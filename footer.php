<?php
/**
 * Template for displaying the footer.
 *
 * @package Pocket
 * @since 1.0
 */
?>
			</div><!-- main -->
		</div><!-- wrapper -->

		<footer id="footer">
			<div id="footer-inside">
				<!-- footer widgets -->
				<?php if ( is_active_sidebar( 'footer-left' ) || is_active_sidebar( 'footer-center' ) || is_active_sidebar( 'footer-right' ) ) { ?>
					<div class="footer-widgets">
						<?php if ( is_active_sidebar( 'footer-left' ) ) { ?>
							<div class="footer-column">
								<?php dynamic_sidebar( 'footer-left' ); ?>
							</div>
						<?php } ?>

						<?php if ( is_active_sidebar( 'footer-center' ) ) { ?>
							<div class="footer-column">
								<?php dynamic_sidebar( 'footer-center' ); ?>
							</div>
						<?php } ?>

						<?php if ( is_active_sidebar( 'footer-right' ) ) { ?>
							<div class="footer-column">
								<?php dynamic_sidebar( 'footer-right' ); ?>
							</div>
						<?php } ?>
					</div><!-- footer widgets -->
				<?php } ?>

				<div class="footer-copy">
					<?php if( pocket_is_wpcom() ) : ?>
						<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'pocket' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'pocket' ), 'WordPress' ); ?></a>
						<span class="sep"> | </span>
						<?php printf( __( 'Theme: %1$s by %2$s.', 'pocket' ), 'Pocket', '<a href="https://array.is/" rel="designer">Array</a>' ); ?>
					<?php else : ?>
						<?php echo pocket_filter_footer_text(); ?>
					<?php endif; ?>

					<?php if ( has_nav_menu( 'footer' ) ) { ?>
						<div class="footer-menu">
							<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'footer-nav', 'depth' => 1 ) ); ?>
						</div>
					<?php } ?>
				</div>
			</div><!-- footer inside -->
		</footer><!-- footer -->

	</div><!-- container -->
	<?php wp_footer(); ?>
</body>
</html>
