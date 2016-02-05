
<?php

// Images
$partners = rwmb_meta( 'mustang_partners', array(
	'type' => 'image_advanced',
	'size' => 'mustang-partner-thumb',
), get_the_ID() );

?>

<?php $partners_heading = rwmb_meta( 'mustang_partners_heading', get_the_ID() ); ?>
<section id="partners">
	<div class="container">
		<h2 class="medium-heading"><?php echo isset( $partners_heading ) ? $partners_heading : __( 'Partners', 'mustang' ); ?></h2>
		<ul class="partners-list">
			<?php foreach ( $partners as $partner ) : ?>
				<li><img src="<?php echo $partner['url']; ?>" width="<?php echo $partner['width']; ?>" height="<?php echo $partner['height']; ?>" alt="<?php echo $partner['title']; ?>"></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section><!-- end of partners -->