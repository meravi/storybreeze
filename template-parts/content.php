<?php
/**
 * Post card template.
 *
 * @package StoryBreeze
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'loop-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="loop-card-thumb" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'large' ); ?>
		</a>
	<?php endif; ?>

	<div class="loop-card-content">
		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
			<div class="entry-meta"><?php storybreeze_posted_on(); ?></div>
		</header>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>

		<?php storybreeze_entry_footer(); ?>
	</div>
</article>
