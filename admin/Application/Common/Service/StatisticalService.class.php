<?php
namespace Common\Service;
use Think\Model;

/**
 * Class StatisticalService
 * @package Common\Service
 * 2014-6-3     统计模块
 */
class StatisticalService extends Model {


    /**
     * 创建横坐标
     * 2014-6-3
     * @param $start_date  开始时间  时间戳
     * @param $end_date  结束时间
     * @return array
     */
    public function createX($start_date,$end_date){
        $start_date = strtotime($start_date);  //起始时间 时间戳转化
        $end_date   = strtotime($end_date);
        //连个时间相同  就是一天
        if($start_date == $end_date){
            $day = 1;
        }else{
            $day = ($end_date-$start_date)%86400 > 0 ? floor(($end_date-$start_date)/86400)+1 : floor(($end_date-$start_date)/86400);
        }
        //创建横坐标显示
        $date = "";
        for($i = 0; $i <= $day; $i++){
            $d = date('y/m/d',intval($start_date) + intval($i*86400));
            $date .= "'$d',";
        }
        $x_date = substr($date,0,strlen($date)-1);
        //横坐标区间
        $step = floor($day/15);
        return array('x_date'=>$x_date,'step'=>$step);
    }

    /**
     * 月份横坐标
     * @return array
     * 2014-8-18  add by <黑暗中的武者>
     */
    public function createMonthX(){
        $date = "";
        for($month = 1; $month <= 12; $month++){
            $month_x = $month.'月';
            $date .= "'$month_x',";
        }
        $month_x_date = substr($date,0,strlen($date)-1);
        return $month_x_date;
    }

    /**
     * 创建年份下拉
     * @param $year
     * @return string
     * 2014-8-18  add by <黑暗中的武者>
     */
    public function createYearSelect($year){
        //创建年份的下拉菜单
        $year_sel = "<select name='year' class='small-input text-input'>";
        //从当前年向前循环14年
        for($j = 14; $j >= 0; $j--){
            //选中年份
            if(intval($year) == (intval(date('Y'))-$j)){
                $year_sel.="<option value='".(intval(date('Y'))-$j)."' selected='true'>".(intval(date('Y'))-$j)."年</option>";
            }else{
                $year_sel.="<option value='".(intval(date('Y'))-$j)."'>".(intval(date('Y'))-$j)."年</option>";
            }
        }
        $year_sel.= "</select>";
        return $year_sel;
    }

    /**
     * 获取折线统计数据
     * @param $start_date
     * @param $end_date
     * @param $parameter  相关参数 包含 (标题  查询条件  对象)
     * @return mixed
     */
    public function getLineData($start_date,$end_date,$parameter){
        $start_date = strtotime($start_date);  //起始时间 时间戳转化
        $end_date   = strtotime($end_date);
        if($start_date == $end_date){
            $day = 1;
        }else{
            //获取天数
            $day = ($end_date-$start_date)%86400 > 0 ? floor(($end_date-$start_date)/86400)+1 : floor(($end_date-$start_date)/86400);
        }
        //获取统计值
        for($i = 0; $i <= $day; $i++){
            foreach($parameter as $k => $value){
                $value['where']['ctime'] = array('between',($start_date + $i * 86400).",".($start_date + ($i+1) * 86400));

                if(empty($value['flag'])){
                    $data[$k][] = $value['obj']->where($value['where'])->count('distinct order_sn');
                }else{
                    $field = "SUM(".$value['flag'][1].")";
                    $amount = $value['obj']->where($value['where'])->getField($field);
                    $data[$k][] =  sprintf("%.2f", $amount);
                }
            }
        }
        //添加标题
        foreach($parameter as $k => $value){
            $result[$value['title']] = $data[$k];
        }
        return $result;
    }

    /**
     * @param $year        年份
     * @param $parameter   相关参数 包含 (标题  查询条件  对象)
     * @return mixed
     * 2014-8-18  add by <黑暗中的武者>
     */
    public function getLineDataByMonth($year,$parameter){
        //获取统计值
        for($month = 1; $month <= 12; $month++){
            foreach($parameter as $k => $value){
                $day_num = getDayNum($year,$month);
                $value['where']['ctime'] = array('between',(strtotime("$year-$month-01 00:00:00")).",".(strtotime("$year-$month-$day_num 23:59:59")));
                $data[$k][$month] = $value['obj']->where($value['where'])->count();
            }
        }
        //添加标题
        foreach($parameter as $k => $value){
            $result[$value['title']] = $data[$k];
        }
        return $result;
    }
    /**
     * 折线参数处理
     * 2014-6-3
     * @param $data 数据格式   $data["商铺统计 **折线名称**"] = array(4,5,...)数组中存入每个时间段的统计数量;
     * @return string
     */
    public function createLine($data){
        //创建折线参数字符串
        $line = '';
        foreach($data as $key => $value){
            $line_data = '';
            $line.= "{name: '".$key."',data:[";
            foreach($value as $v){
                $line_data.=$v.',';
            }
            $line.=substr($line_data,0,strlen($line_data)-1);
            $line.="]},";
        }
        //去除字符串末尾的逗号
        $line = substr($line,0,strlen($line)-1);
        //返回highcharts格式的字符串
        return $line;
    }

    /**
     * 饼状图  获取数据
     * 2014-6-3
     */
    public function getPieData($parameter){
        //总数
        $sum = 0;
        //每个分区的统计值
        foreach($parameter as $key => $value){
            $count = $value['obj']->where($value['where'])->count();
            $parameter[$key]['count'] = $count;
            $sum = $sum + $count;//总数
        }
        //每个分区所占比例
        foreach($parameter as $value){
            $data_per = number_format(($value['count']/$sum)*100,1);//每个分区所占比例
            $data[] = array($value['title']."({$value['count']})",$data_per); //添加标题
        }
        return $data;
    }

    /**
     * 饼状图参数处理
     * 2014-6-3
     * @param $data $data数据格式    $data = array(array('18岁以下 **饼状图分区的标题** ',$per **该分区所占的比例值** ));
     * @return string
     */
    public function createPie($data){
        //创建饼状图参数字符串
        $pie = '';
        foreach($data as $key => $value){
            if($key == 0){
                $pie .= "{name: '".$value[0]."', y:".$value[1].", sliced:true,selected:true},";
            }else{
                $pie .= "['".$value[0]."', ".$value[1]."],";
            }
        }
        //去除字符串末尾的逗号
        $pie = substr($pie,0,strlen($pie)-1);
        //返回highcharts格式的字符串
        return $pie;
    }
}