<?php
defined('ABSPATH') or die('Sorry guys!');
/**
 * @class CRT_Manage_Base
 */
class CRT_Manage_Base {

    public static $_instance = '';

    protected $crt_manage_data;

    protected $crt_manage_theme;

    protected $crt_manage_child_theme;

    protected $crt_manage_depend_plugins = false;

    protected $crt_manage_license = array();

    protected $is_pre_theme = false;

    protected $crt_manage_theme_allow_used = array(
        'tenzin-news-magazine',
        'times-news-magazine-blog',
        'megan-blog-multipurpose',
        'market-coupons-deals',
        'nason-magazine-blog',
    );

    protected $crt_manage_theme_demo = array(
        'tenzin-news-magazine' => array('https://demo1.crthemes.com/tenzin', 'https://demo1.crthemes.com/times', 'https://demo1.crthemes.com/travel'),
        'megan-blog-multipurpose' => array('https://demo1.crthemes.com/megan'),
        'market-coupons-deals' => array('https://demo1.crthemes.com/coupon'),
        'nason-magazine-blog' => array('https://demo1.crthemes.com/nason'),
    );

    private static $prefix_pre = 'is_pre';

    public $crt_manage_theme_uri = '';

    public function __construct() {
        $this->crt_manage_theme = get_option( 'template' );
        $this->crt_manage_child_theme = get_option( 'stylesheet' );

        if ( ! defined( 'CRT_MANAGE_VERSION' ) ) {
            define( 'CRT_MANAGE_VERSION', '1.0.3' );
        }

        $licenses = !empty(get_option('crt_manage_license')) ? json_decode(get_option('crt_manage_license')) : array();
        if(in_array($this->crt_manage_theme, $licenses)) {
            $this->is_pre_theme = true;
        }
        $this->crt_manage_theme_uri = wp_get_theme()->get( 'ThemeURI' );

        if(!in_array($this->crt_manage_theme, $this->crt_manage_theme_allow_used)) {
            $this->crt_manage_depend_plugins = true;
        }
        if (!$this->crt_manage_depend_plugins) {
            $this->includes();
            add_action( 'customize_register', array($this, 'crt_manage_customize_register') );
            add_action( 'admin_menu', array( $this, 'crt_manage_add_page' ), 99 );
            add_action( 'wp_ajax_crt_manage_theme_purchase_code', array( $this, 'crt_manage_theme_purchase_code') );
            add_action( 'admin_enqueue_scripts', array( $this, 'crt_manage_admin_js' ) );
            if(!$this->is_pre_theme) {
                add_action( 'admin_notices', array($this, 'crt_manage_add_notice_buy_theme') );
            }
            global $theme_premium;
            $licenses = !empty(get_option('crt_manage_license')) ? json_decode(get_option('crt_manage_license')) : array();
            if(in_array($this->crt_manage_theme, $licenses)) {
                $theme_premium = true;
            } else {
                $theme_premium = false;
            }
        }
        global $crt_manage_is_woo;
        if(class_exists( 'WooCommerce' )) {
            $crt_manage_is_woo = true;
        } else {
            $crt_manage_is_woo = false;
        }


    }

