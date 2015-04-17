<?php
/**
 * Created by Ademu Anthony.
 * User: Tony
 * Date: 3/20/2015
 * Time: 10:09 AM
 */

class Install extends OpenSms_Abstract_Module_Controller {
    public function Index(){
        //if installed goto dashboard
        if( $this->getSystemSetting(OpenSms::INSTALLATION_STATUS) == 'installed')
            OpenSms::redirectToAction('index', 'dashboard');

        $this->data['pageTitle'] = 'Install | OpenSMS';
        $this->renderTemplate('body');
    }

    public function Save(){
        if(!isset($_POST[OpenSms::DB_HOST])) OpenSms::redirectToAction('index');
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

        $config->{OpenSms::CURRENT_THEME} = 'default';

        $config->{OpenSms::OPEN_PRICE_PER_UNIT} = $this->getFormData(OpenSms::OPEN_PRICE_PER_UNIT);
        $config->{OpenSms::OPEN_UNITS_PER_SMS} = $this->getFormData(OpenSms::OPEN_UNITS_PER_SMS);

        $config->{OpenSms::INSTALLATION_STATUS} = 'installed';
        //unlink(OpenSms::SETTINGS_FILE_PATH);
        $config->saveXML(OpenSms::SETTINGS_FILE_PATH);


        $this->loadSystemSettings();
        //create tables
        OpenSms_Helper_Db::executeNonQuery($this->getDbScript());
        //create admin account
        $user = $this->loadModel('OpenSms_Model_User');
        $user->LoginId = $this->getFormData('admin_username');
        $user->Password = $this->getFormData('admin_password');
        $user->Role = OpenSms_Model_User::ADMIN;

        $saved = $user->save();


        OpenSms::redirectToAction('complete', 'install', 'admin', [0=>$saved == true?1:0]);
    }

