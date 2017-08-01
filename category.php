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
    
    $req->setPageSize("100");
    $req->setAdzoneId("119412095");
    $req->setUnid("3456");
    
    $req->setPageNo("1");
    $req->setFields("coupon_total_count,coupon_info,coupon_click_url,num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,seller_id,volume,nick,shop_title,zk_final_price_wap,event_start_time,event_end_time,tk_rate,status,type");
    

    $thiscat = get_category($cat); 
    $cate = $thiscat ->name;
    $main = false;
    if($cate == '人气推荐'){
         $favorites=array('8678149','8658715');
         $main = true;
    } 
    elseif($cate == '9块9包邮'){
        $favorites=array('8678161','8678349'); 
        $main = true;
    }
    elseif($cate == '明星周边'){
        $favorites=array('8678264','8678327'); 
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
    if($main == true){
        $req->setFavoritesId($favorites[0]);
        $resp0 = $c->execute($req);
        $req->setFavoritesId($favorites[1]);
        $resp1 = $c->execute($req);

        // $uatm_tbk_item = array();
        foreach ($favorites as $key => $value) {
            $req->setFavoritesId($favorites[$key]);
            $resp = $c->execute($req);

            $temp = json_decode(json_encode($resp),TRUE);
            if($key == 0){
                $uatm_tbk_item = $temp['results']['uatm_tbk_item'];
            }else {
                $uatm_tbk_item = count($uatm_tbk_item)>0?array_merge($uatm_tbk_item, $temp['results']['uatm_tbk_item']):$temp['results']['uatm_tbk_item'];
            }
            
        }
        // print_r( array2object($uatm_tbk_item));

        $mainList = array2object($uatm_tbk_item);
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
        <?php if($main){?>
            <div class="pagenavi">
                <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'?page_no='.$page_no;?>">更多</a>
            </div>
        <?php }else{?>
            <div class="pagenavi"><?php next_posts_link('下一页') ?> <?php previous_posts_link('上一页') ?></div>
        <?php }?>
     </div>
</div>

<?php get_footer(); ?>