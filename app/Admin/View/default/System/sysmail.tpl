<extend name="public/common" />
<block name="main">
 <div class="pubmain">
  <h1><div class="pull-left">
   {:btn(array('vals'=>'系统设置','size'=>3,'icon'=>'cog','scene'=>'default','url'=>U('system/sysmod')))}
   {:btn(array('vals'=>'公司设置','size'=>3,'icon'=>'map-marker','scene'=>'default','url'=>U('system/syscompany')))}
   {:btn(array('vals'=>'水印设置','size'=>3,'icon'=>'tint','scene'=>'default','url'=>U('system/syswater')))}
   {:btn(array('vals'=>'上传设置','size'=>3,'icon'=>'paperclip','scene'=>'default','url'=>U('system/sysupload')))}
   {:btn(array('vals'=>'邮件设置','size'=>3,'icon'=>'envelope','scene'=>'primary','url'=>U('system/sysmail')))}
  </div></h1>
  <form name="sysmailset" method="post" action="">
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="{:tabstyle()}">
      <tr>
        <td width="15%" height="30" align="left" valign="middle">参数说明</td>
        <td height="30" align="left" valign="middle">参数值</td>
      </tr>
      <tr>
        <td width="10%" height="25" align="left" valign="middle">发送方式</td>
        <td height="25" align="left" valign="middle">通过（SMTP/POP3）协议发送 <span class="full999">（ 默认 ）</span></td>
      </tr>
      <tr>
        <td height="25" align="left" valign="middle">系统检测<br/><span class="full999" style="font-size:11px;">需要的支持 mail 函数</span></td>
        <td height="25" align="left" valign="middle">
         mail扩展<font class="text-success"> (<if condition="$ismail eq 1"><img src="__img__/yes.gif"><else/><img src="__img__/no.gif"></if>)</font>
        </td>
      </tr>
      <tr>
        <td height="25" align="left" valign="middle">
        邮件服务器<br/>
        <span class="full999" style="font-size:11px;">SMTP服务器，<br/>只有正确设置才能使用发邮件功能<br/></span>
        </td>
        <td height="25" align="left" valign="middle">
        <input type="text" value="{$data['mailsmtp']}" style="width:200px" name="mailsmtp" class="text"{:tooltip('qq邮箱:smtp.qq.com<br>163邮箱：smtp.163.com<br>gmail邮箱：smtp.gmail.com','top',2)} /></td>
      </tr>
      <tr>
        <td height="25" align="left" valign="middle">
        邮件发送端口<br/>
        <span class="full999" style="font-size:11px;">默认为25，一般无需更改</span>
        </td>
        <td height="25" align="left" valign="middle"><input type="text" value="{$data['mailport']}" name="mailport" class="textsort" /></td>
      </tr>
      <tr>
        <td height="25" align="left" valign="middle">
        邮箱帐号<br/>
        <span class="full999" style="font-size:11px;">SMTP服务器的用户帐号(完整的电子邮件地址如user@domain.com)，只有正确设置才能使用发邮件功能</span>
        </td>
        <td height="25" align="left" valign="middle">{:input(array('name'=>'mailname','val'=>$data['mailname'],'width'=>20,'icon'=>'envelope','tips'=>'请输入系统邮件地址','place'=>'请输入系统邮件地址'))}</td>
      </tr>
      <tr>
        <td height="25" align="left" valign="middle">邮箱密码</td>
        <td height="25" align="left" valign="middle"><input type="password" value="{$data['mailpass']}" name="mailpass" class="text" style="width:200px" /></td>
      </tr>
      <tr>
        <td height="25" align="left" valign="middle">邮件设置测试<br/><span class="full999" style="font-size:11px;">请填写接受测试的邮件地址</span> </td>
        <td height="25" align="left" valign="middle">
         <input type="text" value="" name="mailtest" class="text mailtest" style="width:200px" />&nbsp;&nbsp;&nbsp;
         <?php echo '<a href="javascript:void(0)" class="sendmail">'.btn(array('vals'=>'发送测试邮件','icon'=>'envelope','scene'=>'primary','tips'=>'点击发送系统测试邮件，检测邮件服务器是否调试正常')).'</a>';?>
        </td>
      </tr>
      <tr>
        <td height="25" align="left" valign="middle">设置须知</td>
        <td height="25" align="left" valign="middle">您填写的账号必须开启 SMTP/POP3 服务</td>
      </tr>
      <tr>
        <td height="25" align="left" valign="middle">保存</td>
        <td height="35" align="left" valign="middle">{:btn(array('vals'=>'确定保存','size'=>3,'type'=>'submit','icon'=>'cog','scene'=>'primary'))}</td>
      </tr>
    </table>
    </form>
 </div>
 <script type="text/javascript">
  $(".sendmail").click(function(e) {
    var mail = $.trim($(".mailtest").val());
	if(mail==''){
	  swal('请填写接受测试的邮件地址','例如：bh@jxbht.com','error');
	  return false;
	}else{
	  var mailreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/; /*邮箱正则*/
	  if(!mailreg.test(mail)){swal('请填写正确的邮件地址..','例如：bh@jxbht.com','error');return false;}
	  var _this = $(this);
	  _this.find(".btn-primary").html('<span class="glyphicon glyphicon-envelope"></span> 邮件发送中..').addClass("disabled");
	  $.post( "{:U('admin/mailtest')}", {'mail':mail},function(data){
		  var data = eval("(" + data + ")");
		  _this.find(".btn-primary").html('<span class="glyphicon glyphicon-envelope"></span> 发送测试邮件').removeClass("disabled");
		  if(data==1){
			swal('测试邮件发送成功..','请登录您的邮箱查看','success');return false;
		  }else if(data==0){
			swal('测试邮件发送失败..','请修改您的邮箱配置，重新试试吧','error');return false;
		  }else{
			swal(data,'','error');return false;
		  }
	  },'json');
	}
  });
 </script>
</block>