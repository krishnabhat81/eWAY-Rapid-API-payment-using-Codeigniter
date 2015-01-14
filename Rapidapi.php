<?php
/**
The library is customized by: Krishna Bhat
Email: krishna1bhat@gmail.com
Address: Kathmandu, Nepal
Contact: 00977-9848417043 
 **/

/**
 * A PHP eWAY Rapid API library implementation.
 * This class is an example of how to connect to eWAY's Rapid API.
 *
 * Requires PHP 5.3 or greater with the cURL extension
 *
 * @see http://api-portal.anypoint.mulesoft.com/eway/api/eway-rapid-31-api/docs/
 * @version 1.0
 * @package eWAY
 * @author eWAY
 * @copyright (c) 2014, Web Active Corporation Pty Ltd
 */
//namespace eWAY;

/**
 * eWAY Rapid 3.1 Library
 *
 * Check examples for usage
 *
 * @package eWAY
 */
class Rapidapi {

    /**
     * @var string the eWAY endpoint
     */
    private $_url;

    /**
     * @var bool true if using eWAY sandbox
     */
    private $sandbox = true; //if true => sandbox, for live make false

    /**
     * @var string the eWAY API key
     */
    private $username = "60CF3CYVn3kQHKDPQwNm+OqAr8YYmt2JDoRXSUI3Ie8uFrOKACaip9lsvhmxiIE7zKfj90"; //sandbox API key

