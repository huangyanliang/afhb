<extend name="default/public/common" />
<block name="main">
 <div class="pubmain">
  <h1>客服编辑</h1>
  <form name="adminform" method="post" action="" onSubmit="return sysonline(document.adminform)">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="{:tabstyle()}">
   <tr>
    <td width="10%" height="32" align="right" valign="middle">客服名称：</td>
    <td height="32" align="left">{:input(array('name'=>'topic','icon'=>'user','width'=>20,'val'=>$data['topic'],'tips'=>'客服名称（*必填）'))}</td>
   </tr>
   <tr>
    <td width="10%" height="32" align="right" valign="middle">客服账号：</td>
    <td height="32" align="left">{:input(array('name'=>'amount','icon'=>'user','place'=>'QQ号码','width'=>20,'val'=>$data['amount'],'tips'=>'客服账号（*必填）'))}</td>
   </tr>
   <tr class="hide">
    <td width="10%" height="32" align="right" valign="middle">微信号码：</td>
    <td height="32" align="left">{:input(array('name'=>'weixin','icon'=>'qrcode','width'=>20,'val'=>$data['weixin'],'tips'=>'微信号码'))}</td>
   </tr>
   <tr class="hide">
    <td width="10%" height="32" align="right" valign="middle">手机号码：</td>
    <td height="32" align="left">{:input(array('name'=>'phone','icon'=>'phone','width'=>20,'val'=>$data['phone'],'tips'=>'手机号码'))}</td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">是否启用：</td>
     <td height="32" align="left">{:checkbox($data['enabled'])} <span class="text-warning"> 注：勾选表示启用</span></td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">客服排序：</td>
     <td height="32" align="left">{:input(array('name'=>'ord','val'=>$data['ord'],'scene'=>'ord'))}</td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">&nbsp;
     <input type="hidden" value="{$tables}" name="tables">
     <input type="hidden" value="{$data['Id']}" name="id">
     </td>
     <td height="32" align="left">{:btn(array('vals'=>'确定修改','size'=>3,'type'=>'submit','icon'=>'cog','scene'=>'primary'))}</td>
   </tr>
  </table>
  </form>
 </div>
</block>