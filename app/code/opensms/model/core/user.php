<?php
    class OpenSms_Model_User extends OpenSms_Model_Abstract_ModelBase{

        const ADMIN = 'enekpani';

        const SMS_USER = 'user';

        private function getUSerFromJ($loginId, $_password){
            //die($password);
            $sql = "select * from users where loginId = '$loginId' and password = ''";
            $result = $this->db->SendQuery($sql);
            while($r = $result->fetch_assoc()){
                extract($r);
                //this user has not update his password. get it from jos_user
                /*$sql = "select * from jos_users where username = '$loginId'";
                $result = $this->db->SendQuery($sql);
                while($r = $result->fetch_assoc()){
                    $jpassword = $r['password'];
                }*/

                $this->IsOld = FALSE;
                $this->IsOld = false;
                $this->Name = StringMethods::GetRaw($name);
                $this->LoginId = StringMethods::GetRaw($loginId);
                $this->Address = StringMethods::GetRaw($address);
                $this->DateRegistered = $dateRegistered;
                $this->Balance = $balance;
                $this->EmailId = StringMethods::GetRaw($emailId);
                $this->MobileNo = StringMethods::GetRaw($mobileNo);
                $this->Role = StringMethods::GetRaw($role);
                $this->Password = $_password;

                $this->Save();
                
                $this->IsValidated = TRUE;
            }
        }

		public function __construct(array $param = null){
            $loginId = $param == null || empty($param[0])? "" : $param[0];
            $_password = $param == null || empty($param[1])? "" : $param[1];

			$this->IsOld = false;
			$this->Balance = 0;
			 if($loginId != ''){
				$sql = "select * from ".OpenSms::getTableName('users')." where loginId = '".StringMethods::MakeSave($loginId)."' and status = 'active';";
						
				//die($sql);
				$result = OpenSms_Helper_Db::executeReader($sql);
				foreach($result as $r){
					if($_password != '') $this->IsValidated = self::Validate($loginId, $_password);
					$this->IsOld = true;
					$this->Name = StringMethods::GetRaw($r->name);
					$this->LoginId = StringMethods::GetRaw($r->loginId);
					$this->Address = StringMethods::GetRaw($r->address);
					$this->DateRegistered = $r->dateRegistered;
					$this->Balance = $r->balance;
					$this->EmailId = StringMethods::GetRaw($r->emailId);
					$this->MobileNo = StringMethods::GetRaw($r->mobileNo);
                    $this->Role = StringMethods::GetRaw($r->role);
					
				}

                 /*
                if(!$this->IsValidated){
                    $this->getUserFromJ($loginId, $_password);
                }
                 */
			 }
		}

        public function getById($username){
            return self::FindUserById($username);
        }

		public $LoginId;
		
		public $Password;
		
		public $Name;

        public $Image;
		
		public $Address;
		
		public $MobileNo;
		
		public $EmailId;
		
		public $DateRegistered;
		
		public $Balance;
		
        public $Role;

        public $Status;

		public $IsOld;
		
		public $IsValidated;
						
		public function Save(){
			if($this->IsOld){
				if($this->Password != '')
					$sql = "update ".OpenSms::getTableName('users')." set password = '".StringMethods::Encode("$this->Password")."',
                    role = '".StringMethods::MakeSave("$this->Role")."', balance = '".StringMethods::MakeSave(
					$this->Balance)."' where loginId = '".StringMethods::MakeSave($this->LoginId)."';";
				else
					$sql = "update ".OpenSms::getTableName('users')." set balance = '".StringMethods::MakeSave($this->Balance)."',
                    role = '".StringMethods::MakeSave("$this->Role")."' 
                    where loginId = '".StringMethods::MakeSave($this->LoginId)."';";
			}else{
				//validate
				$u = self::FindUserById($this->LoginId);
				if(isset($u->LoginId)){
					return 'The selected username is in use';	
				}
				
				$u = self::FindUserByEmail($this->EmailId);
				if(isset($u->LoginId)){
					return 'The selected Email Address is in use';	
				}
				
                if(empty($this->MobileNo)){
                    
                }
				$u = self::FindUserByPhoneNumber($this->MobileNo);
				if(isset($u->LoginId)){
					return 'The selected phone number is in use';	
				}
				
				
				$sql = "insert into ".OpenSms::getTableName('users')."(loginId, password, name, address, mobileNo, emailId, balance, role)
				 value('".StringMethods::MakeSave($this->LoginId)."', '".StringMethods::Encode("$this->Password")."', 
                 '".StringMethods::MakeSave($this->Name)."', 
                 '".StringMethods::MakeSave($this->Address)."', '".StringMethods::MakeSave($this->MobileNo).
                 "', '".StringMethods::MakeSave($this->EmailId)."', '$this->Balance', '".($this->Role == self::ADMIN?$this->Role:self::SMS_USER)."');";
			}
			
			//die($sql);
            return OpenSms_Helper_Db::executeNonQuery($sql);
		}

        public function Delete(){
			$sql = "update users set status = 'deleted' where loginId = '".StringMethods::MakeSave($this->LoginId)."'";
			//die($sql);
            return OpenSms_Helper_Db::executeNonQuery($sql);
		}

        public function GetTransactions(){
            $trans = array();
            if(empty($this->LoginId)) return $trans;

            $sql = "select * from ".OpenSms::getTableName('transactions')." where loginId = '".StringMethods::MakeSave($this->LoginId)."'";

            $result = OpenSms_Helper_Db::executeReader($sql);

            foreach($result as $tran){
                $trans[] = OpenSms::callModelStaticMethod('OpenSms_Model_Transaction', 'copyFromPDO', [0 => $tran]);
            }
            return $trans;
        }

        public function GetLastTransaction(){
            $trans = array();
            if(empty($this->LoginId)) return $trans;

            $sql = "select * from ".OpenSms::getTableName('transactions')." where loginId =
            '".StringMethods::MakeSave($this->LoginId)."' and id = (select MAX(id) from ".OpenSms::getTableName('transactions')."
            where loginId = '".StringMethods::MakeSave($this->LoginId)."')";

            $result = OpenSms_Helper_Db::executeReader($sql);

            foreach($result as $tran){
                return OpenSms::callModelStaticMethod('OpenSms_Model_Transaction', 'copyFromPDO', [0 => $tran]);
            }
            return OpenSms::loadModel('OpenSms_Model_Transaction');
        }
		
		public function GetGroups(){
			$groups = array();
			$sql = "select * from `".OpenSms::getTableName('group')."` where loginId = '".StringMethods::MakeSave($this->LoginId)."' ORDER BY `id` DESC";
						
			$result = OpenSms_Helper_Db::executeReader($sql);

            foreach($result as $r){
                $g = OpenSms::loadModel("OpenSms_Model_Group");
                $g->Id = $r->id;
                $g->Name = $r->name;
                $g->LoginId  = $r->loginId;
                $g->Description = $r->description;
                $g->GroupExits = !empty($r->id);

                $groups[] = $g;
            }

			return $groups;
		}
		
		public function GetDrafts(){
			$drafts = array();
			$db = new TDataAccess();
			$sql = "select * from `draft` where loginId = '".StringMethods::MakeSave($this->LoginId)."' and deliveryType = 'draft'";
						
			$result = OpenSms_Helper_Db::executeNonQuery($sql);

            foreach ($result as $d) {
                $drafts[] = OpenSms_Model_Draft::copyFromPDO($d);
            }

			return $drafts;
		}
		
        public function GetSentMessages(){
			$drafts = array();
			$db = new TDataAccess();
			$sql = "select * from `draft` where loginId = '".StringMethods::MakeSave($this->LoginId)."' and deliveryType = 'sent'";
						
			$result = OpenSms_Helper_Db::executeNonQuery($sql);

            foreach ($result as $d) {
                $drafts[] = OpenSms_Model_Draft::copyFromPDO($d);
            }

			return $drafts;
		}

        public function GetScheduledMessages(){
			$drafts = array();
			$sql = "select * from `draft` where loginId = '".StringMethods::MakeSave($this->LoginId)."' and deliveryType = 'scheduled'";
						
			$result = OpenSms_Helper_Db::executeNonQuery($sql);

            foreach ($result as $d) {
                $drafts[] = OpenSms_Model_Draft::copyFromPDO($d);
            }

			return $drafts;
		}

        public static function copyFromPDO($pdoObj){
            $u = new OpenSms_Model_User();
            $u->Address = $pdoObj->address;
            $u->Balance = $pdoObj->balance;
            $u->DateRegistered = $pdoObj->dateRegistered;
            $u->EmailId = $pdoObj->emailId;
            $u->IsOld = true;
            $u->LoginId = $pdoObj->loginId;
            $u->MobileNo = $pdoObj->mobileNo;
            $u->Name = $pdoObj->name;
            $u->Role = $pdoObj->role;
            $u->Status = $pdoObj->status;

            return $u;
        }

        public static function GetAllUsers(){
				$sql = "select * from ".OpenSms::getTableName('users')." where status = 'active'";
				
                $users = array();
				$result = OpenSms_Helper_Db::executeReader($sql);
				foreach($result as $u){
                    $users[] = self::copyFromPDO($u);
                }

                return $users;
        }

        public static function Count(){
            $sql = 'select count(*) as no from '.OpenSms::getTableName('users');
            $result = OpenSms_Helper_Db::executeReader($sql);
            foreach($result as $r)
                return $r->no;
        }

		public static function Validate($loginId, $password)
        {
            $sql = "select count(*) as no from ".OpenSms::getTableName('users')." where loginId = '" .
                StringMethods::MakeSave($loginId) . "' && password = '" . StringMethods::Encode($password) . "';";

            $result = OpenSms_Helper_Db::executeReader($sql);

            if (!isset($result[0])) return false;

            return $result[0]->no == 1;
        }
		
		public static function FindUserById($loginId){
			$sql = "select * from ".OpenSms::getTableName('users')." where loginId = '".StringMethods::MakeSave($loginId)."';";
            $result = OpenSms_Helper_Db::executeReader($sql);
            $u = isset($result[0])?self::copyFromPDO($result[0]):new OpenSms_Model_User();
            return $u;
		}

        public static function FindUserByPhoneNumber($mobileNo){
            $sql = "select * from ".OpenSms::getTableName('users')." where loginId = '".StringMethods::MakeSave($mobileNo)."';";
            $u = new OpenSms_Model_User();
            $result = OpenSms_Helper_Db::executeReader($sql);

            return isset($result[0])?self::copyFromPDO($result[0]):new OpenSms_Model_User();
        }

        public static function FindUserByEmail($emailId){
            $sql = "select * from ".OpenSms::getTableName('users')." where loginId = '".StringMethods::MakeSave($emailId)."';";
            $u = new OpenSms_Model_User();
            $result = OpenSms_Helper_Db::executeReader($sql);

            return isset($result[0])?self::copyFromPDO($result[0]):new OpenSms_Model_User();
        }

        public static function getMobileNos(){
            $sql = "select mobileNo from users where mobileNo <> ''";
            $result = OpenSms_Helper_Db::executeReader($sql);
            $nos = '';

		    foreach($result as $r){
                $fChar = substr($r->mobileNo, 0, 1);
                if(trim($r->mobileNo) != '' && ($fChar == '2' || $fChar == '0' || $fChar == '8')){
                    $nos .= trim($r->mobileNo).',';
                }
            }
            return $nos;
        }
	}