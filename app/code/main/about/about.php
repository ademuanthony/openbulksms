<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 7/3/2015
 * Time: 9:25 AM
 */

class About extends OpenSms_Abstract_Module_Controller{
    public function index(){
        $this->data['pageTitle'] = "About Us";
        $this->renderTemplate();
    }
} 