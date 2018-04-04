<head>
	<div class="head_top">
		<div class="main">
			<p><img src="__img__/message_top.gif" />欢迎登录湖南环保设备知名厂商</p>
			<dl>
				<dt><img src="__img__/tell.png"/>服务热线：</dt>
				<dd>{$sysconf['mobile']}</dd>
			</dl>
		</div>
	</div>
	<div class="navBox">
		<div class="logo">
			<a href="{:U('index/index')}"><img src="__img__/logo.jpg" class="hvr-wobble-horizontal" /></a>
		</div>
		<div class="nav">
			<a href="{:U('index/index')}">
				<dl>
					<dt>首页</dt>
					<dd>Home</dd>
				</dl>
			</a>
			<a href="{:U('about/index')}">
				<dl>
					<dt>走进澳菲</dt>
					<dd>About us</dd>
					<i><img src="__img__/down.png"/></i>
					<ul>
						<volist name="aboutMenu" id="aboutMenuts">
							<a href="{:U('about/index','id='.$aboutMenuts['Id'])}">
								<li>{$aboutMenuts['topic']}</li>
							</a>
						</volist>
					</ul>
				</dl>
			</a>
			<a href="{:U('product/index')}">
				<dl>
					<dt>产品中心</dt>
					<dd>Product</dd>
				</dl>
			</a>
			<a href="">
				<dl>
					<dt>工程案例</dt>
					<dd>ngineering</dd>
				</dl>
			</a>
			<a href="">
				<dl>
					<dt>荣誉资质</dt>
					<dd>Honorary</dd>
				</dl>
			</a>
			<a href="">
				<dl>
					<dt>下载专栏</dt>
					<dd>Download</dd>
				</dl>
			</a>
			<a href="">
				<dl>
					<dt>新闻资讯</dt>
					<dd>News</dd>
				</dl>
			</a>
			<a href="">
				<dl>
					<dt>加入我们</dt>
					<dd>Join us</dd>
				</dl>
			</a>
			<a href="">
				<dl>
					<dt>联系方式</dt>
					<dd>Contact</dd>
				</dl>
			</a>
		</div>

	</div>
</head>