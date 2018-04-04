<extend name="default/Base/common" />
<block name="main">
	<div class="pic_n"></div>
	<div class="main">
		<div class="addressBox">
			 <img src="__img__/home.png"/><a href="{:U('index/index')}">首页</a> > <a href="{:U('about/index')}">走进澳菲</a> > {$title}
		</div>
		<div class="menuBox">
			<volist name="aboutMenu" id="aboutMenuobj">
				<a class="hvr-radial-out" <if condition="$id eq $aboutMenuobj['Id']">style="background-color:#05B181;color:#fff;"<else/></if> href="{:U('about/index','id='.$aboutMenuobj['Id'])}">{$aboutMenuobj['topic']}</a>
			</volist>
		</div>
		<div class="content">
			{$content}
		</div>
	</div>
</block>
