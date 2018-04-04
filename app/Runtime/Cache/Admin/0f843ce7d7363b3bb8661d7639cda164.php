<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="明良广后台管理系统 <?php echo C('ADMIN_VERSION');?>">
 <meta name="keywords" content="明良广后台管理系统 <?php echo C('ADMIN_VERSION');?>">
 <meta name="author" content="jxbh">
 <title>系统提示-明良广</title>
 <link href="/23mlg/public/Admin/css/bootstrap.min.css" rel="stylesheet">
 <style>
   body{ padding:0; margin:0;}
   .tips{ width:100%; height:350px; margin:0px auto; overflow:hidden; font-family:"微软雅黑"; padding:10px;}
   .tips h1{ height:50px; line-height:50px; font-size:16px; font-weight:normal; color:#626262; border-bottom:solid 1px #e2e2e2; text-indent:0px; margin:0 0 10px 0;}
   .tips .tips_div{ width:100%; height:200px; overflow:hidden;}
   .tips .tips_div p{ line-height:20px; color:#737373;}
   .tips .tips_div p a{ color:#737373;}
   .tips .tips_div p span{ color:#f05458; font-size:16px;}
   .tips .tips_div p.tips_p{ color:#2dc3e8; font-size:15px;}
   .tips .back{ clear:both; height:60px; line-height:60px; width:100%;}
   .tips .back div{ float:right; color:#5ab8fe; border-right:solid 2px #5ab8fe; border-bottom:solid 2px #5ab8fe; width:100px; text-align:center; cursor:pointer;}
 </style>
</head>
<body>
<div class="tips">
  <h1>系统提示</h1> 
  <div class="tips_div">
   <?php if($status){ ?>
   <p class="tips_p"><?php echo icon('ok','b').' '.$message;?></p>
   <?php }else{?>
   <p class="tips_p" style="color:#fb6e52;"><?php echo icon('remove','b').' '.$error;?></p>
   <?php }?>
   <p>如果您不做出选择，<span id="wait"><?php echo ($waitSecond); ?></span> 秒后<a href="<?php echo ($jumpUrl); ?>" id="href">跳转</a>到指定链接地址</p>
  </div>
  <div class="back">
   <div onClick="history.back(-1);">返回上一页</div>
  </div>
</div>
<script type="text/javascript">
(function(){
	var wait = document.getElementById('wait'),href = document.getElementById('href').href;
	var interval = setInterval(function(){
		var time = --wait.innerHTML;
		if(time <= 0) {
			location.href = href;
			clearInterval(interval);
		};
	}, 1000);
})();
</script>
</body>
</html>