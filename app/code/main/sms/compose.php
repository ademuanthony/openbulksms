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
            $hasError = FALSE;
            if($_POST['sender'] == '' || $_POST['message'] == ''){
                $notification = 'Sender and message cannot be empty';
                $hasError = TRUE;
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
                        $hasError = TRUE;
                    }
                }

                //getting recipient from group
                if(isset($_POST['groupid']) && trim($_POST['groupid']) != '-1'){
                    $g = $this->loadModel('OpenSms_Model_Group', [0 => $_POST['groupid']]);
                    $recepients .= $g->SerializeContacts();
                }

                $result = $this->sendMessage($_POST['sender'], $_POST['message'], $recepients);
                $notification = $result['message'];
                $hasError = $result['status'];
            }

        }
        else{
            $notification = 'Invalid request param';
            $hasError = TRUE;
        }

        if($hasError) $this->setError($notification, 'compose_send');
        else $this->setNotification($notification, 'compose_send');
        OpenSms::redirectToAction('Index');
    }

} 