<?php
class OpenSms_Helper_Db{
    private static $db = NULL;

    private $tablePrefix;

    protected function getSystemSetting($key){
        return OpenSms::getSystemSetting($key);
    }
    protected function  loadSystemSettings(){
        OpenSms::loadSystemSettings();
    }

    protected function getModelRegistry(){
        return OpenSms::getModelRegistry();
    }

    protected function getTablePrefix(){
        OpenSms::getTablePrefix();
    }

    protected function getTableName($name){
        return OpenSms::getTableName($name);
    }

    protected function getDb(){
        return self::getClassDb();
    }

    public static function getClassDb(){
        if(self::$db != NULL) return self::$db;
        $db_name = OpenSms::getSystemSetting(OpenSms::DB_NAME);
        if(empty($db_name)) return null;
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        self::$db = new PDO(OpenSms::getSystemSetting(OpenSms::DB_TYPE) . ':host=' .
            OpenSms::getSystemSetting(OpenSms::DB_HOST) . ';dbname=' .
            OpenSms::getSystemSetting(OpenSms::DB_NAME), OpenSms::getSystemSetting(OpenSms::DB_USERNAME),
            OpenSms::getSystemSetting(OpenSms::DB_PASSWORD), $options);
        return self::$db;
    }

    public static function executeNonQuery($sql, array $param = null){
        $query = self::getClassDb()->prepare($sql);
        $result = $query->execute();
        $query->closeCursor();
        return $result;
    }

    public static function executeReader($sql, array $param = null){
        $db = self::getClassDb();
        if(empty($db)) return null;
        $query = $db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    protected function getOption($key, $takeOne = TRUE){
        $sql = "select `value` from ".$this->getTableName('options')." where `key' = $key;";

        $values = array();
        foreach($this->getDb()->query($sql) as $row) {
            if($takeOne) return $row['value'];
            $values[] = $row['value'];
        }
        return $values;
    }

    protected function setOption($key, $isUnuiqe = TRUE){
        throw new ErrorException();
    }

}
