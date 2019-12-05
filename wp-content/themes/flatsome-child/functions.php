<?php
// Add custom Theme Functions here
require 'inc/widget.php';
require 'inc/cusFunctionsShortCode.php';
require 'inc/reg_sidebar.php';

/** UPDATE JQUERY VERSION */

function replace_core_jquery_version() {
    wp_deregister_script( 'jquery' );
    // Change the URL if you want to load a local copy of jQuery from your own server.
    wp_register_script( 'jquery', "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js", array(), NULL );
}
add_action( 'wp_enqueue_scripts', 'replace_core_jquery_version' );

function setup_script_theme()
{
    
    wp_enqueue_style('app-css',  get_stylesheet_directory_uri() . '/assets/css/app.css', array(), wp_get_theme()->get('Version'));
    wp_enqueue_style('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), NULL);
    wp_enqueue_style('owl-carousel-default', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', array(), NULL);
    wp_enqueue_script('main-js', get_stylesheet_directory_uri() . '/assets/js/main.js' ,array ( 'jquery' ), wp_get_theme()->get('Version'));
    wp_enqueue_script('owl-carousel-script', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array(), NULL);
    wp_enqueue_style('awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css', array(), NULL);

}
add_action('wp_enqueue_scripts', 'setup_script_theme');


// function vaibekum_load_theme_scripts() {
// 	wp_enqueue_script('vaibekum.js',get_stylesheet_directory_uri().'/js/vaibekum.js' , array(), wp_get_theme()->get('Version'));
// }
// add_action( 'wp_enqueue_scripts', 'vaibekum_load_theme_scripts', 30 );

function remove_price_product()
{
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
}
add_action('init', 'remove_price_product');

function pc_add_button_chat(){
    $mg = get_field('vbk_messenger_chat', 'option');
    echo '<a href="'.$mg.'" class="btn button primary">Chat với người bán</a>';
}

add_action('add_button_chat', 'pc_add_button_chat',11,1);

function remove_rating_single_product(){
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
}
add_action('init', 'remove_rating_single_product');

function gift_product(){
    $content_gift = 'content';
    if(have_rows($content_gift)){
        echo '<div class="note-promo">';
        while(have_rows($content_gift)): the_row();
            $url = get_sub_field('link')['url'];
            $target = get_sub_field('link')['target'];
            $title = get_sub_field('link')['title'];
            echo '<p class="link_shop"><a href="'.$url.'" target="'.$target.'">';
            if(!empty($title)){
               echo $title;
            }else{
                echo $url;
            }

            echo  '</a></p>';
            
        endwhile;
        echo '</div>';
    }

}
add_action('woocommerce_single_product_summary', 'gift_product', 25,0);

//add key google map api

function my_acf_init() {

    acf_update_setting('google_api_key', 'AIzaSyBzB4oH-3da_7O2h67LyXCos6kjyqhGxvw');
}
add_action('acf/init', 'my_acf_init');

function create_short_code_add_breadcrumbs(){
    if(!is_front_page()){
        echo '<div class="row row-main">';
        echo '<div class="p-15">';
         if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb('<p id="breadcrumbs">','</p>');
            }
        echo '</div></div>';
    }
}
add_shortcode('CUSTOMMER-YOAST-BREADCRUMB', 'create_short_code_add_breadcrumbs');

add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
    function wcs_woo_remove_reviews_tab($tabs) {
    unset($tabs['reviews']);
    return $tabs;
}
/**
 * Rename product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {

	$tabs['description']['title'] = 'Mô tả';	// Rename the description tab

	return $tabs;

}

// // define the woocommerce_output_related_products_args callback
// function filter_woocommerce_output_related_products_args( $args ) {
//     // make filter magic happen here...
//     $args = array(
//         'posts_per_page' => 5,
//         'columns' => 8,
//         'orderby' => 'rand'
//    );
//     return $args;
// };

// add the filter
// add_filter( 'woocommerce_output_related_products_args', 'filter_woocommerce_output_related_products_args', 10, 1 );

/* THEME OPTIONS */
if(function_exists('acf_add_options_page')){
    acf_add_options_page(array(
        'page_title' 	=> 'Thiết lập giao diện',
		'menu_title'	=> 'Thiết lập giao diện',
        'menu_slug' 	=> 'theme-settings',
        'capability'	=> 'edit_posts',
		'redirect'	=> false,
    ));
};
if(function_exists('show_image_feedback')){
    $num_image = get_field('vbk_number_feedback', 'option');
    echo $num_image;
}


//custom display in stock
function woocommerce_get_custom_availability( $data, $product ) {
    $html = '<span class="stock-brand-title"><strong><i class="fas fa-check-square"></i> Tình trạng: </strong></span>';
    switch( $product->stock_status ) {
        case 'instock':
            $data = array( 'availability' => __( $html . 'Còn hàng', 'woocommerce' ), 'class' => 'in-stock' );
        break;
        case 'outofstock':
            $data = array( 'availability' => __( $html. 'Hết hàng', 'woocommerce' ), 'class' => 'out-of-stock' );
        break;
        case 'onrequest':
            $data = array( 'availability' => __( $html. 'Available to Order', 'woocommerce' ), 'class' => 'on-request' );
        break;
    }
    return $data;
}
add_action('woocommerce_get_availability', 'woocommerce_get_custom_availability', 10, 2);

/* THAY ĐỔI TIỀN VIỆT NAM ĐỒNG */
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);
function change_existing_currency_symbol($currency_symbol, $currency) {
    switch ($currency) {
        case 'VND':
            $currency_symbol = ' đ';
            break;
    }
    return $currency_symbol;
}

