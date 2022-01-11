<?php

/**
 * Plugin Name: Vodapay Gayeway Payment for Woocommerce
 * Plugin URI: https://www.vodacombusiness.co.za/business/solutions/financial-services/accept-payments?icmp=VB/Menu/Solutions/Financialservices/P3/Acceptpayments
 * Description: This plugin allows for local content payment systems for VFS technologies - API Version
 * Version: 2.0.0
 * Author: Vodapay Gayeway
 * Author URI: https://www.vodacombusiness.co.za/business/solutions/financial-services/accept-payments?icmp=VB/Menu/Solutions/Financialservices/P3/Acceptpayments
 * License: 2.0.0
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: wc-vodapay
 */

if(isset($_GET['wc-api'])) {
    $getParams = $_GET['wc-api'];   
    $getParamSubString = substr($getParams, 0, 23);
    $whatWeGet = "wc_vodapay_pay_gateway?";
    $whatWeNeed = "wc_vodapay__pay_gateway&";

    if($getParamSubString == $whatWeGet) {
        $oldParam = array("wc_vodapay__pay_gateway?");
        $replaceParam   = array("wc_vodapay__pay_gateway&");                 
        $newParam = str_replace($oldParam, $replaceParam, $getParams);

        $getMainUrl = $_SERVER['SERVER_NAME'];
        $location = $getMainUrl ."?wc-api=" . $newParam;
        
        header('Location:' . $location);
        exit();
    } 
}

add_action( 'plugins_loaded', 'vodapay_payment_init', 11 );

