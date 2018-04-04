<?php
 namespace Home\Controller;
 use Think\Controller;
 class IndexController extends HomeConfController {
   
   public function index(){
   	if(!$adv = S('indexadv')) {
	   $adv   = M('advdata')->field('pic,topic,linkurl')->where('enabled=1')->order('ord asc,date desc')->limit('4')->select();
	   S('indexadv',$adv,$this->homecache_time);
	}
	$this->assign('adv',$adv);
	$about   = M('aboutus')->field('intro')->where('enabled=1 and Id=1')->find();
	$this->assign('about',$about);
	$new     = M('information')->field('Id,topic,date')->where('enabled=1 and sty=1')->order('ord asc,date desc')->limit(3)->select();
	$this->assign('new',$new);
	$honor   = M('information')->field('Id,topic,pic')->where('enabled=1 and sty=3')->order('ord asc,date desc')->select();
	$this->assign('honor',$honor);
	$case    = M('information')->field('Id,topic,pic')->where('enabled=1 and sty=2')->order('ord asc,date desc')->select();
	$this->assign('case',$case);
	$this->assign('mark','index');
    $this->display();
   }
   
   //在线统计
   public function visitStatistics(){
	 if (IS_AJAX) {
	   $result = D('Home')->recordBrower();
	   $this->ajaxReturn($result);
	 } else {
	   $this->ajaxReturn('Illegal operation');
	 }
   }
   
 } 