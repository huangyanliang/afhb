<?php
namespace Admin\Controller;
use Think\Controller;
class SystemController extends AdminCommonController {
  public function index(){
    return false;
  }
  //系统设置
  public function sysmod(){
	$save   = I('post.send','');
	if($save == ''){
		$data   = M("systemconfig")->field('*')->where(array('Id'=>1))->find();
		if($data){
		  $this->assign('title','系统设置');
		  $this->assign('upload',true);
		  $this->assign('data',$data);
		  $this->display();
		}else{
		  $this->error('资料不存在，请重新操作！');
		}
	}else if($save=='确定保存'){
		 $metatitle   = I('post.metatitle','');
		 $icpnote     = I('post.icpnote','');
		 $metades     = I('post.metades','');
		 $metakey     = I('post.metakey','');
		 $sys_notice  = I('post.sys_notice','');
		 $sys_code    = cg('sys_code');
		 $c_site      = I('post.c_site',0,'intval');
		 $c_text      = I('post.c_text','');
		 $isonline    = I('post.isonline',0,'intval');
		 $isqq        = I('post.isqq',0,'intval');
		 $adminpage   = I('post.adminpage',15,'intval');
		 $adminpage   = ($adminpage<1) ? 1 : $adminpage;
		 $result      = M("systemconfig")->where(array('Id'=>1))->save(array('metatitle'=>$metatitle,'icpnote'=>$icpnote,'metades'=>$metades,'metakey'=>$metakey,'sys_notice'=>$sys_notice,'sys_code'=>$sys_code,'c_site'=>$c_site,'c_text'=>$c_text,'isonline'=>$isonline,'isqq'=>$isqq,'adminpage'=>$adminpage,'qq'=>$qq));
		 if($result){
		   $this->success('资料更新成功');
		 }else{
		   $this->error('资料更新失败，请重新试试吧');
		 }
	}
  }
  //系统设置
  public function syscompany(){
	$save   = I('post.send','');
	if($save == ''){
		$data   = M("systemconfig")->field('*')->where(array('Id'=>1))->find();
		if($data){
		  $this->assign('title','公司设置');
		  $this->assign('upload',true);
		  $this->assign('data',$data);
		  $this->display();
		}else{
		  $this->error('资料不存在，请重新操作！');
		}
	}else if($save=='确定保存'){
		 $companyname = I('post.companyname','');
		 $address     = I('post.address','');
		 $weibourl    = I('post.weibourl','');
		 $tel         = I('post.tel','');
		 $fax         = I('post.fax','');
		 $qq          = I('post.qq','');
		 $email       = I('post.email','');
		 $mobile      = I('post.mobile','');
		 $contact     = I('post.contact','');
		 $weixinpic   = I('post.pic','');
		 $adminpage   = ($adminpage<1) ? 1 : $adminpage;
		 $result      = M("systemconfig")->where(array('Id'=>1))->save(array('weixinpic'=>$weixinpic,'companyname'=>$companyname,'address'=>$address,'weibourl'=>$weibourl,'tel'=>$tel,'fax'=>$fax,'mobile'=>$mobile,'contact'=>$contact,'email'=>$email,'qq'=>$qq));
		 if($result){
		   $this->success('资料更新成功');
		 }else{
		   $this->error('资料更新失败，请重新试试吧');
		 }
	}
  }
  //水印设置
  public function syswater(){
	$save   = I('post.send','');
	if($save==''){
		$data   = M("systemconfig")->field('*')->where(array('Id'=>1))->find();
		if($data){
		  $facearr = array('A','B','C','D','E','F','G','H');
		  $this->assign('title','水印设置');
		  $this->assign('facetitle','字体'.$facearr[$data['facetype']]);
		  $this->assign('data',$data);
		  $this->assign('upload',true);
		  $this->assign("color",true);
		  $this->display();
		}else{
		  $this->error('资料不存在，请重新操作！');
		}
	}else if($save=='确定保存'){
		 $pic         = I('post.pic','');
		 $waterpos    = I('post.waterpos',9,'intval');
		 $fonttext    = I('post.fonttext','');
		 $fontsize    = I('post.fontsize',20,'intval'); 
		 $fontcolor   = I('post.fontcolor','');
		 $wateralpha  = I('post.wateralpha',1,'intval');
		 $fontpos     = I('post.fontpos',9,'intval');
		 $iswater     = I('post.iswater',0,'intval'); 
		 $facetype    = I('post.facetype',0,'intval');  
		 $facetype    = ($facetype>7) ? 7 : $facetype;
		 $result      = M("systemconfig")->where(array('Id'=>1))->save(array('waterpos'=>$waterpos,'wateralpha'=>$wateralpha,'fonttext'=>$fonttext,'fontsize'=>$fontsize,'fontcolor'=>$fontcolor,'facetype'=>$facetype,'fontpos'=>$fontpos,'iswater'=>$iswater,'waterpic'=>$pic));
		 if($result){
		   $this->success('数据更新成功');
		 }else{
		   $this->error('数据更新失败，请重新试试吧');
		 }
	} 
  }
  //上传设置
  public function sysupload(){
    $save   = I('post.send','');
	if ($save == '') {
	  $data   = M("systemconfig")->field('picsuffix,filesuffix,picsize,filesize,picmaxwidth,cropwidth,picmaxsize')->where(array('Id'=>1))->find();
	  $this->assign('title','上传设置');
	  $this->assign('data',$data);
	  $this->display();
	} else if ($save == '确定保存') {
	  $picsuffix    = I('post.picsuffix','',null);
	  $filesuffix   = I('post.filesuffix','',null);
	  $picsize      = I('post.picsize',0,'intval');
	  $filesize     = I('post.filesize',0,'intval');
	  $picmaxwidth  = I('post.picmaxwidth',0,'intval');
	  $cropwidth    = I('post.cropwidth',0,'intval');
	  $picmaxsize   = I('post.picmaxsize',0,'intval');
	  $result       = M("systemconfig")->where(array('Id'=>1))->save(array('picsuffix'=>$picsuffix,'filesuffix'=>$filesuffix,'filesize'=>$filesize,'picmaxwidth'=>$picmaxwidth,'cropwidth'=>$cropwidth,'picsize'=>$picsize,'picmaxsize'=>$picmaxsize));
	  if( $result ){
	    $this->success('上传设置更新成功');
	  }else{
	    $this->error('上传设置更新失败，请重新试试吧');
	  }
	}
  }
  //词汇过滤设置
  public function wordfilter(){
	$save   = I('post.send','');
	if($save==''){
		$data   = M("systemconfig")->field('wordfilter')->where(array('Id'=>1))->find();
		if($data){
		  $this->assign('title','词汇过滤设置');
		  $this->assign('data',$data);
		  $this->display();
		}else{
		  $this->error('资料不存在，请重新操作！');
		}
	}else if($save=='确定保存'){
		 $wordfilter  = I('post.wordfilter','');  
		 $result      = M("systemconfig")->where(array('Id'=>1))->save(array('wordfilter'=>$wordfilter));
		 if($result){
		   $this->success('数据更新成功');
		 }else{
		   $this->error('数据更新失败，请重新试试吧');
		 }
	} 
  }
  //短信设置
  public function sysmsg(){
	$save   = I('post.send','');
	if($save==''){
		$data   = M("baseconfig")->field('msguser,msgpass,msgsuff')->where(array('Id'=>1))->find();
		if($data){
		  $this->assign('title','短信设置');
		  $this->assign('data',$data);
		  $this->display();
		}else{
		  $this->error('资料不存在，请重新操作！');
		}
	}else if($save=='确定保存'){
		 $msguser  = I('post.msguser','');  
		 $msgpass  = I('post.msgpass',''); 
		 $msgsuff  = I('post.msgsuff',''); 
		 $result   = M("baseconfig")->where(array('Id'=>1))->save(array('msguser'=>$msguser,'msgpass'=>$msgpass,'msgsuff'=>$msgsuff));
		 if($result){
		   $this->success('数据更新成功');
		 }else{
		   $this->error('数据更新失败，请重新试试吧');
		 }
	}  
  } 
  //邮件服务器
  public function sysmail(){
	$save   = I('post.send','');
	if($save==''){
		$data   = M("systemconfig")->field('mailsmtp,mailport,mailname,mailpass')->where('Id=1')->find();
		if($data){
		  $this->assign('ismail',(function_exists("mail")) ? 1 : 0);
		  $this->assign('title','邮件服务器设置');
		  $this->assign('data',$data);
		  $this->display();
		}else{
		  $this->error('资料不存在，请重新操作！');
		}
	}else if($save=='确定保存'){
		 $mailsmtp    = I('post.mailsmtp','');  
		 $mailport    = I('post.mailport',''); 
		 $mailname    = I('post.mailname','');
		 $mailpass    = I('post.mailpass','');
		 $dobj = M("systemconfig")->where('Id=1')->save(array('mailsmtp'=>$mailsmtp,'mailport'=>$mailport,'mailname'=>$mailname,'mailpass'=>$mailpass));
		 if($dobj){
		   $this->success('数据更新成功');
		 }else{
		   $this->error('数据更新失败，请重新试试吧');
		 }
	} 
  }
  //ip过滤设置
  public function ipfilter(){
	$save   = I('post.send','');
	if($save==''){
		$data   = M("systemconfig")->field('shieldip,iptips')->where(array('Id'=>1))->find();
		if($data){
		  $this->assign('title','IP过滤设置');
		  $this->assign('data',$data);
		  $this->display();
		}else{
		  $this->error('资料不存在，请重新操作！');
		}
	}else if($save=='确定保存'){
		 $shieldip    = I('post.shieldip','');  
		 $iptips      = I('post.iptips',''); 
		 $dobj = M("systemconfig")->where(array('Id'=>1))->save(array('shieldip'=>$shieldip,'iptips'=>$iptips));
		 if($dobj){
		   $this->success('数据更新成功');
		 }else{
		   $this->error('数据更新失败，请重新试试吧');
		 }
	} 
  }
  //用户列表
  public function admindepartment(){
	$this->pageDisplay(array('title'=>'部门管理列表','tables'=>'admindepartment','order'=>'ord ASC'));
  }  
  public function admindepartmentadd(){
	$this->assign('title','添加管理部门');
	$topmenu = M('adminauth')->field('Id,title,isimportant')->where('1=1 AND tid=0')->order('ord ASC')->select();
	if ($topmenu) {
	  foreach($topmenu as $key=>$val) {
	    $topmenu[$key]['mdata'] = M('adminauth')->field('Id,title,isimportant')->where('1=1 AND tid='.$val['Id'])->order('ord ASC')->select();
	  }
	}
	$this->assign('adminauth',$topmenu);
	$this->display();
  }
  public function createdepartment(){
	$topic = I('post.topic','');
	$ord   = I('post.ord','');
	$auth  = isset($_POST['auth']) ? $_POST['auth'] : array();
	$userauth = '';
	if (count($auth) > 0) {
	   foreach ($auth as $key=>$val) {
		 $userauth .= $val.',';
	   }
	}
	$userauth = removelast($userauth);
	if($topic!=''){
	  if(M('admindepartment')->add(array('topic'=>$topic,'auth'=>$userauth,'ord'=>$ord,'date'=>dates()))){
	    $this->success('部门添加成功',U('system/admindepartment'),2);
	  }else{
	    $this->success('部门添加失败，请重试',U('system/admindepartmentadd'),2);
	  }
	}else{
	  $this->error('请先完善部门信息',U('system/admindepartmentadd'),2);
	}
  }
  public function admindepartmentmod(){
    $id = I('request.id',0,'intval');
	$save   = I('post.send','');
    if($id!=0){
	   if($save==""){
		 $data  = M("admindepartment")->field('*')->where(array('Id'=>$id))->find();
		 if( $data ){
			$this->assign('title','部门编辑');
			$topmenu = M('adminauth')->field('Id,title,isimportant')->where('1=1 AND tid=0')->order('ord ASC')->select();
			if ($topmenu) {
			  foreach($topmenu as $key=>$val) {
				$topmenu[$key]['mdata'] = M('adminauth')->field('Id,title,isimportant')->where('1=1 AND tid='.$val['Id'])->order('ord ASC')->select();
			  }
			}
			$this->assign('adminauth',$topmenu);
			$this->assign('data',$data);
			$this->display();
		 }else{
			$this->error('资料不存在，请重新操作！');
		 }
	   }else if($save=='确定修改'){
	     $topic  = I('post.topic','');
		 $ord    = I('post.ord','');
		 $auth   = isset($_POST['auth']) ? $_POST['auth'] : array();
		 $userauth = '';
		 if (count($auth) > 0) {
		   foreach ($auth as $key=>$val) {
		     $userauth .= $val.',';
		   }
		 }
		 $userauth = removelast($userauth);
		 $result = M("admindepartment")->where(array('Id'=>$id))->save(array('ord'=>$ord,'topic'=>$topic,'auth'=>$userauth,'date'=>dates()));
		 if($result){
		   $this->success('数据更新成功');
		 }else{
		   $this->error('数据更新失败，请重新试试吧');
		 } 
	   }
	}else{
	 $this->error('ID未指定,无法获取任何数据');
	}
  }
  //用户列表
  public function userlist(){
	$this->pageDisplay(array('title'=>'管理员列表','tables'=>'adminuser','order'=>'last_time DESC'));
  }
  //用户编辑
  public function usermod(){
    $id = I('request.id',0,'intval');
	$save   = I('post.send','');
    if($id!=0){
	   if($save==""){
		 $data  = M("adminuser")->field('*')->where(array('Id'=>$id))->find();
		 if( $data ){
			$this->assign('title','用户编辑');
			$this->assign('admindep',$this->getSelect('admindepartment'));
			$this->assign('data',$data);
			$this->display();
		 }else{
			$this->error('资料不存在，请重新操作！');
		 }
	   }else if($save=='确定修改'){
	     $pass   = I('post.pass','');
		 $name   = I('post.name','');
		 $depid  = I('post.depid',0,'intval');
		 $result = M("adminuser")->where(array('Id'=>$id))->save(array('realname'=>$name,'depid'=>$depid,'last_time'=>dates()));
		 if($result){
		   if ($pass!='') D('AdminUser')->modpass($pass,$id);
		   $this->success('数据更新成功');
		 }else{
		   $this->error('数据更新失败，请重新试试吧');
		 } 
	   }
	}else{
	 $this->error('ID未指定,无法获取任何数据');
	}
  }
  //用户添加
  public function useradd(){
	$this->assign('title','添加管理员');
	$this->assign('admindep',$this->getSelect('admindepartment'));
	$this->display();
  }
  //创建用户
  public function createuser(){
	$user  = I('post.user','');
	$pass  = I('post.pass','');
	$name  = I('post.name','');
	$depid = I('post.depid',0,'intval');
	if($user!='' && $pass!='' && $name!=''){
	  if(D("AdminUser")->adduser($user,$pass,$name,$depid)){
	    $this->success('管理员添加成功',U('system/userlist'),2);
	  }else{
	    $this->success('管理员添加失败，请重试',U('system/useradd'),2);
	  }
	}else{
	  $this->error('请先完善管理员信息',U('system/useradd'),2);
	}
  }
  //权限控制
  public function adminauth(){
    $this->pageDisplay(array('title'=>'权限控制','tables'=>'adminauth','where'=>'1=1 AND tid=0','order'=>'isimportant DESC,ord ASC,Id DESC'));
  }
  //添加权限
  public function adminauthadd(){
	$send  = I('post.send','');
	if($send == ""){
	  $this->assign('topmenu',M('adminauth')->field('Id,title AS topic')->where('tid=0')->select());
	  $this->assign('title','添加控制权限');
	  $this->display();
	}else if($send == "添加栏目"){
	  $title = I('post.title','');
	  $icon  = I('post.icon','');
	  $linkurl = isset($_POST['linkurl']) ? trim($_POST['linkurl']) : '';
	  $pid   = I('post.pid',0,'intval');
	  $mpid = I('post.mpid',0,'intval');
	  $ord  = I('post.ord',0,'intval');
	  $isopen = I('post.isopen',0,'intval');
	  $isext = I('post.isext',0,'intval');
	  $isspecial = I('post.isspecial',0,'intval');
	  $isimportant = I('post.isimportant',0,'intval');
	  if ($mpid == 2) {
	    $pid = I('post.lid',0,'intval');
	  }
	  $name = $martables = $tables = '';
	  $sty  = 1;
	  if($linkurl !='' ) {
	    $mlink = explode(",",$linkurl);
		$name   = (isset($mlink[0]) && $mlink[0]!='') ? $mlink[0] : '';
		$fields = (isset($mlink[1]) && $mlink[1]!='') ? $mlink[1] : '';
		if ($fields!='') {
		  $fields = explode("&",$fields);
		  if( count($fields) > 0) {
		    foreach($fields as $mval) {
			   if ($mval!='') {
			     $vArr = explode("=",$mval);
				 if ($vArr[0] == 'martables'){
					$martables = (isset($vArr[1]) && $vArr[1]!='') ? trim($vArr[1]) : '';
				 }
				 if ($vArr[0] == 'tables'){
					$tables = (isset($vArr[1]) && $vArr[1]!='') ? trim($vArr[1]) : '';
				 }
				 if ($vArr[0] == 'sty'){
					$sty = (isset($vArr[1]) && $vArr[1]!='') ? intval($vArr[1]) : 1;
				 }
			   }
			}
		  }
		}
	  }
	  $result = M("adminauth")->add(array('title'=>$title,'name'=>$name,'icon'=>$icon,'isext'=>$isext,'sty'=>$sty,'isopen'=>$isopen,'isspecial'=>$isspecial,'martables'=>$martables,'tables'=>$tables,'linkurl'=>$linkurl,'ord'=>$ord,'isimportant'=>$isimportant,'tid'=>$pid,'date'=>dates()));
	  if($result){
	     $this->success('权限添加成功');
	  }else{
	     $this->error('权限添加失败，请重新试试吧');
	  } 
	}
  }
  //编辑权限
  public function adminauthmod(){
    $id = I('request.id',0,'intval');
	$save   = I('post.send','');
    if($id!=0){
	   if($save == ""){
		 $data  = M("adminauth")->field('*')->where(array('Id'=>$id))->find();
		 if($data){
			$mpid = 1;
			$lid = 0;
			$mtopic = '';
			$topmenu = M('adminauth')->field('Id,title AS topic')->where('tid=0')->select();
			$this->assign('topmenu',$topmenu);
			if ($data['tid'] == 0) {
			  $mpid = 1;
			} else {
			  $mtopic = $this->gettopic('adminauth',$data['tid'],'title');
			  if ($topmenu){
			    foreach ($topmenu as $t=>$v) {
				  if ($v['Id'] == $data['tid']) $mpid = 2;
				}
			  } 
			  $lid = $data['tid'];
			  if ($mpid!=2) $mpid = 3;
			  if ($mpid == 3) {
				 $mlist = '';
				 $tid = $this->gettopic('adminauth',$data['tid'],'tid');
				 $mtopic = $this->gettopic('adminauth',$tid,'title');
				 $lid   = $tid;
				 $mdata = M('adminauth')->field('title,Id')->where('1=1 AND isspecial=0 AND tid='.$tid)->order('ord ASC')->select();
				 if ($data) {
				   foreach ($mdata as $key=>$val) {
					 $scene = ($val['Id'] == $data['tid']) ? 'success' : 'default';
					 $mlist .= '<a href="javascrupt:void(0)" class="btn-menu" data-id="'.$val['Id'].'">'.btn(array('vals'=>$val['title'],'size'=>3,'scene'=>$scene)).'</a>&nbsp;';
				   }
				 }
				 $this->assign('mlist',$mlist);
			  }
			}
			$this->assign('mtopic',$mtopic);
			$this->assign('lid',$lid);
			$this->assign('mpid',$mpid);
		    $this->assign('title','编辑权限信息');
			$this->assign('data',$data);
			$this->display();
		 }else{
			$this->error('资料不存在，请重新操作！');
		 }
	   }else if($save == '保存栏目'){
		  $title   = I('post.title','');
		  $icon    = I('post.icon','');
		  $linkurl = isset($_POST['linkurl']) ? trim($_POST['linkurl']) : '';
		  $pid     = I('post.pid',0,'intval');
		  $mpid    = I('post.mpid',0,'intval');
		  $ord     = I('post.ord',0,'intval');
		  $isopen  = I('post.isopen',0,'intval');
		  $isext   = I('post.isext',0,'intval');
		  $isspecial = I('post.isspecial',0,'intval');
		  $isimportant = I('post.isimportant',0,'intval');
		  if ($mpid == 2) {
			$pid = I('post.lid',0,'intval');
		  }
		  $name = $martables = $tables = '';
		  $sty  = 1;
		  if($linkurl !='' ) {
			$mlink = explode(",",$linkurl);
			$name   = (isset($mlink[0]) && $mlink[0]!='') ? $mlink[0] : '';
			$fields = (isset($mlink[1]) && $mlink[1]!='') ? $mlink[1] : '';
			if ($fields!='') {
			  $fields = explode("&",$fields);
			  if( count($fields) > 0) {
				foreach($fields as $mval) {
				   if ($mval!='') {
					 $vArr = explode("=",$mval);
					 if ($vArr[0] == 'martables'){
						$martables = (isset($vArr[1]) && $vArr[1]!='') ? trim($vArr[1]) : '';
					 }
					 if ($vArr[0] == 'tables'){
						$tables = (isset($vArr[1]) && $vArr[1]!='') ? trim($vArr[1]) : '';
					 }
					 if ($vArr[0] == 'sty'){
						$sty = (isset($vArr[1]) && $vArr[1]!='') ? intval($vArr[1]) : 0;
					 }
				   }
				}
			  }
			}
		  }
		  $result = M("adminauth")->where('Id='.$id)->save(array('title'=>$title,'name'=>$name,'sty'=>$sty,'icon'=>$icon,'isext'=>$isext,'isopen'=>$isopen,'isspecial'=>$isspecial,'martables'=>$martables,'tables'=>$tables,'linkurl'=>$linkurl,'ord'=>$ord,'isimportant'=>$isimportant,'tid'=>$pid,'date'=>dates()));  
		  if($result){
		    $this->success('数据更新成功');
		  }else{
		    $this->error('数据更新失败，请重新试试吧');
		  } 
	   }
	}else{
	 $this->error('ID未指定,无法获取任何数据');
	}
  }
  //登录日志
  public function history(){
	$this->pageDisplay(array('title'=>'系统登录日志','tables'=>'adminrecord','order'=>'date DESC'));
  }
  //广告列表
  public function advlist(){
	$ctag  = I('get.ctag',0,'intval');
	$enabled = I('get.enabled', 0,'intval');
	$topic = I('get.topic','');
	$where = '1=1';
	if ( $ctag ) $where .= ' AND ctag='.$ctag;
	if ( $topic!='' ) $where .= " AND topic like'%$topic%'";
	if ( $enabled == 1 ) $where .= ' AND enabled=0';
	if ( $enabled == 2 ) $where .= ' AND enabled=1';
	$this->assign('advtype',$this->getSelect('advtype'));
	$this->pageDisplay(array('title'=>'广告管理','tables'=>'advdata','where'=>$where,'order'=>'ctag ASC,ord ASC'));
  }
  //广告添加
  public function advadd(){
	$send  = I('post.send','');
	if($send == ""){
	  $this->assign('advtype',$this->getSelect('advtype'));
	  $this->assign('upload',true);
	  $this->assign('title','广告添加');
	  $this->display();
	}else if($send == "提交"){
	  $result    = M("advdata")->add($this->fieldArr(array('linkurl','pic','ctag','remark','picwidth','picheight')));
	  if($result){
	     $this->success('广告添加成功');
	  }else{
	     $this->error('广告添加失败，请重新试试吧');
	  } 
	}
  }
  //广告修改
  public function advmod(){
    $id = I('request.id',0,'intval');
	$save   = I('post.send','');
    if($id!=0){
	   if($save == ""){
		 $data  = M("advdata")->field('*')->where(array('Id'=>$id))->find();
		 if($data){
			$this->assign('advtype',$this->getSelect('advtype')); 
		    $this->assign('title','编辑广告信息');
			$this->assign('upload',true);
			$this->assign('data',$data);
			$this->display();
		 }else{
			$this->error('资料不存在，请重新操作！');
		 }
	   }else if($save == '确定修改'){
		  $result    = M("advdata")->where(array('Id'=>$id))->save($this->fieldArr(array('linkurl','ctag','pic','remark','picwidth','picheight')));
		  if($result){
		    $this->success('数据更新成功');
		  }else{
		    $this->error('数据更新失败，请重新试试吧');
		  } 
	   }
	}else{
	 $this->error('ID未指定,无法获取任何数据');
	}
  }
  //数据库管理
  public function databackup(){
	$send = I('post.send','');
	if($send==''){
		$this->assign('title','数据库备份');
		if(!$tabarr = S('tabarr')){
			$dataArr = array(); 
			$tabobj  = D('Baksql');
			$data    = $tabobj->getTables();
			if(count($data)>0){
			  for($i=0;$i<count($data);$i++){
				$dataArr[$i]['table'] = $data[$i];
				$dobj                 = M(str_replace(C('DB_PREFIX'),'',$data[$i]));
				$dataArr[$i]['count'] = $dobj->count(); 
			  }
			}
			$tabarr = $dataArr;
			S('tabarr',$dataArr,3600); //缓存字段信息
		}
		$this->assign('data',$tabarr);
		$this->display();
	}else if($send=="优化"){
	  $table = isset($_POST['datebasename']) ? $_POST['datebasename'] : array();
	  if(count($table)>0){
	    foreach($table as $val){
		  $val = ($val!='') ? str_replace(C('DB_PREFIX'),'',$val) : '';
	      M()->query("OPTIMIZE TABLE `$val`");
		}
		$this->success('数据表优化成功！','',1);
	  }else{
	    $this->error('请至少选择一条数据进行操作',U('system/databackup'),2);
	  }
	}else if($send=="修复"){
	  $table = isset($_POST['datebasename']) ? $_POST['datebasename'] : array();
	  if(count($table)>0){
	    foreach($table as $val){
		  $val = ($val!='') ? str_replace(C('DB_PREFIX'),'',$val) : '';
	      M()->query("REPAIR TABLE `$val`");
		}
		$this->success('数据表修复成功！','',1);
	  }else{
	    $this->error('请至少选择一条数据进行操作',U('system/databackup'),2);
	  } 
	}else if($send=="备份"){
	  $table  = isset($_POST['datebasename']) ? $_POST['datebasename'] : array();
	  if(count($table)>0){
		$result = D('Baksql')->backtables($table); //备份全部
		if($result){
	      $this->success('数据库备份成功',U('system/databackup'),2);
		}else{
		  $this->error('数据库备份失败，请重试',U('system/databackup'),2);
		}
	  } else {
	    $this->error('请至少选择一个数据表备份',U('system/databackup'),2);
	  }
	}
  }
  
