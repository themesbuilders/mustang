<?php

// Main widgets
$widgets = array(
	'inc/widgets/intro-widget.php',
	'inc/widgets/services-widget.php',
	'inc/widgets/stats-widget.php',
	'inc/widgets/latest-single-post-widget.php',
	'inc/widgets/whoweare-widget.php',
	'inc/widgets/latest-news-widget.php',
);

// Make available for the child themes/plugins
$widgets = apply_filters( 'mustang_widgets', $widgets );

// Load the files.
foreach ( $widgets as $index )
	locate_template( $index, true );
