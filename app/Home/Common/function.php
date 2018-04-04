<?php
 //个性域名
 function domain($tables,$id,$url='',$prefix='') {
   $url = ($url!='') ? $url : 'javascript:void(0)';
   if ($tables!='' && $id!='') {
	 if(!$data = S('domain'.$tables.'_'.$id)) {
       $data = M($tables)->field('domain')->where(array('Id'=>$id,"enabled"=>1))->find();
	   S('domain'.$tables.'_'.$id,$data,7200);
	 }
	 if ($data) {
	   if ($data['domain']!='') {
	     return ($prefix!='') ? __ROOT__.'/'.$prefix.'/'.$data['domain'].C('URL_HTML_SUFFIX') : __ROOT__.'/'.$data['domain'].C('URL_HTML_SUFFIX');
	   } else {
	     return $url;
	   }
	 } else {
	   return $url;
	 }
   } else {
     return $url;
   }
 }
 //图片显示
 function UPIC($pic,$scence = 'pic'){
	$path = __ROOT__.'/'.C('UPLOAD_PATH').'images/';
	if ( $pic == '' || (!file_exists(C('UPLOAD_PATH').'images/'.$pic))) {
	  if ($scence == 'news')     return $path.'default/default.png';
	  return $path.'default/default.png';
	} else {
	  return $path.$pic;
	}
 }