<?php
namespace admin\Controller;
use Think\Controller;
class AdminCommonController extends Controller {
  
  public function _initialize(){
    if ( session('lockuser') && session('lockuser')!='' ) {
	   $this->redirect('Index/lockscreen');
    }
	$loginstatue = D('AdminUser')->AdminLogin();
	if(!$loginstatue['status']){
	  $this->error($loginstatue['msg'],U("index/login"),3);	
	}else{
	  $sessionAuth    = session('adminauth');
	  if(!$admin_conf = S('admin_conf')){
	    $admin_conf   = M("systemconfig")->field('adminpage')->where(array('Id'=>1))->find();
		S('admin_conf',$admin_conf,60*60*24);
	  }
	  C('ADMINPAGE',$admin_conf['adminpage']);
	  $adminauth  = session('adminauth');
	  $userAuth   = M('admindepartment')->field('auth')->where(array('Id'=>$adminauth['admindepid']))->find();
	  $userAuth   = ($userAuth) ? $userAuth['auth'] : '';
	  $actionName = CONTROLLER_NAME.'/'.ACTION_NAME;
	  $sty        = I('request.sty',1,'intval');
	  $tables     = I('request.tables','');
	  $martables  = I('request.martables','');
	  $this->isAuth($actionName,$sty,$tables,$martables,$userAuth);
	  //验证表单令牌
	  if (C("TOKEN_ON") && isset($_POST[C("TOKEN_NAME")]) && $_POST[C("TOKEN_NAME")]!='' ) {
	    if ( !M()->autoCheckToken($_POST) ) {
		  $this->error('TOKEN验证失败，请重新操作');
		}
	  }
	  //end
	  $this->assign('color',0);
	  $this->assign('upload',0);
	  $this->assign('date',0);
	  $this->assign('editor',0);
	  $this->assign('ismod',0);
	  $this->assign('formpic',0);
	  $this->assign('userAuth',$userAuth);
	  //$this->assign('title','澳菲环保后台管理系统');
	}
  }
  //权限组
  private function isAuth($actionName,$sty=1,$tables='',$martables='',$userAuth='') {
    //获取权限组 
	if (!$adminAuth = S('adminAuth')) {
	  $adminAuth = M('adminauth')->field('name')->order('tid ASC,ord ASC')->select();
	  ($adminAuth) ? S('adminAuth',$adminAuth,3600*24) : '';
	}
	if (count($adminAuth) > 0) {
	  $auth = array();
	  foreach ($adminAuth as $key=>$val) {
	    if ($val['name']!='') {
		   $auth[] = ucfirst($val['name']);
		}
	  }
	  if (in_array($actionName,$auth)) {
	    //反编译找出权限ID
		$map['name'] = $actionName;
		$map['sty']  = $sty;
		$map['tables'] = ($tables=='') ? '' : $tables;
		$map['martables'] = ($martables=='') ? '' : $martables;
		$authId = M('adminauth')->field('Id,title')->where($map)->order('ord ASC')->find();
		if ($authId) {
		  $id = $authId['Id'];
		  if ($id) {
			if ($userAuth == '') $this->error('抱歉，您没有权限浏览 '.$authId['title'].' 栏目',U('index/main'),2);
			$userAuth = explode(",",$userAuth);
			if (!in_array($id,$userAuth)) $this->error('抱歉，您没有权限浏览 '.$authId['title'].' 栏目',U('index/main'),2);
			return true;
		  } else {
		    return true;
		  }
		} else {
		  return true;
		}
	  } else {
	    return true;
	  }
	} else {
	  return true;
	}
  }
  /*
	@ 根据ID删除数据
	@ 自动检测表内是否有pic字段,有的话检测是否有图片，有的话删除图片数据
  */
  protected function delbyid($tables,$id){
    if($tables!='' && $id!=''){
	  $obj = M($tables);
	  $data = $obj->where('Id='.$id)->find();
	  if($data){
	    $pic = $obj->where('Id='.$id)->getField('pic');//检测是否有图片
		if($pic){
		   if(file_exists(C("UPLOAD_PATH").'images/'.$pic)){
		     @unlink(C("UPLOAD_PATH").'images/'.$pic); //额外删除图片
		   }
		}
		return $obj->delete($id); //删除数据
	  }else{
	    return false;
	  }
	}
  }
  //返回topic
  protected function gettopic($tables,$id,$field='topic'){
    if ($tables!='' && $id!=0) {
	  $dobj = M($tables)->field($field)->where(array('Id='.$id))->find();
	  return ($dobj) ? $dobj[$field] : '--';
	} else {
	  return '--';
	}
  }
  //是否删除老的图片
  protected function deloldpic($pic,$oldpic) {
    if ($pic!='' && $oldpic!='') {
	  return ($pic != $oldpic) ? @unlink(C("UPLOAD_PATH").'images/'.$oldpic) : false; 
	}
  }
  //下拉属性
  protected function getSelect($tables,$sty=0) {
    if ($tables!='') {
	  $where = ($sty) ? array('sty'=>$sty) : '1=1';
	  return M($tables)->field('Id,topic')->where($where)->order('ord ASC')->select();
	} else {
	  return false;
	}
  }
  //组合字段 $model 1表示新增2表示修改 action 1表示post 2表示get common 表示导入常用的数据 $add 表示组合数据
  protected function fieldArr( $field = array(),$add = array(),$common = true,$model = 1, $action = 1) {
    if (count($field) > 0) {
      $data     = array();
	  $intArr   = array('ord','enabled','picwidth','picheight','istop','sty','inftype','ctag','mtag','stag','isstrong','Id','ishot','hit','showtype','isimportant'); //表示INT 类型的数据
	  $floatArr = array('price'); //表示浮点 类型的数据
	  $textArr  = array('content');
	  $ival     = ($action == 1) ? I('post.') : I('get.'); 
	  foreach ($field as $key => $val) {
		if ( in_array($val,$intArr) ) {
		  $data[$val] = (isset($ival[$val])) ? intval($ival[$val]) : 0;
		} else if ( in_array($val,$floatArr)) {
		  $data[$val] = (isset($ival[$val])) ? floatval($ival[$val]) : 0;
		} else if( in_array($val,$textArr)) {
		  $data[$val] = (isset($ival[$val])) ? cg($val) : '';
		} else {
		  $data[$val] = (isset($ival[$val])) ? $ival[$val] : '';
		}
	  }
	  if ($model ==1 && !in_array('date',$field)) $data['date'] = dates();
	  if ($common) {
	    if (!in_array('topic',$field))   { $data['topic']   = isset($ival['topic'])   ? $ival['topic']           : '';}
		if (!in_array('ord',$field))     { $data['ord']     = isset($ival['ord'])     ? intval($ival['ord'])     : 0 ;}
		if (!in_array('enabled',$field)) { $data['enabled'] = isset($ival['enabled']) ? intval($ival['enabled']) : 0 ;}
	  }
	  if ( count($add) > 0 ) {
        foreach ($add as $akey=>$aval) {
		  $data[$akey] = $aval;
		}
	  }
	  if ( in_array('intro',$field) && in_array('content',$field) ) {
		$content = ($data['content']!='') ? mb_substr(strip_tags(trim($data['content'])),0,120,'utf-8').'...' : '';
		$content = ($content!='')         ? str_replace(array("\r\n", "\r", "\n"), "", $content)     : '';
	    if ( $data['intro'] == '' ) { $data['intro'] = $content; }
	  }
	  return $data;
	} else {
	  return array();
	}
  } 
  //组合分页 
  protected function pageDisplay($conf = array()) {
    $tables    = isset($conf['tables'])    ? $conf['tables']    : I('request.tables','');
	$martables = isset($conf['martables']) ? $conf['martables'] : I('request.martables','');
	$mtables   = isset($conf['mtables'])   ? $conf['mtables']   : '';        //二级表
	$stables   = isset($conf['stables'])   ? $conf['stables']   : '';        //3级表
	$where     = isset($conf['where'])     ? $conf['where']     : '1=1';
	$order     = isset($conf['order'])     ? $conf['order']     : 'ord ASC,date DESC';
	$title     = isset($conf['title'])     ? $conf['title']     : '资料管理';
	$sty       = isset($conf['sty'])       ? $conf['sty']       : 0;
	$delid     = isset($conf['delid'])     ? $conf['delid']     : array();
	$ctag      = isset($conf['ctag'])      ? $conf['ctag']      : 'inftype'; //分类字段
	$mtag      = isset($conf['mtag'])      ? $conf['mtag']      : 'mtag';    //二类字段
	$stag      = isset($conf['stag'])      ? $conf['stag']      : 'stag';    //三类字段
	$ctagAs    = isset($conf['ctagAs'])    ? $conf['ctagAs']    : 'inftopic';//分类字段
	$mtagAs    = isset($conf['mtagAs'])    ? $conf['mtagAs']    : 'mtopic';  //分类字段
	$stagAs    = isset($conf['stagAs'])    ? $conf['stagAs']    : 'stopic';  //分类字段
	$systitle  = isset($conf['systitle'])  ? $conf['systitle']  : '';        //管理标题
	$subtitle  = isset($conf['subtitle'])  ? $conf['subtitle']  : '';        //副标题
	$page      = I('get.page',1,'intval');
	$send      = I('post.deldata','');
	if ($tables == '') {
	  $this->error('数据表为空，无法获取数据',U('index/main'),2);
	  return false;
	} else {
	  if ($send == '') {
	    $count    = M($tables)->where($where)->count();
	    $pobj     = new \Think\AdminPage($count,C('ADMINPAGE'));
	    $data     = M($tables)->field('*')->where($where)->order($order)->limit($pobj->limit)->select();
		if ( $data && $martables !='' ) {
		 foreach($data as $key=>$val) {
		  $data[$key][$ctagAs] = $this->gettopic($martables,$val[$ctag]);
		  if ($mtables!='' && isset($val[$mtag])) {
		    $data[$key][$mtagAs] = $this->gettopic($mtables,$val[$mtag]);
		  }
		  if ($stables!='' && isset($val[$stag])) {
		    $data[$key][$stagAs] = $this->gettopic($stables,$val[$stag]);
		  }
		 }
		}
		
		if ($tables == 'adminauth') {
		  if ($data) {
		    foreach($data as $key=>$val) {
			  $data[$key]['mdata'] = M('adminauth')->field("*")->where('tid='.$val['Id'])->order('ord ASC')->select();
			}
		  }
		}
		$datashow = array();
		$datashow['pageno']   = ($page-1)*$pobj->pagesize;
		$datashow['pageshow'] = ($count>C('ADMINPAGE')) ? $pobj->showpage() : '';
		$datashow['table']    = $tables;
		$datashow['mdata']    = ($martables!='') ? $this->getSelect($martables,$sty) : '';
		$datashow['martable'] = $martables;
		$this->assign('dshow',$datashow);
		$this->assign('sty',$sty);
		$this->assign('data',$data);
		$this->assign('title',$title);
		$this->assign('systitle',$systitle);
		$this->assign('subtitle',$subtitle);
		$this->display();
	  } else if ($send == '删除'){
	    //删除
		$deldata = isset($_POST['pubbox']) ? $_POST['pubbox'] : array();
	    if(count($deldata)>0){
		  $nodelArr = $delid;
		  $delcount = 0;
		  //如果要删除管理员的话，请先保证管理用户至少有一条数据
		  if ($tables == 'adminuser') {
		    $admincount = M($tables)->where('1=1')->count();
			if ($admincount == 1) {
			  $this->error('系统检测到您的管理员只有一个，暂不支持删除，请先添加一个管理员吧！');
			  exit();
			}
			if ($admincount == count($deldata)) {
			  $this->error('请至少保留一位系统管理用户');
			  exit();
			}
		  }
		  foreach($deldata as $val){
		    if(!in_array($val,$nodelArr)){
			  $del = $this->delbyid($tables,$val);
			  $delcount += ($del) ? 1 : 0;
		    }else{
		      $delcount +=0;
		    }
		  }
		  $this->success('数据操作成功，影响数据'.$delcount.'条');
	    }else{
	     $this->error('请至少选择一条数据进行操作');
	    }
		//删除
	  }	
	}
  }
  //修改属性
  protected function upattr($table,$id,$field,$val) {
    if ($table!='' && $id!=0 && $field!='') {
	  return (M($table)->where('Id='.$id)->limit(1)->save(array($field=>$val))) ? true : false;
	} else {
	  return false;
	}
  }
  //返回下拉选项卡
  protected function dropdown($table){
    if ($table!='') {
      return M($table)->field('topic,Id')->order('ord ASC')->select();
	} else {
	  return false;
	}
  }
  //排序
  protected function Array_sort($arr, $keys, $type = 'desc') {
    $keysvalue = $new_array = array();
    foreach ($arr as $k => $v) {
        $keysvalue[$k] = $v[$keys];
    }
    if ($type == 'asc') {
        asort($keysvalue);
    } else {
        arsort($keysvalue);
    }
    reset($keysvalue);
	
    foreach ($keysvalue as $k => $v) {
       // echo $k.'/';
		$new_array[$k] = $arr[$k];
    }
    return $new_array;
  }

  //设置后台保护目录
  protected function CreateAdmin($name,$delname='') {
	 $delname  = ($delname!='') ? ucwords($delname).'Controller.class.php' : '';
     $filename = ucwords($name).'Controller.class.php';
	 $filename = APP_PATH.'Home/Controller/'.$filename;
	 $content  = '<?php
				  namespace Home\Controller;
				  use Think\Controller;
				  class '.ucwords($name).'Controller extends Controller {
					   public function index(){ 
						 C("TMPL_PARSE_STRING",array(
							"__css__"  => "'.__ROOT__.'/public/Admin/css",
							"__js__"   => "'.__ROOT__.'/public/Admin/js",
							"__img__"  => "'.__ROOT__.'/public/Admin/images",
						 ));
						 $this->assign("data",array("adminpath"=>""));
						 $this->display(T("Admin@index/login"));
					   }
				  }';
	 if (!file_exists($filename)) {
	   if (file_put_contents($filename,$content) ){
		 if($delname!='') unlink(APP_PATH.'Home/Controller/'.$delname);
	     return true;
	   } else {
	     return false;
	   }	
	 }
   }
  
}