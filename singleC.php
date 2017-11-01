

<?php 
    include "taobao/TopSdk.php";

    $params = explode("&",$_SERVER["QUERY_STRING"]);
    parse_str($_SERVER['QUERY_STRING'], $get);
    $coupon_click_url = isset($get['coupon_click_url'])?$get['coupon_click_url']:'';
    $pict_url = isset($get['pict_url'])?$get['pict_url']:'';
    if($coupon_click_url!=''&&$pict_url==''){
        wp_redirect(htmlspecialchars_decode('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"])); exit;
    }

    if($coupon_click_url!=''){
        $coupon = $get['coupon'];
        $price = $get['price'];
        $final_price = $get['final_price'];
        $volume = $get['volume'];
        $pict_url = $get['pict_url'];
        $content = $get['content'];
        $title = $get['title'];
        $coupon_total_count = $get['coupon_total_count'];
        $item_id = $get['item_id'];
    }

    function is_weixin(){ 
        if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
                return true;
        }   
        return false;
    }
    $kouling = '';
    // $c = new TopClient;
    // $c->appkey = "24545248";
    // $c->secretKey = "9e69eb2ab9fa086d31ddf043493a6a49";
 
    function get_kouling($post,$coupon_click_url,$pict_url,$coupon_click_url){
        $kouling = '';
        $c = new TopClient;
        $c->appkey = "24545248";
        $c->secretKey = "9e69eb2ab9fa086d31ddf043493a6a49";
        $req = new TbkTpwdCreateRequest;
        // $tpwd_param = new GenPwdIsvParamDto;
        // // $tpwd_param->ext="{\"xx\":\"xx\"}";
        // $tpwd_param->logo= ($coupon_click_url!='')?$pict_url:get_post_meta($post->ID, "hao_zhutu", true);
        // $tpwd_param->url= ($coupon_click_url!='')?$coupon_click_url:get_post_meta($post->ID, "hao_ljgm", true);;
        // $tpwd_param->text= '来自半刀网分享的一件优质宝贝优惠券';
        // // $tpwd_param->user_id="24234234234";
        // $req->setTpwdParam(json_encode($tpwd_param));

        // $req->setUserId("123");
        $req->setText('来自半刀网分享的一件优质宝贝优惠券');
        $req->setUrl(($coupon_click_url!='')?$coupon_click_url:get_post_meta($post->ID, "hao_ljgm", true));
        $req->setLogo(($coupon_click_url!='')?$pict_url:get_post_meta($post->ID, "hao_zhutu", true));
        $req->setExt("{}");
        $resp = $c->execute($req);

        $kouling = $resp->data->model;
        return $kouling;
    }

    if(isset($_POST['kouling'])){
        while (have_posts()) : 
            the_post();
            $kouling = get_kouling($post,$coupon_click_url);
            echo $kouling;
            return;
        endwhile;
    }

    if(!isset($item_id)){
        $item_id_temp = get_post_meta($post->ID, "item_id", true);
        $itemId = !empty($item_id_temp)?get_post_meta($post->ID, "item_id", true):"526283530705";;
    }else{
        $itemId = $item_id;;
    }
?>
<?php get_header(); ?>

<div class="layout page padding-top" style="<?php echo wp_is_mobile() ? 'padding-top: 0;margin-top:-8px':''?>">
    <div id="content" class="container">
        <div class="main">
            <?php 
                while (have_posts()) : the_post(); 
                    if(get_post_meta($post->ID, "kouling", true)){
                        $kouling = get_post_meta($post->ID, "kouling", true);
                    } else if (is_weixin()){
                        if($coupon_click_url!=''){
                            $kouling = get_kouling($post,$coupon_click_url,$pict_url,$coupon_click_url);
                        } else {
                            $kouling = get_kouling($post,$coupon_click_url,'','');
                        }
                    }
            ?>
<article id="post-<?php the_ID(); ?>" class="line-big">
    <?php         
        $taobaoUrl = ($coupon_click_url!='')?$coupon_click_url:get_post_meta($post->ID, "hao_ljgm", true);
    ?>
    <div onclick="jumpToTaobao('<?php echo is_weixin()?'true':'false';?>','<?php echo $taobaoUrl;?>')" class="xl12 xs6 xm4" style="<?php echo wp_is_mobile()?'padding: 0px':''?>">
         <img src="<?php echo ($coupon_click_url!='')?$pict_url:get_post_meta($post->ID, "hao_zhutu", true);?>" class=" img-responsive" alt=""/>
    </div>
    <div class="xl12 xs6 xm6 col1">
        <div class="box-btn" style="position: absolute;display: block;top:<?php echo wp_is_mobile()? '12': '2'?>px">
            <?php if(get_post_meta($post->ID, "hao_leix", true) == '天猫'){ ?>
                <img src="<?php bloginfo('template_url'); ?>/img/tm.png?>">
            <?php };?>
        </div>
        <span class='single-title' style="display: inline-block;text-indent: <?php echo (get_post_meta($post->ID, "hao_leix", true) == '天猫')? '20px': '0px'?>"><?php echo ($coupon_click_url!='')?urldecode($title):the_title(); ?></span>
    
        <div class="col1-a">
             <span class="text">推荐理由：<?php echo ($coupon_click_url!='')?urldecode($content):the_content(); ?></span> 
        </div>
        <div class="col1-b">
            <span class="xj">用券后：<i>¥<strong><?php echo ($coupon_click_url!='')?$final_price:get_post_meta($post->ID, "hao_xianj", true);?></strong></i></span>
            <span class="yj">在售价：<del>¥<?php echo ($coupon_click_url!='')?$price:get_post_meta($post->ID, "hao_yuanj", true);?></i></span>
        </div>
        <div class="col1-c">
            <!-- <span class="zl">商家提供<strong><?php echo ($coupon_click_url!='')?$coupon_total_count:get_post_meta($post->ID, "hao_zongl", true);?></strong>张优惠券丨</span> -->
            <span class="xl">月销量<strong><?php echo ($coupon_click_url!='')?$volume:get_post_meta($post->ID, "hao_xiaol", true);?></strong>件</span>
        </div>
        <?php if ( wp_is_mobile() ){ ?>
            <div id="buyNow" onclick="jumpToTaobao('<?php echo is_weixin()?'true':'false';?>','<?php echo $taobaoUrl;?>')" style="">
                        <a href="javascript:void(0);" >领券购买</a>
            </div>
        <?php }else { ?>
            <div class="col1-d pc-buy-botton" onclick=" window.open('<?php echo ($coupon_click_url!='')?$coupon_click_url:get_post_meta($post->ID, "hao_ljgm", true);?>')">
                <a href="#" >领券购买</a>
            </div>
           
        <?php } ?>

        <div class="col1-e">
            <p></p>
            <div class="text">
                <span>你还可以把这个宝贝分享给你的朋友：</span>
                <?php if(wp_is_mobile()){?>
                    <div class="bdsharebuttonbox">
                        <?php 
                            $urlF = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; 
                            $contentF = ($coupon_click_url!='')?urldecode($title):get_the_title().'\n【在售价'.(($coupon_click_url!='')?$price:get_post_meta($post->ID, "hao_yuanj", true)).'元\n【券后价】'.(($coupon_click_url!='')?$final_price:get_post_meta($post->ID, "hao_xianj", true)).'元\n【下单链接】';
                        ?>
                        <div id="shareWeixin" onclick="shareWeixin('<?php echo $coupon_click_url?>','<?php echo $urlF;?>')"></div>
                        <div id="shareWeibo" onclick="shareWeibo('<?php echo ($coupon_click_url!='')?$pict_url:get_post_meta($post->ID, "hao_zhutu", true);?>','<?php echo $contentF;?>')"></div>
                    </div>
                <?php }else{?>
                    <div class="bdsharebuttonbox">
                        <a href="#" class="bds_more" data-cmd="more"></a>
                        <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                        <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                        <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                        <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
                        <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                    </div>
                <?php }?>
                
            </div>
        </div>
    </div>

</article>
<div class="kouling hide" id="kouling">
    <div class="col1-tkl">
        <div class="kouling-title">淘宝口令</div>
        <div class="kouling-content">
            <textarea style="overflow-y:scroll" id="tkl1" class="tkl" rows="7" cols="8">复制这条信息，{<?php echo $kouling; ?>}，打开【手机淘宝】即可领券购买。&#13;&#10;---------------&#13;&#10;【在售价】 <?php echo ($coupon_click_url!='')?$price:get_post_meta($post->ID, "hao_yuanj", true);?> 元&#13;&#10;【券后价】 <?php echo ($coupon_click_url!='')?$final_price:get_post_meta($post->ID, "hao_xianj", true);?> 元&#13;&#10;---------------&#13;&#10;<?php echo ($coupon_click_url!='')?urldecode($title):the_title();?></textarea>
           
            <input id="copy1" class="but-tkl btn1" type="button" data-clipboard-action="copy" data-clipboard-target="#tkl1" value="一键复制" >
            <p style="text-align: center;">如果无法一键复制，请长按手动复制。</p>
        </div>
        
    </div>
</div>
<div class="kouling hide" id="share">
    <div class="col1-tkl">
        <div class="kouling-title">分享</div>
        <div class="kouling-content">
            <textarea style="overflow-y:scroll" id="tkl2" class="tkl" rows="7" cols="18"><?php echo ($coupon_click_url!='')?urldecode($title):the_title();?>&#13;&#10;---------------&#13;&#10;【在售价】 <?php echo ($coupon_click_url!='')?$price:get_post_meta($post->ID, "hao_yuanj", true);?> 元&#13;&#10;【券后价】 <?php echo ($coupon_click_url!='')?$final_price:get_post_meta($post->ID, "hao_xianj", true);?> 元&#13;&#10;【下单链接】<?php echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; ?> &#13;&#10;复制这条信息，{<?php echo $kouling; ?>}，打开【手机淘宝】即可领券购买。</textarea>
           
            <input id="copy2" class="but-tkl btn2" type="button" data-clipboard-action="copy" data-clipboard-target="#tkl2" value="一键复制" >
            <p style="text-align: center;">如果无法一键复制，请长按手动复制。</p>
        </div>
        
    </div>
</div>
<script type="text/javascript">

    
</script>

            <?php endwhile; ?>
        </div>

        
    </div>
</div>

<?php if(wp_is_mobile()){?>
    <div class="layout page padding-top" >
        <div id="content" class="container">
            <div id="tuwenLink" itemId='<?php echo $itemId;?>'><span>图文详情</span></div>
            <div id="tuwenLoading"><span>稍等，加载中...</span></div>
            <div id="tuwenContent"></div>
        </div>
    </div>
<?php }?>

<div class="layout page padding-top" >
    <div id="content" class="container <?php echo wp_is_mobile()?'mobile':''?>">
        <div class="jingp">
            <img src="<?php bloginfo('template_directory'); ?>/img/jingpintuijian.png" />
        </div>

        <div class="<?php echo wp_is_mobile()?'':'line-middle'?>">
            <?php if ( is_single() ) : global $post;   $categories = get_the_category();  foreach ($categories as $category) :  ?>  
            
            <?php
                function wt_get_category_count($input = '') {
                    global $wpdb;

                    if($input == '') {
                        $category = get_the_category();
                        return $category[0]->category_count;
                    }
                    elseif(is_numeric($input)) {
                        $SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->term_taxonomy.term_id=$input";
                        return $wpdb->get_var($SQL);
                    }
                    else {
                        $SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->terms.slug='$input'";
                        return $wpdb->get_var($SQL);
                    }
                }

                $cate_count =  wt_get_category_count($category->cat_ID);
                $offset = rand(0,$cate_count-20);
                // print_r($category);
                // echo $cate_count;
                // echo get_category($category->cat_ID)->count;
            ?>
            <?php $posts=get_posts('offset='.$offset.'&numberposts=20&category='.($category->term_id!=49?$category->term_id:30).'&exclude='.get_the_ID());foreach($posts as $post) : ?> 
            <div class="post xl12 xs4 xm3 padding-bottom">
                <?php if(wp_is_mobile()){?>
                    <div class="box" onclick=" location.href='<?php the_permalink(); ?>'">
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
                            <dd class=""><?php echo get_post_meta($post->ID, "hao_xiaol", true);?>人已买</dd>
                        </div>
                    </div>
                    
                </div>
            </div>
            <?php endforeach; ?>  
            <?php endforeach; endif ; ?>  
        </div>
    </div>
</div>

<script src="<?php bloginfo('template_url'); ?>/ui/single.js" type="text/javascript" ></script>

<?php get_footer(); ?>
