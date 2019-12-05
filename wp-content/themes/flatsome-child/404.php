<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link    https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package flatsome
 */

get_header(); ?>
<?php do_action( 'flatsome_before_404' ); ?>
<?php
if ( get_theme_mod( '404_block' ) ) :
	echo do_shortcode( '[block id="' . get_theme_mod( '404_block' ) . '"]' );
else :
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main container pt" role="main">
			<section class="error-404 not-found mt mb">
				<div class="row">
					<div class="col medium-12">
						<header class="page-title text-center">
							<img src="<?= get_stylesheet_directory_uri() ?>/images/404.png" alt="error-404">
							<h1 class="page-title"><?php esc_html_e( 'Lỗi không tìm thấy trang', 'flatsome' ); ?></h1>
						</header><!-- .page-title -->
						<div class="page-content text-center land">
							<p><?php esc_html_e( 'Có vẻ như các trang mà bạn đang cố gắng tiếp cận không tồn tại nữa hoặc có thể nó vừa di chuyển.', 'flatsome' ); ?></p>
							<div class="mt-5">
								<a href="/" class="button primary f-w-400 text-white"><i class="fas fa-home" style="font-size: 18px;"></i> Về trang chủ</a>
							</div>
						</div><!-- .page-content -->
					</div>
				</div><!-- .row -->
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->
<?php endif; ?>
<?php do_action( 'flatsome_after_404' ); ?>
<?php get_footer(); ?>
