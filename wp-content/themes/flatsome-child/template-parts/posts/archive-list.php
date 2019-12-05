<?php 
	$titleNews = get_field('vbk_title_content_news', 'option');
	$xhtml = '';
	$xhtml.= '<div class="custommer-title-tag-category">';
	$xhtml.= '<h1>'.$titleNews.'<h1>';
	$xhtml.= '</div>';
	echo $xhtml;
?>

<?php if ( have_posts() ) : ?>

<?php
	// Create IDS
	$contentLength = get_field('vbk_length_content_news', 'option');
	$ids = array();
	$xhtml = '';
	$xhtml.= '<div id="mi-list-news">
				<div class="mi-news-boxs">';
	while ( have_posts() ) : the_post();
		array_push($ids, get_the_ID());
	$xhtml.= '<div class="mi-news-it">
				<a class="mi-news-images" href="'.get_the_permalink().'">';
	$xhtml.=		get_the_post_thumbnail( get_the_id(), 'post-thumb', array("alt"=>get_the_title(), 'class' => 'media-object') );
	$xhtml.=   	'</a>';
	$xhtml.=    '<div class="mi-news-if">
        			<h3><a class="mi-news-tit" href="'.get_the_permalink().'" title="">'.get_the_title().'</a></h3>
        			<div class="mi-news-txt">'.content($contentLength).'</div>
        		</div>
			 </div>';
	endwhile;
	$xhtml.=    '</div>
			</div>';
	$ids = implode(',', $ids);
	echo $xhtml;
?>
<?php flatsome_posts_pagination(); ?>

<?php else : ?>

	<?php get_template_part( 'template-parts/posts/content','none'); ?>

<?php endif; ?>