function vodapay_payment_init() {
    if( class_exists( 'WC_Payment_Gateway' ) ) {

        /**
         * Vodapay Payment Gateway
         *
         * Provides Vodapay Payment Gateway service.
         * We load it later to ensure that WC is loaded first since we're extending it.
         *
         * @class       WC_vodapay_pay_Gateway
         * @extends     WC_Payment_Gateway
         * @version     1.0.0
         * @package     WooCommerce/Classes/Payment
         * @author      Vodapay
         */

        class WC_vodapay_pay_Gateway extends WC_Payment_Gateway {	
        
            public function __construct() {

                $this->id   = 'vodapay';
                $this->icon = apply_filters( 'woo_vodapay_icon', plugins_url('/assets/icon.png', __FILE__ ) );
                $this->has_fields = false;
    
                $this->method_title = __( 'Vodapay Payment Gateway', 'wc-vodapay');
                $this->method_description = __( 'Payment Gateway solution from Vodapay Technologies.', 'wc-vodapay');

                // define the settings.
                $this->init_form_fields();

                // Load the settings.
                $this->init_settings();             

                $this->enabled              = $this->get_option( 'enabled' );
				$this->sandbox              = $this->get_option( 'sandbox' );
                
                $this->title                = $this->get_option( 'title' );
                $this->description          = $this->get_option( 'description' );
                $this->instructions         = $this->get_option( 'instructions');

                if ( 'yes' == $this->sandbox )
					$this->api_endpoint         = 'https://api.vodapaygatewaydev.vodacom.co.za/V2/Pay/OnceOff';
				if ( 'no' == $this->sandbox )
					$this->api_endpoint         = 'https://api.vodapaygateway.vodacom.co.za/V2/Pay/OnceOff';
		        $this->merchant_private_key = $this->get_option( 'merchant_private_key' );
                $this->immediate_capture    = $this->get_option( 'immediate_capture' );
                $this->merchant_image_url   = $this->get_option( 'merchant_image_url' );
                $this->merchant_message_url = $this->get_option( 'merchant_message_url' );
                $this->stylesheet_id        = $this->get_option( 'stylesheet_id' );

                $this->callback_url         = $this->get_option( 'callback_url' );
                $this->callback_url         = !empty($this->callback_url)?$this->callback_url: site_url() . '?wc-api='. strtolower(get_class($this));

                $this->notification_url     = $this->get_option( 'notification_url' );
                $this->notification_url     = !empty($this->notification_url)?$this->notification_url: 'https://www.merchant.com/notify';

                $this->debug                = $this->get_option( 'debug' );

                // Logs
                if ( 'yes' == $this->debug )
                    $this->log = new WC_Logger();


                /*-- Validations --*/
                // Checking if merchant private_key is not empty.
                ($this->merchant_private_key == '') ?
                    add_action( 'admin_notices', array( &$this, 'merchant_private_key_missing_message')) : '';

                // Actions.
                add_action( 'valid_vodapay_request_returnurl', array( &$this, 'check_Vodapay_response_returnurl' ) );
                add_action( 'woocommerce_receipt_vodapay',     array( &$this, 'receipt_page' ) );

                if ( is_admin() )
                    add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );

                add_action( 'woocommerce_api_'.strtolower(get_class($this)), array( &$this, 'handle_callback' ) ); 
                // Webhook URL form - http://site.com/wc-api/vodapay

            }

            public function init_form_fields() {
                $this->form_fields = apply_filters( 'wc_vodapay_settings', array(
                    'enabled' => array(
                        'title' => __( 'Enable/Disable', 'wc-vodapay'),
                        'type' => 'checkbox',
                        'label' => __( 'Enable Vodapay Payment gateway', 'wc-vodapay'),
                        'default' => 'no'
                    ),
					'sandbox' => array(
                        'title' => __( 'Sandbox Mode', 'wc-vodapay'),
                        'type' => 'checkbox',
                        'label' => __( 'Use the sandbox test enviroment', 'wc-vodapay'),
                        'default' => 'no'
                    ),
                    'title' => array(
                        'title' => __( 'Title', 'wc-vodapay'),
                        'type' => 'text',
                        'desc_tip' => true,
                        'description' => __( 'This controls the title which the user sees during checkout.', 'wc-vodapay'),
                        'default' => __( 'Vodacom Financial Services', 'wc-vodapay')
                    ),
                    'description' => array(
                        'title' => __( 'Description', 'wc-vodapay'),
                        'type' => 'textarea',
                        'default' => __( 'Proceed to Secure Checkout with Vodacom Financial Services', 'wc-vodapay'),
                        'desc_tip' => true,
                        'description' => __( 'This controls the description which the user sees during checkout.', 'wc-vodapay')
                    ),
                    'instructions' => array(
                        'title' => __( 'Instructions', 'wc-vodapay'),
                        'type' => 'textarea',
                        'default' => __( 'Default instructions', 'wc-vodapay'),
                        'desc_tip' => true,
                        'description' => __( 'Instructions that will be added to the thank you page and order email', 'wc-vodapay')
                    ),
                   'merchant_private_key' => array(
                        'title' => __( 'Merchant Private Key', 'wc-vodapay'),
                        'type' => 'textarea',
                        'default' => '',
                        'desc_tip' => true,
                        'description' => __( 'Vodapay provided Merchant private key', 'wc-vodapay')
                    ),
                    'immediate_capture'         => array(
                        'title'       => __( 'Capture', 'wc-vodapay' ),
                        'label'       => __( 'Capture charge immediately', 'wc-vodapay' ),
                        'type'        => 'checkbox',
                        'description' => __( 'Whether or not to immediately capture the charge. When unchecked, the charge issues an authorization and will need to be captured later, useful for ecommerce scenarios where products are shipped later or may be cancelled when unavailable.', 'wc-vodapay' ),
                        'default'     => 'yes',
                        'desc_tip'    => true,
                    ),
                    'merchant_image_url' => array(
                        'title' => __( 'Merchant Logo URL', 'wc-vodapay'),
                        'type' => 'textarea',
                        'default' => '',
                        'desc_tip' => true,
                        'description' => __( 'The merchant Logo URL', 'wc-vodapay')
                    ),
                    'merchant_message_url' => array(
                        'title' => __( 'Merchant Message Url', 'wc-vodapay'),
                        'type' => 'textarea',
                        'default' => '',
                        'desc_tip' => true,
                        'description' => __( 'The merchant message', 'wc-vodapay')
                    ),
                    'callback_url' => array(
                        'title' => __( 'Callback URL', 'wc-vodapay').__( '(optional)', 'wc-vodapay'),
                        'type' => 'textarea',
                        'default' => '',
                        'desc_tip' => true,
                        'description' => __( 'URL to redirect back response (Max. 255 characters long)', 'wc-vodapay')
                    ),
                    'notification_url' => array(
                        'title' => __( 'Notification URL', 'wc-vodapay').__( '(optional)', 'wc-vodapay'),
                        'type' => 'textarea',
                        'default' => '',
                        'desc_tip' => true,
                        'description' => __( 'URL to notify transaction status (Max. 255 characters long)', 'wc-vodapay')
                    ),

                    'debug' => array(
                        'title' => __( 'Debug Log', 'wc-vodapay' ),
                        'type' => 'checkbox',
                        'label' => __( 'Enable logging', 'wc-vodapay' ),
                        'default' => 'no',
                        'description' =>  __( 'Log events', 'wc-vodapay' ),
                    )
                ));
            }


            /**
             * Adds thank you message.
             *
             * @access public
             */
            public function thank_you_page(){
                if( $this->instructions ){
                    echo wpautop( $this->instructions );
                }
            }


            /**
             * Add content to the WC emails.
             *
             * @access public
             * @param WC_Order $order
             * @param bool $sent_to_admin
             * @param bool $plain_text
             */
            public function email_instructions( $order, $sent_to_admin, $plain_text = false ) {
                    
                if ( $this->instructions && ! $sent_to_admin && 'offline' === $order->payment_method && $order->has_status( 'on-hold' ) ) {
                    echo wpautop( wptexturize( $this->instructions ) ) . PHP_EOL;
                }
            }



            /**
             * Adds warning messages in admin panel if private key missing
             *
             * @access public
             */
            function merchant_private_key_missing_message()
            {
                $message = '<div class="error">';
                $message .= '<p>'
                    .sprintf(
                        __( '<strong><b>Vodapay</b> Gateway Configuration Missing.</strong> Please update private key. %sClick here to configure!%s' , 'wc-vodapay' ),
                        '<a href="' . get_admin_url() . 'admin.php?page=wc-settings&tab=checkout&section=Vodapay">', '</a>'
                    )
                    . '</p>';
                $message .= '</div>';
                echo $message;
            }

            /**
             * Checking if this gateway is enabled and available in the user's country.
             *
             * @return bool
             */
            public function is_valid_for_use() {
                return in_array( get_woocommerce_currency() , array( 'ZAR', 'INR' ) );
            }

            /**
             * Genrates Admin Panel Options
             * For this plugin fields like enable/disable gateway, passphrase etc
             *
             */
            public function admin_options() {
                ?>
                <h3><?php _e( 'Vodapay Online Payment', 'wc-vodapay' ); ?></h3>
                <p><?php _e( 'Vodapay Online Payment works by sending the user to Vodapay website to enter their payment information.', 'wc-vodapay' ); ?></p>
                <table class="form-table">
                    <?php $this->generate_settings_html(); ?>
                </table><!--/.form-table-->
                <?php
            }

            /**
             * Generate the form, Checks if user has a UUID if not create one and store it for further use
             * in Vodapay gateway
             *
             * @param mixed $order_id
             * @return string
             */
            public function generate_form( $order_id ) {
                $order = new WC_Order( $order_id );
				
				//load swagger generated classes for payload creation
                
                require_once( dirname(__FILE__) . '/vendor/autoload.php');
                require_once( dirname(__FILE__) . '/ResponseCodeConstants.php');

               
                /**********************************************************************************************
                **********************************    Start of PAYLOAD BODY    ********************************
                **********************************************************************************************/
                $body = new \VodaPayGatewayClient\Model\VodaPayGatewayPayment();


                //TRANSACTION AMOUNT
                $amount = intval($order->get_total() * 100);// The amount must be in cents.
                $body->setAmount($amount); //M

                //RETRIEVAL REFERENCE NUMBER
                $rlength = 10;
                $retrievalReference =   substr(
                    str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
                        ceil($rlength/strlen($x)) )),1,32
                );
                $retrievalReference = str_pad($order->get_order_number(), 12, $retrievalReference, STR_PAD_LEFT);


                $body->setTraceId(strval($retrievalReference)); //M

              
                //ECHO DATA
                $body->setEchoData(json_encode(['order_id'=>$order_id])); //O

               
                /****************************************************************
                *****************    Start of ADDITIONAL DATA    ***************
                ****************************************************************/
                $additionData = new \VodaPayGatewayClient\Model\PaymentIntentAdditionalDataModel;

                /************************
                **** Start of BASKET ****
                *************************/
                $basketItems = $this->getBasketItems($order);
                $body->setBasket($basketItems);
                /************************
                **** End of BASKET ****
                *************************/

                /******************************************
                **** Start of NOTIFICATION INFORMATION ****
                ******************************************/
				//$notificationMethod = new \VodaPayGatewayClient\Model\PaymentNotificationMethod;
                //$notifInfo = new \VodaPayGatewayClient\Model\PaymentNotificationDataModel;
                //$notifInfo->setMethod($notificationMethod.email); // 01=SMS ; 03=Email
                //$notifInfo->setAddress($customer_details['email']);
                //$additionData->setNotificationInformation($notifInfo);
                /******************************************
                **** End of NOTIFICATION INFORMATION ****
                ******************************************/

                /******************************************
                **** Start of UI DATA ****
                ******************************************/
                $styling = new \VodaPayGatewayClient\Model\Styling;
                $styling->setLogoUrl($this->merchant_image_url);
                $styling->setBannerUrl($this->merchant_message_url);
                $body->setStyling($styling);
                //$body->setTheme($this->stylesheet_id);
                
                /******************************************
                **** End of UI DATA ****
                ******************************************/

               
                /****************************************************************
                *****************    Start of PERIPHERY DATA    ***************
                ****************************************************************/
                $peripheryData = new \VodaPayGatewayClient\Model\Notifications;

                //Callback URL
                if(!empty($this->callback_url)){
                    $appended = $this->appendQuery($this->callback_url, ['wc-api'=>strtolower(get_class($this))]);
                    //return callback Url MUST contain name of this class otherwise Woocommerce won't activate our class
                    $peripheryData->setCallbackUrl($appended);
                }

                //Notification URL
                if(!empty($this->notification_url))
                    $peripheryData->setNotificationUrl($this->notification_url);

                $body->setNotifications($peripheryData);
                /****************************************************************
                *****************    End of PERIPHERY DATA    ***************
                ****************************************************************/

                /**********************************************************************************************
                **********************************    End of PAYLOAD BODY    ********************************
                **********************************************************************************************/

                /**** To check constructed JSON USE: ****/
                echo strval($body); //exit;

                try {
                    $client = new \GuzzleHttp\Client([
                        'headers' => [
                             'Content-Type' => 'application/json',
                             'api-key' => $this->merchant_private_key
                        ],
                        'verify'=> false,
                        //'debug' => true,
                        'connect_timeout' => 60
                    ]);

                    $response = $client->post($this->api_endpoint,
                        ['body' => strval($body)]
                    );                    

                    if($response->getStatusCode() == 200){
                        $responseJson = $response->getBody()->getContents();
                        $responseObj = json_decode($responseJson);

                        $responseCode = $responseObj->responseCode;
                        if(in_array($responseCode, ResponseCodeConstants::getGoodResponseCodeList())){
                            //SUCCESS
                            if($responseCode == "00"){
                                $peripheryData = $responseObj->peripheryData;
                                $peripheryDataObj = (object) $peripheryData;
                                $initiationUrl = $peripheryDataObj->initiationUrl;
                                header("Location: $initiationUrl");
                            }
                        }elseif(in_array($responseCode, ResponseCodeConstants::getBadResponseCodeList())){
                            //FAILURE
                            $responseMessages = ResponseCodeConstants::getResponseText();
                            $failureMsg = $responseMessages[$responseCode];
                            $this->informTxnFailure($failureMsg.'['.$responseCode.']{'.$responseObj->responseMessage.'}', $order);
                        }

                    }else{
                        $this->informTxnFailure('Vodapay API error', $order);
                    }
                } catch (Exception $e) {
                    echo 'Exception when calling DefaultApi->initiateImmediatePayment: ', $e->getMessage(), PHP_EOL;
                }

            }


            /**
             * Order error button.
             *
             * @param  object $order Order data.
             * @return string Error message and cancel button.
             */
            protected function Vodapay_order_error( $order ) {
                $html = '<p>' . __( 'An error has occurred while processing your payment, please try again. Or contact us for assistance.', 'wc-vodapay' ) . '</p>';
                $html .='<a class="button cancel" href="' . esc_url( $order->get_cancel_order_url() ) . '">' . __( 'Click to try again', 'wc-vodapay' ) . '</a>';
                return $html;
            }
 
            /**
             * Process the payment and return the result.
             *
             * @param int $order_id
             * @return array
             */
            public function process_payment( $order_id ) {
        
                if ( "yes" == $this->debug ){
                    $this->log->add( "wc-vodapay", "Function `process_payment` init - [order id : $order_id]"  );
                }
          
                $order = new WC_Order( $order_id );
                $order->update_status('pending-payment', __( 'Awaiting Vodapay payement', 'wc-vodapay' ));
                
                return array(
                    'result' => 'success',
                    'redirect' => add_query_arg( 
                                        'order', $order->get_id(),
                                        add_query_arg( 'key', $order->get_order_key(), 
                                        get_permalink( wc_get_page_id( 'pay' ) )
                                     )
                    )
                );
            }

            /**
             * Output for the order received page.
             */
            public function receipt_page( $order ) {
                if ( "yes" == $this->debug ){
                    $this->log->add( "wc-vodapay", "Function `receipt_page` init"  );
                }
                echo $this->generate_form( $order );
            }            

            /**
             * Output for the order thank you page.
             */
            public function thankyou_page() {
                if ( "yes" == $this->debug ){
                    $this->log->add( "wc-vodapay", "Function `thankyou_page` init"  );
                }
                if ( $this->instructions ) {
                    echo wpautop( wptexturize( $this->instructions ) );
                }
            }

            /**
             * Handles the webhook callback response when user is redirected back from Vodapay to website
             * after completing(success/failure) the payment
             */
            public function handle_callback() {
                $results = $_GET;
                require_once( dirname(__FILE__) . '/ResponseCodeConstants.php');

                if ( "yes" == $this->debug ){
                     $this->log->add( "wc-vodapay", "Function `check_ipn_response` init"  );
                      $display="\n-------------------------------------------\n";
                      $display.= "GET/POST data: ". $results['data'];
                      $display.="\n--------------------------------------------\n";
                      $this->log->add( "wc-vodapay", $display  );
                }

                $responseObj = json_decode( base64_decode($results['data']) );
                $responseCode = $responseObj->responseCode;
                
                $echoData = $responseObj->echoData;
                $meta = json_decode($echoData, TRUE);
                $order = new WC_Order( $meta['order_id'] );

                if(in_array($responseCode, ResponseCodeConstants::getGoodResponseCodeList())){
                    //SUCCESS
                    if($responseCode == "00"){
                        if ( "yes" == $this->debug ){
                            $this->log->add( "wc-vodapay", "Webhook response code : " . $responseCode  );
                        }

                        if($responseObj->sessionId == wc()->session->get( 'VODAPAY_SESSION_ID' )){ 

                            $order->payment_complete();                            

                            $refId = $responseObj->retrievalReferenceNumber;
                            $txnId = $responseObj->transactionId;

                            $str = preg_replace('/\D/', '', $refId);                   
                            $order = new WC_Order( $str );

                            if ( "yes" == $this->debug ){
                                $this->log->add( "wc-vodapay", "response REF ID : " . $refId  );
                                $this->log->add( "wc-vodapay", "response TXN ID : " . $txnId  );
                                $this->log->add( "wc-vodapay", "response Order : " . $order  );
                            }

                            $success_msg = sprintf(
                                "%s payment completed with Transaction Id of '%s'",
                                'Vodapay',
                                $txnId
                            );

                            $order->add_order_note($success_msg);
                            $order->update_meta_data( 'vodapay_payment_ref_id', $refId );
                            $order->update_meta_data( 'vodapay_payment_txn_id', $txnId );
                           
                            //WC()->cart->empty_cart();
                            wc_add_notice($success_msg, 'success');
                            $order->update_status( 'wc-processing' );
                            wp_redirect($this->get_return_url( $order ));

                        }
                    }
                }elseif(in_array($responseCode, ResponseCodeConstants::getBadResponseCodeList())){
                    //FAILURE
                    $responseMessages = ResponseCodeConstants::getResponseText();
                    $failureMsg = $responseMessages[$responseCode];
                    $this->informTxnFailure($failureMsg, $order);
                }
                else{
                    $this->informTxnFailure($responseObj->responseMessage, $order);
                }
            }
            
            /**************************
             ******HELPER METHODS******
             ***************************/

            /**
             * Returns customer details
             * @param WC_Order $order
             * @return array
             */
            function getCustomerDetails($order){

                return array(
                    'first_name'=> !empty(trim($order->get_billing_first_name()))?trim($order->get_billing_first_name()):trim($order->get_shipping_first_name()),

                    'last_name'=> !empty(trim($order->get_billing_last_name()))?trim($order->get_billing_last_name()):trim($order->get_shipping_last_name()),

                    'email'=> !empty($order->get_billing_email())?$order->get_billing_email():'',

                    'phone'=> !empty($order->get_billing_phone())?$order->get_billing_phone():'',

                    'phone'=> !empty($order->get_billing_phone())?$order->get_billing_phone():'',

                    'address'=>!empty(trim(
                        $order->get_billing_address_1()   . ' ' . $order->get_billing_address_2() . ' ' . $order->get_billing_postcode() . ' ' . $order->get_billing_city() . ',' . $order->get_billing_state() . ',' . $order->get_billing_country()
                    ))
                        ?
                        $order->get_billing_address_1()   . ' ' . $order->get_billing_address_2() . ' ' . $order->get_billing_postcode() . ' ' . $order->get_billing_city() . ',' . $order->get_billing_state() . ',' . $order->get_billing_country()
                        :
                        $order->get_shipping_address_1()  . ' ' . $order->get_shipping_address_2() . ' ' . $order->get_shipping_postcode() . ' ' . $order->get_shipping_city() . ',' . $order->get_shipping_state() . ',' . $order->get_shipping_country()

                );
            }

            /**
             * Returns basket items
             * @param WC_Order $order
             * @return PaymentIntentBasketItemModel[]
             */
            function getBasketItems($order){
                $basketItems = [];
                $line_item_count = 1;

                foreach ( $order->get_items() as  $item_key => $item ) {

                    $basketItem = new \VodaPayGatewayClient\Model\PaymentIntentBasketItemModel();

                    //Ln no.
                    $basketItem->setLineNumber(strval($line_item_count++));

                    //Product Id
                    $product_variation_id = $item->get_variation_id();
                    if ($product_variation_id) { // IF Order Item is Product Variantion then get Variation Data instead
                        $product = wc_get_product($product_variation_id);
                    } else {
                        $product = wc_get_product($item->get_product_id());
                    }
                    $basketItem->setProductId(strval($product->get_id()));

                    //Barcode Id
                    $product_sku = !empty($product->get_sku())? $product->get_sku(): $product->get_id();
                    $product_sku = substr($product_sku, 0, 99);
                    $basketItem->setProductBarcode(strval($product_sku));

                    //Quantity
                    $qty            = intval($item->get_quantity());
                    $basketItem->setQuantity($qty);

                    //Description
                    $product_name   = substr($product->get_name(), 0, 99);
                    $basketItem->setDescription($product_name);

                    //VAT
                    //$line_total     = $item->get_total();       //discounted
                    //$line_tax       = $item->get_total_tax();   //discounted
                    $basketItem->setAmountExVat((int) ( wc_get_price_excluding_tax($product) * 100));
                    $basketItem->setAmountVat((int)   (( wc_get_price_including_tax($product) - wc_get_price_excluding_tax($product)) * 100));

                    $basketItems[]= $basketItem;
                }

                return $basketItems;
            }

            /**
             * Returns assurance data for a given set of payload properties
             * @return string <assurance data>
             */
            function getAssurance($merchantId, $merchantPrivateKey, $order, $sessionId, $transactionId, $retrievalReference, $retrievalReferenceExtended, $amount, $currencyCode){

                $assuranceArr = array(
                        'timestamp'         => $this->generateEpochTime($this->generateCurrentDateTimeUCTFormat()), //timestamp
                        'digitalWalletId'   => $this->checkUserMeta($order), //user UUID in WP
                        'signature'         => $this->buildSignature($merchantId, $merchantPrivateKey, $sessionId, $transactionId, $retrievalReference, $retrievalReferenceExtended, $amount, $currencyCode), //$signature
                        'sessionId'         => $sessionId //session UUID
                );

                $assurance_data = json_encode($assuranceArr);            

                require_once( dirname(__FILE__) . '/AesCipher.php');
                $encKey = str_replace("-", "", strtolower($this->merchant_private_key));
                $cipherTxt = \Vodapay\AesCipher::encrypt($encKey, $assurance_data);
                if($cipherTxt){
                    return strval($cipherTxt);
                }else{
                    $this->informTxnFailure('Could not obtain proper cipher text for assurance data', $order);
                    return;
                }
            }

            function checkUserMeta($order){
               
                $user_id = wp_get_current_user()->ID;
                
                if($user_id == 0) {
                    $user_id = $order->get_billing_email();
                }
                
                $v3uuid = UUID::v3('1546058f-5a25-4334-85ae-e68f2a44bbaf', $user_id);                

                return $v3uuid;
            }

            function buildSignature($merchantId, $merchantPrivateKey, $sessionId, $transactionId, $retrievalReference, $retrievalReferenceExtended, $amount, $currencyCode){
                $contatenation =    strval($merchantId)                 .
                                    strval($amount)                     .
                                    strval($currencyCode)               .
                                    strval($retrievalReference)         .
                                    strval($retrievalReferenceExtended) .
                                    strval($transactionId)              .
                                    strval($sessionId)                  .
                                    strval($merchantPrivateKey);

                $lcContatenation = strtolower($contatenation);
                $hashContatenation = hash("sha512", $lcContatenation);
                $uchash = strtoupper($hashContatenation);
                return $uchash;
            }

            private function generateCurrentDateTimeUCTFormat() {
                $time = new DateTime;
                $timeAtom = $time->format(DateTime::ATOM);
                $removeLastChar = substr($timeAtom, 0, -3);
                $newTime = $removeLastChar . "00";
                return $newTime;
            }

            private function generateEpochTime($date){
                $getDate  = $date;
                $dt   = new DateTime($getDate);
                return $dt->getTimestamp();
            }

            private function informTxnFailure($msg='Cannot get response from Vodapay Payment Gateway', $order){
                wc_add_notice($msg, 'error');
                do_action( 'woocommerce_set_cart_cookies',  true );
                wp_redirect( $order->get_checkout_payment_url() );
            }

            private function appendQuery($url, $kvPairs) {
                $parsed = parse_url($url);
                $scheme = $parsed['scheme'];
                $host = $parsed['host'];
                $port = !empty($parsed['port'])?$parsed['port']:'';
                $user = !empty($parsed['user'])?$parsed['user']:'';
                $pass = !empty($parsed['pass'])?$parsed['pass']:'';
                $path = !empty($parsed['path'])?$parsed['path']:'';
                $query = !empty($parsed['query'])?$parsed['query']:'';
                $fragment = !empty($parsed['fragment'])?$parsed['fragment']:'';
                $newquery = $query;

                if(!empty($query)){
                    parse_str($query, $queryArr);
                    $newquery = http_build_query(array_unique(array_merge($queryArr, $kvPairs)));
                }

                return $scheme.'://'.(!empty($user)?$user:'').(!empty($pass)?$pass:'').(!empty($user)?'@':'').
                    $host . $port . $path . '?'. $newquery . $fragment;
            }
        }

        /*
        * This action hook registers our PHP class as a WooCommerce payment gateway
        */
        add_filter( 'woocommerce_payment_gateways', 'add_to_woo_payment_gateway'); // add to pg list
        function add_to_woo_payment_gateway( $gateways ) {
            $gateways[] = 'WC_vodapay_pay_Gateway'; //class name
            return $gateways;
        }
         
    }
    else {
        add_action( 'admin_notices', 'vodapay_woocommerce_fallback_notice');
        return;
    }
}

