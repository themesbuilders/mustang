<?php

if ( post_type_exists( 'm1t_members' ) && get_theme_mod( 'show_members_pt' ) === true ) {

	global $post;

	$args = array(
		'post_type' => 'm1t_members',
		'orderby'   => 'ID',
		'order'     => 'DESC',
		'posts_per_page' => '4',
		'no_found_rows' => true
	);
	$query = new WP_Query( $args );

	?>
	<section id="team">
		<div class="container">
			<h2 class="medium-heading">Meet Our Team</h2>
			<div class="row">
			<?php if ( $query->posts ) : foreach ( $query->posts as $post ) : setup_postdata( $post ); ?>
				<div class="col-md-3 col-sm-3">
					<div class="team-block">

						<?php if ( has_post_thumbnail( get_the_ID() ) ) {
							$member_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'mustang-team-thumb' );
						?>
						<div class="team-img">
							<img src="<?php echo $member_thumb[0]; ?>" width="<?php echo $member_thumb[1]; ?>" height="<?php echo $member_thumb[2]; ?>"  alt="<?php the_title(); ?>">
						</div>
						<?php } ?>

						<h3><?php the_title(); ?></h3>
						<?php if ( $position = rwmb_meta( 'mustang_member_position', $args = array(), get_the_ID() ) ) : ?>
							<span class="designation"><?php echo $position; ?></span>
						<?php endif; ?>
						<div class="team-contact">
							<?php if ( function_exists( 'member_social_links' ) )
								member_social_links(); ?>
						</div>
					</div>	
				</div>
			<?php endforeach; wp_reset_postdata(); $query = null; else : echo sprintf( '<div class="no-data">%s</div>', __( 'No members found', 'mustang' ) ); endif; ?>
			</div>
		</div>
	</section><!-- end of team -->

	<?php
}