    /**
     * @var string the eWAY API password
     */
    private $password = "EBkrishna123"; //sandbox API password;
    var $AccessCode = '';
    var $TotalAmount = '0.00';
    var $CurrencyCode = 'AUD';
    var $RedirectUrl = '';
    var $CancelUrl = '';
    var $Method = "ProcessPayment";
    var $TransactionType = '';
    var $CustomerIP = null;
    var $LogoUrl = 'https://avatars1.githubusercontent.com/u/6686254?v=3&s=460';
    var $HeaderText = '';
    var $CustomerReadOnly = true;
    var $DeviceID = null;
    var $Cust_TokenCustomerID = null;
    var $Cust_Reference = null;
    var $Cust_Title = null;
    var $Cust_FirstName = null;
    var $Cust_LastName = null;
    var $Cust_CompanyName = null;
    var $Cust_JobDescription = null;
    var $Cust_Street1 = null;
    var $Cust_Street2 = null;
    var $Cust_City = null;
    var $Cust_State = null;
    var $Cust_PostalCode = null;
    var $Cust_Country = null;
    var $Cust_Email = null;
    var $Cust_Phone = null;
    var $Cust_Mobile = null;
    var $Cust_Comments = null;
    var $Cust_Fax = null;
    var $Cust_Url = null;
    var $Ship_add_FirstName = null;
    var $Ship_add_LastName = null;
    var $Ship_add_Street1 = null;
    var $Ship_add_Street2 = null;
    var $Ship_add_City = null;
    var $Ship_add_State = null;
    var $Ship_add_Country = null;
    var $Ship_add_PostalCode = null;
    var $Ship_add_Email = null;
    var $Ship_add_Phone = null;
    var $Ship_add_ShippingMethod = null;
    var $Items = null;
    var $Options = null;
    public $_codes = array(
        'F7000' => "Undefined Fraud",
        'V5000' => "Undefined System",
        'A0000' => "Undefined Approved",
        'A2000' => "Transaction Approved",
        'A2008' => "Honour With Identification",
        'A2010' => "Approved For Partial Amount",
        'A2011' => "Approved VIP",
        'A2016' => "Approved Update Track 3",
        'V6000' => "Undefined Validation",
        'V6001' => "Invalid Request CustomerIP",
        'V6002' => "Invalid Request DeviceID",
        'V6011' => "Invalid Payment Amount",
        'V6012' => "Invalid Payment InvoiceDescription",
        'V6013' => "Invalid Payment InvoiceNumber",
        'V6014' => "Invalid Payment InvoiceReference",
        'V6015' => "Invalid Payment CurrencyCode",
        'V6016' => "Payment Required",
        'V6017' => "Payment CurrencyCode Required",
        'V6018' => "Unknown Payment CurrencyCode",
        'V6021' => "Cardholder Name Required",
        'V6022' => "Card Number Required",
        'V6023' => "CVN Required",
        'V6031' => "Invalid Card Number",
        'V6032' => "Invalid CVN",
        'V6033' => "Invalid Expiry Date",
        'V6034' => "Invalid Issue Number",
        'V6035' => "Invalid Start Date",
        'V6036' => "Invalid Month",
        'V6037' => "Invalid Year",
        'V6040' => "Invalid Token Customer Id",
        'V6041' => "Customer Required",
        'V6042' => "Customer First Name Required",
        'V6043' => "Customer Last Name Required",
        'V6044' => "Customer Country Code Required",
        'V6045' => "Customer Title Required",
        'V6046' => "Token Customer ID Required",
        'V6047' => "RedirectURL Required",
        'V6051' => "Invalid Customer First Name",
        'V6052' => "Invalid Customer Last Name",
        'V6053' => "Invalid Customer Country Code",
        'V6054' => "Invalid Customer Email",
        'V6055' => "Invalid Customer Phone",
        'V6056' => "Invalid Customer Mobile",
        'V6057' => "Invalid Customer Fax",
        'V6058' => "Invalid Customer Title",
        'V6059' => "Redirect URL Invalid",
        'V6060' => "Redirect URL Invalid",
        'V6061' => "Invalid Customer Reference",
        'V6062' => "Invalid Customer CompanyName",
        'V6063' => "Invalid Customer JobDescription",
        'V6064' => "Invalid Customer Street1",
        'V6065' => "Invalid Customer Street2",
        'V6066' => "Invalid Customer City",
        'V6067' => "Invalid Customer State",
        'V6068' => "Invalid Customer Postalcode",
        'V6069' => "Invalid Customer Email",
        'V6070' => "Invalid Customer Phone",
        'V6071' => "Invalid Customer Mobile",
        'V6072' => "Invalid Customer Comments",
        'V6073' => "Invalid Customer Fax",
        'V6074' => "Invalid Customer Url",
        'V6075' => "Invalid ShippingAddress FirstName",
        'V6076' => "Invalid ShippingAddress LastName",
        'V6077' => "Invalid ShippingAddress Street1",
        'V6078' => "Invalid ShippingAddress Street2",
        'V6079' => "Invalid ShippingAddress City",
        'V6080' => "Invalid ShippingAddress State",
        'V6081' => "Invalid ShippingAddress PostalCode",
        'V6082' => "Invalid ShippingAddress Email",
        'V6083' => "Invalid ShippingAddress Phone",
        'V6084' => "Invalid ShippingAddress Country",
        'V6091' => "Unknown Country Code",
        'V6100' => "Invalid ProcessRequest name",
        'V6101' => "Invalid ProcessRequest ExpiryMonth",
        'V6102' => "Invalid ProcessRequest ExpiryYear",
        'V6103' => "Invalid ProcessRequest StartMonth",
        'V6104' => "Invalid ProcessRequest StartYear",
        'V6105' => "Invalid ProcessRequest IssueNumber",
        'V6106' => "Invalid ProcessRequest CVN",
        'V6107' => "Invalid ProcessRequest AccessCode",
        'V6108' => "Invalid ProcessRequest CustomerHostAddress",
        'V6109' => "Invalid ProcessRequest UserAgent",
        'V6110' => "Invalid ProcessRequest Number",
        'V6111' => "Unauthorised API Access, Account Not PCI Certified",
        'V6112' => "Redundant card details other than expiry year and month",
        'V6113' => "Invalid transaction for refund",
        'V6114' => "Gateway validation error",
        'V6115' => "Invalid DirectRefundRequest, Transaction ID",
        'V6116' => "Invalid card data on original TransactionID",
        'V6117' => "Invalid CreateAccessCodeSharedRequest, FooterText",
        'V6118' => "Invalid CreateAccessCodeSharedRequest, HeaderText",
        'V6119' => "Invalid CreateAccessCodeSharedRequest, Language",
        'V6120' => "Invalid CreateAccessCodeSharedRequest, LogoUrl",
        'V6121' => "Invalid TransactionSearch, Filter Match Type",
        'V6122' => "Invalid TransactionSearch, Non numeric Transaction ID",
        'V6123' => "Invalid TransactionSearch,no TransactionID or AccessCode specified",
        'V6124' => "Invalid Line Items. The line items have been provided however the totals do not match the TotalAmount field",
        'V6125' => "Selected Payment Type not enabled",
        'V6126' => "Invalid encrypted card number, decryption failed",
        'V6127' => "Invalid encrypted cvn, decryption failed",
        'D4401' => "Refer to Issuer",
        'D4402' => "Refer to Issuer, special",
        'D4403' => "No Merchant",
        'D4404' => "Pick Up Card",
        'D4405' => "Do Not Honour",
        'D4406' => "Error",
        'D4407' => "Pick Up Card, Special",
        'D4409' => "Request In Progress",
        'D4412' => "Invalid Transaction",
        'D4413' => "Invalid Amount",
        'D4414' => "Invalid Card Number",
        'D4415' => "No Issuer",
        'D4419' => "Re-enter Last Transaction",
        'D4421' => "No Method Taken",
        'D4422' => "Suspected Malfunction",
        'D4423' => "Unacceptable Transaction Fee",
        'D4425' => "Unable to Locate Record On File",
        'D4430' => "Format Error",
        'D4431' => "Bank Not Supported By Switch",
        'D4433' => "Expired Card, Capture",
        'D4434' => "Suspected Fraud, Retain Card",
        'D4435' => "Card Acceptor, Contact Acquirer, Retain Card",
        'D4436' => "Restricted Card, Retain Card",
        'D4437' => "Contact Acquirer Security Department, Retain Card",
        'D4438' => "PIN Tries Exceeded, Capture",
        'D4439' => "No Credit Account",
        'D4440' => "Function Not Supported",
        'D4441' => "Lost Card",
        'D4442' => "No Universal Account",
        'D4443' => "Stolen Card",
        'D4444' => "No Investment Account",
        'D4451' => "Insufficient Funds",
        'D4452' => "No Cheque Account",
        'D4453' => "No Savings Account",
        'D4454' => "Expired Card",
        'D4455' => "Incorrect PIN",
        'D4456' => "No Card Record",
        'D4457' => "Function Not Permitted to Cardholder",
        'D4458' => "Function Not Permitted to Terminal",
        'D4460' => "Acceptor Contact Acquirer",
        'D4461' => "Exceeds Withdrawal Limit",
        'D4462' => "Restricted Card",
        'D4463' => "Security Violation",
        'D4464' => "Original Amount Incorrect",
        'D4466' => "Acceptor Contact Acquirer, Security",
        'D4467' => "Capture Card",
        'D4475' => "PIN Tries Exceeded",
        'D4482' => "CVV Validation Error",
        'D4490' => "Cutoff In Progress",
        'D4491' => "Card Issuer Unavailable",
        'D4492' => "Unable To Route Transaction",
        'D4493' => "Cannot Complete, Violation Of The Law",
        'D4494' => "Duplicate Transaction",
        'D4496' => "System Error",
    );

