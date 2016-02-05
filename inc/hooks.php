<?php

/**
 * Footer hooks.
 *
 * @see  mustang_footer_about()
 * @see  mustang_latest_tweets()
 * @see  mustang_contact_info()
 * @see  mustang_social_links()
 */
add_action( 'mustang-footer', 'mustang_footer_about', 10 );
add_action( 'mustang-footer', 'mustang_latest_tweets', 20 );
add_action( 'mustang-footer', 'mustang_contact_info', 30 );
add_action( 'mustang-footer', 'mustang_social_links', 40 );

/**
 * Bottom footer hooks.
 *
 * @see  mustang_custom_copyright()
 * @see  mustang_footer_menu()
 */
add_action( 'mustang-btm-footer', 'mustang_custom_copyright', 10 );
add_action( 'mustang-btm-footer', 'mustang_footer_menu', 20 );
