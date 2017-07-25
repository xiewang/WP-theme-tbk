<?php
/*------------------------------------*\
	系统 功能
\*------------------------------------*/
//移除<P>标签
remove_filter( 'the_content', 'wpautop' ); //正文
remove_filter( 'the_excerpt', 'wpautop' ); //摘要


/*------------------------------------*\
	菜单 功能
\*------------------------------------*/

// 注册菜单
function hao_menu() {
    register_nav_menus(array(
        'header-menu' => '主菜单', 
        'sidebar-menu' => '边栏菜单',
        'footer-menu' => '底部菜单'
    ));
}
add_action('init', 'hao_menu');

//  移除默认导航多余<div> <ul>
function my_wp_nav_menu_args($args = '') {
    $args['container'] = false;
    $args['items_wrap'] = '%3$s';
    return $args;
}
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); 

// 移除菜单 <li> 中的 id class
function my_css_attributes_filter($var) {
    // return is_array($var) ? array() : ''; // 全部移除
    return is_array($var) ? array_intersect($var, array('current-menu-item')) : ''; // 保留高亮项
}
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); 
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); 
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); 

/*------------------------------------*\
	无限加载infinite scroll
\*------------------------------------*/

function infinite_scroll_js() {
    if (!is_singular() ) {
        ?>
        <script type="text/javascript">
        var loadImg = function(){
            $('.box-img img').each(function() {
                var img = new Image();
                if($(this).attr('original')){
                    img.src = $(this).attr('original');
                } else {
                    img.src = $(this)[0].src;
                }
                
                 
                if(img.complete) {
                    console.log('该图片已经存在于缓存之中，不会再去重新下载');
                    $(this).prev().addClass('hide');
                    $(this).removeClass('hide');
                } else {
                    $(this).load(function(){
                        // console.log($.inArray($(this)[0], $('.box-img img')));
                        $(this).prev().addClass('hide');
                        $(this).removeClass('hide');
                    });
                }
                setTimeout(function(){
                    $(this).prev().addClass('hide');
                    $(this).removeClass('hide');
                },1500);
            });  
        }
        <?php  if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')){?>
            loadImg();
        <?php }?>
        
        jQuery(document).ready(function(){ 
            <?php  if(!strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')){?>
                loadImg();
            <?php }?>
            var infinite_scroll = {
                loading: {
                    img: "<?php echo get_stylesheet_directory_uri(); ?>/img/jiazai.gif",
                    msgText: "自动加载中...",
                    finishedMsg: "已加载所有产品..."
                },
                nextSelector:".pagenavi a",
                navSelector:".pagenavi",
                itemSelector:".post",
                contentSelector:"#content",              
            };
            jQuery( infinite_scroll.contentSelector ).infinitescroll( infinite_scroll,function(arrayOfNewElems){  
              loadImg();
            } );
        });
        </script>
        <?php
    }?>
    <?php 
        if (is_singular() ) {
    ?>
        <script type="text/javascript">
            var loadImg = function(){
                $('.box-img img').each(function() {
                    var img = new Image();
                    img.src = $(this)[0].src;
                     
                    if(img.complete) {
                        console.log('该图片已经存在于缓存之中，不会再去重新下载');
                        $(this).prev().addClass('hide');
                        $(this).removeClass('hide');
                    } else {
                        $(this).load(function(){
                            // console.log($.inArray($(this)[0], $('.box-img img')));
                            $(this).prev().addClass('hide');
                            $(this).removeClass('hide');
                        });
                    }
                    setTimeout(function(){
                        $(this).prev().addClass('hide');
                        $(this).removeClass('hide');
                    },1500);
                });  
            }
            <?php  if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')){?>
                loadImg();
            <?php }?>

             jQuery(document).ready(function(){ 
                <?php  if(!strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')){?>
                    loadImg();
                <?php }?>
            });
        </script>
    <?php
        }
}
add_action('wp_footer', 'infinite_scroll_js', 100);

require_once dirname( __FILE__ ) . '/theme-options.php';  // 加载主题选项文件
/**
 * 获取WordPress所有分类名字和ID
 * <?php show_category(); ?>
 */