/* THAY ĐỔI 0đ THÀNH LIÊN HỆ*/
function vbk_wc_custom_get_price_html( $price, $product ) {
    if ( $product->get_price() == 0 ) {
        if ( $product->is_on_sale() && $product->get_regular_price() ) {
            $regular_price = wc_get_price_to_display( $product, array( 'qty' => 1, 'price' => $product->get_regular_price() ) );

            $price = wc_format_price_range( $regular_price, __( 'Free!', 'woocommerce' ) );
        } else {
            $price = '<span class="amount">' . __( 'Liên hệ', 'woocommerce' ) . '</span>';
        }
    }
    return $price;
}
add_filter( 'woocommerce_get_price_html', 'vbk_wc_custom_get_price_html', 10, 2 );

/* DỊCH TỪ WOOCOMMERCE CHUNG */
function flatsome_mayphotocomvn_text_strings( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
        case '₫' :
            $translated_text = __( ' đ', 'woocommerce' );
            break;
        case 'Posts found' :
            $translated_text = __( 'Bài viết tìm thấy', 'woocommerce' );
            break;
        case 'View cart' :
            $translated_text = __( 'Xem giỏ hàng', 'woocommerce' );
            break;
        case 'Checkout' :
            $translated_text = __( 'Thanh toán', 'woocommerce' );
            break;
        case 'Search' :
            $translated_text = __( 'Tìm kiếm sản phẩm ...', 'woocommerce' );
            break;
        case 'Description' :
            $translated_text = __( 'Chi tiết', 'woocommerce' );
            break;
        case 'Be the first to review' :
            $translated_text = __( 'Hãy là người đầu tiên nhận xét', 'woocommerce' );
            break;
        case 'Cart' :
            $translated_text = __( 'Giỏ hàng', 'woocommerce' );
            break;
        case 'Subtotal' :
            $translated_text = __( 'Tổng cộng', 'woocommerce' );
            break;
        case 'Product' :
            $translated_text = __( 'Sản phẩm', 'woocommerce' );
            break;
        case 'Price' :
            $translated_text = __( 'Giá', 'woocommerce' );
            break;
        case 'Quantity' :
            $translated_text = __( 'Số lượng', 'woocommerce' );
            break;
        case 'Total' :
            $translated_text = __( 'Tổng cộng', 'woocommerce' );
            break;
        case 'Cart totals' :
            $translated_text = __( 'Tổng số lượng', 'woocommerce' );
            break;
        case 'Proceed to checkout' :
            $translated_text = __( 'Tiến hành thanh toán', 'woocommerce' );
            break;
        case 'Coupon' :
            $translated_text = __( 'Mã giảm giá', 'woocommerce' );
            break;
        case 'Coupon code' :
            $translated_text = __( 'Mã ưu đãi', 'woocommerce' );
            break;
        case 'Apply coupon' :
            $translated_text = __( 'Áp dụng mã ưu đãi', 'woocommerce' );
            break;
        case '← Continue shopping' :
            $translated_text = __( 'Tiếp tục xem sản phẩm', 'woocommerce' );
            break;
        case 'Update cart' :
            $translated_text = __( 'Cập nhật giỏ hàng', 'woocommerce' );
            break;
        case 'Checkout' :
            $translated_text = __( 'Thanh toán', 'woocommerce' );
            break;
        case 'Billing details' :
            $translated_text = __( 'Thông tin thanh toán', 'woocommerce' );
            break;
        case 'Additional information' :
            $translated_text = __( 'Thông tin bổ sung', 'woocommerce' );
            break;
        case 'Your order' :
            $translated_text = __( 'Đơn hàng của bạn', 'woocommerce' );
            break;
        case 'Place order' :
            $translated_text = __( 'Đặt hàng', 'woocommerce' );
            break;
        case 'Shopping Cart' :
            $translated_text = __( 'Giỏ hàng', 'woocommerce' );
            break;
        case 'Checkout details' :
            $translated_text = __( 'Thanh toán', 'woocommerce' );
            break;
        case 'Order Complete' :
            $translated_text = __( 'Hoàn thành', 'woocommerce' );
            break;
        case 'Return to shop' :
            $translated_text = __( 'Quay trở lại cửa hàng', 'woocommerce' );
            break;
        case 'Tiếp tục xem sản phẩm' :
            $translated_text = __( 'Quay lại xem SP', 'woocommerce' );
            break;
        case 'We look forward to fulfilling your order soon.' :
            $translated_text = __( '', 'woocommerce' );
            break;
        case 'Cảm ơn đã đặt hàng. Đơn hàng sẽ bị tạm giữ cho đến khi chúng tôi xác nhận thanh toán hoàn thành. Trong thời gian chờ đợi, đây là lời nhắc về những gì bạn đã đặt hàng:' :
            $translated_text = __( 'Cám ơn bạn đã đặt hàng, vui lòng xem lại thông tin bên dưới kỹ càng trước khi thanh toán.', 'woocommerce' );
            break;
        case 'Địa chỉ thanh toán' :
            $translated_text = __( 'Địa chỉ giao hàng', 'woocommerce' );
            break;
        case 'Send email price' :
            $translated_text = __( 'Gởi báo giá', 'woocommerce' );
            break;
        case 'Tìm kiếm' :
            $translated_text = __( 'Tìm kiếm sản phẩm ...', 'woocommerce' );
            break;
        case 'No products in the cart.' :
            $translated_text = __( 'Chưa có sản phẩm trong giỏ hàng.', 'woocommerce' );
            break;
        case 'Related products' :
            $translated_text = __('Sản phẩm cùng loại', 'woocommerce');
            break;
        case 'No products were found matching your selection.' :
            $translated_text = __('Không có sản phẩm nào trong danh mục này.', 'woocommerce');
            break;
        case 'Out of stock' :
            $translated_text = __('Hết hàng', 'woocommerce');
            break;
        case 'Clear selection' :
            $translated_text = __('Xóa lựa chọn', 'woocommerce');
            break;
        
    }
    return $translated_text;
}
add_filter( 'gettext', 'flatsome_mayphotocomvn_text_strings', 20, 3 );

