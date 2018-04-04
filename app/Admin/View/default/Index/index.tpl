<extend name="default/public/common" />
<block name="meta">
 <link href="__css__/index.css" rel="stylesheet">
 <script src="__js__/index.js" type="text/javascript"></script>
 <script src="__js__/screenfull.min.js" type="text/javascript"></script>
</block>
<block name="main">
<div id="header">
 <div class="adminlogo" title="澳菲环保后台管理"></div>
 <div class="adminbar" data-hide="1">{:faicon('bars')}</div>
 <div class="adminmenu">
  <ul>
   <volist name="topmenu" id="tobj">
    <in name="tobj['Id']" value="$myauth">
     <li><a data-id="{$tobj['Id']}" href="javascript:void(0)" <if condition="$tabid eq $tobj['Id']"> class="selected"</if>><if condition="$tobj['icon'] neq ''">{$tobj['isext']?faicon($tobj['icon']):icon($tobj['icon'])}</if> {$tobj['title']}</a></li>
    </in>
   </volist>
  </ul>
 </div>
 <div class="adminright">
  <div class="adminface"></div>
  <div class="menu-switch">{:icon('menu-down')}</div>
 </div>
 <div class="admin-menu">
  <ul class="admin-menu-ul">
   <li class="name">{$adminauth['adminuser']}</li>
   <li><a data-id="0" href="{:U('index/modpass')}" target="right">{:icon('cog')}修改密码</a></li>
   <li><a data-id="0" href="{:U('index/cleancache')}" target="right">{:icon('trash')}清除缓存</a></li>
   <li><a data-id="0" href="{:U('index/main')}" target="right">{:icon('home')}系统首页</a></li>
   <!--<li><a data-id="0" href="http://www.23mlg.com" target="_blank">{:icon('question-sign')}关于我们</a></li>-->
   <li><a data-id="0" href="{:U('index/logout')}">{:icon('share-alt')}退出系统</a></li>
  </ul>
 </div>
</div>
<div class="indexmain">

<div id="sidebar">
 <div style="height:auto; overflow:hidden;">
 <if condition="$mmenu neq ''"> 
  <volist name="mmenu" id="mobj" key="m">
   <if condition="$mobj['smenu'] neq ''">
    <in name="mobj['Id']" value="$myauth">
    <div class="menu-admin {$mobj['isopen']?'':'hide-true'}">
     <div class="menu-header2">{$mobj['isext']?faicon($mobj['icon']):icon($mobj['icon'])} {$mobj['title']}  {:faicon('angle-down','b')}</div>
     <volist name="mobj['smenu']" id="sobj">
       <in name="sobj['Id']" value="$myauth">
        <div class="menu-dd"> <a href="{:tplUrl($sobj['linkurl'])}" data-id="{$sobj['Id']}" target="right">{:faicon('angle-right','b')} {$sobj['isext']?faicon($sobj['icon'],'b'):icon($sobj['icon'],'b')} {$sobj['title']}</a></div>
       </in>
     </volist>
    </div>
    </in>
   <else/>
    <in name="mobj['Id']" value="$myauth">
     <a href="{:tplUrl($mobj['linkurl'])}" target="right"  data-id="{$mobj['Id']}" class="menu-link"><div class="menu-header">{$mobj['isext']?faicon($mobj['icon']):icon($mobj['icon'])}  {$mobj['title']}  {:faicon('angle-right','b')}</div></a>
    </in>
   </if>
  </volist>
 </if>
 <div style="height:20px; clear:both;"></div>
 </div>
 </div>
 <div id="rightmain">
     <div id="map">
     <div class="pull-left btn-group" style="margin:7px auto 0 10px;">
      {:btn(array('vals'=>'','size'=>3,'icon'=>'resize-full','scene'=>'default','add'=>'mycollapse'))}
      {:btn(array('vals'=>'','size'=>3,'icon'=>'arrow-left','scene'=>'default','add'=>'back'))}
      {:btn(array('vals'=>'','size'=>3,'icon'=>'arrow-right','scene'=>'default','add'=>'going'))}
      {:btn(array('vals'=>'','size'=>3,'icon'=>'refresh','scene'=>'default','add'=>'f5'))}
      {:btn(array('vals'=>'','size'=>3,'icon'=>'fullscreen','scene'=>'default','add'=>'fullscreen'))}
      </div>
     <b>当前位置：<a href="{:U('index/main')}" target="right">系统首页</a> <img src="__img__/map_right.png" /> 管理中心 <img src="__img__/map_right.png" /> {:gtopic('adminauth',$tabid,'title')}</b> 
     </div>
     <div id="iframdiv" class="adminpublic"><iframe name="right" id="iframeright" width="100%" height="100%" src="{$refer}" frameborder="0" scrolling="yes"></iframe></div>
 </div>
</div>
<script type="text/javascript">
 var width = document.documentElement.clientWidth - 178;
 document.getElementById('rightmain').style.width = width + 'px';
 var height = document.documentElement.clientHeight - 50;
 document.getElementById('rightmain').style.height = height + 'px';
 document.getElementById('iframdiv').style.width = width-20 + 'px';
 if ( width < 760 ) {
   $("#sidebar").hide();
   $(".mycollapse").find("span").removeClass('glyphicon-resize-full').addClass('glyphicon-resize-small');
 } else {
   $("#sidebar").show();
   $(".mycollapse").find("span").removeClass('glyphicon-resize-small').addClass('glyphicon-resize-full');
 }
 $(".hide-true .menu-dd").hide().css({"height":'0px'});
 $(".hide-true").find(".menu-header2,.menu-header").css({"border-bottom":'none'});
 $(".hide-true").find(".menu-header2 b,.menu-header b").removeClass("glyphicon-menu-down").addClass("fa-angle-up");
 if($(".menu-link").length>0) $(".menu-link").eq(0).addClass("menu-header2").removeClass("menu-header");
 $('#sidebar').perfectScrollbar();

</script>
</block>