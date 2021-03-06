<?php
namespace Admin\Model;
class AdminUserModel {
  //管理员登录
  public function login($user,$pass,$lockscreen=0){
    if($user!='' && $pass!=''){
	 $map   = array('user'=>$user);
	 $check = M('adminuser')->field("Id,user,userpass,randcode,last_ip,depid")->where($map)->find();
	 if($check['userpass'] == md5($check['randcode'].$pass)){
	   $randcode = $this->getcode();
	   M('adminuser')->where($map)->setInc('count');
	   M('adminuser')->where($map)->limit(1)->save(array('last_time' => dates(),'last_ip' => get_client_ip(),'randcode' => $randcode,'userpass'  => md5($randcode.$pass)));
	   M('adminrecord')->add(array('user' => $user,'ip' => get_client_ip(),'date' => dates()));
	   session(array('name'=>'adminauth','expire'=>3600*2));
	   session('adminauth',array('adminuid'=>$check['Id'],'adminuser'=>$check['user'],'admintime'=>time(),'admindepid'=>$check['depid'],'adminip'=>get_client_ip()));
	   if($check['last_ip'] != get_client_ip()) session('loginWarning','您的登录IP发生了变化，系统提示您及时去<a href="'.U('index/modpass').'">修改</a>你的登录密码。');
	   writelog('adminUser','应用：登录 状态：登录成功 用户名：'.$user.' 密码：****** 登录IP:'.get_client_ip());
	   $ckpass = $this->AdminPass($pass);
	   if ( $ckpass['code'] == 0 ) session('passWarning',$ckpass['msg']);
	   if ( $lockscreen ) {
	     session('lockrealname',null);
	     session('lockuser',null);
	   }
	   return 1;
	 }else{
	   writelog('adminUser','应用：登录 状态：登录失败 用户名：'.$user.' 密码：'.$pass.' 登录IP:'.get_client_ip());
	   return 2;
	 }
	}else{
	 return 0;
	}
  }
  //检测密码是否过于简单，简单的话提示用户修改
  private function AdminPass( $pass = '' ) {
    if ( $pass!='' ) {
	  if ( strlen($pass) < 6 )  return array('code'=>0,'msg'=>'您的密码过于简单，系统提示您及时去<a href="'.U('index/modpass').'">修改</a>你的登录密码。');
	  if ( is_numeric($pass) )  return array('code'=>0,'msg'=>'您的密码过于简单，系统提示您及时去<a href="'.U('index/modpass').'">修改</a>你的登录密码。'); 
	  return array('code'=>1,'msg'=>'success');
	} else {
	  return array('code'=>0,'msg'=>'您提交的验证的密码为空。');
	}
  }
  //检测是否非法登录或者登录过久
  public function AdminLogin(){
    $adminAuth = session('adminauth');
	$times     = time(); //当前时间
	$ip        = get_client_ip(); //登录IP
	if (!$adminAuth) return array('status'=>0,'code'=>'','msg'=>'登录超时，请重新登录');
	if (!isset($adminAuth['admintime']) || $adminAuth['admintime']=='') return array('status'=>0,'code'=>'','msg'=>'登录超时，请重新登录');
	if ($times - $adminAuth['admintime'] > 7200) return array('status'=>0,'code'=>'','msg'=>'登录授权失效，请重新登录');
	//检测 IP 
	$adminData = M('adminuser')->field("last_ip")->where('Id='.$adminAuth['adminuid'])->find();
	if (!$adminData) {
	  session('adminauth',null);//
	  return array('status'=>0,'code'=>'','msg'=>'系统未检测到有效的登录ID。');
	} else {
	  if ($ip == $adminData['last_ip']) {//延长登录时间
	    session('adminauth',array('adminuid'=>$adminAuth['adminuid'],'adminuser'=>$adminAuth['adminuser'],'admintime'=>time(),'admindepid'=>$adminAuth['admindepid'],'adminip'=>$ip));
	  }
	}
	return array('status'=>1,'code'=>'','msg'=>'');
  }
  //修改密码
  public function modpass($pass,$uid){
    if($pass!='' && $uid!=''){
	  $randcode = $this->getcode();
	  $savedata = array(
	                   'randcode' => $randcode,
					   'userpass' => md5($randcode.$pass),
					   );
	  $result = M('adminuser')->where(array('Id'=>$uid))->limit(1)->save($savedata);
	  $statue = ($result) ? '成功' : '失败';
	  writelog('adminUser','应用：修改密码 状态：'.$statue.' 用户ID：'.$uid);
	  return ($result) ? true : false;
	}else{
	  return false;
	}
  }
  //检测密码是否正确
  public function ckpass($pass,$uid){
   if($pass!='' && $uid!=''){
    $data = M('adminuser')->field('userpass,randcode')->where(array('Id'=>$uid))->find();
	if($data){
	  return ($data['userpass'] == md5($data['randcode'].$pass)) ? true : false;
	}else{
	  return false;
	}
   }else{
     return false;
   }
  }
  //检测用户是否存在
  public function ckuser($user){
    if($user!=''){
      $data = M('adminuser')->where(array('user'=>$user))->find();
	  return ($data) ? 0 : 1;
	}else{
	  return 0;
	}
  }
  //创建管理员
  public function adduser($user,$pass,$name,$depid=0,$auth=''){
    if($user!='' && $pass!=''){
	  if($this->ckuser($user)){
	    $randcode = $this->getcode();
	    $savedata = array(
		               'user'     => $user,
					   'realname' => $name,
	                   'randcode' => $randcode,
					   'userpass' => md5($randcode.$pass),
					   'auth'     => $auth,
					   'depid'    => $depid,
					   'reg_time' => dates()
					   ); 
		$result = M('adminuser')->add($savedata);
		$statue = ($result) ? '创建成功' : '创建失败';
		$admin  = session('adminauth');
		writelog('adminUser','应用：创建管理用户 状态：'.$statue.' 用户名：'.$user.' 权限：'.$auth.' 创建管理员：'.$admin['adminuser']);
		return ($result) ? true : false;
	  }else{
	    return false;
	  }
	}else{
	  return false;
	}
  }
  //更新随机码
  private function getcode($len=6){
	 $str = "0123456789";
	 $code = '';
	 for ($i = 0; $i < $len; $i++) {
	    $code .= $str[mt_rand(0, strlen($str)-1)];
	 }
	 return $code;
  }
  
}