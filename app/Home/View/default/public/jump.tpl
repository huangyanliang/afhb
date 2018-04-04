<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>404 Error</title>
<link rel="stylesheet" href="<?php echo __ROOT__.'/public/home/css';?>/state.css">
<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
 <div class="bh-error">
    <div class="bh-errorbg"><span class="success">404</span></div>
    <div class="bh-tips">PAGE NOT FOUND</div>
    <div class="bh-notice">很抱歉，你访问的页面不存在输入地址有误或该地址已被删除，你可以点击下面的返回首页按钮返回首页</div>
    <div class="bh-btngroup"> <a href="<?php echo U('index/index');?>" class="bh-backhome">返回首页</a>  <a href="javascript:history.back(-1)" class="bh-back">返回上一页</a></div>
 </div>
</body>
</html>