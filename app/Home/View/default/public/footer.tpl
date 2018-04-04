<footer>
			<div class="footer_t">
				<div class="main">
					<div class="ewm">
						<p>官方微信公众号</p>
						<img src="__pic__/{$sysconf['weixinpic']}"/>
						<p>扫一扫，了解更多</p>
					</div>
					<div class="footer_li"></div>
					<dl>
						<dt>走进澳菲</dt>
						<volist name="aboutMenu" id="aboutMenus">
						<a href=""><dd>{$aboutMenus['topic']}</dd></a>
						</volist>
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
						<volist name="caseMenu" id="caseMenus">
						<a href=""><dd>{$caseMenus['topic']}</dd></a>
						</volist>
					</dl>
					<div class="footer_li"></div>
					<dl>
						<dt>新闻资讯</dt>
						<volist name="newMenu" id="newMenus">
						<a href=""><dd>{$newMenus['topic']}</dd></a>
						</volist>
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
					<p>Copyright © 2012-2018     备案号：{$sysconf['icpnote']} </p>
					<span>{$sysconf['address']}</span>
				</div>
			</div>
		</footer>