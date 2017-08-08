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
    $tbk_item = $temp['results']['tbk_coupon'];
    $searchList = array2object($tbk_item);
?>

<div class="layout page padding-top">
    <div class="container">
        <div id="content" class="line-middle">
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
                            $jump_url = '/bd/32322/?coupon_click_url='.$item->coupon_click_url.'&coupon='.$coupon.'&price='.$item->zk_final_price.'&final_price='.($item->zk_final_price-$coupon).'&volume='.$item->volume.'&pict_url='.$item->pict_url.'&content='.$item->coupon_info.'&title='.$item->title.'&coupon_total_count='.$item->coupon_total_count;
                        } else {
                            $jump_url = $item->item_url;
                        }
            ?>
                <div class="post xl12 xs4 xm3 padding-bottom">
                    <?php if(wp_is_mobile()){?>
                        <div class="box" onclick=" location.href='<?php echo $jump_url; ?>'">
                    <?php }else {?>
                        <div class="box" onclick=" window.open('<?php echo $jump_url; ?>')">
                        <?php }?>
                        <div class="box-image">
                            <a class="box-img" href="<?php echo $jump_url; ?>" <?php echo wp_is_mobile()?'':'target="_blank"'?>>
                                <img src="<?php echo $item->pict_url?>" class="img-responsive" alt=""/>
                            </a>
                        </div>
                        <div class="box-prod">
                            <div class="box-btn">
                                <?php if($item->user_type == 1){ ?>
                                    <img src="<?php bloginfo('template_url'); ?>/img/tm.png?>">
                                <?php };?>
                            </div>

                            <div class="box-name">
                                <dt style="text-indent: <?php echo $item->user_type == 1? '20px': '0px'?>"> 
                                    <a href="<?php echo $jump_url; ?>" <?php echo wp_is_mobile()?'':'target="_blank"'?>><?php echo $item->title; ?></a>
                                </dt> 
                                
                                <div class="box-txt">
                                    <div class="box-juan-price"><span><?php echo $coupon==0?'领完了':$coupon.'元';?></span></div>
                                    <div class="box-juan"><span>券</span></div>
                                </div>

                                <dd class="box-price">
                                     <span>￥<?php echo ($item->zk_final_price-$coupon);?></span>
                                     <del>￥<?php echo $item->zk_final_price;?></del>  
                                </dd>
                                <dd class="box-send">已有<?php echo $item->volume;?>人购买</dd>
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
<script type="text/javascript">
    
    jQuery(document).ready(function(){ 
            var infScroll = new InfiniteScroll( '#content', {
              append: '.post',
              path: '.pagenavi a',
              history: false,
              checkLastPage: true,
              status: '.page-load-status',
            });
            infScroll.on( 'load', function(){
                loadImg();
            } );
        });
</script>
<?php get_footer(); ?>