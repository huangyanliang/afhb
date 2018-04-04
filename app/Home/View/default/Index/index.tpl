<extend name="default/Base/common" />
<block name="main">
	<link rel="stylesheet" href="__css__/swiper.min.css" />
	<link rel="stylesheet" href="__css__/index.css" />
	<script type="text/javascript" src="__js__/index.js"></script>
	<script type="text/javascript" src="__js__/swiper.min.js"></script>
	<div class="pic">
		<div class="swiper-container picShow">
			<div class="swiper-wrapper">
				<volist name="adv" id="advobj">
				<div class="swiper-slide"><a href="{$advobj['linkurl']}"><img src="__pic__{$advobj['pic']}"  alt="{$advobj['topic']} /></a></div>
				</volist>
			</div>
			<div class="swiper-button-next pic_r"></div>
			<div class="swiper-button-prev pic_l"></div>
		</div>
		<div class="product">
			<div class="main">
				<volist name="proMenu" id="proMenuobj">
				<div class="productList"><a href="{:U('product/index','type='.$proMenuobj['Id'].'&sty=4')}">
					<dl>
						<dt><img src="__img__/pro{$i}.png"/></dt>
						<dd>{$proMenuobj['topic']}</dd>
						<div class="pro_pic">
							<img src="__pic__/{$proMenuobj['pic']}" />
						</div>
					</dl>
				</a></div>
				</volist>
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
					<volist name="case" id="caseobj">
					<div class="swiper-slide">
						<a href=""><dl>
							<dd><img src="__pic__/{$caseobj['pic']}" title="{$caseobj['topic']}" alt="{$caseobj['topic']}" width="100%" /></dd>
							<dt>
								<h3 class="ell">{$caseobj['topic']}</h3>
								<p>澳菲专注于环保设备10年致力于打造行业领导品牌！</p>
							</dt>
						</dl></a>
					</div>
					</volist>
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
						<volist name="honor" id="honorobj">
						<div class="swiper-slide">
							<dl><img src="__pic__{$honorobj['pic']}" width="135px" height="192px" title="{$honorobj['topic']}" alt="{$honorobj['topic']}" onclick="honorShow(this.src)" /><dt></dt>
								<dd class="ell">{$honorobj['topic']}</dd>
							</dl>
						</div>
						</volist>
					</div>
				</div>
				<div class="swiper-button-next honor_r"></div>
				<div class="swiper-button-prev honor_l"></div>
			</div>
		</div>
		<div class="blackBg">
			<div class="honorPicShow">
				<img src="__img__/honorss.jpg" />
			</div>
		</div>
	</div>
	
	<div class="main">
		<div class="pubBox_t">
			<div class="pubTitle">公司简介</div>
			<a href=""><span>更多</span></a>
		</div>
		<div class="aboutusBox">
			<div class="aboutCon">{$about['intro']}</div>
			<video src="__img__/myvideo.mp4" controls="controls" poster="__img__/myvideo.jpg"></video>
			<ul>
				<volist name="new" id="news">
				<a href="" title="{$news['topic']}"><li><i>0{$i}</i>{$news['topic']}<span><?php echo date('Y-m-d',strtotime($news['date']));?></span></li></a>
				</volist>
			</ul>
		</div>	
	</div>

</block>