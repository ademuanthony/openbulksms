<?php

class OpenSms_Model_System_Module_Field{

    public function __construct($_label, $_key, $_type, $_sort_order, $value){
        $this->label = $_label;
        $this->key = $_key;
        $this->type = $_type;
        $this->sort_order = $_sort_order;
        $this->value = $value;
    }

    public $label;

    public $key;

    public $type;

    public $sort_order;

    public $value;
}

class OpenSms_Model_System_ModelMeta{
    public function __construct($_key, $class_name, $_filePath){
        $this->key = $_key;
        $this->className = $class_name;
        $this->filePath = $_filePath;
    }
    public $key;

    public $className;

    public $filePath;
}

class OpenSms_Model_System_Payment{

    public function __construct($_lable, $_key, $_sort_order, $_enabled, $_order_status, $_controller, $_action, $_filePath){
        $this->label = $_lable;
        $this->key = $_key;
        $this->sort_order = $_sort_order;
        $this->enable = $_enabled;
        $this->order_status = $_order_status;
        $this->controller = $_controller;
        $this->filePath = $_filePath;
        $this->action = $_action;
    }


    public $label;

    public $key;

    public $controller;

    public $filePath;

    public $action;

    public $sort_order;

    public $order_status;

    public $enable;

    public static $payment_methods = null;

    public static function getPaymentMethod($_key, $loadController = false){
        if(!$loadController) return self::getPaymentMethods()[$_key];
        $payment = self::getPaymentMethods()[$_key];
        if(!class_exists($payment->controller)){
            include './app/code/'.$payment->filePath;
        }
        return $payment;
    }

    public static function getPaymentMethods(){
        if(self::$payment_methods != null) return self::$payment_methods;

        self::$payment_methods = array();
        $modules = OpenSms_Model_System_Module::getModules();
        foreach($modules as $m){
            foreach($m->payments as $p){
                self::$payment_methods[$p->key] = $p;
            }
        }
        return self::$payment_methods;
    }
}

class OpenSms_Model_System_Route{
    public function __construct($_uri, $_controller, $_filePath, $_action){
        $this->uri = $_uri;
        $this->controller = $_controller;
        $this->filePath = $_filePath;
        $this->action = $_action;
    }
    public $uri;

    public $controller;

    public $filePath;

    public $action;
}

class OpenSms_Model_System_Module{

    public  function __construct($_name){
        if(file_exists('app/modules/overwrites/'.strtolower($_name).'.xml')){
            $this->path = 'overwrites';
        }
        else if(file_exists('app/modules/main/'.strtolower($_name).'.xml')){
            $this->path = 'main';
        }
        else{
            $this->exists = FALSE;
            return;
        }

        $this->fileName = 'app/modules/'.$this->path.'/'.strtolower($_name).'.xml';
        $this->load($this->fileName);
    }
    
    /*
        instant members
    */
    public $label;

    public $company;

    public $name;

    public $path;

    public $fileName;

    public $version;

    public $license;

    public $enabled;

    public $routes;

    public $fields;

    public $payments;

    public $modelRegistry;

    public $actions;

    public $exists;

    public $appCast;

    private function load($fileName){
        if(!file_exists($fileName)) return NULL;
        $module_xml=simplexml_load_file($fileName);
        $this->exists = isset($module_xml->name);
        $this->label = (string)$module_xml->label;
        $this->company = (string)$module_xml->company;
        $this->name = (string)$module_xml->name;
        $this->version = (string)$module_xml->version;
        $this->license = (string)$module_xml->lincense;
        $this->enabled = (string)$module_xml->enabled;
        $this->appCast = (string)$module_xml->app_cast;

        //load routes
        $this->routes = array();
        if(isset($module_xml->routes->route))
        foreach($module_xml->routes->route as $route){
            $route_model = new OpenSms_Model_System_Route((string)$route->uri, (string)$route->controller,
                (string)$route->filePath, (string)$route->action);
            $this->routes[] = $route_model;
        }

        //load fields
        $this->fields = array();
        if(isset($module_xml->fields->field))
        foreach($module_xml->fields->field as $field){

            $field_model = new OpenSms_Model_System_Module_Field((string)$field->label, (string)$field->key, (string)$field->type,
                (string)$field->sort_order, (string)$field->value);
            $this->fields[] = $field_model;
        }
        
        //load payment
        $this->payments = array();
        if(isset($module_xml->payments->payment))
        foreach($module_xml->payments->payment as $payment){
            $payment_model = new OpenSms_Model_System_Payment((string)$payment->label, (string)$payment->key,
                (string)$payment->sort_order, (string)$payment->enable, (string)$payment->order_status,
                (string)$payment->controller, (string)$payment->action, (string)$payment->filePath);
            $this->payments[] = $payment_model;
        }

        //model meta
        $this->modelRegistry = array();
        if(isset($module_xml->model_register->model))
            foreach($module_xml->model_register->model as $modelMeta){
                $model_meta = new OpenSms_Model_System_ModelMeta((string)$modelMeta->key,
                    (string)$modelMeta->class_name, (string)$modelMeta->file_path);
                $this->modelRegistry[] = $model_meta;
            }

        //model actions
        $this->actions = array();
        if(isset($module_xml->actions->action))
            foreach($module_xml->actions->action as $action_xml){
                $action = new OpenSms_Model_System_Action((string)$action_xml->key, (string)$action_xml->method,
                    (string)$action_xml->class, (string)$action_xml->fileName, (string)$action_xml->module);
                $this->actions[] = $action;
            }

        //save
        self::$modules[(string)$this->name] = $this;
    }

