<extend name="default/public/common" />
<block name="main">
 <div class="pubmain">
 <h1>系统栏目管理<div class="pull-right">{:btn(array('vals'=>'添加栏目','size'=>3,'icon'=>'plus','scene'=>'primary','url'=>U('system/adminauthadd')))}</div></h1>
 <form name="publist" method="post" action="" onSubmit="return pubdel(document.publist)"> 
  <table width="99%" border="0" cellspacing="0" cellpadding="0" align="center" class="{:tabstyle()}">
   <tr class="active">
     <td width="45" align="center" valign="middle" height="37">{:ckall()}</td>
     <td width="60" align="center" valign="middle">栏目ID</td>
     <td width="230" align="left" valign="middle">栏目名称</td>
     <td align="left" width="300" valign="middle">链接</td>
     <td width="100" align="center" valign="middle">图标</td>
     <td width="100" align="center" valign="middle">图标扩展</td>
     <td width="100" align="center" valign="middle">是否展开</td>
     <td width="100" align="center" valign="middle">排序</td>
     <td align="left" valign="middle">操作</td>
   </tr>
   <volist name="data" id="obj" key="i">
   <tr class="maintr" id="adminauth{$obj['Id']}">
    <td align="center" valign="middle" height="37">{:ckbox($obj['Id'],$i-1)}</td>
    <td align="center" valign="middle">{$obj['Id']}</td>
    <td align="left" valign="middle"><span class="opened" data-id="{$obj['Id']}">{:faicon('minus-square','font')} {$obj['title']?:'--'}</span></td>
    <td align="left" valign="middle">{$obj['linkurl']?:'--'}</td>
    <td align="center" valign="middle">
     <if condition="$obj['icon'] eq ''">
     无
     <else/>
      <if condition="$obj['isext'] eq 0">
       {:icon($obj['icon'])}
      <else/>
       {:faicon($obj['icon'])}
      </if>
     </if>
    </td>
    <td align="center" valign="middle">{:modattr($obj['Id'],$obj['isext'],$dshow['table'],'isext',array('是','否'))}</td>
    <td align="center" valign="middle">{:modattr($obj['Id'],$obj['isopen'],$dshow['table'],'isopen',array('展开','关闭'))}</td>
    <td align="center" valign="middle">{:modord($obj['ord'],$obj['Id'],$dshow['table'])}</td>
    <td align="left" valign="middle">{:btn(array('vals'=>'编辑','icon'=>'edit','tips'=>'点击编辑数据','url'=>U('system/adminauthmod','id='.$obj['Id'])))}</td>
   </tr>
   <if condition="$obj['mdata'] neq ''">
   <volist name="obj['mdata']" id="mobj" key="j">
   <tr id="adminauth{$mobj['Id']}" class="active adminauth{$obj['Id']}">
    <td align="center" valign="middle" height="37">{:ckbox($mobj['Id'],$i-1)}</td>
    <td align="center" valign="middle">{$mobj['Id']}</td>
    <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="opened" data-id="{$mobj['Id']}">{:faicon('plus-square','font')} {$mobj['title']?:'--'}</span></td>
    <td align="left" valign="middle">{:modField($mobj['linkurl'],$mobj['Id'],'linkurl',$dshow['table'])}</td>
    <td align="center" valign="middle">
     <if condition="$mobj['icon'] eq ''">
     无
     <else/>
      <if condition="$mobj['isext'] eq 0">
       {:icon($mobj['icon'])}
      <else/>
       {:faicon($mobj['icon'])}
      </if>
     </if>
    </td>
    <td align="center" valign="middle">{:modattr($mobj['Id'],$mobj['isext'],$dshow['table'],'isext',array('是','否'))}</td>
    <td align="center" valign="middle">{:modattr($mobj['Id'],$mobj['isopen'],$dshow['table'],'isopen',array('展开','关闭'))}</td>
    <td align="center" valign="middle">{:modord($mobj['ord'],$mobj['Id'],$dshow['table'])}</td>
    <td align="left" valign="middle">
     {:btn(array('vals'=>'编辑','icon'=>'edit','tips'=>'点击编辑数据','url'=>U('system/adminauthmod','id='.$mobj['Id'])))}
    </td>
   </tr>
   {:showadminauth($mobj['Id'])}
   </volist>
   </if>
   </volist>
   <tr>
    <td height="37" align="center" valign="middle">{:ckall()}</td>
    <td height="35" colspan="8" align="left" valign="middle">
    {:btn(array('vals'=>'删除','type'=>'submit','name'=>'deldata','icon'=>'trash','scene'=>'danger'))}
    <font class="text-warning">&nbsp;{:icon('warning-sign')} 提示：该栏目不建议对外使用（若栏目规则一致，优先判断排序前的规则）。</font>
    {$dshow['pageshow']}
    </td>
   </tr>
   </table>
   </form>
 </div>
 <script type="text/javascript">
   $("body").on("click",".opened",function(){
     var id  = $(this).data("id");
	 var obj = $(".adminauth"+id);
	 var $this = $(this);
	 if (obj.is(":hidden")){
	   obj.show();
	   $this.find("font").removeClass("fa-plus-square").addClass("fa-minus-square");
	 } else {
	   obj.hide();
	   $this.find("font").removeClass("fa-minus-square").addClass("fa-plus-square");
	 }
   });
 </script>
</block>