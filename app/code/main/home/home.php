<?php
class Home extends OpenSms_Abstract_Module_Controller{
    public function Index(){
        $this->data['pageTitle'] = OpenSms::getSystemSetting(OpenSms::SITE_NAME);
        $this->data['pageKeyword'] = OpenSms::getSystemSetting(OpenSms::SITE_HOME_KEYWORD);
        $this->data['pageDescription'] = OpenSms::getSystemSetting(OpenSms::SITE_HOME_DESCRIPTION);
        $this->renderTemplate();
    }

}
