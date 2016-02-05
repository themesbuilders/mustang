<?php

// Adds Latest_Single_Post widget.
class Latest_Single_Post extends WP_Widget {

	// Register widget with WordPress.
	function __construct() {
		parent::__construct(
			// Base ID
			'latest_single_post_widget',
			// Name
			__( 'Latest Single Post', 'mustang' ),
			// Args
			array( 'description' => __( 'A widget for displaying latest single post on the homepage.', 'mustang' ), )
		);
	}

	// Front-end display of widget.
	public function widget( $args, $instance ) {

		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => 1,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		?>
		<section id="mobile-devices" class="top-line">
			<div class="container">
				<div class="row">
				<?php if ($r->have_posts()) : while ( $r->have_posts() ) : $r->the_post(); ?>
					<div class="col-md-12">
						<?php if ( has_post_thumbnail( get_the_ID() ) ) {
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'mustang-single-post-image' ); ?>
							<div class="mobile-img-section pull-left">
								<img src="<?php echo $thumb[0]; ?>" width="<?php echo $thumb[1]; ?>" height="<?php echo $thumb[2]; ?>"  alt="<?php the_title(); ?>">
							</div>
						<?php } ?>

						<div class="mobile-content">
							<h2 class="medium-heading"><?php the_title(); ?></h2>
							<?php if ( get_the_content() ) : the_content(); endif; ?>
							<a href="<?php the_permalink(); ?>" class="btn btn-secondary" title="<?php the_title(); ?>"><?php _e( 'Learn More', 'mustang' ); ?></a>
						</div>
					</div>
				<?php endwhile; endif; wp_reset_postdata(); ?>
				</div>
			</div>
		</section>
		<?php
	}

	// Back-end widget form.
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'mustang' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	// Sanitize widget form values as they are saved.
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}

}

// Register Latest_Single_Post widget
function register_latest_single_post_widget() {
    register_widget( 'Latest_Single_Post' );
}
add_action( 'widgets_init', 'register_latest_single_post_widget' );