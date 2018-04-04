<extend name="default/public/common" />
<block name="main">
 <div class="pubmain">
 <h1>广告管理<div class="pull-right">{:btn(array('vals'=>'添加广告','size'=>3,'faicon'=>'plus','scene'=>'primary','url'=>U('system/advadd')))}</div></h1>
 <if condition="$data neq ''">
 <form name="pubserch" method="get" action=""> 
  <div class="search">
   广告名称：<input type="text" class="text" name="topic" placeholder="广告名称" style="width:150px;">
   &nbsp;广告位置：{:dropdown($advtype,0,'选择广告位置','ctag')}
   &nbsp;是否启用：{:dropdown(1,0,'请选择','enabled')}
   <input type="hidden" value="{$dshow['table']}" name="tables">
   &nbsp;{:btn(array('vals'=>'查询','type'=>'submit','icon'=>'search','name'=>'searchdata','line'=>1,'scene'=>'primary'))}
  </div>
  </form>
 <form name="publist" method="post" action="" onSubmit="return pubdel(document.publist)"> 
  <table width="99%" border="0" cellspacing="0" cellpadding="0" align="center" class="{:tabstyle()}">
   <tr class="active">
     <td width="45" align="center" valign="middle" height="37">{:ckall()}</td>
     <td width="50" align="left" valign="middle">序号</td>
     <td width="300" align="left" valign="middle">广告名称</td>
     <td width="200" align="left" valign="middle">广告位置</td>
     <td width="60" align="center" valign="middle">图片</td>
     <td width="100" align="center" valign="middle">排序</td>
     <td width="120" align="center" valign="middle">启用</td>
     <td width="140" align="center" valign="middle">更新日期</td>
     <td align="left" valign="middle">操作</td>
   </tr>
   <volist name="data" id="obj">
   <tr class="maintr">
    <td align="center" valign="middle" height="37">{:ckbox($obj['Id'],$i-1)}</td>
    <td align="left" valign="middle">{$dshow['pageno']+$i}</td>
    <td align="left" valign="middle">{:modField($obj['topic'],$obj['Id'],'topic','advdata')}</td>
    <td align="left" valign="middle">{$obj['ctag'] ? gtopic('advtype',$obj['ctag']) : '--'}</td>
    <td align="center" valign="middle"><a href="javascript:void(0)"{:imgshow($obj['pic'])}>{:icon('picture')}</a></td>
    <td align="center" valign="middle">{:modord($obj['ord'],$obj['Id'],$dshow['table'])}</td>
    <td align="center" valign="middle">{:modattr($obj['Id'],$obj['enabled'],$dshow['table'])}</td>
    <td align="center" valign="middle">{$obj['date']}</td>
    <td align="left" valign="middle">{:btn(array('vals'=>'编辑','icon'=>'edit','tips'=>'点击编辑数据','url'=>U('system/advmod','tables='.$dshow['table'].'&id='.$obj['Id'])))}</td>
   </tr>
   </volist>
   <tr>
    <td height="37" align="center" valign="middle">{:ckall()}</td>
    <td height="35" colspan="8" align="left" valign="middle">
    {:btn(array('vals'=>'删除','type'=>'submit','name'=>'deldata','icon'=>'trash','scene'=>'danger'))}
    <font class="text-warning">&nbsp;{:icon('warning-sign')} 提示，任何形式删除的数据都无法找回，请谨慎操作！</font>
    {$dshow['pageshow']}
    </td>
   </tr>
   </table>
  </form>
  <else/>
    <div class="alert alert-danger">暂无资料，您可以点击添加按钮添加一条数据。</div>
  </if> 
 </div>
</block>