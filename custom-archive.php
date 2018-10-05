<?php
/**
 * Template Name: Custom Archive
 *
 * Page template with various categorized archive posts.
 *
 * @package Pocket
 * @since Pocket 1.0
 */

get_header(); ?>

		<div id="content">
			<div class="posts">

				<!-- grab the posts -->
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<article <?php post_class( 'post animated fadeIn' ); ?>>

					<!-- grab the featured image -->
					<?php if ( '' != get_the_post_thumbnail() ) { ?>
						<a class="featured-image" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'large-image' ); ?></a>
					<?php } ?>

					<div class="box-wrap">
						<div class="box">
							<header class="post-header">
								<div class="date-title"><?php echo get_the_date(); ?></div>

								<?php if( is_single() || is_page() ) { ?>
									<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
								<?php } else { ?>
									<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								<?php } ?>
							</header>

							<!-- post content -->
							<div class="post-content">
								<?php the_content(); ?>

								<div id="archive">
									<div class="archive-col">
										<div class="archive-box">
											<h4><?php _e( 'Latest Posts', 'pocket' ); ?></h4>
											<ul>
												<?php wp_get_archives( 'type=postbypost&limit=20' ); ?>
											</ul>
										</div>

										<div class="archive-box">
											<h4><?php _e( 'Archive By Day', 'pocket' ); ?></h4>
											<ul>
												<?php wp_get_archives( 'type=daily&limit=15' ); ?>
											</ul>
										</div>

										<div class="archive-box">
											<h4><?php _e( 'Archive By Month', 'pocket' ); ?></h4>
											<ul>
												<?php wp_get_archives( 'type=monthly&limit=12' ); ?>
											</ul>
										</div>

										<div class="archive-box">
											<h4><?php _e( 'Contributors', 'pocket' ); ?></h4>
											<ul>
												<?php wp_list_authors( 'show_fullname=1&optioncount=1&orderby=post_count&order=DESC' ); ?>
											</ul>
										</div>

										<div class="archive-box">
											<h4><?php _e( 'Pages', 'pocket' ); ?></h4>
											<ul>
												<?php wp_list_pages( 'sort_column=menu_order&title_li=' ); ?>
											</ul>
										</div>

										<div class="archive-box">
											<h4><?php _e( 'Categories', 'pocket' ); ?></h4>
											<ul>
												<?php wp_list_categories( 'orderby=name&title_li=' ); ?>
											</ul>
										</div>
									</div><!-- column -->
								</div><!-- archive -->
							</div><!-- post content -->
						</div><!-- box -->
					</div><!-- box wrap -->
				</article><!-- post-->

				<?php endwhile; ?>
				<?php endif; ?>
			</div>

			<!-- post navigation -->
			<?php pocket_page_nav(); ?>

		</div><!-- content -->

		<!-- footer -->
		<?php get_footer(); ?>