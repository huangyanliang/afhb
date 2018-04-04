<?php
 namespace Home\Controller;
 use Think\Controller;
 class HomeConfController extends Controller{ 
  protected function _initialize(){
	if(!$sysconf = S("sysconf")){  
	   $sysconf  = M("systemconfig")->field('metatitle,metades,metakey,companyname,address,email,tel,mobile,icpnote,c_site,c_text,sys_code,shieldip,iptips,isonline,qq,isqq,companyurl,weibourl,weixinpic')->where(array('Id'=>1))->find();
	  ($sysconf) ? S("sysconf",$sysconf,7200) : '';
	}
	if($sysconf){
	   if(!$sysconf['c_site']){
	     D('Home')->shieldip(get_client_ip(),$sysconf['shieldip'],$sysconf['iptips']);
	     $this->assign('title','');
	     $this->assign('metatitle',$sysconf['metatitle']);
	     $this->assign('metades',  $sysconf['metades']);
	     $this->assign('metakey',  $sysconf['metakey']);
	     $this->assign('sysconf',  $sysconf);                      
	   }else{
	     header('Content-Type: text/html;charset=utf-8');
	     echo ($sysconf['c_text']!='') ? ('<h1 style="text-align:center;line-height:380px;color:#666;">'.$sysconf['c_text'].'</h1>') : ('<h1 style="text-align:center;line-height:380px;color:#666;">网站项目维护中..</h1>');
         exit();
	   }
	}else{
	   exit('<h1 style="text-align:center;line-height:250px;color:#666;">NO SYSTEM DATA</h1>');
	}
	
	$aboutMenu  = M('aboutus')->field('Id,topic')->where('enabled=1 and sty=1')->order('ord asc,date desc')->select();
	$this->assign('aboutMenu',$aboutMenu);
	$newMenu    = M('inftype')->field('Id,topic')->where('enabled=1 and sty=1')->order('ord asc,date desc')->select();
	$this->assign('newMenu',$newMenu);
	$caseMenu   = M('inftype')->field('Id,topic')->where('enabled=1 and sty=2')->order('ord asc,date desc')->select();
	$this->assign('caseMenu',$caseMenu);
	$honorMenu  = M('inftype')->field('Id,topic')->where('enabled=1 and sty=3')->order('ord asc,date desc')->select();
	$this->assign('honorMenu',$honorMenu);
	$proMenu  = M('inftype')->field('Id,topic,pic')->where('enabled=1 and sty=4')->order('ord asc,date desc')->select();
	$this->assign('proMenu',$proMenu);
  }
  
  protected function insidepic($ctag=0) {
	if (!$ctag) return false;
    if(!$articleadv = S('articleadv'.$ctag)) {
	  $articleadv   = M('advdata')->field('pic,topic,linkurl')->where(array('ctag'=>$ctag))->find();
	  ($articleadv) ? S('articleadv'.$ctag,$articleadv,3600) : '';
    }
    return $articleadv; 
  }
   
 } 
