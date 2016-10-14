<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Database.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    Amhsoft
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Database extends PDO {

    /** @var PDO $instance */
    private static $instance = null;
    private static $dns;

    public static function setConfig(Amhsoft_Config_Abstract $conf) {
        self::$dns = $conf;
    }

    public function exec($statement) {
        parent::exec($statement);
        Amhsoft_View::getInstance()->clearAllCache();
    }

    public function query($statement) {
        parent::query($statement);
        Amhsoft_View::getInstance()->clearAllCache();
    }

    /**
     *
     * @return Amhsoft_Database $instance.
     */
    public static function getInstance() {
        if (self::$instance === null) {
            try {
                self::$instance = new DebugBar\DataCollector\PDO\TraceablePDO(new PDO("mysql:host=" . self::$dns->host . ";port=" . self::$dns->port . ";dbname=" . self::$dns->database, self::$dns->user, self::$dns->pass));
                self::$instance->query("SET NAMES 'UTF8'");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $debugger = Amhsoft_Debugger::getInstance();
                $debugger->addCollector(new DebugBar\DataCollector\PDO\PDOCollector(self::$instance));
            } catch (Exception $e) {
                die('<b style="color:red">' . $e->getMessage() . '</b>');
            }
        }
        return self::$instance;
    }

    public static function newInstance() {

        try {
            //self::$instance = new PDO("mysql:host=".config::DB_HOST.";port=".config::DB_PORT.";dbname=".config::DB_NAME.";charset=".config::DB_CHARSET, config::DB_USER, config::DB_PASS);
            $instance = new PDO("mysql:host=" . self::$dns->host . ";port=" . self::$dns->port . ";dbname=" . self::$dns->database, self::$dns->user, self::$dns->pass);
            $instance->query("SET NAMES 'UTF8'");
            $instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die('<b style="color:red">' . $e->getMessage() . '</b>');
        }

        return $instance;
    }

    public static function querySingle($sql) {
        $stmt = self::getInstance()->query($sql);
        return $stmt->fetchColumn();
    }

    public static function setOffset($offset) {
        $sql = "SET time_zone='$offset';";
        self::getInstance()->exec($sql);
    }

    public static function close() {
        self::$instance = null;
    }

    public static function getTableCreateSql($sTable) {
        $sTable = explode('?', $sTable);
        $sTable = $sTable[0];
        $sQuery = "SHOW CREATE TABLE $sTable";

        $sResult2 = Amhsoft_Database::newInstance()->query($sQuery);

        $aTableInfo = $sResult2->fetch(PDO::FETCH_ASSOC);

        $sData = "\n\n--
-- Tabel structure of `$sTable`
--\n\n";
        if (isset($aTableInfo['View'])) {
            $createView_string = $aTableInfo['Create View'] . ";\n";
            $clean = 'CREATE VIEW IF NOT EXISTS ' . substr($createView_string, strpos($createView_string, 'DEFINER VIEW') + 13);

            $sData .= $clean;
        } else {
            $sData .= str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $aTableInfo['Create Table']) . ";\n";
        }
        return $sData;
    }

    public static function getTableData($table, $truncate = true) {
        $table = explode("?", $table);
        $sTable = $table[0];
        $table_query = null;
        if (isset($table[1])) {
            $table_query = $sTable . ' ' . $table[1];
        }
        $sResult2 = Amhsoft_Database::newInstance()->query("SHOW CREATE TABLE $sTable");
        $aTableInfo = $sResult2->fetch(PDO::FETCH_ASSOC);

        if (isset($aTableInfo['View'])) {
            return null;
        }
        $sData = "-- Table $sTable data\n";

        $sResult3 = Amhsoft_Database::newInstance()->query("SELECT $sTable.* FROM $sTable $table_query");
        $sData .= "SET FOREIGN_KEY_CHECKS=0;";
        if ($truncate == true) {
            $sData .= "TRUNCATE TABLE `$sTable`;";
        }
        while ($aRecord = $sResult3->fetch(PDO::FETCH_ASSOC)) {



            $values = "";
            $fields = "";
            foreach ($aRecord as $sField => $sValue) {
                $values .= Amhsoft_Database::newInstance()->quote($sValue) . ",";
                $fields .= "`$sField`,";
            }
            $sValues = substr($values, 0, -1);
            $sFields = substr($fields, 0, -1);
            $sData .= "INSERT IGNORE INTO `$sTable` ($sFields) VALUES (" . $sValues . ");\n";
        }
        $sData .= "SET FOREIGN_KEY_CHECKS=1;";


        return $sData;
    }

    public static function dumpDataBase($onlyData = false, $transaction = true) {
        $data = "-- PDO SQL Dump --\nDatabase: " . self::$dns->database . "\n\n-- --------------------------------------------------------\n";

        if ($transaction == true) {
            $data .= "SET FOREIGN_KEY_CHECKS=0;\nSET SQL_MODE=\"NO_AUTO_VALUE_ON_ZERO\";\nSET AUTOCOMMIT=0;\nSTART TRANSACTION;\nSET time_zone = \"+00:00\";";
        }


        $sQuery = "SHOW tables FROM " . self::$dns->database;
        $sResult = Amhsoft_Database::newInstance()->query($sQuery);


        while ($aTable = $sResult->fetch(PDO::FETCH_ASSOC)) {
            $tableName = $aTable['Tables_in_' . self::$dns->database];
            if ($onlyData == false) {
                $data .= self::getTableCreateSql($tableName);
            }

            $data .= self::getTableData($tableName);
        }
        if ($transaction == true) {
            $data .= "SET FOREIGN_KEY_CHECKS=1;\nCOMMIT;";
        }


        return $data;
    }

    public static function getTables() {
        $instance = Amhsoft_Database::newInstance();
        $array = array();
        $sQuery = "SHOW tables FROM " . self::$dns->database;
        $sResult = $instance->query($sQuery);

        while ($aTable = $sResult->fetch(PDO::FETCH_ASSOC)) {
            $tableName = $aTable['Tables_in_' . self::$dns->database];

            $sResult2 = $instance->query("SHOW CREATE TABLE $tableName");
            $aTableInfo = $sResult2->fetch(PDO::FETCH_ASSOC);

            if (!isset($aTableInfo['View'])) {
                $array[] = $tableName;
            }
        }
        return $array;
    }

}
