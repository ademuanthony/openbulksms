<?php
/**
 * Created by Ademu Anthony.
 * User: Tony
 * Date: 3/23/2015
 * Time: 9:26 AM
 */

class Dashboard extends OpenSms_Abstract_Module_Controller {
    public function Index(){
        $this->getCurrentUri();
        $user = $this->checkLogin();
        $this->data['user'] = $user;
        $this->data['transactions'] = $user->GetTransactions();

        $this->data['pageTitle'] = 'Dashboard | '.OpenSms::getSystemSetting(OpenSms::SITE_NAME);
        $this->renderTemplate('body');
    }
} 