<?php
 namespace Home\Controller;
 use Think\Controller;
 class ArticleController extends HomeConfController {
   
   public function index(){
     $id     = I('get.id',0,'intval');
	 $tables = 'information';
	 if (!$id) $this->error('页面不存在');
	 $data   = M($tables)->field('topic,author,date,content,keyword,metades,sty,hit,source,intro,pic,linkurl')->where(array('enabled'=>1,'Id'=>$id))->find();
	 if (!$data) $this->error('页面不存在');
	 M($tables)->where(array('enabled'=>1,'Id'=>$id))->limit(1)->setInc('hit');
	 if ($data['linkurl'] !='' ) header("Location:".$data['linkurl']);
	 $data['date']    = date('Y-m-d',strtotime($data['date']));
	 $data['author']  = ($data['author']=='admin') ? '' : $data['author'];
	 $this->assign('data',$data);
	 $this->assign('title',$data['topic']);
	 $this->assign('metades',($data['metades']!='') ? $data['metades'] : $data['topic']);
	 $this->assign('metakey',($data['keyword']!='') ? $data['keyword'] : $data['topic']);
	 $this->assign('mark','news');
	 $this->display();
   }
   
 }