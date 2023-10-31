<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use App\Models\CombinedOrder;
use App\Models\User;
use Session;

class AuthorizenetPaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index() {
        $user = User::where('id',session('user_id'))->first();
        $invoiceNumber = '';
        $lastName = '';
        $address = '';
        $city = '';
        $zip = '';
        $country = '';

        if(session('payment_type') == 'cart_payment'){
            $combined_order = CombinedOrder::where('code',session('order_code'))->first();
            $amount = round($combined_order->grand_total);
            $invoiceNumber = time().$combined_order->id;
            $lastName = $user->name;
        }
        elseif(session('payment_type') == 'wallet_payment') {
            $invoiceNumber = rand(10000,99999);
			$amount= session('amount');
            $lastName = $user->name;
        }
        elseif(session('payment_type') == 'seller_package_payment') {
            $invoiceNumber = rand(10000,99999);
			$amount = session('amount');
            $lastName = $user->name;
        }
        
        /* Create a merchantAuthenticationType object with authentication details
          retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(config('payment.authorizenet.AUTHORIZE_NET_MERCHANT_LOGIN_ID'));
        $merchantAuthentication->setTransactionKey(config('payment.authorizenet.AUTHORIZE_NET_MERCHANT_TRANSACTION_KEY'));

        // Set the transaction's refId
        $refId = 'ref' . time();
        $cardNumber = preg_replace('/\s+/', '', session('card_number'));
        
        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cardNumber);
        $creditCard->setExpirationDate(session('expiration_year') . "-" .session('expiration_month'));
        $creditCard->setCardCode(session('cvv'));

        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);
        
        // Create order information
        $order = new AnetAPI\OrderType();
        $order->setInvoiceNumber($invoiceNumber);
        // $order->setDescription("Golf Shirts");

        // Set the customer's Bill To address
        $customerAddress = new AnetAPI\CustomerAddressType();
        $customerAddress->setFirstName("");
        $customerAddress->setLastName($lastName);
        $customerAddress->setAddress($address);
        $customerAddress->setCity($city);
        $customerAddress->setZip($zip);
        $customerAddress->setCountry($country);

        // Set the customer's identifying information
        $customerData = new AnetAPI\CustomerDataType();
        $customerData->setId($user->id);
        $customerData->setEmail($user->email);

        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($amount);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setOrder($order);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setBillTo($customerAddress);
        $transactionRequestType->setCustomer($customerData);

        // Assemble the complete transaction request
        $requests = new AnetAPI\CreateTransactionRequest();
        $requests->setMerchantAuthentication($merchantAuthentication);
        $requests->setRefId($refId);
        $requests->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($requests);
        if (get_setting('authorizenet_sandbox') == 1) {
            $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        } else {
            $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        }
        
        // dd($response);
        if ($response != null) {
            // Check to see if the API request was successfully received and acted upon
            if ($response->getMessages()->getResultCode() == "Ok") {
                // Since the API request was successful, look for a transaction response
                // and parse it to display the results of authorizing the card
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getMessages() != null) {
                    // echo " Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n";
                    // echo " Transaction Response Code: " . $tresponse->getResponseCode() . "\n";
                    // echo " Message Code: " . $tresponse->getMessages()[0]->getCode() . "\n";
                    // echo " Auth Code: " . $tresponse->getAuthCode() . "\n";
                    // echo " Description: " . $tresponse->getMessages()[0]->getDescription() . "\n";
                    $payment_detalis = json_encode(
                            array(
                                'transId' => $tresponse->getTransId(),
                                'authCode' => $tresponse->getAuthCode(),
                                'accountType' => $tresponse->getAccountType(),
                                'accountNumber' => $tresponse->getAccountNumber(),
                                'refId' => $response->getRefId(),
                            )
                    );
                    $message_text = $tresponse->getMessages()[0]->getDescription().", Transaction ID: " . $tresponse->getTransId();
                    $msg_type = "success_msg";    

                    return ( new PaymentController )->payment_success($payment_detalis);
                    
                }
                else {
                    return ( new PaymentController )->payment_failed();
                }
                // Or, print errors if the API request wasn't successful
            }
            else {
                return ( new PaymentController )->payment_failed();       
            }
        }
        else {
            return ( new PaymentController )->payment_failed();
        }
    }

    public function cardType(){
        return (new AnetAPI\CreditCardType())->cardType();
    }

}
