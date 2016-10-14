<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
abstract class Amhsoft_Data_Db_Model_Multilanguage_Adapter extends Amhsoft_Data_Db_Model_Adapter {

  protected $langTable;
  protected $joinColumn;
  public $mapLang = array();
  protected $defaultLang = 'AR';

  /**
   * Construct.
   */
  public function __construct() {
    parent::__construct();
    $this->defaultLang = Amhsoft_System::getCurrentLang();

    $this->langTable = $this->getLanguageTableName();
    //$this->mapLang = array_merge($this->mapLang,  $this->getLangMap());
    $this->mapLang = $this->getLangMap();
    $this->joinColumn = $this->getJoinColumn();
    if ($this->langTable == null) {
      throw new Exception('Missing Language Table');
    }
    if ($this->joinColumn == null) {
      throw new Exception('Missing Join Column');
    }
    if (count($this->mapLang) == 0) {
      throw new Exception('Missing Map Language');
    }



    $this->setCurrentLang($this->defaultLang);

    //$this->where('`lang` = ?', $this->defaultLang, PDO::PARAM_STR);
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

    $this->where($this->langTable . '.`lang` = ?', $this->defaultLang, PDO::PARAM_STR);
  }

  public function qualify($column) {
    return isset($this->map[$column]) ? $this->table . '.' . $column : $this->langTable . '.' . $column;
  }

  public function removeLangVirtualzation() {

    foreach ($this->_whereClause as $key => $val) {
      if (preg_match("/$this->langTable.`lang` = /i", $key)) {
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

  public function hasColumn($column_name) {
    $columns = array_merge($this->map, $this->mapLang);
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
  protected function getSelectStatement() {
    foreach ($this->mapLang as $key => $val) {
      $this->select($this->langTable . '.`' . $key . '`', $val);
    }
    foreach ($this->map as $key => $val) {
      $this->select($this->table . '.`' . $key . '`', $val);
    }
    return parent::getSelectStatement() . ' LEFT JOIN ' . $this->langTable . ' ON ' . $this->table . '.id = ' . $this->joinColumn;
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
        }
      } else {
        $this->_insert_into_table_lang($object);
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

  /**
   * Build sql for insert into table lange
   * @return string
   */
  protected function getInsertIntoTableLangSQL() {

    $this->dbAdapter->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO " . $this->langTable . "(" . $this->joinColumn . ', lang, ';
    $attrs = array_keys($this->mapLang);
    $dbs = array_values($this->mapLang);
    $sql .= implode(',', $attrs) . ') VALUES (:joinColumn, :lang, :';
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
   * update table lang
   * @param IObjectModel $object
   */
  protected function _update_table_lang(&$object) {
    $this->dbAdapter->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE " . $this->langTable . " SET ";
    $attrDb = array();



    foreach ($this->mapLang as $attr => $dbname) {
      $attrDb[] = $dbname . ' = :' . $attr;
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
    return $e;
  }

  public function isTranslated($id, $lang) {
    $sql = "SELECT 1 FROM $this->langTable WHERE  $this->joinColumn = $id AND lang = '$lang' ";
    return $this->dbAdapter->query($sql)->rowCount() > 0;
  }

//	public function fetchAsJson(){
//		$result = array();
//		global $available_lang;
//		foreach ($available_lang as $lang_name => $lang) {
//			$this->setCurrentLang($lang);
//			$result[$lang] = $this->fetch();
//		}
//
//		return json_encode($result);
//	}

  public function fetchAsXml($filename = null) {
    $result = array();
    global $available_lang;
    foreach ($available_lang as $lang_name => $lang) {
      $this->setCurrentLang($lang);
      $result[$lang] = $this->fetch();
    }

    $element = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><dataset></dataset>');

    foreach ((array) $result as $lang => $objects) {
      foreach ($objects as $object) {
        $table = $element->addChild($this->className);
        $table->addAttribute('lang', $lang);
        $this->objectToTable($table, $object);
      }
    }

    if ($filename == null) {
      return $element->asXML();
    } else {
      return $element->asXML($filename);
    }
  }

  protected function objectToTable($element, $object) {


    foreach ($object as $key => $val) {

      if ($val == null) {
        continue;
      }
      if ($val instanceof IEntity) {

        $keyNode = $element->addChild($key);
        $this->objectToTable($keyNode, $val);
        continue;
      }
      if (is_array($val)) {
        foreach ($val as $_o) {
          $keyNode = $element->addChild($key);
          $this->objectToTable($keyNode, $_o);
        }
        continue;
      }
      $element->addChild($key, @htmlspecialchars($val));
    }
  }

  public function fetchAsXls() {

    $headers = null;
    $xmlContent = null;
    $i = 0;
    global $available_lang;
    foreach ($available_lang as $lang_name => $lang) {
      $this->setCurrentLang($lang);
      $result = $this->fetch();
      foreach ($result as $object) {

        foreach ($object as $key => $val) {
          if (is_object($val) || is_array($val)) {
            continue;
          }
          if ($i == 0) {
            $headers .= $key . "\t";
          }

          $xmlContent .= '"' . $val . '"' . "\t";
        }
        $i++;
        $xmlContent .= $lang . "\t";
        $xmlContent .= "\n";
      }
    }
    $headers .= "lang\t";


    return $headers . "\n" . $xmlContent;
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

      foreach ((array) $available_lang as $l => $dl) {
        $this->dbAdapter
                ->exec("DELETE FROM $this->langTable WHERE $this->joinColumn = " . $id . " AND lang = '$dl'");
      }
    } else {

      $this->dbAdapter
              ->exec("DELETE FROM $this->table WHERE id = " . $id);

      $this->dbAdapter
              ->exec("DELETE FROM $this->langTable WHERE $this->joinColumn = " . $id . " AND lang = '$this->defaultLang'");
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
