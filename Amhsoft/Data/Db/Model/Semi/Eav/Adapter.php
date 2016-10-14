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
abstract class Amhsoft_Data_Db_Model_Semi_Eav_Adapter extends Amhsoft_Data_Db_Model_Adapter {

    protected $configTable = null;
    protected $configJoinColumn;
    protected $mapConfig = array();
    protected $uid;

    /**
     * Construct.
     */
    public function __construct() {
        parent::__construct();

        $this->configJoinColumn = $this->getConfigJoinColumn();
        $this->configTable = $this->getConfigTable();
        $this->uid = $this->getUid();
        $this->expandMapping();

        if (empty($this->configTable)) {
            throw new Exception('Missing Language Table');
        }

        if ($this->configJoinColumn == null) {
            throw new Exception('Missing Join Column');
        }
    }

    protected function expandMapping() {
        $adapter = new Eav_Attribute_Model_Adapter();
        $adapter->where('entity_id = ?', $this->getUid());
        $result = $adapter->fetch();
        while ($attribute = $result->fetch()) {

            $this->appendConfigMap($attribute->getName());
        }
    }

    abstract function getUid();

    protected function getConfigTable() {
        return '`' . str_replace('`', '', $this->getTable()) . '_conf`';
    }

    public function appendConfigMap($name, $columnname = null) {
        if ($columnname == null) {
            $columnname = $name;
        }
        $this->mapConfig[$name] = $columnname;
    }

    public function getConfigJoinColumn() {
        return str_replace('`', '', $this->getTable()) . '_id';
    }

    /**
     * build select statement.
     * @override
     * @see BusinessOrm::getSelectStatement()
     */
    protected function getSelectStatement() {
        foreach ($this->mapConfig as $key => $val) {
            $this->select($this->configTable . '.`' . $key . '`', $val);
        }
        foreach ($this->map as $key => $val) {
            $this->select($this->table . '.`' . $key . '`', $val);
        }
        return parent::getSelectStatement() . $this->_getJoinStatement();
    }

    public function _getJoinStatement() {
        return ' JOIN ' . $this->configTable . ' ON ' . $this->table . '.id = ' . $this->configTable . '.' . $this->configJoinColumn;
    }

    /**
     * Insert into tables
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
            //config part
            $this->_insert_into_table_config($object);

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

    public function qualify($column) {
        return isset($this->map[$column]) ? $this->table . '.' . $column : $this->configTable . '.' . $column;
    }

    /**
     * insert into table config
     */
    protected function _insert_into_table_config($object) {
        $this->dbAdapter->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $this->getInsertIntoTableConfigSQL();

        $statement = $this->dbAdapter->prepare($sql);
        $statement->bindParam(':joinColumn', $object->id, PDO::PARAM_INT);

        $attrs = array_keys($this->mapConfig);


        foreach ($attrs as $key => $attributName) {
            $statement->bindValue(':' . $attributName, @$object->{$attributName}, PDO::PARAM_STR);
        }

        $statement->execute();
        $this->id = $this->dbAdapter->lastInsertId();
    }

    /**
     * Build sql for insert into table config
     * @return string
     */
    protected function getInsertIntoTableConfigSQL() {
        $this->dbAdapter->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO " . $this->configTable . "(" . $this->configJoinColumn . ', ';
        $attrs = array_keys($this->mapConfig);
        if (empty($attrs)) {
            $sql = "INSERT INTO " . $this->configTable . "(" . $this->configJoinColumn . ') VALUES (:joinColumn); ';
        } else {
            $sql = "INSERT INTO " . $this->configTable . "(" . $this->configJoinColumn . ', ';
            $sql .= implode(',', $attrs) . ') VALUES (:joinColumn,  :';
            $sql .= implode(',:', $attrs) . ')';
        }
        return $sql;
    }

    /**
     * update table lang
     * @param IObjectModel $object
     */
    protected function _update_table_config($object) {
        $this->dbAdapter->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE " . $this->configTable . " SET ";
        $attrDb = array();



        foreach ($this->mapConfig as $attr => $dbname) {
            $attrDb[] = $dbname . ' = :' . $attr;
        }
        
        if(empty($attrDb)){
          return;
        }
        
        $sql .= implode(',', $attrDb);

        $sql .= " WHERE $this->configJoinColumn = $object->id";


        $statement = $this->dbAdapter->prepare($sql);
        foreach ($this->mapConfig as $attributName => $dbName) {
            $statement->bindParam(':' . $attributName, $object->{$attributName}, PDO::PARAM_STR);
        }


        $statement->execute();
    }

    /**
     * Check if table config has row.
     */
    protected function configRowExists($object) {
        $sql = "SELECT COUNT(*) as c FROM $this->configTable WHERE  $this->configJoinColumn = $object->id";
        return intval(Amhsoft_Database::querySingle($sql)) > 0;
    }

    /**
     * update tables.
     * @param Amhsoft_Data_Db_Model_Interface $object
     */
    public function update(Amhsoft_Data_Db_Model_Interface $object, $cascade = false) {
        $e = parent::update($object, $cascade);

        if (!$this->configRowExists($object)) {
            $this->_insert_into_table_config($object);
        } else {
            $this->_update_table_config($object);
        }
        return $e;
    }

    /**
     * Delete Enitity by given id.
     * @example $entityAdapter->deleteById($id);
     * @param int $id
     * @return <type>
     */
    public function deleteById($id) {

        $this->dbAdapter
                ->exec("DELETE FROM $this->table WHERE id = " . $id);

        $this->dbAdapter
                ->exec("DELETE FROM $this->configTable WHERE $this->configJoinColumn = " . $id);
    }

}
