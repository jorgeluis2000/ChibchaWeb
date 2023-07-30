<?php
if (!defined("CONN_ERROR")) define("CONN_ERROR", "Error connecting DB");
if (!defined("NO_DATA")) define("NO_DATA", 0);
if (!defined("BAD_QUERY")) define("BAD_QUERY", 1);
if (!defined("INSERT_OK")) define("INSERT_OK", 2);
if (!defined("DELETE_OK")) define("DELETE_OK", 3);
if (!defined("UPDATE_OK")) define("UPDATE_OK", 4);
if (!defined("QUERY_OK")) define("QUERY_OK", 5);
if (!defined("SELECT_QUERY")) define("SELECT_QUERY", 1);
if (!defined("INSERT_QUERY")) define("INSERT_QUERY", 2);
if (!defined("DELETE_QUERY")) define("DELETE_QUERY", 3);
if (!defined("UPDATE_QUERY")) define("UPDATE_QUERY", 4);

// define("CONN_ERROR","Error connecting DB");
// define("NO_DATA",0);
// define("BAD_QUERY",1);
// define("INSERT_OK",2);
// define("DELETE_OK",3);
// define("UPDATE_OK",4);
// define("QUERY_OK",5);
// define("SELECT_QUERY",1);
// define("INSERT_QUERY",2);
// define("DELETE_QUERY",3);
// define("UPDATE_QUERY",4);

class Database
{
    var $conn;
    var $user;
    var	$pwd;
    var $db;
    var $results;
    var $rows;
    var $messages;
    var $path;
    var $host;
    
    function Database()
    {
        $this->conn = null;
        $this->results = null;
        $this->db = "chibchaweb";
        $this->user = "root";
        $this->pwd = "123456";
        $this->host = "localhost";
        $this->path = "http://localhost/ChibchaWeb";
        $this->rows = 0;
        $this->messages = array("Error en la conexi&oacute;n","No se pudo realizar la operaci&oacute;n, comun&iacute;quese con el administrador");
        $this->connect();
    }
    
    function connect()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pwd, $this->db);
       
        if (!$this->conn)
        {
            die($this->messages[CONN_ERROR]);
            return false;
        }
        return $this->conn;
    }

    function doQuery($query,$type)
    {
        $this->results=null;
        
        if (!$execute = $this->conn->query($query))
        {
            die('Invalid query: '.utf8_encode($query).'-'. $this->conn->error);
            return null;
        }
        else
        {
            switch($type)
            {
                case SELECT_QUERY:
                    $this->rows = $execute->num_rows;
                 
                    $i = 0;
                    while ($i < $this->rows)
                    {
                        $this->results[$i] = $execute->fetch_assoc();
                        $i++;
                    }
                    return true;
                    break;
                case INSERT_QUERY:
                    return true;
                    break;
                case UPDATE_QUERY:
                    return true;
                    break;
                case DELETE_QUERY:
                    return true;
                    break;
            }
        }
    }
    
    function doQueryPaginator($execute){
        $this->results = null;
        mysql_query("SET NAMES utf8");
        if($execute)
        {
            $this->rows = mysql_num_rows($execute);
            
            $i = 0;
            while ($i < $this->rows)
            {
                $this->results[$i] = mysql_fetch_assoc($execute);
                $i++;
            }
        }
    }
    
    function getNumResults()
    {
        return $this->rows;
    }

    function getResults()
    {
        return $this->results;
    }
    
    function getLastId()
    {
        return mysql_insert_id($this->conn);
    }
    
    function disconnect()
    {
        if($this->conn)
            $this->conn->close();
    } 
}
?>