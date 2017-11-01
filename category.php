<?php if (is_archive() && ($paged > 1) && ($paged < $wp_query->max_num_pages)) { ?>
<link rel="prefetch prerender" href="<?php echo get_next_posts_page_link(); ?>">
<?php } ?>
<?php 

session_start(); 
$thiscat = get_category($cat); 
$cate = isset($thiscat ->name)?$thiscat ->name:'今日更新';
get_header(); 
if($cate == '今日更新' 
    ||$cate == '人气推荐'
    ||$cate == '9块9包邮'
    ||$cate == '明星周边'
    ||$cate == '好券抢购'
    ||$cate == '你没见过'){
    get_sidebar();
} else {
    include "cateandsort.php";
}
?>
<?php 
    include "taobao/TopSdk.php";
    include "taobao/top/request/TbkUatmFavoritesItemGetRequest.php";

    $c = new TopClient;
    $c->appkey = "24545248";
    $c->secretKey = "9e69eb2ab9fa086d31ddf043493a6a49";
    $req = new TbkUatmFavoritesItemGetRequest;
    if(wp_is_mobile()){
        $req->setPlatform("2");
    } else {
        $req->setPlatform("1");
    }
    $pageSize = 10;
    $req->setPageSize((string)$pageSize);
    $req->setAdzoneId("119412095");
    $req->setUnid("3456");
    if(isset($_SERVER['QUERY_STRING'])){
        parse_str($_SERVER['QUERY_STRING'], $get);

        if(isset($get['page'])){
            $page_no = $get['page']+1;
        } else {
            $page_no = 1;
        }
    } else {
        $page_no = 1;
    }

    if(isset($_SESSION['favNo'])){
        $favNo = $_SESSION['favNo'];
    } else {
        $favNo = 1;
    }

    if(isset($_SESSION['PageNo'])){
        $PageNo = $_SESSION['PageNo'] + 1;
    } else {
        $PageNo = 1;
    }
    // echo $_SESSION['PageNo'];

    if($page_no == 1){
        $favNo = 1;
        $PageNo = 1;
    }
    
    $req->setFields("coupon_total_count,coupon_info,coupon_click_url,num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,seller_id,volume,nick,shop_title,zk_final_price_wap,event_start_time,event_end_time,tk_rate,status,type");
    
    
    $main = false;
    if($cate == '人气推荐'){
         $favorites= getFavoritArr('人气');
         $main = true;
    } 
    elseif($cate == '9块9包邮'){
        $favorites= getFavoritArr('9块9');
        $main = true;
    }
    elseif($cate == '明星周边'){
        $favorites= getFavoritArr('明星'); 
        $main = true;
    }
    elseif($cate == '你没见过'){
        $favorites= getFavoritArr('你没见过'); 
        $main = true;
    }

    if($main == true){
        $_SESSION['favNo'] = $favNo;
        $_SESSION['PageNo'] = $PageNo;
        $req->setFavoritesId($favorites[$favNo-1]);
        $req->setPageNo((string)$PageNo);
        $resp = $c->execute($req);
        $temp = json_decode(json_encode($resp),TRUE);
        $total = isset($temp['total_results'])?$temp['total_results']:0;
        if($total > 0){
            $uatm_tbk_item = $temp['results']['uatm_tbk_item'];
            $mainList = array2object($uatm_tbk_item);
        } elseif(($total == 0) && (count($favorites) != $favNo)){
            $_SESSION['favNo'] = $favNo+1;
            $_SESSION['PageNo'] = 1;
            $req->setFavoritesId($favorites[$favNo]);
            $req->setPageNo(1);
            $resp = $c->execute($req);
            $temp = json_decode(json_encode($resp),TRUE);
            $uatm_tbk_item = $temp['results']['uatm_tbk_item'];
            $mainList = array2object($uatm_tbk_item);
        } elseif(($total == 0) && (count($favorites) == $favNo)){
            $mainList  = array();
        }
        
    }

    function array2object($array) {
      if (is_array($array)) {
        $obj = new StdClass();
        foreach ($array as $key => $val){
          $obj->$key = $val;
        }
      }
      else { $obj = $array; }
      return $obj;
    }

    function getFavoritArr($name){
        $arr=array();
        $c = new TopClient;
        $c->appkey = "24545248";
        $c->secretKey = "9e69eb2ab9fa086d31ddf043493a6a49";
        $req1 = new TbkUatmFavoritesGetRequest;
        $req1->setPageNo("1");
        $req1->setPageSize("20");
        $req1->setFields("favorites_title,favorites_id,type");
        $req1->setType("-1");
        $resp11 = $c->execute($req1);
        $temp = json_decode(json_encode($resp11),TRUE);
        $fList = array2object($temp['results']['tbk_favorites']);
        foreach ($fList as $item){
            $item = array2object($item);
            if(strpos($item->favorites_title,$name) !== false){
                array_push($arr,$item->favorites_id);
            }
        }
        return $arr;
    }
    function is_weixin(){ 
        if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
                return true;
        }   
        return false;
    }
