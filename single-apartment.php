<?php
/**
 * The template for displaying all single apartment posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Hemma
 */

get_header(); ?>

	<?php
	$the_id = get_the_ID();
	$subtitle = get_post_meta( $the_id, 'opendept_subtitle_apartment_subtitle', true );
	$overlay_bg = get_post_meta( $the_id, 'opendept_hero_apartment_color', true );
	$titles_align = get_post_meta( $the_id, 'opendept_hero_apartment_align', true );
	$hero_height = get_post_meta( $the_id, 'opendept_hero_apartment_height', true );
	$hero_bg_color = get_post_meta( $the_id, 'opendept_hero_apartment_bg_color', true );
	$hero_mouse_icon = get_post_meta( $the_id, 'opendept_hero_apartment_mouse_icon', true );
	$apartment_guests = get_post_meta( $the_id, 'opendept_apartment_guests', true );
	$apartment_beds = get_post_meta( $the_id, 'opendept_apartment_beds', true );
	$apartment_size = get_post_meta( $the_id, 'opendept_apartment_size', true );
	$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $the_id ), 'full' );
	$sidebar = get_post_meta( $the_id, 'opendept_apartment_sidebar_enable_sidebar', true );
	$grey_box = get_post_meta( $the_id, 'opendept_apartment_sidebar_enable_box', true );
	$grey_box_title = get_post_meta( $the_id, 'opendept_apartment_sidebar_box_title', true );
	$grey_box_price = get_post_meta( $the_id, 'opendept_apartment_sidebar_box_price', true );
	$grey_box_price_per = get_post_meta( $the_id, 'opendept_apartment_sidebar_box_price_per', true );
	$grey_box_button_text = get_post_meta( $the_id, 'opendept_apartment_sidebar_box_button_text', true );
	$grey_box_button_link = get_post_meta( $the_id, 'opendept_apartment_sidebar_box_button_link', true );
	$grey_box_button_color = get_post_meta( $the_id, 'opendept_apartment_sidebar_box_button_color', true );
	$grey_box_button_target = get_post_meta( $the_id, 'opendept_apartment_sidebar_box_button_target', true );
	$grey_box_notes = get_post_meta( $the_id, 'opendept_apartment_sidebar_box_notes', true );
	$sidebar_content = get_post_meta( $the_id, 'opendept_apartment_sidebar_content', true );

	// Set layout column class
	$col_class = ' is-8 is-offset-2';
	if ( $sidebar ) {
		$col_class = ' is-8';
	}
	?>

	<div id="hero" class="hero is-bg-image is-text-light <?php echo sanitize_html_class( $titles_align ); ?> <?php echo sanitize_html_class( $hero_height ); ?> <?php echo sanitize_html_class( $hero_bg_color ); ?>"<?php if ( $image_attributes ) echo 'style="background-image: url(' . esc_url( $image_attributes[0] ) . ');"' ?>>
		<div class="hero-content" style="background-color: <?php echo $overlay_bg; ?>">
			<div class="container is-fluid">
				<div class="hero-text">
					<?php the_title( '<h1 class="hero-title">', '</h1>' ); ?>
					<?php if ( $subtitle ) : ?>
						<div class="hero-subtitle"><?php echo esc_html( $subtitle ); ?></div>
					<?php endif; ?>
				</div><!-- /.hero-text -->
			</div><!-- /.container -->
			<?php
			if ( $hero_mouse_icon ) { ?>
			<div class="scroll-icon"></div>
			<?php } ?>
			<div class="extras-meta container is-fluid">
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
		</div><!-- /.hero-content -->
	</div><!-- /.hero -->

	<div class="container">
		<div class="columns">
			<div class="column<?php echo $col_class; ?>">

				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'cpt' );

						if ( true == get_theme_mod( 'enable_apartment_comments', false ) ) :
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						endif;

					endwhile; // End of the loop.
					?>

					</main><!-- #main -->
				</div><!-- #primary -->

			</div><!-- /.column -->

			<?php if ( $sidebar ) : ?>

			<div class="column is-4">

				<aside id="secondary" class="widget-area" role="complementary">

					<?php if( $grey_box ) : ?>

					<section>
						<div class="grey-box is-centered">
							<h4><?php echo esc_html( $grey_box_title ); ?></h4>
							<div class="h2"><?php echo esc_html( $grey_box_price ); ?></div>
							<p><?php echo esc_html( $grey_box_price_per ); ?></p>
							<?php if( $grey_box_button_text ) : ?>
							<a href="<?php echo esc_url( $grey_box_button_link ); ?>" class="button <?php echo sanitize_html_class( $grey_box_button_color ); ?>"<?php if( $grey_box_button_target ) echo ' target=_blank'; ?>><?php echo esc_html( $grey_box_button_text ); ?></a>
							<?php endif; ?>
							<?php if( $grey_box_notes ) : ?>
							<p><?php echo do_shortcode( wpautop( wp_kses_post( $grey_box_notes ) ) ); ?></p>
							<?php endif; ?>
						</div><!-- /.grey-box -->
					</section>

					<?php endif; ?>

					<?php if( $sidebar_content ) : ?>

					<section>

						<?php echo do_shortcode( wpautop( wp_kses_post( $sidebar_content ) ) ); ?>

					</section>

					<?php endif; ?>

				</aside>

			</div><!-- /.column -->

			<?php endif; ?>

		</div><!-- /.columns -->
	</div><!-- /.container -->

<?php
get_footer();
