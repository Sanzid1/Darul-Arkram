<?php

// Check if static home page is enabled.
function crt_manage_is_static_homepage_enabled( $control ) {
    return ( 'page' === $control->manager->get_setting( 'show_on_front' )->value() );
}
function crt_manage_is_hero_v1_section_enabled( $control ) {
    return ( $control->manager->get_setting( 'crt_manage_enable_hero_v1_section' )->value() );
}
function crt_manage_hero_style1($control) {
    return ( 'v1' === $control->manager->get_setting( 'crt_manage_hero_v1_type' )->value() && $control->manager->get_setting( 'crt_manage_enable_hero_v1_section' )->value());
}
function crt_manage_hero_style2($control) {
    return ( 'v2' === $control->manager->get_setting( 'crt_manage_hero_v1_type' )->value() && $control->manager->get_setting( 'crt_manage_enable_hero_v1_section' )->value());
}
function crt_manage_hero_style3($control) {
    return ( 'v3' === $control->manager->get_setting( 'crt_manage_hero_v1_type' )->value() && $control->manager->get_setting( 'crt_manage_enable_hero_v1_section' )->value());
}
function crt_manage_hero_style1_2($control) {
    return (( 'v1' === $control->manager->get_setting( 'crt_manage_hero_v1_type' )->value() || 'v2' === $control->manager->get_setting( 'crt_manage_hero_v1_type' )->value()) && $control->manager->get_setting( 'crt_manage_enable_hero_v1_section' )->value());
}
function crt_manage_is_feature_section_enabled( $control ) {
    return ( $control->manager->get_setting( 'crt_manage_enable_feature_section' )->value() );
}
function crt_manage_is_sidebar_section_enabled( $control ) {
    return ( $control->manager->get_setting( 'crt_manage_enable_post_sidebar_section' )->value() );
}
function crt_manage_is_post_six_section_enabled( $control ) {
    return ( $control->manager->get_setting( 'crt_manage_enable_post_six_section' )->value() );
}
function crt_manage_is_latest_section_enabled( $control ) {
    return ( $control->manager->get_setting( 'crt_manage_enable_latest_section' )->value() );
}
function crt_manage_header_style1( $control ) {
    return ( 'v1' === $control->manager->get_setting( 'crt_manage_header_type' )->value() );
}
function crt_manage_header_style2( $control ) {
    return ( 'v2' === $control->manager->get_setting( 'crt_manage_header_type' )->value() );
}
function crt_manage_header_style1_style2( $control ) {
    return ( 'v2' === $control->manager->get_setting( 'crt_manage_header_type' )->value() || 'v1' === $control->manager->get_setting( 'crt_manage_header_type' )->value() );
}
function crt_manage_general_homepage_option_border_item($control) {
    return ( 'home-border-item' === $control->manager->get_setting( 'crt_manage_general_homepage_options' )->value() );
}
function crt_manage_heading_sub_enable_active($control) {
    return $control->manager->get_setting( 'crt_manage_heading_sub_enable' )->value();
}
function crt_manage_archive_heading_style_color($control) {
    return ('bg-color' === $control->manager->get_setting( 'crt_manage_archive_heading_style' )->value());
}

?>