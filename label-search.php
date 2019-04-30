<?php
/*
 * Template Name: Label Search
 */
?>

<?php get_header(); ?>

<main id="main" class="page-main" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="label-search">
            <div class="label-search__wrap">
                <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                <?php
                $bottomText = get_field('bottom_content');
                $bottomImage = get_field('bottom_image');
                $additional_top_text = get_field('additional_top_text');
                $form_inner_content = get_field('form_inner_content');
                $penultimate_content = get_field('penultimate_content');
                ?>
                <?php echo $additional_top_text?>
                <form class="select-shape">
                    <div class="radio-wrap"><label class="radio">
                            <input checked="checked" name="shape" type="radio" value="rectangles" />
                            <span class="label">Rectangles</span>
                        </label>
                        <label class="radio">
                            <input name="shape" type="radio" value="ovals" />
                            <span class="label">Ovals</span>
                        </label>
                        <label class="radio">
                            <input name="shape" type="radio" value="circles" />
                            <span class="label">Circles</span>
                        </label>
                    </div>
                    <?php echo $form_inner_content?>
                    <input class="shape-value" type="text" id="width" placeholder="Width" />
                    <input class="shape-value" type="text" id="length" placeholder="Length" />
                    <input class="shape-value hidden" type="text" id="diameter" placeholder="Diameter" />
                    <input type="submit" class="btn" value="submit" id="submit"/>
                </form>
                <script>
                    var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
                    var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
                </script>
            </div>
            <div class="search">
                <div class="label-search__wrap">
                    <div id="target">
                        <div class="preloader">
                            <img src="<?php echo get_field ('spinner');?>" alt="spinner">
                        </div>
                    </div>
                </div>
            </div>
            <div class="label-search__wrap">
                <?php echo $penultimate_content?>
                <div class="bottom-content flex justify-between">
                    <div class="bottom-content__text">
                        <?php echo $bottomText?>
                    </div>
                    <div class="bottom-content__image">
                        <img src="<?php echo $bottomImage?>" alt="label">
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
