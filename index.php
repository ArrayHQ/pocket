<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pocket
 * @since Pocket 1.0
 */

get_header(); ?>

	<div id="content">
		<div class="posts">
			<!-- titles -->
			<?php if ( is_search() ) { ?>
				<h2 class="archive-title">
					<?php
						global $wp_query;
						printf( __( '%d <span>results for</span> "%s"', 'pocket' ), $wp_query->found_posts, get_search_query( true ) );
					?>
				</h2>
			<?php } else if ( is_tag() ) { ?>
				<h2 class="archive-title"><span><?php _e( 'Tag /', 'pocket' ); ?></span> <?php single_tag_title(); ?></h2>
			<?php } else if ( is_day() ) { ?>
				<h2 class="archive-title">
					<span><?php _e( 'Archive /', 'pocket' ); ?></span> <?php echo get_the_date(); ?></h2>
			<?php } else if ( is_month() ) { ?>
				<h2 class="archive-title"><span><?php _e( 'Month /', 'pocket' ); ?></span> <?php echo get_the_date( 'F Y' ); ?></h2>
			<?php } else if ( is_year() ) { ?>
				<h2 class="archive-title"><span><?php _e( 'Year /', 'pocket' ); ?></span> <?php echo get_the_date( 'Y' ); ?></h2>
			<?php } else if ( is_category() ) { ?>
				<h2 class="archive-title"><span><?php _e( 'Category /', 'pocket' ); ?></span> <?php single_cat_title(); ?></h2>
			<?php } else if ( is_author() ) { ?>
				<h2 class="archive-title"><span><?php _e( 'Author /', 'pocket' ); ?></span>
					<?php
						the_post();
						printf( get_the_author() );
					?>
				</h2>
			<?php } ?>

			<div id="post-block">
				<!-- grab the posts -->
				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

					<!-- uses the post format -->
					<?php
					if ( 'quote' == get_post_format() ) {
						get_template_part( 'format', 'quote' );
					} else {
						get_template_part( 'format', 'standard' );
					};
					?>

				<?php endwhile; ?>

				<?php else : ?>

					<article class="post animated fadeIn nothing-found">
						<div class="box-wrap">
							<div class="box">
								<header class="post-header">
									<h1 class="entry-title"><?php _e( 'Nothing found', 'pocket' ); ?></h1>
								</header>

								<!-- post content -->
								<div class="post-content">
									<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

										<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'pocket' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

									<?php elseif ( is_search() ) : ?>

										<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'pocket' ); ?></p>
										<?php get_search_form(); ?>

									<?php else : ?>

										<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'pocket' ); ?></p>
										<?php get_search_form(); ?>

									<?php endif; ?>
								</div><!-- post content -->
							</div><!-- box -->
						</div><!-- box wrap -->
					</article><!-- post-->

				<?php endif; ?>
			</div><!-- post block -->
		</div><!-- posts -->

		<!-- post navigation -->
		<?php pocket_page_nav(); ?>

	</div><!-- content -->

	<!-- footer -->
<?php get_footer(); ?>