/* DỊCH TỪ WOOCOMMERCE KHÔNG DỊCH ĐƯỢC */
function ra_change_translate_text_multiple( $translated ) {
    $text = array(
        'Subtotal' => 'Tổng cộng',
        'Tổng' => 'Thành tiền',
        'Thành tiền cộng' => 'Tổng cộng',
        'Thành tiền số phụ:' => 'Tổng cộng :',
        'Tổng cộng:' => 'Thành tiền :',
        'Cám ơn!' => '',
        'Cảm ơn đã đọc.' => '',
        'Thuế VAT:' => 'thuế VAT :',
        'Lưu ý:' => 'Lưu ý :',
        'Note:' => 'Lưu ý :',
        'Tạm tính:' => 'Tổng cộng',
    );
    $translated = str_ireplace( array_keys($text), $text, $translated );
    return $translated;
}
add_filter( 'gettext', 'ra_change_translate_text_multiple', 20 );

/* SỬ DỤNG STMP GMAIL */
add_action( 'phpmailer_init', function( $phpmailer ) {
    $contentText = get_field('vbk_from_name_text_gmail','option');
    $userName = get_field('vbk_username_gmail','option');
    $passWord = get_field('vbk_password_app_gmail','option');
    if ( !is_object( $phpmailer ) )
    $phpmailer = (object) $phpmailer;
    $phpmailer->Mailer     = 'smtp';
    $phpmailer->Host       = 'smtp.gmail.com';
    $phpmailer->SMTPAuth   = 1;
    $phpmailer->Port       = 587;
    $phpmailer->Username   = ''.$userName.'';
    $phpmailer->Password   = ''.$passWord.'';
    $phpmailer->SMTPSecure = 'TLS';
    $phpmailer->From       = ''.$userName.'';
    $phpmailer->FromName   = ''.$contentText.'';
});

