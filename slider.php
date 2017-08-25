
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
    print_r(get_images_from_media_library());

?>

