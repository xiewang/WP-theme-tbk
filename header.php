<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">	

	<title><?php if(wp_title('', false)=='') { echo '半刀网--优质淘宝优惠券精选--专业人工值守'; }else{bloginfo('name'); echo '推荐：'; wp_title('');} ?> </title>
	<meta name="keywords" content="<?php echo get_option('keywords'); ?>" />
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="baidu-site-verification" content="XvZ5JrfmTv" />
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/ui/swiper-3.4.2.min.css">
	<link href="<?php bloginfo('template_url'); ?>/ui/pintuer.css" rel="stylesheet" type="text/css" />
	<link href="<?php bloginfo('template_url'); ?>/ui/iconfont.css" rel="stylesheet" type="text/css" />
	<link href="<?php bloginfo('template_url'); ?>/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php bloginfo('template_url'); ?>/ui/version-2017102401.css" rel="stylesheet" type="text/css" />
	<link href="<?php bloginfo('template_url'); ?>/ui/add-to-homescreen-master/style/addtohomescreen.css" rel="stylesheet" type="text/css" />

	<script src="<?php bloginfo('template_url'); ?>/ui/jquery.js" type="text/javascript" ></script>
	<script src="<?php bloginfo('template_url'); ?>/ui/pintuer.js" type="text/javascript" ></script>
	<script src="<?php bloginfo('template_url'); ?>/ui/infinite-scroll.pkgd.min.js" type="text/javascript" ></script>
	<script src="<?php bloginfo('template_url'); ?>/ui/mobile-menu.js" type="text/javascript" ></script>
	<script src="<?php bloginfo('template_url'); ?>/ui/ZeroClipboard.min.js" type="text/javascript" ></script>
	<script src="<?php bloginfo('template_url'); ?>/ui/respond.js" type="text/javascript" ></script>
	<script src="<?php bloginfo('template_url'); ?>/ui/clipboard.min.js" type="text/javascript" ></script>
	<script src="<?php bloginfo('template_url'); ?>/ui/add-to-homescreen-master/src/addtohomescreen.min.js" type="text/javascript" ></script>
	<link href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/img/fav.png" rel="apple-touch-icon-precomposed">
	<script src="<?php bloginfo('template_url'); ?>/ui/jquery.lazyload.js" type="text/javascript"></script>
	<script type="text/javascript"> 

		$(function() {
			$(".box-img img").lazyload({
				effect : "fadeIn"
			});
			var addtohome = addToHomescreen({
			   skipFirstVisit: true,
			   maxDisplayCount: 2,
			   autostart: false,
			   lifespan: 40,
			   message:{
			   	ios:'为了更方便使用，您可以将半刀网收藏到桌面: 点击 %icon 然后点击 <strong>添加到主屏幕</strong>.',
			   	android:'为了更方便使用，您可将半刀网收藏到桌面，点击菜单按钮<small> %icon.</small>，然后<strong>添加到主屏幕</strong>（“加快捷方式”）。 <small>部分安卓浏览器可能没有<strong>添加到主屏幕</strong>功能😭，你也可以点击菜单中的“添加到首页导航”、“添加到书签”等类似功能。</small>'
			   }
			});
			<?php if ( wp_is_mobile()&&window.localStorage ){ ?>
				try{
					addtohome.show();
				}catch(e){
					console.log(e)
				}
				
			<?php }?>
		});
	</script>
</head>
<body class="<?php echo wp_is_mobile()?'':'pc'?>" style="top:0;left:0;margin: 0 auto;">

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
	        		<div class="xs12 xm4 xb4 hidden-s hidden-l">
	            			<div class="search">
				                <form class="s" method="get" action="<?php bloginfo('url'); ?>" role="search">
				                	<button class="sy-submit" type="submit" role="button"><span class="icon-search"></span></button>
				                	<input class="sy-input" type="search" name="s" placeholder="宝贝搜索..." value="<?php the_search_query(); ?>">
				                	<div class="button-group" id="searchType">
										<button type="button" class="button dropdown-toggle">
											<?php 
											    parse_str($_SERVER['QUERY_STRING'], $get);
											    $searchType = isset($get['searchType'])?$get['searchType']:0;
											?>
											<span id="searchTypePlace"><?php echo $searchType==0?'超级搜索':'内部优惠'?></span> <span class="downward"></span>
										</button>
										<ul class="drop-menu">
											<li><a href="#" onClick="changeST(0)">超级搜索</a> </li>
											<li><a href="#" onClick="changeST(1)">内部优惠</a> </li>
										</ul>
									</div>
									<input type="hidden" name="searchType" value="0"></input>
				                </form>
				            </div>
	        		</div>
	        		<div class="slogan xs12 xm4 xb4 hidden-s hidden-l">
	        			<div class="s-item">
	        				<div class="s-k"><span>新</span></div>
	        				<div class="s-d">
	        					<span>每日更新</span>
	        				</div>
	        			</div>
	        			<div class="s-item">
	        				<div class="s-k"><span>精</span></div>
	        				<div class="s-d">
	        					<span>人工筛选</span>
	        				</div>
	        			</div>
	        			<div class="s-item">
	        				<div class="s-k"><span>省</span></div>
	        				<div class="s-d">
	        					<span>全网最低</span>
	        				</div>
	        			</div>
	        		</div>
				</div>
			</div>
		<?php } ?>
		<script type="text/javascript">
			function changeST(type){
				$('input[name="searchType"]').val(type);
				if(type === 0){
					$('#searchTypePlace').text('超级搜索');
				} else {
					$('#searchTypePlace').text('内部优惠');
				}
				$('#searchType').removeClass('open');
			}
		</script>
	</div>
</header>
<?php if ( wp_is_mobile() ){ ?>

<?php }else { ?>
    <button class="hao-button button icon-navicon" data-target="#nav">菜单</button>
    <div class="hao-nav bg-inverse nav-navicon fixed"  id="nav">
            <ul class="nav nav-inline nav-menu nav-split nav-justified">
                <?php wp_nav_menu(array('theme_location'=>'header-menu'));?>
            </ul>
    </div>
<?php } ?>
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
            	<div class="button-group mobile" id="searchType">
					<button type="button" class="button dropdown-toggle">
						<?php 
						    parse_str($_SERVER['QUERY_STRING'], $get);
						    $searchType = isset($get['searchType'])?$get['searchType']:0;
						?>
						<span id="searchTypePlace"><?php echo $searchType==0?'超级':'内部'?></span> <span class="downward"></span>
					</button>
					<ul class="drop-menu">
						<li><a href="#" onClick="changeST(0)">超级搜索</a> </li>
						<li><a href="#" onClick="changeST(1)">内部优惠</a> </li>
					</ul>
				</div>
				<input type="hidden" name="searchType" value="0"></input>
            	<input autocomplete="off" id="search" class="sy-input mobile" type="search" name="s" placeholder="宝贝搜索..." value="<?php the_search_query(); ?>">
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
		<div class="">
			<div class="m-slider">
	        	<?php require('slider.php'); ?>    	
			</div>
		</div>
		<div class="layout">
			<div id="ad-scroll" onclick="location.href='http://996shop.com/double11'">
				<div>
					<span>双十一超级红包，11.11前，每天发放2.5亿，先到先得</span>
				</div>
			</div>
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

	<script type="text/javascript">
		function changeST(type){
			$('input[name="searchType"]').val(type);
			if(type === 0){
				$('#searchTypePlace').text('超级');
			} else {
				$('#searchTypePlace').text('内部');
			}
			$('#searchType').removeClass('open');
		}
	</script>
<?php } ?>

