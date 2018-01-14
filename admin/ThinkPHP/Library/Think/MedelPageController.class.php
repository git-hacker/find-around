<?php
namespace Think;
class MedelPageController{
	public function execute_page(MedelPage $medelpage)
	{
		if ($medelpage->getCountpage() != 1) {
			$nevipage="";
			if(1==$medelpage->getNowpage())
			{
	            $nevipage="<div class='page'><a href='javascript:;'><span class='emptytop'>上一页</span></a>";
			}
			else 
			{
				$nevipage="<div class='page'><a href='".$medelpage->getLinkaddress()."page/".$medelpage->getToppage()."'><span class='top'>上一页</span></a>";
			}
			//$begin=floor(($medelpage->getNowpage()-1)/5)*5+1;
			//$leng=$begin+5;
			$middle         =   ceil($medelpage->getRollPage()/2); //中间位置
	
		      if ($medelpage->getCountpage() > $medelpage->getRollPage()) {
	
		            if($medelpage->getNowpage() - $middle < 1){
                      $nevipage.=   '';
		            }else{
		                $nevipage.="<a href='".$medelpage->getLinkaddress()."page/1'><span>1</span></a>...&nbsp;&nbsp;";
		            }
			    }
			if($medelpage->getNowpage()<$middle){
				$start=1;
				$end=$medelpage->getRollPage();
			}elseif ($medelpage->getCountpage() < $medelpage->getNowpage() + $middle - 1 ) {//&& $medelpage->getCountpage()>$middle
	                $start = $medelpage->getCountpage() - $medelpage->getRollPage() + 1;
	                $end = $medelpage->getCountpage();  
	              
	        } else {
	                $start = $medelpage->getNowpage() - $middle + 1;
	                $end = $medelpage->getNowpage() + $middle - 1;
	        }
	        $start < 1 && $start = 1;
	        $end >$medelpage->getCountpage() && $end = $medelpage->getCountpage();
			for($i=$start;$i<=$end;$i++)
			{
				if($medelpage->getCountpage()>=$i)
				{
	
							if($i==$medelpage->getNowpage())
							{
								$nevipage.="<a href='".$medelpage->getLinkaddress()."page/".$i."'><span class='shownow'>".$i."</span></a>";
							}
							else
							{
								$nevipage.="<a href='".$medelpage->getLinkaddress()."page/".$i."'><span>".$i."</span></a>";
							}
						
				}
			}
			if ($medelpage->getCountpage() > $medelpage->getRollPage()) {
	
				 if($medelpage->getNowpage() + $middle > $medelpage->getCountpage()){
	                $nevipage.=   '';
	            }else{
	                $theEndRow  =   $medelpage->getCountpage();
	                $nevipage.=   "...&nbsp;&nbsp;<a href='".$medelpage->getLinkaddress()."page/".$theEndRow."'><span>".$theEndRow."</span></a>";
	            }
			}
			if($medelpage->getNowpage()==$medelpage->getCountpage())
			{
		    	$nevipage.="<a href='javascript:;'><span class='emptybottom'>下一页</span></a>";
			}
			else
		    {
		      $nevipage.="<a href='".$medelpage->getLinkaddress()."page/".$medelpage->getDownpage()."'><span class='bottom'>下一页</span></a>";
			}
			$pageinput="<input tal='".$medelpage->getCountpage()."' type='text' class='pagetext' value=''/><a href='".$medelpage->getLinkaddress()."page=".$medelpage->getDownpage()."'><span class='bottom butpage'>提交</span></a>";
			$nevipage.="当前第<font>".$medelpage->getNowpage()."</font>页/共<font class='totalpage'>".$medelpage->getCountpage()."</font>页</div>";
			if($medelpage->getCountpage()>1){
				$medelpage->setNevipage($nevipage);
			}
			
		}
	}
}
?>