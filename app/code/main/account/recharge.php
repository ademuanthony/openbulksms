<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 4/4/2015
 * Time: 3:08 PM
 */

class Recharge extends OpenSms_Abstract_Module_Controller{
    public function Index(){
        $this->data['user'] = $this->checkLogin();
        $this->data['pageTitle'] = 'But Unit';

        $this->data['payments'] = OpenSms::getPaymentMethods();


        $this->renderTemplate();
    }

    public function Save(){
        $user = $this->checkLogin();
        //create a transaction
        $trans = $this->loadModel("OpenSms_Model_Transaction");
        foreach($_POST as $key=>$value){
            $trans->{$key} = $value;
        }

        $trans->Unit = $trans->Amount/OpenSms::getSystemSetting(OpenSms::OPEN_PRICE_PER_UNIT);

        $trans->LoginId = $user->LoginId;
        //get the selected payment
        $payment = OpenSms::getPaymentMethod($_POST['PaymentMethod'], true);

        //var_dump($payment); die();

        //set the order status to that of the payment method
        $trans->Status = $payment->order_status;
        $trans->Type = OpenSms::OPEN_TRANSACTION_TYPE_CREDIT;
        //save the order
        $trans->Save();
        //put the transaction in session
        $_SESSION[OpenSms::LAST_TRANSACTION] = $trans;
        //make payment
        $paymentController = new $payment->controller();
        $paymentController->{$payment->action}();

    }

    public function Success(){

    }

    public function Failure(){

    }


} 