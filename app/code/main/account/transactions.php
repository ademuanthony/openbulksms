<?php
/**
 * Created by Ademu Anthony.
 * User: Tony
 * Date: 4/4/2015
 * Time: 12:44 PM
 */

class Transactions extends OpenSms_Abstract_Module_Controller {
    public function Index(){
        $this->data['user'] = $this->checkLogin();
        $this->data['transactions'] = $this->data['user']->GetTransactions();

        $this->data['pageTitle'] = 'My Transactions | ' . OpenSms::getSystemSetting(OpenSms::SITE_NAME);
        $this->renderTemplate();
    }

    public function Add(){

    }

    public function Success(){

    }

    public function Failure(){

    }
} 