<?php
    class Content{   
        private $db;
             
		public function __construct($id = -1){
			$this->Id = $id;			
			$this->db = new TDataAccess();
			if($id > -1){
				$sql = "select * from `contents` where id = '$id';";
				$result = $this->db->SendQuery($sql);
				while($r = $result->fetch_assoc()){
					extract($r);
					$this->Name = StringMethods::GetRaw($name);
					$this->Secured = $secured;
					$this->Body = StringMethods::GetRaw($body);	
                    $this->ImageSrc = StringMethods::GetRaw($imageSrc);	
                    $this->LastModificationDate = $lastModificationDate;
                    $this->Status = StringMethods::GetRaw($status);	
				}
			}
		}

        public $Id;
        public $Name;
        public $Secured;
        public $Body;
        public $ImageSrc;
        public $LastModificationDate;
        public $Status;
        
		public function Save(){
            //validation
            if(empty($this->Name)){
                return 'Content name cannot be empty';
            }
            $con = Content::GetContentByName($this->Name);
            if(!empty($con->Name) && $con->Id != $this->Id){
                return 'A Content with the same name already exists.';
            }

            if($this->Id == -1){
			    $sql = "insert into `contents`(name, secured, body, status, imageSrc, lastModificationDate)
				     value('".StringMethods::MakeSave($this->Name)."', '".StringMethods::MakeSave($this->Secured)."', '".
                     StringMethods::MakeSave($this->Body)."', '".StringMethods::MakeSave($this->Status)."', 
                     '".StringMethods::MakeSave($this->ImageSrc)."', now());";
            }
             else{
                 $sql = "update `contents` set name = '".StringMethods::MakeSave($this->Name)."', 
                 secured = '".StringMethods::MakeSave($this->Secured)."', body = '".StringMethods::MakeSave($this->Body)."', 
                 status = '".StringMethods::MakeSave($this->Status)."', imageSrc = '".StringMethods::MakeSave($this->ImageSrc)."',
                 lastModificationDate = now()
                  where id = '".StringMethods::MakeSave($this->Id)."';";
             }
                 //die($sql);
			$this->db->SendQuery($sql);
			
			if($this->Id == -1){
				$sql = "select MAX(id) as no from `contents`";
				$result = $this->db->SendQuery($sql);			
				while($r = $result->fetch_assoc()){
					$this->Id = $r['no'];
					return $r['no'];	
				}
			}else{
			    return $this->Id;
			}
		}
		
		public function Delete(){
			$sql = "delete from `contents` where id = '".StringMethods::MakeSave($this->Id)."'";
			return $this->db->SendQuery($sql);	
		}

        public static function GetContentByName($name){
            $con = new Content();
            $db = new TDataAccess();
            $sql = "select * from `contents` where name = '$name';";
            $result = $db->SendQuery($sql);
            while($r = $result->fetch_assoc()){
                extract($r);
                $con->Id = $id;
                $con->Name = StringMethods::GetRaw($name);
                $con->Secured = $secured;
                $con->Body = StringMethods::GetRaw($body);	
                $con->ImageSrc = StringMethods::GetRaw($imageSrc);
                $con->LastModificationDate = $lastModificationDate;
                $con->Status = StringMethods::GetRaw($status);	
            }
            return $con;
        }

        public static function GetContentCount(){
            $db = new TDataAccess();
            $sql = "select count(*) as no from `contents`;";
            $result = $db->SendQuery($sql);
            while($r = $result->fetch_assoc()){
                extract($r);
                return $no;	
            }
            return 0;
        }

        public static function GetRange($offset, $limit){
            $cons = array();
            $db = new TDataAccess();
            $sql = "select * from `contents` ORDER BY id DESC LIMIT $offset, $limit ;";
            $result = $db->SendQuery($sql);
            while($r = $result->fetch_assoc()){
                extract($r);
                $con = new Content();
                $con->Id = $id;
                $con->Name = StringMethods::GetRaw($name);
                $con->Secured = $secured;
                $con->Body = StringMethods::GetRaw($body);	
                $con->ImageSrc = StringMethods::GetRaw($imageSrc);
                $con->LastModificationDate = $lastModificationDate;
                $con->Status = StringMethods::GetRaw($status);
                $cons[] = $con;	
            }
            return $cons;
        }
    }
?>