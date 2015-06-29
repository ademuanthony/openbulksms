<?php
    class OpenSms_Model_Message extends OpenSms_Model_Abstract_ModelBase{
        public function __construct(array $param = null)
        {
            $id = !empty($param) && isset($param[0]) ? $param[0] : -1;
            $this->getById($id);
        }

        public function getById($id)
        {
            $this->Id = $id;
            if ($id != -1) {
                $sql = "select * from " . OpenSms::getTableName('message') . " where id = '$id';";
                $result = OpenSms_Helper_Db::executeReader($sql);
                foreach ($result as $r) {
                    $this->Id = $r->id;
                    $this->BulkSMSId = $r->bulkSmsId;
                    $this->Number = $r->number;
                    $this->Message = $r->message;
                    $this->Sender = $r->sender;
                    $this->RefId = $r->refId;
                    $this->Status = $r->status;
                }
            }
        }

        public function getTableName(){
            return OpenSms::getTableName('sms');
        }

        public $Id;
        public $BulkSMSId;
        public $Number;
        public $Message;
        public $Sender;
        public $RefId;
        public $Status;

        
		public function Save(){
			$sql = "insert into " . OpenSms::getTableName('sms') . "(bulkSMSId, number, message, sender, refId, Status)
				 value('".StringMethods::MakeSave($this->BulkSMSId)."', '".StringMethods::MakeSave($this->Number)."', '".
                 StringMethods::MakeSave($this->Message)."', '".StringMethods::MakeSave($this->Sender)."', '".
                 StringMethods::MakeSave($this->RefId)."', '".StringMethods::MakeSave($this->Status)."');";

			OpenSms_Helper_Db::executeNonQuery($sql);
			
			if($this->Id == -1){
				$sql = "select MAX(id) as no from `" . OpenSms::getTableName('sms') . "`";
				$result = OpenSms_Helper_Db::executeReader($sql);
				foreach($result as $r){
					$this->Id = $r->no;
					return $r->no;
				}
			}
		}

    }
?>