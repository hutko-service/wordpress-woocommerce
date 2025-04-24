<?php

trait Oplata_Embedded
{
    public $embedded = true;

    public function includeEmbeddedAssets()
    {
        // we need JS only on cart/checkout pages
        // if our payment gateway is disabled, we do not have to enqueue JS too
        if ('no' === $this->enabled || (!is_cart() && !is_checkout_pay_page())) {
            return;
        }

        wp_enqueue_style('oplata-vue-css', 'https://pay.hutko.org/latest/checkout-vue/checkout.css', null, WC_OPLATA_VERSION);

        /* !!! Ch Log !!!  +if */
        if(!wp_script_is( 'oplata-vue-js', 'enqueued' ) ){
          wp_enqueue_script('oplata-vue-js', 'https://pay.hutko.org/latest/checkout-vue/checkout.js', null, WC_OPLATA_VERSION);
        }

        /* !!! Ch Log !!!  +if */
        if(!wp_script_is( 'oplata-init', 'registered' ) ){
          wp_register_script('oplata-init', plugins_url('assets/js/oplata_embedded.js', WC_OPLATA_BASE_FILE), [], WC_OPLATA_VERSION); //['oplata-vue-js']
        }
        wp_enqueue_style('oplata-embedded', plugins_url('assets/css/oplata_embedded.css', WC_OPLATA_BASE_FILE), ['storefront-woocommerce-style', 'oplata-vue-css'], WC_OPLATA_VERSION);
    }

    public function receipt_page($order_id)
    {
        $order = wc_get_order($order_id);

        try {
          $ch_token = $this->getCheckoutToken($order);

            $paymentArguments = [
                'options' => $this->getPaymentOptions(),
              /*-- */  'params' => ['token' => $ch_token],
            ];

            /* !!! Ch Log !!! S  */
            /*-
            $paymentArguments['options']['fields'] = false; 

            $paymentArguments['options']['locales'] = [];
            array_push($paymentArguments['options']['locales'], "ru", "en");

            $paymentArguments['options']['theme'] = new stdClass();
            $paymentArguments['options']['theme']->preset = "black";
            $paymentArguments['options']['theme']->type   = "light";

           //-- $paymentArguments['options']['show_menu_first'] = false;

           $paymentArguments['params'] = new stdClass();
           $paymentArguments['params']->merchant_id = 1396424;
          //-- $paymentArguments['params']->currency = "UAH";
           $paymentArguments['params']->token = $ch_token;
           $paymentArguments['params']->required_rectoken = "y";

            var_dump($paymentArguments);
            */
            /* !!! Ch Log !!! E  */

        } catch (Exception $e) {
//--            wc_add_notice( $e->getMessage(), 'error' ); wc_print_notices();
            wp_die($e->getMessage());
        }

         /* !!! Ch Log !!!  +if */
         if(!wp_script_is( 'oplata-init', 'enqueued' ) ){
            wp_enqueue_script('oplata-init');
            wp_localize_script('oplata-init', 'oplataPaymentArguments', $paymentArguments);
         
        

    /* !!! Ch Log !!!  */
        /*
            echo '***************** '.$order_id.'*************************';
            var_dump($paymentArguments);
        */
            echo '<div id="oplata-checkout-container"></div>';
          } /* if  */
    }

  

}