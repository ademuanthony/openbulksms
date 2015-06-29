<?php

    class OpenSms_Model_Card extends OpenSms_Model_Abstract_ModelBase{

        public function __construct(array $param = null)
        {
            $serialNumber = !empty($param) && isset($param[0]) ? $param[0] : '';
            $pin = !empty($param) && isset($param[1]) ? $param[1] : '';

            $this->getById($serialNumber, $pin);
        }

        public function getById($serialNumber = '', $pin = '')
        {
            if($serialNumber != '' && $pin != ''){
                $sql = "select * from " . OpenSms::getTableName('cards') . " where serialNumber = '".StringMethods::MakeSave($serialNumber).
                    "' and PIN = '".$pin."';";
                $result = OpenSms_Helper_Db::executeReader($sql);
                foreach($result as $r){
                    $this->SerialNumber = $r->serialNumber;
                    $this->Unit = $r->unit;
                    $this->Id = $r->id;
                    $this->IsValid = TRUE;
                }
            }
        }

        public function getTableName(){
            return OpenSms::getTableName('cards');
        }

        public $Id;

        public $SerialNumber;

        public $Pin;

        public $Unit;

        public $IsValid;

        public function Load($loginId){
            $success = TRUE;
            $sql = "select * from " . OpenSms::getTableName('usedCards') . " where cardId = '".StringMethods::MakeSave($this->Id)."';";
            $result = OpenSms_Helper_Db::executeReader($sql);
            foreach($result as $r){
                $success = FALSE;
                if($loginId == $r->loginId)
                    $message = 'This card has already been used by you';
                else
                    $message = 'This card has already been used';			
			}

            if($success){
                $sql = 'insert into ' . OpenSms::getTableName('usedCards') . ' (loginId, cardId) value("'.$loginId.'", "'.$this->Id.'");';
                //die($sql);
                $inserted = OpenSms_Helper_Db::executeNonQuery($sql);
                if($inserted){
                    $user = OpenSms::loadModel("OpenSms_Model_User", [0 => $loginId]);
                    $user->Balance += $this->Unit;
                    $user->Save();
                    $message = 'Your account has been credited with '.$this->Unit.' SMS unit';
                }
            }
            return array('success' => $success, 'message' => $message);

        }

        public static function GenerateCard($no, $unit){
            $cards = array();
            
            for($i = 1; $i <= $no; $i++){
                //get the s/n
                $snExist = FALSE;
                while(!$snExist){
                    $sn = StringMethods::GetRandomString(5);
                    $sql = 'select count(*) as num from ' . OpenSms::getTableName('cards') . ' where serialNumber = "$sn";';
                    $result = OpenSms_Helper_Db::executeReader($sql);
                    foreach($result as $r){
                        if($r->num == 0){
                            $snExist = TRUE;
                        }		
				    }
                }
                //get the pin
                $pinExist = FALSE;
                while(!$pinExist){
                    $pin = StringMethods::GetRandomString(10);
                    $sql = 'select count(*) as num from ' . OpenSms::getTableName('cards') . ' where pin = "'.$pin.'";';
                    $result = OpenSms_Helper_Db::executeReader($sql);
                    foreach($result as $r){
                        if($r->num == 0){
                            $pinExist = TRUE;
                        }		
				    }
                }

                //insert the pin
                $sql = 'insert into ' . OpenSms::getTableName('cards') . ' (serialNumber, pin, unit) value("'.$sn.'", "'.$pin.'", "'.$unit.'");';
                $inserted = OpenSms_Helper_Db::executeNonQuery($sql);
                if($inserted){
                    $card = new OpenSms_Model_Card();
                    $card->SerialNumber = $sn;
                    $card->Pin = $pin;
                    $card->Unit = $unit;
                   $cards[] = $card;
                }

            }

            return $cards;
        }

        public static function GetCard($offset, $limit){
            $sql = "select * from ". OpenSms::getTableName('cards') . " $offset, $limit";
            $result = OpenSms_Helper_Db::executeReader($sql);
            $cards = array();
            foreach($result as $r){
                $card = new OpenSms_Model_Card();
                $card->Id = $r->id;
                $card->Pin = $r->pin;
                $card->Unit = $r->unit;
                $card->IsValid = true;
                $cards[] = $card;
            }

            return $cards;
        }
    }
?>