<extend name="default/public/common" />
<block name="main">
 <div class="pubmain">
 <h1>后台管理中心 </h1> 
 <div class="success-div text-success bg-success">
  &nbsp;{:icon('cog')}&nbsp;&nbsp;系统提示：如果您长时间不使用系统，但是又不想退出系统，您可以点击 <a href="javascript:void(0)" class="lockscreen">{:faicon('lock')} 锁屏</a> 锁定屏幕！
 </div>
 <div class="success-div text-success bg-success">
  &nbsp;{:icon('cog')}&nbsp;&nbsp;系统提示：当您新增或者修改了数据信息时，请点击 <a href="{:U('index/cleancache')}">{:icon('trash')} 清除缓存</a> ，删除掉系统缓存，保证前台显示最新的数据。
 </div>
 <div class="success-div text-success bg-success">
  &nbsp;{:icon('cog')}&nbsp;&nbsp;系统提示：了解后台管理系统特性及版本更新详情 <a href="javascript:void(0)" data-toggle="modal" data-target="#useit">{:icon('question-sign')} 请点击</a> 这里。
 </div>
 <if condition="$sysInfo['backupcount'] gt 0">
 <div class="success-div text-success bg-success">
  &nbsp;{:icon('info-sign')}&nbsp;&nbsp;您有 {$sysInfo['backupcount']} 条数据库备份信息，建议您定时<a href="{:U('system/databackup')}">{:icon('trash')} 备份</a> 您的数据库信息，您上次备份数据的时间为 {$sysInfo['backuptime']}。
 </div>
 </if>
 <if condition="$c_site eq 1">
 <div class="warning-div text-warning bg-warning">
  &nbsp;{:icon('alert')}&nbsp;&nbsp;您的网站项目处于关闭状态。点击 {:btn(array('vals'=>'设置','icon'=>'cog','scene'=>'primary','url'=>U('system/sysmod')))} 去开启项目。
 </div>
 </if>
 <if condition="$sysInfo['tcache'] eq 0">
  <div class="warning-div text-warning bg-warning">
   &nbsp;{:icon('alert')}&nbsp;&nbsp;您的网站的模板编译缓存未开启，建议更改配置文件的 TMPL_CACHE_ON 参数。
  </div>
 </if>
 <if condition="$sysInfo['debug'] eq 1">
  <div class="warning-div text-warning bg-warning">
   &nbsp;{:icon('alert')}&nbsp;&nbsp;您的网站程序DEBUG已经启用，建议更改配置文件的 SHOW_PAGE_TRACE 参数。
  </div>
 </if>
 <if condition="APP_DEBUG eq 1">
 <div class="warning-div text-warning bg-warning">
  &nbsp;{:icon('alert')}&nbsp;&nbsp;您的网站程序处于开发状态，建议更改单入口文件的 APP_DEBUG 参数。
 </div>
 </if>

 <if condition="$sysInfo['loginwarning'] neq ''">
 <div class="warning-div text-warning bg-warning">
  &nbsp;{:icon('alert')}&nbsp;&nbsp;{$sysInfo['loginwarning'] }
 </div>
 </if> 
 
 <if condition="$sysInfo['passWarning'] neq ''">
 <div class="warning-div text-warning bg-warning">
  &nbsp;{:icon('alert')}&nbsp;&nbsp;{$sysInfo['passWarning'] }
 </div>
 </if>
 
 <div class="modal fade" id="useit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius:0;">
      <div class="modal-body">
      <!-----> 
      <div>
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#instructions" aria-controls="instructions" role="tab" data-toggle="tab">{:icon('wrench')} 使用说明</a></li>
        <li role="presentation"><a href="#updatelog" aria-controls="updatelog" role="tab" data-toggle="tab">{:icon('list-alt')} 更新日志</a></li>
        <li role="presentation"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">{:icon('map-marker')} 联系我们</a></li>
        <li role="presentation"><a href="#bug" aria-controls="bug" role="tab" data-toggle="tab">{:faicon('bug')} BUG反馈</a></li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="instructions">
          <blockquote class="use">
            <p style=" color:#666; font-size:15px;">使用说明{$sysInfo['admin_ver']}</p>
            <ul>
             <li><a href="{:U('System/databackup')}">A：数据库备份及下载(建议有重要数据更新之后手动备份数据)</a></li>
             <li><a href="{:U('System/sysmod')}">B：系统设置</a> / <a href="{:U('System/syswater')}" data-pic="__img__/useit/water.png">水印设置</a> / <a href="{:U('System/sysupload')}" data-pic="__img__/useit/file.png">上传设置</a></li>
             <li><a href="{:U('System/syspic')}">C：图片管理器</a></li>
             <li><a href="javascript:void(0)">D：上传图片裁剪</a></li>
             <li><a href="{:U('Index/cleancache')}"{:tooltip('删除掉系统缓存，保证前台显示最新的数据。')}>E：缓存清理(删除掉系统缓存，前台显示最新的数据。)</a></li>
             <li><a href="{:U('System/adminauth')}"{:tooltip('非开发人员不建议使用')}>F：权限控制</a></li>
            </ul>
          </blockquote>
        </div>
        <div role="tabpanel" class="tab-pane" id="updatelog">
          <blockquote class="updata-log">
            <p style=" color:#63f; font-size:15px;">更新日志{$sysInfo['admin_ver']}</p>
            <ul>
             <li>1：更新后台管理程序，去除重复代码。</li>
             <li>2：V3.0版后台登录界面/管理界面。</li>
             <li>3：新增 INPUT函数（快速维护，更新输入框风格）。</li>
             <li>4：新增图片裁剪功能（裁剪之后不保留原图）。</li>
             <li>5：新增 附件，图片的上传设置（可以设置服务器上传附件/图片的大小及后缀名称）。</li>
             <li>6：新增列表页面修改基础数据，包括图片，分类，排序，标题。</li>
             <li>7：新增页面统计功能，可在线统计当天的浏览人次/IP/浏览量，平均浏览时间，后台可设置关闭。</li>
             <li>8：新增权限控制，能精细控制后台管理用户的浏览/访问模块。</li>
             <li>9：新增全局日志函数，后台可设置删除日志及查看日志详情。</li>
             <li>10：优化在线客服后台 可设置关闭显示。</li>
             <li>11：优化项目（后台）在IE8,IE9的显示。</li>
             <li>12：优化数据库结构（去除无用的字段，优化字段类型）。</li>
             <li>13：优化批量删除管理员，至少保留一位管理员。</li>
             <li>14：优化访问统计功能，页面加载完毕进行统计，采集。</li>
             <li>15：优化后台冗余图片查询，优化查询非冗余数据，提高管理用户的访问速度。</li>
             <li>16：优化单页可设置关键词及描述。</li>
             <li style="color:#63f;">17：新增Font Awesome字体库，丰富图标库.</li>
             <li style="color:#63f;">18：新增后台目录保护设功能，设置一个您记得住的后台管理地址吧！</li>
             <li style="color:#63f;">19：新增后台部门管理，部门权限可自行选择。</li>
             <li style="color:#63f;">20：新增图片裁剪和图片库功能，您可以直接在图片库里面选择图片。</li>
             <li style="color:#f00;">21：编辑器新增美图秀秀功能插件，您可以直接利用编辑器处理美化拼接图片。</li>
             <li style="color:#f00;">22：编辑器上传的图片可设置裁剪规则，及可以系统设置添加水印。</li>
             <li style="color:#f00;">23：编辑器上传内容设置压缩规则 规则一：按照上传图片的大小判断，规则二根据上传图片的尺寸判断。</li>
             <li style="color:#f00;">23：新增内容简介截取功能，字段获取您编辑器里面非HTML部分的前120个字符的数据..</li>
             <li style="color:#f00;">24：优化访问统计功能，表设计，访问统计统计图去掉 “用户” 线图..</li>
             <li>23：等等...</li>
            </ul>
          </blockquote>
        </div>
        
       </div>
      </div>
      <!----> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">{:icon('off')} 关闭</button>
      </div>
    </div>
  </div>
 </div>
 
 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="{:tabstyle()}" style="margin:10px auto;">
   <tr class="active"><td colspan="4" align="left" valign="middle">{:icon('cog')} 系统信息</td></tr>
   <tr>
     <td align="left" width="25%" valign="middle" height="25">服务器操作系统：</td>
     <td align="left" width="25%" valign="middle">{$sysInfo['os']}</td>
     <td align="left" width="25%" valign="middle">Web 服务器：</td>
     <td align="left" width="25%" valign="middle">{$sysInfo['web_server']}</td>
   </tr>
   <tr>
     <td align="left" valign="middle" height="25">PHP 版本：</td>
     <td align="left" valign="middle" title="(注:请保证您的PHP版本 > 5.3.0 )">{$sysInfo['php_ver']}</td>
     <td align="left" valign="middle">MySQL 版本：</td>
     <td align="left" valign="middle">{$sysInfo['mysql_ver']}</td>
   </tr>
   <tr>
     <td align="left" valign="middle" height="25">GD 版本：</td>
     <td align="left" valign="middle">{$sysInfo['gd']}</td>
     <td align="left" valign="middle">时区设置：</td>
     <td align="left" valign="middle">{$sysInfo['timezone']}</td>
   </tr>
   <tr>
     <td align="left" valign="middle" height="25">文件上传的最大大小/POST上传最大值：</td>
     <td align="left" valign="middle" title="请在php.ini里面设置这2个值">{$sysInfo['max_filesize']} / {$sysInfo['post_maxsize']}</td>
     <td align="left" valign="middle">Zlib 支持：</td>
     <td align="left" valign="middle">{$sysInfo['zlib']}</td>
   </tr>
   <tr>
     <td align="left" valign="middle" height="25">语言：</td>
     <td align="left" valign="middle">{$sysInfo['language']}</td>
     <td align="left" valign="middle">编码：</td>
     <td align="left" valign="middle">{$sysInfo['coding']}</td>
   </tr>
   <tr>
     <td align="left" valign="middle" height="25">后台版本：</td>
     <td align="left" valign="middle" title="power by thinkphp3.2 and bootstrap 3.0">{$sysInfo['admin_ver']}</td>
     <td align="left" valign="middle">联系邮箱：</td>
     <td align="left" valign="middle"><!--bh#jxbht.com <a href="javascript:void(0)" title="(注:请把#换成@)">?</a>--></td>
   </tr>
   <tr class="hide">
     <td align="left" valign="middle" height="25">磁盘可用：</td>
     <td align="left" valign="middle">{$sysInfo['disk_size']}</td>
     <td align="left" valign="middle">&nbsp;</td>
     <td align="left" valign="middle">&nbsp;</td>
   </tr>
  </table> 
 </div>
 <script type="text/javascript">
    $(".lockscreen").click(function(e) {
     var $this = $(this);
	 $this.html('<span class="fa fa-spinner fa-spin"></span> 锁屏中..');
	 $.post('{:U("Admin/lockscreen")}',{'act':'lock'},function(data){
	   $this.html('<span class="fa fa-lock"></span> 锁屏');
	   if ( data == 1 ) {
	     parent.location.reload();
	   } else {
	     swal(data,'','error');
	   }
	 },'json');
   });
 </script>
</block>