/* PHÂN TRANG */
function wp_corenavi_table($custom_query = null) {
    global $wp_query;
    if($custom_query) $main_query = $custom_query;
    else $main_query = $wp_query;
    $big = 999999999;
    $total = isset($main_query->max_num_pages)?$main_query->max_num_pages:'';
    if($total > 1) echo '<div class="paginate_links">';
    echo paginate_links( array(
       'base'        => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
       'format'   => '?paged=%#%',
       'current'  => max( 1, get_query_var('paged') ),
       'total'    => $total,
       'mid_size' => '10',
       'prev_text'    => __('<','mi'),
       'next_text'    => __('>','mi'),
    ) );
    if($total > 1) echo '</div>';
}

function content($limit) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
    } else {
        $content = implode(" ",$content);
    }
    $content = preg_replace('/[.+]/','', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_shortcodes($content);
    $content = strip_tags($content);
    $content = substr($content, 0, $limit);
    $content = substr($content, 0, strripos($content, " "));
    $content = trim(preg_replace( '/\s+/', ' ', $content));
    $content = $content.' ...';
    return $content;
}

/********* THAY ĐỔI FORM THÔNG TIN GIAO HÀNG ***********/
add_filter( 'woocommerce_checkout_fields' , 'custom_checkout_form' );
function custom_checkout_form( $fields ) {
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_city']);

    $fields['billing']['billing_first_name'] = array(
    'label' => 'Họ Tên',
    'placeholder' => 'Ví dụ: Nguyễn Trung Trực',
    'required'  => true,
    );

    $fields['billing']['billing_phone'] = array(
    'label' => 'Số điện thoại',
    'placeholder' => 'Ví dụ: 0988286818',
    'required'  => true,
    );

    $fields['billing']['billing_email'] = array(
    'label' => 'Email',
    'placeholder' => 'Ví dụ: mucinlaser@gmail.com',
    'required'  => true,
    );

    $fields['billing']['billing_address_1'] = array(
    'label' => 'Địa chỉ giao hàng',
    'placeholder' => 'Ví dụ: Số 18 Ngõ 86 Phú Kiều, Bắc Từ Liêm, Hà Nội',
    'required'  => false,
    );

    $fields['order']['order_comments'] = array(
    'label' => 'Ghi chú',
    'placeholder' => 'Ví dụ: giao hàng trước 17h',
    'required'  => false,
    );

    return $fields;
}

