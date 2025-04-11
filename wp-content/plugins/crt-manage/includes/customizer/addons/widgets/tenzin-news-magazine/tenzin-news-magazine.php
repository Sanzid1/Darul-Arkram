<?php
require_once( CRT_MANAGE_DIR .'/includes/customizer/addons/widgets/tenzin-news-magazine/crt-manage-widget-hero-style-one.php' );
require_once( CRT_MANAGE_DIR .'/includes/customizer/addons/widgets/tenzin-news-magazine/crt-manage-widget-feature-style-one.php' );
require_once( CRT_MANAGE_DIR .'/includes/customizer/addons/widgets/tenzin-news-magazine/crt-manage-widget-area-post-sidebar.php' );
require_once( CRT_MANAGE_DIR .'/includes/customizer/addons/widgets/tenzin-news-magazine/crt-manage-widget-area-post-six.php' );
require_once( CRT_MANAGE_DIR .'/includes/customizer/addons/widgets/tenzin-news-magazine/crt-manage-widget-area-post-sidebar-two.php' );

\Elementor\Plugin::instance()->widgets_manager->register( new \CRT_Manage_News_Hero_Style_One() );
\Elementor\Plugin::instance()->widgets_manager->register( new \CRT_Manage_News_Feature_Style_One() );
\Elementor\Plugin::instance()->widgets_manager->register( new \CRT_Manage_News_Area_Post_Sidebar() );
\Elementor\Plugin::instance()->widgets_manager->register( new \CRT_Manage_News_Area_Post_Six() );
\Elementor\Plugin::instance()->widgets_manager->register( new \CRT_Manage_News_Area_Post_Sidebar_Two() );