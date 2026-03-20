<?php
/**
 * 404 template.
 *
 * @package StoryBreeze
 */

get_header();
?>
<main id="main" class="site-main">
	<div class="container section-space not-found-wrap">
		<section class="not-found-card">
			<h1><?php esc_html_e( 'Page not found', 'storybreeze' ); ?></h1>
			<p><?php esc_html_e( 'The page you are looking for does not exist or has moved.', 'storybreeze' ); ?></p>
			<?php get_search_form(); ?>
			<p><a class="button button-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Return Home', 'storybreeze' ); ?></a></p>
		</section>
	</div>
</main>
<?php
get_footer();
