<?php
  function icon($icon,$code='span',$class=''){
     $class = ($class=='') ? '' : ' '.$class;
     return '<'.$code.' class="glyphicon glyphicon-'.$icon.$class.'"></'.$code.'>';
  }
  function faicon($icon,$code='span',$class=''){
     $class = ($class=='') ? '' : ' '.$class;
	 return '<'.$code.' class="fa fa-'.$icon.$class.'"></'.$code.'>';
  }
  function btn($conf = array()){
	 $btn_conf = array(
	              'scene' => isset($conf['scene']) ? $conf['scene'] : 'info',        //情景
				  'vals'  => isset($conf['vals'])  ? $conf['vals']  : '',            //文本
				  'icon'  => isset($conf['icon'])  ? $conf['icon']  : '',            //图标
				  'faicon'=> isset($conf['faicon'])? $conf['faicon']: '',            //fa图标
				  'size'  => isset($conf['size'])  ? $conf['size']  : '4',           //尺寸 默认超小 1,2,3,4
				  'ban'   => isset($conf['ban'])   ? $conf['ban']   : 0,             //按钮是否可用
				  'type'  => isset($conf['type'])  ? $conf['type']  : 'button',      //按钮类型 
				  'dir'   => isset($conf['dir'])   ? $conf['dir']   : 'top',         //提示的方向
				  'tips'  => isset($conf['tips'])  ? $conf['tips']  : '',            //提示文字
				  'url'   => isset($conf['url'])   ? $conf['url']   : '',            //跳转到
				  'add'   => isset($conf['add'])   ? $conf['add']   : '',            //需要新增的类
				  'name'  => isset($conf['name'])  ? $conf['name']  : 'send',        //名称	
				  'line'  => isset($conf['line'])  ? $conf['line']  : 0,             //bootstrap4.0 outline属性  
				  );
	 $scene = ($btn_conf['scene']!='')    ? 'btn-'.$btn_conf['scene']   : '';        //情景颜色
	 $scene = ($btn_conf['line'])         ? $scene.'-outline'           : $scene;    //outline属性
	 $icon  = ($btn_conf['icon']!='')     ? icon($btn_conf['icon'])     : '';        //定义自定义图标
	 if ($btn_conf['icon']=='') {
	   $icon  = ($btn_conf['faicon']!='') ? faicon($btn_conf['faicon']) : '';        //定义自定义图标
	 }
	 $tips  = ($btn_conf['tips']!='')     ? tooltip($btn_conf['tips'],$btn_conf['dir']) : ''; //启用按钮tooltips
	 $size  = $btn_conf['size']; //按钮尺寸
	 switch($size){
	   case 1:
	   $size = ' btn-lg';
	   break;
	   case 2:
	   $size = '';
	   break;
	   case 3:
	   $size = ' btn-sm';
	   break;
	   case 4:
	   $size = ' btn-xs';
	   break;
	 }
	 $ban   = ($btn_conf['ban']) ? ' disabled="disabled"' : '';
	 $vals  = $btn_conf['vals'];
	 $icon  = ($vals!='') ? $icon.'&nbsp;' : $icon;
	 $type  = $btn_conf['type'];
	 $add   = ($btn_conf['add']!='') ? ' '.$btn_conf['add'] : '';
	 $name  = $btn_conf['name'];	 
	 $ckurl = ($btn_conf['url']!='') ? " onClick=\"location.href='".$btn_conf['url']."'\"" : '';
	 return '<button type="'.$type.'" tabindex="999" value="'.$vals.'" name="'.$name.'"'.$ckurl.' class="btn '.$scene.$size.$add.'" '.$tips.$ban.'>'.$icon.$vals.'</button>';
  }
  function tooltip($tips,$placement='top',$tiptype=1){
	if($tiptype==1){
      return ' data-toggle="tooltip" data-placement="'.$placement.'" title="'.$tips.'"';
	}else{
	  return ' data-container="body" data-toggle="popover" data-trigger="focus" data-placement="'.$placement.'" data-content="'.$tips.'"';
	}
  }
  function tplUrl($url = '') {
    if ($url == '') {
	  return 'javascript:void(0)';
	} else {
	  $uArr = explode(",",$url);
	  if ( count($uArr) > 1 ) {
	    return U($uArr[0],$uArr[1]);
	  } else {
	    return U($uArr[0]);
	  }
	}
  }
  function imgshow($pic='',$placement="left") {
    $isfile  = (file_exists(C("UPLOAD_PATH").'images/'.$pic)) ? 1 : 0;
	$showpic = ($isfile) ? __ROOT__.'/'.C("UPLOAD_PATH").'images/'.$pic  : __ROOT__.'/public/'.MODULE_NAME.'/images/404.jpg';
	$html    = "<img src='".$showpic."' width='150' alt='picture'>";
	return ' data-toggle="popover" data-placement="'.$placement.'" data-content="'.$html.'"';
  }
  function tabstyle(){
    return 'table table-bordered table-striped table-hover';//
  }
  function ckall($type='bottom'){
    return '<span class="ckallbox"><input type="checkbox" value="0" class="ckall"></span>';
  }
  function ckbox($id,$i,$isck=0,$isban=0){
	if(!$isban){
	  return ($isck==0) ? '<input type="checkbox" value="'.$id.'" name="pubbox[]" class="myselect">' : '<input type="checkbox" value="'.$id.'" name="pubbox[]" checked class="myselect">';
	}else{
	  return '<input type="checkbox" value="0" name="pubbox[]" disabled class="myselect">';
	}
  }
  function checkbox($id=0,$isck=0,$name='enabled'){
	if($isck){
      return '<input type="checkbox" name="'.$name.'" value="1" checked="checked">';
	}else{
	  return (!$id) ? '<input type="checkbox" name="'.$name.'" value="1">' : '<input type="checkbox" name="'.$name.'" value="1" checked="checked">';
	}
  }
  function dataord($name,$val,$def=0){
	 if($val[0]==0) return (!$def) ? '<a href="'.get_url().'/'.$name.'/2"'.tooltip('点击按照 '.$val[1].' 倒序排序').'>'.icon('arrow-down').' '.$val[1].'</a>' : '<a href="'.get_url().'/'.$name.'/1"'.tooltip('点击按照 '.$val[1].' 顺序排序').'>'.icon('arrow-up').' '.$val[1].'</a>';  
	 if($val[0]==1) return '<a href="'.get_url().'/'.$name.'/2"'.tooltip('点击按照 '.$val[1].' 倒序排序').'>'.icon('arrow-up').' '.$val[1].'</a>';
	 if($val[0]==2) return '<a href="'.get_url().'/'.$name.'/1"'.tooltip('点击按照 '.$val[1].' 顺序排序').'>'.icon('arrow-down').' '.$val[1].'</a>';
  }
  //获取系统菜单
  function showadminauth($id=0,$show=1,$auth=''){
    if ($id) {
      $data = M('adminauth')->field("*")->where('tid='.$id)->order('ord ASC')->select();
      if ($data) {
	    $str = '';
        foreach($data as $key=>$val) {
		  $icon = '无';
		  if ($val['icon']!='') {
		    $icon = ($val['isext']) ? faicon($val['icon']) : icon($val['icon']);
		  }
		  $special = ($val['isspecial']) ? ' <font color="red">特</font>' : '';
		  if ($show == 1) {
	        $str .= '<tr id="adminauth'.$val['Id'].'" class="success adminauth'.$id.'" style="display:none;"><td align="center" valign="middle" height="37">'.ckbox($val['Id'],$key-1).'</td><td align="center" valign="middle">'.$val['Id'].'</td><td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$val['title'].$special.'</td><td align="left" valign="middle">'.modField($val['linkurl'],$val['Id'],'linkurl','adminauth').'</td><td align="center" valign="middle">'.$icon.'</td><td align="center" valign="middle">'.modattr($val['Id'],$val['isext'],'adminauth','isext',array('是','否')).'</td><td align="center" valign="middle">'.modattr($val['Id'],$val['isopen'],'adminauth','isopen',array('展开','关闭')).'</td><td align="center" valign="middle">'.modord($val['ord'],$val['Id'],'adminauth').'</td><td align="left" valign="middle">'.btn(array('vals'=>'编辑','icon'=>'edit','tips'=>'点击编辑数据','url'=>U('system/adminauthmod','id='.$val['Id']))).'</td></tr>';
		  } else {
		    $ischecked = '';
		    if ($auth!='') {
		      $myauth = explode(",",$auth);
			  $ischecked = in_array($val['Id'],$myauth) ? ' checked="checked"' : '';
		    }
		    $str .= '<tr id="adminauth'.$val['Id'].'" class="success adminauth'.$id.'" style="display:none;"><td align="center" valign="middle" height="37"><input type="checkbox" value="'.$val['Id'].'"'.$ischecked.' name="auth[]"></td><td align="center" valign="middle">'.$val['Id'].'</td><td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$val['title'].$special.'</td></tr>';
		  }
	    }
	    return $str;
	  }
    }
  }
  function input($conf = array()){
    $cname = isset($conf['cname']) ? $conf['cname']        : 'form-control';
	$name  = isset($conf['name'])  ? $conf['name']         : '';
	$val   = isset($conf['val'])   ? $conf['val']          : '';
	$units = isset($conf['units']) ? $conf['units']        : '';
	$add   = isset($conf['add'])   ? ' '.$conf['add']      : '';
	$has   = isset($conf['has'])   ? ' has-'.$conf['has']  : '';
	$scene = isset($conf['scene']) ? $conf['scene']        : '';
	$icon  = isset($conf['icon'])  ? $conf['icon']         : '';
	$faicon= isset($conf['faicon'])? $conf['faicon']       : '';
	$tips  = isset($conf['tips'])  ? tooltip($conf['tips'],'right') : '';
	$type  = isset($conf['type'])  ? $conf['type'] : 'text';
	$width = isset($conf['width']) ? ' style="width:'.($conf['width']*10).'px"' : ' style="width:400px;"';
	$disabled = isset($conf['disabled']) ? ' disabled="disabled"' : '';
	$readonly = isset($conf['readonly']) ? ' readonly="readonly"' : '';
	$place = isset($conf['place']) ? ' placeholder="'.$conf['place'].'"' : '';
	if ($scene == '' && $icon=='' && $units=='' && $faicon=='') {
	  $tips = isset($conf['tips']) ? '<span class="text-warning">'.$conf['tips'].'</span>' : ''; 
	}
	if ($name == 'intro' && $val!='')  $val = stripslashes($val);
	if ($scene == 'ord' && $val == '') $val = 1;
	if ($type == 'text' || $type == 'password') {
	  if ($scene == 'date')  return "<div class=\"input-group input-group-sm".$has."\"".$tips." style=\"width:180px;\"><input type=\"text\" value=\"".$val."\" name=\"".$name."\" onClick=\"laydate({istime:true,format: 'YYYY-MM-DD hh:mm:ss'})\" class=\"".$cname.$add."\"".$disabled."><span class=\"input-group-addon\">".icon('calendar')."</span></div>";
	  if ($scene == 'day')  return "<div class=\"input-group input-group-sm".$has."\"".$tips." style=\"width:180px;\"><input type=\"text\" value=\"".$val."\" name=\"".$name."\" onClick=\"laydate({istime:true,format: 'YYYY-MM-DD})\" class=\"".$cname.$add."\"".$disabled."><span class=\"input-group-addon\">".icon('calendar')."</span></div>";
	  if ($scene == 'topic') return '<div class="input-group input-group-sm'.$has.'"'.$width.$tips.'><input type="'.$type.'" value="'.$val.'" placeholder="请输入资料名称" name="'.$name.'" class="'.$cname.$add.'"'.$disabled.'><span class="input-group-addon">'.faicon('newspaper-o').'</span></div>';
	  if ($scene == 'link') return '<div class="input-group input-group-sm'.$has.'"'.$width.$tips.'><input type="'.$type.'" value="'.$val.'"'.$place.' name="'.$name.'" class="'.$cname.$add.'"'.$disabled.'><span class="input-group-addon">'.icon('link').'</span></div>';
	  if ($scene == 'ord')  return '<div class="input-group input-group-sm'.$has.'"'.tooltip('数字越小，排在越前','right').' style="width:100px;"><input type="'.$type.'" value="'.$val.'"'.$place.' name="'.$name.'" class="'.$cname.$add.'"'.$disabled.'><span class="input-group-addon">'.faicon('sort').'</span></div>';
	  if ($scene == 'key')  return '<div class="input-group input-group-sm has-success"'.tooltip('页面关键词，利于SEO优化,200个字符以内','right').' style="width:600px;"><input type="'.$type.'" value="'.$val.'" name="'.$name.'" class="'.$cname.$add.'"'.$disabled.' placeholder="请输入页面关键词"><span class="input-group-addon">'.icon('menu-right').'</span></div>';
	  if ($scene == 'des')  return '<div class="input-group input-group-sm has-success"'.tooltip('页面描述，利于SEO优化,200个字符以内','right').' style="width:600px;"><input type="'.$type.'" value="'.$val.'" name="'.$name.'" class="'.$cname.$add.'"'.$disabled.' placeholder="请输入页面描述"><span class="input-group-addon">'.icon('menu-right').'</span></div>';
	  if ($icon  != '')     return '<div class="input-group input-group-sm'.$has.'"'.$width.$tips.'><input type="'.$type.'" value="'.$val.'"'.$place.' name="'.$name.'" class="'.$cname.$add.'"'.$disabled.$readonly.'><span class="input-group-addon">'.icon($icon).'</span></div>';
	  if ($faicon  != '')   return '<div class="input-group input-group-sm'.$has.'"'.$width.$tips.'><input type="'.$type.'" value="'.$val.'"'.$place.' name="'.$name.'" class="'.$cname.$add.'"'.$disabled.$readonly.'><span class="input-group-addon">'.faicon($faicon).'</span></div>';
	  if ($units != '')     return '<div class="input-group input-group-sm'.$has.'"'.$width.$tips.'><input type="'.$type.'" value="'.$val.'"'.$place.' name="'.$name.'" class="'.$cname.$add.'"'.$disabled.$readonly.'><span class="input-group-addon">'.$units.'</span></div>';
	  return '<input type="text" value="'.$val.'"'.$place.' name="'.$name.'" class="'.$cname.$add.'"'.$disabled.$readonly.$width.'>'.$tips;
	} else if ($type == 'textarea') {
	  return '<textarea name="'.$name.'"'.$place.' class="mytextarea '.$cname.$add.'" rows="3">'.$val.'</textarea>'.$tips;
	} else if ($type == 'editor') {
	  return '<textarea name="'.$name.'" class="mytextarea '.$cname.$add.'" style="width:95%;height:350px;">'.showdata($val).'</textarea>';
	}
  }
  function modField($val='',$id=0,$field='',$tables=''){
    $val = ($val=='') ? '--' : $val;
    return '<input type="text" class="modfield" data-tables="'.$tables.'" data-id="'.$id.'" data-odata="'.$val.'" data-field="'.$field.'" value="'.$val.'">';
  }
  function get_url() {
    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
    $php_self     = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
    $path_info    = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    $relate_url   = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
    $url = $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
	return $url;
  }
  function cg($name='content',$default='',$method='post'){
	if($method == 'get'){
	  return isset($_GET[$name])  ? $_GET[$name]  : $default;
	}else if($method == 'post'){
	  return isset($_POST[$name]) ? $_POST[$name] : $default;
	}
  }
  function uppic($config = array()){
	  $tips    = isset($config['tips'])    ? $config['tips']    : ''; //提示
	  $iscrop  = isset($config['iscrop'])  ? $config['iscrop']  : 1;  //是否裁剪
	  $w       = isset($config['w'])       ? $config['w']       : 0;  //裁剪宽度
	  $h       = isset($config['h'])       ? $config['h']       : 0;  //裁剪高度
	  $iswater = isset($config['iswater']) ? $config['iswater'] : 0;  //强制不加水印
	  $pic     = isset($config['pic'])     ? $config['pic']     : ''; //在编辑场景里面需要传
	  $isshow  = isset($config['isshow'])  ? $config['isshow']  : 0;  //在图片上传成功之后弹出裁剪框 1表示强制弹出 0表示不弹出
	  $choice  = isset($config['choice'])  ? $config['choice']  : 1;  //在已经上传的图片里面选择
	  $npic    = __ROOT__.'/public/'.MODULE_NAME.'/images/adminbg.jpg';
	  $cropdata= '';
	  $choice  = ($choice) ? ' '.btn(array('vals'=>'选择','add'=>'btn-choice','scene'=>'default','icon'=>'picture','tips'=>'点击在已有图片库中选择一张')) : '';
	  if ( $iscrop ) {
		$isfile  = ($pic!='' && file_exists(C("UPLOAD_PATH").'images/'.$pic)) ? 1 : 0;
		$showpic = ($isfile) ? __ROOT__.'/'.C("UPLOAD_PATH").'images/'.$pic  : $npic;
	    $cropdata = '<div class="crop-mask"></div>
		             <div class="crop-container">
					  <div class="imgcrop-main">
					      <div class="modal-header">
							<button type="button" class="close btn-close-cropper" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">裁剪图片</h4>
						  </div>
		               <div class="img-container">
					     <img src="'.$showpic.'">
					     <div class="cropper-result">裁剪数据：左：<span class="c-l"></span>px，上：<span class="c-t"></span>px，宽度：<span class="c-w"></span>px，高度：<span class="c-h"></span>px &nbsp;&nbsp;</div>
					   </div>
					   <div class="modal-footer">
							<button type="button" class="btn btn-default btn-sm btn-close-cropper">'.icon('off').' 取消</button>
							<button type="button" class="btn btn-primary btn-sm btn-cropper"'.tooltip('点击确定裁剪图片').'>'.icon('scissors').' 裁剪</button>
					   </div>
					  </div>
					 </div>
					 <input id="size-w" type="hidden" value="'.$w.'">
					 <input id="size-h" type="hidden" value="'.$h.'">
		             <input id="img-x" type="hidden" value="0" placeholder="x">
					 <input id="img-y" type="hidden" value="0" placeholder="y">
					 <input id="img-h" type="hidden" value="0" placeholder="w">
					 <input id="img-w" type="hidden" value="0" placeholder="h">
					 <input id="img-r" type="hidden" value="0" placeholder="r">';
	    $tips = ($tips!='') ? '<div class="uptips text-warning">'.icon('info-sign').' '.$tips.btn(array('vals'=>'裁剪','add'=>'btn-cut','scene'=>'default','icon'=>'scissors','tips'=>'点击裁剪图片')).$choice.'</div>' : '<div class="uptips text-warning">'.btn(array('vals'=>'裁剪','add'=>'btn-cut','scene'=>'default','icon'=>'scissors','tips'=>'点击裁剪图片')).$choice.'</div>';
	  } else {
	    $tips = ($tips!='') ? '<div class="uptips text-warning">'.icon('info-sign').' '.$tips.$choice.'</div>' : '';
	  }
	  $isshow  = ($isshow)  ? '<div class="showcroptool hide"></div>' : '';
	  $iswater = ($iswater) ? '<div class="nowater"></div>' : '';
	  if ( $pic == '' ) {
	    return '<div class="bh-cropmain">
		         <input id="uppic" name="uppic" type="file"><input id="pic" name="pic" type="hidden" value="" />
				 '.$tips.'
				 <div class="uppicdiv">
				  <div class="picshow">
				   <div class="picdiv"></div>
				   <div class="picfoot">'.icon('picture','b').icon('trash').'</div>
				  </div>
				 </div>'.$iswater.$isshow.$cropdata.'
				</div>';
	  } else {
		$isfile  = (file_exists(C("UPLOAD_PATH").'images/'.$pic)) ? 1 : 0;
		$showpic = ($isfile) ? __ROOT__.'/'.C("UPLOAD_PATH").'images/'.$pic  : __ROOT__.'/public/'.MODULE_NAME.'/images/404.jpg';
        return '<div class="bh-cropmain">
		         <input id="uppic" name="uppic" type="file"><input id="pic" name="pic" type="hidden" value="'.$pic.'" />
				 '.$tips.'
				 <div class="uppicdiv" style="display:block;">
				  <div class="picshow">
				   <div class="picdiv"><img src="'.$showpic.'" data-action="zoom"></div>
				   <div class="picfoot"><b class="glyphicon glyphicon-picture">'.$pic.'</b>'.icon('trash').'</div>
				  </div>
				 </div>'.$iswater.$isshow.$cropdata.'
				 <div class="nodeloriginal"></div>
				</div>';
	  }
 }
 //上传图片 FORM UPLOAD
 function uppicture($pic='',$tips='',$index=1,$name='pic'){
	  $tips    = ($tips!='') ? '<div class="uptips text-warning">'.icon('info-sign').$tips.'</div>' : '';
	  $myindex = ($index==1) ? '' : $index;
	  $myname  = ($name!='' && $name!='pic') ? $name : 'pic'.$myindex;
      if($pic==''){
	    return '<div class="myupload"><input id="uploadpic'.$index.'" name="Filedata" class="uploadpic" type="file" data-id="'.$index.'"><span class="glyphicon glyphicon-picture"><b>选择上传</b></span></div><div class="up-progress"><div class="up-bar"></div></div><input id="uppic'.$index.'" name="'.$myname.'" type="hidden" value="">'.$tips.'<div class="uppicdiv uppicturediv"><div class="picshow"><div class="picdiv"></div><div class="mypicfoot" data-id="'.$index.'"><b class="glyphicon glyphicon-picture"></b>'.icon('trash').'</div></div></div>';
	  }else{
		$isfile = (file_exists(C("UPLOAD_PATH").'images/'.$pic)) ? 1 : 0;
		$showpic = ($isfile) ? __ROOT__.'/'.C("UPLOAD_PATH").'images/'.$pic  : __ROOT__.'/public/'.MODULE_NAME.'/images/404.jpg';
		return '<div class="myupload"><input id="uploadpic'.$index.'" name="Filedata" class="uploadpic" type="file" data-id="'.$index.'"><span class="glyphicon glyphicon-picture"><b>选择上传</b></span></div><div class="up-progress"><div class="up-bar"></div></div><input id="uppic'.$index.'" name="'.$myname.'" type="hidden" value="'.$pic.'">'.$tips.'<div class="uppicdiv uppicturediv" style="display:block;"><div class="picshow"><div class="picdiv"><img src="'.$showpic.'" data-action="zoom"></div><div class="mypicfoot" data-id="'.$index.'"><b class="glyphicon glyphicon-picture">'.$pic.'</b>'.icon('trash').'</div></div></div>';
	  }
 }
 //多图上传
 function upatlas($file='',$tips='',$piclimit=5){
	  $tips = ($tips!='') ? '<div class="uptips text-warning">'.icon('info-sign').' '.$tips.'</div>' : '';
	  if($file==''){
	    return '<input id="upatlas" name="upatlas" type="file">'.$tips.'<div class="upupatlas"><h3>'.icon('picture').' 图集缩略图，允许上传图片 <span class="piclimit">'.$piclimit.'</span> 张</h3><div class="atlaspiclist"></div></div>';
	  }else{
		$fileArr = unserialize($file);
	    $myatlas = '';
		if(count($fileArr)>0){
		 foreach($fileArr as $fval){
		   $isfile  = (file_exists(C("UPLOAD_PATH").'images/'.$fval)) ? 1 : 0;
		   $showpic = ($isfile) ? __ROOT__.'/'.C("UPLOAD_PATH").'images/'.$fval  : __ROOT__.'/public/'.MODULE_NAME.'/images/404.jpg';
		   $myatlas .= '<div class="atlaspic"><input type="hidden" name="atlas[]" value="'.$fval.'"><div class="atlaspicfile"><img src="'.$showpic.'" data-action="zoom"></div><div class="atlasdel">'.icon('trash').' 删除图片</div></div>';
		 }
		}
		$limit = $piclimit - intval(count($fileArr));
	    return '<input id="upatlas" name="upatlas" type="file">'.$tips.'<div class="upupatlas" style="display:block;"><h3>'.icon('picture').' 图集缩略图，允许上传图片 <span class="piclimit">'.$limit.'</span> 张</h3><div class="atlaspiclist">'.$myatlas.'</div></div>';
	  }
 }
 //上传文件
 function upfile($file='',$tips=''){
	$tips = ($tips!='') ? '<div class="uptips text-warning">'.icon('info-sign').' '.$tips.'</div>' : '';
    if($file==''){
	    return '<input id="upfile" name="upfile" type="file"><input id="filename" name="filename" type="hidden" value="">'.$tips.'<div class="upfilediv"><div class="fileshow">'.icon('file').'<span class="upfilename"></span><span class="glyphicon glyphicon-trash del-file pull-right text-danger"></span></div></div>';
	} else {
	  return '<input id="upfile" name="upfile" type="file"><input id="filename" name="filename" type="hidden" value="'.$file.'"><input name="oldfile" type="hidden" value="'.$file.'">'.$tips.'<div class="upfilediv" style="display:block;"><div class="fileshow">'.icon('file').'<span class="upfilename"><a href='.__ROOT__.C('UPLOAD_PATH').'files/'.$file.'>'.$file.'</a></span><span class="glyphicon glyphicon-trash del-file pull-right text-danger"></span></div></div>';
	}
 }
 //修改排序
 function modord($ord,$id,$tables){
    $click = " onClick=\"modord('".$tables."','".$id."')\"";
    return '<input type="text" value="'.$ord.'" name="modord'.$id.'" class="textord" /><button type="button" tabindex="999" class="btn btn-default btn-xs btn-ord"'.tooltip('点击可以修改排序').$click.'>'.icon('edit').'修改</button>';
 }
 //修改属性 字段从1到0 或者 从0到1
 function modattr($id,$val,$tables,$field='enabled',$tip=array('启用','禁用')){
    if($val==1){
	   return '<div class="btn-group" data-id="'.$id.'" data-tables="'.$tables.'" data-field="'.$field.'" data-tip1="'.$tip[0].'" data-tip2="'.$tip[1].'"><button type="button" tabindex="999" class="btn btn-info btn-xs btn-enabled" data-mark="1" data-toggle="tooltip" data-placement="top" title="点击'.$tip[0].'数据">'.$tip[0].'</button><button type="button" tabindex="999" class="btn btn-default btn-disabled btn-xs" data-mark="2" data-toggle="tooltip" data-placement="top" title="点击'.$tip[1].'数据">'.$tip[1].'</button></div>';
	} else {
	   return '<div class="btn-group" data-id="'.$id.'" data-tables="'.$tables.'" data-field="'.$field.'" data-tip1="'.$tip[0].'" data-tip2="'.$tip[1].'"><button type="button" tabindex="999" class="btn btn-default btn-xs btn-enabled" data-mark="1" data-toggle="tooltip" data-placement="top" title="点击'.$tip[0].'数据">'.$tip[0].'</button><button type="button" tabindex="999" class="btn btn-default btn-xs btn-disabled active" data-mark="2" data-toggle="tooltip" data-placement="top" title="点击'.$tip[1].'数据">'.$tip[1].'</button></div>';
	}
 }
 //下拉
 function dropdown($data,$id=0,$sel='请选择类别',$name="inftype"){
	  $sel = ($sel!='') ? $sel : '请选择类别';
	  $return = '<div class="btn-group btn-dropdown"><input type="hidden" value="'.$id.'" id="'.$name.'" class="drop-val" name="'.$name.'"><button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="drop-topic">'.$sel.'</span> <span class="caret"></span></button>';
	  if($data==1) $data = array(0=>array('Id'=>2,'topic'=>'启用'),1=>array('Id'=>1,'topic'=>'禁用'));
	  if($data==2) $data = array(0=>array('Id'=>2,'topic'=>'置顶'),1=>array('Id'=>1,'topic'=>'非置顶'));
	  if($data && is_array($data)>0){
		 $return .= '<ul class="dropdown-menu dropdown-type">';
		 $sel = (!$id) ? $sel : '请选择一项';
		 $return .= '<li><a href="javascript:void(0)" data-id="0">'.$sel.'</a></li>';
		 $return .= '<li role="separator" class="divider"></li>';
		 foreach($data as $mrkey=>$marval){
		   $return .= '<li><a href="javascript:void(0)" data-id="'.$marval['Id'].'">'.$marval['topic'].'</a></li>';
		 }
		 $return .= '</ul>'; 
	  }
	  $return .= '</div>';
	  return $return;
  }
  //多级联动
  function dropdownlink($data,$field,$tables,$type=2,$dropname=array(),$dropid=array()){
	  $field1   = (isset($field[0]) && $field[0]!='') ? $field[0] : '';
	  $field2   = (isset($field[1]) && $field[1]!='') ? $field[1] : '';
	  $tables1  = (isset($tables[0]) && $tables[0]!='') ? $tables[0] : '';
	  $tables2  = (isset($tables[1]) && $tables[1]!='') ? $tables[1] : '';
	  $dropname = (count($dropname)>0) ? $dropname : array('请选择大类','请选择子类','请选择小类');
	  $dropname[0] = (isset($dropname[0]) && $dropname[0]!='') ? $dropname[0] : '请选择大类';
	  $dropname[1] = (isset($dropname[1]) && $dropname[1]!='') ? $dropname[1] : '请选择子类';
	  $dropname[2] = (isset($dropname[2]) && $dropname[2]!='') ? $dropname[2] : '请选择小类';
	  $dropid      = (count($dropid)>0) ? $dropid : array(0,0,0);
	  $return = '<div class="btn-dropdownlink pull-left"><div class="btn-group btn-dropdown btn-group-type1">
	             <input type="hidden" value="'.$dropid[0].'" name="ctag" class="drop-hide">
				 <button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="drop-topic">'.$dropname[0].'</span> <span class="caret"></span></button>';
	  if($data && is_array($data)>0){
		 $return .= '<ul class="dropdown-menu mydrop-menu-type1">';
		 $return .= '<li><a href="javascript:void(0)" data-id="0">请选择大类</a></li>';
		 $return .= '<li role="separator" class="divider"></li>';
		 foreach($data as $mrkey=>$marval){
		   $return .= '<li><a href="javascript:void(0)" data-id="'.$marval['Id'].'" data-tables1="'.$tables1.'" data-tables2="'.$tables2.'" data-field1="'.$field1.'" data-field2="'.$field2.'">'.$marval['topic'].'</a></li>';
		 }
		 $return .= '</ul>'; 
	  }
	  $return .= '</div>';
	  $return .= '&nbsp;<div class="btn-group btn-dropdown btn-group-type2">   
	              <input type="hidden" value="'.$dropid[1].'" name="mtag" class="drop-hide">
				  <button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="drop-topic">'.$dropname[1].'</span> <span class="caret"></span></button>';
	 $return .= '<ul class="dropdown-menu mydrop-menu-type2">';
	 $return .= '<li><a href="javascript:void(0)" data-id="0">请先选择大类</a></li>';
	 $return .= '</ul>';
	 $return .= '</div>';
	 if($type==3){
	  $return .= '&nbsp;<div class="btn-group btn-dropdown btn-group-type3">   
	              <input type="hidden" value="'.$dropid[2].'" name="stag" class="drop-hide">
				  <button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="drop-topic">'.$dropname[2].'</span> <span class="caret"></span></button>';
	  $return .= '<ul class="dropdown-menu mydrop-menu-type3">';
	  $return .= '<li><a href="javascript:void(0)" data-id="0">请先选择子类</a></li>';
	  $return .= '</ul>';
	  $return .= '</div>';
	 }			  
	 return $return.'</div>';
 }
 //搜索 {:searchField(array('tables'=>'adminauth','field'=>'title','name'=>'adminuid','s_field'=>'name,title'))}
 function searchField($conf = array()){
    $name    = isset($conf['name'])      ? $conf['name']      : 'vid';   //表单名称
    $default = isset($conf['default'])   ? $conf['default']   : '请选择'; //默认
    $width   = isset($conf['width'])     ? $conf['width']     : '120';   //宽度
    $tables  = isset($conf['tables'])    ? $conf['tables']    : '';      //表格
    $field   = isset($conf['field'])     ? $conf['field']     : '';      //显示的字段
    $s_field = isset($conf['s_field'])   ? $conf['s_field']   : '';      //需要检索字段
    $limit   = isset($conf['limit'])     ? $conf['limit']     : 20;      //LIMIT
    $show    = isset($conf['showfield']) ? $conf['showfield'] : $field;  //额外显示的字段
    if ( $name!='' && $tables!='' && $s_field!='' ) {
	  $list = '';
	  $data = M($tables)->field('Id,'.$s_field)->limit($limit)->select();
	  if ( $data ) {
	    foreach( $data as $key=>$val ) {
	      $list .= '<li class="active-result" data-id="'.$val['Id'].'">'.$val[$field].'</li>';
		}
	  } else {
	    $list = '<li class="active-result" data-id="0">暂无数据</li>';
	  }
      return '<div class="chosen-container chosen-container-single" style="width:'.$width.'px; margin-bottom:10px;">
				 <a class="chosen-single chosen-single-with-deselect"><span>'.$default.'</span><abbr class="search-choice-close"></abbr><div><b></b></div></a>
				 <div class="chosen-drop">
				  <div class="chosen-search">
				   <input type="hidden" value="0" class="chose-keyid" name="'.$name.'">
				   <input type="text" class="chosen-keys" data-field="'.$field.'" data-sfield="'.$s_field.'" data-tables="'.$tables.'" autocomplete="off">
				  </div>
				  <div class="chosen-loading"><span class="fa fa-spinner fa-spin"></span></div>
				  <ul class="chosen-results">'.$list.'</ul>
				 </div>
			 </div>';
   } else {
     return '';
   }
 }
 function removelast($str) {
   if($str!=''){
	 $len = mb_strlen($str,'utf-8');
	 return mb_substr($str,0,$len-1,'utf-8');
   }else{
	 return '';
   }
 }
 function dates(){
   return date("Y-m-d H:i:s");
 }
 function showdate($date){
   return ($date!='') ? date("Y-m-d",strtotime($date)) : '--';
 }
 function showdata($str){
   return stripslashes($str);
 }
 function ispic($pic = '') {
   if ( $pic!='' ) {
	 $isfile  = (file_exists(C("UPLOAD_PATH").'images/'.$pic)) ? 1 : 0;
	 return ($isfile) ? __ROOT__.'/'.C("UPLOAD_PATH").'images/'.$pic  : __ROOT__.'/public/'.MODULE_NAME.'/images/404.jpg';
   } else {
     return __ROOT__.'/public/'.MODULE_NAME.'/images/404.jpg';
   }
 }
 function gtopic($db,$id,$field='topic',$default='') {
   if ($db!='' && $id!=0 && $field!='') {
     if ($mydata = M($db)->field($field)->where(array('Id'=>$id))->find()) {
	   return $mydata[$field];
	 } else {
	   return $default;
	 }
   } else {
     return $default;
   }
 }