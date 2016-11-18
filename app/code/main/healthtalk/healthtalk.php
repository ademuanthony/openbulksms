<?php
/**
 * Created by PhpStorm.
 * User: Ademu
 * Date: 11/20/2015
 * Time: 12:02 PM
 */

class HealthTalk extends OpenSms_Abstract_Module_Controller {
    public function Index(){
        $this->data['pageTitle'] = 'Health Talk';
        $this->data['pages'] = $this->callModelStaticMethod("OpenSms_Model_Page", "GetAll", array(0=>'page'));
        $this->renderTemplate();
    }

    public function Read($permmalink){
        $this->data['page'] = $this->loadModel('OpenSms_Model_Page', array(0=>$permmalink));
        $this->data['pageTitle'] = $this->data['page']->Title;
        $this->renderTemplate();
    }
} 