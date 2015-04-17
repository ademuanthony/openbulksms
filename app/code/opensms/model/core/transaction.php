<?php
    	class OpenSms_Model_Transaction extends OpenSms_Model_Abstract_ModelBase
        {
            public function __construct(array $param = null)
            {
                $id = !empty($param) && isset($param[0]) ? $param[0] : -1;
                $this->getById($id);
            }

            public function getById($id)
            {
                $this->Id = $id;
                $this->Committed = false;
                if ($id != -1) {
                    $sql = "select * from " . OpenSms::getTableName('transactions') . " where id = '$id';";
                    $result = OpenSms_Helper_Db::executeReader($sql);
                    foreach ($result as $r) {
                        $this->Amount = $r->amount;
                        $this->Unit = $r->unit;
                        $this->Date = $r->date;
                        $this->Description = $r->description;
                        $this->Id = $r->id;
                        $this->LoginId = $r->loginId;
                        $this->PaymentMethod = $r->paymentMethod;
                        $this->Status = $r->status;
                        $this->IsValid = TRUE;
                        $this->Type = $r->type;
                        $this->Committed = $r->committed;
                    }
                }
            }

            public $Id;

            public $LoginId;

            public $Date;

            public $Amount;

            public $Unit;

            public $Status;

            public $Description;

            public $PaymentMethod;

            public $Type;

            public $IsValid;

            public $Committed;

            public function Commit(){
                if($this->Committed)
                    return 'This transaction has already been committed';
                if($this->Status != OpenSms::OPEN_TRANSACTION_STATUS_COMPLETED)
                    return 'Cannot commit a transaction that is not completed.
                    Please change the status of the transaction to completed and try again';
                $user = OpenSms::loadModel('OpenSms_Model_User', [0 => $this->LoginId]);
                if(empty($user->LoginId)){
                    return 'Invalid username';
                }
                switch($this->Type){
                    case OpenSms::OPEN_TRANSACTION_TYPE_CREDIT:
                        $user->Balance += $this->Unit;
                        break;
                    case OpenSms::OPEN_TRANSACTION_TYPE_DEBIT:
                        if($user->Balance < $this->Amount){
                            return $user->Name." does not have up to ".$this->Amount;
                        }
                        $user->Balance -= $this->Amount;
                        break;
                    default:
                        return 'Invalid transaction type';
                        break;
                }
                $this->Committed = true;
                $user->Save();
                return $this->Save();
            }

            public function Save()
            {
                if ($this->Id != -1) {
                    $sql = "update " . OpenSms::getTableName('transactions') . " set amount = '" .
                        $this->Amount . "', unit = '" . $this->Unit . "', committed = '" . $this->Committed .
                        "' , status = '" . $this->Status . "' where id = '$this->Id';";
                } else {
                    $sql = "insert into " . OpenSms::getTableName('transactions') . "(loginId, amount, unit, description, paymentMethod, `type`, status, committed)
				 value('$this->LoginId', '$this->Amount', '$this->Unit', '$this->Description', '$this->PaymentMethod', '$this->Type', '$this->Status', '$this->Committed');";
                }
                //die($sql);
                $result = OpenSms_Helper_Db::executeNonQuery($sql);

                if($this->Id == -1){
                    $sql = "select MAX('id') as id from " . OpenSms::getTableName('transactions') . " where loginId = '$this->LoginId'";
                    $data = OpenSms_Helper_Db::executeReader($sql);
                    foreach($data as $d){
                        $this->Id = $d->id;
                    }
                }
                //die($result);
                return $result;
            }

            public function Delete(){
                $sql = "delete from ".OpenSms::getTableName('transactions')." where id = '$this->Id'";
                return OpenSms_Helper_Db::executeNonQuery($sql);
            }

            public static function copyFromPDO($r)
            {
                $tran = new OpenSms_Model_Transaction();
                $tran->Id = $r->id;
                $tran->LoginId = StringMethods::GetRaw($r->loginId);
                $tran->Date = $r->date;
                $tran->Amount = StringMethods::GetRaw($r->amount);
                $tran->Unit = StringMethods::GetRaw($r->unit);
                $tran->Status = StringMethods::GetRaw($r->status);
                $tran->Description = StringMethods::GetRaw($r->description);
                $tran->PaymentMethod = StringMethods::GetRaw($r->paymentMethod);
                $tran->IsValid = StringMethods::GetRaw(TRUE);
                $tran->Type = $r->type;
                $tran->Committed = $r->committed;

                return $tran;
            }

            public static function Count($loginId = '')
            {
                $sql = "select count(*) as no from " . OpenSms::getTableName('transactions') .
                    (empty($loginId)?"":"where loginId = '$loginId'"). ";";
                $result = OpenSms_Helper_Db::executeReader($sql);
                foreach ($result as $r) {
                    return $r->no;
                }
                return 0;
            }

            public static function GetRange($offset, $limit, $loginId = '')
            {
                $trans = array();
                $sql = "select * from " . OpenSms::getTableName('transactions') . (empty($loginId)?"":"where loginId = '$loginId'") ." ORDER BY id DESC LIMIT $offset, $limit;";
                $result = OpenSms_Helper_Db::executeReader($sql);
                foreach ($result as $r) {
                    $tran = new OpenSms_Model_Transaction();
                    $tran->Id = $r->id;
                    $tran->LoginId = StringMethods::GetRaw($r->loginId);
                    $tran->Date = $r->date;
                    $tran->Amount = StringMethods::GetRaw($r->amount);
                    $tran->Unit = StringMethods::GetRaw($r->unit);
                    $tran->Status = StringMethods::GetRaw($r->status);
                    $tran->Description = StringMethods::GetRaw($r->description);
                    $tran->PaymentMethod = StringMethods::GetRaw($r->paymentMethod);
                    $tran->IsValid = StringMethods::GetRaw(TRUE);
                    $tran->Type = $r->type;
                    $tran->Committed = $r->committed;

                    $trans[] = $tran;
                }
                return $trans;
            }
        }
