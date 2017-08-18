<?php 
$thiscat = get_category($cat); 
$cate = $thiscat ->name;
parse_str($_SERVER['QUERY_STRING'], $get);
$sortType = $get['so'];
?>
<div id="sort" class="layout page padding-top">
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
            <div class="<?php echo $sortType==1||!isset($sortType)?'active':''?>"><span>最新</span></div>
            <div class="<?php echo $sortType==4?'active':''?>"><span>销量高</span></div>
            <div class="<?php echo $sortType==2?'active':''?>"><span>价格低</span></div>
            <div class="<?php echo $sortType==3?'active':''?>"><span>大额优惠券</span></div>
            <div class="<?php echo $sortType==3?'active':''?>"><span>小额优惠券</span></div>
        </div>
        
    </div>
    
</div>