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
 
</head>
<body>

 <div class="pubmain">
 <h1>后台管理中心 </h1> 
 <div class="success-div text-success bg-success">
  &nbsp;<?php echo icon('cog');?>&nbsp;&nbsp;系统提示：如果您长时间不使用系统，但是又不想退出系统，您可以点击 <a href="javascript:void(0)" class="lockscreen"><?php echo faicon('lock');?> 锁屏</a> 锁定屏幕！
 </div>
 <div class="success-div text-success bg-success">
  &nbsp;<?php echo icon('cog');?>&nbsp;&nbsp;系统提示：当您新增或者修改了数据信息时，请点击 <a href="<?php echo U('index/cleancache');?>"><?php echo icon('trash');?> 清除缓存</a> ，删除掉系统缓存，保证前台显示最新的数据。
 </div>
 <div class="success-div text-success bg-success">
  &nbsp;<?php echo icon('cog');?>&nbsp;&nbsp;系统提示：了解后台管理系统特性及版本更新详情 <a href="javascript:void(0)" data-toggle="modal" data-target="#useit"><?php echo icon('question-sign');?> 请点击</a> 这里。
 </div>
 <?php if($sysInfo['backupcount'] > 0): ?><div class="success-div text-success bg-success">
  &nbsp;<?php echo icon('info-sign');?>&nbsp;&nbsp;您有 <?php echo ($sysInfo['backupcount']); ?> 条数据库备份信息，建议您定时<a href="<?php echo U('system/databackup');?>"><?php echo icon('trash');?> 备份</a> 您的数据库信息，您上次备份数据的时间为 <?php echo ($sysInfo['backuptime']); ?>。
 </div><?php endif; ?>
 <?php if($c_site == 1): ?><div class="warning-div text-warning bg-warning">
  &nbsp;<?php echo icon('alert');?>&nbsp;&nbsp;您的网站项目处于关闭状态。点击 <?php echo btn(array('vals'=>'设置','icon'=>'cog','scene'=>'primary','url'=>U('system/sysmod')));?> 去开启项目。
 </div><?php endif; ?>
 <?php if($sysInfo['tcache'] == 0): ?><div class="warning-div text-warning bg-warning">
   &nbsp;<?php echo icon('alert');?>&nbsp;&nbsp;您的网站的模板编译缓存未开启，建议更改配置文件的 TMPL_CACHE_ON 参数。
  </div><?php endif; ?>
 <?php if($sysInfo['debug'] == 1): ?><div class="warning-div text-warning bg-warning">
   &nbsp;<?php echo icon('alert');?>&nbsp;&nbsp;您的网站程序DEBUG已经启用，建议更改配置文件的 SHOW_PAGE_TRACE 参数。
  </div><?php endif; ?>
 <?php if(APP_DEBUG == 1): ?><div class="warning-div text-warning bg-warning">
  &nbsp;<?php echo icon('alert');?>&nbsp;&nbsp;您的网站程序处于开发状态，建议更改单入口文件的 APP_DEBUG 参数。
 </div><?php endif; ?>

 <?php if($sysInfo['loginwarning'] != ''): ?><div class="warning-div text-warning bg-warning">
  &nbsp;<?php echo icon('alert');?>&nbsp;&nbsp;<?php echo ($sysInfo['loginwarning']); ?>
 </div><?php endif; ?> 
 
 <?php if($sysInfo['passWarning'] != ''): ?><div class="warning-div text-warning bg-warning">
  &nbsp;<?php echo icon('alert');?>&nbsp;&nbsp;<?php echo ($sysInfo['passWarning']); ?>
 </div><?php endif; ?>
 
 <div class="modal fade" id="useit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius:0;">
      <div class="modal-body">
      <!-----> 
      <div>
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#instructions" aria-controls="instructions" role="tab" data-toggle="tab"><?php echo icon('wrench');?> 使用说明</a></li>
        <li role="presentation"><a href="#updatelog" aria-controls="updatelog" role="tab" data-toggle="tab"><?php echo icon('list-alt');?> 更新日志</a></li>
        <li role="presentation"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab"><?php echo icon('map-marker');?> 联系我们</a></li>
        <li role="presentation"><a href="#bug" aria-controls="bug" role="tab" data-toggle="tab"><?php echo faicon('bug');?> BUG反馈</a></li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="instructions">
          <blockquote class="use">
            <p style=" color:#666; font-size:15px;">使用说明<?php echo ($sysInfo['admin_ver']); ?></p>
            <ul>
             <li><a href="<?php echo U('System/databackup');?>">A：数据库备份及下载(建议有重要数据更新之后手动备份数据)</a></li>
             <li><a href="<?php echo U('System/sysmod');?>">B：系统设置</a> / <a href="<?php echo U('System/syswater');?>" data-pic="/23mlg/public/Admin/images/useit/water.png">水印设置</a> / <a href="<?php echo U('System/sysupload');?>" data-pic="/23mlg/public/Admin/images/useit/file.png">上传设置</a></li>
             <li><a href="<?php echo U('System/syspic');?>">C：图片管理器</a></li>
             <li><a href="javascript:void(0)">D：上传图片裁剪</a></li>
             <li><a href="<?php echo U('Index/cleancache');?>"<?php echo tooltip('删除掉系统缓存，保证前台显示最新的数据。');?>>E：缓存清理(删除掉系统缓存，前台显示最新的数据。)</a></li>
             <li><a href="<?php echo U('System/adminauth');?>"<?php echo tooltip('非开发人员不建议使用');?>>F：权限控制</a></li>
            </ul>
          </blockquote>
        </div>
        <div role="tabpanel" class="tab-pane" id="updatelog">
          <blockquote class="updata-log">
            <p style=" color:#63f; font-size:15px;">更新日志<?php echo ($sysInfo['admin_ver']); ?></p>
            <ul>
             <li>1：更新后台管理程序，去除重复代码。</li>
             <li>2：V3.0版后台登录界面/管理界面。</li>
             <li>3：新增 INPUT函数（快速维护，更新输入框风格）。</li>
             <li>4：新增图片裁剪功能（裁剪之后不保留原图）。</li>
             <li>5：新增 附件，图片的上传设置（可以设置服务器上传附件/图片的大小及后缀名称）。</li>
             <li>6：新增列表页面修改基础数据，包括图片，分类，排序，标题。</li>
             <li>7：新增页面统计功能，可在线统计当天的浏览人次/IP/浏览量，平均浏览时间，后台可设置关闭。</li>
             <li>8：新增权限控制，能精细控制后台管理用户的浏览/访问模块。</li>
             <li>9：新增全局日志函数，后台可设置删除日志及查看日志详情。</li>
             <li>10：优化在线客服后台 可设置关闭显示。</li>
             <li>11：优化项目（后台）在IE8,IE9的显示。</li>
             <li>12：优化数据库结构（去除无用的字段，优化字段类型）。</li>
             <li>13：优化批量删除管理员，至少保留一位管理员。</li>
             <li>14：优化访问统计功能，页面加载完毕进行统计，采集。</li>
             <li>15：优化后台冗余图片查询，优化查询非冗余数据，提高管理用户的访问速度。</li>
             <li>16：优化单页可设置关键词及描述。</li>
             <li style="color:#63f;">17：新增Font Awesome字体库，丰富图标库.</li>
             <li style="color:#63f;">18：新增后台目录保护设功能，设置一个您记得住的后台管理地址吧！</li>
             <li style="color:#63f;">19：新增后台部门管理，部门权限可自行选择。</li>
             <li style="color:#63f;">20：新增图片裁剪和图片库功能，您可以直接在图片库里面选择图片。</li>
             <li style="color:#f00;">21：编辑器新增美图秀秀功能插件，您可以直接利用编辑器处理美化拼接图片。</li>
             <li style="color:#f00;">22：编辑器上传的图片可设置裁剪规则，及可以系统设置添加水印。</li>
             <li style="color:#f00;">23：编辑器上传内容设置压缩规则 规则一：按照上传图片的大小判断，规则二根据上传图片的尺寸判断。</li>
             <li style="color:#f00;">23：新增内容简介截取功能，字段获取您编辑器里面非HTML部分的前120个字符的数据..</li>
             <li style="color:#f00;">24：优化访问统计功能，表设计，访问统计统计图去掉 “用户” 线图..</li>
             <li>23：等等...</li>
            </ul>
          </blockquote>
        </div>
        
       </div>
      </div>
      <!----> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?php echo icon('off');?> 关闭</button>
      </div>
    </div>
  </div>
 </div>
 
 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="<?php echo tabstyle();?>" style="margin:10px auto;">
   <tr class="active"><td colspan="4" align="left" valign="middle"><?php echo icon('cog');?> 系统信息</td></tr>
   <tr>
     <td align="left" width="25%" valign="middle" height="25">服务器操作系统：</td>
     <td align="left" width="25%" valign="middle"><?php echo ($sysInfo['os']); ?></td>
     <td align="left" width="25%" valign="middle">Web 服务器：</td>
     <td align="left" width="25%" valign="middle"><?php echo ($sysInfo['web_server']); ?></td>
   </tr>
   <tr>
     <td align="left" valign="middle" height="25">PHP 版本：</td>
     <td align="left" valign="middle" title="(注:请保证您的PHP版本 > 5.3.0 )"><?php echo ($sysInfo['php_ver']); ?></td>
     <td align="left" valign="middle">MySQL 版本：</td>
     <td align="left" valign="middle"><?php echo ($sysInfo['mysql_ver']); ?></td>
   </tr>
   <tr>
     <td align="left" valign="middle" height="25">GD 版本：</td>
     <td align="left" valign="middle"><?php echo ($sysInfo['gd']); ?></td>
     <td align="left" valign="middle">时区设置：</td>
     <td align="left" valign="middle"><?php echo ($sysInfo['timezone']); ?></td>
   </tr>
   <tr>
     <td align="left" valign="middle" height="25">文件上传的最大大小/POST上传最大值：</td>
     <td align="left" valign="middle" title="请在php.ini里面设置这2个值"><?php echo ($sysInfo['max_filesize']); ?> / <?php echo ($sysInfo['post_maxsize']); ?></td>
     <td align="left" valign="middle">Zlib 支持：</td>
     <td align="left" valign="middle"><?php echo ($sysInfo['zlib']); ?></td>
   </tr>
   <tr>
     <td align="left" valign="middle" height="25">语言：</td>
     <td align="left" valign="middle"><?php echo ($sysInfo['language']); ?></td>
     <td align="left" valign="middle">编码：</td>
     <td align="left" valign="middle"><?php echo ($sysInfo['coding']); ?></td>
   </tr>
   <tr>
     <td align="left" valign="middle" height="25">后台版本：</td>
     <td align="left" valign="middle" title="power by thinkphp3.2 and bootstrap 3.0"><?php echo ($sysInfo['admin_ver']); ?></td>
     <td align="left" valign="middle">联系邮箱：</td>
     <td align="left" valign="middle"><!--bh#jxbht.com <a href="javascript:void(0)" title="(注:请把#换成@)">?</a>--></td>
   </tr>
   <tr class="hide">
     <td align="left" valign="middle" height="25">磁盘可用：</td>
     <td align="left" valign="middle"><?php echo ($sysInfo['disk_size']); ?></td>
     <td align="left" valign="middle">&nbsp;</td>
     <td align="left" valign="middle">&nbsp;</td>
   </tr>
  </table> 
 </div>
 <script type="text/javascript">
    $(".lockscreen").click(function(e) {
     var $this = $(this);
	 $this.html('<span class="fa fa-spinner fa-spin"></span> 锁屏中..');
	 $.post('<?php echo U("Admin/lockscreen");?>',{'act':'lock'},function(data){
	   $this.html('<span class="fa fa-lock"></span> 锁屏');
	   if ( data == 1 ) {
	     parent.location.reload();
	   } else {
	     swal(data,'','error');
	   }
	 },'json');
   });
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