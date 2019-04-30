<?php
/*
 * Template Name: Home
 */
?>

<?php get_header(); ?>

    <main id="main" class="page-main" role="main">
        <section class="video-section fullscreen" style="background-color: <?php echo get_field('video_background_color')?>;">
            <div class="video-wrap">
                <video muted autoplay playsinline class="video" id="myVideo">
                    <source src="<?php echo get_field("video_large") ?>" type="video/mp4" class="videoUrl">
                </video>
                <script>
                    var source = document.querySelector('.videoUrl');
                    var video_sources = {
                        small: '<?php echo get_field("video_small") ?>',
                        large: '<?php echo get_field("video_large") ?>'
                    };
                    if (window.innerWidth < 1024) {
                        source.setAttribute('src', video_sources.small)
                    }
                </script>
            </div>
        </section>
        <section class="slider fullscreen" id="slider">
            <h2><?php echo get_field('slider_headline'); ?></h2>
            <button class="previous-slide">
                <span class="icon-arrow-point-to-right"></span>
            </button>
            <div class="slider-holder hidden owl-carousel owl-theme">
                <?php get_template_part('template-parts/slider'); ?>
            </div>
            <button class="next-slide">
                <span class="icon-arrow-point-to-right"></span>
            </button>
            <a href="/richmark/search-samples/" class="btn">See more samples</a>
        </section>
        <section class="info flex">
            <div class="left-part">
                <div class="left-part__content">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                    <a href="/richmark/contact-us" class="btn dark">Contact us today</a>
                </div>
            </div>
            <div class="right-part" style="background-image: url(<?php echo get_field('image_background'); ?>)">
                <div class="triangle"></div>
            </div>
            <div class="info-text"><?php echo get_field('info'); ?></div>
        </section>
    </main>

<?php get_footer(); ?>