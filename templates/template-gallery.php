<?php

/**
 *
 * Template Name: Gallery Template
 *
*/

get_header(); ?>

<?php

// Images
$images = rwmb_meta( 'mustang_gallery', array(
	'type' => 'image_advanced',
	'size' => 'mustang-partner-thumb',
), get_the_ID() );

if ( count( $images ) ) :
?>

<div class="image-box">
	<?php foreach ( $images as $image ) : ?>
		<img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php $image['height']; ?>" alt="<?php $image['title']; ?>">
	<?php endforeach; ?>
</div>

<?php endif; get_footer(); ?>
