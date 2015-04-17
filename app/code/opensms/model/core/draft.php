<?php

	class OpenSms_Model_Draft
    {

        public function __construct($id = -1)
        {
            $this->Id = $id;
            $this->db = new TDataAccess();
            if ($id != '') {
                $sql = "select * from draft where id = '$id';";
                $result = $this->db->SendQuery($sql);
                while ($r = $result->fetch_assoc()) {
                    extract($r);
                    $this->LoginId = StringMethods::GetRaw($loginId);
                    $this->DateCreated = $dateCreated;
                    $this->Recipient = StringMethods::GetRaw($recipient);
                    $this->Message = StringMethods::GetRaw($message);
                    $this->Sender = StringMethods::GetRaw($sender);
                    $this->DeliveryType = $deliveryType;
                }
            }
        }

        public $Id;

        public $LoginId;

        public $Recipient;

        public $Message;

        public $DateCreated;

        public $DeliveryType;//draft, scheduled, sent

        public $Sender;


        public function Save()
        {
            if ($this->Id != -1) {
                $sql = "update draft set message = '" . StringMethods::MakeSave($this->Message)
                    . "', recipient = '" . StringMethods::MakeSave($this->Recipient) . "', deliveryType = '" .
                    StringMethods::MakeSave($this->DeliveryType) . "' where id = '$this->Id';";
            } else {
                $sql = "insert into draft(loginId, recipient, message, sender, deliveryType)
				 value('" . StringMethods::MakeSave($this->LoginId) . "', '" . StringMethods::MakeSave($this->Recipient) .
                    "', '" . StringMethods::MakeSave($this->Message) . "', '" .
                    StringMethods::MakeSave($this->Sender) . "', '" . StringMethods::MakeSave($this->DeliveryType) . "');";
            }
            $this->db->SendQuery($sql);

            if ($this->Id == -1) {
                $sql = "select MAX(id) as no from `draft`";
                $result = $this->db->SendQuery($sql);
                while ($r = $result->fetch_assoc()) {
                    $this->Id = $r['no'];
                    return $r['no'];
                }
            }
        }

        public function Delete()
        {
            $sql = "delete from draft where id = '" . StringMethods::MakeSave($this->Id) . "'";
            return $this->db->SendQuery($sql);
        }

        public static function copyFromPDO($pdoObj){
            $d = new OpenSms_Model_Draft();
            $d->Id = $pdoObj->id;
            $d->LoginId = $pdoObj->loginId;
            $d->Message = $pdoObj->message;
            $d->DateCreated = $pdoObj->dateCreated;
            $d->Recipient = $pdoObj->recipient;
            $d->DeliveryType = $pdoObj->deliveryType;
            $d->Sender = $pdoObj->sender;

            return $d;
        }

    }

?>