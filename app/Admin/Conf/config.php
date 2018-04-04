<?php
  return array(
	'TMPL_PARSE_STRING' => array(
		'__css__'    => __ROOT__.'/public/'.MODULE_NAME.'/css',
		'__js__'     => __ROOT__.'/public/'.MODULE_NAME.'/js',
		'__img__'    => __ROOT__.'/public/'.MODULE_NAME.'/images',
		'__editor__' => __ROOT__.'/public/kindedit',
		'__upload__' => __ROOT__.'/public/'.MODULE_NAME.'/uploadify',
		'__upfile__' => __ROOT__.'/uploads/',
	),
	'URL_HTML_SUFFIX'     => '.html', 
	'ADMINPAGE'           => 15,
	'COOKIE_key'          => 'jxbh',
	'TMPL_ACTION_ERROR'   => 'public/jump',
	'TMPL_ACTION_SUCCESS' => 'public/jump',
	'DB_BACKUP'           => './backup/',
	'ADMIN_VERSION'       => 'V3.0',
	'ADMIN_UPDATE'        => '20161207'
  );
  
  