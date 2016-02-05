<?php

if ( post_type_exists( 'm1t_banners' ) && get_theme_mod( 'show_banners_pt' ) === true ) {

	global $post;

	$args = array(
		'post_type' => 'm1t_banners',
		'orderby'   => 'ID',
		'order'     => 'DESC',
		'posts_per_page' => '-1',
		'no_found_rows' => true
	);
	$query = new WP_Query( $args );

	?>
	<section id="banner">
		<div class="main-slider">
		<?php if ( $query->posts ) : foreach ( $query->posts as $post ) : setup_postdata( $post ); ?>
			<div class="b-item">

				<?php if ( has_post_thumbnail( get_the_ID() ) ) {
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'mustang-banner' );
				?>
					<img src="<?php echo $thumb[0]; ?>" width="<?php echo $thumb[1]; ?>" height="<?php echo $thumb[2]; ?>"  alt="<?php the_title(); ?>">
				<?php } ?>
				<div class="slider-text-block">
					<h2><?php the_title(); ?></h2>
					<?php if ( get_the_content() ) the_content(); ?>

					<?php if ( $more_link = rwmb_meta( 'mustang_m1t_banners_more_link', $args = array(), get_the_ID() ) ) :
						$more_text = rwmb_meta( 'mustang_m1t_banners_more_text', $args = array(), get_the_ID() );
					?>
					<a href="<?php echo $more_link; ?>" class="btn btn-primary" title="<?php _e( 'Learn More', 'mustang' ); ?>"><?php echo empty( $more_text ) ? __( 'Learn More', 'mustang' ) : $more_text; ?></a>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; wp_reset_postdata(); $query = null; else : echo sprintf( '<div class="no-data">%s</div>', __( 'No banners found', 'mustang' ) ); endif; ?>
		</div>
	</section><!-- end of banner -->

	<?php
}