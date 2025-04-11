<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * Resume Widget .
 *
 */
class CRT_Manage_Resume extends Widget_Base {

	public function get_name() {
		return 'crtmanageresume';
	}

	public function get_title() {
		return __( 'CRThemes Resume', 'crt-manage' );
	}

	public function get_icon() {
		return 'eicon-bullet-list';
    }

	public function get_categories() {
		return [ 'crt_manage_theme' ];
	}

    protected function get_upsale_data() {
        global $theme_premium;
        return [
            'condition' => ! $theme_premium,
            'image' => esc_url( ELEMENTOR_ASSETS_URL . 'images/go-pro.svg' ),
            'image_alt' => esc_attr__( 'Upgrade', 'crt-manage' ),
            'title' => esc_html__( 'Buy Premium', 'crt-manage' ),
            'description' => esc_html__( 'Get the premium version of the widget and grow your website capabilities.', 'crt-manage' ),
            'upgrade_url' => esc_url( 'https://example.com/upgrade-to-pro/' ),
            'upgrade_text' => esc_html__( 'Upgrade Now', 'crt-manage' ),
        ];
    }

	protected function register_controls() {
        global $theme_premium;
        if ($theme_premium) :

		$this->start_controls_section(
			'skill_section',
			[
				'label'		 	=> __( 'SKills', 'crt-manage' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

        $skill_repeater = new Repeater();
        $skill_repeater->add_control(
            'crt_manage_resume_skill_label',
            [
                'label' => esc_html__( 'Title', 'crt-manage' ),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $skill_repeater->add_control(
            'crt_manage_resume_skill_repeater',
            [
                'label' => esc_html__( 'Links', 'armed' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Title', 'armed' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'placeholder' => __( 'Title', 'armed' ),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'link',
                        'label' => __( 'Link', 'armed' ),
                        'placeholder' => __( 'https://site.com/', 'armed' ),
                        'type' => \Elementor\Controls_Manager::URL,
                        'label_block' => true,
                        'show_label' => true,
                    ],
                ],
            ]
        );
		$this->add_control(
			'crt_manage_resume_skill_list',
			[
				'label' 		=> __( 'Skill', 'crt-manage' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $skill_repeater->get_controls(),
			]
		);
        $this->end_controls_section();
        endif;
	}

	protected function render() {
        $settings = $this->get_settings_for_display();
        $skill_list = $settings['crt_manage_resume_skill_list'];
    ?>
        <section id="my-resume" class="my-resume" style="background-color: var(--bg-section)">
            <div class="container-xl">
                <div class="row">
                    <div class="col-12">
                        <h2 class="heading-default opacity" data-viewport="opacity" data-delay="300">My Resume<span>Details about me</span></h2>
                        <div class="my-resume__list">
                            <div class="my-resume__item">
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                                    </div>
                                    <div class="col-12 col-md-8 ">
                                        <?php if(!empty($skill_list)): ?>
                                            <div class="my-resume__skill">
                                            <?php foreach ($skill_list as $skill_item): print_r($skill_item); ?>

                                            <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
	}
}