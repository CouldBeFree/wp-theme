<?php
/**
 * theme Theme Customizer
 *
 * @package theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Google map

    $wp_customize->add_section( 'map' , array(
        'title'      => __( 'Map', 'Richmark' ),
        'priority'   => 10
    ) );

    $wp_customize->add_setting( 'map-api' , array(
        'default'   => '',
        'transport' => 'refresh'
    ) );

    $wp_customize->add_control(
        'map-api',
        array(
            'label' => __('Map api', 'mytheme'),
            'section' => 'map',
            'settings' => 'map-api',
            'type' => 'text'
        )
    );

    $wp_customize->add_setting( 'map-zoom' , array(
        'default'   => '',
        'transport' => 'refresh'
    ) );

    $wp_customize->add_control(
        'map-zoom',
        array(
            'label' => __('Zoom', 'mytheme'),
            'section' => 'map',
            'settings' => 'map-zoom',
            'type' => 'text'
        )
    );

    $wp_customize->add_setting( 'latitude' , array(
        'default'   => '',
        'transport' => 'refresh'
    ) );

    $wp_customize->add_control(
        'map',
        array(
            'label' => __('latitude', 'mytheme'),
            'section' => 'map',
            'settings' => 'latitude',
            'type' => 'text'
        )
    );

    $wp_customize->add_setting( 'map-longitude' , array(
        'default'   => '',
        'transport' => 'refresh'
    ) );

    $wp_customize->add_control(
        'map-longitude',
        array(
            'label' => __('longitude', 'mytheme'),
            'section' => 'map',
            'settings' => 'map-longitude',
            'type' => 'text'
        )
    );

	// Adding section header

    $wp_customize->add_section( 'header' , array(
        'title'      => __( 'Header Section', 'Richmark' ),
        'priority'   => 10
    ) );

    // Adding logo

    $wp_customize->add_setting( 'logo' , array(
        'default'   => '',
        'transport' => 'refresh'
    ) );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'logo',
            array(
                'label'      => __( 'Upload a logo', 'Richmark' ),
                'section'    => 'header',
                'settings'   => 'logo'
            )
        )
    );

    // Footer section

    $wp_customize->add_section( 'footer' , array(
        'title'      => __( 'Footer Section', 'Richmark' ),
        'priority'   => 10
    ) );

    // Adding address

    $wp_customize->add_setting( 'address' , array(
        'default'   => '',
        'transport' => 'refresh'
    ) );

    $wp_customize->add_control(
        'footer',
        array(
            'label' => __('Address', 'mytheme'),
            'section' => 'footer',
            'settings' => 'address',
            'type' => 'text'
        )
    );

    // Adding footer sub

    $wp_customize->add_setting( 'trademark' , array(
        'default'   => '',
        'transport' => 'refresh'
    ) );

    $wp_customize->add_control(
        'trademark',
        array(
            'label' => __('Trademark', 'mytheme'),
            'section' => 'footer',
            'settings' => 'trademark',
            'type' => 'text'
        )
    );

    //

    $wp_customize->add_setting( 'middle' , array(
        'default'   => '',
        'transport' => 'refresh'
    ) );

    $wp_customize->add_control(
        'middle',
        array(
            'label' => __('Middle', 'mytheme'),
            'section' => 'footer',
            'settings' => 'middle',
            'type' => 'text'
        )
    );

    //

    $wp_customize->add_setting( 'bottom' , array(
        'default'   => '',
        'transport' => 'refresh'
    ) );

    $wp_customize->add_control(
        'bottom',
        array(
            'label' => __('Bottom', 'mytheme'),
            'section' => 'footer',
            'settings' => 'bottom',
            'type' => 'text'
        )
    );

    // Adding phone

    $wp_customize->add_setting( 'phone' , array(
        'default'   => '',
        'transport' => 'refresh'
    ) );

    $wp_customize->add_control(
        'phone',
        array(
            'label' => __('Phone', 'mytheme'),
            'section' => 'footer',
            'settings' => 'phone',
            'type' => 'text'
        )
    );

    // Adding free phone

    $wp_customize->add_setting( 'free-phone' , array(
        'default'   => '',
        'transport' => 'refresh'
    ) );

    $wp_customize->add_control(
        'free-phone',
        array(
            'label' => __('Free phone', 'mytheme'),
            'section' => 'footer',
            'settings' => 'free-phone',
            'type' => 'text'
        )
    );

    // Adding fax

    $wp_customize->add_setting( 'fax' , array(
        'default'   => '',
        'transport' => 'refresh'
    ) );

    $wp_customize->add_control(
        'fax',
        array(
            'label' => __('Fax', 'mytheme'),
            'section' => 'footer',
            'settings' => 'fax',
            'type' => 'text'
        )
    );

    // Adding email

    $wp_customize->add_setting( 'email' , array(
        'default'   => '',
        'transport' => 'refresh'
    ) );

    $wp_customize->add_control(
        'email',
        array(
            'label' => __('Email', 'mytheme'),
            'section' => 'footer',
            'settings' => 'email',
            'type' => 'text'
        )
    );

    // Add a head scripts
    $wp_customize->add_setting(
        'head-scripts',
        array('default' => '')
    );

    $wp_customize->add_control(
        'head-scripts',
        array(
            'label' => 'Head scripts',
            'section' => 'header',
            'type' => 'textarea',
        )
    );
}
add_action( 'customize_register', 'theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function theme_customize_preview_js() {
	wp_enqueue_script( 'theme_customizer', get_template_directory_uri() . '/assets/scripts/customizer.js', array( 'customize-preview' ), false, true );
}
add_action( 'customize_preview_init', 'theme_customize_preview_js' );
