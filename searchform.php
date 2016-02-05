
<form method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<input type="search" class="search-field search-box" value="<?php echo get_search_query() ?>" name="s" id="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder' ) ?>">
</form>
