<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php if($title != ''): echo ($title); else: echo ($metatitle); endif; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta name="renderer" content="webkit" />
<meta name="description" content="<?php echo ($metades); ?>" />
<meta name="keywords" content="<?php echo ($metakey); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="/23mlg/public/Home/css/common.css" />
<link rel="shortcut icon" href="/23mlg/public/Home/images/favicon.ico" />
<link rel="stylesheet" href="/23mlg/public/Home/css/animate.css" />
<script src="/23mlg/public/Home/js/jquery.min.js"></script>
<script src="/23mlg/public/Home/js/common.js"></script>
<link rel="stylesheet" href="/23mlg/public/Home/css/swiper.min.css" />
<link rel="stylesheet" href="/23mlg/public/Home/css/index.css" />
<script type="text/javascript" src="/23mlg/public/Home/js/index.js"></script>
<script type="text/javascript" src="/23mlg/public/Home/js/swiper.min.js"></script>

<script type="text/javascript">
 var think   = '/23mlg/Home';
 var img     = '/23mlg/public/Home/images';
 var pic     = '/23mlg/uploads/images/';
</script>
</head>
<body>
<head>
	<div class="head_top">
		<div class="main">
			<p><img src="/23mlg/public/Home/images/message_top.gif" />欢迎登录湖南环保设备知名厂商</p>
			<dl>
				<dt><img src="/23mlg/public/Home/images/tell.png"/>服务热线：</dt>
				<dd><?php echo ($sysconf['mobile']); ?></dd>
			</dl>
		</div>
	</div>
	<div class="navBox">
		<div class="logo">
			<a href="<?php echo U('index/index');?>"><img src="/23mlg/public/Home/images/logo.jpg" class="hvr-wobble-horizontal" /></a>
		</div>
		<div class="nav">
			<a href="<?php echo U('index/index');?>">
				<dl>
					<dt>首页</dt>
					<dd>Home</dd>
				</dl>
			</a>
			<a href="<?php echo U('about/index');?>">
				<dl>
					<dt>走进澳菲</dt>
					<dd>About us</dd>
					<i><img src="/23mlg/public/Home/images/down.png"/></i>
					<ul>
						<?php if(is_array($aboutMenu)): $i = 0; $__LIST__ = $aboutMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$aboutMenuts): $mod = ($i % 2 );++$i;?><a href="<?php echo U('about/index','id='.$aboutMenuts['Id']);?>">
								<li><?php echo ($aboutMenuts['topic']); ?></li>
							</a><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</dl>
			</a>
			<a href="<?php echo U('news/index');?>">
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

	<link rel="stylesheet" href="/23mlg/public/Home/css/swiper.min.css" />
	<link rel="stylesheet" href="/23mlg/public/Home/css/index.css" />
	<script type="text/javascript" src="/23mlg/public/Home/js/index.js"></script>
	<script type="text/javascript" src="/23mlg/public/Home/js/swiper.min.js"></script>
	<div class="pic">
		<div class="swiper-container picShow">
			<div class="swiper-wrapper">
				<?php if(is_array($adv)): $i = 0; $__LIST__ = $adv;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$advobj): $mod = ($i % 2 );++$i;?><div class="swiper-slide"><a href="<?php echo ($advobj['linkurl']); ?>"><img src="/23mlg/uploads/images/<?php echo ($advobj['pic']); ?>"  alt="<?php echo ($advobj['topic']); ?> /></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<div class="swiper-button-next pic_r"></div>
			<div class="swiper-button-prev pic_l"></div>
		</div>
		<div class="product">
			<div class="main">
				<?php if(is_array($proMenu)): $i = 0; $__LIST__ = $proMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$proMenuobj): $mod = ($i % 2 );++$i;?><div class="productList"><a href="<?php echo U('product/index','type='.$proMenuobj['Id'].'&sty=4');?>">
					<dl>
						<dt><img src="/23mlg/public/Home/images/pro<?php echo ($i); ?>.png"/></dt>
						<dd><?php echo ($proMenuobj['topic']); ?></dd>
						<div class="pro_pic">
							<img src="/23mlg/uploads/images//<?php echo ($proMenuobj['pic']); ?>" />
						</div>
					</dl>
				</a></div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	</div>

	<div class="main">
		<div class="searchBox">
			<dl>
				<dt>热门搜索</dt>
				<dd>
					<a href="">污水处理设备</a>|
					<a href="">雨水收集系统</a>|
					<a href="">预制泵站</a>|
					<a href="">二次供水设备</a>|
					<a href="">长沙澳菲环保</a>
				</dd>
			</dl>
			<div class="search">
				<form action="" method="post">
					<input type="text" placeholder="污水处理" class="search_in" />
					<input type="submit" value=" " class="search_btn" />
				</form>
			</div>
		</div>
		
		<div class="main case">
			<!--<div class="case_l"></div>-->
			<div class="pubBox_t" style="margin-bottom: 20px;">
				<div class="pubTitle">成功案例</div>
				<a href=""><span>更多</span></a>
			</div>
			<div class="swiper-container case_r">
				<div class="swiper-wrapper">
					<?php if(is_array($case)): $i = 0; $__LIST__ = $case;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$caseobj): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
						<a href=""><dl>
							<dd><img src="/23mlg/uploads/images//<?php echo ($caseobj['pic']); ?>" title="<?php echo ($caseobj['topic']); ?>" alt="<?php echo ($caseobj['topic']); ?>" width="100%" /></dd>
							<dt>
								<h3 class="ell"><?php echo ($caseobj['topic']); ?></h3>
								<p>澳菲专注于环保设备10年致力于打造行业领导品牌！</p>
							</dt>
						</dl></a>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="adv_bg">
	  <div class="main">
	      <div class="adv1 advantage">
	      	<h3>澳菲专注于环保设备10年致力于打造行业领导品牌！</h3>
	        <div class="adv_con">长沙澳菲环保科技有限公司 是一家集研发、生产、安装及销售于一体的公司，公司产品有污水处理、供水设备、中水利用设备、饮用水处理设备、垃圾处理设备。</div>
	      </div>
	      <div class="adv2 advantage">
	      	<h3>货源充足,规格齐全,品质保证,同等质量产品价格低5%</h3>
	        <div class="adv_con">
	        	1、拥有超大仓库，充足的货源，保证了供货时间；<br />
				2、产品规格齐全，污水处理、供水设备、中水利用设备、饮用水处理设备、垃圾处理设备等供你选择；<br />
				3、产品荣获三大全球环保标准认证，产品品质有保证；
	        </div>
	      </div>
	      <div class="adv3 advantage">
	      	<h3>四大产品优势 铸就行业领导品牌</h3>
	        <div class="adv_con">澳菲:国际领先的科学技术,引领环保行业铸就行业知名品牌.
	        </div>
	      </div>
	      <div class="adv4 advantage">
	      	<h3>全方位引爆利润的营销模式完备成熟的营销策略</h3>
	        <div class="adv_con">
	        	1、销售赢利：系列化的产品和服务，全方位引爆利润的营销模式，确保事业伙伴获得利润。<br />
				2、发展网点利润：澳菲环保事业伙伴结合营销模式发展店中店，从批发产品中获得丰厚利润。<br />
				3、代理利润：澳菲环保区域代理商在自己的代理区域内发展下一级合作伙伴，获得代理利润。
	        </div>
	      </div>
	      <div class="adv5 advantage">
	      	<h3>未来5—10年行业发展的有利因素</h3>
	        <div class="adv_con">
	        	我国一直高度重视水资源的合理开发利用、保护以及水污染的防治。《中华人民共和国水法》明确规定国家鼓励和支持开发利用水资源和防治水害的各项事业。随着我国工业化进程的加速，环境污染问题日益严重，社会对可持续发展的呼声也越来越高，对各种污染的治理更为紧迫，水处理行业发展空间巨大。国家对水处理要求的不断提高给技术优势企业将带来新的发展。
	        </div>
	      </div>
	  </div>
	</div>

	<div class="honorBox">
		<div class="main">
			<div class="pubBox_t" style="margin-bottom: 20px;">
				<div class="pubTitle">荣誉资质</div>
				<a href=""><span>更多</span></a>
			</div>
			<div class="honor">
				<div class="swiper-container honorShow">
					<div class="swiper-wrapper">
						<?php if(is_array($honor)): $i = 0; $__LIST__ = $honor;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$honorobj): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
							<dl><img src="/23mlg/uploads/images/<?php echo ($honorobj['pic']); ?>" width="135px" height="192px" title="<?php echo ($honorobj['topic']); ?>" alt="<?php echo ($honorobj['topic']); ?>" onclick="honorShow(this.src)" /><dt></dt>
								<dd class="ell"><?php echo ($honorobj['topic']); ?></dd>
							</dl>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
				<div class="swiper-button-next honor_r"></div>
				<div class="swiper-button-prev honor_l"></div>
			</div>
		</div>
		<div class="blackBg">
			<div class="honorPicShow">
				<img src="/23mlg/public/Home/images/honorss.jpg" />
			</div>
		</div>
	</div>
	
	<div class="main">
		<div class="pubBox_t">
			<div class="pubTitle">公司简介</div>
			<a href=""><span>更多</span></a>
		</div>
		<div class="aboutusBox">
			<div class="aboutCon"><?php echo ($about['intro']); ?></div>
			<video src="/23mlg/public/Home/images/myvideo.mp4" controls="controls" poster="/23mlg/public/Home/images/myvideo.jpg"></video>
			<ul>
				<?php if(is_array($new)): $i = 0; $__LIST__ = $new;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$news): $mod = ($i % 2 );++$i;?><a href="" title="<?php echo ($news['topic']); ?>"><li><i>0<?php echo ($i); ?></i><?php echo ($news['topic']); ?><span><?php echo date('Y-m-d',strtotime($news['date']));?></span></li></a><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>	
	</div>



