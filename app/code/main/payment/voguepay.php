<?php
/**
 * Created by PhpStorm.
 * User: Ademu
 * Date: 1/26/2016
 * Time: 4:19 AM
 */

class Voguepay extends OpenSms_Abstract_Module_Controller {
    public function Pay(){
        OpenSms::redirectToAction('index', 'Voguepay', 'payment');
    }

    public function Index(){
        if(isset($_POST['transaction_id'])){
            $this->Ping();
            $this->redirectToAction('Success');
        }
        $this->data['user'] = $this->checkLogin();
        $this->data['transaction'] = $this->data['user']->GetLastTransaction();
        if($this->data['transaction']->Status == OpenSms::OPEN_TRANSACTION_STATUS_COMPLETED){
            $this->setError("No pending transaction found", "voucher_index");
            OpenSms::redirectToAction('Index', 'Recharge', 'Account');
        }

        $this->data['tranxId'] = $this->data['transaction']->Id.'-876-876';
        $this->data['product'] = $this->data['transaction']->Unit . ' Bulk SMS unit';
        $this->data['price'] = $this->data['transaction']->Amount;

        $this->data['pageTitle'] = "Make Payment";

        $this->renderTemplate();
    }

    public function Ping()
    {
        ##It is assumed that you have put the URL to this file in the notification url (notify_url)
        ##of the form you submitted to voguepay.
        ##VoguePay Submits transaction id to this file as $_POST['transaction_id']
                /*--------------Begin Processing-----------------*/
        ##Check if transaction ID has been submitted
        $merchant_id = OpenSms::getField('Payment_Voguepay_MerchantId')->value;
        if(isset($_POST['transaction_id'])){
            //get the full transaction details as an json from voguepay
            $json = file_get_contents('https://voguepay.com/?v_transaction_id='.$_POST['transaction_id'].'&type=json');
            //create new array to store our transaction detail
            $transaction = json_decode($json, true);

            /*
            Now we have the following keys in our $transaction array
            $transaction['merchant_id'],
            $transaction['transaction_id'],
            $transaction['email'],
            $transaction['total'],
            $transaction['merchant_ref'],
            $transaction['memo'],
            $transaction['status'],
            $transaction['date'],
            $transaction['referrer'],
            $transaction['method']
            */

            if($transaction['total'] == 0)die('Invalid total');
            if($transaction['status'] != 'Approved')die('Failed transaction');
            if($transaction['merchant_id'] != $merchant_id)die('Invalid merchant');

            /*You can do anything you want now with the transaction details or the merchant reference.
            You should query your database with the merchant reference and fetch the records you saved for this transaction.
            Then you should compare the $transaction['total'] with the total from your database.*/
            $tranxId = explode('-', $transaction['merchant_ref'])[0];


            $tran = $this->loadModel('OpenSms_Model_Transaction', array(0=>$tranxId));


            if(empty($tran->Amount)) {
                die('Invalid transaction Id');
            }


            $tran->Status = OpenSms::OPEN_TRANSACTION_STATUS_COMPLETED;

            $result = $tran->Commit();
            if($result === true){
                $this->sendSmsAlert($tran);
            }

            dd($result);
        }
    }
}
