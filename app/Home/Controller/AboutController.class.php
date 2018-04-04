<?php
 namespace Home\Controller;
 use Think\Controller;
 class AboutController extends HomeConfController {
   
   public function index(){
   	 $id = I('request.id', 1, 'intval');
	 $sty     = 1;
	 $inftype = M('inftype')->field('Id,topic')->where(array('sty'=>$sty,'enabled'=>1))->order('ord ASC')->select();
	 $data    = M('aboutus')->field('topic,content,Id,sty,metades,keyword')->where(array('enabled'=>1,'sty'=>$sty,'Id'=>$id))->find();
	 $this->assign('banner',$this->insidepic(6));
	 $this->assign('metades',($data['metades']!='') ? $data['metades'] : $data['topic']);
	 $this->assign('metakey',($data['keyword']!='') ? $data['keyword'] : $data['topic']);
	 $this->assign('inftype',$inftype);
	 $this->assign('title',$data['topic']);
	 $this->assign('content',$data['content']);
	 $this->assign('id',$id);
	 $this->assign('mark','about');
     $this->display();
   }
   
   
 }