<?php
/**
 * Template for quote posts.
 *
 * @package Pocket
 * @since Pocket 1.0
 */
?>

					<article <?php post_class( 'post animated fadeIn' ); ?>>
						<!-- Quote Post Format -->
						<div class="box-wrap">
							<div class="box">
								<div class="format-quote">
									<?php if( is_single() ) { ?>
										<?php the_content(); ?>
									<?php } else { ?>
										<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'pocket' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_content(); ?></a>
									<?php } ?>
								</div>
							</div><!-- box -->
						</div><!-- box wrap -->
					</article><!-- post -->

					<?php if( is_single() ) { ?>
						<div class="quote-meta">
							<ul class="meta">
								<li><i class="fa fa-pencil"></i> <?php the_author_posts_link(); ?></li>
								<li><i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?></li>
								<li><i class="fa fa-list-ul"></i> <?php the_category( ', ' ); ?></li>
								<?php if ( get_the_tags() ) { ?>
									<li><i class="fa fa-tag"></i> <?php the_tags( '', ', ', '' ); ?></li>
								<?php } ?>

								<br/>
								<li class="prev-mobile next-prev-mobile"><?php previous_post_link( '%link', '<i class="fa fa-arrow-left"></i>' . __( 'Previous Post', 'pocket' ) ); ?></li>
								<li class="next-prev-mobile"><?php next_post_link( '%link', '<i class="fa fa-arrow-right"></i>' . __( 'Next Post', 'pocket' ) ); ?></li>
							</ul>
						</div>
					<?php } ?>