<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
/**
 *
 * Contact Form Widget .
 *
 */
class CRT_Manage_Contact_Form extends Widget_Base{

	public function get_name() {
		return 'crtmanagecontactform';
	}

	public function get_title() {
		return __( 'Contact Form', 'crt-manage' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'crt_manage_theme' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'gallery_section',
			[
				'label' 	=> __( 'Contact Form', 'crt-manage' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
		);
		 $this->add_control(
			'use_it_as_slider',
			[
				'label' 		=> __( 'Use it as slider ?', 'crt-manage' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'crt-manage' ),
				'label_off' 	=> __( 'Hide', 'crt-manage' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'section_heading',
			[
				'label' 		=> __( 'Allow Section Heading ?', 'crt-manage' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'crt-manage' ),
				'label_off' 	=> __( 'Hide', 'crt-manage' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'section_title',
			[
				'label' 	=> __( 'Title', 'crt-manage' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'The Title', 'crt-manage' ),
			]
        );
        $this->add_control(
			'section_subtitle',
			[
				'label' 	=> __( 'Subtitle', 'crt-manage' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 3,
                'default'  	=> __( 'The Description area', 'crt-manage' ),
                'condition'		=> [ 'section_heading' => [ 'yes']],
			]
        );
        $this->add_control(
			'shadow_title',
			[
				'label' 	=> __( 'Shadow Title', 'crt-manage' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Lets talk?', 'crt-manage' ),
                'condition'		=> [ 'use_it_as_slider!' => [ 'yes']],
			]
        );
        $this->add_control(
			'contact_form_shortcode',
			[
				'label'     => __( 'Contact Form Shortcode', 'crt-manage' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows'		=> 2,
			]
		);

		$this->add_control(
			'bg_image',
			[
				'label' 		=> __( 'Banner Background Image', 'crt-manage' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
        
		$this->end_controls_section();

		 $this->start_controls_section(
			'phone_section',
			[
				'label' 	=> __( 'Phone Info', 'crt-manage' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'phone_contact_label',
			[
				'label'     => __( 'Phone Label', 'crt-manage' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Call Now:', 'crt-manage' )
			]
        );
        $this->add_control(
			'phone_contact_info',
			[
				'label'     => __( 'Phone Info', 'crt-manage' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( '+1 504-899-8221', 'crt-manage' )
			]
        );
        $this->add_control(
			'phone_contact_info2',
			[
				'label'     => __( 'Phone Info 2', 'crt-manage' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( '+1 504-899-8221', 'crt-manage' )
			]
        );
        $this->add_control(
			'phone_icon',
			[
				'label'     => __( 'Icon Class For Phone', 'crt-manage' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( '<i class="fas fa-phone-alt"></i>', 'crt-manage' )
			]
        );
        $this->end_controls_section();


        $this->start_controls_section(
			'email_section',
			[
				'label' 	=> __( 'Email Info', 'crt-manage' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
		$this->add_control(
			'email_contact_label',
			[
				'label'     => __( 'Email Label', 'crt-manage' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Email Now:', 'crt-manage' )
			]
        );
        $this->add_control(
			'email_contact_info',
			[
				'label'     => __( 'Email Info', 'crt-manage' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'info@ambrox.com', 'crt-manage' )
			]
        );
        $this->add_control(
			'email_contact_info2',
			[
				'label'     => __( 'Email Info 2', 'crt-manage' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'info@ambrox.com', 'crt-manage' )
			]
        );
        $this->add_control(
			'email_icon',
			[
				'label'     => __( 'Icon Class For Email', 'crt-manage' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( '<i class="fas fa-envelope-open-text"></i>', 'crt-manage' )
			]
        );
        $this->end_controls_section();
        

        $this->start_controls_section(
			'address_section',
			[
				'label' 	=> __( 'Adress Info', 'crt-manage' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
		$this->add_control(
			'address_contact_label',
			[
				'label'     => __( 'Address Label', 'crt-manage' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Location:', 'crt-manage' )
			]
        );
        $this->add_control(
			'address_contact_info',
			[
				'label'     => __( 'Address Info', 'crt-manage' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( '1403 Washington Ave, New Orlea <br> ns, LA 70130 United States', 'crt-manage' )
			]
        );
        $this->add_control(
			'address_icon',
			[
				'label'     => __( 'Icon Class For Address', 'crt-manage' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( '<i class="fas fa-map-marker-alt"></i>', 'crt-manage' )
			]
        );
        $this->end_controls_section();
		/*-----------------------------------------features styling------------------------------------*/

		$this->start_controls_section(
			'overview_con_styling',
			[
				'label' 	=> __( 'Heading Styling', 'crt-manage' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->start_controls_tabs(
			'style_tabs2'
		);


		$this->start_controls_tab(
			'style_normal_tab2',
			[
				'label' => esc_html__( 'Title', 'crt-manage' ),
			]
		);
        $this->add_control(
			'overview_title_color',
			[
				'label' 		=> __( 'Color', 'crt-manage' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} h2'	=> '--color-heading: {{VALUE}}!important;'
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_title_typography',
		 		'label' 		=> __( 'Typography', 'crt-manage' ),
		 		'selector' 	=> '{{WRAPPER}} h2',
			]
		);

        $this->add_responsive_control(
			'overview_title_margin',
			[
				'label' 		=> __( 'Margin', 'crt-manage' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'overview_title_padding',
			[
				'label' 		=> __( 'Padding', 'crt-manage' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
		$this->end_controls_tab();

		//--------------------secound--------------------//

		$this->start_controls_tab(
			'style_hover_tab2',
			[
				'label' => esc_html__( 'Subtitle', 'crt-manage' ),
			]
		);
		$this->add_control(
			'overview_content_color',
			[
				'label' 		=> __( 'Color', 'crt-manage' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .contact-form-box p'	=> 'color: {{VALUE}}!important;',
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'overview_content_typography',
		 		'label' 		=> __( 'Typography', 'crt-manage' ),
		 		'selector' 	=> '{{WRAPPER}} .contact-form-box p',
			]
		);

        $this->add_responsive_control(
			'overview_content_margin',
			[
				'label' 		=> __( 'Margin', 'crt-manage' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .contact-form-box p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'overview_content_padding',
			[
				'label' 		=> __( 'Padding', 'crt-manage' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .contact-form-box p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

		$this->end_controls_tab();


		$this->end_controls_tabs();
		$this->end_controls_section();

		//---------------------------------------Button Style---------------------------------------//

		$this->start_controls_section(
			'button_style_section',
			[
				'label' 	=> __( 'Button Style', 'crt-manage' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'button_color',
			[
				'label' 		=> __( 'Button Color', 'crt-manage' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .contact-content form button' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_control(
			'button_color_hover',
			[
				'label' 		=> __( 'Button Color Hover', 'crt-manage' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .contact-content form button:hover' => 'color: {{VALUE}}!important;',
                ],
			]
        );

        $this->add_control(
			'button_bg_color',
			[
				'label' 		=> __( 'Button Background Color', 'crt-manage' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .contact-content form button' => 'background:{{VALUE}}!important;',
                ],
			]
        );

        $this->add_control(
			'button_bg_hover_color',
			[
				'label' 		=> __( 'Button Background Hover Color', 'crt-manage' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .contact-content form button::after' => 'background-color:{{VALUE}}',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border',
				'label' 	=> __( 'Border', 'crt-manage' ),
                'selector' 	=> '{{WRAPPER}} .contact-content form button',
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border_hover',
				'label' 	=> __( 'Border Hover', 'crt-manage' ),
                'selector' 	=> '{{WRAPPER}} .contact-content form button:hover',
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography',
				'label' 	=> __( 'Button Typography', 'crt-manage' ),
                'selector' 	=> '{{WRAPPER}} .contact-content form button',
			]
        );

        $this->add_responsive_control(
			'button_margin',
			[
				'label' 		=> __( 'Button Margin', 'crt-manage' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .contact-content form button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
        );

        $this->add_responsive_control(
			'button_padding',
			[
				'label' 		=> __( 'Button Padding', 'crt-manage' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .contact-content form button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
        $this->add_responsive_control(
			'button_border_radius',
			[
				'label' 		=> __( 'Button Border Radius', 'crt-manage' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .contact-content form button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Button Shadow', 'crt-manage' ),
				'selector' => '{{WRAPPER}} .contact-content form button',
			]
		);
        $this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		echo '<!-----------------------Start Contact Form----------------------->';

		if( $settings['use_it_as_slider'] == 'yes' ){
			echo '<div class="swiper-slide bg-cover" style="background: url('.esc_url($settings['bg_image']['url']).');">';
                echo '<div class="container">';
                    echo '<div class="contact-content">';
                        echo '<div class="row align-center">';
                            echo '<div class="col-lg-7 contact-form-box mb-md-50 mb-xs-50">';
                                echo '<div class="form-box mt-50">';
                                    if(!empty($settings['section_title'])){
		                              	echo '<h2>'.esc_html($settings['section_title']).'</h2>';
		                            }
		                            		                            
		                            if( ! empty( $settings['contact_form_shortcode'] ) ){
										echo do_shortcode( $settings['contact_form_shortcode'] );
									}  
                                echo '</div>';
                            echo '</div>';
        
                            echo '<div class="col-lg-4 offset-lg-1">';
		                        echo '<div class="content">';
		                            echo '<ul>';
		                            if(!empty($settings['email_contact_label'] && $settings['email_contact_info'] && $settings['email_icon'])){
						            	$email      	= $settings['email_contact_info'];
					                    $email          = is_email( $email );

					                    $email2      	= $settings['email_contact_info2'];
					                    $email2          = is_email( $email2 );

					                    $replace        = array(' ','-',' - ');
					                    $with           = array('','','');
					                    $emaillurl       = str_replace( $replace, $with, $email );
					                    $emaillurl2       = str_replace( $replace, $with, $email2 );

						                echo '<li class="contact-info-list wow fadeInUp">';
						                    echo '<div class="icon">'.wp_kses_post($settings['email_icon']).'</div>';
						                    echo '<div class="info">';
						                        echo '<p>'.esc_html($settings['email_contact_label']).'</p>';
						                        echo '<h5>';
						                        	echo '<a href="'.esc_attr( 'mailto:'.$emaillurl ).'">'.esc_html($settings['email_contact_info']).'</a><br>';
						                        	echo '<a href="'.esc_attr( 'mailto:'.$emaillurl2 ).'">'.esc_html($settings['email_contact_info2']).'</a>';
						                        echo '</h5>';
						                    echo '</div>';
						                echo '</li>';
						            }
						            if(!empty($settings['address_contact_label'] && $settings['address_contact_info'] && $settings['address_icon'])){
						                echo '<li class="contact-info-list wow fadeInUp" data-wow-delay="300ms">';
						                    echo '<div class="icon">'.wp_kses_post($settings['address_icon']).'</div>';
						                    echo '<div class="info">';
						                        echo '<p>'.esc_html($settings['address_contact_label']).'</p>';
						                        echo '<h5>'.wp_kses_post($settings['address_contact_info']).'</h5>';
						                    echo '</div>';
						                echo '</li>';
						            }
						            if(!empty($settings['phone_contact_label'] && $settings['phone_contact_info'] && $settings['phone_icon'])){

					            		$phone    		= $settings['phone_contact_info'];
					            		$phone2    		= $settings['phone_contact_info2'];
					                    $replace        = array(' ','-',' - ');
					                    $with           = array('','','');
					                    $phonelurl       = str_replace( $replace, $with, $phone );
					                    $phonelurl2       = str_replace( $replace, $with, $phone2 );

						                echo '<li class="contact-info-list wow fadeInUp" data-wow-delay="500ms">';
						                    echo '<div class="icon">'.wp_kses_post($settings['phone_icon']).'</div>';
						                    echo '<div class="info">';
						                        echo '<p>'.esc_html($settings['phone_contact_label']).'</p>';
						                        echo '<h5>';
						                        echo '<a href="'.esc_attr( 'tel:'.$phonelurl ).'">'.esc_html($settings['phone_contact_info']).'</a><br>';
						                        echo '<a href="'.esc_attr( 'tel:'.$phonelurl2 ).'">'.esc_html($settings['phone_contact_info2']).'</a>';
						                        echo '</h5>';
						                    echo '</div>';
						                echo '</li>';
						            }
		                            echo '</ul>';
		                        echo '</div>';
		                    echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
		}else{
			echo '<div class="contact-area shape-less default-padding overflow-hidden">';
			if(!empty($settings['shadow_title'])){
              	echo '<h2 class="text-shade">'.esc_html($settings['shadow_title']).'</h2>';
            }
	        
	        echo '<div class="container">';
	            echo '<div class="contact-content">';
	                echo '<div class="row align-center">';


	                    echo '<div class="col-lg-7 contact-form-box mb-md-50 mb-xs-50">';
	                        echo '<div class="form-box">';
	                            if(!empty($settings['section_title'])){
	                              	echo '<h2>'.esc_html($settings['section_title']).'</h2>';
	                            }
	                            if(!empty($settings['section_subtitle'])){
	                               	echo '<p>'.esc_html($settings['section_subtitle']).'</p>';
	                            } 
	                            echo '<div class="devider"></div>';
	                            if( ! empty( $settings['contact_form_shortcode'] ) ){
									echo do_shortcode( $settings['contact_form_shortcode'] );
								}  
	                        echo '</div>';
	                    echo '</div>';

	                    echo '<div class="col-lg-4 offset-lg-1 info">';
	                        echo '<div class="content">';
	                            echo '<ul>';
	                            if(!empty($settings['email_contact_label'] && $settings['email_contact_info'] && $settings['email_icon'])){
					            	$email      	= $settings['email_contact_info'];
				                    $email          = is_email( $email );

				                    $email2      	= $settings['email_contact_info2'];
				                    $email2          = is_email( $email2 );

				                    $replace        = array(' ','-',' - ');
				                    $with           = array('','','');
				                    $emaillurl       = str_replace( $replace, $with, $email );
				                    $emaillurl2       = str_replace( $replace, $with, $email2 );

					                echo '<li class="contact-info-list wow fadeInUp">';
					                    echo '<div class="icon">'.wp_kses_post($settings['email_icon']).'</div>';
					                    echo '<div class="info">';
					                        echo '<p>'.esc_html($settings['email_contact_label']).'</p>';
					                        echo '<h5>';
					                        	echo '<a href="'.esc_attr( 'mailto:'.$emaillurl ).'">'.esc_html($settings['email_contact_info']).'</a><br>';
					                        	echo '<a href="'.esc_attr( 'mailto:'.$emaillurl2 ).'">'.esc_html($settings['email_contact_info2']).'</a>';
					                        echo '</h5>';
					                    echo '</div>';
					                echo '</li>';
					            }
					            if(!empty($settings['address_contact_label'] && $settings['address_contact_info'] && $settings['address_icon'])){
					                echo '<li class="contact-info-list wow fadeInUp" data-wow-delay="300ms">';
					                    echo '<div class="icon">'.wp_kses_post($settings['address_icon']).'</div>';
					                    echo '<div class="info">';
					                        echo '<p>'.esc_html($settings['address_contact_label']).'</p>';
					                        echo '<h5>'.wp_kses_post($settings['address_contact_info']).'</h5>';
					                    echo '</div>';
					                echo '</li>';
					            }
					            if(!empty($settings['phone_contact_label'] && $settings['phone_contact_info'] && $settings['phone_icon'])){

				            		$phone    		= $settings['phone_contact_info'];
				            		$phone2    		= $settings['phone_contact_info2'];
				                    $replace        = array(' ','-',' - ');
				                    $with           = array('','','');
				                    $phonelurl       = str_replace( $replace, $with, $phone );
				                    $phonelurl2       = str_replace( $replace, $with, $phone2 );

					                echo '<li class="contact-info-list wow fadeInUp" data-wow-delay="500ms">';
					                    echo '<div class="icon">'.wp_kses_post($settings['phone_icon']).'</div>';
					                    echo '<div class="info">';
					                        echo '<p>'.esc_html($settings['phone_contact_label']).'</p>';
					                        echo '<h5>';
					                        echo '<a href="'.esc_attr( 'tel:'.$phonelurl ).'">'.esc_html($settings['phone_contact_info']).'</a><br>';
					                        echo '<a href="'.esc_attr( 'tel:'.$phonelurl2 ).'">'.esc_html($settings['phone_contact_info2']).'</a>';
					                        echo '</h5>';
					                    echo '</div>';
					                echo '</li>';
					            }
	                            echo '</ul>';
	                        echo '</div>';
	                    echo '</div>';

	                echo '</div>';
	            echo '</div>';
	        echo '</div>';
	    echo '</div>';
		}
		

		echo '<!-----------------------End Contact Form----------------------->';
	}
}