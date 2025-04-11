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
class CRT_Manage_News_Area_Post_Sidebar_Two extends Widget_Base {

	public function get_name() {
		return 'crtmanage-post-sidebar-two';
	}

	public function get_title() {
		return __( 'Post Sidebar 2', 'crt-manage' );
	}

	public function get_icon() {
		return 'eicon-post-list';
    }

	public function get_categories() {
		return [ 'crt_manage_theme' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'blog_post_latest_section',
			[
				'label' => __( 'Blog Latest', 'crt-manage' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
            'post_sidebar_two_heading',
            [
                'label'     => __( 'Heading', 'crt-manage' ),
                'type'      => Controls_Manager::TEXT,
                'default'	=> 'Latest'
            ]
        );
        $this->add_control(
            'post_sidebar_two_heading_sub',
            [
                'label'     => __( 'Heading sub', 'crt-manage' ),
                'type'      => Controls_Manager::TEXT,
                'default'	=> 'Topics News And Opinion'
            ]
        );

        $this->add_control(
            'post_sidebar_two_post_per_page',
            [
                'label'     => __( 'Post per page', 'crt-manage' ),
                'type'      => Controls_Manager::NUMBER,
                'default'	=> '10'
            ]
        );

        $this->add_control(
            'post_sidebar_two_layout',
            [
                'label'     => __( 'Layout', 'crt-manage' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => crt_manage_layout(),
                'default'	=> ''
            ]
        );

        $this->add_control(
            'post_sidebar_two_sidebar',
            [
                'label'     => __( 'Sidebar', 'crt-manage' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => array(
                    'left-sidebar' => __( 'Left Sidebar', 'crt-manage' ),
                    'right-sidebar' => __( 'Right Sidebar', 'crt-manage' ),
                    'no-sidebar' => __( 'No Sidebar', 'crt-manage' ),
                ),
                'default'	=> 'right-sidebar'
            ]
        );



        $this->end_controls_section();
    }

    public function pagination_custom( $paged = '', $max_page = '' ) {
        $big = 999999999;
        if( ! $paged ) {
            $paged = get_query_var('page');
        }

        if( ! $max_page ) {
            global $wp_query;
            $max_page = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
        }

        $pagination = paginate_links( array(
            'base'       => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'     => '?paged=%#%',
            'current'    => max( 1, $paged ),
            'total'      => $max_page,
            'mid_size'   => 1,
            'prev_text'  => __( 'Previous' , 'crt-manage'  ),
            'next_text'  => __( 'Next' , 'crt-manage'  ),
            'type'       => 'list'
        ) );

        echo '<div class="pagination"><div class="pagination__inner">'. $pagination .'</div></div>';
    }

    public function get_style_depends() {
        return array('wp-block-library');
    }

    public function crt_manage_custom_layout_sidebar () {
        $settings = $this->get_settings_for_display();
        $category_layout = 'standard';
        $sidebar = 'right-sidebar';
        $col_one = '';
        $col_two = '';
        $category_layout = $settings['post_sidebar_two_layout'];
        $sidebar = $settings['post_sidebar_two_sidebar'];

        if($sidebar == 'right-sidebar') {
            $col_one = 'col-12 col-md-8 mb-3 mb-md-0';
            $col_two = 'col-12 col-md-4 sidebar-fixed';
        } elseif($sidebar == 'left-sidebar') {
            $col_one = 'col-12 col-md-8 mb-3 mb-md-0';
            $col_two = 'col-12 col-md-4 order-first sidebar-fixed';
        }  elseif($sidebar == 'no-sidebar') {
            $col_one = 'col-12';
            $col_two = 'd-none';
        }
        if($category_layout == 'standard') {
            $category_layout = '';
        } elseif($category_layout == 'grid-2-columns') {
            $category_layout = 'grid2';
        } elseif($category_layout == 'grid-3-columns') {
            $category_layout = 'grid3';
        } elseif($category_layout == 'grid-4-columns') {
            $category_layout = 'grid4';
        } elseif($category_layout == 'masonry-2-columns') {
            $category_layout = 'masonry2';
        } elseif($category_layout == 'masonry-3-columns') {
            $category_layout = 'masonry3';
        } elseif($category_layout == 'masonry-4-columns') {
            $category_layout = 'masonry4';
        }

        return array(
            'col_one' => $col_one,
            'col_two' => $col_two,
            'layout' => $category_layout,
        );

    }

	protected function render() {
        $settings = $this->get_settings_for_display();
        $post_sidebar_two_heading = $settings['post_sidebar_two_heading'];
        $post_sidebar_two_heading_sub = $settings['post_sidebar_two_heading_sub'];
        $post_per_page = $settings['post_sidebar_two_post_per_page'];
        ?>
        <section class="area-post-sidebar-two">
            <div class="container">
                <div class="border-left-right p-lg-4 p-md-3 p-0 pb-lg-5 border-md-none border-sm-none">
                    <div class="row">
                        <div class="col-12">
                            <div class="heading-default">
                                <h2 class="heading-default__title"><?php echo esc_html($post_sidebar_two_heading); ?></h2>
                                <span class="heading-default__sub"><?php echo esc_html($post_sidebar_two_heading_sub); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <?php
                            $args = $this->crt_manage_custom_layout_sidebar();
                            $col_one = $args['col_one'];
                            $col_two = $args['col_two'];
                            $layout = $args['layout'];
                            $grid = str_contains($layout, 'masonry');
                        ?>

                        <div class="<?php echo esc_attr($col_one); ?>">
                            <div>
                                <div class="<?php echo esc_attr($grid ? 'grid':'row') ?>">
                                    <?php
                                        $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
                                        $args = array(
                                            'paged'          => $paged,
                                            'posts_per_page' => ( $post_per_page ) ? $post_per_page : 10
                                        );
                                        $loop = new WP_Query( $args );
                                        if ( $loop->have_posts() ) :
                                            while ( $loop->have_posts() ) :
                                                $loop->the_post();
                                                get_template_part( 'template-parts/content', $layout );
                                            endwhile;
                                        endif;
                                        wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                            <?php
                                $this->pagination_custom( $paged, $loop->max_num_pages);
                            ?>
                        </div>
                        <div class="<?php echo esc_attr($col_two); ?>">
                            <?php
                                if ( ! is_active_sidebar( 'sidebar-1' ) ) {
                                    return;
                                }
                            ?>
                            <aside id="secondary" class="widget-area">
                                <?php dynamic_sidebar( 'sidebar-1' ); ?>
                            </aside><!-- #secondary -->
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <?php
	}
}