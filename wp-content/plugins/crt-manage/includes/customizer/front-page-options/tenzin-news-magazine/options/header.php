<?php
/**
 * Custom Option
 *
 * @package crt_manage
 */

// Social Section Header V1
$options['crt_manage_header_options'] = array(
    'panel' => 'crt_manage_theme_options',
    'title'    => esc_html__( 'Header', 'crt-manage' ),
    'control' => array(
        'crt_manage_header_type' => array(
            'def' => 'v1',
            'label'           => esc_html__( 'Header layout', 'crt-manage' ),
            'type' => 'radio_image',
            'choices' => array(
                'v1' => array(
                    'url' => CRT_MANAGE_URI . '/assets/img/'.$this->crt_manage_theme.'/header-stack3.jpg',
                    'label' => esc_html__( 'Style 1', 'crt-manage' ),
                ),
                'v2' => array(
                    'url' => CRT_MANAGE_URI . '/assets/img/'.$this->crt_manage_theme.'/header-stack4.jpg',
                    'label' => esc_html__( 'Style 2', 'crt-manage' ),
                ),
                'v3' => array(
                    'url' => CRT_MANAGE_URI . '/assets/img/'.$this->crt_manage_theme.'/header-inline.jpg',
                    'label' => esc_html__( 'Style 3', 'crt-manage' ),
                ),
            ),
        ),
        'crt_manage_header_nav_full_width' => array(
            'def' => 'false',
            'label'           => esc_html__( 'Header Nav Fullwidth', 'crt-manage' ),
            'type' => 'checkbox',
            'active_callback' => 'crt_manage_header_style1_style2',
        ),
        'crt_manage_header_nav_style' => array(
            'def' => 'bg-color',
            'label'           => esc_html__( 'Header Nav Style', 'crt-manage' ),
            'type' => 'radio',
            'choices' => array(
                'bg-color' => esc_html__('Background Color','crt-manage'),
                'line' => esc_html__('Line','crt-manage'),
                'line-vertical' => esc_html__('Line Vertical','crt-manage'),
            ),
            'active_callback' => 'crt_manage_header_style1_style2',
        ),
        'crt_manage_header_social' => array(
            'def' => '',
            'type' => 'repeater',
            'sanitize_callback' => 'crt_manage_customizer_repeater_sanitize',
            'repeater_fields' => array(
                'label'   => esc_html__('Social','crt-manage'),
                'intro'   => esc_html__('List social show in navigation','crt-manage'),
                'label_item'   => esc_html__('Social Item','crt-manage'),
                'section' => 'crt_manage_header_options',
                'custom_repeater_link_control' => true,
                'custom_repeater_icon_control' => true,
                'custom_repeater_color_control' => true,
            ),
        ),
        'crt_manage_header_social_style' => array(
            'label'           => esc_html__( 'Social Style', 'crt-manage' ),
            'def' => 'bg-color',
            'type' => 'select',
            'choices' => array(
                'bg-color' => esc_html__('Background Color','crt-manage'),
                'color' => esc_html__('Color','crt-manage'),
                'border-line-solid' => esc_html__('Border Line Solid','crt-manage'),
                'none-border-solid' => esc_html__('None Border Line Solid','crt-manage'),
            ),
            'sanitize_callback' => 'wp_kses_post',
        ),
        'crt_manage_header_social_intro' => array(
            'label'           => esc_html__( 'Intro', 'crt-manage' ),
            'def' => 'Follow us on some social networks above',
            'type' => 'textarea',
            'active_callback' => 'crt_manage_header_style1',
        ),
        'crt_manage_header_right_date_format' => array(
            'label'           => esc_html__( 'Date format', 'crt-manage' ),
            'def' => 'd-m-Y',
            'type' => 'select',
            'choices' => array(
                'd-m-Y' => date('d-m-Y'),
                'F j, Y' => date('F j, Y'),
                'Y-m-d' => date('Y-m-d'),
            ),
            'sanitize_callback' => 'wp_kses_post',
            'active_callback' => 'crt_manage_header_style1_style2',
        ),
        'crt_manage_header_right_vol' => array(
            'label'           => esc_html__( 'Vol', 'crt-manage' ),
            'def' => 'Vol <strong>19</strong>',
            'type' => 'text',
            'sanitize_callback' => 'wp_kses_post',
            'active_callback' => 'crt_manage_header_style1_style2',
        ),
        'crt_manage_header_logo_font' => array(
            'label'           => esc_html__( 'Logo Font Family', 'crt-manage' ),
            'type' => 'select',
            'choices'  => crt_manage_get_all_google_font_families(),
            'sanitize_callback' => 'crt_manage_sanitize_google_fonts',
        ),
        'crt_manage_general_nav_font' => array(
            'label'           => esc_html__( 'Navigation Font Family', 'crt-manage' ),
            'def' => 'Oswald',
            'type' => 'select',
            'choices' => crt_manage_get_all_google_font_families(),
            'sanitize_callback' => 'crt_manage_sanitize_google_fonts',
        ),
        'crt_manage_general_nav_transform' => array(
            'label'           => __( 'Navigation Heading transform', 'crt-manage' ),
            'def' => 'uppercase',
            'type' => 'select',
            'choices' => array(
                'capitalize' => __('Capitalize', 'crt-manage'),
                'lowercase' => __('Lowercase', 'crt-manage'),
                'uppercase' => __('Uppercase', 'crt-manage'),
            ),
            'sanitize_callback' => 'wp_kses_post',
        ),
    )
);