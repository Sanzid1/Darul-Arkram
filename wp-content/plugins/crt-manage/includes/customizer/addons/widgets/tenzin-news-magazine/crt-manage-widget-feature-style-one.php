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
class CRT_Manage_News_Feature_Style_One extends Widget_Base {

	public function get_name() {
		return 'crtmanage-feature-style-one';
	}

	public function get_title() {
		return __( 'Feature Style 1', 'crt-manage' );
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
				'label' => __( 'Feature V1', 'crt-manage' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
            'feature_style_one_heading',
            [
                'label'     => __( 'Heading', 'crt-manage' ),
                'type'      => Controls_Manager::TEXT,
                'default'	=> 'World'
            ]
        );
        $this->add_control(
            'feature_style_one_heading_sub',
            [
                'label'     => __( 'Heading sub', 'crt-manage' ),
                'type'      => Controls_Manager::TEXT,
                'default'	=> 'Topics News And Opinion'
            ]
        );

        $this->add_control(
            'feature_style_one_post',
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
        $feature_style_one_heading = $settings['feature_style_one_heading'];
        $feature_style_one_heading_sub = $settings['feature_style_one_heading_sub'];
        $feature_style_one_post = $settings['feature_style_one_post'];
    ?>
        <section class="area-post-nine">
            <div class="container">
                <div class="border-left-right p-lg-4 p-md-3 p-0 border-md-none border-sm-none">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading-default">
                                <h2 class="heading-default__title"><?php echo esc_html($feature_style_one_heading); ?></h2>
                                <?php if(!empty($feature_style_one_heading_sub)): ?>
                                    <span class="heading-default__sub"><?php echo esc_html($feature_style_one_heading_sub); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php if(!empty($feature_style_one_post)): ?>
                            <?php foreach ($feature_style_one_post as $post_id):
                                $post = get_post( $post_id );
                                $date = date('F d, Y', strtotime($post->post_date));
                                $get_permalink = get_post_permalink( $post );
                                $get_thumbnail_url = get_the_post_thumbnail_url( $post );
                            ?>
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="row">
                                        <div class="col-5 pe-1">
                                            <a href="<?php echo esc_attr($get_permalink); ?>">
                                                <figure class="post-type-one__image lazy ratio43" data-src="<?php echo esc_attr($get_thumbnail_url); ?>"></figure>
                                            </a>
                                        </div>
                                        <div class="col-7">
                                            <div class="entry m-0 mb-2">
                                                <span class="entry__date"><?php echo esc_html($date); ?></span>
                                                <span class="entry__category"><?php tenzin_news_magazine_entry($post_id) ?></span>
                                            </div>
                                            <h6><a href="<?php echo esc_attr($get_permalink); ?>"><?php echo esc_html($post->post_title); ?></a></h6>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </section>
        <?php
	}
}