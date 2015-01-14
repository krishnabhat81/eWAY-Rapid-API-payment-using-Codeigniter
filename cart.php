<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends CI_Controller {

    private $user_id;

    public function __construct() {
        parent::__construct();
    }

    function checkout($order_id) {
        if (!$order_id)
            show_404();

        $response = array();

        $amount = 30; // real amount 
        $amount = $amount * 100; //The amount of the transaction in the lowest denomination for the currency (e.g. a $27.00 transaction would have a TotalAmount value of â€˜2700â€™) 
        $CurrencyCode = "AUD";
        $RedirectUrl = base_url("cart/eway_redirect/" . $order_id);
        $CancelUrl = base_url("cart/eway_cancel/" . $order_id);

        $params = array("TotalAmount" => $amount, "CurrencyCode" => $CurrencyCode, "RedirectUrl" => $RedirectUrl, "CancelUrl" => $CancelUrl);

        $this->load->library('rapidapi', $params);

        $result = $this->rapidapi->CreateAccessCodesShared();

        if (isset($result->Errors)) {
            // Get Error Messages from Error Code. Error Code Mappings are in the Config.ini file
            $ErrorArray = explode(",", $result->Errors);
            $lblError = "";
            foreach ($ErrorArray as $error) {
                $error = $this->rapidapi->getMessage($error);
                $lblError .= $error . "<br />\n";
            }
            $response['payment_error'] = $lblError; //if failed, show errors
        } else {
            $redirect_url = $response['redirect_url'] = $result->SharedPaymentUrl; //in success, redirect to eway site for payment
            redirect($redirect_url); //send to eway fro real payment
            return FALSE;
        }

        echo "<pre>";
        print_r($response);
        echo "</pre>";

        //$this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    /* Eway redirects after transaction finished */

    function eway_redirect($id) {//order_id
        if (!$id)
            show_404();

        $data = array();
        $data['error'] = false;
        unset($_SESSION['order_id']);

        if (isset($_GET['AccessCode']) && $_GET['AccessCode'] != "") {
            $AccessCode = $_GET['AccessCode'];
        } else {
            show_404();
        }

        $this->load->library('rapidapi');
        $result = $this->rapidapi->GetAccessCodeResult($AccessCode); //confirm tansaction

        $lblError = "";

        if (isset($result->Errors)) {
            $ErrorArray = explode(",", $result->Errors);
            foreach ($ErrorArray as $error) {
                $error = $this->rapidapi->getMessage($error);
                $lblError .= $error . "<br />\n";
            }
        }
        //echo $lblError;die();

        if (isset($lblError) && $lblError != "") {
            $data['error_message'] = $lblError;
            $data['error'] = true;
        } else {
            if ($result->ResponseMessage == "A2000" && $result->ResponseCode == '00') {//Transaction Approved
                echo "<pre>";
                print_r($result);
                echo "</pre>";
                //save to your database here, i have not created save function here
                $data['success_message'] = "The following order has been purchased successfully.";
            } else {
                $lblError .= "Your transaction has been inturrupted." . "<br />\n";
                $data['error_message'] = $lblError;
            }
        }
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        //$this->load->view('eway_sucess_v', $data);//view success message
    }

    /* Eway redirecs if transaction is cancelled by users */

    function eway_cancel($id) {
        if (!$id)
            show_404();
        $data = array();
        unset($_SESSION['order_id']);
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        //$this->load->view('eway_cancel_v', $data);//view cancel message
    }

}

?>