/**
* If WooCommerce is not installed show warning message
*/
function vodapay_woocommerce_fallback_notice() {
    $message = '<div class="error">';
    $message .= '<p>' . __( 'Vodapay Payment Gateway depends on the lastest version of <a href="http://wordpress.org/extend/plugins/woocommerce/">WooCommerce</a> to work!' , 'wcdragonpay' ) . '</p>';
    $message .= '</div>';
    echo $message;
}

/**
 * Adds plugin page links
 * 
 * @param array $links all plugin links
 * @return array $links all plugin links + our custom links (i.e., "Settings")
 */
function vodapay_gateway_plugin_links( $links ) {
    $plugin_links = array(
        '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout&section=vodapay' ) . '">' . __( 'Configure', 'wc-vodapay' ) . '</a>'
    );
    return array_merge( $plugin_links, $links );
}

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'vodapay_gateway_plugin_links' );

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'vodapay_gateway_plugin_links' );





class UUID {
    public static function v3($namespace, $name) {
      if(!self::is_valid($namespace)) return false;
  
      // Get hexadecimal components of namespace
      $nhex = str_replace(array('-','{','}'), '', $namespace);
  
      // Binary Value
      $nstr = '';
  
      // Convert Namespace UUID to bits
      for($i = 0; $i < strlen($nhex); $i+=2) {
        $nstr .= chr(hexdec($nhex[$i].$nhex[$i+1]));
      }
  
      // Calculate hash value
      $hash = md5($nstr . $name);
  
      return sprintf('%08s-%04s-%04x-%04x-%12s',
  
        // 32 bits for "time_low"
        substr($hash, 0, 8),
  
        // 16 bits for "time_mid"
        substr($hash, 8, 4),
  
        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 3
        (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x3000,
  
        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,
  
        // 48 bits for "node"
        substr($hash, 20, 12)
      );
    }
  
    public static function v4() {
      return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
  
        // 32 bits for "time_low"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
  
        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),
  
        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,
  
        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,
  
        // 48 bits for "node"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
      );
    }
  
    public static function v5($namespace, $name) {
      if(!self::is_valid($namespace)) return false;
  
      // Get hexadecimal components of namespace
      $nhex = str_replace(array('-','{','}'), '', $namespace);
  
      // Binary Value
      $nstr = '';
  
      // Convert Namespace UUID to bits
      for($i = 0; $i < strlen($nhex); $i+=2) {
        $nstr .= chr(hexdec($nhex[$i].$nhex[$i+1]));
      }
  
      // Calculate hash value
      $hash = sha1($nstr . $name);
  
      return sprintf('%08s-%04s-%04x-%04x-%12s',
  
        // 32 bits for "time_low"
        substr($hash, 0, 8),
  
        // 16 bits for "time_mid"
        substr($hash, 8, 4),
  
        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 5
        (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x5000,
  
        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,
  
        // 48 bits for "node"
        substr($hash, 20, 12)
      );
    }
  
    public static function is_valid($uuid) {
      return preg_match('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?'.
                        '[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $uuid) === 1;
    }
  }