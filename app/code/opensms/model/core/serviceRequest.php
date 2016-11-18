<?php
/**
 * Created by PhpStorm.
 * User: Ademu
 * Date: 10/31/2015
 * Time: 10:03 AM
 */

class OpenSms_Model_ServiceRequest extends OpenSms_Model_Abstract_ModelBase {
    public function getTableName(){
        return OpenSms::getTableName('servicerequest');
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
                $this->Email = StringMethods::GetRaw($r->email);
                $this->Phone = StringMethods::GetRaw($r->phone);
                $this->Message = StringMethods::GetRaw($r->message);
                $this->ServiceName = StringMethods::GetRaw($r->serviceName);
                $this->BranchName = StringMethods::GetRaw($r->branchName);
                $this->Status = StringMethods::GetRaw($r->status);
            }
        }
    }


    public $Id;

    public $Name;

    public $Email;

    public $Phone;

    public $Message;

    public $ServiceName;

    public $Price;

    public $BranchName;

    public $Status;

    public function Save(){
        if($this->Id != -1){
            $sql = "update `".$this->getTableName()."` set
            `status` = '".StringMethods::MakeSave($this->Status)."',
            `phone` = '".StringMethods::MakeSave($this->Phone)."',`email` = '".StringMethods::MakeSave($this->Email)."',
            `price` = '".StringMethods::MakeSave($this->Price)."',
            `branchName` = '".StringMethods::MakeSave($this->BranchName)."' where `id` = '".$this->Id."';";
        }else{
            $sql = "INSERT INTO `".$this->getTableName()."` (`name`, `price`, `phone`, `message`, `serviceName`, `branchName`, `status`) VALUES('".
                StringMethods::MakeSave($this->Name)."', '".StringMethods::MakeSave($this->Price).
                "', '".StringMethods::MakeSave($this->Phone)."', '".StringMethods::MakeSave($this->Message)."',
                 '".StringMethods::MakeSave($this->ServiceName)."', '".$this->BranchName."', '".StringMethods::MakeSave($this->Status)."');";
        }

       // die($sql);
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

    public static function Count($status = ''){
        $sql = 'select count(*) as no from '.OpenSms::getTableName('servicerequest');

        if(!empty($status)){$sql .= " where status = $status";}
        $result = OpenSms_Helper_Db::executeReader($sql);
        foreach($result as $r)
            return $r->no;
    }

    public static function GetAll($status = '',  $offset = 0, $limit = 0)
    {
        $sql = $status == ''? "select * from " . OpenSms::getTableName('servicerequest'):
            "select * from " . OpenSms::getTableName('servicerequest'). " where status = $status";
        if ($limit != 0) {
            $sql .= " ORDER BY name LIMIT $offset, $limit";
        }
        //die($sql);
        $users = array();
        $result = OpenSms_Helper_Db::executeReader($sql);
        foreach ($result as $r) {
            $g = OpenSms::loadModel('OpenSms_Model_ServiceRequest');
            $g->Id = $r->id;
            $g->Price = StringMethods::GetRaw($r->price);
            $g->Name = StringMethods::GetRaw($r->name);
            $g->Email = StringMethods::GetRaw($r->email);
            $g->Phone = StringMethods::GetRaw($r->phone);
            $g->Message = StringMethods::GetRaw($r->message);
            $g->ServiceName = StringMethods::GetRaw($r->serviceName);
            $g->Status = StringMethods::GetRaw($r->status);
            $g->BranchName = StringMethods::GetRaw($r->branchName);
            $users[] = $g;
        }
        return $users;
    }

}