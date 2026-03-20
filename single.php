<?php
/**
 * Single post template.
 *
 * @package StoryBreeze
 */

get_header();
?>
<main id="main" class="site-main">
	<div class="container section-space single-layout">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-article' ); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<div class="entry-meta"><?php storybreeze_posted_on(); ?></div>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="entry-image"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php endif; ?>

				<div class="entry-content">
					<?php the_content(); ?>
					<?php
					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'storybreeze' ),
							'after'  => '</div>',
						)
					);
					?>
				</div>

				<?php storybreeze_entry_footer(); ?>
			</article>
			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
		?>
	</div>
</main>
<?php
get_footer();
