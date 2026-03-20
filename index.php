<?php
/**
 * Main index template.
 *
 * @package StoryBreeze
 */

get_header();
?>
<main id="main" class="site-main">
	<div class="container content-area section-space">
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
