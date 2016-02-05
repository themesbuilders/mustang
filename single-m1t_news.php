<?php get_header(); ?>

<?php

global $post;

if ( have_posts() ) : ?>

<div id="content">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="post-<?php the_ID(); ?>" <?php post_class( 'newsbox clearfix' ); ?>>

					<?php while ( have_posts() ) : the_post(); ?>
						<div class="news-content">
							<h3><?php the_title(); ?></h3>
							<?php if ( get_the_content() ) : ?>
								<?php the_content(); ?>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>

				</div>

			</div>                
		</div>
	</div>
</div>
<?php endif; ?>

<?php get_footer(); ?>
