<?php get_header(1); ?>
            
<?php wp_redirect('/bd/category/today?page_no=1'); exit; ?> 

<div class="layout page padding-large-top padding-large-bottom">
    <div id="content" class="container">
	<div class="text-center">
            <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
                <img src="<?php echo get_option('logo'); ?>" alt="<?php bloginfo('name'); ?>"  />
            </a>

            <div class="padding">
                <form class="s" method="get" action="<?php bloginfo('url'); ?>" role="search">
                	<input class="sy-input" type="search" name="s" placeholder="懒得找，直接输入...">
                	<button class="sy-submit" type="submit" role="button"><span class="icon-search"></span></button>
                </form>
            </div>
        </div>



        <div class="line-middle">
            <div class="xl6 xs3 padding-bottom">
		<a target="_blank" href="<?php bloginfo('url'); ?>/?cat=<?php echo get_option('ID_1'); ?>">
                    <div class="sy-hd pt_3c text-center">
                        <div class="iconfont">&#xe605;</div>
                	<div class="sy-txt">男装</div>
                    </div>
		</a>
            </div>
            <div class="xl6 xs3 padding-bottom">
		<a target="_blank" href="<?php bloginfo('url'); ?>/?cat=<?php echo get_option('ID_2'); ?>">
                    <div class="sy-hd pt_beauty text-center">
                        <div class="iconfont">&#xe602;</div>
                	<div class="sy-txt">女装</div>
                    </div>
		</a>
            </div>
            <div class="xl6 xs2 padding-bottom">
		<a target="_blank" href="<?php bloginfo('url'); ?>/?cat=<?php echo get_option('ID_3'); ?>">
                    <div class="sy-hd pt_electronic text-center">
                        <div class="iconfont">&#xe624;</div>
                	<div class="sy-txt">箱包配饰</div>
                    </div>
		</a>
            </div>
            <div class="xl6 xs2 padding-bottom">
		<a target="_blank" href="<?php bloginfo('url'); ?>/?cat=<?php echo get_option('ID_4'); ?>">
                    <div class="sy-hd pt_phone text-center">
                        <div class="iconfont">&#xe618;</div>
                	<div class="sy-txt">户外运动</div>
                    </div>
		</a>
            </div>
            <div class="xl6 xs2 padding-bottom">
		<a target="_blank" href="<?php bloginfo('url'); ?>/?cat=<?php echo get_option('ID_5'); ?>">
                    <div class="sy-hd pt_cloth text-center">
                        <div class="iconfont">&#xe622;</div>
                	<div class="sy-txt">化妆品</div>
                    </div>
		</a>
            </div>
            <div class="xl6 xs2 padding-bottom">
		<a target="_blank" href="<?php bloginfo('url'); ?>/?cat=<?php echo get_option('ID_6'); ?>">
                    <div class="sy-hd pt_sport text-center">
                        <div class="iconfont">&#xe679;</div>
                	<div class="sy-txt">母婴</div>
                    </div>
		</a>
            </div>
            <div class="xl6 xs2 padding-bottom">
		<a target="_blank" href="<?php bloginfo('url'); ?>/?cat=<?php echo get_option('ID_7'); ?>">
                    <div class="sy-hd pt_baby text-center">
                        <div class="iconfont">&#xe619;</div>
                	<div class="sy-txt">美食</div>
                    </div>
		</a>
            </div>

            <div class="xl6 xs2 padding-bottom">
		<a target="_blank" href="<?php bloginfo('url'); ?>/?cat=<?php echo get_option('ID_9'); ?>">
                    <div class="sy-hd pt_game text-center">
                        <div class="iconfont">&#xe609;</div>
                	<div class="sy-txt">数码家电</div>
                    </div>
		</a>
            </div>
            <div class="xl6 xs2 padding-bottom">
		<a target="_blank" href="<?php bloginfo('url'); ?>/?cat=<?php echo get_option('ID_10'); ?>">
                    <div class="sy-hd pt_travel text-center">
                        <div class="iconfont">&#xe62f;</div>
                	<div class="sy-txt">居家</div>
                    </div>
		</a>
            </div>
            <div class="xl12 xs2 padding-bottom">
		<a target="_blank" href="<?php bloginfo('url'); ?>/?cat=<?php echo get_option('ID_11'); ?>">
                    <div class="sy-hd pt_finance text-center">
                        <div class="iconfont">&#xe656;</div>
                	<div class="sy-txt">汽车用品</div>
                    </div>
		</a>
            </div>
        </div>

	<div class="sy-tj">
	    <p>现有优惠券商品<strong><?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish; ?></strong>件
	    <br>最后更新：<strong><?php $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");$last = date('Y-n-j', strtotime($last[0]->MAX_m));echo $last; ?></strong></p>
	</div>
    </div>
</div>

<?php get_footer(); ?>