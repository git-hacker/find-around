<?php

namespace Think;
require_once dirname(__FILE__).'/MedelPageController.class.php';
class MedelPage{
    private $pagesize;//每页显示的页数或结束行
	private $rowcount;//数据的总行数
	private $nowpage;//当前的页数
	private $countpage;//总页数
	private $startrow;//开始行
	private $toppage;//上一页
	private $downpage;//下一页
	private $rollPage = 5;//分页栏每页显示的页数
	private $linkaddress;//链接
	private $nevipage;//分页导航返回的结果
	public function __construct($pagesize,$rowcount,$linkaddress)
	{
		
		$linkaddressnew=(strpos($linkaddress,"?")>0) ? "/" :"?";
		$linkaddress=$linkaddress.$linkaddressnew;
		
		$this->setPagesize($pagesize);
		$this->setNowpage(!empty($_REQUEST["page"])?intval($_REQUEST["page"]):1);
		$this->setRowcount(empty($rowcount) ? '0' : $rowcount);
		$this->setLinkaddress($linkaddress);
		$this->setCountpage(ceil($this->getRowcount()/$this->getPagesize()));
		$nowpage=$this->getNowpage();
	     if(empty($nowpage))
	     {
	     	$this->setNowpage(1);
	     	
	     }
		 if(1==$this->getNowpage())
		 {
		 	$this->setToppage(1);
		 	$this->setDownpage(2);
		 }
		 else
		 {
		 	$this->setToppage($this->getNowpage()-1);
		 }
		 if($this->getNowpage()==$this->getCountpage())
		 {
		 	$this->setDownpage($this->getNowpage());
		 }
		 else
		 {
		 	$this->setDownpage($this->getNowpage()+1);
		 }
		 if($this->getRowcount()==0){
		 	$this->setNowpage(1);
		 	$this->setPagesize(0);
		 }

		$this->setStartrow(($this->getNowpage()-1)*$this->getPagesize());
	
		$page=new MedelPageController();
		$page->execute_page($this);
	}
	
	/**
	 * @return the $pagesize
	 */
	public function getPagesize() {
		return $this->pagesize;
	}
	/**
	 * @return the $pagesize
	 */
	public function getRollPage() {
		return $this->rollPage;
	}
	/**
	 * @return the $rowcount
	 */
	public function getRowcount() {
		return $this->rowcount;
	}

	/**
	 * @return the $nowpage
	 */
	public function getNowpage() {
		return $this->nowpage;
	}

	/**
	 * @return the $countpage
	 */
	public function getCountpage() {
		return $this->countpage;
	}

	/**
	 * @return the $startrow
	 */
	public function getStartrow() {
		return $this->startrow;
	}

	/**
	 * @return the $toppage
	 */
	public function getToppage() {
		return $this->toppage;
	}

	/**
	 * @return the $downpage
	 */
	public function getDownpage() {
		return $this->downpage;
	}

	/**
	 * @return the $nevipage
	 */
	public function getNevipage() {
		return $this->nevipage;
	}

	/**
	 * @return the $linkaddress
	 */
	public function getLinkaddress() {
		return $this->linkaddress;
	}

	/**
	 * @param field_type $pagesize
	 */
	public function setPagesize($pagesize) {
		$this->pagesize = $pagesize;
	}
	
	/**
	 * @param field_type $pagesize
	 */
	public function setRollPage($rollPage) {
		$this->rollPage = $rollPage;
	}
	/**
	 * @param field_type $rowcount
	 */
	public function setRowcount($rowcount) {
		$this->rowcount = $rowcount;
	}

	/**
	 * @param field_type $nowpage
	 */
	public function setNowpage($nowpage) {
		$this->nowpage = $nowpage;
	}

	/**
	 * @param field_type $countpage
	 */
	public function setCountpage($countpage) {
		$this->countpage = $countpage;
	}

	/**
	 * @param field_type $startrow
	 */
	public function setStartrow($startrow) {
		$this->startrow = $startrow;
	}

	/**
	 * @param field_type $toppage
	 */
	public function setToppage($toppage) {
		$this->toppage = $toppage;
	}

	/**
	 * @param field_type $downpage
	 */
	public function setDownpage($downpage) {
		$this->downpage = $downpage;
	}

	/**
	 * @param field_type $nevipage
	 */
	public function setNevipage($nevipage) {
		$this->nevipage = $nevipage;
	}

	/**
	 * @param field_type $linkaddress
	 */
	public function setLinkaddress($linkaddress) {
		$this->linkaddress = $linkaddress;
	}
}