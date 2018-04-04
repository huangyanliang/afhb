  <notempty name="upload">
    <div class="modal fade bh-picture" id="bh-picture">
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
                  <php>
                   $filelist = D('File')->getfilepath();
                   if ( $filelist ) {
                     foreach( $filelist as $fkey=>$fval ) {
                       echo '<a href="javascript:void(0)" class="list-group-item picture-litype" data-path="'.$fval['file'].'">'.$fval['file'].' <span class="badge">'.$fval['count'].'</span></a>';
                     }
                   }
                   $piclist  = D('File')->getpic();
                  </php> 
                </div> 
                </div>
              </div>
              
              <div class="col-md-10 col-sm-9 col-xs-8 picture-main">
                <div style="height:auto; overflow:hidden;">
                <div class="picture-mblock">
                <php>
                 if ( count($piclist['sdata']) > 0 ) {
                   foreach( $piclist['sdata'] as $pkey=>$pval ) {
                     echo ($pval['spic']!='') ? '<div class="picdiv picture-fname" data-path="'.$pval['spic'].'"><img src="'.ispic($pval['spic']).'" data-action="zooms"><p title="'.$pval['pic'].'">'.$pval['pic'].'</p><div class="pic-active"></div></div>' : '';
                   }
                 }
                </php>
                </div>
                <div style=" height:10px; clear:both;"></div>
                <div class="picture-pagelist">{$piclist['pagelist']}</div>
              </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="pull-left"><div class="up-progress" style="margin:10px auto;"><div class="up-bar"></div></div></div>
            <input type="hidden" value="" id="picture-file">
            <input type="hidden" value="" id="picture-path">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{:icon("off")} 关闭</button>
            <button type="button" class="btn btn-primary btn-sm btn-choice-picture">{:icon("picture")} 选择图片</button>
          </div>
        </div>
      </div>
      <script src="__js__/jqthumb.js" type="text/javascript"></script>
      <script>
	   $(".picture-mblock img").jqthumb({width:128,height:128,classname:'jqthumb'});
	   $('.picture-sidebar').perfectScrollbar();
	   $('.picture-main').perfectScrollbar();
      </script>
    </div>
 </notempty>
 
 <script src="__js__/bootstrap.min.js" type="text/javascript"></script>
 <script src="__js__/alert.min.js" type="text/javascript"></script>
 <script src="__js__/common.js" type="text/javascript"></script>
 <script src="__js__/zoom.js" type="text/javascript"></script>
 <notempty name="upload">
 <link href="__css__/cropper.css" rel="stylesheet">
 <script src="__upload__/uploadify.js" type="text/javascript" ></script>
 <script src="__js__/cropper.min.js" type="text/javascript" ></script>
 </notempty>
 <notempty name="formpic">
 <script src="__js__/jquery.form.js" type="text/javascript" ></script>
 </notempty>
 <notempty name="color">
 <script src="__js__/color.js" type="text/javascript"></script>
 <link href="__css__/color.css" rel="stylesheet">
 <script type="text/javascript">
  $(document).ready( function() {
	$('.colorselect').each( function() {
		$(this).minicolors({
			theme: 'bootstrap'
		});
	});
   });
 </script>
 </notempty>
 <script type="text/javascript">
  var img     = '__img__';
  var abspath = '__MODULE__';
  var upload  = '__upload__';
  var upfile  = '__upfile__';
  $(function () {
    $('[data-toggle="tooltip"]').tooltip({container : 'body'});
    $('[data-toggle="popover"]').popover({html:true,container:'body',trigger:'focus',title:'','placement':'right'});
	$('input').iCheck({checkboxClass: 'icheckbox_minimal',radioClass: 'iradio_minimal',increaseArea: '20%'});
  });
 </script>
 <notempty name="date">
 <script src="__js__/date.js" type="text/javascript"></script>
 </notempty>
 <notempty name="editor">
 <div class="modal fade" id="meituxiuxiumodal" tabindex="-1" role="dialog" data-url="{:U('Fileupload/meituxiuxiu')}">
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
 
 <link rel="stylesheet" href="__editor__/themes/default/default.css" />
 <link rel="stylesheet" href="__editor__/plugins/code/prettify.css" />
 <script charset="utf-8" src="__editor__/kindeditor.js" type="text/javascript"></script>
 <script charset="utf-8" src="__editor__/lang/zh_CN.js" type="text/javascript"></script>
 <script charset="utf-8" src="__editor__/plugins/code/prettify.js" type="text/javascript"></script>
 <script type="text/javascript">
	KindEditor.ready(function(K) {
		var editor1 = K.create('textarea[name="content"],textarea[name="parameter"],textarea[name="parameter2"]', {
			cssPath          : '__editor__/plugins/code/prettify.css',
			uploadJson       : '{:U("Fileupload/editorUpload")}',
			fileManagerJson  : '__editor__/php/file_manager_json.php',
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
		    editor1.insertHtml('<img src="__editor__/attached/image/'+pic+'" alt="">');
			$("#meitupic").val('');
		  }
		});
	});
 </script>
 </notempty>
