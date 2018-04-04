<extend name="default/public/common" />
<block name="main">
 <div class="pubmain">
 <h1>编辑管理部门</h1>
  <form name="adminform" method="post" action="" onSubmit="return sysadminuser(document.adminform)">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="{:tabstyle()}">
   <tr>
    <td width="10%" height="32" align="right" valign="middle">部门名称：</td>
    <td height="32" align="left">{:input(array('name'=>'topic','faicon'=>'gears','val'=>$data['topic'],'width'=>18,'place'=>'部门名称','tips'=>'必填'))}</td>
   </tr>
   <if condition="$adminauth neq ''">
   <tr>
     <td height="32" align="right" valign="middle">管理权限：</td>
     <td height="32" align="left">
      <div class="authlist">
      <table width="99%" border="0" cellspacing="0" cellpadding="0" align="center" class="table">
       <tr>
         <td width="50" align="center" valign="middle" height="37">选择</td>
         <td width="60" align="center" valign="middle">栏目ID</td>
         <td align="left" valign="middle">栏目名称</td>
       </tr>
       <volist name="adminauth" id="obj" key="i">
       <tr id="adminauth{$obj['Id']}" class="active">
         <td align="center" valign="middle" height="37" class="lev1"><input data-lev="1" type="checkbox" value="{$obj.Id}" <in name="obj['Id']" value="$data['auth']">checked="checked"</in> name="auth[]"></td>
         <td align="center" valign="middle">{$obj['Id']}</td>
         <td align="left" valign="middle"><span class="opened" data-id="{$obj['Id']}">{:faicon('minus-square','font')} {$obj['title']?:'--'}</span></td>
       </tr>
       <if condition="$obj['mdata'] neq ''">
         <volist name="obj['mdata']" id="mobj" key="j">
           <tr id="adminauth{$mobj['Id']}" class="adminauth{$obj['Id']}">
             <td align="center" valign="middle" height="37" class="lev2"><input data-lev="2" type="checkbox" value="{$mobj.Id}" <in name="mobj['Id']" value="$data['auth']">checked="checked"</in> name="auth[]"></td>
             <td align="center" valign="middle">{$mobj['Id']}</td>
             <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="opened" data-id="{$mobj['Id']}">{:faicon('plus-square','font')} {$mobj['title']?:'--'}</span></td>
           </tr>
           {:showadminauth($mobj['Id'],2,$data['auth'])}
         </volist>
       </if>
       </volist>
      </table>
      </div>
     </td>
   </tr>
   </if>
   <tr>
     <td height="32" align="right" valign="middle">部门排序：</td>
     <td height="32" align="left">{:input(array('name'=>'ord','val'=>$data['ord'],'scene'=>'ord'))}</td>
   </tr>
   <tr>
     <td height="32" align="right" valign="middle">&nbsp;</td>
     <input type="hidden" value="{$data['Id']}" name="id">
     <td height="32" align="left">{:btn(array('vals'=>'确定修改','size'=>3,'type'=>'submit','icon'=>'edit','scene'=>'primary'))}</td>
   </tr>
  </table>
  </form>
 </div>
 <script type="text/javascript">
    $('.lev1 input,.lev2 input').on('ifChecked', function(event){
	  var id = $(this).val();
	  $(".adminauth"+id).find("input").iCheck('check');
    });
    $(".lev1 input,.lev2 input").on("ifUnchecked",function(event){
	  var id = $(this).val();
	  $(".adminauth"+id).find(".icheckbox_minimal").removeClass("checked");
      $(".adminauth"+id).find("input").attr("checked",false);
    }); 
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