    public static function instance() {
        if (empty(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function includes() {
        require_once dirname( __FILE__, 2 ) . '/includes/customizer/functions.php';
        require_once dirname( __FILE__, 2 ) . '/includes/customizer/customizer.php';
        require_once dirname( __FILE__, 2 ) . '/includes/customizer/users.php';
        require_once dirname( __FILE__, 2 ) . '/includes/cmb2/init.php';
        require_once dirname( __FILE__, 2 ) . '/includes/widget/crt-manage-author-widgets.php';

        $crt_manage_meta_box = dirname( __FILE__, 2 ) . '/includes/metabox/'.$this->crt_manage_theme;
        if(file_exists($crt_manage_meta_box)) {
            require_once $crt_manage_meta_box . '/metabox.php';
        }
        if ( class_exists( 'OCDI_Plugin' ) ) {
            require_once dirname( __FILE__, 2 ) . '/includes/ocdi/ocdi.php';
        }
    }

    public function crt_manage_add_page(){
        add_theme_page(
            esc_html__('CRT Manage','crt-manage-child') ,
            esc_html__('CRT Manage','crt-manage-child'),
            'manage_options',
            'crt-manage-license',
            array( $this,'crt_manage_render' ),
        );
    }

    public function crt_manage_render(){
        ?>
        <h2><?php esc_html_e("General",'crt-manage-child') ?></h2>
        <form method="post">
            <?php
            settings_fields( 'melissa_settings' );
            do_settings_sections( 'melissa_settings' );
            ?>
            <div>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php esc_html_e('License:','crt-manage-child') ?> </th>
                        <td>
                            <div class="booknow_settings_container_holidays">
                                <div class="booknow_settings_container_holiday">
                                    <input class="regular-text" type="text" placeholder="<?php echo esc_attr('Active Code'); ?>" />
                                    <?php echo '<a href="#" class="button button-primary crt-btn-license">'.esc_html__('Active','crt-manage-child').'</a>'; ?>
                                    <p class="description">
                                        <?php echo 'You can buy premium version '.'<a href="'.esc_attr($this->crt_manage_theme_uri).'" target="_blank">here.</a>'; ?>
                                    </p>
                                    <p class="description">
                                        <?php
                                            $crt_manage_license = get_option('crt_manage_license');
                                            $licenses = json_decode($crt_manage_license);
                                            if(!empty($licenses)):
                                                echo 'List of active themes: '. implode(',', $licenses);
                                            endif;
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    <?php
    }

    public function crt_manage_theme_purchase_code() {
        $code = sanitize_text_field($_POST['code']);
        $personalToken = 'acijklmnopHIJKLMXYZ12345890!@^&*';
        $site = 'https://crthemes.com';
        $url = $site.'/wp-json/wc/v3/purchase_theme';
        $headers = array(
            'Content-Type' => 'multipart/form-data',
            'Api-Key' => $personalToken,
        );
        $data = array('code' => $code, 'site' => home_url( '/' ));
        $result = wp_remote_post($url, array('headers' => $headers, 'body' => json_encode($data)));
        $result = $result['body'];
        $result = base64_decode($result);

        $status_code = '';
        if($result === 'NOT_EXIST') {
            $status_code = 'NOT_EXIST';
            echo $status_code;
            exit();
        } elseif ($result === 'CODE_ACTIVED') {
            $status_code = 'CODE_ACTIVED';
            echo $status_code;
            exit();
        }
        $result = base64_decode($result);
        $key = explode('_', $result);
        $license_code = '';
        if(mb_strlen($key[0]) == mb_strlen($this->crt_manage_theme) || in_array($key[1], $this->crt_manage_theme_allow_used)) {
            $license_code = $key[1];
        } else {
            $status_code = 'NOT_EXIST';
            echo $status_code;
            exit();
        }

        // Update license
        $crt_manage_license = !empty(get_option('crt_manage_license')) ? json_decode(get_option('crt_manage_license')):array();
        update_option('crt_manage_license', wp_json_encode(array_merge($crt_manage_license, array($license_code))));
        $status_code = 'ACTIVE_SUCCESS';
        echo $status_code;
        exit();
    }

    public function crt_manage_random_string($str_int = 10) {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*';
        $strings = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < $str_int; $i++) {
            $n = rand(0, $alphaLength);
            $strings[] = $alphabet[$n];
        }
        return implode($strings);
    }

    public function crt_manage_admin_js() {
        wp_enqueue_script( 'crt-manage-child-js', CRT_MANAGE_URI . '/assets/js/license.js', array( 'jquery' ), CRT_MANAGE_VERSION, true );
    }

    public function crt_manage_customize_register($wp_customize) {
        require_once dirname( __FILE__, 2 ) . '/includes/customizer/front-page-options.php';
        $wp_customize->register_control_type( 'Crt_Manage_Customize_Select_Multiple' );
    }

    function crt_manage_add_notice_buy_theme() {
        $demos = $this->crt_manage_theme_demo[$this->crt_manage_theme];
        ?>
        <div class="notice notice-warning is-dismissible">
            <p><strong><?php esc_html_e(CRT_MANAGE_THEME_NAME) ?>: </strong><?php esc_html_e( 'You can buy the premium version, to be able to use blocks, one click demo import ... here: ', 'tenzin-news-magazine' ); ?> <a href="<?php echo esc_url( CRT_MANAGE_URL_DEMO ) ?>" target="_blank" ><?php echo esc_url( CRT_MANAGE_URL_DEMO ) ?></a></p>
            <?php if(!empty($demos)): ?>
                <?php foreach ($demos as $c => $url): ?>
                    <p><?php esc_html_e( 'Demo ' .($c+1).': ', 'tenzin-news-magazine' ); ?> <a href="<?php echo esc_url( $url ) ?>" target="_blank" ><?php echo esc_url( $url ) ?></a></p>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php
    }

}