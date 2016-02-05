<?php

/**
* Adds Services_Widget widget.
*/

class Services_Widget extends WP_Widget {

	// Register
	function __construct() {
		parent::__construct(
			// Base ID
			'services_widget',
			// Name
			__( 'Services Widet', 'mustang' ),
			// Args
			array( 'description' => __( 'Get the three blocks of services on the home page.', 'mustang' ), )
		);
	}

	// Frontend display.
	public function widget( $args, $instance ) {
		get_template_part( 'template-parts/hp/content', 'services' );
	}

	// Backend widget form.
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Section heading', 'mustang' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'mustang' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	// Update the form values.
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

}

// Register Services_Widget widget
function register_services_widget() {
    register_widget( 'Services_Widget' );
}
add_action( 'widgets_init', 'register_services_widget' );