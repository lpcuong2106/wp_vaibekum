<?php
/* CREATE SHORT CODE HỖ TRỢ ONLINE */
if (!function_exists('create_short_code_support_online')) {
	function create_short_code_support_online()
	{
		$address = get_field('vbk_address', 'option');
		$phone = get_field('vbk_phone', 'option');
		$emailHotline = get_field('vbk_email_hotline', 'option');
		$timeWork = get_field('vbk_time_work', 'option');
		$xhtml = '';
		$xhtml .= '<div class="vbk-support">
        					<div class="support" id="support" data-api="smartsupp" data-operation="open">
        						<i class="fa fa-phone"></i>
        						<div class="container-dot-hotline">
        							<div class="animation animation1">
        								<span class="help dot-help-hotline"></span> Hỗ trợ online
        							</div>
        						</div>
        					</div>
        					<div id="contact-infomation-store-load" class="contact-show-info">
        						<i class="icon-bottom"></i>
        						<div class="hotline">Hotline: ' . $phone . '</div>
        						<div><strong>Email:</strong>&nbsp;<strong><a href="mailto:">' . $emailHotline . '</a></strong></div>
        						<div class="support-content">
        							<h4>Vải bé kum</h4>
        							<div class="add-item showroom-item">
        								<div><i class="fa fa-map-marker" title="' . $address . '"></i>' . $address . '</div>
        								<span>Thời gian làm việc: ' . $timeWork . '</span>
        							</div>
        						</div>
        					</div>
        				</div>';
		return $xhtml;
	}
	add_shortcode('SUPPORT-ONLINE', 'create_short_code_support_online');
}

