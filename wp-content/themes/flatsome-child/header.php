<!DOCTYPE html>
<!--[if IE 9 ]> <html <?php language_attributes(); ?> class="ie9 <?php flatsome_html_classes(); ?>"> <![endif]-->
<!--[if IE 8 ]> <html <?php language_attributes(); ?> class="ie8 <?php flatsome_html_classes(); ?>"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="<?php flatsome_html_classes(); ?>"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<script>
	jQuery(document).ready(function() {
		jQuery("#mega-menu-title").click(function() {
			jQuery("#mega_menu").toggleClass("active")
		}),
		jQuery("body").click(function(e) {
			var i = jQuery(e.target);
			"mega-menu-title" != i.attr("id") && jQuery("#mega_menu.active").removeClass("active")
		}),
		jQuery("#mega_menu>li").each(function(e) {
			jQuery(this).children(".sub-menu").css("margin-top", 37 * -e + "px"), jQuery(this).children(".menu-image").css("margin-top", 37 * -e + "px"), jQuery(this).find("li").each(function(e) {
			jQuery(this).children(".menu-image").css("margin-top", 36 * -e + "px")
			})
		})
	});
</script>
<body <?php body_class(); // Body classes is added from inc/helpers-frontend.php ?>>

<?php do_action( 'flatsome_after_body_open' ); ?>

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'flatsome' ); ?></a>

<div id="wrapper">

<?php do_action('flatsome_before_header'); ?>

<header id="header" class="header <?php flatsome_header_classes();  ?>">
   <div class="header-wrapper">
	<?php
		get_template_part('template-parts/header/header', 'wrapper');
	?>
   </div><!-- header-wrapper-->
</header>

<!-- <?php do_action('pc_after_header'); ?> -->

<main id="main" class="<?php flatsome_main_classes();  ?>">
