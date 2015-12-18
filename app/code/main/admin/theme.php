<?php
/**
 * Created by Ademu Anthony.
 * User: Tony
 * Date: 4/9/2015
 * Time: 6:40 AM
 */

class Themes extends OpenSms_Abstract_Module_Controller{
    public function Index(){
        $this->data['user'] = $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);
        $this->data['themes'] = OpenSms_Model_System_Theme::getAll();
        $this->data['theme'] = $this->data['currentTheme'];
        $this->data['pageTitle'] = 'Manage Themes | '.OpenSms::getSystemSetting(OpenSms::SITE_NAME);
        $this->renderTemplate();
    }

    public function Add(){
        $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);
        if(!isset($_FILES['zip_file'])){
            $this->setError('Please select a valid theme file', 'themes_add');
            OpenSms::redirectToAction('Index');
        }

        if($_FILES["zip_file"]["name"]) {
            $filename = $_FILES["zip_file"]["name"];
            $source = $_FILES["zip_file"]["tmp_name"];
            $type = $_FILES["zip_file"]["type"];

            $name = explode(".", $filename);
            $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
            foreach($accepted_types as $mime_type) {
                if($mime_type == $type) {
                    $okay = true;
                    break;
                }
            }

            $continue = strtolower($name[1]) == 'zip' ? true : false;
            if(!$continue) {
                $message = "The file you are trying to upload is not a .zip file. Please try again.";
                $this->setError($message, 'themes_add');
            }

            $target_path = OpenSms::getDocumentRoot().$filename;
            if(move_uploaded_file($source, $target_path)) {
                $zip = new ZipArchive();
                $x = $zip->open($target_path);
                if ($x === true) {
                    $zip->extractTo(OpenSms::getDocumentRoot().OpenSms::DESIGN_PATH);
                    $zip->close();

                    unlink($target_path);
                    $message = "Your themes has been successfully installed";
                    $this->setNotification($message, 'themes_add');
                    OpenSms::redirectToAction('Index');
                }
            } else {
                $message = "There was a problem with the upload. Please try again.";
            }

            $this->setError($message, 'themes_add');
            OpenSms::redirectToAction('Index');
        }
        $this->setError('Invalid file name', 'themes_add');
        OpenSms::redirectToAction('Index');

    }

    public function Detail($key){
        $this->data['user'] = $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);
        $this->data['pageTitle'] = 'Manage Theme | '.OpenSms::getSystemSetting(OpenSms::SITE_NAME);
        $this->data['theme'] = new OpenSms_Model_System_Theme($key);

        $this->renderTemplate();
    }

    public function Update(){
        $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);

        if(isset($_POST['key'])) {
            $theme = new OpenSms_Model_System_Theme($_POST['key']);
            if (!$theme->exists) {
                $this->setError('Invalid theme name', 'themes_update');
                OpenSms::redirectToAction('index');
            }


            if (isset($_POST['Activate'])) {
                $config = simplexml_load_file(OpenSms::SETTINGS_FILE_PATH);
                $config->{OpenSms::CURRENT_THEME_KEY} = $this->getFormData('key');
                $config->saveXML(OpenSms::SETTINGS_FILE_PATH);
            }


            elseif(isset($_POST['Save'])){
                $theme_xml = simplexml_load_file($theme->getSettingsFile());

                foreach($theme_xml->fields->field as $field){
                    $field->value = $_POST[(string)$field->key]['value'];
                }

                $theme_xml->saveXML($theme->getSettingsFile());
            }

            $this->setNotification('Save changes succeeded', 'themes_update');
            OpenSms::redirectToAction('Detail', 'Themes', 'Admin', [0 => $theme->key]);
        }else{
            $this->setError('Invalid request param', 'themes_update');
            OpenSms::redirectToAction('Index', 'Themes', 'Admin');
        }
    }
}