/* CREATE SHORTCODE TITLE */
/** ROW ONE */
if (!function_exists('create_shortcode_title')) {
	function create_shortcode_title()
	{
		$xhtml = '';
		$choose = get_field('vbk_choose_row_one', 'option');
		if($choose == 'Chọn tự nhập'){
			$xhtml .= 	'<div class="container section-head">
							<span class="group-icon">
								<i class="fab fa-dashcube" aria-hidden="true"></i>
							</span>
							<h2>'.get_field('vbk_content_title_row_one', 'option').'</h2>
						</div>';
		}else{
			$category_id = get_field('vbk_choosen_category_one', 'option');
			if(!empty($category_id)){
				$term = get_term_by( 'id', absint( $category_id ), 'product_cat' ); //get category obj
				$name = $term->name;
				$category_link = get_term_link( $category_id, 'product_cat' );
				$xhtml .= '<div class="container section-head">
									<span class="group-icon">
										<i class="fab fa-dashcube" aria-hidden="true"></i>
									</span>
									<h2>'.$name.'</h2>
									<div class="read-more"><a href="'.$category_link.'"><span>Xem thêm</span></a></div>
						</div>';
			}
			
		}
		
		
		return $xhtml;
	}
	add_shortcode('CONTENT-TITLE-1', 'create_shortcode_title');
}
/** ROW TWO */
if (!function_exists('create_shortcode_title_2')) {
	function create_shortcode_title_2()
	{
		$xhtml = '';
		$choose = get_field('vbk_choose_row_two', 'option');
		if($choose == 'Chọn tự nhập'){
			$xhtml .= 	'<div class="container section-head">
							<span class="group-icon">
								<i class="fab fa-dashcube" aria-hidden="true"></i>
							</span>
							<h2>'.get_field('vbk_content_title_row_two', 'option').'</h2>
						</div>';
		}else{
			$category_id = get_field('vbk_choosen_category_two', 'option');
			if(!empty($category_id)){
				$term = get_term_by( 'id', absint( $category_id ), 'product_cat' ); //get category obj
				$name = $term->name;
				$category_link = get_term_link( $category_id, 'product_cat' );
				$xhtml .= '<div class="container section-head">
									<span class="group-icon">
										<i class="fab fa-dashcube" aria-hidden="true"></i>
									</span>
									<h2>'.$name.'</h2>
									<div class="read-more"><a href="'.$category_link.'"><span>Xem thêm</span></a></div>
						</div>';
			}
			
		}
		
		
		return $xhtml;
	}
	add_shortcode('CONTENT-TITLE-2', 'create_shortcode_title_2');
}
/** ROW THREE */
if (!function_exists('create_shortcode_title_3')) {
	function create_shortcode_title_3()
	{
		$xhtml = '';
		$choose = get_field('vbk_choose_row_three', 'option');
		if($choose == 'Chọn tự nhập'){
			$xhtml .= 	'<div class="container section-head">
							<span class="group-icon">
								<i class="fab fa-dashcube" aria-hidden="true"></i>
							</span>
							<h2>'.get_field('vbk_content_title_row_three', 'option').'</h2>
						</div>';
		}else{
			$category_id = get_field('vbk_choosen_category_three', 'option');
			if(!empty($category_id)){
				$term = get_term_by( 'id', absint( $category_id ), 'product_cat' ); //get category obj
				$name = $term->name;
				$category_link = get_term_link( $category_id, 'product_cat' );
				$xhtml .= '<div class="container section-head">
									<span class="group-icon">
										<i class="fab fa-dashcube" aria-hidden="true"></i>
									</span>
									<h2>'.$name.'</h2>
									<div class="read-more"><a href="'.$category_link.'"><span>Xem thêm</span></a></div>
						</div>';
			}
			
		}
		
		
		return $xhtml;
	}
	add_shortcode('CONTENT-TITLE-3', 'create_shortcode_title_3');
}
/** ROW FOUR */
if (!function_exists('create_shortcode_title_4')) {
	function create_shortcode_title_4()
	{
		$xhtml = '';
		$choose = get_field('vbk_choose_row_four', 'option');
		if($choose == 'Chọn tự nhập'){
			$xhtml .= 	'<div class="container section-head">
							<span class="group-icon">
								<i class="fab fa-dashcube" aria-hidden="true"></i>
							</span>
							<h2>'.get_field('vbk_content_title_row_four', 'option').'</h2>
						</div>';
		}else{
			$category_id = get_field('vbk_choosen_category_four', 'option');
			if(!empty($category_id)){
				$term = get_term_by( 'id', absint( $category_id ), 'product_cat' ); //get category obj
				$name = $term->name;
				$category_link = get_term_link( $category_id, 'product_cat' );
				$xhtml .= '<div class="container section-head">
									<span class="group-icon">
										<i class="fab fa-dashcube" aria-hidden="true"></i>
									</span>
									<h2>'.$name.'</h2>
									<div class="read-more"><a href="'.$category_link.'"><span>Xem thêm</span></a></div>
						</div>';
			}
			
		}
		
		
		return $xhtml;
	}
	add_shortcode('CONTENT-TITLE-4', 'create_shortcode_title_4');
}
/** ROW FIVE */
if (!function_exists('create_shortcode_title_5')) {
	function create_shortcode_title_5()
	{
		$xhtml = '';
		$choose = get_field('vbk_choose_row_five', 'option');
		if($choose == 'Chọn tự nhập'){
			$xhtml .= 	'<div class="container section-head">
							<span class="group-icon">
								<i class="fab fa-dashcube" aria-hidden="true"></i>
							</span>
							<h2>'.get_field('vbk_content_title_row_five', 'option').'</h2>
						</div>';
		}else{
			$category_id = get_field('vbk_choosen_category_five', 'option');
			if(!empty($category_id)){
				$term = get_term_by( 'id', absint( $category_id ), 'product_cat' ); //get category obj
				$name = $term->name;
				$category_link = get_term_link( $category_id, 'product_cat' );
				$xhtml .= '<div class="container section-head">
									<span class="group-icon">
										<i class="fab fa-dashcube" aria-hidden="true"></i>
									</span>
									<h2>'.$name.'</h2>
									<div class="read-more"><a href="'.$category_link.'"><span>Xem thêm</span></a></div>
						</div>';
			}
			
		}
		
		
		return $xhtml;
	}
	add_shortcode('CONTENT-TITLE-5', 'create_shortcode_title_5');
}
/* CREATE SHORTCODE ADD TO CART */

