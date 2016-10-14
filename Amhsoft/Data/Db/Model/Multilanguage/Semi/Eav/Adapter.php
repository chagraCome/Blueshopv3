<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Adapter.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package Data
 * @copyright  2005-2013 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
abstract class Amhsoft_Data_Db_Model_Multilanguage_Semi_Eav_Adapter extends Amhsoft_Data_Db_Model_Semi_Eav_Adapter {

  protected $langTable;
  protected $joinColumn;
  public $mapLang = array();
  protected $defaultLang = 'AR';
  protected $langTableConf;
  protected $langJoinColConf;
  public $mapLangConf = array();

  /**
   * Construct.
   */
  public function __construct() {
    parent::__construct();
    $this->defaultLang = Amhsoft_System::getCurrentLang();

    $this->langTable = $this->getLanguageTableName();
    $this->mapLang = $this->getLangMap();
    $this->joinColumn = $this->getJoinColumn();



    $this->langTableConf = $this->getConfigLanguageTableName();
    $this->mapLangConf = $this->getConfigLangMap();
    $this->langJoinColConf = $this->getLangJoinColumnConf();


    if ($this->langTable == null) {
      throw new Exception('Missing Language Table');
    }
    if ($this->joinColumn == null) {
      throw new Exception('Missing Join Column');
    }
    if (count($this->mapLang) == 0) {
      //throw new Exception('Missing Map Language');
    }


    if ($this->langJoinColConf == null) {
      throw new Exception('Missing Language config Table');
    }
    if ($this->langJoinColConf == null) {
      throw new Exception('Missing conf Join Column');
    }
    if (count($this->mapLangConf) == 0) {
      //throw new Exception('Missing config Map Language');
    }

    $this->setCurrentLang($this->defaultLang);
    $this->expandMapping();
  }

  protected function expandMapping() {
    $adapter = new Eav_Attribute_Model_Adapter();
    $adapter->where('entity_id = ?', $this->getUid());
    $result = $adapter->fetch();
    while ($attribute = $result->fetch()) {
      if ($attribute->isString()) {
        $this->appendMapConfigLang($attribute->getName());
      } else {
        $this->appendConfigMap($attribute->getName());
      }
    }
    
  }

  public function getConfigLanguageTableName() {
    return str_replace('`', '', $this->getConfigTable()) . '_lang';
  }

  public function getConfigLangMap() {
    return array();
  }

  public function getLangJoinColumnConf() {
    return str_replace('`', '', $this->getTable()) . '_id';
  }

  /**
   * Sets current Language
   * @param string $lang
   */
  public function setCurrentLang($lang) {

    $this->defaultLang = $lang;
    for ($i = 0; $i < count($this->whereClause); $i++) {
      if (preg_match("/$this->langTable.`lang` = /i", $this->whereClause[$i])) {
        unset($this->whereClause[$i]);
        break;
      }
    }

    for ($i = 0; $i < count($this->whereClause); $i++) {
      if (preg_match("/$this->langTableConf.`lang` = /i", $this->whereClause[$i])) {
        unset($this->whereClause[$i]);
      }
    }



    $this->where($this->langTable . '.`lang` = ?', $this->defaultLang, PDO::PARAM_STR);
    $this->where($this->langTableConf . '.`lang` = ?', $this->defaultLang, PDO::PARAM_STR);
  }

  public function qualify($column) {
    if (isset($this->map[$column])) {
      return $this->table . '.' . $column;
    }
    if (isset($this->mapLang[$column])) {
      return $this->langTable . '.' . $column;
    }
    if (isset($this->mapConfig[$column])) {
      return $this->configTable . '.' . $column;
    }
    if (isset($this->mapLangConf[$column])) {
      return $this->langTableConf . '.' . $column;
    }
    return $column;
  }

  public function removeLangVirtualzation() {

    foreach ($this->_whereClause as $key => $val) {
      if (preg_match("/$this->langTable.`lang` = /i", $key)) {
        unset($this->_whereClause[$key]);
        break;
      }
    }

    foreach ($this->_whereClause as $key => $val) {
      if (preg_match("/$this->langTableConf.`lang` = /i", $key)) {
        unset($this->_whereClause[$key]);
        break;
      }
    }
  }

  public function appendMapLang($name, $columnname = null) {
    if ($columnname == null) {
      $columnname = $name;
    }
    $this->mapLang[$name] = $columnname;
  }

  public function appendMapConfigLang($name, $columnname = null) {
    if ($columnname == null) {
      $columnname = $name;
    }
    $this->mapLangConf[$columnname] = $columnname;
    
  }

