<?php
/**
 * Theme functions and definitions.
 *
 * @package StoryBreeze
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'STORYBREEZE_VERSION' ) ) {
	$storybreeze_theme = wp_get_theme();
	define( 'STORYBREEZE_VERSION', $storybreeze_theme->get( 'Version' ) ? $storybreeze_theme->get( 'Version' ) : '1.0.0' );
}

if ( ! function_exists( 'storybreeze_setup' ) ) :
	/**
	 * Set up theme defaults.
	 *
	 * @return void
	 */
	function storybreeze_setup() {
		load_theme_textdomain( 'storybreeze', get_template_directory() . '/languages' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 96,
				'width'       => 96,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/editor-style.css' );

		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'f3f6fc',
			)
		);

		add_theme_support(
			'custom-header',
			array(
				'width'              => 1920,
				'height'             => 420,
				'flex-height'        => true,
				'flex-width'         => true,
				'uploads'            => true,
				'default-text-color' => '15203b',
			)
		);

		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'storybreeze' ),
				'footer'  => __( 'Footer Menu', 'storybreeze' ),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'storybreeze_setup' );

/**
 * Register optional block styles and patterns.
 *
 * @return void
 */
function storybreeze_register_block_enhancements() {
	if ( function_exists( 'register_block_style' ) ) {
		register_block_style(
			'core/button',
			array(
				'name'  => 'storybreeze-outline',
				'label' => __( 'StoryBreeze Outline', 'storybreeze' ),
			)
		);

		register_block_style(
			'core/group',
			array(
				'name'  => 'storybreeze-card',
				'label' => __( 'StoryBreeze Card', 'storybreeze' ),
			)
		);
	}

	if ( function_exists( 'register_block_pattern_category' ) && class_exists( 'WP_Block_Pattern_Categories_Registry' ) ) {
		$category_registry = WP_Block_Pattern_Categories_Registry::get_instance();
		if ( ! $category_registry->is_registered( 'storybreeze' ) ) {
			register_block_pattern_category(
				'storybreeze',
				array(
					'label' => __( 'StoryBreeze', 'storybreeze' ),
				)
			);
		}
	}

	if ( function_exists( 'register_block_pattern' ) && class_exists( 'WP_Block_Patterns_Registry' ) ) {
		$pattern_registry = WP_Block_Patterns_Registry::get_instance();

		$hero_pattern_content = sprintf(
			'<!-- wp:group {"align":"wide","className":"is-style-storybreeze-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide is-style-storybreeze-card"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center">%1$s</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">%2$s</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">%3$s</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-storybreeze-outline"} -->
<div class="wp-block-button is-style-storybreeze-outline"><a class="wp-block-button__link wp-element-button">%4$s</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->',
			esc_html__( 'Seasonal Campaign', 'storybreeze' ),
			esc_html__( 'Use this hero section to promote your best-selling collection and drive traffic to your shop page.', 'storybreeze' ),
			esc_html__( 'Shop Now', 'storybreeze' ),
			esc_html__( 'Learn More', 'storybreeze' )
		);

		$feature_pattern_content = sprintf(
			'<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide"><!-- wp:heading -->
<h2 class="wp-block-heading">%1$s</h2>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">%2$s</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>%3$s</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">%4$s</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>%5$s</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">%6$s</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>%7$s</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
			esc_html__( 'Store Highlights', 'storybreeze' ),
			esc_html__( 'Fast Dispatch', 'storybreeze' ),
			esc_html__( 'Set clear shipping expectations to build trust during checkout.', 'storybreeze' ),
			esc_html__( 'Quality Promise', 'storybreeze' ),
			esc_html__( 'Showcase your quality checks and customer satisfaction standards.', 'storybreeze' ),
			esc_html__( 'Support Team', 'storybreeze' ),
			esc_html__( 'Guide customers with quick help options before and after purchase.', 'storybreeze' )
		);

		if ( ! $pattern_registry->is_registered( 'storybreeze/hero-cta' ) ) {
			register_block_pattern(
				'storybreeze/hero-cta',
				array(
					'title'       => __( 'Shop Hero CTA', 'storybreeze' ),
					'description' => __( 'A centered promotion section with call-to-action buttons.', 'storybreeze' ),
					'categories'  => array( 'storybreeze', 'featured' ),
					'content'     => $hero_pattern_content,
				)
			);
		}

		if ( ! $pattern_registry->is_registered( 'storybreeze/feature-grid' ) ) {
			register_block_pattern(
				'storybreeze/feature-grid',
				array(
					'title'       => __( 'Store Feature Grid', 'storybreeze' ),
					'description' => __( 'A three-column feature section for service or trust messaging.', 'storybreeze' ),
					'categories'  => array( 'storybreeze', 'columns' ),
					'content'     => $feature_pattern_content,
				)
			);
		}
	}
}
add_action( 'init', 'storybreeze_register_block_enhancements' );

