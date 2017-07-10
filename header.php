<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">	

	<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
	<meta name="keywords" content="<?php echo get_option('keywords'); ?>" />
	<meta name="description" content="<?php bloginfo('description'); ?>">

	<link href="<?php bloginfo('template_url'); ?>/ui/pintuer.css" rel="stylesheet" type="text/css" />
	<link href="<?php bloginfo('template_url'); ?>/ui/iconfont.css" rel="stylesheet" type="text/css" />
	<link href="<?php bloginfo('template_url'); ?>/style.css" rel="stylesheet" type="text/css" />
	<script src="<?php bloginfo('template_url'); ?>/ui/jquery.js" type="text/javascript" ></script>
	<script src="<?php bloginfo('template_url'); ?>/ui/pintuer.js" type="text/javascript" ></script>
	<script src="<?php bloginfo('template_url'); ?>/ui/jquery.infinitescroll.min.js" type="text/javascript" ></script>
	<script src="<?php bloginfo('template_url'); ?>/ui/mobile-menu.js" type="text/javascript" ></script>
	<script src="<?php bloginfo('template_url'); ?>/ui/ZeroClipboard.min.js" type="text/javascript" ></script>
	<script src="<?php bloginfo('template_url'); ?>/ui/respond.js" type="text/javascript" ></script>

	<link href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/touch.png" rel="apple-touch-icon-precomposed">

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
		<div class="container">
			<div class="line padding-big-bottom">
        		<div class="xs12 xm4 xb4 text-float">
            			<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
                			<img src="<?php echo get_option('logo'); ?>" alt="<?php bloginfo('name'); ?>"  />
            			</a>
        		</div>
        		<div class="xs12 xm8 xb8 hidden-s hidden-l">
            			<a href="#" target="_blank">
					<img class="float-right br-img" src="<?php echo get_option('AD1'); ?>" />
            			</a>
        		</div>
			</div>
		</div>
    		
		<?php if ( wp_is_mobile() ){ ?>
		    <div class="find_nav fixed">
	                <div class="find_nav_left">
	                    <div class="find_nav_list">
	                        <ul class="mNav">
	                            <?php wp_nav_menu(array('theme_location'=>'header-menu'));?>
	                            <li class="sideline"></li>
	                        </ul>
	                    </div>
	                </div>
		    </div>
		<?php }else { ?>
		    <button class="hao-button button icon-navicon" data-target="#nav">菜单</button>
		    <div class="hao-nav bg-inverse nav-navicon fixed"  id="nav">
	                <ul class="nav nav-inline nav-menu nav-split nav-justified">
	                    <?php wp_nav_menu(array('theme_location'=>'header-menu'));?>
	                </ul>
		    </div>
		<?php } ?>
		<marquee style="font-size: 14px;color: #ff5777;margin-top: 10px;font-weight: bold;" scrollamount="3">
			<?php echo get_option('gg'); ?>
		</marquee>
	</div>
</header>