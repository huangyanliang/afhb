 window.onload = function () {(window.onresize = function () {
	var width = document.documentElement.clientWidth - 178;
	var height = document.documentElement.clientHeight - 50;
	//隐藏
	if ( width < 760 ) {
	  $("#sidebar").hide();
	  $(".mycollapse").find("span").removeClass('glyphicon-resize-full').addClass('glyphicon-resize-small');
	} else {
	  $("#sidebar").show();
	  $(".mycollapse").find("span").removeClass('glyphicon-resize-small').addClass('glyphicon-resize-full');
	}
	if (width >= 0){
	   if(!$("#sidebar").is(":hidden")){
		  document.getElementById('rightmain').style.width = width + 'px';
	      document.getElementById('iframdiv').style.width = width-20 + 'px';
	   } else {
		  document.getElementById('rightmain').style.width = width+178 + 'px';
	      document.getElementById('iframdiv').style.width = width-20+178 + 'px';
	   }
	}
	if (height >= 0) {
		document.getElementById('sidebar').style.height = height + 'px';
		document.getElementById('rightmain').style.height = height + 'px';
		document.getElementById("iframdiv").style.height = parseInt(((height-48)*0.99)) + 'px';
	}
 })()};
 $(document).ready(function(e) {
   $(".f5").click(function(e) {var url = right.location.href;right.location.href = url;});
   $(".back").click(function(e){right.history.back(-1);});
   $(".going").click(function(e){right.history.go(1);});
   $(".menu-header,.menu-header2").click(function(e) {
	if (!$(this).find('b').hasClass('fa-angle-right')) {
		var obj = $(this).parent().find(".menu-dd");
		if(!obj.is(":hidden")){
		 obj.animate({"height":'0px'},200,function(){obj.hide()});
		 $(this).find("b").removeClass("fa-angle-down").addClass("fa-angle-up");
		 $(this).css({"border-bottom":'none'});
		}else{
		 obj.show().animate({"height":'32px'},200,function(){});
		 $(this).find("b").removeClass("angle-up").addClass("fa-angle-down");
		 $(this).css({"border-bottom":'solid 1px #f3f3f3',"border-top":'solid 1px #f3f3f3'});
		}
	}
  });
  $(".adminmenu li a").click(function(e) {
    var id = $(this).data("id");
	if (!id) return false;
	$.post(abspath+'/Admin/switchtab', {"tabid": id},function(data){
	  window.location.reload();
	},'json');
  });
  if($(".adminmenu li a.selected").length == 0) {
    var id = $(".adminmenu li a").eq(0).data("id");
	if(id!=0 && id!=undefined) {
	  $.post(abspath+'/Admin/switchtab', {"tabid": id},function(data){
	    window.location.reload();
	  },'json');
	}
  }
  $(".adminright,.admin-menu-ul li").click(function(e) {
    if($(".admin-menu-ul").is(":hidden")){
	  $(".menu-switch span").removeClass("glyphicon-menu-down").addClass("glyphicon-menu-up");
	  $(".adminright").css("background","#1ea5d7");
	  $(".admin-menu-ul").show().animate({"right":'-90px'},500,function(){});
	}else{
	  $(".admin-menu-ul").animate({"right":'-180px'},10,function(){$(".admin-menu-ul").hide()});
	  $(".menu-switch span").removeClass("glyphicon-menu-up").addClass("glyphicon-menu-down");
	  $(".adminright").css("background","none");
	}  
  });
  $(".menu-dd a").click(function(e) {
	$(".menu-link").find("div,span,b").css({"color":'#000','border-bottom':'solid 1px #f3f3f3','background':'#fff'});
    $(".menu-dd a").removeClass("selected");
	$(this).addClass("selected");    
  });
  $(".menu-link").click(function(e) {
	 $(".menu-dd a").removeClass("selected");
	 $(".menu-link").find("div,span,b").css({"color":'#000','border-bottom':'solid 1px #f3f3f3','background':'#fff'});
     $(this).find("div,span,b").css({"color":'#2dc3e8','border-bottom':'solid 1px #f3f3f3','background':'#f5f5f5'});
  });
  $(".adminbar").click(function(e) {
   var $this = $(this);
   if ($this.data("hide") == 1) {
	 $this.css({"background-color":"#1ea5d7"});
     $(".adminmenu").show().animate({"top":"50"},500,function(){
	   $this.find("span").removeClass("fa-bars").addClass("fa-times");
	   $this.data("hide",0);
	 })   
   } else {
     $(".adminmenu").animate({"top":"-300"},500,function(){
	   $this.find("span").removeClass("fa-times").addClass("fa-bars");
	   $this.css({"background-color":"#000"});
	   $this.data("hide",1);
 	 })  
   }
  });
  $(".mycollapse").click(function(e) {
    if(!$("#sidebar").is(":hidden")){
 	  $(this).find("span").removeClass('glyphicon-resize-full').addClass('glyphicon-resize-small');
	  $("#sidebar").hide(); 
	  $("#rightmain").width($(document).width());
	  $("#iframdiv").width($(document).width()-20);
    }else{
	  $(this).find("span").removeClass('glyphicon-resize-small').addClass('glyphicon-resize-full');
	  $("#sidebar").show(); 
	  $("#rightmain").width($(document).width()-178);
	  $("#iframdiv").width($(document).width()-198);
    }
   }); 
   $(".fullscreen").click(function(e) {
     if (screenfull.enabled)screenfull.toggle();
   });
   
});