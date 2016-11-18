<?php

function dd($data){
    var_dump($data);
    die();
}

class OpenSms_Helper_Constant{
    const CURRENT_THEME = 'opensms_current_theme';//theme is saved in the option table with this key


    //general
    const SITE_NAME = 'site_name';
    const INSTALLATION_STATUS = 'installation_status';

    //database
    const DB_TYPE = 'opensms_db_type';
    const DB_HOST = 'opensms_db_host';
    const DB_NAME = 'opensms_db_name';
    const TABLE_PREFIX = 'opensms_table_prefix';//prefix will be saved in the settings file with this key
    const DB_USERNAME = 'opensms_username';
    const DB_PASSWORD = 'opensms_password';
}
