<?php
/**
 * Entry Options
 *
 * @package crt_manage
 */


$options['crt_manage_entry_option'] = array(
    'panel' => 'crt_manage_theme_options',
    'title'    => esc_html__( 'Entry Options', 'crt-manage' ),
    'control' => array(
        'crt_manage_entry_style' => array(
            'label'           => esc_html__( 'Entry Style', 'crt-manage' ),
            'def' => 'bg-color',
            'type' => 'select',
            'choices' => array(
                'bg-color' => esc_html__( 'Background Color', 'crt-manage' ),
                'color' => esc_html__( 'Color', 'crt-manage' ),
            ),
            'sanitize_callback' => 'crt_manage_sanitize_select',
        ),
        'crt_manage_entry_font' => array(
            'label'           => esc_html__( 'Entry Font Family', 'crt-manage' ),
            'def' => 'Oswald',
            'type' => 'select',
            'choices'  => crt_manage_get_all_google_font_families(),
            'sanitize_callback' => 'crt_manage_sanitize_google_fonts',
        ),
        'crt_manage_entry_date_format' => array(
            'label'           => esc_html__( 'Date format', 'crt-manage' ),
            'def' => 'F d, Y',
            'type' => 'select',
            'choices' => array(
                'd-m-Y' => date('d-m-Y'),
                'd, m, Y' => date('d, m, Y'),
                'Y-m-d' => date('Y-m-d'),
                'Y, m, d' => date('Y, m, d'),
                'F d, Y' => date('F d, Y'),
            ),
            'sanitize_callback' => 'wp_kses_post',
        ),
        'crt_manage_entry_text_transform' => array(
            'label'           => esc_html__( 'Text transform', 'crt-manage' ),
            'def' => 'F d, Y',
            'type' => 'select',
            'choices' => array(
                'capitalize' => esc_html__('capitalize', 'crt-manage'),
                'lowercase' => esc_html__('lowercase', 'crt-manage'),
                'uppercase' => esc_html__('uppercase', 'crt-manage'),
            ),
            'sanitize_callback' => 'wp_kses_post',
        ),
        'crt_manage_entry_text_character' => array(
            'label'           => esc_html__( 'Text Character', 'crt-manage' ),
            'def' => '•',
            'type' => 'text',
            'sanitize_callback' => 'wp_kses_post',
        ),
        'crt_manage_entry_text_color' => array(
            'label'           => esc_html__( 'Color', 'crt-manage' ),
            'def' => '#000',
            'type' => 'select',
            'choices' => array(
                '#000' => __('Black', 'crt-manage'),
                '#666' => __('Grey', 'crt-manage'),
                '#999' => __('Silver', 'crt-manage'),
            ),
            'sanitize_callback' => 'wp_kses_post',
        ),
    )
);