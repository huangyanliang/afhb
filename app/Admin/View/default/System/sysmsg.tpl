<extend name="public/common" />
<block name="main">
 <div class="pubmain">
  <h1>短信服务器设置</h1>
  <form name="sysmailset" method="post" action="">
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="{:tabstyle()}">
      <tr>
        <td width="10%" height="30" align="left" valign="middle">参数说明</td>
        <td height="30" align="left" valign="middle">参数值</td>
      </tr>
      <tr>
        <td height="25" align="left" valign="middle">您的账号</td>
        <td height="25" align="left" valign="middle">{:input(array('icon'=>'user','width'=>25,'place'=>'您的账号','name'=>'msguser','val'=>$data['msguser'],'tips'=>'输入短信账号'))}</td>
      </tr>
      <tr>
        <td height="25" align="left" valign="middle">账号密码</td>
        <td height="25" align="left" valign="middle">{:input(array('faicon'=>'unlock','type'=>'password','width'=>25,'place'=>'账号密码','name'=>'msgpass','val'=>$data['msgpass'],'tips'=>'输入短信密码'))}</td>
      </tr>
      <tr>
        <td height="25" align="left" valign="middle">短信尾巴<br/>说明：出现在短信尾部<br/>例如：明良广</td>
        <td height="25" align="left" valign="middle">{:input(array('faicon'=>'commenting','width'=>25,'place'=>'短信尾巴','name'=>'msgsuff','val'=>$data['msgsuff'],'tips'=>'输入短信尾巴，出现在短信尾部'))}</td>
      </tr>
      <tr>
        <td height="25" align="left" valign="middle">短信设置测试<br/><span class="full999" style="font-size:11px;">请填写接受测试的手机号码</span> </td>
        <td height="25" align="left" valign="middle">
         <input type="text" value="" name="phonetest" class="text phonetest" style="width:220px" />&nbsp;&nbsp;&nbsp;
         <?php echo '<a href="javascript:void(0)" class="sendphone">'.btn(array('vals'=>'发送测试短信','faicon'=>'commenting','scene'=>'primary','tips'=>'点击发送系统测试短信，检测短信服务器是否调试正常')).'</a>';?>
        </td>
      </tr>
      <tr>
        <td height="25" align="left" valign="middle"></td>
        <td height="35" align="left" valign="middle">{:btn(array('vals'=>'确定保存','size'=>3,'type'=>'submit','icon'=>'cog','scene'=>'primary'))}</td>
      </tr>
    </table>
    </form>
 </div>
 <script type="text/javascript">
  $(".sendphone").click(function(e) {
    var phone = $.trim($(".phonetest").val());
	if(phone==''){
	  swal('请填写接受测试的手机号码','','error');
	  return false;
	}else{
	  var phonereg = /^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/;
	  if(!phonereg.test(phone)){swal('请填写正确的手机号码..','','error');return false;}
	  var _this = $(this);
	  _this.find(".btn-primary").html('<span class="fa fa-spinner fa-spin"></span> 短信发送中..').addClass("disabled");
	  $.post( "{:U('admin/phonetest')}", {'phone':phone},function(data){
		  _this.find(".btn-primary").html('<span class="fa fa-commenting"></span> 发送测试短信').removeClass("disabled");
		  if(data==1){
			swal('测试短信发送成功..','请查看您的手机','success');return false;
		  }else if(data==0){
			swal('测试短信发送失败..','请修改您的系统配置，重新试试吧','error');return false;
		  }else{
			swal(data,'','error');return false;
		  }
      },'json'); 
	}
  });
 </script>
</block>