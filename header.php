<?php
/**
 * Header template.
 *
 * @package StoryBreeze
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'storybreeze' ); ?></a>

<div id="page" class="site">
	<header id="masthead" class="site-header" role="banner">
		<div class="container header-main">
			<div class="site-branding">
				<?php if ( has_custom_logo() ) : ?>
					<div class="site-logo-wrap"><?php the_custom_logo(); ?></div>
				<?php else : ?>
					<span class="site-mark" aria-hidden="true">W</span>
				<?php endif; ?>
				<div class="site-branding-text">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>
					<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description ) :
						?>
							<p class="site-description"><?php echo esc_html( $description ); ?></p>
						<?php
					endif;
					?>
				</div>
			</div>

			<div class="header-tools">
				<?php get_search_form( array( 'storybreeze_context' => 'header' ) ); ?>

				<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-navigation">
					<span class="menu-toggle-icon" aria-hidden="true"></span>
					<span class="screen-reader-text"><?php esc_html_e( 'Toggle menu', 'storybreeze' ); ?></span>
				</button>
			</div>
		</div>

		<nav id="site-navigation" class="primary-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'storybreeze' ); ?>">
			<div class="container">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_class'     => 'menu primary-menu',
						'container'      => false,
						'fallback_cb'    => 'storybreeze_menu_fallback',
					)
				);
				?>
			</div>
		</nav>
	</header>
