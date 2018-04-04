<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends AdminCommonController {
 
  //生成session来区分板块
  public function switchtab(){
	if (IS_AJAX) {
	  $tabid = I('post.tabid',1,'intval');
	  session('tabid',$tabid);
	  $this->ajaxReturn(1);
	} else {
	  $this->error('非法操作');
	}
  }
  //修改属性
  public function modattr(){
    $tables = I('post.tables','');
    $field  = I('post.field','');
    $id     = I('post.id',0,'intval');
    $val    = I('post.val','');
    if($tables!='' && $field!='' && $id!=0){
	 $dobj = M($tables);
	 if($val!=''){
	   $val = intval($val);
	   $result = $dobj->where(array('Id'=>$id))->save(array($field=>$val));
	 }else{
	    $data = $dobj->field($field)->where(array('Id'=>$id))->find();
	    if($data[$field]==1){
	       $result = $dobj->where(array('Id'=>$id))->save(array($field=>0));
	    }else{
	       $result = $dobj->where(array('Id'=>$id))->save(array($field=>1));
	    }
	  }
	 $this->ajaxReturn($result);
    }
  } 
  //
  public function getMenu(){
    if (IS_AJAX) {
	  $id = I('post.id',0,'intval');
	  if ( $id ) {
	     $data = M('adminauth')->field('title,Id')->where('1=1 AND tid='.$id)->order('ord ASC')->select();
	     if ($data) {
		   $str = '';
		   foreach ($data as $key=>$val) {
		     $str .= '<a href="javascrupt:void(0)" class="btn-menu" data-id="'.$val['Id'].'">'.btn(array('vals'=>$val['title'],'size'=>3,'scene'=>'default')).'</a>&nbsp;';
		   }
		   $this->ajaxReturn($str);
		 } else {
		   $this->ajaxReturn('');
		 }
	  }
	}
  }
  
  //修改字段
  public function modField(){
    if (IS_AJAX) {
	  $tables = I('post.tables','');
	  $field  = I('post.field','');
	  $id     = I('post.id',0,'intval');
	  $val    = I('post.val','');
	  if($tables!='' && $field!='' && $id!=0){
		 if($val!=''){
		   $result = M($tables)->where(array('Id'=>$id))->save(array($field=>$val));
		   $this->ajaxReturn($result);
		 } else {
		   $this->ajaxReturn(0);
		 }
	  } else {
	    $this->ajaxReturn(0);
	  }
	}
  }
  //searchField
  public function searchField(){
    if (IS_AJAX) {
	  $tables   = I('post.tables','');
	  $field    = I('post.field','');
	  $sfield   = I('post.sfield','');
	  $kwd      = I('post.key','');
	  $addshow  = I('post.addshow','');
	  $addfield = ($addshow!='') ? ','.$addshow : '';
	  if ($tables!='' && $field!='') {
		if ( $kwd!='' ) {
			if ($sfield!='') {
			  $sArr = explode(",",$sfield);
			  $where = '';
			  foreach( $sArr as $k=>$v ) {
				$where .= " OR $v LIKE '%".$kwd."%'";
			  }
			  $where = ($where!='') ? substr($where,3,strlen($where)) : '';
			} else {
			  $this->ajaxReturn(0);
			}
		} else {
		  $where = '1=1';
		}
	    $mData = M($tables)->field("Id,".$field.$addfield)->where($where)->order('Id ASC')->limit(50)->select();
		if ($mData) {
		  $str = '';
		  foreach($mData as $key=>$val) {
			$fields = ($addshow!='' && $val[$addshow]!='') ? ' | '.$val[$addshow] : '';
			$sdata  = ($kwd!='') ? str_replace($kwd,'<font color="red">'.$kwd.'</font>',$val[$field]) : $val[$field];
		    $str .= '<li class="active-result" data-id="'.$val['Id'].'">'.$sdata.$fields.'</li>';
		  }
		  $this->ajaxReturn($str);
		} else {
		  $this->ajaxReturn(0);
		}
	  } else {
	    $this->ajaxReturn(0);
	  }
	}
  }
  //修改排序
  public function modord(){
    $tables = I('post.tables','');
    $ord    = I('post.ord',0,'intval');
    $id     = I('post.id',0,'intval');
    if($tables!='' && $id!=0){
	  $result = M($tables)->where(array('Id'=>$id))->save(array('ord'=>$ord));
	  $this->ajaxReturn($result);
    }
  }
  //修复 优化 数据表
  public function setdata(){
    $acts   = I('post.acts','');
    $tables = I('post.tables','');
	$tables = ($tables!='') ? str_replace(C('DB_PREFIX'),'',$tables) : '';
	$conn   = M();
    if($acts=="opt"){
      $conn->query("OPTIMIZE TABLE `$tables`"); //优化
	  $this->ajaxReturn(1);
    }else if($acts=="repair"){
      $conn->query("REPAIR TABLE `$tables`"); //修复
	  $this->ajaxReturn(1);
    }else{
      $this->ajaxReturn(0);
    }
  }
  //检测用户是否存在
  public function ckuser(){
    $user = I('post.user','');
	if($user != ''){
	  $this->ajaxReturn(D("AdminUser")->ckuser($user));  
	}
  }
  //下拉联动
  public function droplinks(){
	 $tables  = I('post.tables','');
	 $tables2 = I('post.tables2','');
	 $field   = I('post.field','');
	 $field2  = I('post.field2','');
	 $id      = I('post.id',0,'intval');
	 if($tables!='' && $field!='' && $id!=0){
		 $mtagData = M($tables)->field('Id,topic')->where(array($field=>$id))->order('ord asc')->select();
		 if($mtagData){
		   $str = '';
		   foreach($mtagData as $key=>$val){
			  $str .= '<li><a href="javascript:void(0)" data-id="'.$val['Id'].'" data-tables="'.$tables2.'" data-field="'.$field2.'"" class="menu-li2">'.$val['topic'].'</a></li>';
		   }
		   $this->ajaxReturn($str);
		 }else{
		   $this->ajaxReturn('<li><a href="javascript:void(0)">没有数据</a></li>');
		 }
	  }
  }
  //下拉2
  //3级联动
  public function droplinks2(){
   $tables = I('post.tables','');
   $field  = I('post.field','');
   $id     = I('post.id',0,'intval');
   if($tables!='' && $field!='' && $id!=0){
     $mtagData = M($tables)->field('Id,topic')->where(array($field=>$id))->order('ord asc')->select();
	 if($mtagData){
	   $str = '';
       foreach($mtagData as $key=>$val){
	     $str .= '<li><a href="javascript:void(0)" data-id="'.$val['Id'].'" class="menu-li3">'.$val['topic'].'</a></li>';
	   }
	   $this->ajaxReturn($str);
	 }else{
	   $this->ajaxReturn('<li><a href="javascript:void(0)">没有数据</a></li>');
	 }
   }
  }
 //裁剪
 public function croppic(){
   if ( IS_AJAX ) {
     $w    = I('post.w',0,'intval');
	 $h    = I('post.h',0,'intval');
	 $x    = I('post.x',0,'intval');
	 $y    = I('post.y',0,'intval');
     $r    = I('post.r',0,'intval');
	 $path = I('post.path','');
	 $iswater = I('post.iswater',0,'intval');
	 $delpic  = I('post.delpic',0,'intval');
	 if ( $path == '' ) $this->ajaxReturn(array('state'=>0,'msg'=>'请上传裁剪的图片'));
	 if ( $w == 0 || $h == 0 ) $this->ajaxReturn(array('state'=>0,'msg'=>'裁剪的宽度和高度不能为0px'));
	 $rdata = D("File")->croppic(array('x'=>$x,'y'=>$y,'w'=>$w,'h'=>$h,'r'=>$r,'iswater'=>$iswater,'path'=>$path,'delpic'=>$delpic));
     $this->ajaxReturn($rdata);
   }
 }
 
 public function getpiclist(){
   if ( IS_AJAX ) {
     $page = I('post.page',1,'intval');
	 $path = I('post.path','');
	 $data = D('File')->getpic($path,$page);
	 $html = '';
	 if ( $data['count'] > 0 ) {
	   foreach( $data['sdata'] as $pkey=>$pval ) {
         $html .= ($pval['spic']!='') ? '<div class="picdiv picture-fname" data-path="'.$pval['spic'].'"><img src="'.ispic($pval['spic']).'" data-action="zooms"><p title="'.$pval['pic'].'">'.$pval['pic'].'</p><div class="pic-active"></div></div>' : '';
       }
	 }
	 $this->ajaxReturn(array('msg'=>'','state'=>1,'html'=>$html,'pagelist'=>$data['pagelist']));
   } else {
     $this->ajaxReturn(array('msg'=>'非法调用','state'=>0));
   }
 }
 
   public function lockscreen(){
	if (IS_AJAX) {
	  $adminAuth = session('adminauth');
	  session('lockrealname',$adminAuth['realname']);
	  session('lockuser',$adminAuth['adminuser']);
	  $this->ajaxReturn(1);
	} else {
	  $this->error('非法操作');
	}
  }
 
 
}