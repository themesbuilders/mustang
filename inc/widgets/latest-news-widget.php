<?php

class Latest_News_Widget extends WP_Widget {

	// Register with WP.
	function __construct() {
		parent::__construct(
			/* ID. */
			'latest_news_widget',

			/* Widget title. */
			__( 'Latest News Widget', 'mustang' ),

			/* Args. */
			array( 
				'description' => __( 'This is a widget for displaying latest news items.', 'mustang' ),
			)
		);
	}

	// Frontend display.
	public function widget( $args, $instance ) {

		// Limit the news items.
		$num_news = empty( $instance['num_news'] ) ? 3 : $instance['num_news'];

		// Check if post type exists or not.
		if ( post_type_exists( 'm1t_banners' ) && get_theme_mod( 'show_banners_pt' ) === true ) {

			global $post;

			$args = array(
				'post_type' => 'm1t_news',
				'orderby'   => 'ID',
				'order'     => 'DESC',
				'posts_per_page' => $num_news,
				'no_found_rows' => true
				);
			$query = new WP_Query( $args );
		}

		if ( $query->posts ) :
		?>
		<h2><?php echo $instance['title']; ?></h2>	
		<ul>
			<?php  foreach ( $query->posts as $post ) : setup_postdata( $post ); ?>
				<li>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>	
					<?php if ( has_excerpt( get_the_ID() ) ) : ?>
						<?php the_excerpt(); ?>
					<?php endif; ?>
					<span class="tweet-time"><?php echo get_the_date( 'Y-m-d H:i:s' ); ?></span>
				</li>
			<?php endforeach; wp_reset_postdata(); $query = null; ?>
		</ul>
		<?php
		else : echo sprintf( '<div class="no-data">%s</div>', __( 'No news posts found', 'mustang' ) ); endif;
	}

	// Admin form.
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'mustang' );

		// Limit the news items
		$num_news = empty( $instance['num_news'] ) ? 3 : $instance['num_news'];

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'mustang' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Number:', 'mustang' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'num_news' ); ?>" name="<?php echo $this->get_field_name( 'num_news' ); ?>" type="text" value="<?php echo $num_news; ?>">
		</p>
		<?php
	}

	// Update.
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['num_news'] = ( ! empty( $new_instance['num_news'] ) ) ? strip_tags( $new_instance['num_news'] ) : '';

		return $instance;
	}

}

// Register Latest_News_Widget widget.
function register_latest_news_widget() {
    register_widget( 'Latest_News_Widget' );
}
add_action( 'widgets_init', 'register_latest_news_widget' );