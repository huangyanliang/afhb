<extend name="default/public/common" />
<block name="main">
 <div class="pubmain">
 <h1>{$systitle}管理<div class="pull-right">{:btn(array('vals'=>'添加'.$systitle,'size'=>3,'icon'=>'plus','scene'=>'primary','url'=>U('website/linksadd','sty='.$sty.'&tables='.$dshow['table'])))}</div></h1>
 <if condition="$data neq ''">
 <form name="publist" method="post" action="" onSubmit="return pubdel(document.publist)">
 <table width="99%" border="0" cellspacing="0" cellpadding="0" align="center" class="{:tabstyle()}">
   <tr class="active">
     <td width="45" align="center" valign="middle" height="37">{:ckall()}</td>
     <td width="60" align="left" valign="middle">序号</td>
     <td align="left" valign="middle">{$subtitle}名称</td>
     <td width="260" align="left" valign="middle">{$subtitle}地址</td>
     <td width="100" align="center" valign="middle">{$subtitle}排序</td>
     <td width="120" align="center" valign="middle">是否启用</td>
     <td width="100" align="center" valign="middle">更新日期</td>
     <td width="100" align="center" valign="middle">操作</td>
   </tr>
   <volist name="data" id="obj">
   <tr class="maintr">
    <td align="center" valign="middle" height="37">{:ckbox($obj['Id'],$i-1)}</td>
    <td align="left" valign="middle">{$dshow['pageno']+$i}</td>
    <td align="left" valign="middle">{:modField($obj['topic'],$obj['Id'],'topic',$dshow['table'])}</td>
    <td align="left" valign="middle">{:modField($obj['linkurl'],$obj['Id'],'linkurl',$dshow['table'])}</td>
    <td align="center" valign="middle">{:modord($obj['ord'],$obj['Id'],$dshow['table'])}</td>
    <td align="center" valign="middle">{:modattr($obj['Id'],$obj['enabled'],$dshow['table'])}</td>
    <td align="center" valign="middle">{:showdate($obj['date'])}</td>
    <td align="center" valign="middle">{:btn(array('vals'=>'编辑','icon'=>'edit','tips'=>'点击编辑数据','url'=>U('website/linksmod','id='.$obj['Id'].'&tables='.$dshow['table'])))}</td>
   </tr>
   </volist>
   <tr>
    <td height="37" align="center" valign="middle">{:ckall()}</td>
    <td height="35" colspan="7" align="left" valign="middle">
    {:btn(array('vals'=>'删除','type'=>'submit','name'=>'deldata','icon'=>'trash','scene'=>'danger'))}
    <font class="text-warning">&nbsp;{:icon('warning-sign')} 提示，任何形式删除的数据都无法找回，请谨慎操作！</font>
    {$dshow['pageshow']}
    </td>
   </tr>
   </table>
   </form>
   <else/>
    <div class="alert alert-danger">暂无留言数据。</div>
   </if>
 </div>
</block>