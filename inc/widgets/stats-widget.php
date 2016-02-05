<?php

// Adds Stats_Widget widget.
class Stats_Widget extends WP_Widget {

	// Register widget with WordPress.
	function __construct() {
		parent::__construct(
			// Base ID
			'stats_widget',
			// Name
			__( 'Statistics Widget', 'mustang' ),
			// Args
			array( 'description' => __( 'Company statistics widget.', 'mustang' ), )
		);
	}

	// Front-end display of widget.
	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		// Get the counters.
		$counters = array();

		// Get the field values.
		for( $x = 1; $x <= 4; $x++ ) {
			$counters["counter_{$x}"] = array(
				"label_{$x}" => $instance["label_{$x}"],
				"value_{$x}" => $instance["value_{$x}"],
				"fa_icon_{$x}" => $instance["fa_icon_{$x}"],
			);
		}

		?>
		<section id="statistics">
			<div class="container">
				<div class="row">
					<?php $l = 1; $plus = false; foreach ( $counters as $counter ) : ?>
						<div class="col-md-3 col-sm-3">
							<div class="stat-item">
								<span class="stat-icon"><i class="fa <?php echo $counter['fa_icon_' . $l]; ?>"></i></span>

								<?php
									// Remove white spaces.
									$value = trim( $instance["value_{$l}"] );

									// If contains the '+'
									if ( strpos( $value, '+' ) ) {
										$plus = true;
										$value = intval( rtrim( $value, '+' ) );	
									} else { $plus = false; }
								?>

								<div id="clients"><span class="counter"><?php echo $value; ?></span><?php echo ( $plus ) ? '+' : '' ?></div>
								<span class="stat-title"><?php echo _e( $counter['label_' . $l], 'mustang' ); ?></span>
							</div>
						</div>
					<?php $l++; endforeach; ?>
				</div>
			</div>
		</section><!-- end of statistics -->
		<?php
		echo $args['after_widget'];
	}

	// Back-end widget form.
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';

		for( $x = 1; $x <= 4; $x++ ) {
			$labels["label_{$x}"] = empty( $instance["label_{$x}"] ) ? '' : $instance["label_{$x}"];
			$values["value_{$x}"] = empty( $instance["value_{$x}"] ) ? '0' : $instance["value_{$x}"];
			$fa_icons["fa_icon_{$x}"] = empty( $instance["fa_icon_{$x}"] ) ? '' : $instance["fa_icon_{$x}"];
		}

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'mustang' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<?php for ( $x = 1; $x <= 4; $x++ ) : ?>
			<p>
				<label for="<?php echo $this->get_field_id( 'counter_' . $x ); ?>"><?php _e( "Counter {$x}:", 'mustang' ); ?></label> 
				<input style="margin-bottom: 2px;" class="widefat" id="<?php echo $this->get_field_id( "label_$x" ); ?>" placeholder="<?php _e( "Label", 'mustang' ); ?>" name="<?php echo $this->get_field_name( "label_$x" ); ?>" type="text" value="<?php echo $labels["label_{$x}"]; ?>">
				<input style="margin-bottom: 2px;" class="widefat" id="<?php echo $this->get_field_id( "value_$x" ); ?>" placeholder="<?php _e( "Value", 'mustang' ); ?>" name="<?php echo $this->get_field_name( "value_$x" ); ?>" type="text" value="<?php echo $values["value_{$x}"]; ?>">
				<input class="widefat" id="<?php echo $this->get_field_id( "fa_icon_$x" ); ?>" placeholder="<?php _e( "Font-awesome class, Ex. fa-user", 'mustang' ); ?>" name="<?php echo $this->get_field_name( "fa_icon_$x" ); ?>" type="text" value="<?php echo $fa_icons["fa_icon_{$x}"]; ?>">
			</p>
		<?php endfor; ?>

		<?php 
	}

	// Sanitize widget form values as they are saved.
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		for( $x = 1; $x <= 4; $x++ ) {


			$instance["label_{$x}"] = empty( $new_instance["label_{$x}"] ) ? '' : $new_instance["label_{$x}"];
			$instance["value_{$x}"] = empty( $new_instance["value_{$x}"] ) ? '' : $new_instance["value_{$x}"];
			$instance["fa_icon_{$x}"] = empty( $new_instance["fa_icon_{$x}"] ) ? '' : $new_instance["fa_icon_{$x}"];
		}

		return $instance;
	}

}

// Register Stats_Widget widget
function register_stats_widget() {
    register_widget( 'Stats_Widget' );
}
add_action( 'widgets_init', 'register_stats_widget' );