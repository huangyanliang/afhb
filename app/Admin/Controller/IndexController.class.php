<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
	private $cache_time = 3600;
	public function index(){
	   if ( session('lockuser') && session('lockuser')!='' ) {
	     $this->redirect('Index/lockscreen');
	   }
	   $loginstatue = D('AdminUser')->AdminLogin();
	   if($loginstatue['status']){
		 C("SHOW_PAGE_TRACE",false);
		 $topmenu = $this->topmenu();
		 $tabid = session("tabid");
		 $tabid = ($tabid==0 || $tabid==null) ? $topmenu[0]['Id'] : $tabid;
		 $mmenu = M('adminauth')->field('Id,name,icon,isext,linkurl,isopen,title')->where('1=1 AND tid='.$tabid)->order('ord ASC')->select();
		 if ( $mmenu ) {
		   foreach ( $mmenu as $key=>$val ) {
		     $mmenu[$key]['smenu'] = M('adminauth')->field('name,icon,isext,linkurl,title,Id')->where('1=1 AND isspecial=0 AND tid='.$val['Id'])->order('ord ASC')->select();
		   }
		 }
		 $this->assign('myauth',$this->myAuth()); //我的权限
		 $this->assign('topmenu',$topmenu);
		 $this->assign('mmenu',$mmenu);
		 $this->assign('tabid',$tabid);
		 $this->assign('refer',U('index/main'));
		 $this->assign('title','澳菲环保后台管理系统');
		 $this->assign('adminauth',session('adminauth'));
		 $this->display();
	   }else{
		 $this->redirect('index/login');
	   }
	}
	//获取TOPMENU
	private function topmenu(){
	  return M('adminauth')->field('Id,title,isext,icon')->where('tid=0')->order('ord ASC')->select();
	}
	//获取我的权限列表
	private function myAuth() {
      $loginstatue = D('AdminUser')->AdminLogin();
	  if($loginstatue['status']){
	    $adminauth  = session('adminauth');
		$admindepid = $adminauth['admindepid'];
		$auth = M('admindepartment')->field('auth')->where(array('Id'=>$admindepid))->find();
		if ( $auth ) {
		  return $auth['auth'];
		} else {
		  return FALSE;
		}
	  } else {
	    $this->error($loginstatue['msg'],U("index/login"),2);	
	  }
	}
	//修改密码
	public function modpass(){
	   $loginstatue = D('AdminUser')->AdminLogin();
	   if($loginstatue['status']){
		if(I('post.send','') == "修改密码"){
		  $oldpass = I('post.pass','',false);
		  $newpass = I('post.newpass','',false);
		  if($oldpass!=$newpass){
		    $login  = D("AdminUser");
			$adminauth = session('adminauth');
			if($login->ckpass($oldpass,$adminauth['adminuid'])){
			 $result = $login->modpass($newpass,$adminauth['adminuid']);
			 if($result){
			   session('loginWarning',null);
			   $this->success('密码修改成功，下次登录有效',U('index/modpass'),2);
			 }else{
			   $this->error('密码修改失败，请重试',U('index/modpass'),2);
			 }
			}else{
			 $this->error('抱歉，您输入的旧密码有误，请重新输入',U('index/modpass'),2);
			}
		  }else{
		    $this->error('新密码不能和原密码一致',U('index/modpass'),2);
		  }
		}else{
		  $this->assign('adminauth',session('adminauth'));
		  $this->assign('title','修改密码');
	      $this->display();
		}
	  }else{
	    $this->error($loginstatue['msg'],U("index/login"),2);	
	  }
	}
	//系统管理
	public function main(){
	  if ( session('lockuser') && session('lockuser')!='' ) {
	    $this->redirect('Index/lockscreen');
	  }
	  $loginstatue = D('AdminUser')->AdminLogin();
	  if($loginstatue['status']){
		$sys_info = array();
		$sys_info['os']            = PHP_OS;
		$sys_info['web_server']    = $_SERVER['SERVER_SOFTWARE'];
		$sys_info['php_ver']       = PHP_VERSION;
		$sys_info['mysql_ver']     = $this->mysql_version();
		$sys_info['zlib']          = function_exists('gzclose') ? '是' : '否';
		$sys_info['timezone']      = function_exists("date_default_timezone_get") ? date_default_timezone_get() : '无法检测';
		$sys_info['max_filesize']  = ini_get('upload_max_filesize');
		$sys_info['post_maxsize']  = ini_get('post_max_size');
		$gd                        = gd_info();
		$sys_info['gd']            = $gd['GD Version'];
		$sys_info['admin_ver']     = C('ADMIN_VERSION');
		$sys_info['admin_update']  = C('ADMIN_UPDATE');
 		$sys_info['language']      = 'ZH-CN';
		$sys_info['coding']        = 'UTF-8';
		$databackup                = $this->getdataup(C("DB_BACKUP"));
		$sys_info['backupcount']   = count($databackup); //备份记录
		$sys_info['debug']         = C('SHOW_PAGE_TRACE');
		$sys_info['loginwarning']  = session("loginWarning");
		$sys_info['passWarning']   = session("passWarning");
		$sys_info['tcache']        = (C('TMPL_CACHE_ON')) ? 1 : 0; //模板编译
		$disk_size                 = '未知';
		if (function_exists('disk_free_space')) {
		  $disk_size = floor(disk_free_space('./') / (1024 * 1024));
		  if ( $disk_size > 1024 ) {
		    $disk_size = round(floor($disk_size)/(1024),2).'G';
		  } else {
		    $disk_size = round($disk_size,2).'M';
		  }
		}
		$sys_info['disk_size']     = $disk_size;
		$sdata                     = array(); 
	    if(count($databackup)>0){ 
		  for( $i=0;$i<count($databackup);$i++ ){
			$sdata[$i]['time'] = date("Y-m-d H:i:s",filectime($databackup[$i]));
		  }
		}
		$sys_info['backuptime']    = isset($sdata[count($databackup)-1]['time']) ? $sdata[count($databackup)-1]['time'] : '';
		$sys = M('systemconfig')->field('c_site')->where(array('Id'=>1))->find();
		$this->assign('c_site',($sys) ? $sys['c_site'] : 0);
		$this->assign('title','系统管理');
		$this->assign('sysInfo',$sys_info); //注册系统信息
	    $this->display();
	  }else{
		$this->error($loginstatue['msg'],U('index/login'),2);
	  } 
	}
	//返回mysql版本
	private function mysql_version(){
	  if(!$ver = S('sql_ver')){
        $version = M()->query("select version() as ver");
	    S('sql_ver',$version[0]['ver'],3600*24);
        return $version[0]['ver'];
	  }else{
	    return $ver;
	  }
	}
	//返回数据库备份信息
    private static $dataup = array();	
    private function getfile($path){
	  global $dataup;
	  foreach( scandir($path) as $afile ){
		 if( $afile == '.' || $afile == '..' ) continue; 
		 if( is_dir($path.'/'.$afile )) { 
		   $this->getfile($path.'/'.$afile);
		 } else { 
		   $dataup[]=$path.'/'.$afile;
		 } 
	  } 
    }
    private function getdataup($path){
	   global $dataup;
	   $this->getfile($path);
	   return $dataup;
    }
	//删除缓存内容
	public function cleancache() {
	   if ( session('lockuser') && session('lockuser')!='' ) {
	     $this->redirect('Index/lockscreen');
	   }
	   $send  = I('post.send','');
	   if ( $send !='' ) {
		 $cachetype = isset($_POST['cachetype']) ? $_POST['cachetype'] : '';
		 if ( $cachetype == '' ) { $this->error('请至少选择一项缓存类型'); die; }
		 $dirs  = array();
		 foreach ( $cachetype as $key=>$val ) {
		   if ( $val == 1 ) $dirs[] = './app/Runtime/Data/';
		   if ( $val == 2 ) $dirs[] = './app/Runtime/Temp/';
		   if ( $val == 3 ) $dirs[] = './app/Runtime/Cache/Home/';
		   if ( $val == 4 ) $dirs[] = './app/Runtime/Cache/Admin/';
		   if ( $val == 5 ) $dirs[] = './app/Html/';
		   if ( $val == 6 ) $dirs   = array ('./app/Runtime/','./app/Html/');
		 }
	     foreach ( $dirs as $value ) {
		   $this->_rmdirr ( $value );
	     }
		 @mkdir ( './app/Runtime', 0777, true );
         $this->success('系统缓存清除成功',U('index/main'),2);
	   } else {
		 $this->assign('act',$act);
		 $this->assign('title','清除缓存内容');
		 $this->display();
	   }
	}
	private function _rmdirr($dirname) {
		if (! file_exists ( $dirname )) {
			return false;
		}
		if (is_file ( $dirname ) || is_link ( $dirname )) {
			return unlink ( $dirname );
		}
		$dir = dir ( $dirname );
		if ($dir) {
			while ( false !== $entry = $dir->read () ) {
				if ($entry == '.' || $entry == '..') {
					continue;
				}
				$this->_rmdirr ( $dirname . DIRECTORY_SEPARATOR . $entry );
			}
		}
		$dir->close ();
		return rmdir ( $dirname );
	}
	//系统锁屏
	public function lockscreen(){
	  C('TMPL_L_DELIM','{<');
	  C('TMPL_R_DELIM','>}');
	  $lockuser = session('lockuser');
	  $lockrealname = session('lockrealname');
	  if ( !$lockuser || $lockuser == '' ) $this->redirect('index/index');
	  $this->assign('lockrealname',($lockrealname!='') ? $lockrealname : $lockuser);
      $this->assign('lockuser',$lockuser);
	  $this->assign('title','系统锁屏');
	  $this->display();
	}
	//ajax锁屏
	public function ajaxLock(){
	  if ( IS_AJAX ) {
	    $user = I('post.user','');
		$pass = I('post.pass','');
		if ( $user!='' && $pass!='' ) {
		  $result = D('AdminUser')->login($user,$pass,1);
		  if ( $result == 0 ) $this->ajaxReturn(array('state'=>0,'msg'=>'用户名或者密码为空，请输入。'));
		  if ( $result == 1 ) $this->ajaxReturn(array('state'=>1,'msg'=>''));
		  if ( $result == 2 ) $this->ajaxReturn(array('state'=>0,'msg'=>'用户名或者密码错误，请重新输入'));
		} else {
		  $this->ajaxReturn(array('state'=>0,'msg'=>'用户名或者密码为空，请输入。'));
		}
	  } else {
	    $this->ajaxReturn(array('state'=>0,'msg'=>'非法操作'));
	  }
	}
	//登录
	public function login(){
	  $loginstatue = D('AdminUser')->AdminLogin();
	  if(!$loginstatue['status']){
		$data = M("systemconfig")->field('adminpath')->where(array('Id'=>1))->find();
		$this->assign('data',$data);
	    $this->display();
	  }else{
		$this->redirect('index');
	  }
	}
	//退出登录
	public function logout(){
	  $admin = session('adminauth');
	  writelog('adminUser','应用：账户退出 管理员：'.$admin['adminuser']);
	  session('adminauth',null);
	  session('loginWarning',null);
	  session('tabid',null);
	  $this->success("账户已安全退出",U("index/login"),2);	
	}
	//验证登录
	public function checklogin(){
	  $user = I('post.user');
	  $pass = I('post.pass','',false);
	  $code = I('post.code','');
	  if($user!='' && $pass!='' && $code!=''){
		$verify = new \Think\Verify();
		if ($verify->check($code)) {
	      $this->ajaxReturn(D("AdminUser")->login($user,$pass));
		} else {
		  $this->ajaxReturn(3);
		}
	  }else{
		$this->ajaxReturn(4);
	  }
	}
	//登录验证码
	public function logincode() {
	  $config = array('length' => 4,'useImgBg' => false,'useNoise' => false,'useCurve' => false ,'fontttf' => '7.ttf','bg' => array('255','255','255'),'imageW'=>'97','imageH'=>'27','fontSize'=>'13','useZh'=>false,'codeSet'=>'0123456789');
	  $verify = new \Think\Verify($config);
	  ob_clean();
	  $verify->entry();
	}
	//访问统计
	public function dataonline(){
	  $loginstatue = D('AdminUser')->AdminLogin();
	  if(!$loginstatue['status']){
	    $this->error($loginstatue['msg'],U('index/login'),2);
	  }
      $act   = I('get.act',1,'intval');
	  $chart = I('get.chart',1,'intval');
	  $act   = ($act<1 || $act>3) ? 1 : $act;
	  $sday  = I('post.sday','');
	  $eday  = I('post.eday','');
	  $where   = '1=1';
	  $nowtime = date('Y-m-d'); 
	  $subtitle = '';
	  if ($act == 1) {
	    $scene = array('primary','default','default');
		$week  = date("Y-m-d", strtotime("-7 days", strtotime($nowtime)));
	    $where .= " AND day<='".$nowtime."' AND day>='".$week."'";
		$subtitle = '最近7天访问统计信息图';
	  } else if ($act == 2) {
	    $scene = array('default','primary','default');
		$month = date("Y-m-d", strtotime("-31 days", strtotime($nowtime)));
		$where .= " AND day<='".$nowtime."' AND day>='".$month."'";
		$subtitle = '最近30天访问统计信息图';
	  } else if ($act == 3) {
	    $scene = array('default','default','primary');
		$where .= " AND day<='".date('Y-m-30')."' AND day>='".date('Y-m-1')."'";
		$subtitle = '本月访问统计信息图';
	  }
	  if ($chart == 1) {
	    $chartscene = array('success','default','default');
		$type = 'line';
	  } else if ($chart == 2) {
	    $chartscene = array('default','success','default');
		$type = 'column';
	  } else if ($chart == 3) {
	    $chartscene = array('default','default','success');
		$type = 'area';
	  }
	  if ($sday!='' && $eday!='') {
	    $scene = array('default','default','default');
		$where = "1=1 AND day<='".date('Y-m-d',strtotime($eday))."' AND day>='".date('Y-m-d',strtotime($sday))."'";
		$subtitle = $sday.'至'.$eday.'访问统计信息图';
	  }
	  $data = M('online')->group('day')->where($where)->order('day ASC')->limit('30')->select();
	  $chartx  = '' ;
	  $pvcount = '';
	  $ipcount = '';
	  $ucount  = '';
	  $week    = array('星期天','星期一','星期二','星期三','星期四','星期五','星期六');
	  if ($data) {
	    foreach($data as $key=>$val) {
		  $pv                    = $this->getonlinepv($val['day']);
		  $ips                   = $this->getonlineip($val['day']);
		  $data[$key]['pv']      = $pv;
		  $data[$key]['action']  = $this->getonlineaction($val['day']);
		  $data[$key]['ipcount'] = $ips;
		  $data[$key]['time']    = $this->getonlinetime($val['day']);
		  $data[$key]['weekday'] = (date("w",strtotime($val['day']))==0) ? '<font color="red"'.tooltip('礼拜天').'>'.$val['day'].'</font>' : '<font'.tooltip($week[date("w",strtotime($val['day']))]).'>'.$val['day'].'</font>'; 
		  $chartx  .= "'".date("Y/m/d",strtotime($val['day']))."',";
		  $pvcount .= $pv.',';
		  $ipcount .= $ips.',';
		}
	  }
	  $chartx  = removelast($chartx);
	  $pvcount = removelast($pvcount);
	  $ipcount = removelast($ipcount);
	  $this->assign('type',$type);
	  $this->assign('data',$data);
	  $this->assign('scene',$scene);
	  $this->assign('subtitle',$subtitle);
	  $this->assign('chartx',$chartx); 
	  $this->assign('pvcount',$pvcount); 
	  $this->assign('ipcount',$ipcount); 
	  $this->assign('chartscene',$chartscene);
	  $this->assign('chartindex',$chart);
	  $this->assign('sday',$sday);
	  $this->assign('eday',$eday);
	  $this->assign('date',true);
	  $this->assign('act',$act);
	  $this->assign('title',($subtitle!='') ? $subtitle : '在线统计');
	  $this->display();
	}
	//浏览量
	private function getonlinepv($day) {
	  if ($day!='') {
	    return M('online')->where(array('day'=>$day))->count();
	  } else {
	    return 0; 
	  }
	}
	//访问量
	private function getonlinevisit($day) {
	  if ($day!='') {
	    return M('online')->where(array('day'=>$day))->count('distinct ip');
	  } else {
	    return 0;
	  }
	}
	//Ip量
	private function getonlineip($day) {
	  if ($day!='') {
	    return M('online')->where(array('day'=>$day))->count('distinct ip');
	  } else {
	    return 0;
	  }
	}
	//受访问最多的模块
	private function getonlineaction($day) {
      if ($day!='') {
	    $data = M('online')->group('actionid')->where(array('day'=>$day))->order('hit DESC')->find();
		return ($data) ? $data['action'] : '--';
	  } else {
	    return '--';
	  }
	}
	//访问时长
	private function getonlinetime($day) {
	  if ($day!='') {
	    $total = 0 ;
		$data  = M('online')->group('actionid')->where("day='".$day."' AND etime>0")->select();
		if ($day && count($data) > 0) {
		   foreach($data as $key=>$val) {
		     $total += ($val['etime'] > 0 ) ? (intval($val['etime'])-intval($val['stime'])) : 0;
		   } 
		   return $this->dealwithtime(intval($total / count($data)));
		}
	  } else {
	    return '--s';
	  }
	}
	//处理时间
	private function dealwithtime($times) {
	  if ($times > 0) {
	    if ($times < 60) {
		  return '00:00:'.$times;
		} else if ($times >= 60 && $times < 3600 ) {
		  return  gmstrftime('%H:%M:%S', $times);
		} else if ($times >= 3600 ) {
		  return intval($times/3600).":".gmstrftime('%M:%S', $times-3600);
		}
	  } else {
	    return '00:00:00';
	  }
	}
	//查看详细
	public function onlinedetail(){
	    $loginstatue = D('AdminUser')->AdminLogin();
	    if(!$loginstatue['status']){
	      $this->error($loginstatue['msg'],U('index/login'),2);
	    }	
        $day   = I('get.day','');
	  	$page  = I('get.page',1,'intval');
		$dobj  = M('online');
		$where = "day='".$day."'";
		$count = $dobj->where($where)->count();
		$pobj  = new \Think\AdminPage($count,C('ADMINPAGE'));
		$data  = $dobj->field('*')->where($where)->order('hit DESC,stime DESC')->limit($pobj->limit)->select();
		if ($data && count($data) > 0) {
		  foreach($data as $key=>$val) {
		    $data[$key]['timeconsuming'] = ($val['etime'] > 0) ? $this->dealwithtime($val['etime']-$val['stime']) : '00:00:00';
		  }
		}
		$datashow = array();
		$datashow['pageno']   = ($page-1)*$pobj->pagesize;
		$datashow['pageshow'] = ($count>C('ADMINPAGE')) ? $pobj->showpage() : '';
		$datashow['day']      = $day;
	    $this->assign('date',true);
		$this->assign('title',$day.'在线访问统计详细管理');
		$this->assign('dshow',$datashow);
		$this->assign('data',$data);
	    $this->display();
    }
}