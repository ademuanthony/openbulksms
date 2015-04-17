<?php
    class OpenSms_Model_Login{
        private $serverKey;
        private $cookieName;

        public function __construct(){
            $this->serverKey = 'cDe42437070@_67theMan';
            $this->cookieName = 'passToken';

            if(isset($_COOKIE[$this->cookieName])){
                $token = $_COOKIE[$this->cookieName];                
            }

			if(!empty($token)){
				$sql = "select * from logins where token = '".StringMethods::MakeSave($token)."';";
				$result = OpenSms_Helper_Db::executeReader($sql);
				foreach($result as $r){
                    $this->LoginId = $r->loginId;
                    $this->Token = $r->token;
                    $this->Id = $r->id;
                    $this->Date = $r->date;
				}
			}

            if(empty($this->Token)){
			    $randomToken = hash('sha256',uniqid(mt_rand(), true).uniqid(mt_rand(), true));
                $randomToken .= ':'.hash_hmac('md5', $randomToken, $this->serverKey);
                $this->Token = $randomToken;
			}
		}
		
        public $Id;

        public $LoginId;

        public $Token;

        public $Date;

		public function Save(){
			if(!empty($this->Id)){
				$sql = "update logins set loginId = '".StringMethods::MakeSave($this->LoginId)
				."', token = '".StringMethods::MakeSave($this->Token)."', date = now() where id = '$this->Id';";
			}else{
				$sql = "insert into logins(loginId, token)
				 value('".StringMethods::MakeSave($this->LoginId)."', '".StringMethods::MakeSave($this->Token)."');";
			}

            //die($sql);
			//$this->db->SendQuery($sql);
            OpenSms_Helper_Db::executeNonQuery($sql);
			
            setcookie($this->cookieName, $this->Token, time() + (86400 * 30) * 12 * 10, '/');

			if($this->Id == -1){
				$sql = "select MAX(id) as no from `logins`";
				$result = OpenSms_Helper_Db::executeReader($sql);
                return $result[0]->no;
			}
		}
		
		public function Delete(){
            unset($_COOKIE[$this->cookieName]);
            $sql = "delete from logins where id = '".StringMethods::MakeSave($this->Id)."'";
			return OpenSms_Helper_Db::executeNonQuery($sql);
		}

        public function Validated(){
            if(empty($this->LoginId)) return FALSE;

            list($token, $hmac) = explode(':', $this->Token, 2);
            if ($hmac != hash_hmac('md5', $token, $this->serverKey)) {
                unset($_COOKIE[$this->cookieName]);
                return FALSE;
            }else{
                return TRUE;
            }
        }
    }
?>