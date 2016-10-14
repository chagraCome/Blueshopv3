<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Source.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Revision: 102 $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedBy: a.cherif $
 * @package    defaultPackage
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    <unknown>
 */

/**
 * Data Source class
 * @author Amir Cherif
 */
class Amhsoft_Data_Source {

  /**
   * @param string $tableName
   * @param string $index
   * @param string $value
   * @param string $sqlExpression
   * @return DataSet|array
   * @static
   */
  public static function Table($tableName, $index = 'id', $value = 'name', $sqlExpression = null) {
    $statement = Amhsoft_Database::getInstance()->prepare("SELECT * FROM `$tableName` " . $sqlExpression);
    $statement->execute();
    if ($statement instanceof PDOStatement) {
      return new Amhsoft_Data_Set($statement->fetchAll(PDO::FETCH_ASSOC));
      //return new PDODataSet($statement);
    } else {
      return array();
    }
  }

  /**
   * @param string $sql SQL query string
   * @return DataSet|array
   */
  public static function SQL($sql) {
    $statement = Amhsoft_Database::getInstance()->prepare($sql);
    $statement->execute();
    if ($statement instanceof PDOStatement) {
      return new Amhsoft_Data_Set($statement->fetchAll(PDO::FETCH_ASSOC));
    } else {
      return array();
    }
  }

  /**
   * Sets POST as datasource
   * @return array
   */
  public static function Post() {
    array_walk_recursive($_POST, 'Amhsoft_Data_Source::sepecialchars');
    return $_POST;
  }

  /**
   * Sets Get as datasource
   * @return array
   */
  public static function Get() {
    return $_GET;
  }

  public static function sepecialchars($val) {
    return htmlspecialchars($val, ENT_QUOTES | ENT_NOQUOTES, "UTF-8");
  }

}
