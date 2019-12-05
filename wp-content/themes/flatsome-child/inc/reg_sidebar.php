<?php

function wpdocs_theme_slug_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Product Sidebar Follow', 'woocommerce' ),
        'id'            => 'sidebar-single-bellow',
        'before_widget' => '<div class="col large-3 hide-for-medium product-sidebar-small product-sidebar-follow">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="widget-title shop-sidebar sale_product">',
        'after_title'   => '</span>',
    ) );
}
add_action( 'widgets_init', 'wpdocs_theme_slug_widgets_init' );