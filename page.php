<?php get_header(); ?>


<div class="layout page padding-top padding-bottom">
	<div id="content" class="container">
		<?php 

			$comments_args = array(
				'comment_notes_before' =>'',
				'comment_notes_after' => '',
				'title_reply' => '半刀网一直在改进，不啬留下您的宝贵建议，我们会非常感谢！',
				'label_submit'=>'提交',

			 );
		 	
			comment_form($comments_args); 
			$ob = ob_get_clean();
			$ob = str_replace('class="comment-form-author"','class="comment-form-author" style="display:none;"',$ob);
			$ob = str_replace('class="comment-form-email"','class="comment-form-email" style="display:none;"',$ob);
			$ob = str_replace('class="comment-form-url"','class="comment-form-url" style="display:none;"',$ob);
			$ob = str_replace('class="logged-in-as"','class="logged-in-as" style="display:none;"',$ob);
			$ob = str_replace('<label for="comment">评论</label>','<label for="comment" style="display:none;">评论</label>',$ob);
			echo $ob;
		?>
	</div>
</div>
<?php get_footer(); ?>