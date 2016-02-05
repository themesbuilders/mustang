<?php

/**
 *
 * Template Name: Homepage Template
 *
*/

get_header(); ?>

<?php

// Homepage blocks.
$hp_blocks = array(
	'banners',
	'intro',
	'services',
	'widgets',
	'team',
	'partners',
);

foreach( $hp_blocks as $block )
	get_template_part( 'template-parts/hp/content', $block ); ?>

<?php get_footer(); ?>
