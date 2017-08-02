<?php get_header(); ?>
<?php get_sidebar(); ?>
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
    $pageSize = 60;
    $req->setPageSize((string)$pageSize);
    $req->setAdzoneId("119412095");
    $req->setUnid("3456");
    if(isset($_SERVER['QUERY_STRING'])){
        parse_str($_SERVER['QUERY_STRING'], $get);

        if(isset($get['page'])){
            $page_no = $get['page'];
        } else {
            $page_no = 1;
        }

        if(isset($get['total'])){
            $total = $get['total'];
        } else {
            $total = 100;
        }
        
        if(isset($get['fav'])){
            $fav = $get['fav'];
        } else {
            $fav = 0;
        }
    } else {
        $page_no = 1;
        $total = 100;
        $fav = 0;
    }
    echo $page_no;
    $req->setPageNo((string)$page_no);
    $req->setFields("coupon_total_count,coupon_info,coupon_click_url,num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,seller_id,volume,nick,shop_title,zk_final_price_wap,event_start_time,event_end_time,tk_rate,status,type");
    
    $thiscat = get_category($cat); 
    $cate = $thiscat ->name;
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

    
    if($main == true){
        
        if(($page_no-1)*$pageSize >= $total){
            $fav = $fav+1;
            $page_no=1;
            $req->setPageNo("1");
        }
        echo $page_no;

        if(count($favorites) < ($fav+1)){
            return null;
        }

        $req->setFavoritesId($favorites[$fav]);
        $resp = $c->execute($req);

        $temp = json_decode(json_encode($resp),TRUE);
        $uatm_tbk_item = $temp['results']['uatm_tbk_item'];
        $total = $temp['total_results'];
        $mainList = array2object($uatm_tbk_item);

        // foreach ($favorites as $key => $value) {
        //     $req->setFavoritesId($favorites[$key]);
        //     $resp = $c->execute($req);


        //     $temp = json_decode(json_encode($resp),TRUE);
        //     $uatm_tbk_item = $temp['results']['uatm_tbk_item'];
        //     $total_results = $temp['results']['total_results'];
        //     if()
        //     // if($key == 0){
        //     //     $uatm_tbk_item = $temp['results']['uatm_tbk_item'];
        //     // }else {
        //     //     $uatm_tbk_item = count($uatm_tbk_item)>0?array_merge($uatm_tbk_item, $temp['results']['uatm_tbk_item']):$temp['results']['uatm_tbk_item'];
        //     // }
            
        // }
        // // print_r( array2object($uatm_tbk_item));

        // $mainList = array2object($uatm_tbk_item);
    }
    
?>

<?php 
    // include "cateapi.php";
?>
<div class="layout page padding-top">
    <div class="container">
        <div id="content" class="line-middle">
            <?php  
                if($main && isset($mainList)){
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

            <?php
               } }
            ?>
            <?php while (have_posts()&&!$main) : the_post(); 
                if(get_post_meta($post->ID, "hao_zhutu", true) !=''){
            ?>

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
            

            <?php } endwhile; ?>
        </div>
        <?php if($main){ 
            $next = (int)$page_no+1; 
            $temp = explode("?",$_SERVER["REQUEST_URI"]);
            $route = $temp[0];
            ?>
            <div class="pagenavi">
              <a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$route.'?page='.$next.'&total='.$total.'&fav='.$fav?>">更多</a>
            </div>
        <?php }else{?>
            <div class="pagenavi"><?php next_posts_link('下一页') ?> <?php previous_posts_link('上一页') ?></div>
        <?php }?>
     </div>
</div>

<?php get_footer(); ?>