/**
 * Register widget area.
 *
 * @return void
 */
function storybreeze_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'storybreeze' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here.', 'storybreeze' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'storybreeze_widgets_init' );

/**
 * Enqueue assets.
 *
 * @return void
 */
function storybreeze_enqueue_assets() {
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style( 'storybreeze-style', get_stylesheet_uri(), array(), STORYBREEZE_VERSION );
	wp_enqueue_style(
		'storybreeze-theme',
		get_template_directory_uri() . '/assets/css/theme.css',
		array( 'storybreeze-style' ),
		STORYBREEZE_VERSION
	);

	wp_enqueue_script(
		'storybreeze-navigation',
		get_template_directory_uri() . '/assets/js/navigation.js',
		array(),
		STORYBREEZE_VERSION,
		true
	);
	wp_script_add_data( 'storybreeze-navigation', 'defer', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'storybreeze_enqueue_assets' );

/**
 * Menu fallback callback.
 *
 * @param array<string, mixed> $args Menu arguments.
 * @return void
 */
function storybreeze_menu_fallback( $args ) {
	$menu_class = isset( $args['menu_class'] ) ? (string) $args['menu_class'] : 'menu';
	echo '<ul class="' . esc_attr( $menu_class ) . '">';
	echo wp_kses_post(
		wp_list_pages(
			array(
				'title_li' => '',
				'echo'     => 0,
			)
		)
	);
	echo '</ul>';
}

/**
 * Adds custom body classes.
 *
 * @param string[] $classes Existing classes.
 * @return string[]
 */
function storybreeze_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'storybreeze-front-page';
	}

	return $classes;
}
add_filter( 'body_class', 'storybreeze_body_classes' );

/**
 * Displays posted-on meta.
 *
 * @return void
 */
function storybreeze_posted_on() {
	echo '<span class="entry-meta-item">' . esc_html( get_the_date() ) . '</span>';
	echo '<span class="entry-meta-sep" aria-hidden="true">|</span>';
	echo '<span class="entry-meta-item">' . esc_html( get_the_author() ) . '</span>';
}

/**
 * Displays entry taxonomies.
 *
 * @return void
 */
function storybreeze_entry_footer() {
	if ( 'post' !== get_post_type() ) {
		return;
	}

	$categories_list = get_the_category_list( esc_html__( ', ', 'storybreeze' ) );
	$tags_list       = get_the_tag_list( '', esc_html__( ', ', 'storybreeze' ) );

	if ( ! $categories_list && ! $tags_list ) {
		return;
	}

	echo '<div class="entry-taxonomies">';

	if ( $categories_list ) {
		echo '<span class="entry-taxonomy entry-taxonomy-categories">';
		echo '<span class="entry-taxonomy-label">' . esc_html__( 'Categories:', 'storybreeze' ) . '</span> ';
		echo wp_kses_post( $categories_list );
		echo '</span>';
	}

	if ( $tags_list ) {
		echo '<span class="entry-taxonomy entry-taxonomy-tags">';
		echo '<span class="entry-taxonomy-label">' . esc_html__( 'Tags:', 'storybreeze' ) . '</span> ';
		echo wp_kses_post( $tags_list );
		echo '</span>';
	}

	echo '</div>';
}

/**
 * Get the storefront URL.
 *
 * @return string
 */