    /**
     * RapidAPI constructor
     *
     * @param string $username your eWAY API Key
     * @param string $password your eWAY API Password
     * @param string $params set $params['sandbox'] to true to use the sandbox for testing
     */
    function __construct($params = array()) {

        if ($this->sandbox == true) {
            $this->_url = 'https://api.sandbox.ewaypayments.com/';
        } else {
            $this->_url = 'https://api.ewaypayments.com/';
        }

        if (isset($params['TotalAmount']))
            $this->TotalAmount = $params['TotalAmount'];
        if (isset($params['CurrencyCode']))
            $this->CurrencyCode = $params['CurrencyCode'];
        if (isset($params['RedirectUrl']))
            $this->RedirectUrl = $params['RedirectUrl'];
        if (isset($params['CancelUrl']))
            $this->CancelUrl = $params['CancelUrl'];

        $this->CustomerIP = $_SERVER["REMOTE_ADDR"];

//        echo "<pre>";print_r($params);echo "</pre><br /><br />";
//        echo "<pre>";print_r($this);echo "</pre><br /><br />";
    }

    function setAccessCode($accessCode) {
        $this->AccessCode = $accessCode;
    }

    /**
     * Create a request for a Transparent Redirect Access Code
     *
     * @param eWAY\CreateAccessCodeRequest $request
     * @return object
     */
    public function CreateAccessCode($request) {
        if (isset($request->Options) && count($request->Options->Option)) {
            $i = 0;
            $tempClass = new \stdClass();
            foreach ($request->Options->Option as $Option) {
                $tempClass->Options[$i] = $Option;
                $i++;
            }
            $request->Options = $tempClass->Options;
        }
        if (isset($request->Items) && count($request->Items->LineItem)) {
            $i = 0;
            $tempClass = new \stdClass();
            foreach ($request->Items->LineItem as $LineItem) {
                // must be strings
                $LineItem->Quantity = strval($LineItem->Quantity);
                $LineItem->UnitCost = strval($LineItem->UnitCost);
                $LineItem->Tax = strval($LineItem->Tax);
                $LineItem->Total = strval($LineItem->Total);
                $tempClass->Items[$i] = $LineItem;
                $i++;
            }
            $request->Items = $tempClass->Items;
        }

        $request = json_encode($request);
        $response = $this->PostToRapidAPI("AccessCodes", $request);
        return json_decode($response);
    }