/********* THÊM CÁC TỈNH THÀNH PHỐ WOOCOMMERCE ***********/
add_filter( 'woocommerce_states', 'vietnam_cities_woocommerce' );
function vietnam_cities_woocommerce( $states ) {
  $states['VN'] = array(
    'Cần Thơ' => __('Cần Thơ', 'woocommerce') ,
    'Hồ Chí Minh' => __('Hồ Chí Minh', 'woocommerce') ,
    'Hà Nội' => __('Hà Nội', 'woocommerce') ,
    'Hải Phòng' => __('Hải Phòng', 'woocommerce') ,
    'Đà Nẵng' => __('Đà Nẵng', 'woocommerce') ,
    'An Giang' => __('An Giang', 'woocommerce') ,
    'Bà Rịa - Vũng Tàu' => __('Bà Rịa - Vũng Tàu', 'woocommerce') ,
    'Bạc Liêu' => __('Bạc Liêu', 'woocommerce') ,
    'Bắc Kạn' => __('Bắc Kạn', 'woocommerce') ,
    'Bắc Ninh' => __('Bắc Ninh', 'woocommerce') ,
    'Bắc Giang' => __('Bắc Giang', 'woocommerce') ,
    'Bến Tre' => __('Bến Tre', 'woocommerce') ,
    'Bình Dương' => __('Bình Dương', 'woocommerce') ,
    'Bình Định' => __('Bình Định', 'woocommerce') ,
    'Bình Phước' => __('Bình Phước', 'woocommerce') ,
    'Bình Phước' => __('Bình Thuận', 'woocommerce'),
    'Cà Mau' => __('Cà Mau', 'woocommerce'),
    'Đak Lak' => __('Đak Lak', 'woocommerce'),
    'Đak Nông' => __('Đak Nông', 'woocommerce'),
    'Điện Biên' => __('Điện Biên', 'woocommerce'),
    'Đồng Nai' => __('Đồng Nai', 'woocommerce'),
    'Gia Lai' => __('Gia Lai', 'woocommerce'),
    'Hà Giang' => __('Hà Giang', 'woocommerce'),
    'Hà Nam' => __('Hà Nam', 'woocommerce'),
    'Hà Tĩnh' => __('Hà Tĩnh', 'woocommerce'),
    'Hải Dương' => __('Hải Dương', 'woocommerce'),
    'Hậu Giang' => __('Hậu Giang', 'woocommerce'),
    'Hòa Bình' => __('Hòa Bình', 'woocommerce'),
    'Hưng Yên' => __('Hưng Yên', 'woocommerce'),
    'Khánh Hòa' => __('Khánh Hòa', 'woocommerce'),
    'Kiên Giang' => __('Kiên Giang', 'woocommerce'),
    'Kom Tum' => __('Kom Tum', 'woocommerce'),
    'Lai Châu' => __('Lai Châu', 'woocommerce'),
    'Lâm Đồng' => __('Lâm Đồng', 'woocommerce'),
    'Lạng Sơn' => __('Lạng Sơn', 'woocommerce'),
    'Lào Cai' => __('Lào Cai', 'woocommerce'),
    'Long An' => __('Long An', 'woocommerce'),
    'Nam Định' => __('Nam Định', 'woocommerce'),
    'Nghệ An' => __('Nghệ An', 'woocommerce'),
    'Ninh Bình' => __('Ninh Bình', 'woocommerce'),
    'Ninh Thuận' => __('Ninh Thuận', 'woocommerce'),
    'Phú Thọ' => __('Phú Thọ', 'woocommerce'),
    'Phú Yên' => __('Phú Yên', 'woocommerce'),
    'Quảng Bình' => __('Quảng Bình', 'woocommerce'),
    'Quảng Nam' => __('Quảng Nam', 'woocommerce'),
    'Quảng Ngãi' => __('Quảng Ngãi', 'woocommerce'),
    'Quảng Ninh' => __('Quảng Ninh', 'woocommerce'),
    'Quảng Trị' => __('Quảng Trị', 'woocommerce'),
    'Sóc Trăng' => __('Sóc Trăng', 'woocommerce'),
    'Sơn La' => __('Sơn La', 'woocommerce'),
    'Tây Ninh' => __('Tây Ninh', 'woocommerce'),
    'Thái Bình' => __('Thái Bình', 'woocommerce'),
    'Thái Nguyên' => __('Thái Nguyên', 'woocommerce'),
    'Thanh Hóa' => __('Thanh Hóa', 'woocommerce'),
    'Thừa Thiên - Huế' => __('Thừa Thiên - Huế', 'woocommerce'),
    'Tiền Giang' => __('Tiền Giang', 'woocommerce'),
    'Trà Vinh' => __('Trà Vinh', 'woocommerce'),
    'Tuyên Quang' => __('Tuyên Quang', 'woocommerce'),
    'Vĩnh Long' => __('Vĩnh Long', 'woocommerce'),
    'Vĩnh Phúc' => __('Vĩnh Phúc', 'woocommerce'),
    'Yên Bái' => __('Yên Bái', 'woocommerce'),
  );

  return $states;
}
function flatsome_vaibekum_custom_checkout_fields( $fields ) {

    // Đổi tên Bang / Hạt thành Tỉnh / Thành Phố
    $fields['state']['label'] = 'Tỉnh / Thành Phố';
    return $fields;
}
add_filter( 'woocommerce_default_address_fields', 'flatsome_vaibekum_custom_checkout_fields' );

