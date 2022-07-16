<?php
class Database{
    protected $db;
    private static $instance = null;
    public function __construct()
    {
        try{
            $this->db = new PDO(
                'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8;',
                DB_USER,DB_PASS
            );
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new Database();
        }
        return self::$instance;
    }
    public function query($query, $params = array()){
        $statement = $this->db->prepare($query);
        $statement->execute($params);
        $checkQuery = strtolower(explode(' ', $query)[0]);
        if($checkQuery == 'select'){
            $data = $statement->fetchAll();
            return $data;
        }
    }
}