function pc_create_add_to_cart()
{
	global $product;
	$pid = $product->get_id();	?>
	<div class="wrap_add_cart" title="Cho vào giỏ hàng"><a href="<?php echo do_shortcode('[add_to_cart_url id=' . $pid . ']') ?>"  data-product_id="<?php echo $pid; ?>"
    class="ajax_add_to_cart add_to_cart_button product_type_simple"><i class="fas fa-shopping-cart"></i></a></div>
<?php
}
add_shortcode('ADD_CART_PC', 'pc_create_add_to_cart');

/* CREATE SHORT CODE BLOG NEWS */
if (!function_exists('create_short_code_blog_news')) {
    function create_short_code_blog_news() {
        $titleNews = get_field('vbk_title_content_news', 'option');
        $xhtml = '';
        $xhtml.= '<div class="body-container-wrapper">
                    <div class="body-container container-fluid">
                        <div class="row-fluid-wrapper row-depth-1 row-number-1">
                            <div class="row-fluid ">
                                <div class="span12 widget-span widget-type-cell page-center content-wrapper container" style="" data-widget-type="cell" data-x="0" data-w="12">
                                    <h1>'.$titleNews.'</h1>
                                    <div class="row-fluid-wrapper row-depth-1 row-number-2">
                                        <div class="row-fluid ">
                                            <div class="span12 widget-span widget-type-cell blog-content" style="" data-widget-type="cell" data-x="0" data-w="8">
                                                <div class="row-fluid-wrapper row-depth-1 row-number-4">
                                                    <div class="row-fluid ">
                                                        <div class="span12 widget-span widget-type-cell " style="" data-widget-type="cell" data-x="0" data-w="12">
                                                            <div class="row-fluid-wrapper row-depth-1 row-number-5">
                                                                <div class="row-fluid ">
                                                                    <div class="span12 widget-span widget-type-custom_widget " style="" data-widget-type="custom_widget" data-x="0" data-w="12">
                                                                        <div id="hs_cos_wrapper_module_1540731714361596" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-blog_content" style="" data-hs-cos-general-type="widget" data-hs-cos-type="module">';
        $xhtml.=                                                            do_shortcode('[SHOW-CATEGORY]');
        $xhtml.=                                                        '</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        return $xhtml;
    }

    add_shortcode( 'BLOG-NEWS', 'create_short_code_blog_news');
}

/* CREATE SHORTCODE SHOW TAGS */

if(!function_exists('create_shortcode_show_tags')) {
    function create_shortcode_show_tags() {
        $post_tags = get_the_tags();
        if (!empty($post_tags)) {
			$output = '';
            $output .= '<div class="title-name-tags">Tags: ';
            foreach ($post_tags as $tag) {
                $output .= '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
            }
            $output .= '</div>';
            return trim($output);
        }
    }
    add_shortcode('SHOW-TAGS', 'create_shortcode_show_tags');
}

