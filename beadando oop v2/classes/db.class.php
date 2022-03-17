<?php
//require_once 'init.inc.php';
require_once 'functions/sanatize.php';
Class Db {
    private static $_instance = null;   //The "_" implies that it's a private or protected variable.
    private $_pdo;
    private $_query;    //Last query tha is executed.
    private $_error;    //It represents wheter ther is an error or not.
    private $_results;  //It stores the result set
    private $_count=0;  // Count of the result set.
    
    
    private function __construct() {
        try{        
            $this->_pdo = new PDO('mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db'),Config::get('mysql/username'),Config::get('mysql/password'));
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    
    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new DB();
        }
        return self::$_instance;
    }
    
    public function query($sql,$params = array()){
         $this->_error = false;
         if($this->_query = $this->_pdo->prepare($sql)){
            if(count($params)){
                $position = 1;
                foreach($params as $param)
                {
                    $this->_query->bindValue($position,$param);
                    $position++;
                }
            }
            if($this->_query->execute()){
                $tmp = explode(" ",$sql);
                if($tmp[0]==='SELECT') //!$tmp[0]==='INSERT'&&!$tmp[0]==='UPDATE'
                {
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                }
                //$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount(); // rowCount if the last executed sql statment was a SELECT statment won't always return  the number of rows returned by that statement.Depending on the database.
                
            }else{
                $this->_error = true;
            }
         }
         return $this;
    }
    
    private function action($action,$table,$where = array()) {
        if(count($where)===3){
            $operators = array('=','>','<','>=','<=');
            $field    = $where[0];
            $operator = $where[1];
            $value    = $where[2];
            
            if(in_array($operator,$operators)){
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                if($this->query($sql,array($value))){
                    return $this;
                }
            }
        }
        else
        {
            $sql = "{$action} FROM {$table}";
            if($this->query($sql)){
                return $this;
            }
        }
        
    }
    
    public function get($table,$where = array()) {
        return $this->action('SELECT *',$table,$where);
    }

    public function delete($table,$where = array()) {
        return $this->action('DELETE',$table,$where);
    }
    
    public function results(){
        return $this->_results;
    }
    
    public function first(){
        return $this->_results[0];  //alternative $this->results()[0];
    }
    
    public function error() {
        return $this->_error;
    }
    
    public function count() {
        return $this->_count;   
    }
    /*
    insert:
        $field format: array('colum'(as key) => 'value'(as value))
    */
    public function insert($table_name,$fields = array()){  
        $keys = array_keys($fields);
        $values = '';
        $x = 1;
        foreach($fields as $field)
        {
            $values .= '?';
            if($x < count($fields))
            {
                $values .= ' ,';
            }
                $x++;
        }
       
        $sql ="INSERT INTO {$table_name}("."`".implode('`,`',$keys)."`) VALUES({$values})";

        if(!$this->query($sql,$fields)->error())
        {
            return true;
        }
            
        
        return false;
    }
    /*
    update:
        $Where is nullable or format:array('colum','operator','value')
        $field format: array('colum'(as key) => 'value'(as value))
    */
    public function update($table_name,$fields = array(),$where = array()){  
        $set = '';
        $x = 1;
        foreach($fields as $name => $value)
        {
            $set .= "{$name} = ?";
            if($x < count($fields))
            {
                $set .= ",";
            }
            $x++;
        }
        if(isset($where)&&count($where)===3)
        {
            $operators = array('=','>','<','>=','<=');
            $field    = $where[0];
            $operator = $where[1];
            $value    = $where[2];
            if(in_array($operator,$operators))
            {
            $sql = "UPDATE {$table_name} SET {$set} WHERE {$field} {$operator} ?";
            $fields['where_value'] = $value;
            }
        }else
        {
            $sql = "UPDATE {$table_name} SET {$set}";
        }
        if(!$this->query($sql,$fields)->error())
        {
            return true;
        }
        return false;
    }

    
}