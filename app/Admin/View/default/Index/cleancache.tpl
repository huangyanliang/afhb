<extend name="default/public/common" />
<block name="main">
 <div class="pubmain">
  <h1>清除缓存</h1>
  <div class="alert alert-warning" style="margin-bottom:10px">
    <p>清除缓存须知.</p>
    <p>1.什么是缓存，本站缓存是指项目在运行一次之后缓存下来的数据，模板，字段，及文件静态缓存。</p>
    <p>2.缓存有什么用，缓存的作用主要是为了减轻服务器的压力，通过IO开销来均衡数据库服务器的压力。</p>
    <p>3.清除缓存的作用，清除缓存主要是为了重新渲染数据库和服务器最新更新资源。</p>
  </div>
  <form name="cacheForm" method="post" action="">
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" class="{:tabstyle()}">
      <tr>
        <td width="10%" height="30" align="left" valign="middle">参数说明</td>
        <td height="30" align="left" valign="middle">参数值</td>
      </tr>
      <tr>
        <td width="10%" height="25" align="left" valign="middle">缓存类型</td>
        <td height="25" align="left" valign="middle">
         <input type="checkbox" value="1" name="cachetype[]"> 字段缓存<span class="text-warning">(数据库字段缓存，通常不需要清除)</span>&nbsp;&nbsp;
         <input type="checkbox" value="2" name="cachetype[]" checked> 数据缓存<span class="text-warning">（系统做的缓存资料）</span>&nbsp;&nbsp;
         <input type="checkbox" value="3" name="cachetype[]" checked> 模板缓存(前台)&nbsp;&nbsp;
         <input type="checkbox" value="4" name="cachetype[]"> 模板缓存(后台)&nbsp;&nbsp;
         <input type="checkbox" value="5" name="cachetype[]"> 静态缓存&nbsp;&nbsp;
         <input type="checkbox" value="6" name="cachetype[]"> 全部（清除全部缓存）
        </td>
      </tr>
      <tr>
        <td height="35" align="left" valign="middle"></td>
        <td height="35" align="left" valign="middle">{:btn(array('vals'=>'清楚缓存','size'=>3,'type'=>'submit','icon'=>'cog','scene'=>'primary'))}</td>
      </tr>
    </table>
  </form>
 </div>
</block>