/* CREATE SHORTCODE BÀI VIẾT LIÊN QUAN CHI TIẾT BÀI BIẾT */
if(!function_exists('create_shortcode_post_single_blog')) {
    function create_shortcode_post_single_blog() {
        $titleRelated = get_field('vbk_title_related_news','option');
        $numberPostRelated = get_field('vbk_count_post_related','option');
        $categories = get_the_category(get_the_ID());
        if ($categories){
            echo '<div class="mi-related-cat">';
            $category_ids = array();
            foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
            $args=array(
                'category__in' => $category_ids,
                'post__not_in' => array(get_the_ID()),
                'posts_per_page' => $numberPostRelated,
            );
            $my_query = new wp_query($args);
            if( $my_query->have_posts() ):
                echo '<h2 class="mi-title-related">'.$titleRelated.'</h2><ul>';
                while ($my_query->have_posts()):$my_query->the_post();
                    ?>
                    <li><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
                    <?php
                endwhile;
                echo '</ul>';
            endif; wp_reset_query();
            echo '</div>';
        }
    }
    add_shortcode('POST-LIEN-QUAN', 'create_shortcode_post_single_blog');
}

/** CREATE SHORTCODE DISPLAY FEEDBACK CUSTOMER */

if(!function_exists('show_feedback_customer')){
	function show_feedback_customer(){
		class Image
		{
			public $url;
			public $title;
		}

		$array_ImageOfFeedback = array();
		for( $i = 1; $i<=5; $i++ ) {
			$arrayItem = new Image();
			$arrayItem->url = get_field('vbk_number_'.$i.'_feedback', 'option');
			$arrayItem->title = get_field('comment_'.$i, 'option');
			$array_ImageOfFeedback[] = $arrayItem;
		}
		
		$array_imgage_new = array_filter($array_ImageOfFeedback, function($value) { return $value->url !== false; });

		if(!empty($array_imgage_new)){
			$smg = get_field('vbk_messenger_chat', 'option');
			$html = '<div class="row">';
			$html .= '<div class="owl-carousel">';
			foreach($array_imgage_new as $key => $value){
				
				$html .= '<div class="item">
				<div class="product-small col has-hover product type-product post-570 status-publish has-post-thumbnail shipping-taxable purchasable product-type-simple is-selected"">
					<div class="col-inner">
						<div class="product-small box ">
							<div class="box-image">
								<div class="image-fade_in_back">
									<a>
										<img width="247" height="296" src="'.$value->url.'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt=""> </a>
								</div>
								
							</div>
							<!-- box-image -->

							<div class="box-text box-text-products text-center grid-style-2">
								<div class="title-wrapper">
									<p class="name product-title"><a>'.$value->title.'</a></p>
								</div>
								
								<div class="chat_btn"><a href="'.$smg.'" class="btn button primary">Chat với người bán</a></div>
								
							</div>
							<!-- box-text -->
						</div>
						<!-- box -->
					</div>
					<!-- .col-inner -->
				</div>
				
				</div>';
			}
			$html .= '</div></div>';
		}
		return $html;
	}
	add_shortcode('SHOW_FEEDBACK_CUSTOMER', 'show_feedback_customer');
}

/* CREATE SHORT CODE SHOW CATEGORY BLOG */
if (!function_exists('create_short_code_show_category_blog')) {
    function create_short_code_show_category_blog() {
        $contentLength = get_field('vbk_length_content_news', 'option');
        $xhtml = '';
        $xhtml.= '<div id="mi-list-news">
                    <div class="mi-news-boxs">';
                    $cats = get_categories();
                    foreach ($cats as $cat) {
                        $cat_id= $cat->term_id;
                        global $paged;
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        query_posts('category__in='.$cat_id.'&posts_per_page=10&paged='.$paged.'&orderby=date&order=DESC');
                        if (have_posts()) :
                            while (have_posts()) : the_post();
        $xhtml.=                '<div class="mi-news-it">';
                                        $permalink = get_the_permalink();
                                        $title = get_the_title();
        $xhtml.=                    '<a class="mi-news-images" href="'.$permalink.'">';
        $xhtml.=                        get_the_post_thumbnail( get_the_id(), 'post-thumb', array("alt"=>get_the_title(), 'class' => 'media-object') );
        $xhtml.=                    '</a>
                                        <div class="mi-news-if">
                                            <p class="mi-cate-name"><a class="mi-news-ct" href="'.get_category_link($cat_id).'" title="'.$cat->name.'">'.$cat->name.'</a></p>
                                            <h3><a class="mi-news-tit" href="'.$permalink.'" title="'.$title.'">'.$title.'</a></h3>
                                            <div class="mi-news-txt">'.content($contentLength).'</div>
                                        </div>
                                    </div>';
                            endwhile;
                        endif;
                    }
        $xhtml.=    '</div>
                </div>';
        return $xhtml;
    }
    add_shortcode( 'SHOW-CATEGORY', 'create_short_code_show_category_blog');
}

