<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Index.php 470 2016-03-07 13:04:30Z montassar.amhsoft $
 * $Rev: 470 $
 * @package    Paytabs
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-03-07 14:04:30 +0100 (lun., 07 mars 2016) $
 * $Author: montassar.amhsoft $
 */
class Paytabs_Frontend_Index_Controller extends Amhsoft_System_Web_Controller {

    protected $orderId;
    protected $hashedKEY;

    /** @var Saleorder_Model $saleOrder */
    protected $saleOrder;
    protected $account_id;

    /**
     * Initialize event
     */
    public function __initialize() {

        $paymentModelAdapter = new Payment_Payment_Model_Adapter();
        $paymentModelAdapter->where("modulename = ?", 'Paytabs');
        $paymentModelAdapter->where("online = 1");

        $paymentModel = $paymentModelAdapter->fetch()->fetch();

        if (!$paymentModel instanceof Payment_Payment_Model) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }

        $this->orderId = $this->getRequest()->getId();
        if ($this->orderId > 0) {
            $saleOrderModelAdapter = new Saleorder_Model_Adapter();
            $this->saleOrder = $saleOrderModelAdapter->fetchById($this->orderId);
        }

        if (!$this->saleOrder instanceof Saleorder_Model) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }

        $auth = Amhsoft_Authentication::getInstance();
        if ($auth->isAuthenticated()) {
            $this->account_id = $auth->getObject()->id;
        } else {
            $cart = Cart_Shoppingcart_Model::getInstance();
            $this->account_id = $cart->account_id;
        }

        if ($this->saleOrder->account->id != $this->account_id) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }

        $this->hashedKEY = sha1($this->saleOrder->getId());
    }

    /**
     * Default event
     */
    public function __default() {
        $paytabsConfiguration = new Amhsoft_Config_Table_Adapter('paytabs');

        $merchantID = $paytabsConfiguration->getValue('merchant_id');
        $merchantPassword = $paytabsConfiguration->getValue('merchant_password');
        $paytabsCurrency = $paytabsConfiguration->getValue('paytabs_currency');
        $paytabsLanguage = $paytabsConfiguration->getValue('paytabs_lang');
        $gateway_url = 'https://www.paytabs.com/';

        $request_string_auth = array(
            'merchant_id' => $merchantID,
            'merchant_password' => $merchantPassword
        );

        $api_data = $this->sendRequest($gateway_url . 'api/authentication', $request_string_auth);


        $object_api = json_decode($api_data);
        $api_key = $object_api->api_key;
        $_SESSION['api_key'] = $api_key;



        $lang_ = $paytabsLanguage;


        $order_description = '';
        $order_address = '';
        $categories = "";
        $product_title = "";
        $quantity = "";
        $per_price = "";
        $per_title = "";
        $amount = "";


        //print_r($order);exit();

        $current_currency = Amhsoft_Common::GetCookie('current_currency');

        if (!$current_currency) {
            $current_currency = 'SAR';
        }
        /*         * if($current_currency == $paytabsCurrency){
          $final_amount = $this->saleOrder->getTotalPrice();
          }else{
          $final_amount = Amhsoft_Locale::convertCurrency($this->saleOrder->getTotalPrice(), $paytabsCurrency,$current_currency, 3);
          }* */

        $final_amount = $this->saleOrder->getTotalPrice();

        foreach ($this->saleOrder->getItems() as $item) {

            if (count($this->saleOrder->getItems()) > 1) {

                $order_description .= ', ' . $item->getItemName();
                $product_title .= ', ' . $item->getItemName();
                $quantity .= ' || ' . $item->getQuantity();
                $per_price .= ' || ' . $item->getUnitPrice();
                $per_title .= ' || ' . $item->getItemName();
                $amount .= '|| ' . $final_amount;
            } else {

                $order_description = $item->getItemName();
                $product_title = $item->getItemName();
                $quantity = $item->getQuantity();
                $per_price = $item->getUnitPrice();
                $per_title = $item->getItemName();
                $amount = $final_amount;
            }
        }

        $request_param = array('api_key' => $api_key,
            'cc_first_name' => $this->saleOrder->getAccount()->getName(),
            'cc_last_name' => "",
            'phone_number' => $this->saleOrder->getAccount()->getMobile(),
            'billing_address' => $this->saleOrder->getAccount()->getStreet(),
            'city' => $this->saleOrder->getAccount()->getCity(),
            'state' => $this->saleOrder->getAccount()->getProvince(),
            'postal_code' => $this->saleOrder->getAccount()->getZipcode(),
            'country' => $this->saleOrder->getAccount()->getCountry(),
            'email' => $this->saleOrder->getAccount()->getEmail(),
            'amount' => $final_amount,
            'currency' => $paytabsCurrency,
            'title' => $order_description,
            'quantity' => $quantity,
            "unit_price" => $per_price,
            "products_per_title" => $product_title,
            'ip_customer' => $_SERVER['REMOTE_ADDR'],
            'ip_merchant' => $_SERVER['SERVER_ADDR'],
            'msg_lang' => $lang_,
            'quantity' => $quantity,
            'products_per_title' => $per_title,
            'ProductCategory' => $categories,
            "msg_lang" => $lang_,
            'unit_price' => $per_price,
            'city_shipping' => $this->saleOrder->getAccount()->getCity(),
            'address_shipping' => $this->saleOrder->getAccount()->getStreet(),
            'postal_code_shipping' => $this->saleOrder->getAccount()->getZipcode(),
            'CustomerId' => $this->saleOrder->getAccount()->getId(),
            'state_shipping' => $this->saleOrder->getAccount()->getProvince(),
            'return_url' => Amhsoft_System_Config::getProperty("appurl") . "/index.php?module=paytabs&page=confirm&hash=" . $this->hashedKEY
        );


        $request_string = http_build_query($request_param);
        return;
        $response_data = $this->sendRequest($gateway_url . 'api/create_pay_page', $request_string);

        $object = json_decode($response_data);


        if (isset($object->payment_url) && $object->payment_url != '') {
            $this->getRedirector()->go($object->payment_url);
        } else {
            echo "error";
            exit;
        }
    }

    public function sendRequest($gateway_url, $request_string) {
        $ch = @curl_init();
        @curl_setopt($ch, CURLOPT_URL, $gateway_url);
        @curl_setopt($ch, CURLOPT_POST, true);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $request_string);
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        @curl_setopt($ch, CURLOPT_HEADER, false);
        @curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        @curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        @curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        @curl_setopt($ch, CURLOPT_VERBOSE, true);
        $result = @curl_exec($ch);
        if (!$result)
            die(curl_error($ch));

        @curl_close($ch);

        return $result;
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        
    }

}

?>
