<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
/**
 *
 * Blog Post Widget .
 *
 */
class CRT_Manage_Blog_Post extends Widget_Base {

	public function get_name() {
		return 'crtmanageblogpost';
	}

	public function get_title() {
		return __( 'CRThemes Blog Post', 'crt-manage' );
	}

	public function get_icon() {
		return 'eicon-post-list';
    }

	public function get_categories() {
		return [ 'crt_manage_theme' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'blog_post_section',
			[
				'label' => __( 'Blog Post', 'crt-manage' ),
				'tab' => Controls_Manager::TAB_CONTENT,
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
				'condition'		=> [ 'use_it_as_slider!' => [ 'yes']],
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
			'blog_post_count',
			[
				'label' 	=> __( 'No of Post to show', 'crt-manage' ),
                'type' 		=> Controls_Manager::NUMBER,
                'min'       => 1,
                'max'       => count( get_posts( array('post_type' => 'post', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) ),
                'default'  	=> __( '4', 'crt-manage' )
			]
        );

		$this->add_control(
			'title_count',
			[
				'label' 	=> __( 'Title Length', 'crt-manage' ),
				'type' 		=> Controls_Manager::TEXT,
				'default'  	=> __( '4', 'crt-manage' ),
			]
		);
		$this->add_control(
			'excerpt_count',
			[
				'label' 	=> __( 'Excerpt Length', 'crt-manage' ),
				'type' 		=> Controls_Manager::TEXT,
				'default'  	=> __( '16', 'crt-manage' ),
			]
		);

        $this->add_control(
			'blog_post_order',
			[
				'label' 	=> __( 'Order', 'crt-manage' ),
                'type' 		=> Controls_Manager::SELECT,
                'options'   => [
                    'ASC'   	=> __('ASC','crt-manage'),
                    'DESC'   	=> __('DESC','crt-manage'),
                ],
                'default'  	=> 'DESC'
			]
        );

        $this->add_control(
			'blog_post_order_by',
			[
				'label' 	=> __( 'Order By', 'crt-manage' ),
                'type' 		=> Controls_Manager::SELECT,
                'options'   => [
                    'ID'    	=> __( 'ID', 'crt-manage' ),
                    'author'    => __( 'Author', 'crt-manage' ),
                    'title'    	=> __( 'Title', 'crt-manage' ),
                    'date'    	=> __( 'Date', 'crt-manage' ),
                    'rand'    	=> __( 'Random', 'crt-manage' ),
                ],
                'default'  	=> 'ID'
			]
        );

        $this->add_control(
			'exclude_cats',
			[
				'label' 		=> __( 'Exclude Categories', 'crt-manage' ),
                'type' 			=> Controls_Manager::SELECT2,
                'multiple' 		=> true,
				'options' 		=> $this->ambrox_get_categories(),
			]
        );

        $this->add_control(
			'exclude_tags',
			[
				'label' 		=> __( 'Exclude Tags', 'crt-manage' ),
                'type' 			=> Controls_Manager::SELECT2,
                'multiple' 		=> true,
				'options' 		=> $this->ambrox_get_tags(),
			]
        );

        $this->add_control(
			'exclude_post_id',
			[
				'label'         => __( 'Exclude Post', 'crt-manage' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
				'options'       => $this->ambrox_post_id(),
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
				'condition'		=> [ 'use_it_as_slider' => [ 'yes' ] ],
			]
		);

        $this->end_controls_section();

		

        /*-----------------------------------------META styling------------------------------------*/

		$this->start_controls_section(
			'meta_con_styling',
			[
				'label' 	=> __( 'Meta Styling', 'crt-manage' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->start_controls_tabs(
			'meta_tabs3'
		);


		$this->start_controls_tab(
			'meta_normal_tab3',
			[
				'label' => esc_html__( 'Icon', 'crt-manage' ),
			]
		);
        $this->add_control(
			'meta_title_color',
			[
				'label' 		=> __( 'Icon Color', 'crt-manage' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .blog-area .item .info .meta ul li i'	=> 'color: {{VALUE}}!important;'

				],
			]
        );
        $this->add_control(
			'icon_size',
			[
				'label' 		=> __( 'icon Size', 'crt-manage' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'range' 		=> [
					'%' 	=> [
						'min' 		=> 0,
						'step' 		=> 1,
						'max' 		=> 100,
					],
				],
				'default' 		=> [
					'unit' 			=> 'px',
					'size' 			=> 4,
				],
				'selectors' => [
					'{{WRAPPER}} .blog-area .item .info .meta ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		//--------------------secound--------------------//

		$this->start_controls_tab(
			'meta_hover_tab4',
			[
				'label' => esc_html__( 'Content', 'crt-manage' ),
			]
		);
		$this->add_control(
			'meta_content_color',
			[
				'label' 		=> __( 'Color', 'crt-manage' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .blog-area .item .info .meta ul li, {{WRAPPER}} .blog-area .item .info .meta ul li a'	=> 'color: {{VALUE}}!important;'
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'meta_title_typography',
		 		'label' 		=> __( 'Typography', 'crt-manage' ),
		 		'selector' 	=> '{{WRAPPER}} .blog-area .item .info .meta ul li, {{WRAPPER}} .blog-area .item .info .meta ul li a',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

		

		/*-----------------------------------------Blog Content styling------------------------------------*/

		$this->start_controls_section(
			'blog_con_styling',
			[
				'label' 	=> __( 'Blog Content Styling', 'crt-manage' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->start_controls_tabs(
			'blog_tabs3'
		);


		$this->start_controls_tab(
			'blog_normal_tab3',
			[
				'label' => esc_html__( 'Title', 'crt-manage' ),
			]
		);
        $this->add_control(
			'blog_title_color',
			[
				'label' 		=> __( 'Color', 'crt-manage' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} h4 a'	=> 'color: {{VALUE}}!important;'

				],
			]
        );
        $this->add_control(
			'blog_title_hvr_color',
			[
				'label' 		=> __( 'Hover Color', 'crt-manage' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .blog-area h4 a:hover'	=> 'color: {{VALUE}}!important;'

				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'blog_title_typography',
		 		'label' 		=> __( 'Typography', 'crt-manage' ),
		 		'selector' 	=> '{{WRAPPER}} h4 a',
			]
		);

        $this->add_responsive_control(
			'blog_title_margin',
			[
				'label' 		=> __( 'Margin', 'crt-manage' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h4 a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

        $this->add_responsive_control(
			'blog_title_padding',
			[
				'label' 		=> __( 'Padding', 'crt-manage' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} h4 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
        );
		$this->end_controls_tab();

		//--------------------secound--------------------//

		$this->start_controls_tab(
			'blog_hover_tab4',
			[
				'label' => esc_html__( 'Content', 'crt-manage' ),
			]
		);
		$this->add_control(
			'blog_content_color',
			[
				'label' 		=> __( 'Color', 'crt-manage' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .info p'	=> 'color: {{VALUE}}!important;'
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'blog_content_typography',
		 		'label' 		=> __( 'Typography', 'crt-manage' ),
		 		'selector' 	=> '{{WRAPPER}} .info p',
			]
		);

        $this->add_responsive_control(
			'blog_content_margin',
			[
				'label' 		=> __( 'Margin', 'crt-manage' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .info p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

        $this->add_responsive_control(
			'blog_content_padding',
			[
				'label' 		=> __( 'Padding', 'crt-manage' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .info p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

		$this->end_controls_tab();


		$this->end_controls_tabs();
		$this->end_controls_section();

    }

    public function ambrox_get_categories() {
        $cats = get_terms(array(
            'taxonomy' => 'category',
            'hide_empty' => true,
        ));

        $catarr = [];

        foreach( $cats as $singlecat ) {
            $catarr[$singlecat->term_id] = __($singlecat->name,'crt-manage');
        }

        return $catarr;
    }

    public function ambrox_get_tags() {
        $cats = get_terms(array(
            'taxonomy' => 'post_tag',
            'hide_empty' => true,
        ));

        $catarr = [];

        foreach( $cats as $singlecat ) {
            $catarr[$singlecat->term_id] = __($singlecat->name,'crt-manage');
        }

        return $catarr;
    }

    // Get Specific Post
    public function ambrox_post_id(){
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => -1,
        );

        $ambrox_post = new WP_Query( $args );

        $postarray = [];

        while( $ambrox_post->have_posts() ){
            $ambrox_post->the_post();
            $postarray[get_the_Id()] = get_the_title();
        }
        wp_reset_postdata();
        return $postarray;
    }

	protected function render() {

        $settings = $this->get_settings_for_display();
        $exclude_post = $settings['exclude_post_id'];

        if( !empty( $settings['exclude_cats'] ) && empty( $settings['exclude_tags'] ) && empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'category__not_in'      => $settings['exclude_cats']
            );
        } elseif( !empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'category__not_in'      => $settings['exclude_cats'],
                'tag__not_in'           => $settings['exclude_tags']
            );
        }elseif( !empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'category__not_in'      => $settings['exclude_cats'],
                'tag__not_in'           => $settings['exclude_tags'],
                'post__not_in'          => $exclude_post
            );
        } elseif( !empty( $settings['exclude_cats'] ) && empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'category__not_in'      => $settings['exclude_cats'],
                'post__not_in'          => $exclude_post
            );
        } elseif( empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'tag__not_in'           => $settings['exclude_tags'],
                'post__not_in'          => $exclude_post
            );
        } elseif( empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'tag__not_in'           => $settings['exclude_tags'],
            );
        } elseif( empty( $settings['exclude_cats'] ) && empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'post__not_in'          => $exclude_post
            );
        } else {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true
            );
        }

        $blogpost = new WP_Query( $args );

        if( $blogpost->have_posts() ) {

        	if( $settings['use_it_as_slider'] == 'yes' ){
        		echo '<div class="swiper-slide bg-cover" style="background: url('.esc_url($settings['bg_image']['url']).');">';
                    echo '<div class="container">';
                        echo '<div class="content">';
                            echo '<div class="row align-center">';
                                echo '<div class="col-lg-1 info">';
                                    if(!empty($settings['section_title'])){
		                                echo '<h2 class="curbe-title">'.esc_html($settings['section_title']).'</h2>';
		                            }
                                echo '</div>';

                               echo ' <div class="col-lg-10 offset-lg-1">';
                                    echo '<div class="row">';
			            	
						            	while( $blogpost->have_posts() ) {
						            		$idd = uniqid();

											$blogpost->the_post();

											$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'ambrox_432x324');
											if( get_comments_number() > 1 ){
					                            $comment_text = __( ' Comments', 'crt-manage' );
					                        }else{
					                            $comment_text = __( ' Comment', 'crt-manage' );
					                        }


							                echo '<!-- Single item -->';
							                echo '<div class="blog-style-one mb-30 col-lg-4 col-md-6">';
							                    echo '<div class="item">';
							                    	if(has_post_thumbnail( )){
								                        echo '<div class="thumb">';
								                            echo '<a href="'.get_the_permalink().'"><img src="'.esc_url($featured_img_url).'" alt="Thumb"></a>';
								                        echo '</div>';
								                    }
							                        echo '<div class="info">';
							                            echo '<h4>';
							                                echo '<a href="'.get_the_permalink().'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a>';
							                            echo '</h4>';
							                            echo '<div class="meta">';
							                                echo '<ul>';

							                                    echo '<li>';
							                                        echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'"><i class="fas fa-user-circle"></i> '.esc_html( get_the_author() ).'</a>';
							                                    echo '</li>';
							                                    echo '<li>';
							                                        echo '<a href="'.esc_url( ambrox_blog_date_permalink() ).'"><i class="fas fa-calendar-alt"></i>'.esc_html( get_the_date( 'M d, Y' ) ).'</a>';
							                                    echo '</li>';
							                                echo '</ul>';
							                            echo '</div>';
							                        echo '</div>';
							                    echo '</div>';
							                echo '</div>';
							            }
							            wp_reset_postdata();
						            echo '</div>';
                                echo '</div>';
                                
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
        		
        	}else{
        		echo '<div class="blog-style-one-area blog-area default-padding-top bottom-less">';
			        echo '<div class="container">';
			            echo '<div class="row">';
			                echo '<div class="col-lg-8 offset-lg-2">';
			                    echo '<div class="site-heading text-center">';
			                        if(!empty($settings['section_title'])){
		                              	echo '<h4 class="sub-title">'.esc_html($settings['section_title']).'</h4>';
		                            }
		                            if(!empty($settings['section_subtitle'])){
		                               	echo '<h2 class="title">'.esc_html($settings['section_subtitle']).'</h2>';
		                            } 
		                            echo '<div class="devider"></div>';
			                    echo '</div>';
			                echo '</div>';
			            echo '</div>';
			        echo '</div>';
			        echo '<div class="container">';
			            echo '<div class="row">';
			            	
			            	while( $blogpost->have_posts() ) {
			            		$idd = uniqid();

								$blogpost->the_post();

								$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'ambrox_432x324');
								if( get_comments_number() > 1 ){
		                            $comment_text = __( ' Comments', 'crt-manage' );
		                        }else{
		                            $comment_text = __( ' Comment', 'crt-manage' );
		                        }


				                echo '<!-- Single item -->';
				                echo '<div class="blog-style-one mb-30 col-lg-4 col-md-6">';
				                    echo '<div class="item">';
				                    	if(has_post_thumbnail( )){
					                        echo '<div class="thumb">';
					                            echo '<a href="'.get_the_permalink().'"><img src="'.esc_url($featured_img_url).'" alt="Thumb"></a>';
					                        echo '</div>';
					                    }
				                        echo '<div class="info">';
				                            echo '<h4>';
				                                echo '<a href="'.get_the_permalink().'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a>';
				                            echo '</h4>';
				                            echo '<div class="meta">';
				                                echo '<ul>';

				                                    echo '<li>';
				                                        echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'"><i class="fas fa-user-circle"></i> '.esc_html( get_the_author() ).'</a>';
				                                    echo '</li>';
				                                    echo '<li>';
				                                        echo '<a href="'.esc_url( ambrox_blog_date_permalink() ).'"><i class="fas fa-calendar-alt"></i>'.esc_html( get_the_date( 'M d, Y' ) ).'</a>';
				                                    echo '</li>';
				                                echo '</ul>';
				                            echo '</div>';
				                        echo '</div>';
				                    echo '</div>';
				                echo '</div>';
				            }
				            wp_reset_postdata();
			            echo '</div>';
			        echo '</div>';

			        
			        echo '<!-- End Blog Single Modal -->';

			    echo '</div>';
        	}
        	
        }   
	}
}