<?php
// register_activation_hook(__FILE__, 'my_activation');
function my_activation() {
		// my_deactivation();
	echo 'test=============';
	// get_all_auto_post();
	if ( !wp_next_scheduled( 'my_hourly_event' ) ) {
		// wp_schedule_event(time(), 'hourly', 'my_hourly_event');
	} 
}
function my_deactivation() {
	wp_clear_scheduled_hook('my_hourly_event');
}

add_action('my_hourly_event', 'do_this_hourly');

add_action('wp', 'my_activation');
function do_this_hourly() {

     // wp_mail( "xiewang0501@126.com", "这是一个测试邮件！ ", "这是测试邮件标题", "这是测试邮件内容");
	// wp_delete_post( 44677, true );
}


function get_all_auto_post(){
	$args=array(
	'include' => '38' //标签ID号
	); 
	$tags = get_tags($args);
	// 循环所有标签 
	foreach ($tags as $tag) { 
	// 得到标签ID 
	$tagid = $tag->term_id; 
	// 得到标签下所有文章 
	query_posts("showposts=-1&tag_id=$tagid"); 
	while (have_posts()) : the_post();
		if(the_title() == ''){
			echo 'get id'.the_title();
		}
	endwhile;
	}
}
?> 