?>

<?php 
    // include "cateapi.php";
?>
<div class="layout page <?php echo wp_is_mobile()?'list':'padding-top'?>">
    <div class="container <?php echo wp_is_mobile()?'mobile':''?>">
        <div id="content" class="<?php echo wp_is_mobile()?'':'line-middle'?>">
            <?php  
                if($main && isset($mainList) && count($mainList)>0){
                    foreach ($mainList as $item){ 
                        $item = array2object($item);
                        $coupon = 0;
                        if(isset($item->coupon_info)){
                            $str = $item->coupon_info;
                            $arr = explode("元",$str);
                            if(count($arr)>2){
                                $temp = explode("减",$arr[1]);
                                $coupon = $temp[1];
                            } else {
                                $coupon = $arr[0];
                            }
                        }
                        $coupon = ceil($coupon);
                                   

                        if(isset($item->coupon_click_url)){
                            $jump_url = '/bd/32322/?coupon_click_url='.$item->coupon_click_url.'&coupon='.$coupon.'&price='.$item->zk_final_price.'&final_price='.($item->zk_final_price-$coupon).'&volume='.$item->volume.'&pict_url='.$item->pict_url.'&content='.$item->coupon_info.'&title='.$item->title.'&coupon_total_count='.$item->coupon_total_count.'&item_id='.$item->num_iid;
                        } else {
                            // $jump_url = $item->item_url;
                            $jump_url = "http://www.996shop.com";
                        }
            ?>
                <div class="post xl12 xs4 xm3 padding-bottom">
                    <?php if(wp_is_mobile()){?>
                        <div class="box" onclick=" jumpToNextPage('<?php echo $jump_url; ?>','<?php echo $item->title; ?>')" >
                    <?php }else {?>
                        <div class="box" onclick=" window.open('<?php echo $jump_url; ?>')">
                        <?php }?>
                        <div class="box-image">
                            <a class="box-img" >
                                <img src="<?php echo $item->pict_url?>" class="img-responsive" alt=""/>
                            </a>
                        </div>
                        <div class="box-prod">
                            <div class="box-btn" style="display: block;top:<?php echo wp_is_mobile()? '0': '17'?>px">
                                <?php if($item->user_type == 1){ ?>
                                    <img src="<?php bloginfo('template_url'); ?>/img/tm.png?>">
                                <?php };?>
                            </div>

                            <div class="box-name">
                                <dt style="text-indent: <?php echo $item->user_type == 1? '20px': '0px'?>"> 
                                    <a ><?php echo $item->title; ?></a>
                                </dt> 
                                
                                <div class="box-txt">
                                    <div class="box-juan-price"><span><?php echo $coupon==0?'领完了':$coupon.'元';?></span></div>
                                    <div class="box-juan"><span>券</span></div>
                                </div>

                                <dd class="box-price">
                                     <span>￥<?php echo ($item->zk_final_price-$coupon);?></span>
                                     <del>￥<?php echo $item->zk_final_price;?></del>  
                                </dd>
                                <dd class="post-time">活动开始于<?php echo timeago( get_gmt_from_date($item->event_start_time) );?></dd>
                                <dd class="buy-count"><?php echo $item->volume;?>人已买</dd>
                            </div>
                        </div>
                        
                    </div>
            </div>

            <?php
               } } elseif($main && isset($mainList)&&count($mainList)==0){
            ?>
                
            <?php }?>
            <?php if (!$main) :
                     // the_post(); 
                    parse_str($_SERVER['QUERY_STRING'], $get);
                    $sortType = isset($get['so'])?$get['so']:'1';
                    $order = isset($get['o'])?$get['o']:'desc';
                    switch($sortType){  
                        case "1":  
                            $sort = 'post_date'; //时间 
                            break;
                        case "2":  
                            $sort = 'hao_xianj'; //价格 
                            break;
                        case "3":  
                            $sort = 'hao_youh'; //优惠券 
                            break;
                        case "4":  
                            $sort = 'hao_xiaol';  //销量
                            break;      
                        default:  
                            $sort = 'post_date';  
                            break;  
                      }  
                    $url = $_SERVER['REQUEST_URI'];
                    if($_SERVER["QUERY_STRING"] == ''){
                        $all = explode("/",$url);
                    }else {
                        $all = explode("/",explode("?",$url)[0]);
                    }
                    $page = $all[count($all)-1];
                    $page = is_numeric($page)?$page:1;
                    $cat_ID = get_query_var('cat');
                    if($sort == 'post_date'){
                        $posts = get_posts("category=".$cat_ID."&offset=".(10*($page-1))."&numberposts=10&orderby=post_date&order=".$order);
                    }else {
                        $posts = get_posts("category=".$cat_ID."&offset=".(10*($page-1))."&numberposts=10&meta_key=".$sort."&orderby=meta_value_num&order=".$order);
                    }
                    foreach( $posts as $post ) :
                if(get_post_meta($post->ID, "hao_zhutu", true) !=''){
            ?>

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
                                    <div class="box-juan-price"><span><?php echo ceil(get_post_meta($post->ID, "hao_youh", true))==0?没有:ceil(get_post_meta($post->ID, "hao_youh", true)).'元';?></span></div>
                                    <div class="box-juan"><span>券</span></div>
                                </div>

                                <dd class="box-price">
                                     <span>￥<?php echo get_post_meta($post->ID, "hao_xianj", true);?></span>
                                     <del>￥<?php echo get_post_meta($post->ID, "hao_yuanj", true);?></del>  
                                </dd>
                                <dd style="<?php echo $cate == '双十一'?'visibility: hidden;':''?>" class="post-time"><?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) );?></dd>
                                <dd style="<?php echo $cate == '双十一'?'visibility: hidden;':''?>" class="buy-count"><?php echo get_post_meta($post->ID, "hao_xiaol", true);?>人已买</dd>
                            </div>
                        </div>
                        
                    </div>
                </div>
            

            <?php }  endforeach;endif;?>
        </div>
        <?php 
            $next = $page_no;
            $temp = explode("?",$_SERVER["REQUEST_URI"]);
            $route = $temp[0];
            if($main){ 
            ?>
            <div class="pagenavi">
              <a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$route?>">更多</a>
            </div>
        <?php }else{?>
            <?php 
                if(strstr($route,"/page")!==false){
                    $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$route;
                } else {
                    $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$route.'/page/2';
                }
                
            ?>
            <div class="pagenavi"><?php if (count($posts) == 10) {next_posts_link('下一页');} else {echo '<a href='.$url.'>下一页</a>';} ?> <?php previous_posts_link('上一页') ?></div>
        <?php }?>
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
        } else {
            // location.href = url;
            // window.open(url);

            
            jumpWithoutFresh(url,title);
            
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
                    $('body').parent().append(div);
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
        <?php if($main){?>
            var infScroll = new InfiniteScroll( '#content', {
              append: '.post',
              path: function() {
                    <?php 
                        $favs = count($favorites);
                        $maxPage = ceil(200/$pageSize)*$favs;
                    ?>
                  if(this.loadCount < parseInt('<?php echo $maxPage;?>')){
                        var pageNumber = this.loadCount + 1;
                        var path = $('.pagenavi a').attr('href')+'?page='+pageNumber;
                        return path;
                  }
                  
                },
              history: '<?php echo is_weixin()? false:false?>',

              status: '.page-load-status',
            });
        <?php }else{?>
            var infScroll = new InfiniteScroll( '#content', {
              append: '.post',
              path: '.pagenavi a',
              status: '.page-load-status',
              history: '<?php echo is_weixin()? false:false?>',
            });
        <?php }?>
        infScroll.on( 'append', function(){
            loadImg();
        } );

    });
</script>
<?php get_footer(); ?>