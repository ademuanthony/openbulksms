<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 4/7/2015
 * Time: 9:41 AM
 */

class Admin_UBA_Bank_Controller extends OpenSms_Abstract_Module_Controller {
    public function Pay(OpenSms_Model_Transaction $transaction){
        OpenSms::redirectToAction('Finish', 'UBA', 'Admin');
    }

    public function Finish(){
        $this->data['pageTitle'] = 'Order Placed';
        $this->renderTemplate();
    }
} 