/* REMOVE URL PRODUCT FIX LINKS */
function devvn_remove_slug( $post_link, $post ) {
    if ( !in_array( get_post_type($post), array( 'product' ) ) || 'publish' != $post->post_status ) {
        return $post_link;
    }
    if('product' == $post->post_type){
        $post_link = str_replace( '/product/', '/', $post_link );
    }else{
        $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
    }
    return $post_link;
}
add_filter( 'post_type_link', 'devvn_remove_slug', 10, 2 );

function devvn_woo_product_rewrite_rules($flash = false) {
    global $wp_post_types, $wpdb;
    $siteLink = esc_url(home_url('/'));
    foreach ($wp_post_types as $type=>$custom_post) {
        if($type == 'product'){
            if ($custom_post->_builtin == false) {
                $querystr = "SELECT {$wpdb->posts}.post_name, {$wpdb->posts}.ID
                            FROM {$wpdb->posts}
                            WHERE {$wpdb->posts}.post_status = 'publish'
                            AND {$wpdb->posts}.post_type = '{$type}'";
                $posts = $wpdb->get_results($querystr, OBJECT);
                foreach ($posts as $post) {
                    $current_slug = get_permalink($post->ID);
                    $base_product = str_replace($siteLink,'',$current_slug);
                    add_rewrite_rule($base_product.'?$', "index.php?{$custom_post->query_var}={$post->post_name}", 'top');
                    add_rewrite_rule($base_product.'comment-page-([0-9]{1,})/?$', 'index.php?'.$custom_post->query_var.'='.$post->post_name.'&cpage=$matches[1]', 'top');
                    add_rewrite_rule($base_product.'(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?'.$custom_post->query_var.'='.$post->post_name.'&feed=$matches[1]','top');
                }
            }
        }
    }
    if ($flash == true)
        flush_rewrite_rules(false);
}
add_action('init', 'devvn_woo_product_rewrite_rules');
/*Fix lỗi khi tạo sản phẩm mới bị 404*/
function devvn_woo_new_product_post_save($post_id){
    global $wp_post_types;
    $post_type = get_post_type($post_id);
    foreach ($wp_post_types as $type=>$custom_post) {
        if ($custom_post->_builtin == false && $type == $post_type) {
            devvn_woo_product_rewrite_rules(true);
        }
    }
}
add_action('wp_insert_post', 'devvn_woo_new_product_post_save');

