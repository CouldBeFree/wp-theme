<?php
/*
 * Template Name: Info
 */
?>

<?php get_header(); ?>

<main id="main" class="page-info" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

        <div class="page-content">
            <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
            <?php the_content(); ?>
        </div>
    <?php endwhile; ?>

    <?php $value = get_field('additional_text');

    if($value): ?>
        <div class="additional">
            <div class="additional__content flex justify-between">
                <div class="text">
                    <?php echo $value;?>
                </div>
                <div class="image" style="background-image: url(<?php echo get_field('image');?>)"></div>
            </div>
        </div>
    <?php endif; ?>

</main>

<?php get_footer(); ?>
