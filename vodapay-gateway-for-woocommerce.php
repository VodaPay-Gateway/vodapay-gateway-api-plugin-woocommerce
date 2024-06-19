<?php

/**
 * Plugin Name: VodaPay Gateway for Woocommerce
 * Plugin URI: https://docs.vodapaygateway.vodacom.co.za/docs/plugins-sdks/plugins/WooCommerce/Overview
 * Description: This plugin allows ecommerce merchants to accept online payments from customers.
 * Version: 2.1.7
 * Author: VodaPay Gateway
 * Author URI: https://vodapay.vodacom.co.za/vodapay/personal/home
 * License: 2.0.0
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: wc-vodapay-gateway
 */

 if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (isset($_GET['wc-api'])) {
    $getParams = $_GET['wc-api'];
    $getParamSubString = substr($getParams, 0, 23);
    $whatWeGet = "wc_vodapay_gateway?";
    $whatWeNeed = "wc_vodapay_gateway&";
	
	if (str_contains($getParamSubString, $whatWeGet)) {
		$replaceStr = str_replace($whatWeGet,$whatWeNeed,$getParams);
		$getMainUrl = $_SERVER['SERVER_NAME'];
        $location = $getMainUrl . "?wc-api=" . $replaceStr;
        header('Location:' . $location);
        exit();
	}

}

//Compiles VPG payment plugin
add_action('plugins_loaded', 'woocommerce_payment_plugin', 11);

//Checks if WC generic payment object exists and extends to create VPG plugin if so
function woocommerce_payment_plugin () {
    if (!class_exists('WC_Payment_Gateway')){
        add_action('admin_notices', 'vodapay_woocommerce_fallback_notice');
        return;
    }

    include (plugin_dir_path(__FILE__).'/includes/vodapay-gateway-for-woocommerce-processor.php');
}

//Adds VPG payment plugin to checkout payment gateway list
add_filter('woocommerce_payment_gateways', 'add_payment_gateway');

function add_payment_gateway ($gateways) {
    $gateways[] = 'WC_vodapay_gateway';
    return $gateways;
}

//WooCommerce not installed error
function vodapay_woocommerce_fallback_notice()
{
    $message = '<div class="error">';
    $message .= '<p>' . __('VodaPay Gateway depends on the lastest version of <a href="http://wordpress.org/extend/plugins/woocommerce/">WooCommerce</a> to work!', 'wcdragonpay') . '</p>';
    $message .= '</div>';
    echo $message;
}

/*
 * Adds plugin page links
 * 
 * @param array $links all plugin links
 * @return array $links all plugin links + our custom links (i.e., "Settings")
 */
function vodagateway_plugin_links($links)
{
    $plugin_links = array(
        '<a href="' . admin_url('admin.php?page=wc-settings&tab=checkout&section=vodapay') . '">' . __('Configure', 'wc-vodapay') . '</a>'
    );
    return array_merge($plugin_links, $links);
}

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'vodagateway_plugin_links');

/*
* Custom function to declare compatibility with cart_checkout_blocks feature
*/
add_action( 'before_woocommerce_init', function() {
    if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'cart_checkout_blocks', __FILE__, true );
    }
} );

// Hook the custom function to the 'woocommerce_blocks_loaded' action
add_action( 'woocommerce_blocks_loaded', 'register_order_approval_payment_method_type' );

/*
 * Custom function to register a payment method type
 */
function register_order_approval_payment_method_type() {
    // Check if the required class exists
    if ( ! class_exists( 'Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType' ) ) {
        return;
    }

    // Include the custom Blocks Checkout class
    require_once plugin_dir_path(__FILE__) . '/includes/vodapay-gateway-for-woocommerce-class-block.php';

    // Hook the registration function to the 'woocommerce_blocks_payment_method_type_registration' action
    add_action(
        'woocommerce_blocks_payment_method_type_registration',
        function( Automattic\WooCommerce\Blocks\Payments\PaymentMethodRegistry $payment_method_registry ) {
            // Register an instance of vodapay_gateway_Blocks
            $payment_method_registry->register( new WC_vodapay_gateway_Blocks );
        }
    );
}
?>
