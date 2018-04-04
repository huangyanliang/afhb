<extend name="default/Base/common" />
<block name="main">
	<div class="pic_n"></div>
	<div class="main">
		<div class="addressBox">
			 <img src="__img__/home.png"/><a href="{:U('index/index')}">首页</a> > <a href="{:U('product/index')}">产品中心</a> > {$title}
		</div>
		<div class="menuBox">
			<volist name="proMenu" id="proMenuobj">
				<a class="hvr-radial-out" <if condition="$type eq $proMenuobj['Id']">style="background-color:#05B181;color:#fff;"<else/></if> href="{:U('product/index','type='.$proMenuobj['Id'])}">{$proMenuobj['topic']}</a>
			</volist>
		</div>
		{$pageshow}
	</div>
</block>
