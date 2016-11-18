<?php
/**
 * Created by PhpStorm.
 * User: Ademu
 * Date: 1/26/2016
 * Time: 4:57 AM
 */

class Payment extends OpenSms_Abstract_Module_Controller {
    function Success(){
        $this->data['user'] = $this->checkLogin();
        $this->data['transaction'] = $this->data['user']->GetLastTransaction();
        $this->data['title'] = "Payment completed";
        $this->renderTemplate();
    }

    function Failed(){
        $this->data['user'] = $this->checkLogin();
        $this->data['transaction'] = $this->data['user']->GetLastTransaction();
        $this->data['title'] = "Payment failed";

        $this->renderTemplate();
    }
} 