    private function getDbScript(){
        $sql = "CREATE TABLE IF NOT EXISTS `". $this->getTableName('admins')."` (
          `userName` varchar(128) NOT NULL,
          `password` varchar(265) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        CREATE TABLE IF NOT EXISTS `". $this->getTableName('bulksms')."` (
          `id` int(11) NOT NULL,
          `loginId` varchar(50) NOT NULL,
          `sender` varchar(18) NOT NULL,
          `message` text NOT NULL,
          `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `status` int(11) NOT NULL,
          `count` int(11) NOT NULL
        ) ENGINE=InnoDB AUTO_INCREMENT=346 DEFAULT CHARSET=utf8;



        CREATE TABLE IF NOT EXISTS `". $this->getTableName('cards')."` (
          `id` int(11) NOT NULL,
          `serialNumber` varchar(5) NOT NULL,
          `pin` varchar(128) NOT NULL,
          `unit` int(11) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


        CREATE TABLE IF NOT EXISTS `". $this->getTableName('contact')."` (
          `id` int(11) NOT NULL,
          `groupId` int(11) NOT NULL,
          `number` varchar(18) NOT NULL,
          `name` varchar(128) NOT NULL
        ) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf8;


        CREATE TABLE IF NOT EXISTS `". $this->getTableName('contents')."` (
          `id` int(11) NOT NULL,
          `name` varchar(265) NOT NULL,
          `secured` varchar(4) NOT NULL,
          `body` text NOT NULL,
          `imageSrc` varchar(265) NOT NULL,
          `lastModificationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `status` varchar(50) NOT NULL DEFAULT 'Pending'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


        CREATE TABLE IF NOT EXISTS `". $this->getTableName('draft')."` (
          `id` int(11) NOT NULL,
          `loginId` varchar(128) NOT NULL,
          `recepient` text NOT NULL,
          `message` varchar(1500) NOT NULL,
          `sender` varchar(18) NOT NULL,
          `deliveryType` varchar(18) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


        CREATE TABLE IF NOT EXISTS `". $this->getTableName('group')."` (
          `id` int(11) NOT NULL,
          `loginId` varchar(128) NOT NULL,
          `name` varchar(128) NOT NULL,
          `description` text NOT NULL
        ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


        CREATE TABLE IF NOT EXISTS `". $this->getTableName('logins')."` (
          `id` int(11) NOT NULL,
          `loginId` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
          `token` varchar(265) COLLATE utf8_unicode_ci NOT NULL,
          `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


        CREATE TABLE IF NOT EXISTS `". $this->getTableName('passwordresettoken')."` (
          `id` int(11) NOT NULL,
          `token` varchar(265) NOT NULL,
          `emailId` varchar(128) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


        CREATE TABLE IF NOT EXISTS `". $this->getTableName('sms')."` (
          `id` int(11) NOT NULL,
          `bulkSMSId` int(11) NOT NULL,
          `number` varchar(18) NOT NULL,
          `message` text NOT NULL,
          `sender` varchar(18) NOT NULL,
          `status` int(11) NOT NULL,
          `refId` varchar(50) NOT NULL
        ) ENGINE=InnoDB AUTO_INCREMENT=26664 DEFAULT CHARSET=utf8;


        CREATE TABLE IF NOT EXISTS `". $this->getTableName('transactions')."` (
          `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `amount` double NOT NULL,
          `unit` INT NOT NULL,
          `status` varchar(64) NOT NULL,
          `description` varchar(265) NOT NULL,
          `paymentMethod` varchar(24) NOT NULL,
          `type` VARCHAR(16) NOT NULL,
          `committed` TINYINT NOT NULL DEFAULT '0',
          `loginId` varchar(128) NOT NULL,
          `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


        CREATE TABLE IF NOT EXISTS `". $this->getTableName('usedcards')."` (
          `id` int(11) NOT NULL,
          `cardId` int(11) NOT NULL,
          `loginId` varchar(28) NOT NULL,
          `dateUsed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


        CREATE TABLE IF NOT EXISTS `". $this->getTableName('users')."` (
          `loginId` varchar(128) NOT NULL,
          `password` varchar(265) NOT NULL,
          `name` varchar(128) NOT NULL,
          `address` varchar(128) NOT NULL,
          `mobileNo` varchar(18) NOT NULL,
          `emailId` varchar(128) NOT NULL,
          `balance` double NOT NULL,
          `status` varchar(16) NOT NULL DEFAULT 'active',
          `role` varchar(16) NOT NULL DEFAULT 'user',
          `dateRegistered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


        ALTER TABLE `". $this->getTableName('admins')."`
          ADD PRIMARY KEY (`userName`);


        ALTER TABLE `". $this->getTableName('bulksms')."`
          ADD PRIMARY KEY (`id`);


        ALTER TABLE `". $this->getTableName('cards')."`
          ADD PRIMARY KEY (`id`);


        ALTER TABLE `". $this->getTableName('contact')."`
          ADD PRIMARY KEY (`id`);


        ALTER TABLE `". $this->getTableName('draft')."`
          ADD PRIMARY KEY (`id`);


        ALTER TABLE `". $this->getTableName('group')."`
          ADD PRIMARY KEY (`id`);

        ALTER TABLE `". $this->getTableName('logins')."`
          ADD PRIMARY KEY (`id`);

        ALTER TABLE `". $this->getTableName('passwordresettoken')."`
          ADD PRIMARY KEY (`id`);

        ALTER TABLE `". $this->getTableName('sms')."`
          ADD PRIMARY KEY (`id`);

        ALTER TABLE `". $this->getTableName('usedcards')."`
          ADD PRIMARY KEY (`id`);

        ALTER TABLE `". $this->getTableName('users')."`
          ADD PRIMARY KEY (`loginId`);

        ALTER TABLE `". $this->getTableName('bulksms')."`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=346;

        ALTER TABLE `". $this->getTableName('cards')."`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

        ALTER TABLE `". $this->getTableName('contact')."`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=187;

        ALTER TABLE `". $this->getTableName('group')."`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;

        ALTER TABLE `". $this->getTableName('logins')."`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;

        ALTER TABLE `". $this->getTableName('sms')."`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26664;

        ALTER TABLE `". $this->getTableName('usedcards')."`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

        ";

        return $sql;
    }

    public function complete($success){
        $this->data['pageTitle'] = 'Install -> Complete | OpenSms';
        $this->data['success'] = $success;
        $this->data['message'] = $success?'Installation of OpenSMS has been successfully carried out':'Error in installing OpenSMS';
        if($success) $_SESSION['notification'] = $this->data['message'];
        else $_SESSION['error'] = $this->data['message'];
        $this->renderTemplate('body');
    }
} 