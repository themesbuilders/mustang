
<?php get_header(); ?>

<div id="mini-header">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="miniheader-nonsticky news">
					<h1 class="page-title"><?php printf( __( 'Search results for: %s', 'gsa' ), get_search_query() ); ?></h1>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="content">
	<div class="container">
		<div class="content-inner clearfix">
			<div class="news-page">
				<?php if ( have_posts() ) : ?>
					<div class="row">
						<ul class="list-unstyled clearfix">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'template-parts/content', 'search' ); ?>
							<?php endwhile; ?>
						</ul>
					</div>
				<?php else : ?>
					<?php get_template_part( 'template-parts/content', 'none' ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
