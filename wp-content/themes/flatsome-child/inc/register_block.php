<?php 
add_action('acf/init', 'my_register_blocks');
function my_register_blocks() {

    // check function exists.
    if( function_exists('acf_register_block_type') ) {

        // Register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'title_product_category',
            'title'             => __('Tiêu đề danh mục sản phẩm'),
            'render_template'   => 'template-parts/blocks/title_product_category.php',
            'category'          => 'formatting',
        ));
    }
}
