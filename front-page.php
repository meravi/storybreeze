<?php
/**
 * Front page template.
 *
 * @package StoryBreeze
 */

get_header();

$shop_url = storybreeze_get_shop_page_url();

$hero_media_url = get_header_image();
if ( ! $hero_media_url ) {
	$hero_media_post_query = new WP_Query(
		array(
			'post_type'              => 'post',
			'post_status'            => 'publish',
			'posts_per_page'         => 1,
			'ignore_sticky_posts'    => true,
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		)
	);

	if ( $hero_media_post_query->have_posts() ) {
		$hero_media_post_query->the_post();
		$hero_media_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		wp_reset_postdata();
	}
}

$featured_content_query = new WP_Query(
	array(
		'post_type'              => 'post',
		'post_status'            => 'publish',
		'posts_per_page'         => 4,
		'ignore_sticky_posts'    => true,
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
	)
);
?>
<main id="main" class="site-main">
	<section class="sb-showcase">
		<div class="container">
			<div class="sb-hero-banner">
				<div class="sb-hero-media" aria-hidden="true">
					<?php if ( $hero_media_url ) : ?>
						<img src="<?php echo esc_url( $hero_media_url ); ?>" alt="" loading="lazy" decoding="async" />
					<?php else : ?>
						<div class="sb-hero-fallback"></div>
					<?php endif; ?>
				</div>
				<div class="sb-hero-overlay">
					<p class="sb-hero-kicker"><?php esc_html_e( 'Editorial Notes', 'storybreeze' ); ?></p>
					<h1><?php esc_html_e( 'Stories for Everyday Living', 'storybreeze' ); ?></h1>
					<p><?php esc_html_e( 'A simple front-page layout with featured posts, readable typography, and clear navigation.', 'storybreeze' ); ?></p>
					<a class="button button-primary" href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'Read Stories', 'storybreeze' ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<section class="sb-catalog section-space">
		<div class="container">
			<div class="sb-section-head">
				<h2><?php esc_html_e( 'Latest Stories', 'storybreeze' ); ?></h2>
			</div>
			<div class="sb-product-grid">
				<?php if ( $featured_content_query->have_posts() ) : ?>
					<?php
					while ( $featured_content_query->have_posts() ) :
						$featured_content_query->the_post();
						?>
						<article <?php post_class( 'sb-product-card sb-post-card' ); ?>>
							<a class="sb-product-thumb" href="<?php the_permalink(); ?>">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'medium_large' );
								} else {
									echo '<span class="sb-product-fallback" aria-hidden="true"></span>';
								}
								?>
							</a>
							<div class="sb-product-content">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<p class="sb-product-price"><?php echo esc_html( get_the_date() ); ?></p>
							</div>
						</article>
						<?php
					endwhile;
					wp_reset_postdata();
					?>
				<?php else : ?>
					<p><?php esc_html_e( 'No posts found yet.', 'storybreeze' ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
