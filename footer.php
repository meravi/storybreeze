<?php
/**
 * Footer template.
 *
 * @package StoryBreeze
 */

?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container footer-grid">
			<div class="footer-column">
				<p class="footer-heading"><?php esc_html_e( 'Quick Links', 'storybreeze' ); ?></p>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'menu_class'     => 'menu footer-menu',
						'container'      => false,
						'fallback_cb'    => 'storybreeze_menu_fallback',
					)
				);
				?>
			</div>

			<div class="footer-column">
				<p class="footer-heading"><?php esc_html_e( 'About StoryBreeze', 'storybreeze' ); ?></p>
				<p><?php esc_html_e( 'A minimal classic WordPress theme focused on clean presentation and readable content sections.', 'storybreeze' ); ?></p>
			</div>

			<div class="footer-column">
				<p class="footer-heading"><?php esc_html_e( 'Customer Care', 'storybreeze' ); ?></p>
				<ul class="footer-list">
					<li><?php esc_html_e( 'Shipping & Delivery', 'storybreeze' ); ?></li>
					<li><?php esc_html_e( 'Returns & Refunds', 'storybreeze' ); ?></li>
					<li><?php esc_html_e( 'Secure Checkout', 'storybreeze' ); ?></li>
				</ul>
			</div>

			<div class="footer-column">
				<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				<?php else : ?>
					<p class="footer-heading"><?php esc_html_e( 'Stay Connected', 'storybreeze' ); ?></p>
					<ul class="footer-list">
						<li><a href="mailto:support@example.com">support@example.com</a></li>
						<li><a href="tel:+10000000000">+1 (000) 000-0000</a></li>
						<li><?php esc_html_e( 'Mon - Fri, 9:00 AM - 6:00 PM', 'storybreeze' ); ?></li>
					</ul>
				<?php endif; ?>
			</div>
		</div>

		<div class="container footer-bottom">
			<p>
				<?php
				echo esc_html(
					sprintf(
						/* translators: %d current year. */
						__( '(c) %d StoryBreeze. All rights reserved.', 'storybreeze' ),
						(int) gmdate( 'Y' )
					)
				);
				?>
			</p>
			<p><?php esc_html_e( 'Powered by WordPress.', 'storybreeze' ); ?></p>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
