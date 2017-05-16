<?php
/**
 * Template Name: Apartment page
 * The template for displaying Apartment template pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hemma
 */

get_header(); ?>

	<?php
	$page_id = get_the_ID();
	$page_subtitle = get_post_meta( $page_id, 'opendept_apartment_subtitle_subtitle', true );
	$filter_posts = get_post_meta( $page_id, 'opendept_filter_apartment_filter_category', true );
	$page_overlay_bg = get_post_meta( $page_id, 'opendept_hero_apartment_color', true );
	$page_titles_align = get_post_meta( $page_id, 'opendept_hero_apartment_align', true );
	$page_hero_height = get_post_meta( $page_id, 'opendept_hero_apartment_height', true );
	$page_hero_bg_color = get_post_meta( $page_id, 'opendept_hero_apartment_bg_color', true );
	$page_hero_mouse_icon = get_post_meta( $page_id, 'opendept_hero_apartment_mouse_icon', true );
	$page_image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'full' );
	$listed_posts_enable_subtitle = get_post_meta( $page_id, 'opendept_listed_posts_enable_subtitle', true );
	$listed_posts_enable_meta = get_post_meta( $page_id, 'opendept_listed_posts_enable_meta_info', true );
	$listed_posts_enable_button = get_post_meta( $page_id, 'opendept_listed_posts_enable_button', true );
	$listed_posts_button_text = get_post_meta( $page_id, 'opendept_listed_posts_button_text', true );
	$listed_posts_button_color = get_post_meta( $page_id, 'opendept_listed_posts_button_color', true );
	$listed_posts_strip_title_link = get_post_meta( $page_id, 'opendept_listed_posts_strip_title_link', true );
	$listed_posts_height = get_post_meta( $page_id, 'opendept_listed_posts_height', true );
	$posts_per_page = get_theme_mod( 'apartment_posts_per_page', 4 );
	?>

	<div id="hero" class="hero is-bg-image is-text-light <?php echo sanitize_html_class( $page_titles_align ); ?> <?php echo sanitize_html_class( $page_hero_height ); ?> <?php echo sanitize_html_class( $page_hero_bg_color ); ?>"<?php if ( $page_image_attributes ) echo ' style="background-image: url(' . esc_url( $page_image_attributes[0] ) . ');"' ?>>
		<div class="hero-content" style="background-color: <?php echo $page_overlay_bg; ?>">
			<div class="container is-fluid">
				<div class="hero-text">
					 <?php the_title( '<h1 class="hero-title">', '</h1>' ); ?>
					<div class="hero-subtitle"><?php echo esc_html( $page_subtitle ); ?></div>
					<?php
					while ( have_posts() ) : the_post();
						the_content();
					endwhile;
					?>
				</div><!-- /.hero-text -->
			</div><!-- /.container -->
			<?php
			if ( $page_hero_mouse_icon ) { ?>
			<div class="scroll-icon"></div>
			<?php } ?>
		</div><!-- /.hero-content -->
	</div><!-- /.hero -->

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
			<?php
			$args = array(
				'post_type' => 'apartment',
				'posts_per_page' => $posts_per_page,
				'paged' => ( $paged = get_query_var('paged') ) ? $paged : 1,
			);
			if( $filter_posts ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'apartmentcategory',
						'field' => 'slug',
						'terms' => $filter_posts
					)
				);
			}

			$the_query = new WP_Query( $args );

			while ( $the_query->have_posts() ) : $the_query->the_post();

				$the_id = get_the_ID();
				$subtitle = get_post_meta( $the_id, 'opendept_subtitle_subtitle', true );
				$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $the_id ), 'full' );
				$apartment_guests = get_post_meta( $the_id, 'opendept_apartment_guests', true );
				$apartment_beds = get_post_meta( $the_id, 'opendept_apartment_beds', true );
				$apartment_size = get_post_meta( $the_id, 'opendept_apartment_size', true );
				$summary_content = get_post_meta( $the_id, 'opendept_summary_content', true );
				?>

				<div id="post-<?php the_ID(); ?>" <?php post_class( 'block block-split' ); ?>>
					<div class="block-content<?php if( $listed_posts_height ) echo ' ' . sanitize_html_class( $listed_posts_height ); ?>">
						<div class="block-figure"<?php if ( $image_attributes ) echo 'style="background-image: url(' . esc_url( $image_attributes[0] ) . ');"' ?>>
						</div>
						<div class="container is-fluid">
							<div class="columns">
								<div class="column is-6-desktop">
									<div class="block-text">
										<?php
										if ( $listed_posts_strip_title_link ) :
											the_title( '<h2 class="block-title">', '</h2>' );
										else :
											the_title( '<h2 class="block-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
										endif;
										?>

										<?php if ( $subtitle && $listed_posts_enable_subtitle ) : ?>
											<div class="block-subtitle"><?php echo esc_html( $subtitle ); ?></div>
										<?php endif; ?>

										<?php if ( $listed_posts_enable_meta ) : ?>
											<div class="extras-meta">
												<div class="extras-meta-apartment">

													<?php if ( $apartment_guests ) : ?>

														<span class="extras-meta-block extras-meta-apartment-guests">
															<svg class="hemma-icon hemma-icon-guests"><use xlink:href="#hemma-icon-guests"></use></svg>
															<?php echo esc_html( $apartment_guests ); ?>
														</span>

													<?php endif; ?>
													
													<?php if ( $apartment_beds ) : ?>

														<span class="extras-meta-block extras-meta-apartment-beds">
															<svg class="hemma-icon hemma-icon-beds"><use xlink:href="#hemma-icon-beds"></use></svg>
															<?php echo esc_html( $apartment_beds ); ?>
														</span>

													<?php endif; ?>

													<?php if ( $apartment_size ) : ?>

														<span class="extras-meta-block extras-meta-apartment-size">
															<svg class="hemma-icon hemma-icon-size"><use xlink:href="#hemma-icon-size"></use></svg>
															<?php echo esc_html( $apartment_size ); ?>
														</span>

													<?php endif; ?>

												</div><!-- /.extras-meta-apartment -->
											</div><!-- /.extras-meta -->
										<?php endif; ?>

										<?php echo do_shortcode( wpautop( wp_kses_post( $summary_content ) ) ); ?>

										<?php if ( $listed_posts_enable_button ) : ?>
											<a href="<?php the_permalink(); ?>" class="button <?php echo sanitize_html_class( $listed_posts_button_color ); ?>"><?php echo esc_html( $listed_posts_button_text ); ?></a>
										<?php endif; ?>

									</div><!-- /.block-text -->
								</div><!-- /.column -->
							</div><!-- /.columns -->
						</div><!-- /.container -->
					</div><!-- /.block-content -->
				</div><!-- /.block -->

			<?php
			endwhile; ?>

			<?php if ( get_next_posts_link( false, $the_query->max_num_pages ) || get_previous_posts_link() ) : ?>
			
				<div class="nav-links">
					<div class="container is-fluid">
						<?php next_posts_link( esc_html__( 'Prev Apartments', 'hemma' ), $the_query->max_num_pages ); ?>
						<?php previous_posts_link( esc_html__( 'Next Apartments', 'hemma' ) ); ?>
					</div>
				</div>

			<?php endif; ?>
			
			<?php
			wp_reset_postdata(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();