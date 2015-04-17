<?php
/**
 * Created by Ademu Anthony.
 * User: Gabriel
 * Date: 4/11/2015
 * Time: 11:57 AM
 */

class UBA extends OpenSms_Abstract_Module_Controller{
    public function Index(){
        $this->data['pageTitle'] = "Finalize Order";
        $this->data['user'] = $this->checkLogin();

        $this->data['transaction'] = $this->data['user']->GetLastTransaction();

        $this->renderTemplate();
    }

    public function Pay(){
        OpenSms::redirectToAction('index', 'uba', 'payment');
    }
} 