function storybreeze_get_shop_page_url() {
	$shop_url = home_url( '/' );

	$blog_page = get_page_by_path( 'blog' );
	if ( $blog_page instanceof WP_Post ) {
		$shop_url = get_permalink( $blog_page );
	}

	/**
	 * Filters the storefront URL used across theme templates.
	 *
	 * @param string $shop_url URL.
	 */
	return (string) apply_filters( 'storybreeze_shop_page_url', $shop_url );
}

/**
 * Returns demo page definitions.
 *
 * @return array<string, array<string, string>>
 */
function storybreeze_get_demo_page_definitions() {
	$shop_content  = '<div class="sb-page-intro"><h2>' . esc_html__( 'Shop Landing Page', 'storybreeze' ) . '</h2><p>' . esc_html__( 'Use this page to highlight featured content, campaign sections, and key collections with the block editor.', 'storybreeze' ) . '</p></div>';
	$shop_content .= '<h3>' . esc_html__( 'Featured Collections', 'storybreeze' ) . '</h3>';
	$shop_content .= '<p>' . esc_html__( 'Add category links, featured posts, or custom promotional blocks to build your storefront narrative.', 'storybreeze' ) . '</p>';

	$home_content = '<h2>' . esc_html__( 'Welcome to StoryBreeze', 'storybreeze' ) . '</h2><p>' . esc_html__( 'This page is powered by front-page.php. Import starter content from Appearance > StoryBreeze Setup for a fast launch.', 'storybreeze' ) . '</p>';

	$definitions = array(
		'home'     => array(
			'title'   => __( 'Home', 'storybreeze' ),
			'slug'    => 'home',
			'content' => $home_content,
		),
		'shop'     => array(
			'title'   => __( 'Shop', 'storybreeze' ),
			'slug'    => 'shop',
			'content' => $shop_content,
		),
		'about'    => array(
			'title'   => __( 'About', 'storybreeze' ),
			'slug'    => 'about',
			'content' => '<div class="sb-page-intro"><h2>' . esc_html__( 'Our Story', 'storybreeze' ) . '</h2><p>' . esc_html__( 'StoryBreeze was designed for merchants who want a fast, elegant storefront without visual clutter.', 'storybreeze' ) . '</p></div><div class="sb-info-grid"><article class="sb-info-card"><h3>' . esc_html__( 'Mission', 'storybreeze' ) . '</h3><p>' . esc_html__( 'Deliver practical products with premium customer service from first click to final delivery.', 'storybreeze' ) . '</p></article><article class="sb-info-card"><h3>' . esc_html__( 'Approach', 'storybreeze' ) . '</h3><p>' . esc_html__( 'We combine clean design, fast pages, and transparent product information to increase trust.', 'storybreeze' ) . '</p></article><article class="sb-info-card"><h3>' . esc_html__( 'Promise', 'storybreeze' ) . '</h3><p>' . esc_html__( 'Every product page should help shoppers decide quickly with confidence.', 'storybreeze' ) . '</p></article></div><h3>' . esc_html__( 'Why customers stay with us', 'storybreeze' ) . '</h3><ul><li>' . esc_html__( 'Reliable quality checks before dispatch', 'storybreeze' ) . '</li><li>' . esc_html__( 'Transparent shipping and support communication', 'storybreeze' ) . '</li><li>' . esc_html__( 'Helpful return policy and quick response times', 'storybreeze' ) . '</li></ul>',
		),
		'services' => array(
			'title'   => __( 'Services', 'storybreeze' ),
			'slug'    => 'services',
			'content' => '<div class="sb-page-intro"><h2>' . esc_html__( 'Ecommerce Services', 'storybreeze' ) . '</h2><p>' . esc_html__( 'Use this page to explain fulfillment, B2B support, and brand-specific service options.', 'storybreeze' ) . '</p></div><div class="sb-info-grid"><article class="sb-info-card"><h3>' . esc_html__( 'Retail Fulfillment', 'storybreeze' ) . '</h3><p>' . esc_html__( 'Fast processing and delivery updates for direct-to-customer orders.', 'storybreeze' ) . '</p></article><article class="sb-info-card"><h3>' . esc_html__( 'Wholesale Support', 'storybreeze' ) . '</h3><p>' . esc_html__( 'Dedicated workflows for bulk orders, custom pricing, and recurring supply.', 'storybreeze' ) . '</p></article><article class="sb-info-card"><h3>' . esc_html__( 'Priority Care', 'storybreeze' ) . '</h3><p>' . esc_html__( 'Direct support channel for urgent order and account requests.', 'storybreeze' ) . '</p></article></div>',
		),
		'contact'  => array(
			'title'   => __( 'Contact Us', 'storybreeze' ),
			'slug'    => 'contact-us',
			'content' => '<div class="sb-page-intro"><h2>' . esc_html__( 'Contact Us', 'storybreeze' ) . '</h2><p>' . esc_html__( 'Questions about products, shipping, or order status? We are here to help.', 'storybreeze' ) . '</p></div><div class="sb-contact-grid"><article class="sb-contact-card"><h3>' . esc_html__( 'Email Support', 'storybreeze' ) . '</h3><p>support@example.com</p></article><article class="sb-contact-card"><h3>' . esc_html__( 'Phone', 'storybreeze' ) . '</h3><p>+1 (000) 000-0000</p></article><article class="sb-contact-card"><h3>' . esc_html__( 'Working Hours', 'storybreeze' ) . '</h3><p>' . esc_html__( 'Monday to Friday, 9:00 AM to 6:00 PM', 'storybreeze' ) . '</p></article></div><h3>' . esc_html__( 'Fast support checklist', 'storybreeze' ) . '</h3><ul><li>' . esc_html__( 'Include your order number in the first message', 'storybreeze' ) . '</li><li>' . esc_html__( 'Attach product photos for warranty or damage requests', 'storybreeze' ) . '</li><li>' . esc_html__( 'Use the same email used at checkout for faster verification', 'storybreeze' ) . '</li></ul>',
		),
		'journal'  => array(
			'title'   => __( 'Blog', 'storybreeze' ),
			'slug'    => 'blog',
			'content' => '<h2>' . esc_html__( 'Shop Journal', 'storybreeze' ) . '</h2><p>' . esc_html__( 'Use your blog for buyer guides, comparison posts, and campaign updates.', 'storybreeze' ) . '</p>',
		),
	);

	/**
	 * Filters demo page definitions.
	 *
	 * @param array<string, array<string, string>> $definitions Demo definitions.
	 */
	return (array) apply_filters( 'storybreeze_demo_page_definitions', $definitions );
}

