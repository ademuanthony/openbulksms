<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 6/29/2015
 * Time: 5:13 PM
 */

class OpenSms_Model_Content extends OpenSms_Model_Abstract_ModelBase{
    public function __construct($param = null){
        if(is_array($param) && count($param)){
            $key = $param[0];
            $this->getById($key);
        }
    }

    public function getById($key)
    {
        $sql = "select * from ".$this->getTableName()." where `key` = '$key'";
        $result = OpenSms_Helper_Db::executeReader($sql);
        $this->copy($result);
    }

    public  function getTableName(){
        return OpenSms::getTableName('content');
    }

    private function copy($result)
    {
        foreach ($result as $r) {
            $this->Key = $r->key;
            $this->Body = StringMethods::GetRaw($r->body);
            $this->Host = StringMethods::GetRaw($r->host);
            $this->Type = $r->type;
            $this->Id = $r->id;
        }
    }


    public $Id;
    public $Key;
    public $Type;
    public $Host;
    public $Body;

    public function Save(){
        $content = new OpenSms_Model_Content([0=>$this->Key]);
        if($content->Id > 0) $this->Id = $content->Id;

        $sql = !$this->Id > 0?"insert into ".$this->getTableName().
            "(`key`, `type`, `body`, `host`) value('".StringMethods::MakeSave($this->Key)."', '".StringMethods::MakeSave($this->Type)."', '".
            StringMethods::MakeSave($this->Body)."', '". StringMethods::MakeSave($this->Host)."');"
            :"update ". $this->getTableName(). " set `body` = '".StringMethods::MakeSave($this->Body)."'
            where `key` = '".StringMethods::MakeSave($this->Key)."';";
        //die($sql);
        return OpenSms_Helper_Db::executeNonQuery($sql);
    }


    public static function GetAll(){
        $pageObj = new OpenSms_Model_Content();
        $tableName = $pageObj->getTableName();
        $sql = "select * from $tableName";
        $results = OpenSms_Helper_Db::executeReader($sql);
        $pages = array();
        foreach($results as $r){
            $page = new OpenSms_Model_Content();
            $page->copy([$r]);
            $pages[] = $page;
        }
        return $pages;
    }
}