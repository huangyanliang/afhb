<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="明良广后台管理系统 <?php echo C('ADMIN_VERSION');?>">
 <meta name="keywords" content="明良广后台管理系统 <?php echo C('ADMIN_VERSION');?>">
 <title><?php echo ($title); ?></title>
 <link href="/23mlg/public/Admin/css/bootstrap.min.css" rel="stylesheet">
 <link href="/23mlg/public/Admin/css/font-awesome.min.css" rel="stylesheet">
 <link href="/23mlg/public/Admin/css/alert.css" rel="stylesheet">
 <link href="/23mlg/public/Admin/css/common.css" rel="stylesheet">
 <!--[if IE 8]>
 <link rel="stylesheet" type="text/css" href="/23mlg/public/Admin/css/comie.css">
 <![endif]-->
 <!--[if IE 9]>
 <link rel="stylesheet" type="text/css" href="/23mlg/public/Admin/css/comie.css">
 <![endif]-->
 <script src="/23mlg/public/Admin/js/jquery.min.js" type="text/javascript"></script>
 <link href="/23mlg/public/Admin/css/minimal/minimal.css" rel="stylesheet">
 <script src="/23mlg/public/Admin/js/icheck.min.js" type="text/javascript"></script>
 <script src="/23mlg/public/Admin/js/jquery.scorll.js" type="text/javascript"></script>
 
 <link href="/23mlg/public/Admin/css/index.css" rel="stylesheet">
 <script src="/23mlg/public/Admin/js/index.js" type="text/javascript"></script>
 <script src="/23mlg/public/Admin/js/screenfull.min.js" type="text/javascript"></script>

</head>
<body>

<div id="header">
 <div class="adminlogo" title="澳菲环保后台管理"></div>
 <div class="adminbar" data-hide="1"><?php echo faicon('bars');?></div>
 <div class="adminmenu">
  <ul>
   <?php if(is_array($topmenu)): $i = 0; $__LIST__ = $topmenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tobj): $mod = ($i % 2 );++$i; if(in_array(($tobj['Id']), is_array($myauth)?$myauth:explode(',',$myauth))): ?><li><a data-id="<?php echo ($tobj['Id']); ?>" href="javascript:void(0)" <?php if($tabid == $tobj['Id']): ?>class="selected"<?php endif; ?>><?php if($tobj['icon'] != ''): echo ($tobj['isext']?faicon($tobj['icon']):icon($tobj['icon'])); endif; ?> <?php echo ($tobj['title']); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
  </ul>
 </div>
 <div class="adminright">
  <div class="adminface"></div>
  <div class="menu-switch"><?php echo icon('menu-down');?></div>
 </div>
 <div class="admin-menu">
  <ul class="admin-menu-ul">
   <li class="name"><?php echo ($adminauth['adminuser']); ?></li>
   <li><a data-id="0" href="<?php echo U('index/modpass');?>" target="right"><?php echo icon('cog');?>修改密码</a></li>
   <li><a data-id="0" href="<?php echo U('index/cleancache');?>" target="right"><?php echo icon('trash');?>清除缓存</a></li>
   <li><a data-id="0" href="<?php echo U('index/main');?>" target="right"><?php echo icon('home');?>系统首页</a></li>
   <!--<li><a data-id="0" href="http://www.23mlg.com" target="_blank"><?php echo icon('question-sign');?>关于我们</a></li>-->
   <li><a data-id="0" href="<?php echo U('index/logout');?>"><?php echo icon('share-alt');?>退出系统</a></li>
  </ul>
 </div>
</div>
<div class="indexmain">