function show_category(){
    global $wpdb;
    $request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
    $request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
    $request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
    $request .= " ORDER BY term_id asc";
    $categorys = $wpdb->get_results($request);
    foreach ($categorys as $category) { //调用菜单
        $output = '<li>'.$category->name."[<strong>".$category->term_id.'</strong>]</li>';
        echo $output;
    }
}

/**------------------------------
 * 商品信息输入面板
---------------------------------*/ 
$hao_meta_boxes = array(
    "hao_zhutu" => array(
        "name" => "hao_zhutu",
        "describe" => "请填入图片地址，如：http://xbaba.cn/img.jpg",
        "std" => "",
        "title" => "商品图片："),
    "hao_xianj" => array(
        "name" => "hao_xianj",
        "describe" => "直接填入商品现价&券后价。如：29.9",
        "std" => "",
        "title" => "商品现价："),
    "hao_yuanj" => array(
        "name" => "hao_yuanj",
        "describe" => "直接填入商品原价。如：39.9",
        "std" => "",
        "title" => "商品原价："),
    "hao_youh" => array(
        "name" => "hao_youh",
        "describe" => "直接填入优惠券的面额。如：10",
        "std" => "",
        "title" => "优惠金额："),
    "hao_ljgm" => array(
        "name" => "hao_ljgm",
        "describe" => "直接写入商品购买链接或领券链接",
        "std" => "",
        "title" => "购买链接："),
    "hao_xiaol" => array(
        "name" => "hao_xiaol",
        "describe" => "直接填入商品销量。如：8991",
        "std" => "",
        "title" => "产品销量："),
    "hao_zongl" => array(
        "name" => "hao_zongl",
        "describe" => "直接填入商品优惠券的总数量。如：100000",
        "std" => "",
        "title" => "优惠券量："),
    "hao_leix" => array(
        "name" => "hao_leix",
        "describe" => "请填入：淘宝或天猫",
        "std" => "",
        "title" => "店铺类型：")
);
 
function hao_meta_boxes() {
    global $post, $hao_meta_boxes;
    foreach($hao_meta_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'', true);
        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];
            echo '<table><tr><td><h4>'.$meta_box['title'].'</h4></td>';
            echo '<td><textarea cols="50" rows="1" name="'.$meta_box['name'].'">'.$meta_box_value.'</textarea></td>';
            echo '<td><p>'.$meta_box['describe'].'</p></td></tr></table>';
    }
    echo '<input type="hidden" name="dj_metaboxes_nonce" id="dj_metaboxes_nonce" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
}

function create_meta_box() {
    global $theme_name;
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'hao-meta-boxes', '商品信息', 'hao_meta_boxes', 'post', 'normal', 'high' );
    }
}

function save_postdata( $post_id ) {
    global $hao_meta_boxes;
    if ( !wp_verify_nonce( $_POST['dj_metaboxes_nonce'], plugin_basename(__FILE__) ))
        return;
    if ( !current_user_can( 'edit_posts', $post_id ))
        return;
    foreach($hao_meta_boxes as $meta_box) {
        $data = $_POST[$meta_box['name'].''];
        if($data == "")
            delete_post_meta($post_id, $meta_box['name'].'', get_post_meta($post_id, $meta_box['name'].'', true));
        else
            update_post_meta($post_id, $meta_box['name'].'', $data);
    }
}

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');

function hao_admin_js() {
?>
<script src="<?php bloginfo('template_url'); ?>/ui/jquery.js" type="text/javascript" ></script>
<script>
jQuery(document).ready(function(){
$("#postdivrich").before($("#hao-meta-boxes"));
})
</script>
<?php
}
add_action( 'admin_head', 'hao_admin_js' );

/**
 * 添加输出菜单描述的 Walker 类
 * https://www.wpdaxue.com/wp_nav_menu-output-description.html
 */
class description_walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth, $args)
    {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
        $class_names = $value = '';
 
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';
 
        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
 
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
 
        $prepend = '<span >';
        $append = '</span>';
        $description  = ! empty( $item->description ) ? '<span class="iconfont">'.esc_attr( $item->description ).'</span>' : '';
 
        if($depth != 0)
        {
            $description = $append = $prepend = "";
        }
 
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $description.$args->link_after;
        $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
        $item_output .= '</a>';
        $item_output .= $args->after;
 
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
?>