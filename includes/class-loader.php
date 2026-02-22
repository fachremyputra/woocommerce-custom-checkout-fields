<?php

if (!defined('ABSPATH')) {
    exit;
}

class WCCF_Loader {

    public function __construct() {
        add_filter('woocommerce_checkout_fields', [$this, 'add_custom_checkout_field']);
        add_action('woocommerce_checkout_update_order_meta', [$this, 'save_custom_field']);
        add_action('woocommerce_admin_order_data_after_billing_address', [$this, 'display_admin_order_meta'], 10, 1);
    }

    public function add_custom_checkout_field($fields) {
        $fields['billing']['billing_custom_note'] = [
            'type' => 'text',
            'label' => __('Custom Note'),
            'required' => false,
            'class' => ['form-row-wide'],
            'priority' => 120,
        ];
        return $fields;
    }

    public function save_custom_field($order_id) {
        if (!empty($_POST['billing_custom_note'])) {
            update_post_meta($order_id, '_billing_custom_note', sanitize_text_field($_POST['billing_custom_note']));
        }
    }

    public function display_admin_order_meta($order) {
        echo '<p><strong>Custom Note:</strong> ' . esc_html(get_post_meta($order->get_id(), '_billing_custom_note', true)) . '</p>';
    }
}
