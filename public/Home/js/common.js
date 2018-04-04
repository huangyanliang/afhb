//创建遮罩层
 function cmask(){
   var w = $(window).width();
   var h = $(document).height();
   $("body").append('<div style="width:'+w+'px;height:'+h+'px" class="cscreen" id="vmask"></div>');
 }
 function hide(){
   $("#vmask").hide().remove();
 }
 //
 $(document).ready(function(e) {
   $.post(think+'/Index/visitStatistics', {'online':1},function(data){},'json');
   $(".bh-fixtop").click(function(e) {
     $("html,body,php").animate({scrollTop: 0}, 400);  
   });
 });
 