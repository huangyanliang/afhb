<extend name="default/public/common" />
<block name="main">
 <div class="pubmain">
   <h1>日志管理
  <div class="pull-right">
   {:btn(array('vals'=>'','size'=>3,'icon'=>'th-list','scene'=>$scene[0],'url'=>U('system/syslogs','act=1')))}
   {:btn(array('vals'=>'','size'=>3,'icon'=>'folder-open','scene'=>$scene[1],'url'=>U('system/syslogs','act=2')))}
   {:btn(array('vals'=>'统计','size'=>3,'icon'=>'signal','scene'=>'default','tips'=>'统计文件夹内上传文件大小，文件夹数量，文件数量','dir'=>'bottom','add'=>'mysignal'))}
  </div></h1>
  <if condition="$act eq 1">
  <form name="publist" method="post" action="{:U('system/sysdellogs')}" onSubmit="return pubdel(document.publist)">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="{:tabstyle()}">
   <tr class="active">
     <td width="45" align="center" valign="middle" height="30">{:ckall('top')}</td>
     <td width="35%" align="left" valign="middle">文件夹/日志名称</td>
     <td width="100" align="left" valign="middle">大小</td>
     <td width="150" align="left" valign="middle">{:icon('time')} 日志时间</td>
     <td align="left" valign="middle">查看日志</td>
   </tr>
   <volist name="data" id="obj">
   <tr class="maintr">
    <td align="center" valign="middle" height="25">{:ckbox($obj['file'],$i-1)}</td>
    <td align="left" valign="middle">{$obj['file']}</td>
    <td align="left" valign="middle">{$obj['size']}</td>
    <td align="left" valign="middle">{$obj['time']}</td>
    <td align="left" valign="middle"><a href="javascript:void(0)" class="open-logs" data-path="{$obj['file']}">{:btn(array('vals'=>'查看','icon'=>'eye-open','tips'=>'点击查看日志详情'))}</a></td>
   </tr>
   </volist>
   <tr>
    <td align="center" valign="middle">{:ckall()}</td>
    <td height="35" align="left" valign="middle" colspan="4">
	 {:btn(array('vals'=>'删除','type'=>'submit','icon'=>'trash','name'=>'deldata','scene'=>'danger'))}&nbsp;
     <font class="text-warning">&nbsp;{:icon('warning-sign')} 提示，任何日志删除都无法找回，建议只删除日期比较前的日志！</font>
     {$dshow['pageshow']}
    </td>
   </tr>
  </table>
  </form>
  </if>
  <if condition="$act eq 2">
   <volist name="file" id="fobj">
    <if condition="$fobj['count'] eq 0">
      <a href="javascript:void(0)">
    <else/>
      <a href="{:U('system/syslogs','path='.$fobj['file'])}">
    </if>
    <div class="myfolder">
     <div class="myfilenum"><span>{$fobj['count']}</span></div>
     <div class="myicon">{:icon('folder-open')}</div>
     <div class="mytips">{$fobj['file']}</div>
    </div></a>
   </volist>
  </if>
  <div class="filesignal">
   <h2>文件统计 <b>&times;</b></h2>
   <p>统计路径：{:icon('file')}<b>{$upTotal['file']}</b></p>
   <p>目录大小：{:faicon('info')}<b>{$upTotal['size']}</b></p>
   <p>　文件数：{:icon('folder-open')}<b>{$upTotal['count']} 个</b></p>
   <p>　目录数：{:faicon('list')}<b>{$upTotal['dircount']} 个</b></p>
  </div>
  <script type="text/javascript">
    $(".mysignal").click(function(e) {
      if ($(".filesignal").is(":hidden")) {
	    $(".filesignal").show().animate({"right":"10px"},500,function(){});
	  }    
   });
   $(".filesignal h2 b").click(function(e) {
	  $(".filesignal").animate({"right":"-380px"},500,function(){
	    $(".filesignal").hide();
	  });
   });
  </script>
 </div>
 <!--显示-->
  <div class="modal fade" id="codeshow">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius:0;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">日志信息详情</h4>
      </div>
      <div class="modal-body logshow" style="max-height:400px; overflow:auto; width:99%; margin:0px auto; padding:5px;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">{:icon('off')} 关闭</button>
      </div>
    </div>
  </div>
 </div>
 <!--结束-->
 <script type="text/javascript">
  (function ($) {  
    $(".open-logs").click(function(e) {
	  var $this = $(this);
	  $this.find("button").button('loading');
      var path = $(this).data("path");
	  if (!path) return false;
	  $.post( abspath+'/System/showLog', {'path':path},function(data){
	   $this.find("button").button('reset');
	   if (data!='') {
	     $(".logshow").html('<pre style="padding:10px; border-radius:2px;margin:5px;">'+data+'</pre>');
		 $("#codeshow").modal('show');
	   } else {
	     swal('无法读取日志信息','','error');
	   }
	  },'json');
    });
  })(jQuery);  
 </script>
</block>