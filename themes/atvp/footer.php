<?php
/**
 * The template for displaying the footer
 */
?>

	<footer id="colophon" class="site-footer">
		<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
		<div class="site-company">
			<?php dynamic_sidebar( 'footer-organization' ); ?>
		</div>

		<nav class="footer-nav">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-2',
					'menu_id'        => 'footer-menu',
				)
			);
			?>
			<?php if ( has_nav_menu( 'social' ) ) : ?>
			<ul class="social-menu-wrapper menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'social',
						'items_wrap'     => '%3$s',
						'container'      => false,
						'depth'          => 1,
						'link_before'    => '<span>',
						'link_after'     => '</span>',
						'fallback_cb'    => false,
					)
				);
				?>
			</ul>
			<?php endif; ?>
		</nav>

		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'atvp' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'atvp' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Built by %s', 'atvp' ), '<a href="https://happyprime.co/">Happy Prime</a>' );
				?>
		</div><!-- .site-info -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
