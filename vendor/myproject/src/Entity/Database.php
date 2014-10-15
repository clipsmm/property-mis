<?php
/**
 * Created by PhpStorm.
 * User: Meshaq
 * Date: 3/3/14
 * Time: 4:00 PM
 */

namespace Entity;


class Database {
    protected $dbHost;
    protected $dbName;
    protected $dbUser;
    protected $dbPassword;
    protected $dbConnection;
    protected $dbTable;
    protected $dbQuery;
    protected $dbConnect;

    public function set(){
        $this->dbHost = (DB_HOST);
        $this->dbName = (DB_NAME);
        $this->dbUser = (DB_USER);
        $this->dbPassword = (DB_PASSWORD);
    }
    public function open(){
        $this->set();
        $conn = mysql_connect($this->dbHost,$this->dbUser,$this->dbPassword);
        $con = mysql_select_db($this->dbName,$conn);
        if ($con){
            $this->dbConnect = true;
            $this->dbConnection = $con;
        }else{
            echo mysql_error()."<br>".$this->dbUser;
        }
    }


    //close database connection
    public function close(){
        $closed = mysql_close();
        if ($closed){
            $this->dbConnect = false;
        }else{
            $this->dbConnect = true;
            echo mysql_error($this->dbConnection);
        }

    }

    public function query($query){
        $this->dbQuery = $query;
    }


    public function persist(){
        $this->open();
        if($this->dbQuery != NULL || $this->dbQuery ==""){
            // $this->table($this->dbName);
            $doQuery = mysql_query($this->dbQuery) or die(mysql_error());
                if($doQuery){
                    return $doQuery;
                }else{
                    return "Error".mysql_errno()."".mysql_error();
                }

        }
    }

    public function fetch($arr){
        return mysql_fetch_assoc($arr);
    }

    public function flush(){
        unset($this);
    }

    public function getEntity($entity){
        $this->query("SELECT * FROM ".$entity."");
        $result = $this->persist();
        $entity = $this->fetch($result);

        return $entity;
    }
    public function getRawEntity($entity){
        $this->query("SELECT * FROM ".$entity."");
        $entity = $this->persist();

        return $entity;
    }

    public function searchEntity($entity,$term){
        $searchphrase = $term;
        $table = $entity;
        $sql_search = "select * from ".$table." where ";
        $sql_search_fields = Array();
        $sql = "SHOW COLUMNS FROM ".$table;
        $rs = mysql_query($sql);
        while($r = mysql_fetch_array($rs)){
            $colum = $r[0];
            $sql_search_fields[] = $colum." like('%".$searchphrase."%')";
        }

        $sql_search .= implode(" OR ", $sql_search_fields);
        $rs2 = $this->query($sql_search);
        $result = $this->persist();
        if ($this->rows($result)>0){
            return $result;
        }else{
            return false;
        }
    }
    public function getEntityById($entity,$id){
        $this->query("SELECT * FROM ".$entity." WHERE id='$id'");
        $result = $this->persist();
        $entity = $this->fetch($result);

        return $entity;
    }

    public function getEntityBy($entity,$col,$term){
        $this->query("SELECT * FROM ".$entity." WHERE ".$col."='$term'");
        $result = $this->persist();
        $entity = $this->fetch($result);

        return $entity;
    }
    public function getRawEntityBy($entity,$col,$term){
        $this->query("SELECT * FROM ".$entity." WHERE ".$col."='$term'");
        $result = $this->persist();

        return $result;
    }

    public function getEntityDetail($entity,$id,$col){
        $this->query("SELECT * FROM ".$entity." WHERE id='$id'");
        $result = $this->persist();

        while($entity = $this->fetch($result)){
            return $entity[$col];
        }
    }
    public function getId(){
        return mysql_insert_id();
    }

    public function rows($entities){
        return mysql_num_rows($entities);
    }
}