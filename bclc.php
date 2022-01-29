<?php
/*
Plugin Name: BCLC
Plugin URI: http://bclcph.com/bclc-plugin/
Description: Ultimate Plugin for your website need
Version: 1.0
Author: BCLC
Author URI: bclcph.com
License: later
Text Domain: BCLC
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly.

class BCLC_
{

    public $wpdb;
    static public $uavc_editor_enable = false;

    public $post;
    /**
     * Plugin data from get_plugins()
     *
     * @since 1.0
     * @var object
     */
    public $plugin_data;

    /**
     * Includes to load
     *
     * @since 1.0
     * @var array
     */

    public $includes;
    /**
     * Plugin Action and Filter Hooks
     *
     * @since 1.0.0
     * @return null
     */
    public function __construct()
    {
        global $wpdb;
        global $post;

        add_action( 'admin_menu', __CLASS__ . '::BCLC_menus' );
        add_shortcode( 'BCLC_SUBSCRIBERS', __CLASS__ . '::BCLC__subscribers' );
        add_shortcode( 'BCLC_POPUP', __CLASS__ . '::BCLC__popup' );
        add_shortcode( 'BCLC_CONTACT', __CLASS__ . '::BCLC__contact' );


        #############################################################
        #############################################################
        $is_upgrade = 0;
		$table_name1 = $wpdb->prefix . 'BCLC_subscriber';
   
        if ($wpdb->get_var("show tables like '$table_name1'") == "")
        {
            $sql = "CREATE TABLE " . $table_name1 . " (
			`id` mediumint(9) NOT NULL AUTO_INCREMENT,
            `first_name` varchar(50) NOT NULL,
            `last_name` varchar(50) NOT NULL,
            `email` varchar(20) NOT NULL,
            `phone_number` varchar(20) NOT NULL,
            `business` varchar(30) NOT NULL,
            `role` varchar(10) NOT NULL,
            `job_title` varchar(50) NOT NULL,
            `have_company_website` varchar(5) NOT NULL,
            `website` varchar(20) NOT NULL,
            `business_city` varchar(20) NOT NULL,
            `business_state` varchar(20) NOT NULL,
            `product_services_offered` varchar(50) NOT NULL,
            `average_product_price_sold` varchar(30) NOT NULL,
            `product_services_type` varchar(30) NOT NULL,
            `website_needs` varchar(500) NOT NULL,
			`status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'INACTIVE',
            `role_other` varchar(50) NOT NULL,
            `market_industry` varchar(50) NOT NULL,
			UNIQUE KEY id (id)
			);";

            if ($is_upgrade == 0)
            {
                require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
            }
            $is_upgrade = 1;
            @dbDelta($sql);
        }
        #############################################################
        #############################################################



        #############################################################
        #############################################################
        $is_upgrade = 0;
        $table_name2 = $wpdb->prefix . 'BCLC_contactus';
   
        if ($wpdb->get_var("show tables like '$table_name2'") == "")
        {
            $sql = "CREATE TABLE " . $table_name2 . " (
            `id` mediumint(9) NOT NULL AUTO_INCREMENT,
            `first_name` varchar(50) NOT NULL,
            `last_name` varchar(50) NOT NULL,
            `email` varchar(20) NOT NULL,
            `subject` varchar(100) NOT NULL,
            `comments` varchar(500) NOT NULL,
            `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'INACTIVE',
            UNIQUE KEY id (id)
            );";

            if ($is_upgrade == 0)
            {
                require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
            }
            $is_upgrade = 1;
            @dbDelta($sql);
        }
        #############################################################
        #############################################################        
	}

    static public function BCLC_menus()
    {
        add_menu_page('BCLC', 'BCLC', 'administrator', 'BCLC_dashboard', __CLASS__ . '::BCLC_dashboard', 'dashicons-code-standards', '42.78578');
        add_submenu_page('BCLC_dashboard', 'Subscribers', 'Subscribers', 'administrator', 'BCLC_subscribers', __CLASS__ . '::BCLC_subscribers');
        add_submenu_page('BCLC_dashboard', 'Contacts', 'Contacts', 'administrator', 'BCLC_contacts', __CLASS__ . '::BCLC_contacts');
        add_submenu_page('BCLC_dashboard', 'Settings', 'Settings', 'administrator', 'BCLC_settings', __CLASS__ . '::BCLC_settings');
    }

    static public function BCLC_dashboard()
    {
        wp_register_style('bootstrap.min', plugins_url('BCLC/assets/css/bootstrap.min.css'));
        wp_enqueue_style('bootstrap.min');
        wp_register_style('font-awesome', plugins_url('BCLC/assets/css/font-awesome.min.css'));
        wp_enqueue_style('font-awesome');
        require_once ABSPATH . 'wp-content/plugins/BCLC/admin/dashboard.php';
    }

    static public function BCLC_contacts()
    {
        wp_register_style('bootstrap.min', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
        wp_enqueue_style('bootstrap.min');
        wp_register_style('font-awesome', plugins_url('BCLC/assets/css/font-awesome.min.css'));
        wp_enqueue_style('font-awesome');

        wp_enqueue_script( 'class-vc-video_image_overlay', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array('jquery') ); 
        wp_enqueue_script( 'class-vc-video_image_overlay', plugins_url('assets/js/jquery.min.js', __FILE__), array('jquery') ); 

        require_once ABSPATH . 'wp-content/plugins/BCLC/admin/contacts.php';
    }

    static public function BCLC_subscribers()
    {
        wp_register_style('bootstrap.min', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
        wp_enqueue_style('bootstrap.min');
        wp_register_style('font-awesome', plugins_url('BCLC/assets/css/font-awesome.min.css'));
        wp_enqueue_style('font-awesome');

        wp_enqueue_script( 'class-vc-video_image_overlay', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array('jquery') ); 
        wp_enqueue_script( 'class-vc-video_image_overlay', plugins_url('assets/js/jquery.min.js', __FILE__), array('jquery') ); 

        require_once ABSPATH . 'wp-content/plugins/BCLC/admin/subscribers.php';
    }

    static public function BCLC_settings()
    {
        wp_register_style('bootstrap.min', plugins_url('BCLC/assets/css/bootstrap.min.css'));
        wp_enqueue_style('bootstrap.min');
        wp_register_style('font-awesome', plugins_url('BCLC/assets/css/font-awesome.min.css'));
        wp_enqueue_style('font-awesome');
        require_once ABSPATH . 'wp-content/plugins/BCLC/admin/settings.php';
    }

    static public function BCLC__subscribers()
    {
        require_once ('class/BCLC__subscribers.php');
    }

    static public function BCLC__contact()
    {
        require_once ('class/BCLC__contactus.php');
    }

    static public function BCLC__popup()
    {
        require_once ('class/BCLC__popup.php');
    }

    
    
}
new BCLC_();