<?php
if (! defined('ABSPATH')) {
    exit;
}

add_action('customize_register', function (WP_Customize_Manager $wp_customize) {

    $wp_customize->add_section('webart_contact_social', array(
        'title'       => __('Contact & Social', 'webart01'),
        'description' => __('Shown in the site footer. Leave a field empty to hide it.', 'webart01'),
        'priority'    => 130,
    ));

    // Email
    $wp_customize->add_setting('webart_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('webart_email', array(
        'label'   => __('Email address', 'webart01'),
        'section' => 'webart_contact_social',
        'type'    => 'email',
    ));

    // Phone
    $wp_customize->add_setting('webart_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('webart_phone', array(
        'label'   => __('Phone number', 'webart01'),
        'section' => 'webart_contact_social',
        'type'    => 'text',
    ));

    // Social URLs
    $socials = array(
        'webart_facebook'  => __('Facebook URL', 'webart01'),
        'webart_instagram' => __('Instagram URL', 'webart01'),
        'webart_linkedin'  => __('LinkedIn URL', 'webart01'),
    );

    foreach ($socials as $id => $label) {
        $wp_customize->add_setting($id, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control($id, array(
            'label'   => $label,
            'section' => 'webart_contact_social',
            'type'    => 'url',
        ));
    }
});
