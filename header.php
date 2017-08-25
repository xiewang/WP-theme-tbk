<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">	

	<title><?php bloginfo('name'); ?>推荐:<?php wp_title(''); ?> <?php if(wp_title('', false)) { echo ''; } ?> </title>
	<meta name="keywords" content="<?php echo get_option('keywords'); ?>" />
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="baidu-site-verification" content="XvZ5JrfmTv" />
	<link href="<?php bloginfo('template_url'); ?>/ui/pintuer.css" rel="stylesheet" type="text/css" />
	<link href="<?php bloginfo('template_url'); ?>/ui/iconfont.css" rel="stylesheet" type="text/css" />
	<link href="<?php bloginfo('template_url'); ?>/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php bloginfo('template_url'); ?>/ui/version-2017072002.css" rel="stylesheet" type="text/css" />
	<script src="<?php bloginfo('template_url'); ?>/ui/jquery.js" type="text/javascript" ></script>
	<script src="<?php bloginfo('template_url'); ?>/ui/pintuer.js" type="text/javascript" ></script>
	<script src="<?php bloginfo('template_url'); ?>/ui/infinite-scroll.pkgd.min.js" type="text/javascript" ></script>
	<script src="<?php bloginfo('template_url'); ?>/ui/mobile-menu.js" type="text/javascript" ></script>
	<script src="<?php bloginfo('template_url'); ?>/ui/ZeroClipboard.min.js" type="text/javascript" ></script>
	<script src="<?php bloginfo('template_url'); ?>/ui/respond.js" type="text/javascript" ></script>
	<script src="<?php bloginfo('template_url'); ?>/ui/clipboard.min.js" type="text/javascript" ></script>
	<link href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/img/fav.png" rel="apple-touch-icon-precomposed">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/ui/swiper-3.4.2.min.css">
	<script src="<?php bloginfo('template_url'); ?>/ui/jquery.lazyload.js" type="text/javascript"></script>
	<script type="text/javascript"> 

		$(function() {
			$(".box-img img").lazyload({
				effect : "fadeIn"
			});
		});
	</script>
</head>
<body>

<header class="layout page header">
	<div class="container-layout padding-top" id="headerC">
		<?php if ( !wp_is_mobile() ){ ?>
			<div class="container">
				<div class="line">
	        		<div class="xs12 xm4 xb4 text-float" id="title-logo">
	            			<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
	                			<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php bloginfo('name'); ?>"  />
	            			</a>
	        		</div>
	        		<div class="xs12 xm8 xb8 hidden-s hidden-l">
	            			<div class="search">
				                <form class="s" method="get" action="<?php bloginfo('url'); ?>" role="search">
				                	<button class="sy-submit" type="submit" role="button"><span class="icon-search"></span></button>
				                	<input class="sy-input" type="search" name="s" placeholder="宝贝搜索..." value="<?php the_search_query(); ?>">
				                </form>
				            </div>
	        		</div>
				</div>
			</div>
		<?php } ?>
		
    		
		<?php if ( wp_is_mobile() ){ ?>
		    <!-- <div class="find_nav fixed">
	                <div class="find_nav_left">
	                    <div class="find_nav_list">
	                        <ul class="mNav">
	                            <?php wp_nav_menu(array('theme_location'=>'header-menu'));?>
	                            <li class="sideline"></li>
	                        </ul>
	                    </div>
	                </div>
		    </div> -->
		<?php }else { ?>
		    <button class="hao-button button icon-navicon" data-target="#nav">菜单</button>
		    <div class="hao-nav bg-inverse nav-navicon fixed"  id="nav">
	                <ul class="nav nav-inline nav-menu nav-split nav-justified">
	                    <?php wp_nav_menu(array('theme_location'=>'header-menu'));?>
	                </ul>
		    </div>
		<?php } ?>

	</div>
</header>

<?php 
	$thiscat = get_category($cat); 
	$cate = isset($thiscat ->name)?$thiscat ->name:'今日更新';
	if ( wp_is_mobile() ){ ?>
	<div class="m-header">
		<?php if ( is_single() ){ ?>
			<div class="m-back " onclick="history.length>1?history.go(-1) :location.href='<?php bloginfo('url'); ?>'" >
				<img class='hide' src="<?php bloginfo('template_url'); ?>/img/home.png">
			</div> 
		<?php }else { ?>
			<div class="m-logo">
				<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
					<span><?php bloginfo('name'); ?></span>
				</a>
			</div>  
		<?php } ?>
	
		
		<div class="m-search">
			<form class="s" method="get" action="<?php bloginfo('url'); ?>" role="search">
            	
            	<input autocomplete="off" id="search" class="sy-input" type="search" name="s" placeholder="宝贝搜索..." value="<?php the_search_query(); ?>">
            	<button class="sy-submit" type="submit" role="button"><span class="icon-search"></span></button>
            </form>
		</div>
		<div class="m-cate" id='m-cate-icon'>
			<img src="<?php bloginfo('template_url'); ?>/img/item.png">
			<span>分类</span>
		</div>
	</div>

	<?php if ( !is_single()&&!is_search()&&!is_404() &&($cate == '人气推荐'
	||$cate == '今日更新'
    ||$cate == '9块9包邮'
    ||$cate == '明星周边'
    ||$cate == '好券抢购'
    ||$cate == '你没见过')){ ?>
		<div class="layout">
			<div class="m-slider">
	            	<div class="banner">
						<div class="carousel">
							<!-- <div class="item">
								<div id="img1" class="sliderImg" ></div>
							</div> -->
							<div class="item">
								<div id="img2" class="sliderImg" ></div>
							</div>
							<div class="item">
								<div id="img3" class="sliderImg" ></div>
							</div>
						</div>
					</div>
				</div>
		</div>
		<div class="layout">
			<div class="m-main-cate">
				<ul>
	                <?php wp_nav_menu(array('theme_location'=>'header-menu'));?>
	            </ul>
			</div>
			
		</div>
	<?php } else { ?>
		<div style="width: 100%;height:40px;background:#fff;margin-top: -8px;"></div>
	<?php } ?>

	<div class="m-cate-drop hide">
		<div class="m-cate-container">
			<ul class="m-cate-list">
				<?php wp_nav_menu(array('theme_location'=>'sidebar-menu','walker' => new description_walker() ));?>	
			</ul>
			<div class="m-packup" id="m-packup">
				<span>收起</span>
			</div>
		</div>
	</div>
<?php } ?>

