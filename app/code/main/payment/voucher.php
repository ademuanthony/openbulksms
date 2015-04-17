<?php
/**
 * Created by Ademu Anthony.
 * User: Tony
 * Date: 4/15/2015
 * Time: 11:38 PM
 */

class Voucher extends OpenSms_Abstract_Module_Controller{
    public function Pay(){
        OpenSms::redirectToAction('index', 'voucher', 'payment');
    }

    public function Index(){
        $this->data['user'] = $this->checkLogin();
        $this->data['transaction'] = $this->data['user']->GetLastTransaction();
        if($this->data['transaction']->Status == OpenSms::OPEN_TRANSACTION_STATUS_COMPLETED){
            $this->setError("No pending transaction found", "voucher_index");
            OpenSms::redirectToAction('Index', 'Recharge', 'Account');
        }

        if(isset($_POST['pin'])){
            if(empty($_POST['pin']) || empty($_POST['serialNumber'])){
                $this->setError('Both PIN and serial number are required', 'voucher_index');
            }else{
                $card = OpenSms::loadModel('OpenSms_Model_Card', [0 => $_POST['serialNumber'], 1 => $_POST['pin']]);
                if($card->IsValid) {
                    $result = $card->Load($this->data['user']->LoginId);
                    if ($result['success'] != true) {
                        $this->setError($result['message'], 'voucher_index');
                    } else {
                        $this->data['transaction']->Status = OpenSms::OPEN_TRANSACTION_STATUS_COMPLETED;
                        $this->data['transaction']->Save();
                        $this->setNotification("Your account has been credited with $card->Unit units. Thanks for your patronage", 'voucher_index');
                        OpenSms::redirectToAction('index', 'dashboard', 'dashboard');
                    }
                }else{
                    $this->setError('Invalid card information. Please try again', 'voucher_index');
                }
            }
        }

        $this->data['pageTitle'] = "Load Voucher";

        $this->renderTemplate();
    }
}