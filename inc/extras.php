<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Mustang
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function mustang_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'mustang_body_classes' );

// Make your custom sizes selectable from your WordPress admin.
add_filter( 'image_size_names_choose', 'my_custom_sizes' );
function my_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'mustang-banner' => __( 'Mustang Banner', 'mustang' ),
    ) );
}

// Custom thumbnail column for custom post types.
// Get featured image
function mt_get_featured_image( $post_ID ) {
	$post_thumbnail_id = get_post_thumbnail_id( $post_ID );
	if ( $post_thumbnail_id ) {
		$post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'mustang-post-thumb' );
		return $post_thumbnail_img[0];
	}
}

// Add new column
function mt_columns_head( $defaults ) {
	$defaults['xy-post-thumb'] = 'Post Thumbnail';
	return $defaults;
}

// Show the featured image
function mt_columns_content( $column_name, $post_ID ) {
	if ( $column_name == 'xy-post-thumb' ) {
		$post_featured_image = mt_get_featured_image($post_ID);
		if ( $post_featured_image ) {
			echo '<img src="' . $post_featured_image . '" />';
		} else {
			echo __( '-', 'xyoga' );
		}
	}
}

/*
// Deregister matching post types.
function custom_unregister_theme_post_types() {
    global $wp_post_types;
    foreach( array( 'banner' ) as $post_type ) {
        if ( isset( $wp_post_types[ $post_type ] ) ) {
            unset( $wp_post_types[ $post_type ] );
        }
    }
}

//  Delete all the posts of custom post type.
function delete_mt_posts( $args = array(), $force_delete = false ) {
	if ( ! empty( $args ) ) {
		// Get the posts.
		$posts = get_posts( $args );

		// Delete each post.
		foreach ( $posts as $post ) {
			wp_delete_post( $post->ID, $force_delete );
		}
	}
}
*/