  public function sysAdmin(){
    $save   = I('post.send','');
	$protectedPath = array('About','App','Article','BaiHeng','Case','Contact','Index','Knowledge','News','Promotion','Qrcode','Remittances','Service','Website','Admin');
	if ($save == '') {
	  $data   = M("systemconfig")->field('adminpath')->where(array('Id'=>1))->find();
	  $domain = 'http://'.$_SERVER['HTTP_HOST'].'/';
	  $this->assign('domain',$domain);
	  $this->assign('title','上传设置');
	  $this->assign('protectedPath',$protectedPath);
	  $this->assign('data',$data);
	  $this->display();
	} else if ($save == '确定保存') {
	  $adminpath    = I('post.adminpath','');
	  $oldadminpath = I('post.oldadminpath','');
	  if ($adminpath=='') $this->error('请填写后台目录保护，必须是英文'); 
	  if ($adminpath == $oldadminpath) $this->error('设置后台目录保护不得和上一次设置目录一致'); 
	  if (in_array($adminpath,$protectedPath)) {
	    $this->error($adminpath.'是系统目录，请重新设置'); 
	  }
	  $result     = M("systemconfig")->where(array('Id'=>1))->save(array('adminpath'=>$adminpath));
	  if( $result ){
		$this->CreateAdmin($adminpath,$oldadminpath);
	    $this->success('后台目录设置更新成功');
	  }else{
	    $this->error('后台目录设置更新失败，请重新试试吧');
	  }
	}
  }
  public function clearAdmin(){
    $data   = M("systemconfig")->field('adminpath')->where(array('Id'=>1))->find();
	if ($data['adminpath']!='') {
	  M("systemconfig")->where(array('Id'=>1))->save(array('adminpath'=>''));
	  unlink(APP_PATH.'Home/Controller/'.ucwords($data['adminpath']).'Controller.class.php');
	}
	$this->success('后台目录设置还原成功');
  }
  
