<?php

// Adds a test woidget.
class Test_Widget extends WP_Widget {

	public $bars = array();

	// Register with WP.
	function __construct() {
		parent::__construct(
			/* ID. */
			'test_widget',

			/* Widget title. */
			__( 'Test Widget', 'mustang' ),

			/* Args. */
			array( 
				'description' => __( 'This is a test widget to show how to handle loop.', 'mustang' ),
			)
		);
		$this->set_bars();
	}

	// Sets the bars fields.
	public function set_bars() {
		$this->bars = array(
			'bar_f1' => array(
				'title' => __( 'Bar f1', 'mustang' ),
				'dw_slug' => 'bar_f1_dw',
				'dt_slug' => 'bar_f1_dt',
			),
			'bar_f2' => array(
				'title' => __( 'Bar f2', 'mustang' ),
				'dw_slug' => 'bar_f2_dw',
				'dt_slug' => 'bar_f2_dt',
			),
		);
	}

	// Frontend display.
	public function widget( $args, $instance ) {

		var_dump( $instance );

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		echo __( 'Hello, World!', 'mustang' );
		echo $args['after_widget'];
	}

	// Admin form.
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'mustang' );

		foreach ( $this->bars as $slug => $fields ) {
			$values[$slug] = array(
				$fields['dw_slug'] => empty( $instance[$fields['dw_slug']] ) ? 0 : $instance[$fields['dw_slug']],
				$fields['dt_slug'] => empty( $instance[$fields['dt_slug']] ) ? 0 : $instance[$fields['dt_slug']],
			);
		}

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input style="margin-bottom: 3px;" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<?php foreach ( $this->bars as $slug => $fields ) : ?>
			<p>
				<label for="<?php echo $this->get_field_id( $slug ); ?>"><?php echo $fields['title']; ?></label> 
				<input style="margin-bottom: 2px;" class="widefat" id="<?php echo $this->get_field_id( $fields['dw_slug'] ); ?>" name="<?php echo $this->get_field_name( $fields['dw_slug'] ); ?>" type="number" value="<?php echo $values[$slug][$fields['dw_slug']]; ?>">
				<input class="widefat" id="<?php echo $this->get_field_id( $fields['dt_slug'] ); ?>" name="<?php echo $this->get_field_name( $fields['dt_slug'] ); ?>" type="number" value="<?php echo $values[$slug][$fields['dt_slug']]; ?>">
			</p>
		<?php endforeach; ?>

		<?php
	}

	// Update.
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		foreach ( $this->bars as $slug => $fields ) {
			$instance[$fields['dw_slug']] = empty( $new_instance[$fields['dw_slug']] ) ? 0 : $new_instance[$fields['dw_slug']];
			$instance[$fields['dt_slug']] = empty( $new_instance[$fields['dt_slug']] ) ? 0 : $new_instance[$fields['dt_slug']];
		}

		return $instance;
	}

}

// Register Test_Widget widget.
function register_test_widget() {
    register_widget( 'Test_Widget' );
}
add_action( 'widgets_init', 'register_test_widget' );