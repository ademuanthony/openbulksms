<?php
/**
 * Created by PhpStorm.
 * User: Ademu
 * Date: 10/30/2015
 * Time: 5:55 AM
 */

class OpenSms_Model_Service extends OpenSms_Model_Abstract_ModelBase {
    public function getTableName(){
        return OpenSms::getTableName('service');
    }

    public function __construct(array $param = [0 => -1]){
        $this->getById(isset($param[0]) ? $param[0] : -1);
    }

    public function getById($id = -1){
        $this->Id = $id;
        if($id != -1){
            $sql = "select * from `".$this->getTableName()."` where id = '".StringMethods::MakeSave($id)."';";
            $result = OpenSms_Helper_Db::executeReader($sql);
            foreach($result as $r){
                $this->Price = StringMethods::GetRaw($r->price);
                $this->Name = StringMethods::GetRaw($r->name);
                $this->Description = StringMethods::GetRaw($r->description);
                $this->Image = StringMethods::GetRaw($r->image);
            }
        }
    }


    public $Id;

    public $Name;

    public $Description;

    public $Price;

    public $Image;

    public function Save(){
        $g = self::FindByName($this->Name);
        if((isset($g->Id) && $g->Id != $this->Id)){
            return 'A service with the same name already exist';
        }
        if($this->Id != -1){
            $sql = "update `".$this->getTableName()."` set `name` = '".StringMethods::MakeSave($this->Name)."',
            `price` = '".StringMethods::MakeSave($this->Price)."', `image` = '".StringMethods::MakeSave($this->Image)."', `description` = '".
                StringMethods::MakeSave($this->Description).
                "' where `id` = '".$this->Id."';";
        }else{
            $sql = "INSERT INTO `".$this->getTableName()."` (`price`, `name`, `description`, `image`) VALUES('".
                StringMethods::MakeSave($this->Price)."', '".StringMethods::MakeSave($this->Name).
                "', '".StringMethods::MakeSave($this->Description)."', '".StringMethods::MakeSave($this->Image)."');";
        }

        OpenSms_Helper_Db::executeNonQuery($sql);

        if($this->Id == -1){
            $sql = "select MAX(id) as no from `".$this->getTableName()."`";
            $result = OpenSms_Helper_Db::executeReader($sql);
            foreach($result as $r){
                $this->Id = $r->no;
                return 'Service Added';
            }
        }
        return 'Service Updated';
    }

    public function Delete(){
        $sql = "delete from `".$this->getTableName()."` where id = '".StringMethods::MakeSave($this->Id)."'";
        return OpenSms_Helper_Db::executeNonQuery($sql);
    }

    public static function FindByName($name){
        if(!empty($name)){
            $sql = "select * from `".self::getTableName()."` where name = '".StringMethods::MakeSave($name)."';";
            $result = OpenSms_Helper_Db::executeReader($sql);
            foreach($result as $r){
                $g = OpenSms::loadModel('OpenSms_Model_Service');
                $g->Id = $r->id;
                $g->Price = StringMethods::GetRaw($r->price);
                $g->Name = StringMethods::GetRaw($r->name);
                $g->Image = StringMethods::GetRaw($r->image);
                $g->Description = StringMethods::GetRaw($r->description);
                return $g;
            }
        }
    }

    public static function Count(){
        $sql = 'select count(*) as no from '.OpenSms::getTableName('service');
        $result = OpenSms_Helper_Db::executeReader($sql);
        foreach($result as $r)
            return $r->no;
    }

    public static function GetAll($offset = 0, $limit = 0)
    {
        if ($limit == 0) {
            $sql = "select * from " . OpenSms::getTableName('service');
        } else {
            $sql = "select * from " . OpenSms::getTableName('service') . " ORDER BY name LIMIT $offset, $limit";
        }
        $users = array();
        $result = OpenSms_Helper_Db::executeReader($sql);
        foreach ($result as $r) {
            $g = OpenSms::loadModel('OpenSms_Model_Service');
            $g->Id = $r->id;
            $g->Price = StringMethods::GetRaw($r->price);
            $g->Name = StringMethods::GetRaw($r->name);
            $g->Image = StringMethods::GetRaw($r->image);
            $g->Description = StringMethods::GetRaw($r->description);
            $users[] = $g;
        }

        return $users;
    }
} 