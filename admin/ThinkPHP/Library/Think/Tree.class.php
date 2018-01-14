<?php
namespace Think;
/**
 * 数组树形结构转换 2013-10-28 16:12:18
 * 模板的转意空格 会被替换成 层级符号
 * @author king  edit liyanqiu
*/
class Tree{

	protected $tree_data   = array(); //要变更树状结构的数组
	protected $child       = ''; //数组的子集数组名称
	protected $tmp         = ''; //模板
    protected $field_arr   = array(); // 初始的时候要赋值的字段内容
    protected $replace     = ''; //替换的模板内容
    protected $prohibit    = array(); //不可操作的ID数组
    protected $root_pre    = '';//根树前的层级符号
    protected $son_pre     = '';//子树前的层级符号
    protected $indentation = '';//缩行填充 全角空格(分类缩进) 或 带有宽度的html(无限回复)

    /**
     * 初始化树模型
     * $data 要转换成 tabletree 的 数组  must
     * $child 数组 为 子分类的 索引名称 must
     * $tmp 标签tmp 模板 must
     * $field_arr 初始的时候要赋值的字段内容
     * $replace 要被替换的模板
     * $prohibit  禁止操作的ID数组
     * $indentation 缩行填充 全角空格(分类缩进) 或 带有宽度的html(无限回复)
     */
	public function __init($tree_data=array(),$child='',$tmp='',$field_arr=array(),$replace='',$prohibit=array(),$root_pre='',$son_pre='',$indentation=''){
		$this->tree_data   = $tree_data;
		$this->child       = $child;
		$this->tmp         = $tmp;
        $this->field_arr   = $field_arr;
        $this->replace     = $replace;
        $this->prohibit    = $prohibit;
        $this->root_pre    = $root_pre;
        $this->son_pre     = $son_pre;
        $this->indentation = $indentation;
	}

	/**
	 * 数组转换成树结构 2013-8-22 15:53:15
	 * */
	public function getTree(){
		$trees = '';
		//遍历外部提供的数组
		foreach ($this->tree_data as $val){
            //若该分类不可操作  删除其增删改内容
            if(!empty($this->prohibit) && in_array($val['dishes_cate_id'],$this->prohibit)){
                $tmp = str_replace($this->replace,'',$this->tmp);//替换$this->replace 为 ''
            }else{
                $tmp = $this->tmp;//原模板
            }
			//正则替换
			foreach($this->field_arr as $v){
                //动态匹配数组下标名称
                $tmp = preg_replace("/{".$v."}/i",$val[$v],$tmp);
			}
            //拼接html
			$trees .= $tmp;
			//判断是否有子级
			if(!empty($val[$this->child])){
				$trees .= $this->getChild($val[$this->child],1);
			}
		}
		//去除根目录的层级站位
		$trees = preg_replace("/(\{nbsp})/is", $this->root_pre, $trees);
		return $trees;
	}
    /**
     * 获得树形结构的子级 2013-8-22 18:06:30
     * @param $child 子级数组
     * @param int $lv 子类层级
     * @internal param $fieldarr 需要替换的字段
     * @return mixed|string
     */
    function getChild($child,$lv = 1){
        if(empty($child))return;
        //标签组合
        $trees = '';
        //计算当前的层级
        $nbsp = '';
        for($i = 0; $i < ($lv*2); $i++){
            $nbsp .= $this->indentation;
        }
        $nbsp .= $this->son_pre;
        foreach($child as $val){
            //若该分类不可操作  删除其增删改内容  替换$this->replace 为 ''
            if(!empty($this->prohibit) && in_array($val['dishes_cate_id'],$this->prohibit)){
                $tmp = str_replace($this->replace,'',$this->tmp);
            }else{
                $tmp = $this->tmp;
            }
            //正则替换相应字段数据
            foreach($this->field_arr as $v){
                $tmp = preg_replace("/{".$v."}/i",$val[$v],$tmp);
            }
            //添加到返回字符串
            $trees .= $tmp;
            //子分类层级位置
            $trees = preg_replace("/(\{nbsp})/is", $nbsp, $trees);
            //判断子级是否存在
            if(!empty($val[$this->child])){
                $trees .= $this->getChild($val[$this->child],$lv+1);
            }
        }
        return $trees;
    }

    /**
     * 获得select树形结构 2013-8-23 18:09:25
     * 参数表示谁要被设置成默认选中
     * 下表名为 $index 值为 $selected 的 会被设置为 默认选中
     * @param string $value
     * @param int|string $index
     * @internal param string $valus
     * @internal param int|string $selected
     * @return mixed|string
     */
	function getSelectTree($value='',$index=''){
		$trees = '';
		foreach ($this->tree_data as $val){
			//标签组合
			$tree = $this->tmp;
			//正则替换 动态循环数组下标
			foreach($this->field_arr as $v){
                //根据要替换的标签 匹配数据
				$tree = preg_replace("/{".$v."}/i",$val[$v],$tree);
                //如果满足参数要求 给option 添加 select 属性
                if($val[$index]==$value && !preg_match('/selected/',$tree) && $index!=''){
                    $tree = preg_replace('/>/','selected="selected" >',$tree,1);
                }
			}
			$trees .= $tree;
			if(!empty($val[$this->child])){
				$trees .= $this->getOptionChild($val[$this->child],1,$value,$index);
			}
		}
		$trees = preg_replace("/(\{nbsp\})/is", ' ', $trees);
		return $trees;
	}

    /**
     * @param $child
     * @param int $lv
     * @param string $value
     * @param string $index
     * @return mixed|string
     */
    function getOptionChild($child,$lv = 1,$value = '',$index = ''){
		if(empty($child))return;
		//标签组合
		$trees = '';
		//计算当前的层级
		$nbsp = '';
		for($i = 0; $i < ($lv*2); $i++){
			$nbsp .= "&nbsp;";
		}
		foreach($child as $val){
			$tree = $this->tmp;
			//正则替换相应字段数据
			foreach($this->field_arr as $v){
				$tree = preg_replace("/{".$v."}/i",$val[$v],$tree);
                //如果满足参数要求 给option 添加 select 属性
                if($val[$index]==$value && !preg_match('/selected/',$tree) && $index!=''){
                    $tree = preg_replace('/>/','selected="selected" >',$tree,1);
                }
			}
			//添加到返回字符串
			$trees .= $tree;
			//子分类层级位置
			$trees = preg_replace("/(\{nbsp})/is", $nbsp, $trees);
			//判断子级是否存在
			if(!empty($val[$this->child])){
				$trees .= $this->getOptionChild($val[$this->child],$lv+1,$value,$index);
			}
		}
		return $trees;
	}
}
?>