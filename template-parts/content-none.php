<?php
/**
 * No content template.
 *
 * @package StoryBreeze
 */

?>
<section class="no-results not-found">
	<h2><?php esc_html_e( 'Nothing Found', 'storybreeze' ); ?></h2>
	<p><?php esc_html_e( 'Try searching with different keywords.', 'storybreeze' ); ?></p>
	<?php get_search_form(); ?>
</section>
