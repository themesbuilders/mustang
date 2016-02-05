<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Mustang
 */

if ( ! function_exists( 'mustang_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function mustang_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'mustang' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'mustang' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'mustang_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function mustang_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'mustang' ) );
		if ( $categories_list && mustang_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'mustang' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'mustang' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'mustang' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'mustang' ), esc_html__( '1 Comment', 'mustang' ), esc_html__( '% Comments', 'mustang' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'mustang' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function mustang_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'mustang_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'mustang_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so mustang_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so mustang_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in mustang_categorized_blog.
 */
function mustang_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'mustang_categories' );
}
add_action( 'edit_category', 'mustang_category_transient_flusher' );
add_action( 'save_post',     'mustang_category_transient_flusher' );

// Member social profile links.
if ( ! function_exists( 'member_social_links' ) ) {
	function member_social_links() {

		// Socials.
		$socials = array(
			'facebook' => __( 'Facebook', 'mustang' ),
			'twitter' => __( 'Twitter', 'mustang' ),
			'google' => __( 'Google +', 'mustang' ),
		);

		foreach ( $socials as $key => $value ) {

			$social_url = rwmb_meta( "mustang_member_{$key}", array() );

			if ( ! empty( $social_url ) ) {
				echo sprintf( 
					'<a href="%s" title="%s" class="%s-icon"><i class="fa fa-%s"></i></a>',
					$social_url,
					$value,
					$key,
					$key
				);
			}
		}
		
	}
}

// Newsletter.
if ( ! function_exists( 'mustang_footer_about' ) ) {
	function mustang_footer_about() {
		?>
		<div class="col-md-3 col-sm-3">
			<div class="newsletter">
				<?php if ( is_active_sidebar( 'sidebar-footer-col1' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-footer-col1' ); ?>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}

// Latest tweets.
if ( ! function_exists( 'mustang_latest_tweets' ) ) {
	function mustang_latest_tweets() {
		?>
		<div class="col-md-3 col-sm-3">
			<div class="tweets">
				<!-- <h2>Latest Tweets</h2>
				<ul>
					<li>
						<p>
							<i class="fa fa-twitter"></i>
							If you have any suggestions for the next updates, let us know.
						</p>
						<span class="tweet-time">08:05 AM Nov 15th</span>
					</li>
					<li>
						<p>
							<i class="fa fa-twitter"></i>
							If you have any suggestions for the next updates, let us know.
						</p>
						<span class="tweet-time">08:05 AM Nov 15th</span>
					</li>
				</ul> -->
				<?php if ( is_active_sidebar( 'sidebar-footer-col2' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-footer-col2' ); ?>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}

// Contact.
if ( ! function_exists( 'mustang_contact_info' ) ) {
	function mustang_contact_info() {
		?>
		<div class="col-md-3 col-sm-3">
			<div class="contact">
				<?php if ( $contact_heading = get_theme_mod( 'contact_heading' ) ) : ?>
					<h2><?php echo ( $contact_heading ) ? $contact_heading : __( 'Contact Us', 'mustang' ); ?></h2>
				<?php endif; ?>
				<ul class="contacts-info">

					<?php if ( $address = get_theme_mod( 'contact_address' ) ) : ?>
						<li>
							<i class="fa fa-map-marker"></i>
							<?php echo sprintf( 
								'<strong>%s:</strong> <span class="link">%s</span>',
								__( 'Address', 'mustang' ),
								$address ); ?>
						</li>
					<?php endif; if ( $phone = get_theme_mod( 'contact_phone' ) ) : ?>
						<li>
							<i class="fa fa-phone"></i>
							<?php echo sprintf( 
								'<strong>%s:</strong> <span class="link">%s</span>',
								__( 'Phone', 'mustang' ),
								$phone ); ?>
						</li>
					<?php endif; if ( $email = get_theme_mod( 'contact_email' ) ) : ?>
						<li>
							<i class="fa fa-envelope"></i>
							<?php echo sprintf( 
								'<strong>%s:</strong> <span class="link">%s</span>',
								__( 'Email', 'mustang' ),
								$email ); ?>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
		<?php
	}
}

// Footer social links.
if ( ! function_exists( 'mustang_social_links' ) ) {
	function mustang_social_links() {

		// Array.
		$socials = array(
			'facebook' => array(
				'slug' => 'facebook',
				'url' => get_theme_mod( 'fb_link' ),
				'title' => __( 'Facebook', 'mustang' ),
			),
			'twitter' => array(
				'slug' => 'twitter',
				'url' => get_theme_mod( 'tw_link' ),
				'title' => __( 'Twitter', 'mustang' ),
			),
			'google' => array(
				'slug' => 'google',
				'url' => get_theme_mod( 'gp_link' ),
				'title' => __( 'Google +', 'mustang' ),
			),
		);

		?>
		<div class="col-md-3 col-sm-3">
			<div class="follow">
				<?php if ( $social_heading = get_theme_mod( 'social_heading' ) ) : ?>
					<h2><?php echo $social_heading; ?></h2>
				<?php endif; ?>
				<div class="social-links">
				<?php foreach ( $socials as $social ) : if ( ! empty( $social['url'] ) ) : ?>
					<a href="<?php echo $social['url']; ?>" target="_blank" title="<?php echo $social['title']; ?>" class="<?php echo $social['slug']; ?>-icon"><i class="fa fa-<?php echo $social['slug']; ?>"></i></a>
				<?php endif; endforeach; ?>
				</div>
			</div>
		</div>
		<?php
	}
}

// Custom copyright.
if ( ! function_exists( 'mustang_custom_copyright' ) ) {
	function mustang_custom_copyright() {

		$custom_copyright = get_theme_mod( 'custom_copyright' );

		?>
		<div class="col-md-6 col-sm-6">
			<div class="footer-text">
				<?php echo empty( $custom_copyright ) ? __( '&copy; All rights reserved.', 'mustang' ) : $custom_copyright; ?>
			</div>
		</div>
		<?php
	}
}

// Footer menu links.
if ( ! function_exists( 'mustang_footer_menu' ) ) {
	function mustang_footer_menu() {
		?>
		<div class="col-md-6 col-sm-6">

			<?php

			if ( has_nav_menu( 'secondary' ) ) :
				wp_nav_menu( array(
					'theme_location'  => 'secondary',
					'sort_column'		=> 'menu_order',
					'menu_class'      => 'footer-menu',
					'menu_id'         => 'secondary',
					'echo'            => true,
					'fallback_cb'     => false,
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 3,
					'walker'          => '',
				) );
			else : echo __( "No secondary menu assigned.", 'mustang' );
			endif;

			?>

		</div>
		<?php
	}
}
