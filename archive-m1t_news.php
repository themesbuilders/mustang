<?php get_header();

global $post;

$args = array(
	'post_type' => 'm1t_news',
	'orderby'   => 'date',
	'order'     => 'DESC',
	'posts_per_page' => '-1',
	'no_found_rows' => true
);
$query = new WP_Query( $args );

?>

<div class="row">
	<div class="col-sm-12">
		<h2 class="page-title">News</h2>
	</div>
</div>

<?php if ( $query->posts ) : ?>
	<div class="row">
		<div class="col-sm-12">
			<?php foreach ( $query->posts as $post ) : setup_postdata( $post ); ?>
				<div class="newsbox clearfix">
					<div class="news-image">
						<!-- image -->
					</div>
					<div class="news-content">
						<h3><?php the_title(); ?></h3>
						<?php if ( get_the_excerpt() ) : ?>
							<?php the_excerpt(); ?>
						<?php else : echo 'No entry found'; endif; ?>
						<div class="readmore"><a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a></div>
					</div>
				</div>
			<?php endforeach; wp_reset_postdata(); $query = null; ?>
		</div>                
	</div>
<?php endif; ?>

<?php get_footer(); ?>
