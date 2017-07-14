<?php get_header(); ?>
<?php get_sidebar(); ?>
<div class="layout page padding-top">
    <div class="container">
        <div id="content" class="line-middle">
            <?php while (have_posts()) : the_post(); ?>

            <div class="post xl12 xs4 xm3 padding-bottom">
                <div class="box" onclick="window.open('<?php the_permalink(); ?>')">
                    <div class="box-image">
                        <a class="box-img" href="<?php the_permalink(); ?>" target="_blank">
                            <img src="<?php echo get_post_meta($post->ID, "hao_zhutu", true);?>" class="img-responsive" alt="<?php the_title(); ?>"/>
                        </a>
                    </div>
                    <div class="box-prod">
                        <div class="box-name">
                            <dt> 
                                <a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a>
                            </dt> 
                            <p class="box-txt">
                                 优惠券：<strong><?php echo get_post_meta($post->ID, "hao_youh", true);?>元</strong>
                            </p>
                            <dd class="box-price">
                                 <span>￥<?php echo get_post_meta($post->ID, "hao_xianj", true);?></span>
                                 <del>￥<?php echo get_post_meta($post->ID, "hao_yuanj", true);?></del>  
                            </dd>
                            <dd class="box-send">已有<?php echo get_post_meta($post->ID, "hao_xiaol", true);?>人购买</dd>
                        </div>
                    </div>
                    <div class="box-btn">
                        <?php if(get_post_meta($post->ID, "hao_leix", true) == '天猫'){ ?>
                            <img src="<?php bloginfo('template_url'); ?>/img/tm.png?>">
                        <?php };?>
                    </div>
                    <a class="box-btn" target="_blank" href="<?php the_permalink(); ?>"></a>
                </div>
            </div>

            <?php endwhile; ?>
        </div>
      <div class="pagenavi"><?php next_posts_link('下一页') ?>	<?php previous_posts_link('上一页') ?></div>
     </div>
</div>

<?php get_footer(); ?>