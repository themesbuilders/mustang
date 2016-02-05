
<?php
$intro_heading = rwmb_meta( 'mustang_intro_heading', array(), get_the_ID() );
$intro_text = rwmb_meta( 'mustang_intro_text', array(), get_the_ID() );
?>
<section id="introduction">
	<div class="container">
		<?php if ( ! empty( $intro_heading ) ) : ?>
		<h2><?php echo $intro_heading; ?></h2>
		<?php endif; if ( ! empty( $intro_text ) ) : echo wpautop( $intro_text ); endif; ?>
	</div>
</section><!-- end of introduction -->