<footer>
			<div class="footer_t">
				<div class="main">
					<div class="ewm">
						<p>官方微信公众号</p>
						<img src="/23mlg/uploads/images//<?php echo ($sysconf['weixinpic']); ?>"/>
						<p>扫一扫，了解更多</p>
					</div>
					<div class="footer_li"></div>
					<dl>
						<dt>走进澳菲</dt>
						<?php if(is_array($aboutMenu)): $i = 0; $__LIST__ = $aboutMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$aboutMenus): $mod = ($i % 2 );++$i;?><a href=""><dd><?php echo ($aboutMenus['topic']); ?></dd></a><?php endforeach; endif; else: echo "" ;endif; ?>
					</dl>
					<div class="footer_li"></div>
					<dl>
						<dt>产品中心</dt>
						<dd><a href="">一体化预制泵站</a></dd>
						<dd><a href="">污水处理设备</a></dd>
						<dd><a href="">雨水收集系统</a></dd>
						<dd><a href="">预制泵站</a></dd>
						<dd><a href="">二次供水设备</a></dd>
					</dl>
					<div class="footer_li"></div>
					<dl>
						<dt>工程案例</dt>
						<?php if(is_array($caseMenu)): $i = 0; $__LIST__ = $caseMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$caseMenus): $mod = ($i % 2 );++$i;?><a href=""><dd><?php echo ($caseMenus['topic']); ?></dd></a><?php endforeach; endif; else: echo "" ;endif; ?>
					</dl>
					<div class="footer_li"></div>
					<dl>
						<dt>新闻资讯</dt>
						<?php if(is_array($newMenu)): $i = 0; $__LIST__ = $newMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$newMenus): $mod = ($i % 2 );++$i;?><a href=""><dd><?php echo ($newMenus['topic']); ?></dd></a><?php endforeach; endif; else: echo "" ;endif; ?>
					</dl>
					<div class="footer_li"></div>
					<dl>
						<dt><a href="">加入我们</a></dt>
						<dd><a href="">招贤纳士</a></dd>
					</dl>
					<div class="footer_li"></div>
					<dl>
						<dt>联系方式</dt>
						<dd><a href="">QQ联系</a></dd>
						<dd><a href="">在线留言</a></dd>
					</dl>
				</div>
			</div>
			<div class="footer_b">
				<div class="main">
					<p>Copyright © 2012-2018     备案号：<?php echo ($sysconf['icpnote']); ?> </p>
					<span><?php echo ($sysconf['address']); ?></span>
				</div>
			</div>
		</footer>
<?php if(!empty($sysconf)): echo ($sysconf['sys_code']); endif; ?>
</body>
</html>