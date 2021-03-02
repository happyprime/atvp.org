<?php

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'atvp' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
		<?php if ( is_front_page() ) : ?>
			<h1 class="site-title"><?php get_template_part( 'template-parts/logo' ); ?></h1>
		<?php else : ?>
			<p class="site-title"><?php get_template_part( 'template-parts/logo' ); ?></p>
		<?php endif; ?>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->

	<nav id="site-navigation" class="main-navigation">
		<button class="menu-toggle" hidden>
			<span class="icon-close"><?php ATVP\TemplateTags\svg( 'close' ); ?></span>
			<span class="icon-menu"><?php ATVP\TemplateTags\svg( 'menu' ); ?></span>
			<?php esc_html_e( 'Menu', 'atvp' ); ?>
		</button>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'container'      => '',
				'fallback_cb'    => false,
			)
		);
		?>
	</nav><!-- #site-navigation -->
