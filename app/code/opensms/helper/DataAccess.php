<?php
//namespace TSite\Shared
//{
	//use MySQLi as MySQLi;
	//use Exception as Exception;
	
	class TDataAccess{
			
		private $server;
		private $userName;
		private $password;
		private $database;//wwwbuzys_shallomsms
		
		/*public function __construct($server = 'MYSQL5005.Smarterasp.net', $database = 'db_9a9b4e_dehope', 
		$uid = '9a9b4e_dehope', $password = 'ojima123'){
			$this->SetDatabase($database);
			$this->SetPassword($password);
			$this->SetUId($uid);
			$this->SetServerName($server);
		}*/

        public function __construct($server = DB_HOST, $database = DB_NAME, 
		$uid = DB_USER, $password = DB_PASS){
			$this->SetDatabase($database);
			$this->SetPassword($password);
			$this->SetUId($uid);
			$this->SetServerName($server);
		}
		
		private function SetServerName($serverName){
			$this->server = $serverName;
		}
		private function GetServerName(){
			return $this->server;
		}
		
		private function SetUId($uid){
			$this->userName = $uid;	
		}
		private function GetUId(){
			return $this->userName;	
		}
		
		private function SetPassword($pws){
			$this->password = $pws;
		}
		private function GetPassword(){
			return $this->password;
		}
		
		private function SetDatabase($db){
			$this->database = $db;	
		}
		private function GetDatabase(){
			return $this->database;	
		}
		
		function SendQuery($query){
			$mydb = new MySQLi($this->GetServerName(), $this->GetUId(), $this->GetPassword(), $this->GetDatabase());
			return $mydb->query($query);
			$mydb->close();
		}
	}

//}
?>