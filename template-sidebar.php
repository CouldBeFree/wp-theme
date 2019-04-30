<?php
/*
 * Template Name: Sidebar
 */
?>

<?php get_header(); ?>

<main id="main" class="sidebar-page" role="main">
    <div class="sidebar-page__wrapper">
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                <div class="content-wrapper flex justify-between">
                    <div class="content">
                        <?php the_content(); ?>
                    </div>
                    <div class="message-wrap">
                        <div class="request-success">
                            <div class="request-success__content flex align-center justify-center">
                                <?php echo get_field('message_success') ?>
                            </div>
                        </div>
                        <button class="close-message" id="close-message">Request Another Quote</button>
                    </div>
                    <?php  get_template_part('template-parts/sidebar');?>
                </div>
            </article>
        <?php endwhile; ?>
        <?php $form = get_field('form');
        $message = get_field('message_success');
        if($form) :
            ?>
            <div class="form-holder flex justify-between align-center">
                <div class="form-wrapper">
                    <?php echo $form?>
                </div>
                <div class="message-success" id="scroll-target">
                    <div class="message-success__content flex align-center justify-center">
                        <?php echo $message?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php $text = get_field( "additional" );
    if ($text): ?>
        <div class="sidebar-page__wrapper">
            <div class="additional-content">
                <?php echo $text?>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
