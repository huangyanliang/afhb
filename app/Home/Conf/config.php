<?php
 return array(
	 'TMPL_PARSE_STRING' => array(
		'__css__'  =>  __ROOT__ .'/public/'.MODULE_NAME.'/css',
		'__js__'   =>  __ROOT__ .'/public/'.MODULE_NAME.'/js',
		'__img__'  =>  __ROOT__ .'/public/'.MODULE_NAME.'/images',
        '__pic__'  =>  __ROOT__ .'/uploads/images/',
		'__file__' =>  __ROOT__ .'/uploads/files/',
	 ),
	 'TMPL_ACTION_ERROR'   => 'public/state',
	 'TMPL_ACTION_SUCCESS' => 'public/state',
	 'URL_HTML_SUFFIX'     => '.html' 
 );