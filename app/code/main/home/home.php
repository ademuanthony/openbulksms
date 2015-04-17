<?php
class Home extends OpenSms_Abstract_Module_Controller{
    public function Index(){
        $this->data['pageTitle'] = "Home Page | ".OpenSms::getSystemSetting(OpenSms::SITE_NAME)." : Cheapest bulk sms. Free Bulk sms site creator";
        $this->renderTemplate();
    }

}
