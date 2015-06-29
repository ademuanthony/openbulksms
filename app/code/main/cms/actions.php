<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 6/29/2015
 * Time: 4:39 PM
 */

class Actions extends OpenSms_Abstract_Module_Controller{
    public static function TriggerEditor(){
        if(isset($_GET['action']) && $_GET['action'] == 'cms'){
            OpenSms::checkLogin(OpenSms::OPEN_ROLE_ADMIN);
            OpenSms::registerView('cms_trigger', 'default/assets/js/cms.js', OpenSms::VIEW_TYPE_SCRIPT, OpenSms::VIEW_POSITION_TOP);
        }
    }
} 