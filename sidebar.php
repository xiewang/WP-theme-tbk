<?php if ( wp_is_mobile() ){ ?>
    
<?php }else { ?>
    <div class="container"  id="cate">
            <ul class="cate-list">
                <?php wp_nav_menu(array('theme_location'=>'sidebar-menu'));?>
            </ul>
    </div>
<?php } ?>