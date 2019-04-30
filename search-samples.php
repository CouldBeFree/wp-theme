<?php
/*
 * Template Name: Search Samples
 */
?>

<?php get_header(); ?>

<div class="samples-wrap">
    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
    <div class="form-wrap">
        <form class="flex" id="label-search">
            <div class="industry-search">
                <label for="select">Search by Industry</label>
                <select id="select">
                    <option value="" disabled selected="selected">Select</option>
                    <option value="empty" class="reset">No Industry</option>
                    <?php
                    $get_industry = array(
                        'posts_per_page'	=> -1,
                        'post_type'			=> 'labels'
                    );
                    $get_items = new WP_Query($get_industry);
                    $categories = get_terms( 'industry-tag',
                        array(
                            'hide_empty'  => 1,
                            'orderby'     => 'name',
                            'order'       => 'ASC',
                            'pad_counts'  => 1
                        ) );
                    foreach( $categories as $category ): ?>
                        <option value="<?php echo $category->name?>"><?php echo $category->name?></option>
                    <?php endforeach; ?>
                    <?php
                    wp_reset_postdata();
                     ?>
                </select>
                <span class="icon-arrow-point-to-right"></span>
            </div>
            <div class="keywords-search flex align-end justify-between">
                <div class="input-holder">
                    <label for="keywords">Search by Product</label>
                    <input name="keywords" id="keywords" placeholder="Enter keywords" type="text" />
                </div>
                <input type="submit" id="search" value=""/>
                <span class="icon-holder"></span>
            </div>
        </form>
        <script>
            var url = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
            var pages_num = '<?php echo $wp_query->max_num_pages; ?>';
        </script>
    </div>
    <div id="result" class="result-block">
        <?php $preloader = get_field('preloader');?>
        <img src="<?php echo $preloader?>" class="preloader hidden" alt="preloader">
        <div class="grid visible"></div>
    </div>
    <div class="pagination-holder flex align-center justify-center">
        <div id="pagination">
        </div>
    </div>
    <div class="background-target" style="background-image: url(<?php echo get_field('bacground_image'); ?>)"></div>
    <div id="scroll-button">
        <span class="icon-up-chevron-button"></span>
    </div>
</div>

<?php get_footer(); ?>