  //备份列表非数据库版
  public function databackuplist(){
    $data  = $this->getarrays(C('DB_BACKUP'));
	$sdata = array();
	if(count($data)>0){
		for($i=0;$i<count($data);$i++){
		  $sdata[$i]['size'] = (file_exists($data[$i])) ? $this->size(filesize($data[$i])) : 0;
		  $sdata[$i]['time'] = date("Y-m-d H:i:s",filectime($data[$i]));
		  $sdata[$i]['path'] = str_replace(C("DB_BACKUP").'/','',$data[$i]);
		}
	}
	krsort($sdata);
	$datauparr = array('isdel'=>1,'isre'=>0);
	$this->assign('title','数据库备份管理');
	$this->assign('data',$sdata);
	$this->assign('datasys',$datauparr);
	$this->display();
  }
  //size
  private function size($_size){
	  $_rand = ceil(($_size/1024));	
	  if($_rand<1)     return $_size."bit";	
	  if($_rand>1 && $_rand<1024) return $_rand."KB";
	  if($_rand>1024)  return ceil(($_rand/1024))."MB";
	  if($_rand==1)    return $_rand."KB";
	  if($_rand==1024) return $_rand."MB";
  }
  //删除备份
  public function deldataup(){
    $delpath = I('get.delpath','',false);
	if($delpath!=''){
	  @unlink(C('DB_BACKUP').$delpath);
	  $this->error('数据删除成功',U('system/databackuplist'),2); 
	}else{
	  $this->error('数据删除失败，数据不存在，请检查',U('system/databackuplist'),2);
	}
  }
  //下载备份
  public function downdataup(){
	$downpath = I('get.downpath','',false);
	if($downpath != ''){
	  D('Baksql')->downloadBak(C('DB_BACKUP').$downpath);
	}else{
	  $this->error('数据下载失败，数据不存在，请检查',U('system/databackuplist'),2);
	}
  }
  //还原备份 //慎用
  public function redataup(){
	$repath = I('get.repath','',false);
	if($repath != ''){
	  $result = D('Baksql')->recover($repath.'.sql');
	  if($result){
	    $this->success('备份还原成功',U('index/main'),2);
	  }else{
	    $this->error('备份还原失败，请重试',U('index/main'),2);
	  }
	}else{
	  $this->error('数据还原失败，数据不存在，请检查',U('system/databackuplist'),2);
	}
  }
  //日志管理
  public function syslogs(){
	$upTotal = $this->getDirectorySize('./logs/');
	$upTotal['size'] = $this->size($upTotal['size']);
    $act  = I('get.act',1,'intval');
	$path = isset($_GET['path']) ? $_GET['path'] : '';
	$path = './logs/'.$path;
	$act  = ($act<1 || $act>2) ? 1 : $act;
	$page = I('get.page',1,'intval');
    if( $act == 1 ) $scene = array('primary','default');
    if( $act == 2 ) $scene = array('default','primary');
	$data  = $this->getarrays($path);
	$count = count($data);
	$pageS = ($act==2) ? C('ADMINPAGE')*2 : C('ADMINPAGE');
	$sdata = array();
	if($act == 1){
		$pobj  = new \Think\AdminPage($count,$pageS);
		$start = explode(",",$pobj->limit);
		$start = isset($start[0]) ? $start[0] : 0;
		$pagesize    = ($count>=$pageS*$page) ? $pageS*$page : $count;
		for($i=$start;$i<$pagesize;$i++){
		  $sdata[$i]['size']  = (file_exists($data[$i])) ? $this->size(filesize($data[$i])) : 0;
		  $sdata[$i]['time']  = date("Y-m-d H:i:s",filectime($data[$i]));
		  $sdata[$i]['file']  = ($path == './logs/' ) ? str_replace('./logs//',"",$data[$i]) : str_replace('./logs/',"",$data[$i]);
		}
	}
	//文件夹模式
	$objfile = array();
	if( $act == 2 ){
	 $handle = opendir($path);
	 $dwsArr = array ('.','..');
	 $j = 0;
	 while (($file = readdir($handle))!==false) {
		if (!in_array($file,$dwsArr)) {	
		  $objfile[$j]['file']  = $file;
		  $objfile[$j]['count'] = $this->filecount($path.$file.'/');
		  $j++;	
		}
	 }
	 closedir($handle);
	}
	//ending
	krsort($sdata);
	$datashow['pageshow']  = ($count>$pageS && $act!=2) ? $pobj->showpage() : '';
	$this->assign('dshow',$datashow);
	$this->assign("file",$objfile);
	$this->assign('data',$sdata);
	$this->assign("act",$act);
	$this->assign('upTotal',$upTotal);
	$this->assign('scene',$scene);
	$this->display();
  }
  //下载
  public function showLog(){
    if (IS_AJAX) {
      $path = isset($_POST['path']) ? $_POST['path'] : '';
	  if ($path !='' ) {
        if (file_exists('./logs/'.$path)) {
		  //读取
		  $fobj = fopen('./logs/'.$path,'r');
		  $content = '';
		  if ( $fobj ) {
			while (!feof($fobj)) {
			  $str = htmlspecialchars(fgets($fobj, 4096));
			  $str = preg_replace('/\s/','',$str);
			  $str = str_replace("time",'时间',$str);
			  $str = str_replace('content','内容',$str);
			  $str = str_replace('array(','',$str);
			  $str = str_replace('),','',$str);
			  $str = str_replace(")",'',$str);
			  $str = str_replace('&lt;?php','',$str);
			  $str = str_replace(';','',$str);
			  $str = str_replace('return','',$str);
			  $str = str_replace('=','-',$str);
			  $str = str_replace(',','<br/><br/>',$str);
			  $content .= $str;
			}
			
			fclose($fobj);
			return $this->ajaxReturn($content);
		  } else {
	        return $this->ajaxReturn('日志打开失败');
		  }
		} else {
		  return $this->ajaxReturn('文件不存在');
		}
		$this->ajaxReturn($path);
	  } else {
	    return $this->ajaxReturn(0);
	  }
	} else {
	  $this->error('非法操作');
	}
  }
  //获取文件
  private function getDirectorySize($path){
    $totalsize  = 0;
    $totalcount = 0;
    $dircount   = 0;
    if ($handle = opendir ($path)){
	  while (false !== ($file = readdir($handle))){
	    $nextpath = $path . '/' . $file;
	    if ($file != '.' && $file != '..' && !is_link ($nextpath)){
		if (is_dir ($nextpath)){
		    $dircount++;
		    $result      = $this->getDirectorySize($nextpath);
		    $totalsize  += $result['size'];
		    $totalcount += $result['count'];
		    $dircount   += $result['dircount'];
		  }elseif (is_file ($nextpath)){
		    $totalsize += filesize ($nextpath);
		    $totalcount++;
		  }
	    }
	  }
    }
    closedir ($handle);
    $total['size']     =  $totalsize;
    $total['count']    =  $totalcount;
    $total['dircount'] = $dircount;
	$total['file']     = $path;
    return $total;
  }
  //图片管理器
  public function syspic(){
	$upTotal = $this->getDirectorySize('./uploads/');
	$upTotal['size'] = $this->size($upTotal['size']);
    $act  = I('get.act',1,'intval');
	$path = isset($_GET['path']) ? $_GET['path'] : '';
	$path = C("UPLOAD_PATH").'images/'.$path;
	$act  = ($act<1 || $act>4) ? 1 : $act;
	$page = I('get.page',1,'intval');
    if($act==1) $scene = array('primary','default','default');
    if($act==2) $scene = array('default','primary','default');
    if($act==3 || $act==4) $scene = array('default','default','primary');
	$data  = $this->getarrays($path);
	$count = count($data);
	$pageS = ($act==2 || $act==4) ? C('ADMINPAGE')*2 : C('ADMINPAGE');
	$sdata = array();
	if($act!=3){
		$pobj  = new \Think\AdminPage($count,$pageS);
		$start = explode(",",$pobj->limit);
		$start = isset($start[0]) ? $start[0] : 0;
		$pagesize    = ($count>=$pageS*$page) ? $pageS*$page : $count;
		$normalpic   = ($act!=3) ? $this->normalpic(array(1=>array('tables'=>'systemconfig','field'=>'waterpic,weixinpic')),array('default','userface','qrcode')) : array();
		for($i=$start;$i<$pagesize;$i++){
		  $sdata[$i]['size'] = (file_exists($data[$i])) ? $this->size(filesize($data[$i])) : 0;
		  $sdata[$i]['time'] = date("Y-m-d H:i:s",filectime($data[$i]));
		  $sdata[$i]['spic'] = str_replace($path.'/',"",$data[$i]);
		  $sdata[$i]['pic']  = $data[$i]; 
		  if($act != 4){
			$sdata[$i]['isou'] = (in_array(str_replace(C("UPLOAD_PATH").'images//',"",$data[$i]),$normalpic)) ? 1 : 0;
		  }else{
			$sdata[$i]['isou'] = (in_array(str_replace(C("UPLOAD_PATH").'images/',"",$data[$i]),$normalpic)) ? 1 : 0;
		  }
		}
	}
	//文件夹模式
	$objfile = array();
	if($act==3){
	 $handle = opendir($path);
	 $dwsArr = array ('.','..');
	 $j = 0;
	 while (($file = readdir($handle))!==false) {
		if (!in_array($file,$dwsArr)) {	
		  $objfile[$j]['file']  = $file;
		  $objfile[$j]['count'] = $this->filecount($path.$file.'/');
		  $j++;	
		}
	 }
	 closedir($handle);
	}
	//ending
	krsort($sdata);
	$datashow['pageshow']  = ($count>$pageS && $act!=3) ? $pobj->showpage() : '';
	$this->assign('dshow',$datashow);
	$this->assign("file",$objfile);
	$this->assign('data',$sdata);
	$this->assign("act",$act);
	$this->assign('upTotal',$upTotal);
	$this->assign('scene',$scene);
	$this->display();
  }
  //删除图片-文件 数据
  public function sysdelpic(){
    $send = I('post.deldata');
	if($send == "删除" || $send == "选中删除"){
	  $delpic = I('post.pubbox',array(),false);
	  $succ   = 0;
	  if(count($delpic)>0){
	    for($i=0;$i<count($delpic);$i++){
		  if (file_exists($delpic[$i])){
		    $succ = @unlink($delpic[$i]) ? $succ+1 : $succ+0;
		  }
		}
		S("fileArr",null);
		S("normalPic",null);
		$this->success('图片操作成功，共计删除图片 '.$succ.' 张');
	  }else{
	    $this->error('请至少选择一条数据操作');
	  }
	}
  }
  //删除日志
  public function sysdellogs(){
    $send = I('post.deldata');
	if($send == "删除"){
	  $delpic = I('post.pubbox',array(),false);
	  $succ   = 0;
	  if(count($delpic)>0){
	    for($i=0;$i<count($delpic);$i++){
		  if (file_exists('./logs/'.$delpic[$i])){
		    $succ = @unlink('./logs/'.$delpic[$i]) ? $succ+1 : $succ+0;
		  }
		}
		S("fileArr",null);
		S("normalPic",null);
		$this->success('日志删除成功，共计删除日志 '.$succ.' 篇');
	  }else{
	    $this->error('请至少选择一条数据操作');
	  }
	}
  }
  //获取文件夹下文件数量
  private function filecount($path){
    $handle = opendir($path);
	$f = 0;
	$dwsArr  = array ('.','..');
	while (($file = readdir($handle)) !== false) {
	  if (!in_array($file,$dwsArr)) $f++;
	  
	}
	closedir($handle);
	($f==0) ? @rmdir($path) : '';
	return $f;
  }
  //读取图片
  private static $filepath = array();	
  private function getfile($path){
	global $filepath;
	foreach(scandir($path) as $afile){
	  if($afile == '.' || $afile == '..') continue; 
	   if(is_dir($path.'/'.$afile)) { 
		  $this->getfile($path.'/'.$afile);
	   } else { 
		  $filepath[]=$path.'/'.$afile;
	   } 
	 } 
  }
  private function getarrays($path){
	global $filepath;
	$this->getfile($path);
	return  $filepath;
  }
  //获取有效的图片信息
  private function normalpic($addField=array(),$clernArr=array()){
	 //设置缓存信息
	 if (S('normalPic')) return S('normalPic');
	 $tables  = D('Baksql')->getTables();
	 $normal  = array();
	 if(count($tables)>0){
	   foreach($tables as $val){
		 if($this->ckfields($val)){
		   $obj   = M(str_replace(C('DB_PREFIX'),'',$val));
		   $odata = $obj->field('pic')->select();
		   if($odata){
		    foreach($odata as $okey=>$oval){
			   if($oval['pic']!=''){
			     $normal[] = $oval['pic'];
			   }
		    }
		   }
		 }
	   }
	 }
	 if ( count($addField) > 0 ) {
	   foreach ($addField as $key=>$val) {
	     $obj = M($val['tables'])->field($val['field'])->select();
		 if ( $obj ){
		   foreach($obj as $mkey=>$mval) {
		     $fieldArr = explode(',',$val['field']);
			 if (isset($val['spc']) && $val['spc']) {
			   for($i=0;$i<count($fieldArr);$i++) {
			     $picArr = ($mval[$fieldArr[$i]]!='') ? unserialize($mval[$fieldArr[$i]]) : array();
			     if ( count($picArr) > 0 ) {
			       for($j=0;$j<count($picArr);$j++) {
				     $normal[] = $picArr[$j];
				   }
				 }
			   }
			 } else {
			   for($i=0;$i<count($fieldArr);$i++) {
			     $normal[] = $mval[$fieldArr[$i]];
			   }
			 }
		   }
		 }
	   }
	 }
	 //文件夹下为非冗余
	 if (count($clernArr)) {
	   for ( $c=0; $c<count($clernArr); $c++ ) {
	     $folderArr = $this->getarrays(C("UPLOAD_PATH").'images/'.$clernArr[$c]);
		 if (count($folderArr) > 0) {
		   for ($j=0;$j<count($folderArr);$j++) {
		     $normal[] = str_replace(C("UPLOAD_PATH").'images/',"",$folderArr[$j]);
		   }
		 }
	   }
	 }
	 S('normalPic',$normal,3600*24);
	 return $normal;
  }
  //检测是否包含字段
  private function ckfields($table,$field='pic'){
     if($table!=''){
	   $fdata    = M()->query("SHOW COLUMNS FROM `$table`");
	   $fieldarr = array();
	   foreach($fdata as $key=>$val){
	     $fieldarr[] = $val['Field'];
	   }
	   return (in_array($field,$fieldarr)) ? true : false;
	 }else{
	   return false;
	 }
  }
    
}