/** TẠO WIDGET SUPPORT ONLINE */

function create_widget_ho_tro_online(){
    $title = get_field('title', 'option');
    $address = get_field('address' , 'option');
    $phone_suppport = get_field('vbk_phone', 'option');
    $time_work = get_field('vbk_time_work', 'option');
    $html = '';
	$html .= '<div class="support-content">';
	$html .= '<span class="widget-title shop-sidebar">'.$title.'</span>';
	$html .= '<div class="support_content">';
    $html .= '<p class="sub-showroom"><a target="_blank" href="https://maps.google.com/?ll='.$address['lat'].','.$address['lng'].'"><i class="fas fa-map-marker-alt"></i>'.$address['address'].'</a></p>';
    $html .= '<span class="color-support">Hỗ trợ:</span>';
   
    if(!empty( $phone_suppport )){
        $html .= '<i class="fas fa-phone phone">  '.$phone_suppport.'</i>';
    }
	$html .= '<span class="color-support-time-work">Thời gian làm việc : '. $time_work.'</span>';  
	$html .= '</div>';
	$html .= '</div>';
    return $html;
}
add_shortcode('WIDGET_SUPPORT_ONLINE', 'create_widget_ho_tro_online');

/** TẠO WIDGET FOOTER TWO  */

function create_footer_two(){

	$location = get_field('address', 'option');
			$html = '';
    		$html .= '<div class="acf-map">';
        	$html .= '<div class="marker" data-lat="'. $location['lat'].'" data-lng="'. $location['lng'] .'"></div>';
			$html .= '</div>'
			?>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzB4oH-3da_7O2h67LyXCos6kjyqhGxvw"></script>   
            <script type="text/javascript">
                (function($) {

                /*
                *  new_map
                *
                *  This function will render a Google Map onto the selected jQuery element
                *
                *  @type	function
                *  @date	8/11/2013
                *  @since	4.3.0
                *
                *  @param	$el (jQuery element)
                *  @return	n/a
                */

                function new_map( $el ) {
                    
                    // var
                    var $markers = $el.find('.marker');
                    
                    
                    // vars
                    var args = {
                        zoom		: 16,
                        center		: new google.maps.LatLng(0, 0),
                        mapTypeId	: google.maps.MapTypeId.ROADMAP
                    };
                    
                    
                    // create map	        	
                    var map = new google.maps.Map( $el[0], args);
                    
                    
                    // add a markers reference
                    map.markers = [];
                    
                    
                    // add markers
                    $markers.each(function(){
                        
                        add_marker( $(this), map );
                        
                    });
                    
                    
                    // center map
                    center_map( map );
                    
                    
                    // return
                    return map;
                    
                }

                /*
                *  add_marker
                *
                *  This function will add a marker to the selected Google Map
                *
                *  @type	function
                *  @date	8/11/2013
                *  @since	4.3.0
                *
                *  @param	$marker (jQuery element)
                *  @param	map (Google Map object)
                *  @return	n/a
                */

                function add_marker( $marker, map ) {

                    // var
                    var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

                    // create marker
                    var marker = new google.maps.Marker({
                        position	: latlng,
                        map			: map
                    });

                    // add to array
                    map.markers.push( marker );

                    // if marker contains HTML, add it to an infoWindow
                    if( $marker.html() )
                    {
                        // create info window
                        var infowindow = new google.maps.InfoWindow({
                            content		: $marker.html()
                        });

                        // show info window when marker is clicked
                        google.maps.event.addListener(marker, 'click', function() {

                            infowindow.open( map, marker );

                        });
                    }

                }

                /*
                *  center_map
                *
                *  This function will center the map, showing all markers attached to this map
                *
                *  @type	function
                *  @date	8/11/2013
                *  @since	4.3.0
                *
                *  @param	map (Google Map object)
                *  @return	n/a
                */

                function center_map( map ) {

                    // vars
                    var bounds = new google.maps.LatLngBounds();

                    // loop through all markers and create bounds
                    $.each( map.markers, function( i, marker ){

                        var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

                        bounds.extend( latlng );

                    });

                    // only 1 marker?
                    if( map.markers.length == 1 )
                    {
                        // set center of map
                        map.setCenter( bounds.getCenter() );
                        map.setZoom( 16 );
                    }
                    else
                    {
                        // fit to bounds
                        map.fitBounds( bounds );
                    }

                }

                /*
                *  document ready
                *
                *  This function will render each map when the document is ready (page has loaded)
                *
                *  @type	function
                *  @date	8/11/2013
                *  @since	5.0.0
                *
                *  @param	n/a
                *  @return	n/a
                */
                // global var
                var map = null;

                $(document).ready(function(){

                    $('.acf-map').each(function(){

                        // create map
                        map = new_map( $(this) );

                    });

                });

            })(jQuery);
			</script>
		<?php
    return $html;
}
add_shortcode('WIDGET_FOOTER_TWO', 'create_footer_two');

