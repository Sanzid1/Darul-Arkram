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
class CRT_Manage_News_Area_Post_Six extends Widget_Base {

	public function get_name() {
		return 'crtmanage-post-six';
	}

	public function get_title() {
		return __( 'Post Six', 'crt-manage' );
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
				'label' => __( 'Blog Six Post', 'crt-manage' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
            'post_six_heading',
            [
                'label'     => __( 'Heading', 'crt-manage' ),
                'type'      => Controls_Manager::TEXT,
                'default'	=> 'Technology'
            ]
        );
        $this->add_control(
            'post_six_heading_sub',
            [
                'label'     => __( 'Heading sub', 'crt-manage' ),
                'type'      => Controls_Manager::TEXT,
                'default'	=> 'Topics News And Opinion'
            ]
        );
        $this->add_control(
            'post_six_list',
            [
                'label'     => __( 'Select Post List', 'crt-manage' ),
                'type'      => Controls_Manager::SELECT2,
                'options'   => $this->crt_manage_post_id(),
                'multiple' => true,
                'default'	=> ''
            ]
        );

        $this->end_controls_section();
    }

    // Get Post
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
        $post_six_heading = $settings['post_six_heading'];
        $post_six_heading_sub = $settings['post_six_heading_sub'];
        $post_six_list = $settings['post_six_list'];
        ?>
        <section class="area-post-six">
            <div class="container">
                <div class="border-left-right p-lg-4 p-md-3 p-0 border-md-none border-sm-none">
                    <div class="row">
                        <div class="col-12">
                            <div class="heading-default">
                                <h2 class="heading-default__title"><?php echo esc_html($post_six_heading); ?></h2>
                                <span class="heading-default__sub"><?php echo esc_html($post_six_heading_sub); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php if(!empty($post_six_list)): ?>
                        <?php foreach ($post_six_list as $post_id):
                            $post = get_post( $post_id );
                            $date = date('F d, Y', strtotime($post->post_date));
                            $get_permalink = get_post_permalink( $post );
                            $get_thumbnail_url = get_the_post_thumbnail_url( $post );
                        ?>
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <a href="<?php echo esc_attr($get_permalink); ?>">
                                <figure class="post-type-two__image lazy ratio32" data-src="<?php echo esc_attr($get_thumbnail_url); ?>"></figure>
                            </a>
                            <div class="entry mt-3">
                                <span class="entry__date"><?php echo esc_html($date); ?></span>
                                <span class="entry__category"><?php tenzin_news_magazine_entry($post_id) ?></span>
                            </div>
                            <h3><a href="<?php echo esc_attr($get_permalink); ?>"><?php echo esc_html($post->post_title); ?></a></h3>
                            <div class="post-type-two__sub">
                                <?php echo tenzin_news_magazine_excerpt_custom(20, $post_id); ?>
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