<?php 
$thiscat = get_category($cat); 
$cate = $thiscat ->name;
parse_str($_SERVER['QUERY_STRING'], $get);
$sortType = isset($get['so'])?$get['so']:'';
$orderType = isset($get['o'])?$get['o']:'';
$sortUrl = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].explode("?",$_SERVER["REQUEST_URI"])[0]; 

?>
<div id="sort" class="layout page padding-top">
    <?php if ( wp_is_mobile() ){ ?>
        <div class="container mobile">              
            <div class="content">
                <div class="<?php echo $sortType==1||!isset($sortType)||$sortType==''?'active':''?>"><a href="<?php echo $sortUrl.'?so=1'?>">最新</a></div>
                <div class="<?php echo $sortType==4?'active':''?>"><a href="<?php echo $sortUrl.'?so=4'?>">销量</a></div>
                <div class="<?php echo $sortType==2?'active':''?>"><a href="<?php echo $sortUrl.'?so=2&o=asc'?>">价格</a></div>
                <div class="<?php echo $sortType==3&&($orderType=='desc'||!isset($orderType))?'active':''?>"><a href="<?php echo $sortUrl.'?so=3&o=desc'?>">大额优惠券</a></div>
            </div>
        </div>
    <?php }else { ?>
        <div class="container">              
            <div class="content">
                <div>
                    <a href="javascript:void(0)" id="dropcate"><?php echo $cate;?><span class="arrow"></span></a>
                    <div class="drop">
                       <ul class="drop-menu">                                       
                            <?php wp_nav_menu(array('theme_location'=>'sidebar-menu','walker' => new description_walker() ));?>
                        </ul> 
                    </div>
                    
                </div>
                <div class="<?php echo $sortType==1||!isset($sortType)||$sortType==''?'active':''?>"><a href="<?php echo $sortUrl.'?so=1'?>">最新</a></div>
                <div class="<?php echo $sortType==4?'active':''?>"><a href="<?php echo $sortUrl.'?so=4'?>">销量高</a></div>
                <div class="<?php echo $sortType==2?'active':''?>"><a href="<?php echo $sortUrl.'?so=2&o=asc'?>">价格低</a></div>
                <div class="<?php echo $sortType==3&&($orderType=='desc'||!isset($orderType))?'active':''?>"><a href="<?php echo $sortUrl.'?so=3&o=desc'?>">大额优惠券</a></div>
                <div class="<?php echo $sortType==3&&$orderType=='asc'?'active':''?>"><a href="<?php echo $sortUrl.'?so=3&o=asc'?>">小额优惠券</a></div>
            </div>
        </div>
    <?php } ?>
    
    
</div>