    /**
     * Get the result from an AccessCode after a customer has completed
     * a payment
     *
     * @param eWAY\GetAccessCodeResultRequest $request
     * @return object
     */
    public function GetAccessCodeResult($AccessCode) {
        //$request = array("AccessCode" => $this->accessCode);
        $this->accessCode = $AccessCode;
        $request = array("AccessCode" => $this->accessCode);
        $request = json_encode($request);
        //{"AccessCode":"C3AB9Rc7XltpcTDnlU3m-paSAoefiYTxgwoL_wu4Fgb0qfTC_eIfN22ZRC-h_LxUTnKzLVf-_70vFzTE_-dq3jeosBvcnP08BuQOssGFosemp4wWTJKGNBQtw932Qviki0Yq2"}
        $response = $this->PostToRapidAPI("AccessCode/" . $_GET['AccessCode'], $request, false);
        return json_decode($response);
    }

    /**
     * Create an AccessCode for a Responsive Shared Page payment
     *
     * @param eWAY\CreateAccessCodesSharedRequest $request
     * @return object type
     */
    public function CreateAccessCodesShared() {
        $request = array();
        $request['CancelUrl'] = $this->CancelUrl;
        $request['LogoUrl'] = $this->LogoUrl;
        $request['HeaderText'] = $this->HeaderText;
        $request['CustomerReadOnly'] = $this->CustomerReadOnly;
        $request['Customer'] = null;
        $request['ShippingAddress'] = null;
        $request['Customer'] = array("TokenCustomerID" => $this->Cust_TokenCustomerID, "Reference" => $this->Cust_Reference, "Title" => $this->Cust_Title, "FirstName" => $this->Cust_FirstName, "LastName" => $this->Cust_LastName, "CompanyName" => $this->Cust_CompanyName, "JobDescription" => $this->Cust_JobDescription, "Street1" => $this->Cust_Street1, "Street2" => $this->Cust_Street2, "City" => $this->Cust_City, "State" => $this->Cust_State, "PostalCode" => $this->Cust_PostalCode, "Country" => $this->Cust_Country, "Email" => $this->Cust_Email, "Phone" => $this->Cust_Phone, "Mobile" => $this->Cust_Mobile, "Comments" => $this->Cust_Comments, "Fax" => $this->Cust_Fax, "Url" => $this->Cust_Url);
        $request['ShippingAddress'] = array("FirstName" => $this->Ship_add_FirstName, "LastName" => $this->Ship_add_LastName, "Street1" => $this->Ship_add_Street1, "Street2" => $this->Ship_add_Street2, "City" => $this->Ship_add_City, "State" => $this->Ship_add_State, "Country" => $this->Ship_add_Country, "PostalCode" => $this->Ship_add_PostalCode, "Email" => $this->Ship_add_Email, "Phone" => $this->Ship_add_Phone, "ShippingMethod" => $this->Ship_add_ShippingMethod);
        $request["Items"] = $this->Items;
        $request["Options"] = $this->Options;
        $request["Payment"] = array("TotalAmount" => $this->TotalAmount, "InvoiceNumber" => null, "InvoiceDescription" => null, "InvoiceReference" => null, "CurrencyCode" => $this->CurrencyCode);
        $request["RedirectUrl"] = $this->RedirectUrl;
        $request["Method"] = $this->Method;
        $request["TransactionType"] = $this->TransactionType;
        $request["CustomerIP"] = $this->CustomerIP;
        $request["DeviceID"] = $this->DeviceID;
        //$request['CardDetails'] = array("Name"=>"Krishna Bhat", "Number"=>"4444333322221111", "ExpiryMonth"=>"03", "ExpiryYear"=>"2016", "StartMonth"=>null, "StartYear"=>null, "IssueNumber"=>null,  "CVN"=>"123");
        //echo "<pre>";print_r($request);echo "</pre><br /><br />";die();
        $request = json_encode($request);
        //echo $request;die();
        //$request = '{"CancelUrl":"http:\/\/ci.draftserver.com\/countrytrack\/rapid-3-1-eway\/examples\/ResponsiveSharedPage\/","LogoUrl":"","HeaderText":"","CustomerReadOnly":true,"Customer":{"TokenCustomerID":null,"Reference":null,"Title":null,"FirstName":null,"LastName":null,"CompanyName":null,"JobDescription":null,"Street1":null,"Street2":null,"City":null,"State":null,"PostalCode":null,"Country":null,"Email":null,"Phone":null,"Mobile":null,"Comments":null,"Fax":null,"Url":null},"ShippingAddress":{"FirstName":null,"LastName":null,"Street1":null,"Street2":null,"City":null,"State":null,"Country":null,"PostalCode":null,"Email":null,"Phone":null,"ShippingMethod":null},"Items":null,"Options":null,"Payment":{"TotalAmount":"100","InvoiceNumber":null,"InvoiceDescription":null,"InvoiceReference":null,"CurrencyCode":"AUD"},"RedirectUrl":"http:\/\/ci.draftserver.com\/countrytrack\/rapid-3-1-eway\/examples\/ResponsiveSharedPage\/","Method":"ProcessPayment","TransactionType":"","CustomerIP":"202.166.198.119","DeviceID":null}';
        $response = $this->PostToRapidAPI("AccessCodesShared", $request);
        return json_decode($response);
    }