/**
 * Create or update a page.
 *
 * @param array<string, string> $page Page definition.
 * @return array<string, int|bool>
 */
function storybreeze_upsert_demo_page( $page ) {
	$slug = sanitize_title( $page['slug'] );
	$post = get_page_by_path( $slug, OBJECT, 'page' );

	$postarr = array(
		'post_type'    => 'page',
		'post_status'  => 'publish',
		'post_title'   => wp_strip_all_tags( $page['title'] ),
		'post_name'    => $slug,
		'post_content' => (string) $page['content'],
	);

	$created = true;

	if ( $post instanceof WP_Post ) {
		$postarr['ID'] = $post->ID;
		$created       = false;
		$post_id       = wp_update_post( wp_slash( $postarr ), true );
	} else {
		$post_id = wp_insert_post( wp_slash( $postarr ), true );
	}

	return array(
		'post_id'  => is_wp_error( $post_id ) ? 0 : (int) $post_id,
		'created'  => $created,
		'is_error' => is_wp_error( $post_id ),
	);
}

/**
 * Get or create a nav menu.
 *
 * @param string $name Menu name.
 * @return int
 */
function storybreeze_get_or_create_menu_id( $name ) {
	$menu = wp_get_nav_menu_object( $name );

	if ( $menu && ! is_wp_error( $menu ) && isset( $menu->term_id ) ) {
		return (int) $menu->term_id;
	}

	$menu_id = wp_create_nav_menu( $name );

	if ( is_wp_error( $menu_id ) ) {
		return 0;
	}

	return (int) $menu_id;
}

