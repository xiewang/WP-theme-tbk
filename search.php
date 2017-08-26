<?php 
    require 'searchapi.php';
    return;
?>
<?php get_header(); ?>

<div class="layout page padding-top">
    <div class="container <?php echo wp_is_mobile()?'mobile':''?>">
        <div id="content" class="line-middle">
            <?php while (have_posts()) : the_post(); ?>
            <?php if ( get_post_meta($post->ID, "hao_zhutu", true) ){ ?>
            <div class="post xl12 xs4 xm3 padding-bottom">
                <?php if(wp_is_mobile()){?>
                    <div class="box" onclick=" location.href='<?php the_permalink(); ?>'">
                <?php }else {?>
                    <div class="box" onclick=" window.open('<?php the_permalink(); ?>')">
                <?php }?>
                    <div class="box-image">
                        <a class="box-img" href="<?php the_permalink(); ?>" <?php echo wp_is_mobile()?'':'target="_blank"'?>>
                            <span class="icon-spinner for-img"></span>
                            <img src="<?php echo get_post_meta($post->ID, "hao_zhutu", true);?>" class="hide img-responsive" alt="<?php the_title(); ?>"/>
                        </a>
                    </div>
                    <div class="box-prod">
                        <div class="box-btn" style="display: block;top:<?php echo wp_is_mobile()? '0': '17'?>px">
                            <?php if(get_post_meta($post->ID, "hao_leix", true) == '天猫'){ ?>
                                <img src="<?php bloginfo('template_url'); ?>/img/tm.png?>">
                            <?php };?>
                        </div>

                        <div class="box-name">
                            <dt style="text-indent: <?php echo get_post_meta($post->ID, "hao_leix", true) == '天猫'? '20px': '0px'?>"> 
                                <a href="<?php the_permalink(); ?>" <?php echo wp_is_mobile()?'':'target="_blank"'?>><?php the_title(); ?></a>
                            </dt> 
                            <div class="box-txt">
                                <div class="box-juan-price"><span><?php echo get_post_meta($post->ID, "hao_youh", true);?>元</span></div>
                                <div class="box-juan"><span>券</span></div>
                            </div>

                            <dd class="box-price">
                                 <span>￥<?php echo get_post_meta($post->ID, "hao_xianj", true);?></span>
                                 <del>￥<?php echo get_post_meta($post->ID, "hao_yuanj", true);?></del>  
                            </dd>
                            <dd class=""><?php echo get_post_meta($post->ID, "hao_xiaol", true);?>人已买</dd>
                        </div>
                    </div>
                    
                </div>
            </div>
            <?php }?>
            <?php endwhile; ?>
        </div>
      <div class="pagenavi"><?php next_posts_link('下一页') ?> <?php previous_posts_link('上一页') ?></div>
     </div>
</div>

<?php get_footer(); ?>