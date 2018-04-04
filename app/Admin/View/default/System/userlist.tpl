<extend name="default/public/common" />
<block name="main">
 <div class="pubmain">
 <form name="publist" method="post" action="" onSubmit="return pubdel(document.publist)"> 
 <h1>管理员列表 <div class="pull-right">{:btn(array('vals'=>'添加管理员','size'=>3,'icon'=>'plus','scene'=>'primary','url'=>U('system/useradd')))}</div></h1>
  <table width="99%" border="0" cellspacing="0" cellpadding="0" align="center" class="{:tabstyle()}">
   <tr class="active">
     <td width="45" align="center" valign="middle" height="37">{:ckall()}</td>
     <td width="100" align="left" valign="middle">管理员ID</td>
     <td width="160" align="left" valign="middle">管理员姓名</td>
     <td width="120" align="left" valign="middle">所属部门</td>
     <td width="120" align="center" valign="middle">登录次数</td>
     <td width="120" align="center" valign="middle">最后登录IP</td>
     <td width="160" align="center" valign="middle">最后登录时间</td>
     <td align="left" valign="middle">操作</td>
   </tr>
   <volist name="data" id="obj">
   <tr class="maintr">
    <td align="center" valign="middle" height="37">{:ckbox($obj['Id'],$i-1)}</td>
    <td align="left" valign="middle">{$obj['user']}</td>
    <td align="left" valign="middle">{$obj['realname']}</td>
    <td align="left" valign="middle">{:gtopic('admindepartment',$obj['depid'],'topic','--')}</td>
    <td align="center" valign="middle">{$obj['count']}</td>
    <td align="center" valign="middle">{$obj['last_ip']?:'未登录'}</td>
    <td align="center" valign="middle">{$obj['last_time']?:'未登录'}</td>
    <td align="left" valign="middle">{:btn(array('vals'=>'编辑','icon'=>'edit','tips'=>'点击编辑数据','url'=>U('system/usermod','id='.$obj['Id'])))}</td>
   </tr>
   </volist>
   <tr>
    <td height="37" align="center" valign="middle">{:ckall()}</td>
    <td height="35" colspan="7" align="left" valign="middle">
    {:btn(array('vals'=>'删除','type'=>'submit','name'=>'deldata','icon'=>'trash','scene'=>'danger'))}
    <font class="text-warning">&nbsp;{:icon('warning-sign')} 提示，任何形式删除的数据都无法找回，管理员删除，请保证后台至少有一个管理用户！</font>
    {$dshow['pageshow']}
    </td>
   </tr>
   </table>
   </form>
 </div>
</block>