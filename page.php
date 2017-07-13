<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package weishang
 */

get_header(); ?>
<?php get_sidebar(); ?>

<div class="layout page padding-top padding-bottom">
	<div id="content" class="container">
		<?php if(function_exists('breadcrumbs')) breadcrumbs();?>

		<?php the_content(); ?>

		<?php if ( wp_is_mobile() ){ ?>
			<?php wp_redirect('https://temai.m.taobao.com/new/index.htm?pid=mm_14661123_33544947_119412095'); exit; ?> 
		<?php }else { ?>
			<?php wp_redirect('http://uland.taobao.com/coupon/list?pid=mm_14661123_33544947_119412095'); exit; ?>
		<?php } ?>
	</div>
</div>
<?php get_footer(); ?>