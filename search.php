<?php
/**
 * Search results template.
 *
 * @package StoryBreeze
 */

get_header();
?>
<main id="main" class="site-main">
	<div class="container content-area section-space">
		<header class="page-header">
			<h1 class="page-title">
				<?php
				printf(
					/* translators: %s search query. */
					esc_html__( 'Search Results for: %s', 'storybreeze' ),
					'<span>' . esc_html( get_search_query() ) . '</span>'
				);
				?>
			</h1>
		</header>

		<div class="loop-grid">
			<?php if ( have_posts() ) : ?>
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile;
				?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</div>

		<?php the_posts_pagination(); ?>
	</div>
</main>
<?php
get_footer();
