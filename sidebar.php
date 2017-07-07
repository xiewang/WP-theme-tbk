<!-- sidebar -->
<aside class="xs3 hidden-l" role="complementary">

	<?php get_template_part('searchform'); ?>

<!-- search -->
<form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
	<input class="search-input" type="search" name="s" placeholder="<?php _e( '搜索，输入后回车。', 'hao' ); ?>">
	<button class="search-submit" type="submit" role="button"><?php _e( 'Search', 'hao' ); ?></button>
</form>
<!-- /search -->

	<div class="sidebar-widget">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
	</div>

	<div class="sidebar-widget">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?>
	</div>

</aside>
<!-- /sidebar -->

<?php if ( wp_is_mobile() ){ ?>
正在使用移动设备浏览
<?php }else { ?>
不是移动设备
<?php } ?>

        <div class="tab" data-toggle="hover">
	    <div class="tab-head">
		<ul class="tab-nav pt_3c">
			<li class="active"><a href="#tab-start2">男装</a> </li>
			<li><a href="#tab-css2">女装</a> </li>
			<li><a href="#tab-units2">鞋包配饰</a> </li>
		</ul>
	    </div>
	    <div class="tab-body tab-body-bordered line-middle">
		<div class="tab-panel active" id="tab-start2">
		    <?php query_posts('cat=3&showposts=8'); while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" class="xl12 xs4 xm3 padding-bottom">
                <div class="box">
                    <a href="<?php the_permalink(); ?>" target="_blank">
			<span class="box-jb box-jb-yhj"></span>
                        <img src="<?php echo get_post_meta($post->ID, "hao_zhutu", true);?>" class="img-responsive" alt="<?php the_title(); ?>"/>
                    </a>
                    <div class="box-prod">
                        <p class="box-txt">
                              <?php the_content(); ?>
                        </p>
                        <div class="box-name">
                            <dt> 
				<a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a>
                            </dt> 
                            <dd class="box-price">
                                 <span>￥<?php echo get_post_meta($post->ID, "hao_xianj", true);?></span>
                                 <del>￥<?php echo get_post_meta($post->ID, "hao_yuanj", true);?></del>
                            </dd>
                            <dd class="box-send">已有<?php echo get_post_meta($post->ID, "hao_xiaol", true);?>人购买</dd>
                        </div>
                    </div>
                    <a class="box-btn" target="_blank" href="<?php the_permalink(); ?>"></a>
                </div>
            </article>
		    <?php endwhile; wp_reset_query(); ?>
		</div>
		<div class="tab-panel" id="tab-css2">
		    <?php query_posts('cat=3&showposts=8'); while (have_posts()) : the_post(); ?>
		        <article class="xl12 xs4 xm3 padding-bottom">
		            <div class="hao-box">
				<img src="<?php echo get_post_meta($post->ID, "hao_zhutu", true);?>" class="img-responsive" alt="<?php the_title(); ?>"/>
				<div class="txt" style="height: 45px; overflow: hidden;">
					<h3 style="padding-top: 0px;"><?php the_content(); ?></h3>
					<p><?php the_title(); ?></p>
				</div>
		            </div>
		        </article>
		    <?php endwhile; wp_reset_query(); ?>
		</div>
		<div class="tab-panel" id="tab-units2">

		</div>
	    </div>
        </div>