    public static function getField($key){
        $moduleName = explode('_', $key)[0];
        $module = self::getModule($moduleName);
        if(!$module->exists) return null;
        foreach($module->fields as $field){
            if(strtolower($field->key) == strtolower($key)) return $field;
        }
        return null;
    }
    
    /*
        static members
    */
    public  static function getModule($_name){
        if(!empty(self::$modules[$_name])) return self::$modules[$_name];
        return !empty(self::$modules[$_name]) ? self::$modules[$_name] : new OpenSms_Model_System_Module($_name);
    }
    public static $modules;

    public static function getModules(){
        $modules = array();
        if ($handle = opendir('app/modules/main/')) {

            while (false !== ($entry = readdir($handle))) {

                if ($entry != "." && $entry != "..") {
                    $name = explode('.', $entry)[0];
                    $modules[$name] = self::getModule($name);
                }
            }
            closedir($handle);
        }
        return $modules;
    }
}

class OpenSms_Model_System_Action{
    public function __construct($key, $method, $class, $fileName, $module){
        $this->key = $key;
        $this->method = $method;
        $this->moduleName = $module;
        $this->fileName = $fileName;
        $this->class = $class;
    }

    public $key;
    public $method;
    public $class;
    public $fileName;
    public $moduleName;

    private static $actions = array();
    public static function getAll(){
        if(count(self::$actions) > 0)  return selft::$actions;

        $modules = OpenSms_Model_System_Module::getModules();
        foreach ($modules as $module) {
            foreach ($module->actions as $action) {
                $actions[] = $action;
            }
        }
        return $actions;
    }
}

class OpenSms_Model_System_Theme_Field{
    public function __construct($label, $key, $type, $value, $readonly){
        $this->label = $label;
        $this->key = $key;
        $this->type = $type;
        $this->value = $value;
        $this->readonly = $readonly;
    }

    public $label;
    public $key;
    public $type;
    public $value;
    public $readonly;
}

class OpenSms_Model_System_Theme{
    private static $collection = array();
    public function __construct($key){
        if(isset(self::$collection[$key])){
            $theme = self::$collection[$key];
            $this->name = $theme->name;
            $this->key = $theme->key;
            $this->screenShot = $theme->screenShot;
            $this->version = $theme->version;
            $this->author = $theme->author;
            $this->url = $theme->url;
            $this->email = $theme->email;
            $this->appCast = $theme->appCast;
            $this->exists = !empty($this->name);

            $this->fields = $theme->fields;
        }else {
            $this->load($key);
        }
    }

    public $name;
    public $key;
    public $screenShot;
    public $version;
    public $author;
    public $url;
    public $email;
    public $appCast;

    public $fields;

    private function load($key){
        $fileName = OpenSms::DESIGN_PATH.$key.'/theme.xml';
        if(!file_exists($fileName)) return NULL;
        $theme_xml=simplexml_load_file($fileName);
        $this->name = (string)$theme_xml->name;
        $this->key = (string)$theme_xml->key;
        $this->screenShot = (string)$theme_xml->screen_shot;
        $this->version = (string)$theme_xml->version;
        $this->author = (string)$theme_xml->author;
        $this->url = (string)$theme_xml->url;
        $this->email = (string)$theme_xml->email;
        $this->appCast = (string)$theme_xml->appCast;
        $this->exists = !empty($this->name);

        //load fields
        $this->fields = array();
        if(isset($theme_xml->fields->field))
            foreach($theme_xml->fields->field as $field){

                $field_model = new OpenSms_Model_System_Theme_Field((string)$field->label, (string)$field->key, (string)$field->type,
                    (string)$field->value, (string)$field->readonly);
                $this->fields[] = $field_model;
            }

        self::$collection[$this->key] = $this;
    }

    public function getSettingsFile(){
        return OpenSms::DESIGN_PATH.$this->key.'/theme.xml';
    }

    public function getField($key){
        foreach($this->fields as $field){
            if(strtolower($field->key) == strtolower($key)){
                return $field;
            }
        }
    }

    public static function getAll(){
        //check design directory and ensure that all themes are in the collection
        $directories = glob(OpenSms::DESIGN_PATH . '*' , GLOB_ONLYDIR);
        foreach($directories as $dir){
            $key = explode('/',$dir)[2];
            if(!isset(self::$collection[$key])){
                new OpenSms_Model_System_Theme($key);
            }
        }
        return self::$collection;
    }
}

class OpenSms_Model_System_View{
    public function __construct($key, $content, $type, $isFile, $position){
        $this->key = $key;
        $this->content = $content;
        $this->type = $type;
        $this->isFile = $isFile;
        $this->position = $position;
    }

    public $key;
    public $content;
    public $type;
    public $isFile;
    public $position;
}