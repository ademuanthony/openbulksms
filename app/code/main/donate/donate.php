<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 7/3/2015
 * Time: 9:42 AM
 */

class Donate extends OpenSms_Abstract_Module_Controller{
    public function index(){
        $this->data['pageTitle'] = 'Make Donation';
        $this->renderTemplate();
    }
} 