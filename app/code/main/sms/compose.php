<?php
/**
 * Created by Ademu Anthony.
 * User: Tony
 * Date: 3/30/2015
 * Time: 6:00 PM
 */

class Compose extends OpenSms_Abstract_Module_Controller{

    public function Index(){

        $this->data['pageTitle'] =  'Compose | '.OpenSms::getSystemSetting(OpenSms::SITE_NAME);

        $this->data['user'] = $this->checkLogin();
        $this->data['groups'] = $this->data['user']->GetGroups();

        $this->renderTemplate();
    }

    public function Send(){
        $user =  $this->checkLogin();

        //var_dump($_POST); die();
        if(isset($_POST['sendmessage'])){
            $hasErro = FALSE;
            if($_POST['sender'] == '' || $_POST['message'] == ''){
                $notification = 'Sender and message cannot be empty';
                $hasErro = TRUE;
            }else{
                //sending message
                $recepients = '';
                //getting recipiet from the txtbox
                if(isset($_POST['recipient'])){
                    $contactInput = preg_split('/(\r?\n)+/', trim($_POST['recipient']));
                    foreach($contactInput as $ci){
                        $recepients .= $ci.',';
                    }
                }

                //getting recipient from the uploaded file
                if (!(empty($_FILES['to_file']['name']))) {
                    //chicking file type
                    $allowedTxt =  array('txt','TXT');
                    $allowedXls =  array('xls','XLS');
                    $filename = $_FILES['to_file']['name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);

                    if(in_array($ext,$allowedTxt) ) {
                        $fp = fopen($_FILES['to_file']['tmp_name'], 'rb');
                        while ( ($line = fgets($fp)) !== false) {
                            if(strlen(trim($line)) > 4){
                                $f = substr($line, 0, 1);
                                if($f != '0' && $f != '2'){
                                    $line = '0'.$line;
                                }
                                $recepients .= $line.',';
                            }
                        }
                    }elseif(in_array($ext,$allowedXls)){
                        //excel sheet
                        require_once('app/code/opensms/helper/excel_reader2.php');
                        $data = new Spreadsheet_Excel_Reader($_FILES['to_file']['tmp_name']);
                        for($i=0;$i<count($data->sheets);$i++) // Loop to get all sheets in a file.
                        {
                            if(count($data->sheets[$i]['cells'])>0) // checking sheet not empty
                            {
                                for($j=1;$j<=count($data->sheets[$i]['cells']);$j++) // loop used to get each row of the sheet
                                {
                                    $num = $data->sheets[$i]['cells'][$j][1];
                                    if(strlen(trim($num)) > 4){
                                        $f = substr($num, 0, 1);
                                        if($f != '0' && $f != '2'){
                                            $num = '0'.$num;
                                        }
                                        $recepients .= $num.',';
                                    }
                                }
                            }
                        }

                    }else{
                        $notification = 'Error! Please upload a text or an excel(xls) file';
                        $hasErro = TRUE;
                    }
                }

                //getting recipient from group
                if(isset($_POST['groupid']) && trim($_POST['groupid']) != '-1'){
                    $g = $this->loadModel('OpenSms_Model_Group', [0 => $_POST['groupid']]);
                    $recepients .= $g->SerializeContacts();
                }

                //senitizing number
                $recepients = str_replace(' ', '', trim($recepients));//take out spcae
                $recepients = str_replace(PHP_EOL, '', trim($recepients));//take out new lines
                $recepients = str_replace('+', '', $recepients);
                if(substr($recepients, 0, 1) == '0')
                    $recepients = '234'.substr($recepients, 1);

                $recepients = str_replace(',0', ',234', $recepients);


                //take away the 1st and last comma
                if(substr($recepients, 0, 1) == ',')
                    $recepients = ''.substr($recepients, 1);

                if(substr($recepients, strlen($recepients) - 1, 1) == ',')
                    $recepients = ''.substr($recepients, 0, strlen($recepients) - 1);


                //balanc check
                $len = strlen($_POST['message']);
                $lenPerSMS = $len < 160? 160:153;

                $msgNo = $len < $lenPerSMS? 1: ($len - $len % $lenPerSMS)/$lenPerSMS;
                $msgNo  = ($len > $lenPerSMS && $len % $lenPerSMS != 0)? $msgNo + 1: $msgNo;



                //dskljfsaddlkl mk
                $notification = '';
                $hasErro = FALSE;

                $count = ceil(count(explode(',', $recepients)) * $msgNo);

                $avu = ($user->Balance * 1);
                $uneeded = ($count * OpenSms::getSystemSetting(OpenSms::OPEN_UNITS_PER_SMS));


                if($avu < $uneeded){
                    $notification = 'Insufficient SMS unit!';
                    $hasErro = TRUE;
                }else{
                    if($count > 0 && !$hasErro){

                        /*
                        $url = API_URL.'api/SAPI/sendMessage?returnDetails=1&loginId='.API_USERNAME.'&password='.API_PASSWORD.'&senderId='.
                            urlencode($_POST["sender"]).'&message='.urlencode($_POST['message']).
                            '&Recipients='.trim($recepients).'&sendOnDate=2/2/2';
                        */


                        $url = OpenSms::getField('Sms_Send_Api')->value;

                        //replace username, password, senderId, message, recipients, sendOnDate
                        $url = str_replace('@username@', OpenSms::getField('Sms_Api_Username')->value, $url);
                        $url = str_replace('@password@', OpenSms::getField('Sms_Api_Password')->value, $url);
                        $url = str_replace('@senderId@', urlencode($_POST["sender"]), $url);
                        $url = str_replace('@message@', urlencode($_POST["message"]), $url);
                        $url = str_replace('@recipients@', trim($recepients), $url);



                        //die($url);


                        //messge scheduling &sendondate=13-04-2014T12:03:20
                        if(isset($_POST['send_later']) && $_POST['send_later'] == 1){
                            $y = $_POST['schedule_year'];
                            $mnt = $_POST['schedule_month'];
                            $d = $_POST['schedule_day'];
                            $h = $_POST['schedule_hour'];
                            $m = $_POST['schedule_munite'];
                            $now = new DateTime();
                            $selectedDateStr = $d.'-'.$mnt.'-'.$y.'T'.$h.':'.$m.':00';

                            $sendDate = '&sendondate='.urlencode($selectedDateStr);

                            $url.=$sendDate;

                            $url = str_replace('@sendOnDate@', $sendDate, $url);
                        }else{
                            $url = str_replace('@sendOnDate@', '2/2/2', $url);
                        }


                        //die($url);
                        $xml = file_get_contents($url);

                        //var_dump($xml);die();
                        //<result>True</result>
                        //1701
                        //check if message sent and deduct
                        //strpos(strtolower($xml), strtolower(OpenSms::getField('Sms_Api_Success_Keyword'))
                        if(strpos(strtolower($xml), strtolower(OpenSms::getField('Sms_Api_Success_Keyword')->value))){
                            $user->Balance -= ($count * OpenSms::getSystemSetting(OpenSms::OPEN_UNITS_PER_SMS));
                            $user->Save();
                            $notification = "Message sent";

                            $bulksSMS = $this->loadModel('OpenSms_Model_BulkSms');
                            $bulksSMS->LoginId = $user->LoginId;
                            $bulksSMS->Message = $_POST['message'];
                            $bulksSMS->Sender = $_POST['sender'];
                            $bulksSMS->Status = 1701;
                            $bulksSMS->Count = $count;
                            $bulksSMS->Save();

                            $messages = array();
                            $nos = explode(',', $recepients);
                            foreach($nos  as $no){
                                if(empty($no)){
                                    continue;
                                }
                                $message = $this->loadModel('OpenSms_Model_Message');
                                $message->BulkSMSId = $bulksSMS->Id;
                                $message->Number = $no;
                                $message->Message = $_POST['message'];
                                $message->Sender = $_POST['sender'];
                                $message->RefId = -1;
                                $message->Status = 1701;

                                $messages[] = $message;
                            }

                            $bulksSMS->SaveMessages($messages);
                        }else{
                            $notification = "Error! Message not sent";
                        }

                    }else{
                        if(!$hasErro)
                            $notification = 'Please enter at least one number';
                    }
                }
            }

        }
        else{
            $notification = 'Invalid request param';
            $hasErro = TRUE;
        }

        if($hasErro) $this->setError($notification, 'compose_send');
        else $this->setNotification($notification, 'compose_send');
        OpenSms::redirectToAction('Index');
    }

} 