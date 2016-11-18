<?php
/**
 * Created by PhpStorm.
 * User: Chinedu
 * Date: 20/09/2015
 * Time: 14:28
 */
class Api extends OpenSms_Abstract_Module_Controller{
    public function Index(){
        $this->data['user'] = $this->checkLogin();
        $this->data['pageTitle'] = "SMS API";
        $this->renderTemplate();
    }

    public function Send(){
        if(empty($_REQUEST['callback'])) $_REQUEST['callback'] = 'callback';
        $user =  $this->checkLogin();

        //var_dump($_POST); die();
        if(isset($_REQUEST['callback'])){
            $hasErro = FALSE;
            if($_REQUEST['sender'] == '' || $_REQUEST['message'] == ''){
                $notification = 'Sender and message cannot be empty';
                $hasErro = TRUE;
            }else{
                //sending message
                $recepients = '';
                //getting recipiet from the txtbox
                if(isset($_REQUEST['recipient'])){
                    $contactInput = preg_split('/(\r?\n)+/', trim($_REQUEST['recipient']));
                    foreach($contactInput as $ci){
                        $recepients .= $ci.',';
                    }
                }

                //getting recipient from group
                if(isset($_REQUEST['groupid']) && trim($_REQUEST['groupid']) != '-1'){
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
                $len = strlen($_REQUEST['message']);
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
                        $url = str_replace('@senderId@', urlencode($_REQUEST["sender"]), $url);
                        $url = str_replace('@message@', urlencode($_REQUEST["message"]), $url);
                        $url = str_replace('@recipients@', trim($recepients), $url);



                        //die($url);


                        //messge scheduling &sendondate=13-04-2014T12:03:20
                        if(isset($_REQUEST['send_later']) && $_REQUEST['send_later'] == 1){
                            $y = $_REQUEST['schedule_year'];
                            $mnt = $_REQUEST['schedule_month'];
                            $d = $_REQUEST['schedule_day'];
                            $h = $_REQUEST['schedule_hour'];
                            $m = $_REQUEST['schedule_munite'];
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

                        //var_dump($xml);dd(OpenSms::getField('Sms_Api_Success_Keyword')->value);
                        //dd(strpos(strtolower($xml), strtolower(OpenSms::getField('Sms_Api_Success_Keyword'))));

                        if(strpos(strtolower($xml), strtolower(OpenSms::getField('Sms_Api_Success_Keyword')->value)) > -1){
                            $user->Balance -= ($count * OpenSms::getSystemSetting(OpenSms::OPEN_UNITS_PER_SMS));
                            $user->Save();
                            $notification = "Message sent";

                            $bulksSMS = $this->loadModel('OpenSms_Model_BulkSms');
                            $bulksSMS->LoginId = $user->LoginId;
                            $bulksSMS->Message = $_REQUEST['message'];
                            $bulksSMS->Sender = $_REQUEST['sender'];
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
                                $message->Message = $_REQUEST['message'];
                                $message->Sender = $_REQUEST['sender'];
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



        die(OpenSms::jSonp(['message'=>$notification, 'error' => $hasErro], $_REQUEST['callback']));
    }

    public function Balance(){
        if(empty($_REQUEST['callback'])) $_REQUEST['callback'] = 'callback';
        $user = $this->checkLogin();
        die(OpenSms::jSonp(array('balance'=>$user->Balance, 'error' => false), $_REQUEST['callback']));
    }
}