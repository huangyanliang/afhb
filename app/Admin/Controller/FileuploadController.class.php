<?php
namespace Admin\Controller;
use Think\Controller;
/* 公用上传类 */
class FileuploadController extends Controller {
  
  //图片上传
  public function picupload(){
	$this->ajaxReturn(D('File')->picupload());
  } 
  //文件上传
  public function fileupload(){
	$this->ajaxReturn(D('File')->fileupload());
  } 
  //编辑器上传
  public function editorUpload(){
    $this->ajaxReturn(D('File')->editorUpload());
  }
  //美图秀秀插件
  public function meituxiuxiu(){
	$act = I('get.act','');
	if ( $act == '' ) {
	  $uploadurl  = 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI']).'/picupload.html';
	} else {
	  $uploadurl  = 'http://'.$_SERVER['SERVER_NAME'].dirname(dirname(dirname($_SERVER['REQUEST_URI']))).'/picupload.html';
	}
	$this->assign('uploadurl',$uploadurl);
	$this->assign('act',$act);
	$this->assign('title', '美图秀秀图片处理');
	$this->display();
  }

}