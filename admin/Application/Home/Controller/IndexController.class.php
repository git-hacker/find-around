<?php
namespace Home\Controller;
use Think\Controller;

/**
 * Class IndexController
 * @package Admin\Controller
 * 管理页面
 */
class IndexController extends AdminBasicController {

    public function _initialize(){
        $this->checkLogin();
    }

    public function index(){
        $this->display('index');
    }

    public function top(){
        $where['a_id'] = session('A_ID');
        $res = D("Admin")->where($where)->find();
        $this->assign('admin',$res['account']);
        unset($where);
        $where['status'] = 1;
        $order_count = D("Notice")->where($where)->count();
        $this->assign("order_count",$order_count);
        $this->display('top');
        $this->assign('account',session('A_ACCOUNT'));
        $this->display('top');
    }

    public function left(){
        $this->display('left');
    }

    public function main(){

        /**获取商家的行业*/
        $w['parent_id'] = 0;
        $res =  D("Com_cate")->where($w)->select();
        $this->assign('list',$res);
        $cate_id = I("post.cate_id");
        $request['cate_id'] = $cate_id;
        $this->assign("request",$request);
        //判断起始时间
        if(empty($_POST['start_time']) && empty($_POST['end_time'])){
            $start_time = date('Y-m-d',(time()-intval(864000)));
            $end_time = date('Y-m-d',time());
        }else{
            $start_time = I('post.start_time');
            $this->assign("start_time",$start_time);
            $end_time = I('post.end_time');
            $this->assign("end_time",$end_time);
        }
        //年份判空
        $year = empty($_POST['year']) ? date('Y') : I('post.year');
        /**用户分级*/
        $num = empty($_REQUEST['num'])?"":$_REQUEST['num'];
        //横坐标赋值时间
        if($num){
            $this->assign("num",$num);
            //横坐标赋值时间
            $x_res = D('Statistical','Service')->createX($start_time,$end_time,"用户订单总数");
        }else{
            //横坐标赋值时间
            $x_res = D('Statistical','Service')->createX($start_time,$end_time,"用户消费总金额（元）");
        }
        //销售额统计
        $this->getSalesByDay($start_time,$end_time,$cate_id,$num);  //天
        $this->getSalesByMonth($year,$cate_id,$num); //月

        $this->assign('x_date',$x_res['x_date']);
        //相隔区间
        $this->assign('step',intval($x_res['step']));
        //标题
        $this->assign('title',$x_res['title']);
        $this->display('main');
    }

    /**
     * 日活跃度
     */
    public function getSalesByDay($start_time,$end_time,$cate_id,$num){
        //折线图数据 查询条件及对象
        if($cate_id){
            if($num){
                $sales_line_p = array('title'=>'用户订单总数','where'=>array('status'=>array('in','4,6'),'cate_id'=>$cate_id),'obj'=>D('Order'),'flag'=>array());
            }else{
                $sales_line_p = array('title'=>'用户消费总金额','where'=>array('status'=>array('in','4,6'),'cate_id'=>$cate_id),'obj'=>D('Order'),'flag'=>array());
            }
        }elseif($num){
            if($cate_id){
                $sales_line_p = array('title'=>'用户订单总数','where'=>array('status'=>array('in','4,6'),'cate_id'=>$cate_id),'obj'=>D('Order'),'flag'=>array());
            }else{
                $sales_line_p = array('title'=>'用户订单总数','where'=>array('status'=>array('in','4,6')),'obj'=>D('Order'),'flag'=>array());
            }
        }else{
            $sales_line_p = array('title'=>'用户消费总金额','where'=>array('status'=>array('in','4,6')),'obj'=>D('Order'),'flag'=>array());
        }

        //数据参数
        $line_parameter = array($sales_line_p);
        //获取数据
        $sales_line_data = D('Statistical','Service')->getLineData($start_time,$end_time,$line_parameter,$num);
        //创建折线
        $this->assign('day_line',D('Statistical','Service')->createLine($sales_line_data));
        //顶部文字subtitle
        $this->assign('day_date_flag','【日增加量】　'.$start_time.'至'.$end_time);
    }

    /**
     * 月活跃度
     */
    public function getSalesByMonth($year,$cate_id,$num){
        //获取统计值
        for($month = 1; $month <= 12; $month++){
            $day_num = getDayNum($year,$month);
            $where['ctime'] = array('between',(strtotime("$year-$month-01 00:00:00")).",".(strtotime("$year-$month-$day_num 23:59:59")));
            if($num&&$cate_id){
                //已完成订单
                $where['status'] = array('in','4,6');
                $where['cate_id'] = $cate_id;
                $field = "count(order_sn)";
                $amount = D('Order')->where($where)->getField($field);
                $total =  sprintf("%.2f", $amount);
                $sales_line_data['用户订单总数'][] = $total;
            }else{
                if($num){
                    //已完成订单
                    $where['status'] = array('in','4,6');
                    $field = "count(order_sn)";
                    $amount = D('Order')->where($where)->getField($field);
                    $total =  sprintf("%.2f", $amount);
                    $sales_line_data['用户订单总数'][] = $total;
                }else{
                    if($cate_id){
                        //已完成订单
                        $where['status'] = array('in','4,6');
                        $where['cate_id'] = $cate_id;
                        $field = "sum(price)";
                        $amount = D('Order')->where($where)->getField($field);
                        $total =  sprintf("%.2f", $amount);
                        $sales_line_data['所有用户订单钱数'][] = $total;
                    }else{
                        //已完成订单
                        $where['status'] = array('in','4,6');
                        $field = "sum(price)";
                        $amount = D('Order')->where($where)->getField($field);
                        $total =  sprintf("%.2f", $amount);
                        $sales_line_data['所有用户订单钱数'][] = $total;
                    }
                }
            }
        }
        //创建折线
        $this->assign('month_line',D('Statistical','Service')->createLine($sales_line_data));
        //顶部文字subtitle
        $this->assign('month_date_flag','【月增加量】　'.$year.'年');
        $this->assign('month_x_date',D('Statistical','Service')->createMonthX());
        //创建年份下拉菜单
        $this->assign('year_sel',D('Statistical','Service')->createYearSelect($year));
    }


}