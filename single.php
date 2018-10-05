<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Pocket
 * @since Pocket 1.0
 */

get_header(); ?>

	<div id="content">
		<div class="posts">
			<!-- grab the posts -->
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<!-- uses the post format -->
				<?php
				if ( 'quote' == get_post_format() ) {
					get_template_part( 'format', 'quote' );
				} else {
					get_template_part( 'format', 'standard' );
				};
				?>

			<?php endwhile; ?>
			<?php endif; ?>
		</div><!-- posts -->

		<!-- comments -->
		<?php if ( comments_open() || '0' != get_comments_number() ) { ?>
			<div id="comment-jump" class="comments">
				<?php comments_template(); ?>
			</div>
		<?php } ?>
	</div><!-- content -->

	<!-- footer -->
<?php get_footer(); ?>