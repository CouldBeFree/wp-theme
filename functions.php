<?php
/**
 * theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package theme
 */

if ( ! function_exists( 'theme_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function theme_setup() {
        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'menu-1' => esc_html__( 'Primary', 'theme' ),
            'menu-2' => esc_html__( 'Footer menu', 'theme' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );
    }
endif;
add_action( 'after_setup_theme', 'theme_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function theme_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'theme' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function theme_scripts() {
    // Styles
    //wp_enqueue_style( 'theme-style', get_stylesheet_uri() );
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css' );
//	wp_enqueue_style( 'owl', get_template_directory_uri() . '/assets/css/owl.carousel.min.css' );
//	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.theme.default.css' );
    wp_enqueue_style( 'icomoon', get_template_directory_uri() . '/assets/css/icomoon.css' );
    wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css' );
    wp_enqueue_style( 'pagination', get_template_directory_uri() . '/assets/css/pagination.css' );
    wp_enqueue_style( 'normalize', get_template_directory_uri() . '/assets/css/normalize.css' );
    wp_enqueue_style( 'theme-main-style', get_template_directory_uri() . '/assets/dist/main.css' );
    wp_enqueue_style( 'theme-custom-style', get_template_directory_uri() . '/assets/css/custom.css' );
    // Scripts
    wp_enqueue_script( 'slick-script', get_template_directory_uri() . '/assets/scripts/slick.min.js', array('jquery'), false, true );
    // Masonry
    wp_enqueue_script( 'masonry-script', get_template_directory_uri() . '/assets/scripts/masonry.pkgd.min.js', array('jquery'), false, true );
    wp_enqueue_script( 'images-script', get_template_directory_uri() . '/assets/scripts/imagesloaded.pkgd.min.js', array('jquery'), false, true );
    wp_enqueue_script( 'fancybox-script', get_template_directory_uri() . '/assets/scripts/jquery.fancybox.min.js', array('jquery'), false, true );
//    wp_enqueue_script( 'bootstrap-scr', get_template_directory_uri() . '/assets/scripts/bootstrap.min.js', array('jquery'), false, true );
//    wp_enqueue_script( 'boot', get_template_directory_uri() . '/assets/scripts/jquery.bootpag.min.js', array('jquery'), false, true );
    wp_enqueue_script( 'pagination', get_template_directory_uri() . '/assets/scripts/pagination.min.js', array('jquery'), false, true );
//	wp_enqueue_script( 'owl-script', get_template_directory_uri() . '/assets/scripts/owl.carousel.min.js', array('jquery'), false, true );
    wp_enqueue_script( 'theme-script', get_template_directory_uri() . '/assets/scripts/main.js', array('jquery'), false, true );
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

/**
 * Clear WP HEAD
 */
require get_template_directory() . '/include/clear-wp-head.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/include/customizer.php';

/**
 * Create custom post types.
 */
require get_template_directory() . '/include/custom-post-type.php';

// Ajax for labels and shapes

function true_load_posts(){
    $width = $_POST['width'];
    $length = $_POST['length'];
    $diameter = $_POST['diameter'];
    $shape = $_POST['shape'];
    $widthNum = (float)$width;
    $lengthNum = (float)$length;

    $minWidth = $_POST['minWidth'];
    $maxWidth = $_POST['maxWidth'];
    $minLength = $_POST['minLength'];
    $maxLength = $_POST['maxLength'];
    $diameterMax = $_POST['diameterMax'];
    $diameterMin = $_POST['diameterMin'];
    $post_type = $_POST['postType'];

    $minWidthNum = (float)$minWidth;
    $maxWidthNum = (float)$maxWidth;
    $minLengthNum = (float)$minLength;
    $maxLengthNum = (float)$maxLength;
    $maxDiameterNum = (float)$diameterMax;
    $minDiameterNum = (float)$diameterMin;
    $diameterNum = (float)$diameter;

    if($shape == 'circles') {
        $args = array(
            'posts_per_page'	=> -1,
            'post_type'			=> 'circle',
            'meta_query'	=> array(
                array(
                    'key'		=> 'diameter',
                    'type' => 'DECIMAL(10, 5)',
                    'value'		=> array($minDiameterNum, $maxDiameterNum),
                    'compare' => 'BETWEEN'
                )
            )
        );
    } elseif ($shape == 'ovals') {
        $args = array(
            'posts_per_page'	=> -1,
            'post_type'			=> 'oval',
            'meta_query'	=> array(
                'relation' => 'AND',
                array(
                    'key'		=> 'width',
                    'type' => 'DECIMAL(10, 4)',
                    'value'		=>array($minWidthNum, $maxWidthNum),
                    'compare' => 'BETWEEN'
                ),
                array(
                    'key'		=> 'length',
                    'type' => 'DECIMAL(10, 4)',
                    'value'		=> array($minLengthNum, $maxLengthNum),
                    'compare' => 'BETWEEN'
                )
            )
        );
    } elseif ($shape == 'rectangles') {
        $args = array(
            'posts_per_page'	=> -1,
            'post_type'			=> 'rectangle',
            'meta_query'	=> array(
                'relation' => 'AND',
                array(
                    'key'		=> 'width',
                    'type' => 'DECIMAL(10, 4)',
                    'value'		=>array($minWidthNum, $maxWidthNum),
                    'compare' => 'BETWEEN'
                ),
                array(
                    'key'		=> 'length',
                    'type' => 'DECIMAL(10, 4)',
                    'value'		=> array($minLengthNum, $maxLengthNum),
                    'compare' => 'BETWEEN'
                )
            )
        );
    }

    $q = new WP_Query($args);
    if( $q->have_posts() ):?>
        <div class="result" id="scroll-target">
            <div class="entry">
                <h3>Die(s) that match your desired width and length:</h3>
            </div>
            <div class="result__item">
                <h3>Dies .25″ larger or smaller than the width and length entered:</h3>
                <?php while($q->have_posts()): $q->the_post();?>
                    <?php
                    $widthVal = get_field('width');
                    $lengthVal = get_field('length');
                    $cornerRadius = get_field('cornerradius');
                    if($widthVal && $lengthVal && $cornerRadius) :
                        ?>
                        <div class="inner-wrap">
                            <p>Width: <span class="width-result"><?php echo $widthVal?></span></p>
                            <p>Length: <span class="length-result"><?php echo $lengthVal?></span></p>
                            <p>Corner Radius: <span class="corner-result"><?php echo $cornerRadius?></span></p>
                            <p>Die Number: <span class="number"><?php the_title(); ?></span></p>
                        </div>
                    <?php elseif($widthVal && $lengthVal):?>
                        <div class="inner-wrap">
                            <p>Width: <span class="width-result"><?php echo $widthVal?></span></p>
                            <p>Length: <span class="length-result"><?php echo $lengthVal?></span></p>
                            <p>Die Number: <span class="number"><?php the_title(); ?></span></p>
                        </div>
                    <?php else:
                        $diameterVal = get_field('diameter');
                        ?>
                        <div class="inner-wrap circle">
                            <p>Diameter: <span class="diameter-result"><?php echo $diameterVal?></span></p>
                            <p>Die Number: <span class="number"><?php the_title(); ?></span></p>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="result" id="scroll-target">
            <h3>There are no labels to fit your requirements</h3>
        </div>
    <?php endif; ?>
    <?php
    wp_reset_postdata();
    die();
}

add_action('wp_ajax_loadmore', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore', 'true_load_posts');

function get_data () {
    $row = 1;
    if (($handle = fopen("rectangles.csv", "rb", true)) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data);
            $id = wp_insert_post(array(
                'post_title' => $data[0],
                'post_type' => 'Rectangle',
                'post_content' => '',
                'post_status' => 'publish'
            ));
            for ($c = 0; $c < $num; $c++) {
                update_field('dieltr', $data[1], $id);
                update_field('dieno', $data[2], $id);
                update_field('width', $data[3], $id);
                update_field('length', $data[4], $id);
                update_field('cornerradius', $data[5], $id);
            }
            $row++;
        }
        fclose($handle);
    }
}

// Ajax for Samples Library

function search_labels(){
    $industry = $_POST['industry'];
    $keywords = $_POST['keywords'];
    $index = $_POST['index'];

    if(!$keywords && $industry) {
        $search_args = array(
            'posts_per_page'	=> -1,
            'post_type'			=> 'labels',
            'tax_query' => array(
                array (
                    'taxonomy' => 'industry-tag',
                    'field' => 'slug',
                    'terms' => $industry
                )
            ),
//            'paged' => $paged
        );
    } elseif (!$industry && $keywords) {
        $search_args = array(
            'posts_per_page'	=> -1,
            'post_type'			=> 'labels',
            'tax_query' => array(
                array (
                    'taxonomy' => 'keywords-tag',
                    'field' => 'slug',
                    'terms' => $keywords
                ),
//                'paged' => $paged
            )
        );
    } elseif ($industry && $keywords) {
        $search_args = array(
            'posts_per_page'	=> -1,
            'post_type'			=> 'labels',
            'tax_query' => array(
                'relation' => 'AND',
                array (
                    'taxonomy' => 'keywords-tag',
                    'field' => 'slug',
                    'terms' => $keywords
                ),
                array (
                    'taxonomy' => 'industry-tag',
                    'field' => 'slug',
                    'terms' => $industry
                )
            ),
//            'paged' => $paged
        );
    }

    $query = new WP_Query($search_args);
    $arr = array();
    if( $query->have_posts() ):
        while($query->have_posts()): $query->the_post();
            ?>
            <?php while(has_sub_field('label_image')): ?>
                <?php array_push($arr, get_sub_field('image_item'));?>
            <?php endwhile; ?>
        <?php
        endwhile; ?>
        <?php $ref = array_chunk($arr, 20);
        $size = sizeof($ref);
        $test = $ref[$index];?>
        <?php foreach ($test as $value): ?>
        <div class="gutter-sizer"></div>
        <div class="grid-item" data-size="<?php echo $size?>">
            <a href="<?php echo $value?>" data-fancybox="gallery" class="box">
                <img src="<?php echo $value ?>" alt="label">
            </a>
        </div>
    <?php endforeach; ?>

    <?php else : ?>
        <div class="empty">
            <?php echo get_field('error_message', 21);?>
        </div>
    <?php endif;
    wp_reset_postdata();
    die();
}

add_action('wp_ajax_search', 'search_labels');
add_action('wp_ajax_nopriv_search', 'search_labels');

remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );



