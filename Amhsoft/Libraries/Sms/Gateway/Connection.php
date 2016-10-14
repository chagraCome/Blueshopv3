<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Connection.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    Core
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Connection extends PDO {

    var $hostname = null;
    var $database = null;
    var $usename = null;
    var $password = null;
    var $port;
    var $Connected = FALSE;
    var $id = null;
    var $sql = null;
    var $querys = null;
    var $c = 0;
    var $data;
    var $dataType;
    var $dataValue;

    function __construct() {

        $systemConfig = Amhsoft_System_Config::getInstance();


        $this->setHostname($systemConfig->getProperty('host'));

        $this->setPort($systemConfig->getProperty('port'));

        $this->setUsename($systemConfig->getProperty('user'));
        $this->setPassword($systemConfig->getProperty('pass'));

        $this->setDatabase($systemConfig->getProperty('database'));

        if ($this->Connected == FALSE) {
            $this->connect();
            $this->Connected = TRUE;
        }
    }

    function getInstance() {
        static $obj = null;
        if ($obj === null) {
            $obj = new Amhsoft_Connection();
        }
        return $obj;
    }

    function setHostname($hostname) {
        $this->hostname = $hostname;
    }

    function setDatabase($database) {
        $this->database = $database;
    }

    function setUsename($usename) {
        $this->usename = $usename;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setPort($port) {
        $this->port = $port;
    }

    function connect() {
        if (empty($this->hostname))
            return;

        if (empty($this->database))
            return;

        $host = ($this->port == "") ? $this->hostname : $this->hostname . ":" . $this->port;

        $this->id = @mysql_connect($host, $this->usename, $this->password);
        if ($this->id === FALSE)
            throw new AmhshopException('Cannot connect to database.', -1, false);

        $this->Connected = TRUE;
        if ($this->database != "")
            $this->selectDatabase();
        return true;
    }

    function selectDatabase() {
        if ($this->Connected == FALSE)
            die('MySQL Error: Connection failed.');
        @mysql_query("set names utf8", $this->id);
        @mysql_query("set character utf8", $this->id);
        @mysql_query("set COLLATE utf8_unicode_ci", $this->id);

        if (@mysql_select_db($this->database, $this->id) === FALSE) {
            $this->Connected = FALSE;
            $this->error();
        }
    }

    /**
     * @access private
     * @return bool
     */
    function begin() {

        @mysql_query("START TRANSACTION", $this->id);
        return @mysql_query("BEGIN", $this->id);
    }

    /**
     * @access private
     * @return bool
     */
    function commit() {
        $erg = @mysql_query("COMMIT", $this->id);

        return $erg;
    }

    /**
     * @access private
     * @return bool
     */
    function rollback() {
        return @mysql_query("ROLLBACK", $this->id);
    }

    /**
     * @access 
     * @param array $_query
     * @return bool
     *   return $this->Amhsoft_Connection->transaction($_query);
     */
    function transaction($_query, $restrict_affected_rows = true) {

        if ($this->Connected == FALSE)
            die('MySQL Error: Connection failed.');

        $retval = 1;

        $this->begin();

        foreach ($_query as $qa) {
            $result = mysql_query($qa, $this->id);
            if ($restrict_affected_rows == true) {
                if (@mysql_affected_rows() == 0) {
                    $retval = 0;
                }
            } else {
                if (@mysql_errno($this->id) > 0) {
                    $retval = 0;
                }
            }
        }

        if ($retval == 0) {
            $this->rollback();
            return false;
        } else {
            $this->commit();
            return true;
        }
    }

    /**
     * @access 
     * @param $query
     * @return integer
     */
    function exec($query = null) {


        if ($this->Connected == FALSE)
            die('MySQL Error: Connection failed.');


        if ($query)
            $this->sql = $query;

        if (!@mysql_query($query, $this->id)) {
            echo mysql_error($this->id);
            exit;

            $this->Connected = FALSE;
            $this->error();
            return 0;
        }
        return @mysql_affected_rows();
    }

    function execute($query = null) {

        //writeToFile("sql.txt", $query."\n");

        if ($this->Connected == FALSE)
            die('MySQL Error: Connection failed.');


        if ($query)
            $this->sql = $query;

        if (!@mysql_query($query, $this->id)) {

            $this->Connected = FALSE;
            $this->error();

            return false;
        }
        return @mysql_insert_id($this->id);
    }

    function prepeare($query, $array) {
        $this->sql = $query;
        unset($this->data);
        $this->data = $array;


        $this->c = 0;
        //$sql = preg_replace_callback("/((('[^']*')|(\"[^\"]*\")|[^?])+)(\?)/", array(&$this, 'bind'), $query);
        $sql = preg_replace_callback("/((('[^']*')|(\"[^\"]*\")|[^?])+)(\?)/", array(&$this, 'bind'), $query);
        $this->sql = $sql;
    }

    function bind($matches) {
        $this->c++;
        return $matches[1] . "'" . $this->data[$this->c - 1] . "'";
    }

    function selectInObj($query, &$obj) {
        if ($this->Connected == FALSE)
            die('MySQL Error: Connection failed.');

        $result = @mysql_query($query, $this->id);
        if (mysql_error()) {
            $this->error();
        }
        if ($result) {
            $i = 0;
            while ($rows = @mysql_fetch_object($result)) {
                // Store relults as an objects within main array
                $obj[$i] = $rows;
                $i++;
            }
            @mysql_free_result($result);
            if ($i)
                return true;
            else
                return false;
        }
    }

    function selectInArray($query, &$array) {
        if ($this->Connected == FALSE)
            die('MySQL Error: Connection failed.');

        if ($query)
            $this->sql = $query;

        $result = @mysql_query($this->sql, $this->id);
        if (mysql_error()) {
            $this->error();
        }
        if ($result) {
            $i = 0;
            while ($rows = @mysql_fetch_assoc($result)) {
                // Store relults as an objects within main array
                $array[$i] = $rows;
                $i++;
            }
            @mysql_free_result($result);
            if ($i)
                return $i;
            else
                return false;
        }
    }

    function select4options($query, $with_null = false) {
        if ($this->Connected == FALSE)
            die('MySQL Error: Connection failed.');

        if ($query)
            $this->sql = $query;

        $result = @mysql_query($this->sql, $this->id);
        if (mysql_error()) {
            $this->error();
        }
        if ($result) {
            $res = array();

            if ($with_null == true)
                $res[0] = "";

            while (list($key, $val) = @mysql_fetch_row($result)) {
                $res[$key] = $val;
            }
            @mysql_free_result($result);
            return $res;
        }
    }

    function query($query = null) {

        if ($this->Connected == FALSE)
            die('MySQL Error: Connection failed.');

        if ($query)
            $this->sql = $query;
        return @mysql_query($query, $this->id);
    }

    function selectOne($query) {
        if ($this->Connected == FALSE)
            die('MySQL Error: Connection failed.');

        if ($query)
            $this->sql = $query;

        $result = @mysql_query($this->sql, $this->id);


        if (mysql_error()) {
            $this->error();
        }
        if ($result) {
            $rows = @mysql_fetch_row($result);

            @mysql_free_result($result);

            return $rows[0];
        }
        return null;
    }

    function selectOneRow($query) {
        if ($this->Connected == FALSE)
            die('MySQL Error: Connection failed.');

        if ($query)
            $this->sql = $query;

        $result = @mysql_query($this->sql, $this->id);


        if (mysql_error()) {
            $this->error();
        }
        if ($result) {
            $rows = @mysql_fetch_assoc($result);
            @mysql_free_result($result);

            return $rows;
        }
        return null;
    }

    function selectOneObj($query) {
        if ($this->Connected == FALSE)
            die('MySQL Error: Connection failed.');

        if ($query)
            $this->sql = $query;

        $result = @mysql_query($this->sql, $this->id);


        if (mysql_error()) {
            $this->error();
        }
        if ($result) {
            $obj = null;
            $obj = @mysql_fetch_object($result);
            @mysql_free_result($result);

            return $obj;
        }
        return null;
    }

    function getColInfo($query, &$obj) {
        if ($this->Connected == FALSE)
            die('MySQL Error: Connection failed.');

        $result = @mysql_query($query, $this->id);
        if (mysql_error()) {
            $this->error();
        }
        if ($result) {
            $i = 0;
            while ($i < @mysql_num_fields($result)) {
                $obj[$i] = @mysql_fetch_field($result);
                $i++;
            }
            @mysql_free_result($result);
        }
    }

    function getCount($query = null) {
        if ($query)
            $this->sql = $query;
        $result = @mysql_query($this->sql, $this->id);
        return @mysql_num_rows($result);
    }

    function is_sql_safe($query) {
        $search = array("--", ";", "insert", "dump", "select", "update", "delete", "xp_", '"', "'");
        foreach ($search as $s) {
            if (ereg("/$s/i", $query))
                return false;
        }
        return true;
    }

    function close() {

        if ($this->Connected == TRUE)
            @mysql_close($this->id) or $this->error(__LINE__, @mysql_error($this->id), @mysql_errno($this->$id));
    }

    function error() {
        if ($this->id) {
            $error = "<li>Error: " . @mysql_error($this->id) . "</li>";
            $error_number = " <li>Error Number:" . @mysql_errno($this->id) . "</li>";
        } else {
            $error = "<li>" . @mysql_error() . "</li>";
            $error_number = "<li>" . @mysql_errno() . __FILE__ . "</li>";
        }
        if (!empty($this->sql))
            $sql = "<li>SQL: " . $this->sql . "</li>";
        else
            $sql = "";
        die("MySQL <ul>$error$error_number$sql</ul>");
    }

    function asXmlString($query) {
        if ($this->Connected == FALSE)
            die('MySQL Error: Connection failed.');

        if ($query)
            $this->sql = $query;

        $result = @mysql_query($this->sql, $this->id);
        if (mysql_error()) {
            $this->error();
        }
        if ($result) {
            $i = 0;
            // create a new XML document
            $doc = new DomDocument('1.0');
            // create root node
            $root = $doc->createElement('root');
            $root = $doc->appendChild($root);

            while ($row = @mysql_fetch_assoc($result)) {
                // add node for each row
                $occ = $doc->createElement('table');
                $occ = $root->appendChild($occ);
                // add a child node for each field
                foreach ($row as $fieldname => $fieldvalue) {
                    $child = $doc->createElement($fieldname);
                    $child = $occ->appendChild($child);
                    if (preg_match("/desc/i", $fieldname)) {
                        $value = $doc->createTextNode('<![CDATA[' . $fieldvalue . ']]>');
                    } else {
                        $value = $doc->createTextNode($fieldvalue);
                    }

                    $value = $child->appendChild($value);
                } // foreach
            } // while

            $doc->encoding = "utf-8";
            return $doc->saveXML();
        }
    }

    function asJsonString($query) {
        if ($this->Connected == FALSE)
            die("MySQL Error: Connection faild");

        if ($query)
            $this->sql = $query;

        $result = @mysql_query($this->sql, $this->id);
        if (mysql_error()) {
            $this->error();
        }
        if (!$result) {
            return;
        }
        $data = array();
        while ($row = @mysql_fetch_assoc($result)) {
            $data[] = $row;
        }
        return json_encode($data);
    }

}