/*
 * Link https://https://domain.net/xoa-bo-product-category-va-toan-bo-slug-cua-danh-muc-cha-khoi-duong-dan-cua-woocommerce/
 * */
// Remove product cat base product-category and all-slug
add_filter('term_link', 'devvn_no_term_parents', 1000, 3);
function devvn_no_term_parents($url, $term, $taxonomy) {
    if($taxonomy == 'product_cat'){
        $term_nicename = $term->slug;
        $url = trailingslashit(get_option( 'home' )) . user_trailingslashit( $term_nicename, 'category' );
    }
    return $url;
}

// Add our custom product cat rewrite rules
function devvn_no_product_cat_parents_rewrite_rules($flash = false) {
    $terms = get_terms( array(
        'taxonomy' => 'product_cat',
        'post_type' => 'product',
        'hide_empty' => false,
    ));
    if($terms && !is_wp_error($terms)){
        foreach ($terms as $term){
            $term_slug = $term->slug;
            add_rewrite_rule($term_slug.'/?$', 'index.php?product_cat='.$term_slug,'top');
            add_rewrite_rule($term_slug.'/page/([0-9]{1,})/?$', 'index.php?product_cat='.$term_slug.'&paged=$matches[1]','top');
            add_rewrite_rule($term_slug.'/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?product_cat='.$term_slug.'&feed=$matches[1]','top');
        }
    }
    if ($flash == true)
        flush_rewrite_rules(false);
}
add_action('init', 'devvn_no_product_cat_parents_rewrite_rules');

/*Sửa lỗi khi tạo mới taxomony bị 404*/
add_action( 'create_term', 'devvn_new_product_cat_edit_success', 10);
add_action( 'edit_terms', 'devvn_new_product_cat_edit_success', 10);
add_action( 'delete_term', 'devvn_new_product_cat_edit_success', 10);
function devvn_new_product_cat_edit_success( ) {
    devvn_no_product_cat_parents_rewrite_rules(true);
}

/********* CUSTOMER ĐỊA CHỈ THANH TOÁN TRANG CHECKOUT ***********/
function action_woocommerce_order_details_after_customer_details( $order ) {
	$xhtml = '';
	$xhtml.= '<div class="details-order">
				<div class="information-details">
					<div class="title-color-checkout">Họ tên: <strong>'.$order->get_billing_first_name().'</strong></div>
					<div class="title-color-checkout">Địa chỉ: <strong>'.$order->get_billing_address_1().'</strong></div>
					<div class="title-color-checkout">Số điện thoại: <strong>'.$order->get_billing_phone().'</strong></div>
					<div class="title-color-checkout">Email: <strong>'.$order->get_billing_email().'</strong></div>
				</div>
			 </div>';
	echo $xhtml;
}
add_action( 'woocommerce_order_details_after_customer_details',array($this, 'action_woocommerce_order_details_after_customer_details'),10,1);

/* CHẶN TÍNH NĂNG SO SÁNH GIÁ COCCOC */
add_filter('woocommerce_structured_data_product_offer','devvn_woocommerce_structured_data_product_offer', 10, 2);
function devvn_woocommerce_structured_data_product_offer($markup_offer, $product){
    if ('' !== $product->get_price()) {
        if ($product->is_type('variable')) {
            if(isset($markup_offer['price'])){
                $markup_offer['price'] = 0;
            }
            $markup_offer['priceSpecification']['price'] = 0;
        } else {
            $markup_offer['price'] = 0;
            if(isset($markup_offer['priceSpecification']['price'])){
                $markup_offer['priceSpecification']['price'] = 0;
            }
        }
    }
    return $markup_offer;
}
/* XÁC THỰC SỐ ĐIỆN THOẠI TẠI PAGE CHECK OUT */
add_action('woocommerce_checkout_process', 'devvn_validate_phone_field_process' );
function devvn_validate_phone_field_process() {
    $billing_phone = filter_input(INPUT_POST, 'billing_phone');
    if ( ! (preg_match('/^(0[35789]|09)[0-9]{8}$/', $billing_phone )) ){
        wc_add_notice( "Xin nhập đúng <strong>số điện thoại</strong> của bạn"  ,'error' );
    }
}

