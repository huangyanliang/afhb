<?php
	namespace Home\Controller;
 	use Think\Controller;
 	header("Content-Type: text/html;charset=utf-8");
	header('Access-Control-Allow-Origin:*');//允许跨域
 	class TestController extends Controller{
 		public function test(){
        	$buff -> a ='are you OK?';
        	$buff -> b ='厉害了我的哥';
        	//$this->ajaxReturn($buff);
        	exit(json_encode($buff, JSON_UNESCAPED_UNICODE));  
    	}
 	}
?>