  public function hasColumn($column_name) {
    $columns = array_merge($this->map, $this->mapLang, $this->mapLangConf, $this->mapConfig);
    if (in_array($column_name, $columns)) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * build select statement.
   * @override
   * @see BusinessOrm::getSelectStatement()
   */
  public function getSelectStatement() {
    foreach ($this->mapLang as $key => $val) {
      $this->select($this->langTable . '.`' . $key . '`', $val);
    }

    foreach ($this->mapLangConf as $key => $val) {
      $this->select($this->langTableConf . '.`' . $key . '`', $val);
    }


   
    
    $sql =  parent::getSelectStatement() .' JOIN ' . $this->langTable . ' ON ' . $this->table . '.id = ' . $this->langTable . '.' . $this->joinColumn .
            ' JOIN ' . $this->langTableConf . ' ON ' . $this->table . '.id = ' . $this->langTableConf . '.' . $this->langJoinColConf; 
    
  
    return $sql;
  }
  
  public function getJoinStatement(){
   return  parent::_getJoinStatement().
            ' JOIN ' . $this->langTable . ' ON ' . $this->table . '.id = ' . $this->langTable . '.' . $this->joinColumn .
            ' JOIN ' . $this->langTableConf . ' ON ' . $this->table . '.id = ' . $this->langTableConf . '.' . $this->langJoinColConf; 
  }

  /**
   * Insert into tables
   * @see BusinessOrm::_insert()
   */
  protected function _insert($object) {
    $inTransaction = false;
    try {
      $this->dbAdapter->beginTransaction();
    } catch (Exception $inTransationExp) {
      $inTransaction = true;
    }
    try {
      parent::_insert($object);

      if ($this->id == null) {
        return;
      }
      //lang
      if (Amhsoft_System::getVirtualization() == false) {
        foreach (Amhsoft_System::getAvailableLang() as $l => $dl) {
          $this->setCurrentLang($dl);
          $this->_insert_into_table_lang($object);
          $this->_insert_into_table_lang_conf($object);
        }
      } else {
        $this->_insert_into_table_lang($object);
        $this->_insert_into_table_lang_conf($object);
      }
      if ($inTransaction == false) {
        $this->dbAdapter->commit();
      }
    } catch (Exception $e) {
      if ($inTransaction == false) {
        $this->dbAdapter->rollBack();
      }
      $object->id = null;
      throw $e;
    }
  }

  protected function _insert_into_table_lang_conf($object) {
    $this->dbAdapter->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $this->getInsertIntoTableLangConfSQL();
    $statement = $this->dbAdapter->prepare($sql);
    $statement->bindParam(':joinColumn', $object->id, PDO::PARAM_INT);
    $statement->bindParam(':lang', $this->defaultLang, PDO::PARAM_STR);

    $attrs = array_keys($this->mapLangConf);
    foreach ($attrs as $key => $attributName) {
     
        $statement->bindValue(':' . $attributName, $object->{$attributName}, PDO::PARAM_STR);
     
      
    }


    $statement->execute();
    $this->id = $this->dbAdapter->lastInsertId();
  }

  /**
   * Build sql for insert into table lange
   * @return string
   */
  protected function getInsertIntoTableLangSQL() {

    $this->dbAdapter->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $attrs = array_keys($this->mapLang);
    $dbs = array_values($this->mapLang);
    if(empty($attrs)){
     return "INSERT INTO " . $this->langTable . "(`" . $this->joinColumn . '`, `lang`) VALUES(:joinColumn, :lang) ';
    }
    
    $sql = "INSERT INTO " . $this->langTable . "(`" . $this->joinColumn . '`, `lang`, ';
    
    $sql .= implode(',', $attrs) . ') VALUES (:joinColumn, :lang , :';
    $sql .= implode(',:', $attrs) . ')';
    return $sql;
  }

  /**
   * Build sql for insert into table lange
   * @return string
   */
  protected function getInsertIntoTableLangConfSQL() {
    $this->dbAdapter->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $attrs = array_keys($this->mapLangConf);
    if(empty($attrs)){
      return "INSERT INTO " . $this->langTableConf . "(" . $this->langJoinColConf . ', lang) VALUES (:joinColumn, :lang)';
    }
    $sql = "INSERT INTO " . $this->langTableConf . "(" . $this->langJoinColConf . ', lang  ';
    $sql .= ', `' . implode('` ,`', $attrs) . '`) VALUES (:joinColumn, :lang, :';
    $sql .= implode(',:', $attrs) . ')';
    return $sql;
  }

  /**
   * insert into table lang
   * @param IObjectModel $object
   */
  protected function _insert_into_table_lang($object) {
    $this->dbAdapter->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $this->getInsertIntoTableLangSQL();
    $statement = $this->dbAdapter->prepare($sql);
    $statement->bindParam(':joinColumn', $object->id, PDO::PARAM_INT);
    $statement->bindParam(':lang', $this->defaultLang, PDO::PARAM_STR);

    $attrs = array_keys($this->mapLang);

    foreach ($attrs as $key => $attributName) {
      $statement->bindParam(':' . $attributName, $object->{$attributName}, PDO::PARAM_STR);
    }

    $statement->execute();
    $this->id = $this->dbAdapter->lastInsertId();
  }

  /**
   * Check if table lang has row.
   * @param IObjectModel $object
   * @return bool $rowExist.
   */
  protected function langRowExists(&$object) {
    $sql = "SELECT COUNT(*) as c FROM $this->langTable WHERE lang = '$this->defaultLang' AND $this->joinColumn = $object->id";
    $stmt = $this->dbAdapter->prepare($sql);
    $stmt->execute();
    $erg = $stmt->fetch();
    return (intval($erg['c']) > 0);
  }

  /**
   * Check if table lang has row.
   * @param IObjectModel $object
   * @return bool $rowExist.
   */
  protected function langConfRowExists(&$object) {
    $sql = "SELECT COUNT(*) as c FROM $this->langTableConf WHERE lang = '$this->defaultLang' AND $this->langJoinColConf = $object->id";
    $stmt = $this->dbAdapter->prepare($sql);
    $stmt->execute();
    $erg = $stmt->fetch();
    return (intval($erg['c']) > 0);
  }

  /**
   * update table lang
   * @param IObjectModel $object
   */
  protected function _update_table_lang($object) {
    $this->dbAdapter->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE " . $this->langTable . " SET ";
    $attrDb = array();

    foreach ($this->mapLang as $attr => $dbname) {
      $attrDb[] = $dbname . ' = :' . $attr;
    }
    
    if(empty($attrDb)){
      return;
    }
    
    $sql .= implode(',', $attrDb);

    $sql .= " WHERE $this->joinColumn = $object->id AND lang = '$this->defaultLang'";


    $statement = $this->dbAdapter->prepare($sql);
    foreach ($this->mapLang as $attributName => $dbName) {
      $statement->bindParam(':' . $attributName, $object->{$attributName}, PDO::PARAM_STR);
    }


    $statement->execute();
  }

  /**
   * update table lang
   * @param IObjectModel $object
   */
  protected function _update_table_lang_conf($object) {
    if(empty($this->mapLangConf)){
      return;
    }
    
    $this->dbAdapter->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE " . $this->langTableConf . " SET ";
    $attrDb = array();



    foreach ($this->mapLangConf as $attr => $dbname) {
      $attrDb[] = $dbname . ' = :' . $attr;
    }
    $sql .= implode(',', $attrDb);

    $sql .= " WHERE $this->langJoinColConf = $object->id AND lang = '$this->defaultLang'";


    $statement = $this->dbAdapter->prepare($sql);
    foreach ($this->mapLangConf as $attributName => $dbName) {
      $statement->bindParam(':' . $attributName, $object->{$attributName}, PDO::PARAM_STR);
    }


    $statement->execute();
  }

  /**
   * update tables.
   * @param Amhsoft_Data_Db_Model_Interface $object
   */
  public function update(Amhsoft_Data_Db_Model_Interface $object, $cascade = false) {
    $e = parent::update($object);

    if (!$this->langRowExists($object)) {
      $this->_insert_into_table_lang($object);
    } else {
      $this->_update_table_lang($object);
    }

    if (!$this->langConfRowExists($object)) {
      $this->_insert_into_table_lang_conf($object);
    } else {
      $this->_update_table_lang_conf($object);
    }

    return $e;
  }

  public function isTranslated($id, $lang) {
    $sql = "SELECT 1 FROM $this->langTable WHERE  $this->joinColumn = $id AND lang = '$lang' ";
    return $this->dbAdapter->query($sql)->rowCount() > 0;
  }

  public function isConfTranslated($id, $lang) {
    $sql = "SELECT 1 FROM $this->langTableConf WHERE  $this->langJoinColConf = $id AND lang = '$lang' ";
    return $this->dbAdapter->query($sql)->rowCount() > 0;
  }

  /**
   * Delete Enitity by given id.
   * @example $entityAdapter->deleteById($id);
   * @param int $id
   * @return <type>
   */
  public function deleteById($id) {

    global $virtualization, $available_lang;
    if ($virtualization == false) {

      $this->dbAdapter
              ->exec("DELETE FROM $this->table WHERE id = " . $id);
      $this->dbAdapter
              ->exec("DELETE FROM $this->configTable WHERE $this->configJoinColumn = " . $id);

      foreach ((array) $available_lang as $l => $dl) {
        $this->dbAdapter
                ->exec("DELETE FROM $this->langTable WHERE $this->joinColumn = " . $id . " AND lang = '$dl'");
        $this->dbAdapter
                ->exec("DELETE FROM $this->langTableConf WHERE $this->langJoinColConf = " . $id . " AND lang = '$dl'");
      }
    } else {

      $this->dbAdapter
              ->exec("DELETE FROM $this->table WHERE id = " . $id);

      $this->dbAdapter
              ->exec("DELETE FROM $this->configTable WHERE $this->configJoinColumn = " . $id);

      $this->dbAdapter
              ->exec("DELETE FROM $this->langTable WHERE $this->joinColumn = " . $id . " AND lang = '$this->defaultLang'");
      $this->dbAdapter
              ->exec("DELETE FROM $this->langTableConf WHERE $this->langJoinColConf = " . $id . " AND lang = '$this->defaultLang'");
    }
  }

  /**
   * @return string $_language_table_name
   */
  abstract function getLanguageTableName();

  /**
   * @return array $langMap
   */
  abstract function getLangMap();

  /**
   * @return string $join_column
   */
  abstract function getJoinColumn();
}
