<?php get_header(); 
    // echo $_SERVER['QUERY_STRING'];
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
    if(isset($_SERVER['QUERY_STRING'])){
        parse_str($_SERVER['QUERY_STRING'], $get);

        if(!isset($get['page'])){
            $page_no = 1;
        } else {
            $page_no = $get['page'];
        }
        
    } else {
        $page_no = 1;
    }

    if($page_no > 10){
        return ;
    }
    include "taobao/TopSdk.php";
    $c = new TopClient;
    $c->appkey = "24545248";
    $c->secretKey = "9e69eb2ab9fa086d31ddf043493a6a49";
    
    $req = new TbkDgItemCouponGetRequest;
    if(wp_is_mobile()){
        $req->setPlatform("2");
    } else {
        $req->setPlatform("1");
    }
    $req->setAdzoneId("119412095");
    $req->setPageSize("10");
    $req->setCat("");
    $req->setQ($get['s']);
    $req->setPageNo(strval($page_no));
    $resp = $c->execute($req);

    $temp = json_decode(json_encode($resp),TRUE);
    $tbk_item = isset($temp['results'])?$temp['results']['tbk_coupon']:'';
    if(count($tbk_item) > 10 && is_array($tbk_item)){
        $a=array();
        array_push($a,$tbk_item);
        $searchList = array2object($a);
    } else if(count($tbk_item) <= 10 && is_array($tbk_item)){
        $searchList = array2object($tbk_item);
    } 

?>

<div class="layout page <?php echo wp_is_mobile()?'list':'padding-top'?>">
    <div class="container <?php echo wp_is_mobile()?'mobile':''?>">
        <div id="content" class="<?php echo wp_is_mobile()?'':'line-middle'?>">
            <div class="ad-sort">
                <a href="" target="_blank">
                    <img src="<?php bloginfo('template_url'); ?>/img/img2.png">
                </a>
            </div>
            <?php  
                if(isset($searchList)){
                    foreach ($searchList as $item){ 
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
                                   

                        if(isset($item->coupon_click_url)){
                            $item->volume = $item->volume<100?rand(100,1000):$item->volume;
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
                                <dd class="post-time">活动开始于<?php echo timeago( get_gmt_from_date($item->coupon_start_time) );?></dd>
                                <dd class="buy-count"><?php echo $item->volume;?>人已买</dd>
                            </div>
                        </div>
                        
                    </div>
            </div>
            <?php }}?>

        </div>
      <div class="pagenavi">
      <a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"].'&'.'page='.($page_no+1)?>">更多</a>
      </div>
      <div class="page-load-status">
            <?php if(isset($searchList)):?>
                  <div class="infinite-scroll-request <?php echo count($tbk_item)!=10?'hide':''?>">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/jiazai.gif" alt="Loading" />
                    加载中...
                  </div>
            <?php endif;?>

          <p class="infinite-scroll-error infinite-scroll-last">
            <?php echo isset($searchList)?'到底了噢！(提示：搜索词越长，搜索越准确！)':'抱歉，没帮你找到相关宝贝，试试其他的关键词呢？';?>
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