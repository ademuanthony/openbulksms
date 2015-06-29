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
            OpenSms::registerView('cms_ck_editor_js', 'default/assets/plugins/ckeditor/ckeditor.js', OpenSms::VIEW_TYPE_SCRIPT, OpenSms::VIEW_POSITION_TOP);
            OpenSms::registerView('cms_content_editor', 'default/template/cms/content_editor.php', OpenSms::VIEW_TYPE_HTML, OpenSms::VIEW_POSITION_FOOTER);
            OpenSms::registerView('cms_editor_js', 'default/assets/js/cms.js', OpenSms::VIEW_TYPE_SCRIPT, OpenSms::VIEW_POSITION_FOOTER);
            OpenSms::registerView('cms_editor_css', 'default/assets/css/cms.css', OpenSms::VIEW_TYPE_STYLE, OpenSms::VIEW_POSITION_TOP);
        }
    }
} 