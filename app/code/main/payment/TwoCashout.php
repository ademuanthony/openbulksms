<?php
/**
 * Created by PhpStorm.
 * User: Ademu
 * Date: 10/18/2015
 * Time: 10:19 AM
 */

class TwoCashout extends OpenSms_Abstract_Module_Controller {
    public function Pay(){
        OpenSms::redirectToAction('index', 'TwoCashout', 'payment');
    }

    public function Index(){
        $this->data['user'] = $this->checkLogin();
        $this->data['transaction'] = $this->data['user']->GetLastTransaction();
        if($this->data['transaction']->Status == OpenSms::OPEN_TRANSACTION_STATUS_COMPLETED){
            $this->setError("No pending transaction found", "voucher_index");
            OpenSms::redirectToAction('Index', 'Recharge', 'Account');
        }

        $this->data['product'] = $this->data['transaction']->Unit . ' Bulk SMS unit';
        $this->data['price'] = $this->data['transaction']->Amount/200;

        $this->data['pageTitle'] = "Make Payment";

        $this->renderTemplate();
    }

    public function Ping()
    {
        $user = $this->checkLogin();
        $transaction = $this->data['user']->GetLastTransaction();
        if ($_POST['credit_card_processed'] == "Y") {
            $transaction->Status = OpenSms::OPEN_TRANSACTION_STATUS_COMPLETED;
            $transaction->Commit();
            //$user->Balance += $transaction->Unit;
            //$user->Save();
            $this->setNotification('Account created', 'TwoCheckout_ping');
            $this->redirectToAction('Index', 'Dashboard', 'Dashboard');
        }
        $this->setNotification('Transaction failed', 'TwoCheckout_ping');
        $this->redirectToAction('Index', 'recharge', 'account');
    }
} 