/**
 * Replaces menu items with page links.
 *
 * @param int      $menu_id Menu id.
 * @param string[] $order Page keys order.
 * @param int[]    $page_ids Page ids by key.
 * @return void
 */
function storybreeze_replace_menu_items( $menu_id, $order, $page_ids ) {
	$items = wp_get_nav_menu_items( $menu_id, array( 'post_status' => 'any' ) );

	if ( is_array( $items ) ) {
		foreach ( $items as $item ) {
			wp_delete_post( (int) $item->ID, true );
		}
	}

	foreach ( $order as $key ) {
		if ( empty( $page_ids[ $key ] ) ) {
			continue;
		}

		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'     => get_the_title( $page_ids[ $key ] ),
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $page_ids[ $key ],
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
			)
		);
	}
}

/**
 * Creates and assigns demo menus.
 *
 * @param int[] $page_ids Page ids.
 * @return void
 */
function storybreeze_create_demo_menus( $page_ids ) {
	$primary_menu_id = storybreeze_get_or_create_menu_id( __( 'StoryBreeze Primary Menu', 'storybreeze' ) );
	$footer_menu_id  = storybreeze_get_or_create_menu_id( __( 'StoryBreeze Footer Menu', 'storybreeze' ) );

	if ( $primary_menu_id ) {
		storybreeze_replace_menu_items( $primary_menu_id, array( 'home', 'shop', 'about', 'services', 'journal', 'contact' ), $page_ids );
	}

	if ( $footer_menu_id ) {
		storybreeze_replace_menu_items( $footer_menu_id, array( 'shop', 'about', 'contact' ), $page_ids );
	}

	$locations            = get_nav_menu_locations();
	$locations['primary'] = $primary_menu_id;
	$locations['footer']  = $footer_menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}

/**
 * Imports demo blog posts.
 *
 * @return array<string, int>
 */
function storybreeze_import_demo_posts() {
	$summary = array(
		'created' => 0,
		'updated' => 0,
		'errors'  => 0,
	);

	$definitions = array(
		array(
			'title'   => __( 'How to Build a Better Product Page', 'storybreeze' ),
			'slug'    => 'how-to-build-a-better-product-page',
			'excerpt' => __( 'Practical tips to improve product clarity, trust signals, and conversion rate.', 'storybreeze' ),
			'content' => __( 'Write clear product benefits, use comparison-friendly specs, and keep shipping details visible near the add-to-cart button.', 'storybreeze' ),
		),
		array(
			'title'   => __( 'Checkout Optimization Checklist', 'storybreeze' ),
			'slug'    => 'checkout-optimization-checklist',
			'excerpt' => __( 'A quick checklist for reducing friction in checkout flows.', 'storybreeze' ),
			'content' => __( 'Minimize required fields, offer trusted payment options, and display total costs early to reduce abandonment.', 'storybreeze' ),
		),
		array(
			'title'   => __( 'Seasonal Campaign Planning for Stores', 'storybreeze' ),
			'slug'    => 'seasonal-campaign-planning-for-stores',
			'excerpt' => __( 'Plan promotions with the right messaging and category focus.', 'storybreeze' ),
			'content' => __( 'Coordinate homepage messaging, category highlights, and promo banners so visitors can discover offers quickly.', 'storybreeze' ),
		),
	);

	foreach ( $definitions as $definition ) {
		$existing = get_page_by_path( (string) $definition['slug'], OBJECT, 'post' );
		$created  = ! ( $existing instanceof WP_Post );

		$postarr = array(
			'post_type'    => 'post',
			'post_status'  => 'publish',
			'post_title'   => (string) $definition['title'],
			'post_name'    => sanitize_title( (string) $definition['slug'] ),
			'post_excerpt' => (string) $definition['excerpt'],
			'post_content' => (string) $definition['content'],
		);

		if ( $existing instanceof WP_Post ) {
			$postarr['ID'] = $existing->ID;
			$post_id       = wp_update_post( wp_slash( $postarr ), true );
		} else {
			$post_id = wp_insert_post( wp_slash( $postarr ), true );
		}

		if ( is_wp_error( $post_id ) ) {
			++$summary['errors'];
			continue;
		}

		if ( $created ) {
			++$summary['created'];
		} else {
			++$summary['updated'];
		}
	}

	return $summary;
}

