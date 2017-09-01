<?php get_header(); ?>


<div class="layout page padding-top padding-bottom <?php echo wp_is_mobile()?'mobile':''?> comment-page">
	<div id="content" class="container">
		<?php if(!wp_is_mobile()){?>
			<div class="ad-sort">
	            <a href="" target="_blank">
	                <img src="<?php bloginfo('template_url'); ?>/img/img2.png">
	            </a>
	        </div>
	    <?php }?>
		<?php 

			$comments_args = array(
				'fields'=>array(
					'author' => '',
					'email' => '',
					'url' => ''
					),
				'logged_in_as' =>'',
				'comment_notes_before' =>'',
				'comment_notes_after' => '',
				'title_reply' => '半刀网一直在改进。为了更好服务您，不啬留下您的宝贵建议，非常感谢！',
				'label_submit'=>'提交'
			 );
		 	
			comment_form($comments_args); 
			$ob = ob_get_clean();
			$ob = str_replace('<label for="comment">评论</label>','<label for="comment" style="display:none;">评论</label>',$ob);
			echo $ob;
		?>
	</div>
</div>
<?php get_footer(); ?>