<?php
/**
 * Template for standard posts.
 *
 * @package Pocket
 * @since Pocket 1.0
 */
?>

					<article <?php post_class( 'post animated fadeIn' ); ?>>
						<!-- grab the video -->
						<?php if ( ! pocket_is_wpcom() && get_post_meta( $post->ID, 'video', true ) ) { ?>
							<div class="fitvid">
								<?php echo get_post_meta( $post->ID, 'video', true ) ?>
							</div>

						<?php } else { ?>

							<!-- grab the featured image -->
							<?php if ( '' != get_the_post_thumbnail() ) { ?>
								<a class="featured-image <?php if ( get_option( 'pocket_customizer_bw_image' ) == 'enable' ) echo "grayscale"; ?>" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'large-image' ); ?></a>
							<?php } ?>

						<?php } ?>

						<div class="box-wrap">
							<div class="box">
								<header class="post-header">
									<div class="date-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_the_date(); ?></a></div>

									<?php if( is_single() || is_page() ) { ?>
										<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
									<?php } else { ?>
										<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
									<?php } ?>
								</header>

								<!-- post content -->
								<div class="post-content">
									<?php if( is_search() || is_archive() ) { ?>
										<div class="excerpt-more">
											<?php the_excerpt(); ?>
											<p><a class="more-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><span><?php _e( 'Continue Reading', 'pocket' ); ?></span></a></p>
										</div>
									<?php } else { ?>
										<?php the_content(); ?>

										<?php if( is_single() || is_page() ) { ?>
											<div class="pagelink">
												<?php wp_link_pages(); ?>
											</div>
										<?php } ?>

										<?php if( is_single() ) { ?>
											<ul class="meta">
												<?php edit_post_link( __( 'Edit Post', 'pocket' ), '<li><i class="fa fa-edit"></i>', '</li>' ); ?>
												<li><i class="fa fa-pencil"></i> <?php the_author_posts_link(); ?></li>
												<li><i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?></li>
												<?php if ( has_category() ) { ?>
													<li><i class="fa fa-list-ul"></i> <?php the_category( ', ' ); ?></li>
												<?php } ?>
												<?php if ( get_the_tags() ) { ?>
													<li><i class="fa fa-tag"></i> <?php the_tags( '', ', ', '' ); ?></li>
												<?php } ?>

												<li class="next-prev-mobile">&nbsp;</li>
												<li class="prev-mobile next-prev-mobile"><?php previous_post_link( '%link', '<i class="fa fa-arrow-left"></i>' . __( 'Previous Post', 'pocket' ) ); ?></li>
												<li class="next-prev-mobile"><?php next_post_link( '%link', '<i class="fa fa-arrow-right"></i>' . __( 'Next Post', 'pocket' ) ); ?></li>
											</ul>
										<?php } ?>
									<?php } ?>
								</div><!-- post content -->
							</div><!-- box -->
						</div><!-- box wrap -->
					</article><!-- post-->
