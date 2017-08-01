<?php if ( wp_is_mobile() ){ ?>
    
<?php }else { ?>
    <div class="container"  id="cate">
            <ul class="cate-list">
                <?php wp_nav_menu(array('theme_location'=>'sidebar-menu','walker' => new description_walker() ));?>
            </ul>
            <div class="slider">
            	<div class="banner">
					<div class="carousel">
						<!-- <div class="item">
							<div id="img1" class="sliderImg" ></div>
						</div> -->
						<div class="item" onclick="location.href='http://www.996shop.com/bd/category/popular/'">
							<div id="img2" class="sliderImg" ></div>
						</div>
						<div class="item" onclick="location.href='http://www.996shop.com/bd/category/9h9/'">
							<div id="img3" class="sliderImg" ></div>
						</div>
					</div>
				</div>
			</div>
    </div>
<?php } ?>