    /**
     * Perform a Direct Payment
     *
     * Note: Before being able to send credit card data via the direct API, eWAY
     * must enable it on the account. To be enabled on a live account eWAY must
     * receive proof that the environment is PCI-DSS compliant.
     *
     * @param eWAY\CreateDirectPaymentRequest $request
     * @return object
     */
    public function DirectPayment($request) {
        if (isset($request->Options) && count($request->Options->Option)) {
            $i = 0;
            $tempClass = new \stdClass();
            foreach ($request->Options->Option as $Option) {
                $tempClass->Options[$i] = $Option;
                $i++;
            }
            $request->Options = $tempClass->Options;
        }
        if (isset($request->Items) && count($request->Items->LineItem)) {
            $i = 0;
            $tempClass = new \stdClass();
            foreach ($request->Items->LineItem as $LineItem) {
                $tempClass->Items[$i] = $LineItem;
                $i++;
            }
            $request->Items = $tempClass->Items;
        }

        $request = json_encode($request);
        $response = $this->PostToRapidAPI("Transaction", $request);
        return json_decode($response);
    }

    /**
     * Fetches the message associated with a Response Code
     *
     * @param string $code
     * @return string
     */
    public function getMessage($code) {
        return $this->_codes[$code];
    }

    /**
     * A Function for doing a Curl GET/POST
     *
     * @param string $url the path for this request
     * @param Request $request
     * @param boolean $IsPost set to false to perform a GET
     * @return string
     */
    private function PostToRapidAPI($url, $request, $IsPost = true) {
        //print_r($request);
        //echo "<br />";
        $url = $this->_url . $url;
        //echo "<pre>";print_r($this);echo "</pre><br /><br />";die();
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ":" . $this->password);
        if ($IsPost)
            curl_setopt($ch, CURLOPT_POST, true);
        else
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);

        // Uncomment this if you are getting SSL errors (common in WAMP)
        // Make sure it is enabled when you go live!
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Ucomment for CURL debugging
        //curl_setopt($ch, CURLOPT_VERBOSE, true);

        $response = curl_exec($ch);
        //print_r($response);die();
        if (curl_errno($ch) != CURLE_OK) {
            echo "<h2>POST Error: " . curl_error($ch) . " URL: $url</h2><pre>";
            die();
        } else {
            $info = curl_getinfo($ch);
            if ($info['http_code'] == 401 || $info['http_code'] == 404) {
                $__is_in_sandbox = $this->sandbox ? ' (Sandbox)' : ' (Live)';
                echo "<h2>Please check the API Key and Password $__is_in_sandbox</h2><pre>";
                die();
            }

            curl_close($ch);
            //echo "<pre>";print_r($response);echo "</pre><br /><br />";die();
            return $response;
        }
    }

}

?>
