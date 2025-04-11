<?php
add_action( 'cmb2_admin_init', 'crt_manage_page_contact' );
/**
 * Define the metabox and field configurations.
 */
function crt_manage_page_contact() {
    /**
     * Initiate the metabox
     */
    $crt_manage_page_contact = new_cmb2_box( array(
        'id'            => 'crt_manage_shortcode_form',
        'title'         => __( 'Extra Form', 'cmb2' ),
        'object_types'  => array( 'page' ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        'show_on'      => array( 'key' => 'page-template', 'value' => 'template-contact.php' ),
    ) );

    $crt_manage_page_contact->add_field( array(
        'name'       => __( 'Shortcode Form', 'cmb2' ),
        'id'         => 'crt_manage_form_text_shortcode_field',
        'type'       => 'text',
    ) );


}