<div id="sidebar">
 <div style="height:auto; overflow:hidden;">
 <?php if($mmenu != ''): if(is_array($mmenu)): $m = 0; $__LIST__ = $mmenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mobj): $mod = ($m % 2 );++$m; if($mobj['smenu'] != ''): if(in_array(($mobj['Id']), is_array($myauth)?$myauth:explode(',',$myauth))): ?><div class="menu-admin <?php echo ($mobj['isopen']?'':'hide-true'); ?>">
     <div class="menu-header2"><?php echo ($mobj['isext']?faicon($mobj['icon']):icon($mobj['icon'])); ?> <?php echo ($mobj['title']); ?>  <?php echo faicon('angle-down','b');?></div>
     <?php if(is_array($mobj['smenu'])): $i = 0; $__LIST__ = $mobj['smenu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sobj): $mod = ($i % 2 );++$i; if(in_array(($sobj['Id']), is_array($myauth)?$myauth:explode(',',$myauth))): ?><div class="menu-dd"> <a href="<?php echo tplUrl($sobj['linkurl']);?>" data-id="<?php echo ($sobj['Id']); ?>" target="right"><?php echo faicon('angle-right','b');?> <?php echo ($sobj['isext']?faicon($sobj['icon'],'b'):icon($sobj['icon'],'b')); ?> <?php echo ($sobj['title']); ?></a></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </div><?php endif; ?>
   <?php else: ?>
    <?php if(in_array(($mobj['Id']), is_array($myauth)?$myauth:explode(',',$myauth))): ?><a href="<?php echo tplUrl($mobj['linkurl']);?>" target="right"  data-id="<?php echo ($mobj['Id']); ?>" class="menu-link"><div class="menu-header"><?php echo ($mobj['isext']?faicon($mobj['icon']):icon($mobj['icon'])); ?>  <?php echo ($mobj['title']); ?>  <?php echo faicon('angle-right','b');?></div></a><?php endif; endif; endforeach; endif; else: echo "" ;endif; endif; ?>
 <div style="height:20px; clear:both;"></div>
 </div>
 </div>
 <div id="rightmain">
     <div id="map">
     <div class="pull-left btn-group" style="margin:7px auto 0 10px;">
      <?php echo btn(array('vals'=>'','size'=>3,'icon'=>'resize-full','scene'=>'default','add'=>'mycollapse'));?>
      <?php echo btn(array('vals'=>'','size'=>3,'icon'=>'arrow-left','scene'=>'default','add'=>'back'));?>
      <?php echo btn(array('vals'=>'','size'=>3,'icon'=>'arrow-right','scene'=>'default','add'=>'going'));?>
      <?php echo btn(array('vals'=>'','size'=>3,'icon'=>'refresh','scene'=>'default','add'=>'f5'));?>
      <?php echo btn(array('vals'=>'','size'=>3,'icon'=>'fullscreen','scene'=>'default','add'=>'fullscreen'));?>
      </div>
     <b>当前位置：<a href="<?php echo U('index/main');?>" target="right">系统首页</a> <img src="/23mlg/public/Admin/images/map_right.png" /> 管理中心 <img src="/23mlg/public/Admin/images/map_right.png" /> <?php echo gtopic('adminauth',$tabid,'title');?></b> 
     </div>
     <div id="iframdiv" class="adminpublic"><iframe name="right" id="iframeright" width="100%" height="100%" src="<?php echo ($refer); ?>" frameborder="0" scrolling="yes"></iframe></div>
 </div>
</div>
<script type="text/javascript">
 var width = document.documentElement.clientWidth - 178;
 document.getElementById('rightmain').style.width = width + 'px';
 var height = document.documentElement.clientHeight - 50;
 document.getElementById('rightmain').style.height = height + 'px';
 document.getElementById('iframdiv').style.width = width-20 + 'px';
 if ( width < 760 ) {
   $("#sidebar").hide();
   $(".mycollapse").find("span").removeClass('glyphicon-resize-full').addClass('glyphicon-resize-small');
 } else {
   $("#sidebar").show();
   $(".mycollapse").find("span").removeClass('glyphicon-resize-small').addClass('glyphicon-resize-full');
 }
 $(".hide-true .menu-dd").hide().css({"height":'0px'});
 $(".hide-true").find(".menu-header2,.menu-header").css({"border-bottom":'none'});
 $(".hide-true").find(".menu-header2 b,.menu-header b").removeClass("glyphicon-menu-down").addClass("fa-angle-up");
 if($(".menu-link").length>0) $(".menu-link").eq(0).addClass("menu-header2").removeClass("menu-header");
 $('#sidebar').perfectScrollbar();

</script>

  <?php if(!empty($upload)): ?><div class="modal fade bh-picture" id="bh-picture">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">系统图片库</h4>
          </div>
          <div class="modal-body" style="margin:0; padding:0;">
            <div class="row modal-picture">
              
              <div class="col-md-2 col-sm-3 col-xs-4 picture-sidebar">
                <div style="height:auto; overflow:hidden;">
                <div class="list-group">
                  <?php $filelist = D('File')->getfilepath(); if ( $filelist ) { foreach( $filelist as $fkey=>$fval ) { echo '<a href="javascript:void(0)" class="list-group-item picture-litype" data-path="'.$fval['file'].'">'.$fval['file'].' <span class="badge">'.$fval['count'].'</span></a>'; } } $piclist = D('File')->getpic(); ?> 
                </div> 
                </div>
              </div>
              
              <div class="col-md-10 col-sm-9 col-xs-8 picture-main">
                <div style="height:auto; overflow:hidden;">
                <div class="picture-mblock">
                <?php if ( count($piclist['sdata']) > 0 ) { foreach( $piclist['sdata'] as $pkey=>$pval ) { echo ($pval['spic']!='') ? '<div class="picdiv picture-fname" data-path="'.$pval['spic'].'"><img src="'.ispic($pval['spic']).'" data-action="zooms"><p title="'.$pval['pic'].'">'.$pval['pic'].'</p><div class="pic-active"></div></div>' : ''; } } ?>
                </div>
                <div style=" height:10px; clear:both;"></div>
                <div class="picture-pagelist"><?php echo ($piclist['pagelist']); ?></div>
              </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="pull-left"><div class="up-progress" style="margin:10px auto;"><div class="up-bar"></div></div></div>
            <input type="hidden" value="" id="picture-file">
            <input type="hidden" value="" id="picture-path">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo icon("off");?> 关闭</button>
            <button type="button" class="btn btn-primary btn-sm btn-choice-picture"><?php echo icon("picture");?> 选择图片</button>
          </div>
        </div>
      </div>
      <script src="/23mlg/public/Admin/js/jqthumb.js" type="text/javascript"></script>
      <script>
	   $(".picture-mblock img").jqthumb({width:128,height:128,classname:'jqthumb'});
	   $('.picture-sidebar').perfectScrollbar();
	   $('.picture-main').perfectScrollbar();
      </script>
    </div><?php endif; ?>
 
 <script src="/23mlg/public/Admin/js/bootstrap.min.js" type="text/javascript"></script>
 <script src="/23mlg/public/Admin/js/alert.min.js" type="text/javascript"></script>
 <script src="/23mlg/public/Admin/js/common.js" type="text/javascript"></script>
 <script src="/23mlg/public/Admin/js/zoom.js" type="text/javascript"></script>
 <?php if(!empty($upload)): ?><link href="/23mlg/public/Admin/css/cropper.css" rel="stylesheet">
 <script src="/23mlg/public/Admin/uploadify/uploadify.js" type="text/javascript" ></script>
 <script src="/23mlg/public/Admin/js/cropper.min.js" type="text/javascript" ></script><?php endif; ?>
 <?php if(!empty($formpic)): ?><script src="/23mlg/public/Admin/js/jquery.form.js" type="text/javascript" ></script><?php endif; ?>
 <?php if(!empty($color)): ?><script src="/23mlg/public/Admin/js/color.js" type="text/javascript"></script>
 <link href="/23mlg/public/Admin/css/color.css" rel="stylesheet">
 <script type="text/javascript">
  $(document).ready( function() {
	$('.colorselect').each( function() {
		$(this).minicolors({
			theme: 'bootstrap'
		});
	});
   });
 </script><?php endif; ?>
 <script type="text/javascript">
  var img     = '/23mlg/public/Admin/images';
  var abspath = '/23mlg/Admin';
  var upload  = '/23mlg/public/Admin/uploadify';
  var upfile  = '/23mlg/uploads/';
  $(function () {
    $('[data-toggle="tooltip"]').tooltip({container : 'body'});
    $('[data-toggle="popover"]').popover({html:true,container:'body',trigger:'focus',title:'','placement':'right'});
	$('input').iCheck({checkboxClass: 'icheckbox_minimal',radioClass: 'iradio_minimal',increaseArea: '20%'});
  });
 </script>
 <?php if(!empty($date)): ?><script src="/23mlg/public/Admin/js/date.js" type="text/javascript"></script><?php endif; ?>
 <?php if(!empty($editor)): ?><div class="modal fade" id="meituxiuxiumodal" tabindex="-1" role="dialog" data-url="<?php echo U('Fileupload/meituxiuxiu');?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width:730px; height:640px;">
      <div class="modal-header">
        <button type="button" class="close btn-meitu-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">美图秀秀在线处理</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" value="" id="meitupic">
        <iframe name="iframexiuxiu" class="iframexiuxiu" width="700" height="550" scrolling="no" frameborder="0" src="###"></iframe>
      </div>
    </div>
  </div>
 </div>
 
 <link rel="stylesheet" href="/23mlg/public/kindedit/themes/default/default.css" />
 <link rel="stylesheet" href="/23mlg/public/kindedit/plugins/code/prettify.css" />
 <script charset="utf-8" src="/23mlg/public/kindedit/kindeditor.js" type="text/javascript"></script>
 <script charset="utf-8" src="/23mlg/public/kindedit/lang/zh_CN.js" type="text/javascript"></script>
 <script charset="utf-8" src="/23mlg/public/kindedit/plugins/code/prettify.js" type="text/javascript"></script>
 <script type="text/javascript">
	KindEditor.ready(function(K) {
		var editor1 = K.create('textarea[name="content"],textarea[name="parameter"],textarea[name="parameter2"]', {
			cssPath          : '/23mlg/public/kindedit/plugins/code/prettify.css',
			uploadJson       : '<?php echo U("Fileupload/editorUpload");?>',
			fileManagerJson  : '/23mlg/public/kindedit/php/file_manager_json.php',
			allowFileManager : true,
			afterCreate : function() {
			  var self = this;
			  K.ctrl(document, 13, function() {
				self.sync();
				K('form[name=example]')[0].submit();
			  });
			  K.ctrl(self.edit.doc, 13, function() {
				self.sync();
				K('form[name=example]')[0].submit();
			  });
			}
		});
		prettyPrint();
	    $('#meituxiuxiumodal').on('hidden.bs.modal', function (e) {
		  var pic = $("#meitupic").val();
		  if ( pic !='' ) {
		    editor1.insertHtml('<img src="/23mlg/public/kindedit/attached/image/'+pic+'" alt="">');
			$("#meitupic").val('');
		  }
		});
	});
 </script><?php endif; ?>

</body>
</html>