/* THÊM HÌNH ẢNH SẢN PHẨM VÀO FORM GỬI MAIL */
add_filter( 'woocommerce_email_order_items_args', 'iconic_email_order_items_args', 10, 1 );
function iconic_email_order_items_args( $args ) {
    $args['show_image'] = true;
    return $args;
}
/* LOẠI BỎ BÀI VIẾT KHI SEARCH */
function search_by_title_only( $search, &$wp_query ) {
    global $wpdb;
    if ( empty( $search ) )
        return $search; // skip processing – no search term in query
    $q = $wp_query->query_vars;
    $n = ! empty( $q['exact'] ) ? '' : '%';
    $search =
    $searchand = '';
    foreach ( (array) $q['search_terms'] as $term ) {
        $term = esc_sql( like_escape( $term ) );
        $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
        $searchand = ' AND ';
    }
    if ( ! empty( $search ) ) {
        $search = " AND ({$search}) ";
        if ( ! is_user_logged_in() )
            $search .= " AND ($wpdb->posts.post_password = '') ";
    }
    return $search;
}
add_filter( 'posts_search', 'search_by_title_only', 500, 2 );

/** ẨN PHƯƠNG THỨC THANH TOÁN SEND EMAIL  **/
add_filter( 'woocommerce_get_order_item_totals', 'custom_woocommerce_get_order_item_totals' );
function custom_woocommerce_get_order_item_totals( $totals ) {
    unset( $totals['payment_method'] );
    return $totals;
}

/* CUSTOMMER STATES DEFAULT */
add_filter( 'default_checkout_state', 'change_default_checkout_state' );
function change_default_checkout_state() {
    return 'Hồ Chí Minh';
}

add_filter( 'woocommerce_single_product_summary', 'woocommerce_total_product_price', 16 );
function woocommerce_total_product_price() {
    global $woocommerce, $product;
    ?>
        <script>
            jQuery(function($){
                function formatNumber(num) {
                    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                }
                var price_sale = <?php echo $product->get_price(); ?>;
                var currence_symbol = '<span class="woocommerce-Price-currencySymbol"> đ</span>';
         
                $('[name=quantity]').change(function(){
                    if (!(this.value < 1)) {

                        var product_total = formatNumber(parseFloat(price_sale * this.value) );
                        if($('.product-page-price>ins .woocommerce-Price-amount.amount').length == 0){
                            $('.product-page-price .woocommerce-Price-amount.amount').html(product_total + currence_symbol);
                           
                        }else{
                            $('.product-page-price>ins .woocommerce-Price-amount.amount').html(product_total + currence_symbol);
                        }
                        
                    }
                });
            });
        </script>
    <?php
}

/**
 * Auto update cart after quantity change
 *
 * @return  string
 **/
add_action( 'woocommerce_after_cart', 'custom_after_cart' );
function custom_after_cart() { 
    if(is_cart()){
    ?>
    <script>
   function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
    jQuery(document).ready(function($) {
        var upd_cart_btn = $("button[name='update_cart']");
        $(".woocommerce-cart-form").find(".qty").on("change", function(){
            var price = parseInt($(this).parent().parent().prev().children().text().replace(/( đ)|,/g, ''));
            var total = $(this).val() * price;
            $(this).parent().parent().next().children().html(formatNumber(total) + '<span class="woocommerce-Price-currencySymbol"> đ</span>');

        });
    });
    </script>
    <?php
    }
}