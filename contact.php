<?php
/*
 * Template Name: Contact
 */
?>

<?php get_header(); ?>

	<main id="main" class="page-contact" role="main">
        <div class="page-contact__wrapper">
            <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
        </div>
        <div class="page-contact__wrapper flex justify-between">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="page-contact__left">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; ?>
            <div class="page-contact__right">
                <?php echo get_field('form') ?>
            </div>
        </div>
        <div class="page-contact__wrapper">
            <div class="message-success" id="scroll-target">
                <?php echo get_field('message_success') ?>
            </div>
        </div>
	</main>

<?php get_footer(); ?>