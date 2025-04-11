<?php 
	$digital_magazine_custom_css ='';

    /*----------------Related Product show/hide -------------------*/

    $digital_magazine_enable_related_product = get_theme_mod('digital_magazine_enable_related_product',1);

    if($digital_magazine_enable_related_product == 0){
        $digital_magazine_custom_css .='.related.products{';
            $digital_magazine_custom_css .='display: none;';
        $digital_magazine_custom_css .='}';
    }

    /*----------------blog post content alignment -------------------*/

    $digital_magazine_blog_Post_content_layout = get_theme_mod( 'digital_magazine_blog_Post_content_layout','Left');
    if($digital_magazine_blog_Post_content_layout == 'Left'){
        $digital_magazine_custom_css .='.ct-post-wrapper .card-item {';
            $digital_magazine_custom_css .='text-align:start;';
        $digital_magazine_custom_css .='}';
    }else if($digital_magazine_blog_Post_content_layout == 'Center'){
        $digital_magazine_custom_css .='.ct-post-wrapper .card-item {';
            $digital_magazine_custom_css .='text-align:center;';
        $digital_magazine_custom_css .='}';
    }else if($digital_magazine_blog_Post_content_layout == 'Right'){
        $digital_magazine_custom_css .='.ct-post-wrapper .card-item {';
            $digital_magazine_custom_css .='text-align:end;';
        $digital_magazine_custom_css .='}';
    }

    /*--------------------------- Footer background image -------------------*/

    $digital_magazine_footer_bg_image = get_theme_mod('digital_magazine_footer_bg_image');
    if($digital_magazine_footer_bg_image != false){
        $digital_magazine_custom_css .='.footer-top{';
            $digital_magazine_custom_css .='background: url('.esc_attr($digital_magazine_footer_bg_image).');';
        $digital_magazine_custom_css .='}';
    }

    /*--------------------------- Go to top positions -------------------*/

    $digital_magazine_go_to_top_position = get_theme_mod( 'digital_magazine_go_to_top_position','Right');
    if($digital_magazine_go_to_top_position == 'Right'){
        $digital_magazine_custom_css .='.footer-go-to-top{';
            $digital_magazine_custom_css .='right: 20px;';
        $digital_magazine_custom_css .='}';
    }else if($digital_magazine_go_to_top_position == 'Left'){
        $digital_magazine_custom_css .='.footer-go-to-top{';
            $digital_magazine_custom_css .='left: 20px;';
        $digital_magazine_custom_css .='}';
    }else if($digital_magazine_go_to_top_position == 'Center'){
        $digital_magazine_custom_css .='.footer-go-to-top{';
            $digital_magazine_custom_css .='right: 50%;left: 50%;';
        $digital_magazine_custom_css .='}';
    }

    /*--------------------------- Woocommerce Product Sale Positions -------------------*/

    $digital_magazine_product_sale = get_theme_mod( 'digital_magazine_woocommerce_product_sale','Right');
    if($digital_magazine_product_sale == 'Right'){
        $digital_magazine_custom_css .='.woocommerce ul.products li.product .onsale{';
            $digital_magazine_custom_css .='left: auto; ';
        $digital_magazine_custom_css .='}';
    }else if($digital_magazine_product_sale == 'Left'){
        $digital_magazine_custom_css .='.woocommerce ul.products li.product .onsale{';
            $digital_magazine_custom_css .='right: auto;';
        $digital_magazine_custom_css .='}';
    }else if($digital_magazine_product_sale == 'Center'){
        $digital_magazine_custom_css .='.woocommerce ul.products li.product .onsale{';
            $digital_magazine_custom_css .='right: 50%; left: 50%; ';
        $digital_magazine_custom_css .='}';
    }

    /*-------------------- Primary Color -------------------*/

	$digital_magazine_primary_color = get_theme_mod('digital_magazine_primary_color', '#FF1843'); // Add a fallback if the color isn't set
	if ($digital_magazine_primary_color) {
		$digital_magazine_custom_css .= ':root {';
		$digital_magazine_custom_css .= '--primary-color: ' . esc_attr($digital_magazine_primary_color) . ';';
		$digital_magazine_custom_css .= '}';
	}