<?php
/**
 * The template for displaying the footer.
 *
 * @package Mustang
 */

?>
		<footer id="footer">
			<div class="container">
				<div class="row">
					<?php
					/**
					 * @hooked mustang_newsletter - 10
					 * @hooked mustang_latest_tweets - 20
					 * @hooked mustang_contact_info - 30
					 * @hooked mustang_social_links - 40
					 */
					do_action( 'mustang-footer' ); ?>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="container">
					<div class="row">
						<?php
						/**
						 * @hooked mustang_custom_copyright - 10
						 * @hooked mustang_footer_menu - 20
						 */
						do_action( 'mustang-btm-footer' ); ?>
					</div>
				</div>
			</div>
		</footer><!-- end of footer -->
	</div><!-- /#wrapper -->
	<?php wp_footer(); ?>
	
</body>
</html>
