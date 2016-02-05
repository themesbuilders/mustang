<?php
/**
 * The header for our theme.
 *
 * @package Mustang
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<style type="text/css">
	.no-data { min-height: 100px; text-align: center; margin: 100px auto; }
</style>

<?php wp_head(); ?>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>
<body <?php body_class(); ?>>

	<div id="wrapper">
		<header id="header">
			<div class="container clearfix">

				<?php if ( $custom_logo = get_theme_mod( 'custom_logo' ) ) : ?>
					<?php
						$image = wp_get_attachment_image_src( $custom_logo );
					?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="Logo" /></a>
				<?php else: ?>
					<h1 id="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php endif; ?>

				<nav id="main-menu" class="navbar">
					<div class="container-fluid">

						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only"><?php esc_html_e( 'Toggle Navigation', 'mustang' ); ?></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

							<?php

							if ( has_nav_menu( 'primary' ) ) :
							wp_nav_menu( array(
								'theme_location'  => 'primary',
								'sort_column'		=> 'menu_order',
								'menu'            => '',
								'container'       => '',
								'container_class' => '',
								'container_id'    => '',
								'menu_class'      => 'nav navbar-nav',
								'menu_id'         => 'primary',
								'echo'            => true,
								'fallback_cb'     => false,
								'before'          => '',
								'after'           => '',
								'link_before'     => '',
								'link_after'      => '',
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth'           => 3,
								'walker'          => new Mustang_walker_nav_menu(),
							) );
							else : echo __( "No primary menu assigned.", 'mustang' );
							endif;

							?>

							<div class="search">
								<a id="formTigger" href="#"><i class="fa fa-search"></i></a>
								<div id="searchForm">
									<?php get_search_form(); ?>
								</div>
							</div>

						</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</nav>
			</div>
		</header><!-- end of header -->
