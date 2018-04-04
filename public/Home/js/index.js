$(function(){
	var swiper = new Swiper('.picShow', {//滚动大图
		navigation: {
			nextEl: '.pic_r',
			prevEl: '.pic_l',
		},
		autoplay:true,
		loop : true
	});
	var swiper = new Swiper('.honorShow', {//资质荣誉
      slidesPerView: 6,
      spaceBetween: 30,
      slidesPerGroup: 1,
      loop: true,
      //autoplay:true,
      loopFillGroupWithBlank: true,
      navigation: {
        nextEl: '.honor_r',
        prevEl: '.honor_l',
      },
    });
    var swiper = new Swiper('.case_r', {//成功案例
      slidesPerView: 4,
      slidesPerColumn: 2,
      spaceBetween: 15,
      //slidesPerGroup: 1,
      //loop: true,
      //autoplay:true,
      //loopFillGroupWithBlank: true
    });
	
	$(".nav dl").bind("mouseover",function(){
		$(this).find("ul").show();
	});
	$(".nav dl").bind("mouseout",function(){
		$(this).find("ul").hide();
	});
	
	/*$(".product").find("dl:first").find(".pro_pic").show();
	$(".product").find("dl:first").css({"background":"#05b181","margin-right":"269px"});
	$(".product").find("dl:last").css("border-right","none");
	$(".product").find("dl").on("mouseenter",function(){
		$(".product").find("dl").find(".pro_pic").hide();
		$(".product").find("dl").css({"background":"none","margin-right":"0px"});
		$(this).css({"background":"#05b181","margin-right":"269px"});
		$(this).find(".pro_pic").show();
	});*/
	
	var currentLi =  $(".product .productList");
	$(currentLi.eq(0)).stop().animate({"width":"444px"},600);
	$(currentLi.eq(0)).css({"background":"#05b181"});
	$(currentLi.eq(0)).children(".pro_pic").animate({"left":"176px"},600);
	$(currentLi.eq(4)).find("dl").css("border-right","none");
	$(currentLi).hover(function(e){
		$(this).siblings(".productList").stop().animate({"width":"176px"},600);
		$(this).siblings(".productList").css({"background":"none"});
		$(this).stop().animate({"width":"444px"},600);
		$(this).css({"background":"#05b181"});
	});
	
	$(".blackBg").bind("click",function(){
		$(this).hide("slow");
	});

});

function honorShow(src){
	$(".honorPicShow img").attr("src",src);
	$(".blackBg").show("slow");
}
 