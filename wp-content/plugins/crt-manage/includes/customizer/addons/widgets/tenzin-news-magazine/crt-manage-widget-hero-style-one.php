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
class CRT_Manage_News_Hero_Style_One extends Widget_Base {

	public function get_name() {
		return 'crtmanage-hero-style-one';
	}

	public function get_title() {
		return __( 'Hero Style 1', 'crt-manage' );
	}

	public function get_icon() {
		return 'eicon-post-list';
    }

	public function get_categories() {
		return [ 'crt_manage_theme' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'hero_style_one_general_settings',
			[
				'label' => __( 'General Settings', 'crt-manage' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'hero_style_one_section_left_post',
            [
                'label' => __( 'Left Post', 'crt-manage' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'hero_style_one_left_post',
            [
                'label'     => __( 'Select Post', 'crt-manage' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => $this->crt_manage_post_id(),
                'multiple' => true,
                'default'	=> ''
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'hero_style_one_section_center_post',
            [
                'label' => __( 'Center Post', 'crt-manage' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'hero_style_one_center_post',
            [
                'label'     => __( 'Select Post', 'crt-manage' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->crt_manage_post_id(),
                'default'	=> ''
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'hero_style_one_section_right_post',
            [
                'label' => __( 'Right Post', 'crt-manage' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'hero_style_one_right_post',
            [
                'label'     => __( 'Select Post', 'crt-manage' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => $this->crt_manage_post_id(),
                'multiple' => true,
                'default'	=> ''
            ]
        );
        $this->end_controls_section();
    }

    public function crt_manage_get_categories() {
        $cats = get_terms(array(
            'taxonomy' => 'category',
            'hide_empty' => true,
        ));

        $catarr = [];

        foreach( $cats as $singlecat ) {
            $catarr[$singlecat->term_id] = __($singlecat->name, 'crt-manage');
        }

        return $catarr;
    }

    public function crt_manage_get_tags() {
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
    public function crt_manage_post_id(){
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => -1,
        );

        $crt_manage_post = new WP_Query( $args );

        $postarray = [];

        while( $crt_manage_post->have_posts() ){
            $crt_manage_post->the_post();
            $postarray[get_the_Id()] = get_the_title();
        }
        wp_reset_postdata();
        return $postarray;
    }

	protected function render() {
        $settings = $this->get_settings_for_display();
        $hero_style_one_left_post = $settings['hero_style_one_left_post'];
        $hero_style_one_center_post = $settings['hero_style_one_center_post'];
        $hero_style_one_right_post = $settings['hero_style_one_right_post'];
    ?>
        <section class="area-feature">
            <div class="container">
                <div class="border-left-right p-lg-4 p-md-3 p-0 border-md-none border-sm-none">
                    <div class="row">
                        <div class="col-md-3 order-2 order-md-1">
                            <?php if(!empty($hero_style_one_left_post)): ?>
                            <?php foreach ( $hero_style_one_left_post as $post_id ) {
                                $post = get_post( $post_id );
                                $date = date('F d, Y', strtotime($post->post_date));
                                $get_permalink = get_post_permalink( $post );
                                $get_thumbnail_url = get_the_post_thumbnail_url( $post );
                            ?>
                            <div class="area-feature__item">
                                <div class="area-feature__item--inner">
                                    <a href="<?php echo esc_attr($get_permalink); ?>">
                                        <figure class="lazy ratio32" data-src="<?php echo esc_attr($get_thumbnail_url); ?>"></figure>
                                    </a>
                                    <div class="area-feature__content">
                                        <div class="entry mt-2">
                                            <span class="entry__date"><?php echo esc_html($date); ?></span>
                                            <span class="entry__category"><?php tenzin_news_magazine_entry($post_id) ?></span>
                                        </div>
                                        <h5><a href="<?php echo esc_attr($get_permalink); ?>"><?php echo esc_html($post->post_title); ?></a></h5>
                                        <div class="area-feature__sub"><?php echo tenzin_news_magazine_excerpt_custom(20, $post_id); ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 order-1 order-md-2 mb-md-0 mb-3">
                            <?php if(!empty($hero_style_one_center_post)): ?>
                            <?php
                                $post = get_post( $hero_style_one_center_post );
                                $date = date('F d, Y', strtotime($post->post_date));
                                $get_permalink = get_post_permalink( $post );
                                $get_thumbnail_url = get_the_post_thumbnail_url( $post );
                            ?>
                            <div class="area-feature__item">
                                <div class="area-feature__item--inner">
                                    <a href="<?php echo esc_attr($get_permalink); ?>">
                                        <figure class="lazy ratio32" data-src="<?php echo esc_attr($get_thumbnail_url); ?>"></figure>
                                    </a>
                                    <div class="area-feature__content">
                                        <h5 class="area-feature__title"><a href="<?php echo esc_attr($get_permalink); ?>"><?php echo esc_html($post->post_title); ?></a></h5>
                                        <div class="area-feature__sub"><?php echo tenzin_news_magazine_excerpt_custom(30, $post_id); ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-3 order-3 order-md-3">
                        <?php if(!empty($hero_style_one_left_post)): ?>
                            <?php foreach ( $hero_style_one_right_post as $post_id ) {
                                $post = get_post( $post_id );
                                $date = date('F d, Y', strtotime($post->post_date));
                                $get_permalink = get_post_permalink( $post );
                                $get_thumbnail_url = get_the_post_thumbnail_url( $post );
                                ?>
                                <div class="area-feature__item">
                                    <div class="area-feature__item--inner">
                                        <a href="<?php echo esc_attr($get_permalink); ?>">
                                            <figure class="lazy ratio32" data-src="<?php echo esc_attr($get_thumbnail_url); ?>"></figure>
                                        </a>
                                        <div class="area-feature__content">
                                            <div class="entry mt-2">
                                                <span class="entry__date"><?php echo esc_html($date); ?></span>
                                                <span class="entry__category"><?php tenzin_news_magazine_entry($post_id) ?></span>
                                            </div>
                                            <h5><a href="<?php echo esc_attr($get_permalink); ?>"><?php echo esc_html($post->post_title); ?></a></h5>
                                            <div class="area-feature__sub">
                                                <?php echo tenzin_news_magazine_excerpt_custom(20, $post_id); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
	}

    public function get_script_depends() {
        if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
            return [ 'crt-manage-lazy-load' ];
        } else {
            return [];
        }
    }
}