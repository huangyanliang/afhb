<extend name="default/public/common" />
<block name="main">
 <div class="pubmain">
 <h1>修改密码</h1>
 <form name="adminform" method="post" action="" onSubmit="return modpass(document.adminform)">
 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="{:tabstyle()}" style="margin:10px auto;">
   <tr>
    <td width="10%" height="32" align="right" valign="middle">登录ID：</td>
    <td height="32" align="left">{:input(array('name'=>'user','val'=>$adminauth['adminuser'],'icon'=>'user','disabled'=>1,'width'=>18))}</td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">登录密码：</td>
     <td height="32" align="left">{:input(array('type'=>'password','name'=>'pass','icon'=>'log-out','place'=>'请输入您当前的登录密码','width'=>30,'tips'=>'长度大于6位，支持大小写'))}</td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">新密码：</td>
     <td height="32" align="left">{:input(array('type'=>'password','name'=>'newpass','icon'=>'log-out','place'=>'请输入您的新密码','width'=>30,'tips'=>'长度大于6位，支持大小写'))}</td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">确认新密码：</td>
     <td height="32" align="left">{:input(array('type'=>'password','name'=>'notpass','icon'=>'log-out','place'=>'请输入确认新密码','width'=>30,'tips'=>'长度大于6位，支持大小写'))}</td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">&nbsp;</td>
     <td height="32" align="left">{:btn(array('vals'=>'修改密码','size'=>3,'type'=>'submit','icon'=>'edit','scene'=>'primary'))}</td>
   </tr>
 </table>
 </form>
 </div>
 <script type="text/javascript">
  function modpass(td){
   if(td.pass.value.length<6){swal('请输入登录密码','不的少于6位','error');return false;}
   if(td.newpass.value.length<6){swal('请输入新密码','不的少于6位','error');return false;}
   if(td.newpass.value!=td.notpass.value){swal('密码与确认密码不一致','请重新输入','error');return false;}
  }
 </script>
</block>