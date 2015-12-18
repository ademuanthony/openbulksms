<?php
class Home extends OpenSms_Abstract_Module_Controller{
    public function Index(){
        $this->data['pageTitle'] = OpenSms::getSystemSetting(OpenSms::SITE_NAME);
        $this->renderTemplate();
    }

}
