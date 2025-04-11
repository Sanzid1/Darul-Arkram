<?php
if ( ! function_exists( 'crt_manage_layout' ) ) :
    /**
     * Return List Array Layout.
     */
    function crt_manage_layout() {
        return array(
            'standard' => __( 'List', 'crt-manage' ),
            'list-large-image' => __( 'List - Image Large', 'crt-manage' ),
            'grid-2-columns' => __( 'Grid 2 columns', 'crt-manage' ),
            'grid-3-columns' => __( 'Grid 3 columns', 'crt-manage' ),
            'grid-4-columns' => __( 'Grid 4 columns', 'crt-manage' ),
            'masonry-2-columns' => __( 'Masonry 2 columns', 'crt-manage' ),
            'masonry-3-columns' => __( 'Masonry 3 columns', 'crt-manage' ),
            'masonry-4-columns' => __( 'Masonry 4 columns', 'crt-manage' ),
        );
    }
endif;

if ( ! function_exists( 'crt_manage_sidebar' ) ) :
    /**
     * Return Sidebar In Theme.
     */
    function crt_manage_sidebar() {
        $sidebars = array();
        foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar) {
            $sidebars[$sidebar['id']] = $sidebar['name'];
        }
        return $sidebars;
    }
endif;

if ( ! function_exists( 'crt_manage_heading_sizes' ) ) :
    /**
     * Return Heading Sizes.
     */
    function crt_manage_heading_sizes() {
        $sizes = array();
        for($i = 1; $i < 3; $i += 0.25) {
            $sizes[$i.'rem'] = $i.' Rem';
        }
        return $sizes;
    }
endif;

if ( ! function_exists( 'crt_manage_heading_px_sizes' ) ) :
    /**
     * Return Heading Sizes.
     */
    function crt_manage_heading_px_sizes() {
        $sizes = array();
        for($i = 10; $i < 80; $i += 2) {
            $sizes[$i.'px'] = $i.' Px';
        }
        return $sizes;
    }
endif;

function crt_manage_control_block_element($settings = array('thumb_size' => true, 'thumb_border' => true, 'heading_size' => true), $prefix = 'crt_manage_hero_col_1', $active_callback = '') {
    $controls = array(
        $prefix . '_thumbnail_size' => array(
            'label'           => esc_html__( 'Thumbnail Background', 'crt-manage' ),
            'def' => 'bg-content',
            'type' => 'select',
            'choices' => array(
                'ratio32' => esc_html__( 'Ratio 3x2', 'crt-manage' ),
                'ratio43' => esc_html__( 'Ratio 4x3', 'crt-manage' ),
                'ratio169' => esc_html__( 'Ratio 16x9', 'crt-manage' ),
                'ratio219' => esc_html__( 'Ratio 21x9', 'crt-manage' ),
                'ratio_auto' => esc_html__( 'Height auto', 'crt-manage' ),
            ),
            'sanitize_callback' => 'crt_manage_sanitize_select',
//            'active_callback' => 'crt_manage_hero_style3',
        ),
        $prefix . '_thumbnail_border' => array(
            'label'           => esc_html__( 'Thumbnail Border Radius', 'crt-manage' ),
            'def' => 'bg-content',
            'type' => 'select',
            'choices' => array(
                '3px' => esc_html__( 'Mini Border Radius', 'crt-manage' ),
                '5px' => esc_html__( 'Large Border Radius', 'crt-manage' ),
                'circle' => esc_html__( 'Circle Border Radius', 'crt-manage' ),
            ),
            'sanitize_callback' => 'crt_manage_sanitize_select',
//            'active_callback' => 'crt_manage_hero_style3',
        ),
        $prefix . '_heading_size' => array(
            'label'           => esc_html__( 'Heading Size', 'crt-manage' ),
            'def' => 'bg-content',
            'type' => 'select',
            'choices' => crt_manage_heading_px_sizes(),
            'sanitize_callback' => 'crt_manage_sanitize_select',
//            'active_callback' => 'crt_manage_hero_style3',
        ),
    );
    return $controls;
}

function crt_manage_update_data($site) {
    global $wpdb;
    $site_client = site_url();
    $query2 = "UPDATE wp_posts SET post_content = REPLACE (post_content, '$site', '$site_client');";
    $query3 = "UPDATE wp_posts SET post_excerpt = REPLACE (post_excerpt, '$site', '$site_client');";
    $query4 = "UPDATE wp_postmeta SET meta_value = REPLACE (meta_value, '$site', '$site_client');";
    $query5 = "UPDATE wp_termmeta SET meta_value = REPLACE (meta_value, '$site','$site_client');";
    $query6 = "UPDATE wp_comments SET comment_content = REPLACE (comment_content, '$site', '$site_client');";
    $query7 = "UPDATE wp_comments SET comment_author_url = REPLACE (comment_author_url, '$site', '$site_client');";
    $query8 = "UPDATE wp_posts SET guid = REPLACE (guid, '$site', '$site_client') WHERE post_type = 'attachment';";

    $result2 = $wpdb->get_results($query2);
    $result3 = $wpdb->get_results($query3);
    $result4 = $wpdb->get_results($query4);
    $result5 = $wpdb->get_results($query5);
    $result6 = $wpdb->get_results($query6);
    $result7 = $wpdb->get_results($query7);
    $result8 = $wpdb->get_results($query8);
}