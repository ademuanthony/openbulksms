<?php
/**
 * Created by PhpStorm.
 * User: Ademu
 * Date: 11/8/2015
 * Time: 7:33 PM
 */

class OpenSms_Model_ContactMessage extends OpenSms_Model_Abstract_ModelBase{

    public function __construct(array $param = [0 => -1]){
        $this->getById(isset($param[0]) ? $param[0] : -1);
    }

    public function getById($id = -1){
        $this->Id = $id;
        $this->Status = OpenSms::CONTACT_MESSAGE_STATUS_NEW;

        if($id != ''){
            $sql = "select * from ".$this->getTableName()." where id = '".StringMethods::MakeSave($id)."';";
            $result = OpenSms_Helper_Db::executeReader($sql);
            foreach($result as $r){
                $this->Name = $r->name;
                $this->Email = StringMethods::GetRaw($r->email);
                $this->Phone = StringMethods::GetRaw($r->phone);
                $this->Subject = $r->subject;
                $this->Message = $r->message;
                $this->Date = $r->date;
                $this->Status = $r->status;
            }
        }
    }

    public function getTableName(){
        return OpenSms::getTableName('contactMessage');
    }

    public $Id;

    public $Name;

    public $Email;

    public $Phone;

    public $Subject;

    public $Message;

    public $Date;

    public $Status;

    public function Save(){
        if($this->Id != -1){
            $sql = "update `".$this->getTableName()."` set
            `name` = '".StringMethods::MakeSave($this->Name)."',
            `email` = '".StringMethods::MakeSave($this->Email)."',
            `phone` = '".StringMethods::MakeSave($this->Phone)."',
            `subject` = '".StringMethods::MakeSave($this->Subject)."',
            `message` = '".StringMethods::MakeSave($this->Message)."',
            `date` = '".StringMethods::MakeSave($this->Date)."',
            `status` = '".StringMethods::MakeSave($this->Status).
                "' where `id` = '".$this->Id."';";
        }else{
            $sql = "INSERT INTO `".$this->getTableName()."` (`name`, `email`, `phone`, `subject`, `message`, `status`)
            VALUES(
            '".StringMethods::MakeSave($this->Name)."',
            '".StringMethods::MakeSave($this->Email)."',
            '".StringMethods::MakeSave($this->Phone)."',
            '".StringMethods::MakeSave($this->Subject)."',
            '".StringMethods::MakeSave($this->Message)."',
            '".StringMethods::MakeSave($this->Status)."'
            );";
        }
        OpenSms_Helper_Db::executeNonQuery($sql);

        if($this->Id == -1){
            $sql = "select MAX(id) as no from `".$this->getTableName()."`";
            $result = OpenSms_Helper_Db::executeReader($sql);
            foreach($result as $r){
                $this->Id = $r->no;
                $this->GroupExits = TRUE;
                return 'Added';
            }
        }
        return 'Updated';

    }

    public function Delete(){
        $sql = "delete from `".$this->getTableName()."` where id = '".StringMethods::MakeSave($this->Id)."'";
        $this->GroupExits = FALSE;
        return OpenSms_Helper_Db::executeNonQuery($sql);
    }

    public static function GetMessages($status = OpenSms::CONTACT_MESSAGE_STATUS_NONE, $offset = 0, $limit = 0)
    {
        $obj = new OpenSms_Model_ContactMessage();
        $sql = "select * from " . $obj->getTableName() . ($status == OpenSms::CONTACT_MESSAGE_STATUS_NONE? " ": " where status = '$status'");
        if ($limit > 0) {
            $sql .= " ORDER BY `Date` LIMIT $offset, $limit";
        }
        $objs = array();
        $result = OpenSms_Helper_Db::executeReader($sql);
        foreach ($result as $r) {
            $obj = new OpenSms_Model_ContactMessage();
            $obj->Name = $r->name;
            $obj->Email = StringMethods::GetRaw($r->email);
            $obj->Phone = StringMethods::GetRaw($r->phone);
            $obj->Subject = $r->subject;
            $obj->Message = $r->message;
            $obj->Date = $r->date;
            $obj->Status = $r->status;
            $objs[] = $obj;
        }

        return $objs;
    }

} 