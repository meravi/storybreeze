<?php
/**
 * Search form template.
 *
 * @package StoryBreeze
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$context = 'default';
if ( isset( $args['storybreeze_context'] ) && is_scalar( $args['storybreeze_context'] ) ) {
	$context = sanitize_key( wp_unslash( (string) $args['storybreeze_context'] ) );
}

$label       = __( 'Search for:', 'storybreeze' );
$placeholder = __( 'Search posts and pages', 'storybreeze' );
$form_class  = 'search-form';

if ( 'header' === $context ) {
	$form_class .= ' header-search-form';
	$label       = __( 'Search:', 'storybreeze' );
	$placeholder = __( 'Search stories', 'storybreeze' );
}

$unique_id = wp_unique_id( 'search-form-' );
?>
<form method="get" class="<?php echo esc_attr( $form_class ); ?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $unique_id ); ?>">
		<span class="screen-reader-text"><?php echo esc_html( $label ); ?></span>
	</label>
	<input id="<?php echo esc_attr( $unique_id ); ?>" type="search" class="search-field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>" />
	<?php if ( 'header' === $context ) : ?>
		<button type="submit" class="search-submit">
			<span class="screen-reader-text"><?php esc_html_e( 'Search', 'storybreeze' ); ?></span>
			<span class="search-icon" aria-hidden="true"></span>
		</button>
	<?php else : ?>
		<button type="submit" class="search-submit"><?php esc_html_e( 'Search', 'storybreeze' ); ?></button>
	<?php endif; ?>
</form>
