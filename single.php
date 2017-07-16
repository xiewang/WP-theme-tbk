<?php get_header(); ?>

<div class="layout page padding-top">
    <div id="content" class="container">
        <div class="main">
            <?php while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" class="line-big">
    <div class="xl12 xs6 xm4" style="<?php echo wp_is_mobile()?'padding: 0px':''?>">
         <img src="<?php echo get_post_meta($post->ID, "hao_zhutu", true);?>" class="img-responsive" alt="<?php the_title(); ?>"/>
    </div>
    <div class="xl12 xs6 xm6 col1">
        <span class='single-title'><?php the_title(); ?></span>
    
        <div class="col1-a">
             <span class="text">推荐理由：<?php the_content(); ?></span> 
        </div>
        <div class="col1-b">
            <span class="xj">用券后<i>¥<strong><?php echo get_post_meta($post->ID, "hao_xianj", true);?></strong></i></span>
            <span class="yj">在售价<i>¥<?php echo get_post_meta($post->ID, "hao_yuanj", true);?></i></span>
        </div>
        <div class="col1-c">
            <span class="zl">商家提供<strong><?php echo get_post_meta($post->ID, "hao_zongl", true);?></strong>张优惠券丨</span>
            <span class="xl">月销量<strong><?php echo get_post_meta($post->ID, "hao_xiaol", true);?></strong>件</span>
        </div>
        <?php if ( wp_is_mobile() ){ ?>
            <?php if (get_post_meta($post->ID, "hao_tkl", true)) { ?>
                <div class="col1-tkl">
                    <textarea id="tkl" class="tkl" rows="5"><?php the_title(); ?>&#13;&#10;【在售价】 <?php echo get_post_meta($post->ID, "hao_yuanj", true);?> 元&#13;&#10;【券后价】 <?php echo get_post_meta($post->ID, "hao_xianj", true);?> 元&#13;&#10;---------------&#13;&#10;复制这条信息，{<?php echo get_post_meta($post->ID, "hao_tkl", true);?>}，打开【手机淘宝】即可查看。</textarea>
                    <input id="copy" class="but-tkl" type="button" data-clipboard-target="tkl" value="一键复制">
                    <p>如果无法一键复制，请长按手动复制。</p>
                    <script type="text/javascript">
                        var clip = new ZeroClipboard( document.getElementById("copy") );
                    </script>
                </div>
            <?php } else { ?>
                    <div class="col1-d" onclick=" window.open('<?php echo get_post_meta($post->ID, "hao_ljgm", true);?>')">
                        <a href="#" >领券 & 购买</a>
                    </div>
            <?php } ?>
        <?php }else { ?>
            <div class="col1-d" onclick=" window.open('<?php echo get_post_meta($post->ID, "hao_ljgm", true);?>')">
                <a href="#" >领券 & 购买</a>
            </div>
        <?php } ?>

        <div class="col1-e">
            <p>提示：微信和QQ，请使用手机浏览器打开</p>
            <div class="text">
                你还可以把这个宝贝分享给你的朋友：
                <div class="bdsharebuttonbox">
                    <a href="#" class="bds_more" data-cmd="more"></a>
                    <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                    <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                    <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                    <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
                    <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                </div>
            </div>
        </div>
    </div>

</article>
            <?php endwhile; ?>
        </div>

        <div class="jingp">
            <img src="<?php bloginfo('template_directory'); ?>/img/jingpintuijian.png" />
        </div>
        <div class="line-middle">
            <?php if ( is_single() ) : global $post;   $categories = get_the_category();  foreach ($categories as $category) :  ?>  
            <?php $posts=get_posts('numberposts=20&category='.$category->term_id.'&exclude='.get_the_ID());foreach($posts as $post) : ?> 
            <div class="post xl12 xs4 xm3 padding-bottom">
                <?php if(wp_is_mobile()){?>
                    <div class="box" onclick=" location.href='<?php the_permalink(); ?>'">
                <?php }else {?>
                    <div class="box" onclick=" window.open('<?php the_permalink(); ?>')">
                <?php }?>
                    <div class="box-image">
                        <a class="box-img" href="<?php the_permalink(); ?>" <?php echo wp_is_mobile()?'':'target="_blank"'?>>
                            <img src="<?php echo get_post_meta($post->ID, "hao_zhutu", true);?>" class="img-responsive" alt="<?php the_title(); ?>"/>
                        </a>
                    </div>
                    <div class="box-prod">
                        <div class="box-btn">
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
                            <dd class="box-send">已有<?php echo get_post_meta($post->ID, "hao_xiaol", true);?>人购买</dd>
                        </div>
                    </div>
                    
                </div>
            </div>
            <?php endforeach; ?>  
            <?php endforeach; endif ; ?>  
        </div>
    </div>
</div>

<?php get_footer(); ?>