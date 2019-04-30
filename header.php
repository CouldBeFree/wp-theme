<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php get_template_part( 'template-parts/head' ); ?>
</head>

<body <?php body_class("page-body"); ?>>

	<header class="page-header flex justify-between">
        <div class="logo-holder flex justify-center align-center">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <img src="<?php echo get_theme_mod('logo'); ?>" alt="logo">
            </a>
        </div>

		<nav class="main-nav flex justify-between" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_class' => 'main-nav__list', 'container' => false ) ); ?>
		</nav>

	</header>