/**
 * Imports demo pages and assigns options.
 *
 * @return array{summary: array<string, int>, ids: array<string, int>}
 */
function storybreeze_import_demo_pages() {
	$pages   = storybreeze_get_demo_page_definitions();
	$summary = array(
		'created' => 0,
		'updated' => 0,
		'errors'  => 0,
	);
	$ids     = array();

	foreach ( $pages as $key => $page ) {
		$result = storybreeze_upsert_demo_page( $page );

		if ( true === $result['is_error'] || empty( $result['post_id'] ) ) {
			++$summary['errors'];
			continue;
		}

		$ids[ $key ] = (int) $result['post_id'];

		if ( true === $result['created'] ) {
			++$summary['created'];
		} else {
			++$summary['updated'];
		}
	}

	if ( isset( $ids['home'], $ids['journal'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', (int) $ids['home'] );
		update_option( 'page_for_posts', (int) $ids['journal'] );
	}

	storybreeze_create_demo_menus( $ids );

	return array(
		'summary' => $summary,
		'ids'     => $ids,
	);
}

/**
 * Registers setup page.
 *
 * @return void
 */
function storybreeze_register_setup_page() {
	add_theme_page(
		__( 'StoryBreeze Setup', 'storybreeze' ),
		__( 'StoryBreeze Setup', 'storybreeze' ),
		'edit_theme_options',
		'storybreeze-setup',
		'storybreeze_render_setup_page'
	);
}
add_action( 'admin_menu', 'storybreeze_register_setup_page' );

/**
 * Handles setup actions.
 *
 * @return void
 */
function storybreeze_handle_setup_actions() {
	if ( ! isset( $_POST['storybreeze_setup_action'] ) || ! is_scalar( $_POST['storybreeze_setup_action'] ) ) {
		return;
	}

	$action = sanitize_key( wp_unslash( (string) $_POST['storybreeze_setup_action'] ) );

	if ( ! in_array( $action, array( 'import_demo_pages', 'import_demo_content' ), true ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	check_admin_referer( 'storybreeze_import_demo_pages', 'storybreeze_import_nonce' );

	$page_result  = storybreeze_import_demo_pages();
	$page_summary = $page_result['summary'];
	$post_summary = array(
		'created' => 0,
		'updated' => 0,
		'errors'  => 0,
	);

	if ( 'import_demo_content' === $action ) {
		$post_summary = storybreeze_import_demo_posts();
	}

	$url = add_query_arg(
		array(
			'page'               => 'storybreeze-setup',
			'imported'           => 1,
			'action_done'        => $action,
			'p_created'          => (int) $page_summary['created'],
			'p_updated'          => (int) $page_summary['updated'],
			'p_errors'           => (int) $page_summary['errors'],
			'b_created'          => (int) $post_summary['created'],
			'b_updated'          => (int) $post_summary['updated'],
			'b_errors'           => (int) $post_summary['errors'],
			'setup_notice_nonce' => wp_create_nonce( 'storybreeze_setup_notice' ),
		),
		admin_url( 'themes.php' )
	);

	wp_safe_redirect( $url );
	exit;
}
add_action( 'admin_init', 'storybreeze_handle_setup_actions' );

/**
 * Renders setup page.
 *
 * @return void
 */
function storybreeze_render_setup_page() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	$imported    = false;
	$action_done = '';
	$p_created   = 0;
	$p_updated   = 0;
	$p_errors    = 0;
	$b_created   = 0;
	$b_updated   = 0;
	$b_errors    = 0;

	$setup_notice_nonce = ( isset( $_GET['setup_notice_nonce'] ) && is_scalar( $_GET['setup_notice_nonce'] ) ) ? sanitize_text_field( wp_unslash( (string) $_GET['setup_notice_nonce'] ) ) : '';
	if ( wp_verify_nonce( $setup_notice_nonce, 'storybreeze_setup_notice' ) ) {
		$imported    = ( isset( $_GET['imported'] ) && is_scalar( $_GET['imported'] ) ) ? '1' === sanitize_text_field( wp_unslash( (string) $_GET['imported'] ) ) : false;
		$action_done = ( isset( $_GET['action_done'] ) && is_scalar( $_GET['action_done'] ) ) ? sanitize_key( wp_unslash( (string) $_GET['action_done'] ) ) : '';

		$p_created = ( isset( $_GET['p_created'] ) && is_scalar( $_GET['p_created'] ) ) ? absint( wp_unslash( (string) $_GET['p_created'] ) ) : 0;
		$p_updated = ( isset( $_GET['p_updated'] ) && is_scalar( $_GET['p_updated'] ) ) ? absint( wp_unslash( (string) $_GET['p_updated'] ) ) : 0;
		$p_errors  = ( isset( $_GET['p_errors'] ) && is_scalar( $_GET['p_errors'] ) ) ? absint( wp_unslash( (string) $_GET['p_errors'] ) ) : 0;

		$b_created = ( isset( $_GET['b_created'] ) && is_scalar( $_GET['b_created'] ) ) ? absint( wp_unslash( (string) $_GET['b_created'] ) ) : 0;
		$b_updated = ( isset( $_GET['b_updated'] ) && is_scalar( $_GET['b_updated'] ) ) ? absint( wp_unslash( (string) $_GET['b_updated'] ) ) : 0;
		$b_errors  = ( isset( $_GET['b_errors'] ) && is_scalar( $_GET['b_errors'] ) ) ? absint( wp_unslash( (string) $_GET['b_errors'] ) ) : 0;
	}
	?>
	<div class="wrap">
		<h1><?php echo esc_html__( 'StoryBreeze Setup', 'storybreeze' ); ?></h1>
		<p><?php echo esc_html__( 'Build a complete starter site with one click. You can import pages and menus, or pages + menus + starter blog posts.', 'storybreeze' ); ?></p>

		<?php if ( $imported ) : ?>
			<div class="notice notice-success inline">
				<p>
					<?php
					echo esc_html(
						sprintf(
							/* translators: 1: created count, 2: updated count, 3: error count. */
							__( 'Pages import: Created %1$d, Updated %2$d, Errors %3$d.', 'storybreeze' ),
							$p_created,
							$p_updated,
							$p_errors
						)
					);
					?>
				</p>
				<?php if ( 'import_demo_content' === $action_done ) : ?>
					<p>
						<?php
						echo esc_html(
							sprintf(
								/* translators: 1: created count, 2: updated count, 3: error count. */
								__( 'Blog posts import: Created %1$d, Updated %2$d, Errors %3$d.', 'storybreeze' ),
								$b_created,
								$b_updated,
								$b_errors
							)
						);
						?>
					</p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<h2><?php echo esc_html__( 'Starter Content (Recommended)', 'storybreeze' ); ?></h2>
		<p><?php echo esc_html__( 'Imports pages, menus, and starter blog posts.', 'storybreeze' ); ?></p>
		<form method="post" action="">
			<?php wp_nonce_field( 'storybreeze_import_demo_pages', 'storybreeze_import_nonce' ); ?>
			<input type="hidden" name="storybreeze_setup_action" value="import_demo_content" />
			<?php submit_button( __( 'Import Starter Content', 'storybreeze' ), 'primary', 'submit', false ); ?>
		</form>

		<h2><?php echo esc_html__( 'Pages + Menus Only', 'storybreeze' ); ?></h2>
		<p><?php echo esc_html__( 'Imports and assigns demo pages and professional header/footer menus.', 'storybreeze' ); ?></p>
		<form method="post" action="">
			<?php wp_nonce_field( 'storybreeze_import_demo_pages', 'storybreeze_import_nonce' ); ?>
			<input type="hidden" name="storybreeze_setup_action" value="import_demo_pages" />
			<?php submit_button( __( 'Import Pages and Menus', 'storybreeze' ), 'secondary', 'submit', false ); ?>
		</form>
	</div>
	<?php
}
