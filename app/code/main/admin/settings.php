<?php
/**
 * Created by Ademu Anthony.
 * User: Tony
 * Date: 4/4/2015
 * Time: 3:30 PM
 */

class Settings extends OpenSms_Abstract_Module_Controller {
    public function Index(){
        $this->data['user'] = $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);
        $this->data['pageTitle'] = 'Settings | '.$this->getSystemSetting(OpenSms::SITE_NAME);
        $this->data['settings'] = null;

        $this->renderTemplate();
    }

    public function Save(){
        //if installed goto dashboard
        if($this->getSystemSetting(OpenSms::INSTALLATION_STATUS))
            OpenSms::redirectToAction('index', 'dashboard');
        //var_dump($_POST);die();
        // CREATE
        $config = new SimpleXmlElement('<settings/>');

        $config->{OpenSms::VERSION} = $this->getSystemSetting(OpenSms::VERSION);
        $config->{OpenSms::SITE_NAME} = $this->getFormData(OpenSms::SITE_NAME);
        $config->{OpenSms::SITE_URL} = $this->getFormData(OpenSms::SITE_URL);


        $config->{OpenSms::DB_TYPE} = 'mysql';
        $config->{OpenSms::DB_HOST} = $this->getFormData(OpenSms::DB_HOST);
        $config->{OpenSms::DB_NAME} = $this->getFormData(OpenSms::DB_NAME);
        $config->{OpenSms::DB_TABLE_PREFIX} = $this->getFormData(OpenSms::DB_TABLE_PREFIX);
        $config->{OpenSms::DB_USERNAME} = $this->getFormData(OpenSms::DB_USERNAME);
        $config->{OpenSms::DB_PASSWORD} = $this->getFormData(OpenSms::DB_PASSWORD);
        $config->{OpenSms::DB_PASSWORD} = $this->getFormData(OpenSms::DB_PASSWORD);

        $config->{OpenSms::CURRENT_THEME_KEY} = $this->getFormData(OpenSms::CURRENT_THEME_KEY);

        $config->{OpenSms::OPEN_PRICE_PER_UNIT} = $this->getFormData(OpenSms::OPEN_PRICE_PER_UNIT);
        $config->{OpenSms::OPEN_UNITS_PER_SMS} = $this->getFormData(OpenSms::OPEN_UNITS_PER_SMS);

        $config->{OpenSms::INSTALLATION_STATUS} = false;
        //unlink(OpenSms::SETTINGS_FILE_PATH);
        $config->saveXML(OpenSms::SETTINGS_FILE_PATH);

        $this->setNotification('Settings saved', 'settings_save');
        OpenSms::redirectToAction('index');
    }
} 