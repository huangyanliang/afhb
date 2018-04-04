<?php
namespace Home\Model;
class HomeModel{
 //公用防止屏蔽字符
 public function shield($string){
   if($string!=''){
	 if(!$shield = S("wordsfilter")){
	    $shield  = M("systemconfig")->field("wordfilter")->where(array('Id'=>1))->find();
	   ($shield) ? S("wordsfilter",$shield,7200) : '';
	 }
	 if($shield){
	   $words = ($shield['wordfilter']=="") ? array() : explode("|",$shield['wordfilter']);
	   if(count($words)>0){
	     foreach($words as $key=>$val){
		   $string = str_ireplace($words,"*",$string);
	     }
	   }
	 }
	 return $string;
   }
 }
 //屏蔽字符
 public function shieldip($ip,$shieldip,$iptips=''){
    if($ip!='' && $shieldip!=''){
     $shieldip = ($shieldip!='') ? explode("|",$shieldip) : array();
	 if(count($shieldip)>0){
	  foreach($shieldip as $key=>$val){
	    if($val == $ip){
		  header('Content-Type: text/html;charset=utf-8');
	      echo ($iptips!='') ? ('<h1 style="text-align:center;line-height:380px;color:#666;">'.$iptips.'</h1>') : ('<h1 style="text-align:center;line-height:380px;color:#666;">抱歉，您的IP将禁用一段时间。</h1>');
		  exit();
	    }
	  }
	 }
    }
 }
 //获取资料
 public function gettopic($db,$id,$field='topic') {
   if ($db!='' && $id!='') {
	  if (!$return = S('topic-'.$db.'-'.$field.'-'.$id)){
	    $obj = M($db)->field($field)->where(array('enabled'=>1,'Id'=>$id))->find();
	    if ($obj) {
		  $return = $obj[$field];
		  S('topic-'.$db.'-'.$field.'-'.$id,$return,7200);
		} else {
		  $return = '';
		}
	  }
	  return $return;
   } else {
	  return '';
   }
 }
 //检测
 public function cktype($db,$id) {
   if ($db!='' && $id!='') {
	 return (M($db)->where(array('enabled'=>1,'Id'=>$id))->count()) ? true : false;
   } else {
	 return false;
   }
 }
 //返回ID
 public function ckdomain($db,$domain) {
	if ($db!='' && $domain!='') {
	  $data = M($db)->field('Id')->where(array('domain'=>$domain))->find();
	  return (!$data) ? false : $data['Id'];
	} else {
	  return false;
	}
 }
 //记录浏览器信息
 private function getBrower(){
	if (strpos($_SERVER['HTTP_USER_AGENT'], 'Maxthon')) {  
	    $browser = 'Maxthon'; 
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 12.0')) {  
	    $browser = 'IE12.0';  
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 11.0')) {  
	    $browser = 'IE11.0';  
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 10.0')) {  
	    $browser = 'IE10.0';  
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.0')) {  
	    $browser = 'IE9.0';  
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0')) {  
	    $browser = 'IE8.0';  
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0')) {  
	    $browser = 'IE7.0';  
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0')) {  
	    $browser = 'IE6.0';  
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'NetCaptor')) {  
	    $browser = 'NetCaptor';  
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape')) {  
	    $browser = 'Netscape';  
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Lynx')) {  
	    $browser = 'Lynx';  
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera')) {  
	    $browser = 'Opera';  
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')) {  
	    $browser = 'Google';  
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {  
	    $browser = 'Firefox';  
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari')) {  
	    $browser = 'Safari'; 
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'iphone') || strpos($_SERVER['HTTP_USER_AGENT'], 'ipod')) {  
	    $browser = 'iphone';
	} else if(strpos($_SERVER['HTTP_USER_AGENT'], 'ipad')) {  
	    $browser = 'iphone';
	} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'android')) {  
	    $browser = 'android';
	} else {  
	    $browser = 'other';  
	}
	return addslashes($browser);
 }
 //统计信息
 public function recordBrower(){
	$isonline = 0;
	if (!$isonline = S('systemonline')) {
	  $isonline = M('systemconfig')->field('isonline')->where(array('Id'=>1))->find();
	  if($isonline){
	    S('systemonline',$isonline['isonline'],3600);
		$isonline = $isonline['isonline'];
	  }
	}
 	$online_cutout = cookie('online_cutout');
	$myaction      = cookie('myaction');
	$refer         = cookie('refer');
	if ( $isonline && !$online_cutout ) {
        $action   = (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!='') ? addslashes($_SERVER['HTTP_REFERER']) : '';;
		$actionid = ($action!='') ? md5($action) : '';
		$ip       = get_client_ip(0,true);
		$day      = date('Y-m-d');
		if ($actionid != '') {
			$isonline = M('online')->field('stime,etime')->where(array('actionid'=>$actionid,'ip'=>$ip,'day'=>$day))->find();
			$online   = false;
			if (!$isonline && $action!='') {
			  $online = M('online')->add(array('action' => $action,'actionid'=>$actionid,'refer' => $refer,'ip' => $ip,'agent' => $this->getBrower(),'day' => $day,'stime' => time()));
			  cookie('myaction',$actionid);
			  cookie('refer',$action);
			} else {
			  if($myaction!='') M('online')->where(array('actionid'=>$myaction,'ip'=>$ip,'day'=>$day))->limit(1)->save(array('etime'=>time())); //更新结束时间
			  $etime = ($isonline['etime'] > 0) ? time()+intval($isonline['etime']-$isonline['stime']) : 0;
			  if ($actionid != '') {
				M('online')->where(array('actionid'=>$actionid,'ip'=>$ip,'day'=>$day))->limit(1)->setInc('hit');
				M('online')->where(array('actionid'=>$actionid,'ip'=>$ip,'day'=>$day))->limit(1)->save(array('stime'=>time(),'etime'=>$etime));
			  }
			}
			if ($online) cookie('online_cutout',true,1);
		}
	}
 }
 //获取上一页 下一页
 public function getPage($conf=''){
     $sty    = isset($conf['sty'])    ? intval($conf['sty']) : 0;
     $order  = isset($conf['order'])  ? $conf['order']       : 'istop DESC,date DESC';
	 $id     = isset($conf['id'])     ? intval($conf['id'])  : 0;
	 $tables = isset($conf['tables']) ? $conf['tables']      : 'information';
	 $return = array('topid'=>0,'nextid'=>0);
	 if ($id && $tables!='') {
	   $where   = '1=1 AND enabled=1';
	   if($sty) $where .= ' AND sty='.$sty;
	   if(!$dlist = S('dlist'.$tables.$sty)) {
	     $dlist = M($tables)->field('Id')->where($where)->order($order)->select();
		 S('dlist'.$tables.$sty,$dlist);
	   }
	   if($dlist) {
	     foreach($dlist as $key=>$val) {
		   if($val['Id'] == $id) {
		     $return['topid']  = isset($dlist[$key-1]['Id']) ? $dlist[$key-1]['Id'] : 0;
			 $return['nextid'] = isset($dlist[$key+1]['Id']) ? $dlist[$key+1]['Id']  : 0;
		   }
		 }
	   }
	 }
	 return $return;
 }
 //防止注入
 public function dosqlxss($str){
	$str = str_ireplace("and","",$str);
	$str = str_ireplace("exec","",$str);
	$str = str_ireplace("insert","",$str);
	$str = str_ireplace("select","",$str);
	$str = str_ireplace("delete","",$str);
	$str = str_ireplace("update","",$str);
	$str = str_ireplace("count","",$str);
	$str = str_ireplace("*","",$str);
	$str = str_ireplace("%","",$str);
	$str = str_ireplace("from","",$str);
	$str = str_ireplace("union","",$str);
	$str = str_ireplace("master","",$str);
	$str = str_ireplace("truncate","",$str);
	$str = str_ireplace("char","",$str);
	$str = str_ireplace("declare","",$str);
	$str = str_ireplace("onerror","",$str);
	$str = str_ireplace("CR","",$str);
	$str = str_ireplace("LF","",$str);
	$str = str_ireplace("javascript:","",$str); 
	$str = str_ireplace("jscript:","",$str);
	$str = str_ireplace("vbscript:","",$str);
	$str = str_ireplace("scirpt","",$str);	
	$str = str_ireplace("=","",$str);
	$str = str_ireplace("@","#",$str);
	$str = str_ireplace(";","；",$str);
	return htmlspecialchars($str);
 }

 
}