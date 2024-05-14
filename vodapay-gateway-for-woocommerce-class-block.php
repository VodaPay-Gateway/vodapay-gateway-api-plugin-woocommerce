<?php

    use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;

    final class WC_vodapay_gateway_Blocks extends AbstractPaymentMethodType {

        private $gateway;
        protected $name = 'vodapay_gateway';

        public function initialize() {
            $this->settings = get_option( 'wc_vodapay_settings', [] );
            $this->gateway = new WC_vodapay_gateway();
        }

        public function is_active() {
            return $this->gateway->is_available();
        }

        public function get_payment_method_script_handles() {

            wp_register_script(
                'WC_vodapay_gateway-blocks-integration',
                plugin_dir_url(__FILE__) . 'vodapay-gateway-for-woocommerce.js',
                [
                    'wc-blocks-registry',
                    'wc-settings',
                    'wp-element',
                    'wp-html-entities',
                    'wp-i18n',
                ],
                null,
                true
            );
            if( function_exists( 'wp_set_script_translations' ) ) {            
                wp_set_script_translations( 'WC_vodapay_gateway-blocks-integration');
                
            }
            return [ 'WC_vodapay_gateway-blocks-integration' ];
        }

        public function get_payment_method_data() {
            return [
                'title' => $this->gateway->title,
                //'description' => $this->gateway->description,
            ];
        }

    }
?>