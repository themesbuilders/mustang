<?php

if ( post_type_exists( 'm1t_services' ) && get_theme_mod( 'show_services_pt' ) === true ) {

	global $post;

	$args = array(
		'post_type' => 'm1t_services',
		'orderby'   => 'ID',
		'order'     => 'ASC',
		'posts_per_page' => '3',
		'no_found_rows' => true
	);
	$query = new WP_Query( $args );

	?>

	<section id="features">
		<div class="container">
			<div class="row">
			<?php if ( $query->posts ) : foreach ( $query->posts as $post ) : setup_postdata( $post ); ?>
				<div class="col-md-4 col-sm-4">
					<div class="feature-block">
						<?php if ( $fa_icon = rwmb_meta( 'mustang_service_fa_icon', $args = array(), get_the_ID() ) ) : ?>
						<span class="feat-icon"><i class="<?php echo "fa {$fa_icon}"; ?>"></i></span>
						<?php endif; 
							$h_color = rwmb_meta( 'mustang_service_heading_color', $args = array(), get_the_ID() ); 
							$h_color = $h_color ? $h_color : '#000000';
						?>
						<h2 style="color: <?php echo $h_color; ?>" class="color-green"><?php the_title(); ?></h2>
						
						<?php if ( get_the_content() ) : ?>
							<?php the_content(); ?>
						<?php endif; ?>

					</div>
				</div>
			<?php endforeach; wp_reset_postdata(); $query = null; else : echo sprintf( '<div class="no-data">%s</div>', __( 'No entries found', 'mustang' ) ); endif; ?>
			</div>
		</div>
	</section><!-- end of features-->

	<?php
}