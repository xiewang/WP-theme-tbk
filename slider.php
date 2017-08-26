
<?php 

    function get_images_from_media_library() {
        $args = array(
            'post_type' => 'attachment',
            'post_mime_type' =>'image',
            'post_status' => 'inherit',
            'posts_per_page' => 5,
            'orderby' => 'rand'
        );
        $query_images = new WP_Query( $args );
        $images = array();
        foreach ( $query_images->posts as $image) {
            // $images[]= $image->guid;
            $attachments = wp_prepare_attachment_for_js($image->ID);
            $obj =new \stdClass; 
            $obj->url = $attachments['caption'];
            $obj->image = $attachments['url'];
            $images[] = $obj;
        }
        return $images;
    }
    $sliders = get_images_from_media_library();

?>

<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php foreach ($sliders as $key => $value) {
        ?> 
            <div class="swiper-slide">
                <a href="<?php echo $value->url;?>" target="_blank">
                    <img src="<?php echo $value->image;?>">
                </a>
            </div>
        <?php }?>
        
    </div>
    <!-- 如果需要分页器 -->
    <div class="swiper-pagination"></div>
    
    <?php if(!wp_is_mobile()){?>
        <div class="swiper-button">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    <?php }?>
    
</div>