<?php 
    parse_str($_SERVER['QUERY_STRING'], $get);
    $searchType = $get['searchType'];
    if($searchType == 0){
        require 'searchapi.php';
        return; 
    }
    function is_weixin(){ 
        if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
                return true;
        }   
        return false;
    }
?>
<?php get_header(); ?>

<div class="layout page <?php echo wp_is_mobile()?'list':'padding-top'?>">
    <div class="container <?php echo wp_is_mobile()?'mobile':''?>">
        <div id="content" class="<?php echo wp_is_mobile()?'':'line-middle'?>">
            <div class="ad-sort">
                <a href="" target="_blank">
                    <img src="<?php bloginfo('template_url'); ?>/img/img2.png">
                </a>
            </div>
            <?php while (have_posts()) : the_post(); ?>
            <?php if ( get_post_meta($post->ID, "hao_zhutu", true) ){ ?>
            <div class="post xl12 xs4 xm3 padding-bottom">
                <?php if(wp_is_mobile()){?>
                    <div class="box" onclick=" jumpToNextPage('<?php the_permalink(); ?>','<?php the_title(); ?>')">
                <?php }else {?>
                    <div class="box" onclick=" window.open('<?php the_permalink(); ?>')">
                <?php }?>
                    <div class="box-image">
                        <a class="box-img" >
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
                                <a ><?php the_title(); ?></a>
                            </dt> 
                            <div class="box-txt">
                                <div class="box-juan-price"><span><?php echo get_post_meta($post->ID, "hao_youh", true);?>元</span></div>
                                <div class="box-juan"><span>券</span></div>
                            </div>

                            <dd class="box-price">
                                 <span>￥<?php echo get_post_meta($post->ID, "hao_xianj", true);?></span>
                                 <del>￥<?php echo get_post_meta($post->ID, "hao_yuanj", true);?></del>  
                            </dd>
                            <dd class="post-time"><?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) );?></dd>
                            <dd class="buy-count"><?php echo get_post_meta($post->ID, "hao_xiaol", true);?>人已买</dd>
                        </div>
                    </div>
                    
                </div>
            </div>
            <?php }?>
            <?php endwhile; ?>
        </div>
      <div class="pagenavi"><?php next_posts_link('下一页') ?> <?php previous_posts_link('上一页') ?></div>
      <div class="page-load-status">
          <div class="infinite-scroll-request">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/jiazai.gif" alt="Loading" />
            加载中...
          </div>
          <p class="infinite-scroll-error infinite-scroll-last">
            到底了噢！
          </p>
        </div>
     </div>
</div>
<div class="spinner hide">
    <div class=" icon-spinner for-img"></div>
</div>
<script type="text/javascript">
    var scrollTop = document.documentElement.scrollTop;
    function jumpToNextPage(url,title){
        if(navigator.userAgent.indexOf('UCBrowser')>-1){//uc 
            location.href = url;
        } else if('<?php echo is_weixin();?>' == 1
            || navigator.userAgent.toLowerCase().indexOf('weibo')) {
            jumpWithoutFresh(url,title);
        } else {
            window.open(url);
        }
    }

    var jumpWithoutFresh = function(url,title){
        document.title = '半刀网推荐：'+title;
        history.pushState({title:document.title,type:'signle'}, "signle", url);
        showKL = false;
        $('.spinner').removeClass('hide');
        $.ajax({
            type:"get",
            url: url,
            success:function(response){
                if(response){
                    $('body>*').not('.m-header').hide();
                    $('#single').remove();
                    var div = document.createElement('div');
                    div.id = 'single';
                    var html = $.parseHTML( response,'',false )
                    // div.innerHTML = response;
                    var html1 = [];
                    for(i=0;i<html.length;i++){
                        if(html[i].localName !== 'meta' && html[i].localName !== 'link' && html[i].className !== 'm-header'){
                            html1.push(html[i])
                        }
                    }
                    $('body').append(div);
                    // $('<div>d</div>').appendTo('body');
                    $(div).append(html1);
                    $(window).scrollTop(0);
                    $('.spinner').addClass('hide');
                }
            }
        }); 
    }
    jQuery(document).ready(function(){ 
         window.onpopstate = function (e) { 
            if(!e.state){
                $('body>*').not('.m-header').show();
                $('#single').hide();
                $(window).scrollTop(scrollTop);
            } else {
                $('body>*').not('.m-header').hide();
                $('#single').show();
            }
        }
        var infScroll = new InfiniteScroll( '#content', {
          append: '.post',
          path: '.pagenavi a',
          history: false,
          checkLastPage: true,
          status: '.page-load-status',
        });
        infScroll.on( 'append', function(){
            loadImg();
        } );
    });
</script>
<?php get_footer(); ?>