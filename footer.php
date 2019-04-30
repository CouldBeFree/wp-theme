	<footer class="page-footer" role="contentinfo">
		<div class="page-footer__inner">
            <div class="logo-wrap">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <img src="<?php echo get_theme_mod('logo'); ?>" alt="logo">
                </a>
            </div>
            <div class="footer-content flex">
                <nav class="footer-nav flex justify-between" role="navigation">
                    <?php wp_nav_menu( array( 'theme_location' => 'menu-2', 'menu_class' => 'footer-nav__list', 'container' => false ) ); ?>
                </nav>
                <div class="info-left">
                    <h4>Find Us</h4>
                    <div class="address">
                        <span><?php echo get_theme_mod('address'); ?></span>
                        <span><?php echo get_theme_mod('middle'); ?></span>
                        <span><?php echo get_theme_mod('bottom'); ?></span>
                    </div>
                    <a href="/richmark/map" class="info-link">Get Directions <span class="icon-arrow-point-to-right"></span></a>
                </div>
                <div class="info-right">
                    <h4>Connect</h4>
                    <p><a href="tel:<?php echo get_theme_mod('phone'); ?>">Phone: <?php echo get_theme_mod('phone'); ?></a></p>
                    <p><a href="tel:<?php echo get_theme_mod('free-phone'); ?>">Toll Free: <?php echo get_theme_mod('free-phone'); ?></a></p>
                    <p><a href="fax:<?php echo get_theme_mod('phone'); ?>">Fax: <?php echo get_theme_mod('fax'); ?></a></p>
                    <a href="mailto:<?php echo get_theme_mod('email'); ?>" class="info-link direction"><?php echo get_theme_mod('email'); ?></a>
                </div>
            </div>
			<p class="copyright">&copy; Copyright <?php echo date("Y"); ?> Richmark Label - All rights reserved.</p>
            <p class="copyright bottom"><?php echo get_theme_mod('trademark'); ?></p>
		</div>
	</footer>

<?php wp_footer(); ?>

</body>
</html>
