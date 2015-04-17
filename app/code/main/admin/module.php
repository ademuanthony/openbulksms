<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 4/5/2015
 * Time: 6:17 AM
 */

class Modules extends OpenSms_Abstract_Module_Controller{
    public function Index(){
        $this->data['user'] = $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);

        $this->data['modules'] = OpenSms_Model_System_Module::getModules();
        $this->data['pageTitle'] = 'Modules | '. OpenSms::getSystemSetting(OpenSms::SITE_NAME);

        $this->renderTemplate();
    }

    public function Add(){
        $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);
        if(!isset($_FILES['zip_file'])){
            $this->setError('Please select a module file', 'modules_add');
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
                $this->setError($message, 'modules_add');
            }

            $target_path = OpenSms::getDocumentRoot().$filename;
            if(move_uploaded_file($source, $target_path)) {
                $zip = new ZipArchive();
                $x = $zip->open($target_path);
                if ($x === true) {
                    $zip->extractTo(OpenSms::getDocumentRoot());
                    $zip->close();

                    unlink($target_path);
                    $message = "Your module has been successfully installed";
                    $this->setNotification($message, 'modules_add');
                    OpenSms::redirectToAction('Index');
                }
            } else {
                $message = "There was a problem with the upload. Please try again.";
            }

            $this->setError($message, 'modules_add');
            OpenSms::redirectToAction('Index');
        }
        $this->setError('Invalid file name', 'module_add');
        OpenSms::redirectToAction('Index');

    }

    public function Detail($key){
        $this->data['user'] = $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);

        $this->data['module'] = OpenSms_Model_System_Module::getModule($key);
        $this->data['pageTitle'] = 'Module Detail | '. OpenSms::getSystemSetting(OpenSms::SITE_NAME);

        //var_dump($this->data['module']); die();

        $this->renderTemplate();
    }

    public function Update(){
        $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);

        if(isset($_POST['name'])) {
            $module = new OpenSms_Model_System_Module($_POST['name']);
            if (!$module->exists) {
                $this->setError('Invalid module name', 'modules_update');
                OpenSms::redirectToAction('index');
            }

            $module_xml = simplexml_load_file($module->fileName);

            if (isset($_POST['Disable'])) {

                if (OpenSms::OPEN_OPTION_YES == $module->enabled && strtolower($module->name) == 'admin') {
                    $this->setError("You can't disable the admin module", "modules_update");
                    OpenSms::redirectToAction('Detail', 'Modules', 'Admin', [0 => $module->name]);
                }
                $module_xml->enabled = (string)$module_xml->enabled == OpenSms::OPEN_OPTION_YES?OpenSms::OPEN_OPTION_NO:OpenSms::OPEN_OPTION_YES;
            }


            elseif(isset($_POST['Save'])){
                foreach($module_xml->payments->payment as $payment){
                    $payment->enable = $_POST[(string)$payment->key]['enabled'];
                    $payment->sort_order =  $_POST[(string)$payment->key]['sort_order'];
                    $payment->order_status =  $_POST[(string)$payment->key]['order_status'];
                }

                foreach($module_xml->fields->field as $field){
                    $field->value = $_POST[(string)$field->key]['value'];
                    $field->sort_order =  $_POST[(string)$field->key]['sort_order'];
                }
            }

            $module_xml->saveXML($module->fileName);
            $this->setNotification('Save changes succeeded', 'modules_update');
            OpenSms::redirectToAction('Detail', 'Modules', 'Admin', [0 => $module->name]);
        }else{
            $this->setError('Invalid request param', 'modules_update');
            OpenSms::redirectToAction('Index', 'Modules', 'Admin');
        }
    }
} 