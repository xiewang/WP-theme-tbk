<?php get_header(); ?>

<?php 
    include "taobao/TopSdk.php";

    $params = explode("&",$_SERVER["QUERY_STRING"]);
    parse_str($_SERVER['QUERY_STRING'], $get);
    $coupon_click_url = isset($get['coupon_click_url'])?$get['coupon_click_url']:'';
    if($coupon_click_url!=''){
        // $coupon_click_url = substr($params[0],17,strlen($params[0])-17);
        // $coupon = substr($params[1],7,strlen($params[1])-7);
        // $price = substr($params[2],6,strlen($params[2])-6);
        // $final_price = substr($params[3],12,strlen($params[3])-12);
        // $volume = substr($params[4],7,strlen($params[4])-7);
        // $pict_url = substr($params[5],9,strlen($params[5])-9);
        // $content = substr($params[6],8,strlen($params[6])-8);
        // $title = substr($params[7],6,strlen($params[7])-6);
        // $coupon_total_count = substr($params[8],19,strlen($params[8])-19);
        $coupon_click_url = $get['coupon_click_url'];
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
    $c = new TopClient;
    $c->appkey = "24545248";
    $c->secretKey = "9e69eb2ab9fa086d31ddf043493a6a49";
    if (is_weixin()){
        
        $req = new WirelessShareTpwdCreateRequest;
        $tpwd_param = new GenPwdIsvParamDto;
        // $tpwd_param->ext="{\"xx\":\"xx\"}";
        $tpwd_param->logo= ($coupon_click_url!='')?$pict_url:get_post_meta($post->ID, "hao_zhutu", true);
        $tpwd_param->url= ($coupon_click_url!='')?$coupon_click_url:get_post_meta($post->ID, "hao_ljgm", true);;
        $tpwd_param->text= '来自半刀网分享的一件优质宝贝优惠券';
        // $tpwd_param->user_id="24234234234";
        $req->setTpwdParam(json_encode($tpwd_param));
        $resp = $c->execute($req);
         
        $kouling = $resp->model;
    }
    

    
   
    // echo $coupon_click_url.'</br>';
    // echo $coupon.'</br>';
    // echo $price.'</br>';
    // echo $final_price.'</br>';
    // echo $volume.'</br>';
    // echo $pict_url.'</br>';
    // echo $content.'</br>';
    // print_r($params);
?>
<script type="text/javascript">

    $(function(){
        $('#tuwenLink').click(function(){
            if($('#tuwenContent').find('img').length == 0){
               $('#tuwenLoading').show();
                <?php if(!isset($item_id)){?>
                var itemId = '<?php echo !empty(get_post_meta($post->ID, "item_id", true))?get_post_meta($post->ID, "item_id", true):"526283530705";?>';
                <?php }else{?>
                    var itemId = '<?php echo $item_id;?>';
                <?php }?>
                $.ajax({
                type:"get",
                url:"http://hws.m.taobao.com/cache/mtop.wdetail.getItemDescx/4.1/?&data={%22item_num_id%22:%22"+itemId+"%22}&type=jsonp&_=1502351053740",/*url写异域的请求地址*/
                dataType:"jsonp",
                success:function(res){
                        $('#tuwenLoading').hide();
                        var pages = res.data.images;
                        $.each(pages, function(k,v){
                            $('<img src='+v+' class="tuwenImg"/>').appendTo($('#tuwenContent'));
                        });
                    }
                }); 
            }
            
        });
        
    });
</script>

<div class="layout page padding-top" style="<?php echo wp_is_mobile() ? 'padding-top: 0;margin-top:-8px':''?>">
    <div id="content" class="container">
        <div class="main">
            <?php while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" class="line-big">
    <div class="xl12 xs6 xm4" style="<?php echo wp_is_mobile()?'padding: 0px':''?>">

         <img src="<?php echo ($coupon_click_url!='')?$pict_url:get_post_meta($post->ID, "hao_zhutu", true);?>" class=" img-responsive" alt=""/>
    </div>
    <div class="xl12 xs6 xm6 col1">
        <span class='single-title'><?php echo ($coupon_click_url!='')?urldecode($title):the_title(); ?></span>
    
        <div class="col1-a">
             <span class="text">推荐理由：<?php echo ($coupon_click_url!='')?urldecode($content):the_content(); ?></span> 
        </div>
        <div class="col1-b">
            <span class="xj">用券后<i>¥<strong><?php echo ($coupon_click_url!='')?$final_price:get_post_meta($post->ID, "hao_xianj", true);?></strong></i></span>
            <span class="yj">在售价<i>¥<?php echo ($coupon_click_url!='')?$price:get_post_meta($post->ID, "hao_yuanj", true);?></i></span>
        </div>
        <div class="col1-c">
            <!-- <span class="zl">商家提供<strong><?php echo ($coupon_click_url!='')?$coupon_total_count:get_post_meta($post->ID, "hao_zongl", true);?></strong>张优惠券丨</span> -->
            <span class="xl">月销量<strong><?php echo ($coupon_click_url!='')?$volume:get_post_meta($post->ID, "hao_xiaol", true);?></strong>件</span>
        </div>
        <?php if ( wp_is_mobile() ){ ?>
            <div id="buyNow" onclick="jumpToTaobao()">
                        <a href="#" >领券购买</a>
            </div>
        <?php }else { ?>
            <div class="col1-d" onclick=" window.open('<?php echo ($coupon_click_url!='')?$coupon_click_url:get_post_meta($post->ID, "hao_ljgm", true);?>')">
                <a href="#" >领券购买</a>
            </div>
           
        <?php } ?>

        <div class="col1-e">
            <p></p>
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
<div class="kouling hide" id="kouling">
    <div class="col1-tkl">
        <div class="kouling-title">淘宝口令</div>
        <div class="kouling-content">
            <textarea style="overflow-y:scroll" id="tkl" class="tkl" rows="7">复制这条信息，{<?php echo $kouling; ?>}，打开【手机淘宝】即可领券。&#13;&#10;---------------&#13;&#10;【在售价】 <?php echo ($coupon_click_url!='')?$price:get_post_meta($post->ID, "hao_yuanj", true);?> 元&#13;&#10;【券后价】 <?php echo ($coupon_click_url!='')?$final_price:get_post_meta($post->ID, "hao_xianj", true);?> 元&#13;&#10;---------------&#13;&#10;<?php echo ($coupon_click_url!='')?urldecode($title):the_title();?>
            </textarea>
           
            <input id="copy" class="but-tkl btn" type="button" data-clipboard-action="copy" data-clipboard-target="#tkl" value="一键复制" onclick="copy()">
            <p style="text-align: center;">如果无法一键复制，请长按手动复制。</p>
        </div>
        
    </div>
</div>
<script type="text/javascript">
    var showKL = false;
    function copy(){
        // var clip = new ZeroClipboard( document.getElementById("copy"), {
        //   moviePath: "<?php bloginfo('template_url'); ?>/ui/ZeroClipboard.swf"
        // }  );

        // clip.on( 'complete', function(client, args) {
        //    alert("复制成功，打开‘淘宝’APP去领券吧！");
        //    showKL = false;
        // } );
    }
    function jumpToTaobao(){
        <?php if(is_weixin()){?>
            $('#kouling').removeClass('hide');
            howKL = true;
            var clipboard = new Clipboard('.btn');
            clipboard.on('success', function(e) {
                alert("复制成功，快打开' 淘宝 'APP去领券吧！");
            });
        <?php }else {?>
            window.open('<?php echo ($coupon_click_url!='')?$coupon_click_url:get_post_meta($post->ID, "hao_ljgm", true);?>');
        <?php }?>

    }

    $('#kouling').on('click', function(e){
        var $target  = $(e.target);
        if($target.is("#kouling")){
            $('#kouling').addClass('hide');
            howKL = false;
        }
        
    });

    $(document).on('touchmove',function(e){
        if(howKL)
            e.preventDefault();
    })

    $(function(){
        <?php if(($coupon_click_url!='')){?>
            document.title = '<?php echo "半刀网推荐：".urldecode($title);?>'
        <?php }?>
    });
    
</script>

            <?php endwhile; ?>
        </div>

        
    </div>
</div>

<?php if(wp_is_mobile()){?>
    <div class="layout page padding-top" >
        <div id="content" class="container">
            <div id="tuwenLink"><span>图文详情</span></div>
            <div id="tuwenLoading"><span>稍等，加载中...</span></div>
            <div id="tuwenContent"></div>
        </div>
    </div>
<?php }?>

<div class="layout page padding-top" >
    <div id="content" class="container">
        <div class="jingp">
            <img src="<?php bloginfo('template_directory'); ?>/img/jingpintuijian.png" />
        </div>

        <div class="line-middle">
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
                        <a class="box-img" href="<?php the_permalink(); ?>" <?php echo wp_is_mobile()?'':'target="_blank"'?>>
                            <span class="icon-spinner for-img"></span>
                            <img src="<?php echo get_post_meta($post->ID, "hao_zhutu", true);?>" class="hide img-responsive" alt="<?php the_title(); ?>"/>
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
