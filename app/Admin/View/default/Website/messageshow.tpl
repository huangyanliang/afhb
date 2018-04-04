<extend name="default/public/common" />
<block name="main">
 <div class="pubmain">
  <h1>查看留言信息</h1>
  <form name="adminform" method="post" action="" onSubmit="return sysabout(document.adminform)">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="{:tabstyle()}">
   <tr>
     <td height="32" align="right" valign="middle">留言姓名：</td>
     <td height="32" align="left">{$data['user']}</td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">手机号码：</td>
     <td height="32" align="left">{$data['phone']}</td>
   </tr>
   <tr>
    <td width="10%" height="32" align="right" valign="middle">留言标题：</td>
    <td height="32" align="left">{:input(array('name'=>'topic','scene'=>'topic','val'=>$data['topic']))}</td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">留言内容：</td>
     <td height="32" align="left">{:input(array('type'=>'textarea',name=>'intro','val'=>$data['content']))}</td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">留言时间：</td>
     <td height="32" align="left">{$data['date']}</td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">是否处理：</td>
     <td height="32" align="left">{:checkbox($data['enabled'])} <span class="text-warning"> 注：勾选表示处理</span></td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">留言IP：</td>
     <td height="32" align="left">{$data['ip']}</td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">&nbsp;</td>
     <input type="hidden" value="{$data['Id']}" name="id">
     <td height="32" align="left">{:btn(array('vals'=>'处理留言','size'=>3,'type'=>'submit','icon'=>'comment','scene'=>'primary'))}</td>
   </tr>
  </table>
  </form>
 </div>
</block>