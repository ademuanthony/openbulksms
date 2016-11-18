<?php
class OpenSms_Abstract_Module_Base extends OpenSms_Helper_Db{
    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        $this->module = OpenSms::getCurrentModule();
        $this->data['currentTheme'] = OpenSms::getCurrentTheme();
        $this->date['pageKeyword'] = '';
        $this->data['pageDescription'] = '';

    }

    protected $module = NULL;
    protected $data = array();

    protected function loadHelper($name){
        throw new ErrorException();
    }

    public function loadModel($model_name, array $param = null)
    {
        return OpenSms::loadModel($model_name, $param);
    }

    public function callModelStaticMethod($model, $method, array $param = null){
        return OpenSms::callModelStaticMethod($model, $method, $param);
    }
}
