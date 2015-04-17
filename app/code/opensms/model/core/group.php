<?php
    
	class OpenSms_Model_Group extends OpenSms_Model_Abstract_ModelBase{
        public function __construct(array $param = [0 => -1]){
            $this->getById(isset($param[0]) ? $param[0] : -1);
        }
		
		public function getById($id = -1){
			$this->Id = $id;
			if($id != -1){
				$sql = "select * from `".OpenSms::getTableName('group')."` where id = '".StringMethods::MakeSave($id)."';";
				$result = OpenSms_Helper_Db::executeReader($sql);
				foreach($result as $r){
					$this->LoginId = StringMethods::GetRaw($r->loginId);
					$this->Name = StringMethods::GetRaw($r->name);
					$this->Description = StringMethods::GetRaw($r->description);
                    $this->GroupExits = TRUE;
				}
			}
		}
		
		public $Id;
		
		public $LoginId;
		
		public $Name;
		
		public $Description;

        public $GroupExits = FALSE;
		
		public function GetContactCount(){
			$sql = "select count(*) as no from ".OpenSms::getTableName('contact')." where groupId = '$this->Id'";
			$result = OpenSms_Helper_Db::executeReader($sql);
			foreach($result as $r){
				return $r->no;
			}
		}
		
		public function GetContacts($offset = 0, $limit = 0){
            if($limit == 0){
			    $sql = "select * from ".OpenSms::getTableName('contact')." where groupId = '$this->Id'";
            }else{
                $sql = "select * from ".OpenSms::getTableName('contact')." where groupId = '$this->Id' ORDER BY Id LIMIT $offset, $limit";
            }
			//die($sql);
			$cons = array();
			$result = OpenSms_Helper_Db::executeReader($sql);
			foreach($result as $r){
				$con = OpenSms::loadModel('OpenSms_Model_Contact');
				$con->GroupId = $this->Id;
				$con->Name = $r->name;
				$con->Number = StringMethods::GetRaw($r->number);
                $con->Id = $r->id;
				$cons[] = $con;
			}
			return $cons;
		}
		
		public function SerializeContacts(){
			$cons = $this->GetContacts();
			
			$out = '';
			foreach($cons as $c){
				$out.=$c->Number.',';	
			}
			return $out;
		}
		
		public function Save(){
            $g = self::FindGroupByName($this->Name);
            if((isset($g->Id) && $g->Id != $this->Id) && $g->LoginId == $this->LoginId){
                return 'A group with the same name already exist';
            }
			if($this->Id != -1){
				$sql = "update `".OpenSms::getTableName('group')."` set `name` = '".StringMethods::MakeSave($this->Name)."', `description` = '".
				StringMethods::MakeSave($this->Description).
				"' where `id` = '".$this->Id."';";
			}else{
				$sql = "INSERT INTO `".OpenSms::getTableName('group')."` (`loginId`, `name`, `description`) VALUES('".
				StringMethods::MakeSave($this->LoginId)."', '".StringMethods::MakeSave($this->Name).
				"', '".StringMethods::MakeSave($this->Description)."');";
			}
            OpenSms_Helper_Db::executeNonQuery($sql);
			
			if($this->Id == -1){
				$sql = "select MAX(id) as no from `".OpenSms::getTableName('group')."`";
				$result = OpenSms_Helper_Db::executeReader($sql);
				foreach($result as $r){
					$this->Id = $r->no;
                    $this->GroupExits = TRUE;
					return 'Group Added';	
				}
			}
            return 'Group Updated';
			
		}
		
		public function Delete(){
            $sql = "delete from ".OpenSms::getTableName('contact')." where groupId = '".StringMethods::MakeSave($this->Id)."'";
            OpenSms_Helper_Db::executeNonQuery($sql);

			$sql = "delete from `".OpenSms::getTableName('group')."` where id = '".StringMethods::MakeSave($this->Id)."'";
            $this->GroupExits = FALSE;
			return OpenSms_Helper_Db::executeNonQuery($sql);
		}

        public static function copyFromPDO($pdoObj){
            $g = OpenSms::loadModel('OpenSms_Model_Group');
            $g->Id = $pdoObj->id;
            $g->Name = $pdoObj->name;
            $g->LoginId  = $pdoObj->loginId;
            $g->Description = $pdoObj->description;
            $g->GroupExits = !empty($pdoObj->id);

            return $g;
        }

        public static function FindGroupByName($name){
			if(!empty($name)){
				$sql = "select * from `".OpenSms::getTableName('group')."` where name = '".StringMethods::MakeSave($name)."';";
				$result = OpenSms_Helper_Db::executeReader($sql);
				foreach($result as $r){
                    $g = OpenSms::loadModel('OpenSms_Model_Group');
                    $g->Id = $r->id;
					$g->LoginId = StringMethods::GetRaw($r->loginId);
					$g->Name = StringMethods::GetRaw($r->name);
					$g->Description = StringMethods::GetRaw($r->description);
                    $g->GroupExits = TRUE;
                    return $g;
				}
			}
        }
			
	}
?>