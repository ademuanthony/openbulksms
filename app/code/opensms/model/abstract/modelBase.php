<?php
abstract class OpenSms_Model_Abstract_ModelBase{

    public static function  getDb()
    {
        return OpenSms_Helper_Db::getClassDb();
    }

    public abstract function getById($id);
}