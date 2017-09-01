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
			if(get_query_var('pagename') == 'feedback'){
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
			} 
			if(get_query_var('pagename') == 'article'){
		?>
			<div id="article">
				<ul>
					<li>
						<p><a href="https://mp.weixin.qq.com/s?__biz=MzIzODk0MzY1NQ==&mid=100000132&idx=1&sn=ddea0dcaefbdbf86b4efa79c1b9fff5d&chksm=6930ed4c5e47645adbc812eb6ae363c469bddc101f2337e99001e24162fb4962eabaef741443&mpshare=1&scene=1&srcid=0901uqBD9Zb7HXFKVAHVQWHG&key=8005acd0071433fd485025c66f3c666338c64bf8948fe7c0ee50c959109fb775a32846c33d0b849326890620635ff56b525e876781dc7c2bc63182b3134c4a5d4bbee62d19deac67d49e39928e266e12&ascene=0&uin=NjI0MzE4ODQw&devicetype=iMac+MacBookPro11%2C3+OSX+OSX+10.10.5+build(14F2511)&version=12020610&nettype=WIFI&fontScale=100&pass_ticket=gbD2Q6i4TkBKW8aXlic4c1nZ0FoiUgp652c6%2Fc0%2BQ0Lgvc4LB7cBSxYlgGzYxMLO">优惠券领用教程-淘宝专用</a></p>
					</li>
				</ul>
			</div>
		<?php }?>
	</div>
</div>
<?php get_footer(); ?>