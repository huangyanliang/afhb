<extend name="default/public/common" />
<block name="main">
 <div class="pubmain">
  <h1>词汇过滤设置</h1>
   <form name="sysmod" method="post" action="">
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" class="{:tabstyle()}">
      <tr>
        <td width="10%" height="30" align="left" valign="middle">参数说明</td>
        <td height="30" align="left" valign="middle">参数值</td>
      </tr>
      <tr>
        <td width="10%" height="25" align="left" valign="middle">替换词语:<br/> <span class="full999" style="font-size:11px;">（词语会被替换成***）用|分开<br/> 但不要在结尾加</span></td>
        <td height="25" align="left" valign="middle">
        {:input(array('name'=>'wordfilter','val'=>$data['wordfilter'],'type'=>'textarea'))}
        </td>
      </tr>
      <tr>
        <td height="35" align="left" valign="middle">保存</td>
        <td height="35" align="left" valign="middle">{:btn(array('vals'=>'确定保存','size'=>3,'type'=>'submit','icon'=>'cog','scene'=>'primary'))}</td>
      </tr>
    </table>
    </form>
 </div>
</block>