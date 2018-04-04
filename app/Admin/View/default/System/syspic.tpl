<extend name="default/public/common" />
<block name="main">
 <div class="pubmain">
   <h1>图片管理
  <div class="pull-right">
   {:btn(array('vals'=>'','size'=>3,'icon'=>'th-list','scene'=>$scene[0],'url'=>U('system/syspic','act=1')))}
   {:btn(array('vals'=>'','size'=>3,'icon'=>'th','scene'=>$scene[1],'url'=>U('system/syspic','act=2')))}
   {:btn(array('vals'=>'','size'=>3,'icon'=>'folder-open','scene'=>$scene[2],'url'=>U('system/syspic','act=3')))}
   {:btn(array('vals'=>'统计','size'=>3,'icon'=>'signal','scene'=>'default','tips'=>'统计文件夹内上传文件大小，文件夹数量，文件数量','dir'=>'bottom','add'=>'mysignal'))}
  </div></h1>
  <if condition="$act eq 1">
  <form name="publist" method="post" action="{:U('system/sysdelpic')}" onSubmit="return pubdel(document.publist)">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="{:tabstyle()}">
   <tr class="active">
     <td width="45" align="center" valign="middle" height="30">{:ckall('top')}</td>
     <td width="35%" align="left" valign="middle">文件夹/图片名称</td>
     <td width="100" align="left" valign="middle">大小</td>
     <td width="150" align="left" valign="middle">上传时间</td>
     <td width="80" align="left" valign="middle">是否冗余</td>
     <td align="left" valign="middle">查看</td>
   </tr>
   <volist name="data" id="obj">
   <if condition="$obj['isou'] eq 1">
   <tr class="maintr">
   <else/>
   <tr class="maintr info">
   </if>
    <td align="center" valign="middle" height="25">
    <if condition="$obj['isou'] eq 1">
     {:ckbox($obj['pic'],$i-1,0,1)}
    <else/>
     {:ckbox($obj['pic'],$i-1,1)}
    </if>
    </td>
    <td align="left" valign="middle">{$obj['spic']}</td>
    <td align="left" valign="middle">{$obj['size']}</td>
    <td align="left" valign="middle">{$obj['time']}</td>
    <td align="left" valign="middle">
     <if condition="$obj['isou'] eq 1">
      <font color="green">正常</font>
     <else/>
      <font color="red">冗余</font>
     </if>
    </td>
    <td align="left" valign="middle">
     <div class="zomm-pic"><img src="__ROOT__/{$obj['pic']}" data-action="zoom"></div>
    </td>
   </tr>
   </volist>
   <tr>
    <td align="center" valign="middle">{:ckall()}</td>
    <td height="35" align="left" valign="middle" colspan="5">
	 {:btn(array('vals'=>'删除','type'=>'submit','icon'=>'trash','name'=>'deldata','scene'=>'danger'))}&nbsp;
     <font class="text-warning">&nbsp;{:icon('warning-sign')} 提示，任何图片删除都无法找回，建议只删除冗余的图片！</font>
     {$dshow['pageshow']}
    </td>
   </tr>
  </table>
  </form>
  </if>
  
  <if condition="($act eq 2) OR ($act eq 4)">
  <form name="publist" method="post" action="{:U('system/sysdelpic')}" onSubmit="return pubdel(document.publist)">
  <volist name="data" id="obj">
      <div class="syspicshow">
       <div class="sysmypic"><img src="__ROOT__/{$obj['pic']}" class="img-thumbnail" data-action="zoom"></div>
       <div class="sysmypic-foot">
	     <if condition="$obj['isou'] eq 1">
          <font color="green">正常</font>  {:ckbox($obj['pic'],$i-1,0,1)}
         <else/>
          <font color="red">冗余</font>  {:ckbox($obj['pic'],$i-1,1)}
         </if>
       </div>
      </div>
  </volist>
  <div style="height:10px; clear:both;"></div>
  <div class="delmostdiv" style="margin:5px auto 0px 10px; clear:both;">
   {:ckall($type='bottom').btn(array('vals'=>'选中删除','type'=>'submit','size'=>3,'icon'=>'trash','name'=>'deldata','scene'=>'danger'))}
   {$dshow['pageshow']}
  </div>
  </form>
  </if>
  
  <if condition="$act eq 3">
   <volist name="file" id="fobj">
    <if condition="$fobj['count'] eq 0">
    <a href="javascript:void(0)">
    <else/>
    <a href="{:U('system/syspic','act=4&path='.$fobj['file'])}">
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
</block>