<?php

  add_action('admin_menu', 'option_page');
   
  function option_page()
  {
    if ( count( $_POST ) > 0 && isset( $_POST['zan_settings'] ) ) {
      $options = array( 
        'ID_1',
        'ID_2',
        'ID_3',
        'ID_4', 
        'ID_5', 
        'ID_6',
        'ID_7',
        'ID_8',
        'ID_9',
        'ID_10',
        'ID_11',
        'logo',
	'AD1',
	'gg',
	'keywords'
      );
      foreach ( $options as $opt ) {
        delete_option($opt, $_POST[$opt]);
        add_option($opt, $_POST[$opt]);
      }
    }
    $hookname =  add_submenu_page( 'themes.php','主题设置', '主题设置' , 'edit_themes', basename( __FILE__ ), 'zan_settings' );
    add_action( $hookname, 'zan_admin_scripts' );
  }

  // 引入样式
  function zan_admin_scripts() {
    global $shortname, $options;
    wp_enqueue_style( 'theme-css', get_template_directory_uri() . '/ui/pintuer.css', '', '3.0.0' );
    wp_enqueue_script( 'theme-jquery', get_template_directory_uri() . '/ui/jquery.js', '', '3.0.0', true );
    wp_enqueue_script( 'theme-js', get_template_directory_uri() . '/ui/pintuer.js', 'theme-jquery', '3.0.0', true );
  }
   
  function zan_settings()
  {
?>

<div class="wrap">
    <h2>主题选项</h2>
    <div class="alert alert-yellow margin-bottom">
        <span class="close rotate-hover"></span>
        <strong>注意：</strong>本主题未适配任何插件。如有乱码，请提前关闭所有插件。
    </div>
    <div class="tab margin-top">
        <div class="tab-head">
            <ul class="tab-nav">
                <li class="active">
                    <a href="#tab-start">主题教程</a></li>
                <li>
                    <a href="#tab-css">首页设置</a></li>
                <li>
                    <a href="#tab-units">基本设置</a></li>
            </ul>
        </div>
        <form method="post" class="form-x">
            <div class="tab-body">
                <div class="tab-panel active" id="tab-start">
		    <div class="panel margin-bottom">
                    	<div class="panel-head">更新说明：</div>
                        <div class="panel-body">
                             <h2 class="margin-bottom">2017.6.16日更新：增加商品信息输入面板</h2>
                             <ul class="margin-big-bottom">
                                 <li>1.增加商品信息输入面板。后台--写文章即可看到</li>
                                 <li>2.修改了一些细节</li>
                             </ul>
                             <h2 class="margin-bottom">2017.6.10日更新：主要更新有淘口令的产品显示</h2>
                             <ul class="margin-big-bottom">
                                 <li>1.增加新的自定义字段hao_tkl，主要针对有淘口令的产品。</li>
                                 <li>2.新增字段只在移动端显示：增加判断，只在移动端，且该字段有内容时显示。</li>
                                 <li>3.可以一键复制产品信息到剪切板，方便推广。</li>
                             </ul>
                             <h2 class="margin-bottom">2017.5.27日更新：本次主要更新导航栏。</h2>
                             <ul class="margin-big-bottom">
                                 <li>1.重做：移动端导航，现在可以滑动了。更像APP了</li>
                                 <li>2.导航置顶；页面下拉后，导航置顶（移动端和桌面端）。</li>
                                 <li>3.商品标题前增加店铺显示；</li>
                             </ul>
			</div>
                    </div>
                    <div class="panel margin-bottom">
                    	<div class="panel-head">简单介绍</div>
                        <div class="panel-body">
                             <p>超级折扣，为wordpress淘宝客主题。专注wordpress淘宝客主题开发，独有的“每天10分钟，轻松做淘客”教程。欢迎有兴趣的同学一起交流，学习。</p>
                             <p>主题预览网站：<a href="http://xbaba.cn">超级折扣</a> 作者网站：<a href="http://yhaow.com">Hao Blog</a></p>
                        </div>
                    </div>
                    <div class="panel margin-bottom">
                    	<div class="panel-head">下载&安装</div>
                        <div class="panel-body">
                             <p>主题下载请到我网站下载，具体入口自己找下，肯定会很醒目的。另外，该主题将投稿到各大主题网站，百度下应该也能找到。 同时欢迎大家转载该主题，留不留版权信息，就看人品了。主题本身没有特别需要的插件。直接下载安装包安装就可以了。</p>
                        </div>
                    </div>
                    <div class="panel margin-bottom">
                    	<div class="panel-head">常见问题</div>
                        <div class="panel-body">
                             <h2>问：怎么我安装的和预览网站不一样？</h2>
                             <p>你下载到的主题就是预览网站的主题，需要数据填充就可以了。</p>
                             <h2>问：主题菜单图标怎么设置？</h2>
                             <p>进入后台，外观--菜单，在导航名字前加入下边的代码即可（具体图标请查看首页模板）：<div class="doc-code"><xmp class=""><span class="icon">&#xe605;</span></xmp></div></p>
                             <h2>问：商品怎么发布</h2>
                             <p>后台写文章即可看到。</p>
                             <p>轻松淘客教程可10分钟导入1万条信息，欢迎大家去我网站了解</p>
                        </div>
                    </div>
                </div>
                <div class="tab-panel" id="tab-css">
			<h1>首页设置</h1><hr class="bg-gray" />
                    <div class="line-big">
                        <div class="x2">
                            <h1>文章分类及ID</h1>
                            <hr class="bg-gray" />
                            <ul class="list-unstyle height text-right">
                                <?php show_category(); ?></ul>
                        </div>
                        <div class="x10">
                            <h1>首页分类设置</h1>
                            <hr class="bg-gray" />
                            <div class="x6">
                                <div class="form-group">
                                    <div class="label">
                                        <label for="username">男装男鞋</label></div>
                                    <div class="field">
                                        <input class="input" name="ID_1" id="ID_1" type="text" value="<?php echo get_option('ID_1'); ?>"></div>
                                </div>
                                <div class="form-group">
                                    <div class="label">
                                        <label for="username">女装女鞋</label></div>
                                    <div class="field">
                                        <input class="input" name="ID_2" id="ID_2" type="text" value="<?php echo get_option('ID_2'); ?>"></div>
                                </div>
                                <div class="form-group">
                                    <div class="label">
                                        <label for="username">包包配饰</label></div>
                                    <div class="field">
                                        <input class="input" name="ID_3" id="ID_3" type="text" value="<?php echo get_option('ID_3'); ?>"></div>
                                </div>
                                <div class="form-group">
                                    <div class="label">
                                        <label for="username">运动户外</label></div>
                                    <div class="field">
                                        <input class="input" name="ID_4" id="ID_4" type="text" value="<?php echo get_option('ID_4'); ?>"></div>
                                </div>
                                <div class="form-group">
                                    <div class="label">
                                        <label for="username">美妆彩妆</label></div>
                                    <div class="field">
                                        <input class="input" name="ID_5" id="ID_5" type="text" value="<?php echo get_option('ID_5'); ?>"></div>
                                </div>
                                <div class="form-group">
                                    <div class="label">
                                        <label for="username">童装母婴</label></div>
                                    <div class="field">
                                        <input class="input" name="ID_6" id="ID_6" type="text" value="<?php echo get_option('ID_6'); ?>"></div>
                                </div>
                            </div>
                            <div class="x6">
                                <div class="form-group">
                                    <div class="label">
                                        <label for="username">零食茶饮</label></div>
                                    <div class="field">
                                        <input class="input" name="ID_7" id="ID_7" type="text" value="<?php echo get_option('ID_7'); ?>"></div>
                                </div>
                                <div class="form-group">
                                    <div class="label">
                                        <label for="username">内衣情趣</label></div>
                                    <div class="field">
                                        <input class="input" name="ID_8" id="ID_8" type="text" value="<?php echo get_option('ID_8'); ?>"></div>
                                </div>
                                <div class="form-group">
                                    <div class="label">
                                        <label for="username">数码家电</label></div>
                                    <div class="field">
                                        <input class="input" name="ID_9" id="ID_9" type="text" value="<?php echo get_option('ID_9'); ?>"></div>
                                </div>
                                <div class="form-group">
                                    <div class="label">
                                        <label for="username">居家生活</label></div>
                                    <div class="field">
                                        <input class="input" name="ID_10" id="ID_10" type="text" value="<?php echo get_option('ID_10'); ?>"></div>
                                </div>
                                <div class="form-group">
                                    <div class="label">
                                        <label for="username">汽车用品</label></div>
                                    <div class="field">
                                        <input class="input" name="ID_11" id="ID_11" type="text" value="<?php echo get_option('ID_11'); ?>"></div>
                                </div>
                            </div>
                            <hr /></div>
                    </div>
                </div>
                <div class="tab-panel" id="tab-units">
                    <h1>基本设置</h1>
                    <hr class="bg-gray" />
                    <div class="form-group">
                        <div class="label">
                            <label for="username">LOGO 链接</label></div>
                        <div class="field">
                            <input class="input" name="logo" id="logo" type="text" value="<?php echo get_option('logo'); ?>">
                            <div class="input-note">请输入完整的图片地址.别忘记 http:// 哦! 建议尺寸：350 × 100</div></div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="username">顶部广告 图片链接</label></div>
                        <div class="field">
                            <input class="input" name="AD1" id="AD1" type="text" value="<?php echo get_option('AD1'); ?>">
                            <div class="input-note">请输入完整的图片地址. 建议尺寸：430 × 100</div></div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="username">网站公告</label></div>
                        <div class="field">
                            <input class="input" name="gg" id="gg" type="text" value="<?php echo get_option('gg'); ?>">
                            <div class="input-note">滚动的网站公告</div></div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="username">关键字</label></div>
                        <div class="field">
                            <input class="input" name="keywords" id="keywords" type="text" value="<?php echo get_option('keywords'); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p class="submit">
                <input type="submit" name="Submit" class="button border-green" value="保存设置" />
                <input type="hidden" name="zan_settings" value="save" style="display:none;" />
        </p>
        </form>
    </div>


<?php
}
?>