/** FOOTER COLLUMN ONE */


/* CREATE SHORT CODE SHOW CATEGORY BLOG */
if (!function_exists('footer_column_one')) {
    function footer_column_one() {
		$logo = get_field('vbk_logo_footer', 'option');
		$address = get_field('vbk_address', 'option');
		$mail = get_field('vbk_email_hotline', 'option');
		$name = get_bloginfo('home');
		$str = preg_replace('#^https?://#', '', $name);
		$shopee = get_field('vbk_shopee', 'option');
		$lazada = get_field('vbk_lazada', 'option');
		$sendo = get_field('vbk_sendo', 'option');
		$xhtml = '';
		if(!empty($logo['url'])){
        $xhtml.= '<div class="ux-logo has-hover align-middle ux_logo inline-block has-block tooltipstered" style="max-width: 100%!important; width: 330px!important">
						<div class="ux-logo-link block image-" title="'.$logo['alt'].'" target="_self" href="" style="padding: 15px;"><img src="'.$logo['url'].'" title="'.get_bloginfo('name').'" alt="'.get_bloginfo('name').'" class="ux-logo-image block" style="height:49px;"></div>
					</div>';
		}
		$xhtml .= '<div class="footer-content">
						<ul class="info">';
						if(!empty($address)){
							$xhtml .= '<li>'.$address.'</li>';
						}
							$xhtml .= '<li>Website: <a href="/">'.$str.'</a></li>';
						if(!empty($mail)){
							$xhtml .= '<li>Email: <a target="_blank" href="mailto:'.$mail.'">'.$mail.'</a></li>';
						}	
						if(!empty($shopee)){
							$xhtml .= '<li>Shopee: <a  target="_blank" href="'.$shopee.'">'.$shopee.'</a></li>';
						}	
						if(!empty($lazada)){
							$xhtml .= '<li>Lazada: <a target="_blank" href="'.$lazada.'">'.$lazada.'</a></li>';
						}	
						if(!empty($sendo)){
							$xhtml .= '<li>Sendo: <a target="_blank" href="'.$sendo.'">'.$sendo.'</a></li>';
						}	
		$xhtml .='</ul></div>';
        return $xhtml;
    }
    add_shortcode( 'SHOW-FOOTER-ONE', 'footer_column_one');
}