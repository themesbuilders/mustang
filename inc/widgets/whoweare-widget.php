<?php

// Adds a test woidget.
class Who_We_Are_Widget extends WP_Widget {

	public $bars = array();
	public $num_bars = 4;

	// Register with WP.
	function __construct() {
		parent::__construct(
			/* ID. */
			'who_we_are_widget',

			/* Widget title. */
			__( 'Who We Are', 'mustang' ),

			/* Args. */
			array( 
				'description' => __( 'This is a test widget to show how to handle loop.', 'mustang' ),
			)
		);
		$this->set_bars();
	}

	// Sets the bars fields.
	public function set_bars() {
	}

	// Frontend display.
	public function widget( $args, $instance ) {

		$data = array();

		// Tweak.
		for ( $l = 1; $l <= $this->num_bars; $l++ ) {
			if ( array_key_exists( "pr_bar_{$l}_dw", $instance ) 
				|| array_key_exists( "pr_bar_{$l}_dt", $instance ) ) {
				$data[$l] = array(
					'data_lbl' => $instance["pr_bar_{$l}_lbl"],
					'data_dw' => $instance["pr_bar_{$l}_dw"],
					'data_dt' => $instance["pr_bar_{$l}_dt"]
				);
			}
		}

		?>
		<section id="about" class="top-line">
			<div class="container">
				<div class="row">
					<div class="col-md-5">
						<div class="about-content">
							<h2 class="medium-heading">
								<?php if ( ! empty( $instance['title'] ) ) {
									echo apply_filters( 'widget_title', $instance['title'] );
								} ?>
							</h2>
							<?php echo  wpautop( $instance['paragraph'] ); ?>
						</div>
					</div>
					<div class="col-md-6">
						<ul class='skills'>

							<?php foreach ( $data as $d ) : if ( $d['data_dt'] && $d['data_dw'] ) : ?>
								<li class='progressbar1' data-width='<?php echo $d['data_dw']; ?>' data-target='<?php echo $d['data_dt'] ?>'><?php echo $d['data_lbl']; ?></li>
							<?php endif; endforeach; ?>

						</ul>
					</div>
				</div>
			</div>
		</section><!-- end of about -->
		<?php
	}

	// Admin form.
	public function form( $instance ) {

		$data = array();
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'mustang' );
		$paragraph = ! empty( $instance['paragraph'] ) ? $instance['paragraph'] : __( 'Your paragraph', 'mustang' );

		// Tweak.
		for ( $l = 1; $l <= $this->num_bars; $l++ ) {
			if ( array_key_exists( "pr_bar_{$l}_dw", $instance ) 
				|| array_key_exists( "pr_bar_{$l}_dt", $instance ) ) {
				$data[$l] = array(
					'data_title' => empty( $instance["pr_bar_{$l}_lbl"] ) ? '' : $instance["pr_bar_{$l}_lbl"],
					'data_dw' => empty( $instance["pr_bar_{$l}_dw"] ) ? 0 : $instance["pr_bar_{$l}_dw"],
					'data_dt' => empty( $instance["pr_bar_{$l}_dt"] ) ? 0 : $instance["pr_bar_{$l}_dt"],
				);
			}
		}

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input style="margin-bottom: 3px;" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<?php for ( $l = 1; $l <= $this->num_bars; $l++ ) : ?>
			<p>
				<label for=""><?php _e( "Bar {$l}:", 'mustang' ); ?></label>
				<input style="margin-bottom: 3px;" class="widefat" id="<?php echo $this->get_field_id( "pr_bar_{$l}_lbl" ); ?>" name="<?php echo $this->get_field_name( "pr_bar_{$l}_lbl" ); ?>" type="text" value="<?php echo $data[$l]['data_title']; ?>" placeholder="<?php _e( 'Bar label', 'mustang' ); ?>">
				<input style="margin-bottom: 3px;" class="widefat" id="<?php echo $this->get_field_id( "pr_bar_{$l}_dw" ); ?>" name="<?php echo $this->get_field_name( "pr_bar_{$l}_dw" ); ?>" type="number" value="<?php echo $data[$l]['data_dw']; ?>" placeholder="<?php _e( 'Bar data width', 'mustang' ); ?>">
				<input style="margin-bottom: 3px;" class="widefat" id="<?php echo $this->get_field_id( "pr_bar_{$l}_dt" ); ?>" name="<?php echo $this->get_field_name( "pr_bar_{$l}_dt" ); ?>" type="number" value="<?php echo $data[$l]['data_dt']; ?>" placeholder="<?php _e( 'Bar data target', 'mustang' ); ?>">
			</p>
		<?php endfor; ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'paragraph' ); ?>"><?php _e( 'Paragraph:', 'mustang' ); ?></label> 
			<textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('paragraph'); ?>" name="<?php echo $this->get_field_name('paragraph'); ?>"><?php echo esc_textarea( $instance['paragraph'] ); ?></textarea>
		</p>

		<?php
	}

	// Update.
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['paragraph'] = ( ! empty( $new_instance['paragraph'] ) ) ? $new_instance['paragraph'] : '';

		// Update each values.
		for ( $l = 1; $l <= $this->num_bars; $l++ ) {
			$instance["pr_bar_{$l}_lbl"] = empty( $new_instance["pr_bar_{$l}_lbl"] ) ? '' : $new_instance["pr_bar_{$l}_lbl"];
			$instance["pr_bar_{$l}_dw"] = empty( $new_instance["pr_bar_{$l}_dw"] ) ? 0 : $new_instance["pr_bar_{$l}_dw"];
			$instance["pr_bar_{$l}_dt"] = empty( $new_instance["pr_bar_{$l}_dt"] ) ? 0 : $new_instance["pr_bar_{$l}_dt"];
		}

		return $instance;
	}

}

// Register Who_We_Are_Widget widget.
function register_who_we_are_widget() {
    register_widget( 'Who_We_Are_Widget' );
}
add_action( 'widgets_init', 'register_who_we_are_widget' );
