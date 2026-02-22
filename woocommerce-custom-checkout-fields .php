<?php
/**
 * Plugin Name: WooCommerce Custom Checkout Fields
 * Description: Professional custom checkout field manager for WooCommerce.
 * Version: 1.0.0
 * Author: Fachremy Putra
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'includes/class-loader.php';

new WCCF_Loader();
