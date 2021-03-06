<extend name="default/public/common" />
<block name="main">
 <div class="pubmain">
  <h1>资料编辑</h1>
  <form name="adminform" method="post" action="" onSubmit="return sysabout(document.adminform)">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="{:tabstyle()}">
   <tr>
    <td width="10%" height="32" align="right" valign="middle">资料标题：</td>
    <td height="32" align="left">{:input(array('name'=>'topic','scene'=>'topic','val'=>$data['topic'],'tips'=>'资料标题（*必填）'))}</td>
   </tr>
   <tr>
    <td width="10%" height="32" align="right" valign="middle">资料配图：</td>
    <td height="32" align="left">{:uppic(array('pic'=>$data['pic'],'tips'=>'没有要求可以不用上传。'))}</td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">资料简介：</td>
     <td height="32" align="left">{:input(array('name'=>'intro','val'=>$data['intro'],'type'=>'textarea','place'=>'资料简介，若不填写，自动截取资料详情里面的内容！'))}</td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">资料内容：</td>
     <td height="32" align="left">{:input(array('name'=>'content','val'=>$data['content'],'type'=>'editor'))}</td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">关键词：</td>
     <td height="32" align="left">{:input(array('name'=>'keyword','val'=>$data['keyword'],'scene'=>'key'))}</td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">页面描述：</td>
     <td height="32" align="left">{:input(array('name'=>'metades','val'=>$data['metades'],'scene'=>'des'))}</td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">是否启用：</td>
     <td height="32" align="left">{:checkbox($data['enabled'])} <span class="text-warning"> 注：勾选表示启用</span></td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">资料排序：</td>
     <td height="32" align="left">{:input(array('name'=>'ord','val'=>$data['ord'],'scene'=>'ord'))}</td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">&nbsp;
     <input type="hidden" value="{$tables}" name="tables">
     <input type="hidden" value="{$data['sty']}" name="sty">
     <input type="hidden" value="{$data['Id']}" name="id">
     </td>
     <td height="32" align="left">{:btn(array('vals'=>'确定修改','size'=>3,'type'=>'submit','icon'=>'cog','scene'=>'primary'))}</td>
   </tr>
  </table>
  </form>
 </div>
</block>