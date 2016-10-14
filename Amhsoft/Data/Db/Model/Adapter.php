<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 124 2016-01-26 17:30:14Z montassar.amhsoft $
 * $Rev: 124 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-26 18:30:14 +0100 (mar., 26 janv. 2016) $
 * $Author: montassar.amhsoft $
 */
class Amhsoft_Data_Db_Model_Adapter {

    protected $className;
    protected $table;
    protected $map = array();
    protected $whereClause = null;
    protected $selectStatment = null;
    protected $limitClause = null;
    protected $_whereClause = array();
    protected $_selectColumns = array();
    protected $one2oneRelations = array();
    protected $one2manyRelations = array();
    protected $many2manyRelations = array();
    protected $leftJoin = array();
    protected $groupBy;
    protected $id;
    protected $orderby;
    protected $preDefinedSelectStatement;
    protected $dbAdapter;

    /**
     * Construct.
     */
    public function __construct() {

        $this->dbAdapter = Amhsoft_Database::getInstance();
        $this->selectStatment = $this->whereClause = null;

        $this->table = '`' . $this->table . '`';

        if (is_null($this->table) || empty($this->table)) {
            throw new Exception('Table name is unknown.');
        }

        if (is_null($this->className)) {
            throw new Exception('Class name is unknown.');
        }

        if (count($this->map) == 0) {
            throw new Exception('No Map available.');
        }
    }

    public function setClassName($class) {
        $this->className = $class;
    }

    public function getDbAdapter() {
        return $this->dbAdapter;
    }

    public function setDbAdapter($dbAdapter) {
        $this->dbAdapter = $dbAdapter;
    }

    public function getClassName() {
        return $this->className;
    }

    public function getTable() {
        return $this->table;
    }

    public function qualify($column) {
        if (strpos($column, '.')) {
            return $column;
        }
        return $this->table . '.' . $column;
    }

    public function getSelectStatment() {
        return $this->selectStatment;
    }

    public function removeAllRelationShips() {
        $this->one2manyRelations = array();
        $this->one2oneRelations = array();
        $this->many2manyRelations = array();
    }

    public function getOne2oneRelations() {
        return $this->one2oneRelations;
    }

    public function getOne2manyRelations() {
        return $this->one2manyRelations;
    }

    public function getMany2manyRelations() {
        return $this->many2manyRelations;
    }

    public function getLeftJoin() {
        return $this->leftJoin;
    }

    public function getGroupBy() {
        return $this->groupBy;
    }

    public function getOrderby() {
        return $this->orderby;
    }

    public function setPreDefinedSelectStatement($preDefinedSelectStatement) {
        $this->preDefinedSelectStatement = $preDefinedSelectStatement;
    }

    public function appendMap($name, $columnname = null) {
        if ($columnname == null) {
            $columnname = $name;
        }
        $this->map[$name] = $columnname;
    }

    /**
     * Gets limit clause.
     * @assert () == 'LIMIT 5'
     * @return string $limitClause
     */
    public function getLimitClause() {
        return $this->limitClause;
    }

    /**
     * Gets Map.
     * @return array map
     */
    public function getMap() {
        return $this->map;
    }

    public function groupBy($context) {
        $this->groupBy = "GROUP BY " . $context;
    }

    /**
     *
     * Set Limit Condition
     * @example $adapter->limit(10);
     * @param  int $limit
     * @return BusinessOrmAdapter $this
     */
    public function limit($limit) {
        if (intval($limit) > 0) {
            $this->limitClause = ' LIMIT ' . $limit;
        } else {
            $this->limitClause = $limit;
        }
        return $this;
    }

    /**
     *
     * Add Where condition
     * $statement must have a sql syntax <br />
     * $value can be int or string or bool or null <br />
     * $int is a Amhsoft_Database::PARAM_*  <br />
     *  
     * @example $adapter->where('id < ?', 5);
     * @example $adapter->where('name LIKE ?, 'Mohammed', Database:PARAM_STR);
     * @param string $statement
     * @param mixed $value
     * @param int $int
     * @return DbObjectAdapter $instance
     */
    public function where($statement, $value = null, $int = 1) {
        if ($value == null) {
            $this->_whereClause[$statement] = $statement;
        }

        if ($value == "%%") {
            return $this;
        }
        if ($int == Amhsoft_Database::PARAM_STR) {
            $this->_whereClause[$statement] = @str_replace('?', "'" . $value . "'", $statement);
        }
        if ($int == Amhsoft_Database::PARAM_INT) {
            $this->_whereClause[$statement] = @str_replace('?', intval($value), $statement);
        }
        if ($int == Amhsoft_Database::PARAM_INT) {
            $this->_whereClause[$statement] = @str_replace('?', intval($value), $statement);
        }
        if ($int == Amhsoft_Database::PARAM_BOOL) {
            $this->_whereClause[$statement] = @str_replace('?', (bool) ($value), $statement);
        }
        if ($int == Amhsoft_Database::PARAM_NULL) {
            $this->_whereClause[$statement] = @str_replace('?', 'NULL', $statement);
        }
        return $this;
    }

    /**
     *
     * Add Column to select
     * @example $adapter->select('name');
     * @example $adapter->select('name', 'firstname');
     * that´s mean select name AS firstname.
     * @param string $column
     * @param string $alias
     * @return BusinessOrmInterface $instance
     */
    public function select($column, $alias = null) {
        $this->_selectColumns[] = ($alias == null || ($this->table . "." . $column) == $alias) ? $column : "$column AS `$alias`";
        return $this;
    }

    /**
     *
     * Add Column to select
     * @example $adapter->select('name');
     * @example $adapter->select('name', 'firstname');
     * that´s mean select name AS firstname.
     * @param string $column
     * @param string $alias
     * @return BusinessOrmInterface $instance
     */
    public function selectFunc($func) {
        $this->_selectColumns[] = $func;
        return $this;
    }

    /**
     * Left join with another table.
     * @example $adapter->leftJoin('other_table', 'id', 'other_table_id');
     * @param string $table
     * @param string $leftkey
     * @param string $rightkey
     * @return BusinessOrmInterface $instance
     */
    public function leftJoin($table, $leftkey, $rightkey) {
        $this->leftJoin[$table] = " LEFT JOIN `$table` ON $this->table.`$leftkey` = `$table`.`$rightkey`";
        return $this;
    }

    public function outerJoin($table, $leftkey, $rightkey) {
        $this->leftJoin[$table] = " LEFT OUTER JOIN `$table` ON $this->table.`$leftkey` = `$table`.`$rightkey`";
        return $this;
    }

    /**
     * Left join with another table.
     * @example $adapter->leftJoin('other_table', 'id', 'other_table_id');
     * @param string $table
     * @param string $leftkey
     * @param string $rightkey
     * @return BusinessOrmInterface $instance
     */
    public function leftJoinWithoutCardinality($table, $leftkey, $rightkey) {
        $this->leftJoin[$table] = " LEFT JOIN $table ON $leftkey = $rightkey";
// echo " LEFT JOIN `$table` ON $this->table.`$leftkey` = `$table`.`$rightkey`"; exit;
        return $this;
    }

    public function from($table, $sql) {
        $this->leftJoin[$table] = " " . $sql;
    }

    public function joinBySQL($table, $sql) {
        $this->leftJoin[$table] = " " . $sql;
// echo " LEFT JOIN `$table` ON $this->table.`$leftkey` = `$table`.`$rightkey`"; exit;
        return $this;
    }

    public function rightJoin($table, $leftkey, $rightkey) {
        $this->leftJoin[$table] = " RIGHT JOIN `$table` ON $this->table.`$leftkey` = `$table`.`$rightkey`";
// echo " LEFT JOIN `$table` ON $this->table.`$leftkey` = `$table`.`$rightkey`"; exit;
        return $this;
    }

    /**
     * Gets LEFT JOIN clause.
     * @access protected.
     * @return string $sql_join_clause
     */
    public function getLeftJoinStatement() {
        return @implode('', $this->leftJoin);
    }

    /**
     * Gets select clause.
     * @return string $sql_select_clause.
     */
    protected function getSelectStatement() {

        if ($this->preDefinedSelectStatement != null) {
            return $this->preDefinedSelectStatement;
        }

        if (count($this->_selectColumns) == 0) {
            return "SELECT $this->table.* FROM $this->table";
        }
        return "SELECT " . @implode(', ', $this->_selectColumns) . " FROM $this->table";
    }

    /**
     * Check if the Entity has One2One Relationship with an other Enttities.
     * @access private
     * @return bool $has_relation_ship
     */
    protected function hasOne2OneRelations() {
        return count($this->one2oneRelations) > 0;
    }

    /**
     *
     * Check if the Entity has One2Many Relationship with an an other Entities.
     * @access private
     * @return bool $has_relation_ship
     */
    protected function hasOne2ManyRelations() {
        return count($this->one2manyRelations) > 0;
    }

    /**
     * Check if the Entity has Many2Many Relationship with an other Entities
     * @access private
     * @return bool $has_many2many_relations
     */
    protected function hasMany2ManyRelations() {
        return count($this->many2manyRelations) > 0;
    }

    /**
     * Gets Where Clause.
     * @assert () == WHERE id = 5
     * @access private
     * @return string $where_clause
     */
    public function getWhereClause() {
        $this->whereClause = (count($this->_whereClause) > 0) ? ' WHERE ' . @implode(' AND ', $this->_whereClause) : null;
        return $this->whereClause;
    }

    /**
     * @example $adapter->orderBy('id DESC');
     * @param string $clause
     */
    public function orderBy($clause) {
        $this->orderby = ' ORDER BY ' . $clause . ' ';
    }

    /**
     * Gets Select Clause.
     * @return string $select_clause
     */
    public function selectSqlClause() {
        $sql = $this->getSelectStatement() . $this->getLeftJoinStatement() . $this->getWhereClause() . ' ' . $this->groupBy . ' ' . $this->orderby . $this->getLimitClause();
        return $sql;
    }

    public function getSize() {
        try {
            $stmt = $this->dbAdapter->query($this->selectSqlClause());
            return $stmt->rowCount();
        } catch (Exception $exp) {
            return 0;
        }
    }

    /**
     * @deprecated
     * @return integer
     */
    public function getCount() {
        return $this->getSize();
    }

    /**
     * Fetch Database
     * @example $entities = $enttityAdapter->fetch();
     * @see IORM::fetch()
     * @thorws PDO
     * @return array $BusinessOrm
     */
    public function fetch() {
        //$event = 'before.fetch.' . strtolower($this->getClassName());
       // Amhsoft_Data_Db_Model_Event_Handler::trigger($event, $this, null);
        $db = Amhsoft_Database::getInstance();

        $db->setAttribute(PDO::ATTR_STATEMENT_CLASS, array('DBStatement', array($this)));

        $stmt = $db->prepare($this->selectSqlClause());



        try {
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, $this->className);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        if (!$this->hasOne2OneRelations() && !$this->hasOne2ManyRelations() && !$this->hasMany2ManyRelations()) {
            return $stmt;
        }


        return $stmt;
    }

    /**
     * Fetch Database By Entity id.
     * @example $entity  = $entityAdpater->fetchById($id);
     * @param int $id
     * @return Amhsoft_Data_Db_Model_Interface $entity
     * @see IORM::fetchById($id)
     */
    public function fetchById($id) {
        if ($id == 0) {
            return null;
        }
        $this->id = $id;
        $this->where($this->table . '.id = ?', $this->id, Amhsoft_Database::PARAM_INT);

        $stmt = $this->fetch();
        if ($stmt instanceof PDOStatement) {
            $e = $stmt->fetch();
            return $e;
        }
        return isset($stmt[0]) ? $stmt[0] : null;
    }

    /**
     * Fetch Database By Entity email.
     * @example $entity  = $entityAdpater->fetchByEmail($email);
     * @param string $email
     * @return Amhsoft_Data_Db_Model_Interface $entity
     * @see IORM::fetchByEmail($email)
     */
    public function fetchByEmail($email, $columnName = 'email1') {
        $this->email = $email;
        $this->where($this->table . '.' . $columnName . ' = ?', $this->email, Amhsoft_Database::PARAM_STR);
        $stmt = $this->fetch();

        if ($stmt instanceof PDOStatement) {
            $e = $stmt->fetch();
            return $e;
        }
        return isset($stmt[0]) ? $stmt[0] : null;
    }

    /**
     * Delete current Entity
     * @example $entityAdapter->delete();
     * @see IORM::delete()
     */
    public function delete() {
        $e = $this->deleteById($this->id);
        Amhsoft_View::getInstance()->clearAllCache();
        return $e;
    }

    /**
     * Delete Enitity by given id.
     * @example $entityAdapter->deleteById($id);
     * @param int $id
     * @return <type>
     */
    public function deleteById($id) {
        $event = 'before.delete.' . strtolower($this->getClassName());
        Amhsoft_Data_Db_Model_Event_Handler::trigger($event, $this, $id);
        $e = $this->dbAdapter
                ->exec("DELETE FROM $this->table WHERE id = " . $id);
        if ($e) {
            $event = 'after.delete.' . strtolower($this->getClassName());
            Amhsoft_Data_Db_Model_Event_Handler::trigger($event, $this, null);
        }
        return $e;
    }

    /**
     * Delete Enitity by given id.
     * @example $entityAdapter->deleteById($id);
     * @param int $id
     * @return <type>
     */
    public function deleteAll($where = null) {
        $event = 'before.deleteall.' . strtolower($this->getClassName());
        Amhsoft_Data_Db_Model_Event_Handler::trigger($event, $this, $where);
        $e = $this->dbAdapter
                ->exec("DELETE FROM $this->table $where");
        if ($e) {
            $event = 'after.deleteall.' . strtolower($this->getClassName());
            Amhsoft_Data_Db_Model_Event_Handler::trigger($event, $this, null);
        }
        return $e;
    }

    /**
     * Insert entitiy into Database.
     * @example $entityAdapter->insert($entity);
     * @param Amhsoft_Data_Db_Model_Interface $entity
     * @see IORM::insert()
     */
    public function insert(Amhsoft_Data_Db_Model_Interface $object, $cascade = false) {
        $event = 'before.insert.' . strtolower($this->getClassName());
        Amhsoft_Data_Db_Model_Event_Handler::trigger($event, $this, $object);
        $this->saveRelationShopOne2One($object, $cascade);
        $this->_insert($object);
        $this->saveMany2ManyRelationShips($object, $cascade);
        $event = 'after.insert.' . strtolower($this->getClassName());
        Amhsoft_Data_Db_Model_Event_Handler::trigger($event, $this, $object);
        Amhsoft_View::getInstance()->clearAllCache();
        return $object->id;
    }

    /**
     * Insert or Update Entity
     * if $entity->id == null then insert otherwise update
     * @param Amhsoft_Data_Db_Model_Interface $object
     */
    public function save(Amhsoft_Data_Db_Model_Interface $object, $cascade = false) {

        if (isset($object->id) && intval($object->id) > 0) {
            $this->update($object, $cascade);
        } else {
            $this->insert($object, $cascade);
        }
        return $object->id;
    }

    /**
     * Build insert statement.
     * @return string $insert_statement
     */
    protected function buildInsertSQL() {
        $sql = 'INSERT INTO ' . $this->table . ' (';
        $attrs = array_keys($this->map);
        $dbs = array_values($this->map);
        $isFirst = true;
        foreach ($attrs as $attributeName) {
            if (!$isFirst) {
                $sql .= ', ';
            } else {
                $isFirst = false;
            }
            $sql .= '`' . $attributeName . '`';
        }
        $sql .= ') VALUES (:';
        $sql .= implode(',:', $attrs) . ')';
        return $sql;
    }

    /**
     * Do Insert into Database.
     * @param Amhsoft_Data_Db_Model_Interface $object
     */
    protected function _insert($object) {
        $this->dbAdapter->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $statement = $this->dbAdapter->prepare($this->buildInsertSQL());


        $attrs = array_keys($this->getMap());
        foreach ($attrs as $key => $attributName) {
            $statement->bindParam(':' . $attributName, $object->{$attributName}, PDO::PARAM_STR);
        }

        $statement->execute();
        $this->id = $object->id = $this->dbAdapter->lastInsertId();
        return $this->id;
    }

    /**
     * @param Amhsoft_Data_Db_Model_Interface $object
     */
    protected function saveRelationShopOne2Many(&$object, $cascade) {
        if ($this->hasOne2ManyRelations()) {
            foreach ($this->one2manyRelations as $relation) {
                $fAdapter = new $relation['associatedClass'];
                $fAdapter->map[$relation['foreignKey']] = $relation['foreignKey'];
                foreach ((array) $object->{$relation['role']} as $o) {
                    $o->{$relation['foreignKey']} = $this->id;
                    if ($cascade == true)
                        $fAdapter->save($o);
                }
            }
        }
    }

    /**
     *
     * @param Amhsoft_Data_Db_Model_Interface $object
     */
    protected function saveRelationShopOne2One(&$object, $cascade) {
        if ($this->hasOne2OneRelations()) {

            foreach ($this->one2oneRelations as $relation) {

                $this->map[$relation['foreignKey']] = $relation['foreignKey'];

                if (isset($object->{$relation['role']}->id) && $object->{$relation['role']}->id > 0) {
                    $object->{$relation['foreignKey']} = $object->{$relation['role']}->id;
                } else {

                    if ($cascade == true && $object->{$relation['role']} != null) {
                        $fAdapter = new $relation['associatedClass'];
                        $fAdapter->save($object->{$relation['role']});
                        $object->{$relation['foreignKey']} = $object->{$relation['role']}->id;
                    }
                }
            }
        }
    }

    /**
     * Save One2One Relation
     * @param <type> $object
     * @return <type>
     */
    protected function saveMany2ManyRelationShips($object, $cascade = false) {

        if (count($this->many2manyRelations) == 0) {
            return;
        }

//   if($cascade == false){
//     return;
//   }

        foreach ($this->many2manyRelations as $relation) {
            if ($relation['updateCascade'] == false) {
                continue;
            }
            $Database = $this->dbAdapter;
            $sql = 'DELETE FROM ' . $relation['associatedTable'] . ' WHERE ' . $relation['localKey'] . ' = ' . $object->id;

            $Database->exec($sql);

            foreach ((array) $object->{$relation['role']} as $o) {
                if ($relation['updateCascade'] == true && intval($o->id) == 0) {
                    $fAdapter = new $relation['associatedClass'];
                    $fAdapter->save($o);
                }        
//NEW
                if (count($relation['selected_cols']) > 0) {
                    $values = '';
                    $sql = 'INSERT INTO ' . $relation['associatedTable'] . ' (' . $relation['localKey'] . ',' . $relation['foreignKey'];
                    foreach ($relation['selected_cols'] as $col) {
                        $sql .= ',' . $col;
                        if (is_string($o->$col)) {
                            $values .= ",'" . $o->$col . "'";
                        } else {
                            $values .= "," . $o->$col;
                        }
                    }

                    $sql .= ' ) VALUES (' . $object->id . ',' . $o->id . ' ' . $values . ')';
                } else {
                    $sql = 'INSERT INTO ' . $relation['associatedTable'] . ' (' . $relation['localKey'] . ',' . $relation['foreignKey'] . ') VALUES (' . $object->id . ',' . $o->id . ')';
                }
//END_NEW
//OLD
//$sql = 'INSERT INTO ' . $relation['associatedTable'] . ' (' . $relation['localKey'] . ',' . $relation['foreignKey'] . ') VALUES (' . $object->id . ',' . $o->id . ')';
//END_OLD
                try {
                    $Database->exec($sql);
                } catch (Exception $e) {
                    
                }
            }
        }
    }

    /**
     * update object with their Relationships
     * @see IORM::update()
     */
    public function update(Amhsoft_Data_Db_Model_Interface $object, $cascade = false) {
        $this->updateRelationShipOne2One($object, $cascade);
        $this->_update($object);
        $this->updateRelationShipOne2Many($object, $cascade);
        $this->saveMany2ManyRelationShips($object, $cascade);
        Amhsoft_View::getInstance()->clearAllCache();
        return $object->id;
    }

    /**
     * update one2one Rlationship
     * @param $object
     */
    protected function updateRelationShipOne2One(&$object, $cascade) {

        if ($this->hasOne2OneRelations()) {
            foreach ($this->one2oneRelations as $relation) {

                if ($object->{$relation['role']} == null) {
                    continue;
                }

                $this->map[$relation['foreignKey']] = $relation['foreignKey'];

                if ($relation['updateCascade'] == false || $object->{$relation['role']} == null) {
                    continue;
                }


                if (!$object->{$relation['foreignKey']}) {
                    $object->{$relation['foreignKey']} = $object->{$relation['role']}->id;
                }

                $object->{$relation['foreignKey']} = $object->{$relation['role']}->id;
                $fAdapter = new $relation['associatedClass'];
                if ($object->{$relation['role']}->id == null)
                    $fAdapter->insert($object->{$relation['role']});
                else
                    $fAdapter->update($object->{$relation['role']});
                $object->{$relation['foreignKey']} = $object->{$relation['role']}->id;
            }
        }
    }

    /**
     *
     * update one2Many Relationship
     * @param unknown_type $object
     * @throws BusinessOrmException
     */
    protected function updateRelationShipOne2Many(&$object, $cascade) {
//if ($cascade == false) {
//    return;
// }

        if ($this->hasOne2ManyRelations()) {
            foreach ($this->one2manyRelations as $relation) {
                if ($relation['updateCascade'] == false) {
                    continue;
                }
                $fAdapter = new $relation['associatedClass'];
                $Database = $this->dbAdapter;
                $sql = 'DELETE FROM ' . $fAdapter->getTable() . ' WHERE ' . $relation['foreignKey'] . ' = ' . $object->id;
                $Database->exec($sql);
                foreach ($object->{$relation['role']} as $role) {
                    $role->{$relation['foreignKey']} = $object->id;
                    $fAdapter->insert($role);
                }
            }
        }
    }

    /**
     * Convert Entity to Xml
     */
    public function toXml() {
        
    }

    /**
     * Build update SQL
     * @return string $update_sql
     */
    protected function buildUpdateSql(Amhsoft_Data_Db_Model_Interface $object) {
        $sql = "UPDATE " . $this->table . " SET ";
        $attrDb = array();
        foreach ($this->map as $attr => $dbname) {
            $attrDb[] = '`' . $dbname . '` = :' . $attr;
        }
        $sql .= implode(',', $attrDb);
        $sql .= ' WHERE `id` = ' . $object->id;
        return $sql;
    }

    /**
     * Update Entity
     * @param Amhsoft_Data_Db_Model_Interface $object
     * @return int $id
     */
    protected function _update(&$object) {
        if ($object->id == null) {
            throw new Exception('id is null');
        }
        $this->dbAdapter->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $statement = $this->dbAdapter->prepare($this->buildUpdateSql($object));

        $event = 'before.update.' . strtolower($this->getClassName());
        Amhsoft_Data_Db_Model_Event_Handler::trigger($event, $this, $object);


        foreach ($this->map as $attributName => $dbName) {
            $statement->bindParam(':' . $attributName, $object->{$attributName}, PDO::PARAM_STR);
        }
        $statement->execute();
        $e = $object->id;
        $event = 'after.update.' . strtolower($this->getClassName());
        Amhsoft_Data_Db_Model_Event_Handler::trigger($event, $this, $object);
        return $e;
    }

    /**
     * Define One2One Relationship.
     * @param string $role represent the foreign key in this class
     * @param string $foreignKey the foreign table keys xxxx_id
     * @param string $associatedClass the associated class
     * @param bool $onDelteCascade
     * @param bool $onUpdateCascade
     */
    public function defineOne2One($role, $foreignKey, $associatedClass, $onDelteCascade = false, $onUpdateCascade = false) {
        $this->appendMap($foreignKey);
        $this->one2oneRelations[] = array('role' => $role, 'foreignKey' => $foreignKey, 'associatedClass' => $associatedClass . '_Adapter', 'deleteCascade' => $onDelteCascade, 'updateCascade' => $onUpdateCascade);
    }

    /**
     * Define One2Many Relationship
     * @param string $role
     * @param string $foreignKey
     * @param string $associatedClass
     * @param bool $onDelteCascade
     * @param bool $onUpdateCascade dfsdf
     */
    public function defineOne2Many($role, $foreignKey, $associatedClass, $onDelteCascade = false, $onUpdateCascade = false, $sortcol = null) {
        $this->one2manyRelations[] = array('role' => $role, 'foreignKey' => $foreignKey, 'associatedClass' => $associatedClass . '_Adapter', 'deleteCascade' => $onDelteCascade, 'updateCascade' => $onUpdateCascade, 'sortcol' => $sortcol);
    }

    /**
     * Define Many2Many Relationship
     * @param string $role
     * @param string $associetedClass
     * @param string $associationTable
     * @param string $localKey
     * @param string $foreignKey
     * @param string $onDelteCascade
     * @param string $onUpdateCascade
     */
    public function defineMany2Many($role, $associetedClass, $associationTable, $localKey, $foreignKey, $onDeleteCascade = false, $onUpdateCascade = false, $sortcol = null, $selected_cols = array()) {
        $this->many2manyRelations[] = array('role' => $role, 'associatedClass' => $associetedClass . '_Adapter', 'associatedTable' => $associationTable, 'localKey' => $localKey, 'foreignKey' => $foreignKey, 'deleteCascade' => $onDeleteCascade, 'updateCascade' => $onUpdateCascade, 'sortcol' => $sortcol, 'selected_cols' => $selected_cols);
    }

    /**
     * Export Entity to Xml
     * @param string $filename
     * @return string xml
     */
    public function fetchAsXml($element = null, $filename = null, $asXml = true) {
        $result = $this->fetch();
        if ($element == null) {
            $element = new SimpleXMLElement('<dataset></dataset>');
        }


        while ($object = $result->fetch()) {
            $table = $element->addChild(str_replace('`', '', $this->getTable()));
            $table->addAttribute('class', $this->getClassName());
            foreach ($object as $key => $val) {
                $key = str_replace('`', '', $key);
                if (is_string($val)) {
                    $table->addChild($key, $val);
                }
                if (is_object($val)) {
                    $sub = $table->addChild($key);
                    $sub->addAttribute('class', get_class($val));
                    foreach ($val as $subkey => $subval) {
                        if (is_string($subval)) {
                            $sub->addChild($subkey, $subval);
                        }
                    }
                }
            }
        }

        if ($filename == null) {
            if ($asXml == true) {
                return $element->asXML();
            } else {
                return $element;
            }
        } else {
            return $element->asXML($filename);
        }
    }

    public function fetchByIdAsXml($id) {
        $object = $this->fetchById($id);
        $element = new SimpleXMLElement("<$this->className></$this->className>");

        foreach ($object as $key => $val) {
            $element->addChild($key, (string) $val);
//$table->addAttribute($key, $val);
//}
        }

        return $element->asXML();
    }

    public function fetchAsJson() {
        $result = $this->fetch();
        if ($result) {
            $data = array();
            while ($d = $result->fetch()) {
                if ($this->className == 'VehicleModel') {
                    $d->getOwner();
                }
                if ($this->className == 'Request_Model') {
                    if ($d->content == null) {
                        $d->content = "null";
                    }
                }
                $data[] = $d;
            }
            return json_encode($data);
        }
    }

    public function fetchAsXls() {
        $filename = "excelreport.xls";
        $result = $this->fetch();
        $headers = null;
        $contents = null;
        $i = 0;
        $map = $this->getMap();
        foreach ($result as $object) {

            foreach ($map as $key => $val) {
                if ($i == 0) {
                    $headers .= $key . "\t";
                }
                $contents .= '"' . $object->{$val} . '"' . "\t";
            }
            $i++;
            $contents .= "\n";
        }
        header('Content-type: application/ms-excel');
        header('Content-Disposition: attachment; filename=' . $filename);
        echo $headers . "\n" . $contents;
        exit;
    }

}

class DBStatement extends PDOStatement {

    protected $adapter;

    public function getAdapter() {
        return $this->adapter;
    }
    
    protected function __construct($adapter) {
        $this->adapter = $adapter;
    }

// real cast number
    public function fetch($fetch_style = null, $cursor_orientation = null, $cursor_offset = null) {

        $mainObject = parent::fetch(null, $cursor_orientation, $cursor_offset);

        if (!$mainObject) {
            return;
        }

        //$event = 'before.fetch.' . strtolower($this->adapter->getClassName());
       // Amhsoft_Data_Db_Model_Event_Handler::trigger($event, $this->adapter, $mainObject);
        foreach ($this->adapter->getOne2oneRelations() as $relation) {

            if (isset($mainObject->{$relation['foreignKey']})) {
                $object = new $relation['associatedClass'];
                $object->where('id = ?', $mainObject->{$relation['foreignKey']}, Amhsoft_Database::PARAM_INT);
                $resultStmt = $object->fetch();

                if ($resultStmt->rowCount() > 0) {
                    $mainObject->{$relation['role']} = $resultStmt->fetch();
                }
            }
        }

//fetch one2many
        foreach ($this->adapter->getOne2manyRelations() as $relation) {
            $object = new $relation['associatedClass'];
            if (!$mainObject instanceof Amhsoft_Data_Db_Model_Interface) {
                continue;
            }
            $object->where($relation['foreignKey'] . ' = ?', $mainObject->id, Amhsoft_Database::PARAM_INT);
            if ($relation['sortcol']) {
                $object->orderBy($relation['sortcol'] . ' ASC');
            }
            $resultStmt = $object->fetch();

            if (is_array($resultStmt)) {
                $mainObject->{$relation['role']} = $resultStmt;
                continue;
            }

            if (!$resultStmt instanceof PDOStatement) {
                $mainObject->{$relation['role']} = array();
                continue;
            }
            while ($fobject = $resultStmt->fetch()) {
                $mainObject->{$relation['role']}[] = $fobject;
            }
        }

//fetch many2many
        foreach ($this->adapter->getMany2manyRelations() as $relation) {

            $object = new $relation['associatedClass'];
            $object->leftJoin($relation['associatedTable'], 'id', $relation['foreignKey']);
            $object->where($relation['associatedTable'] . '.' . $relation['localKey'] . ' = ?', $mainObject->id, Amhsoft_Database::PARAM_INT);
            if ($relation['sortcol']) {
                $object->orderBy($relation['associatedTable'] . '.' . $relation['sortcol'] . ' ASC');
            }
            if (!empty($relation['selected_cols'])) {
                $object->select('*');
                foreach ($relation['selected_cols'] as $col) {
                    $object->select($relation['associatedTable'] . '.' . $col, $col);
                }
            }
            $resultst = $object->fetch();
            while ($ob = $resultst->fetch()) {
                $mainObject->{$relation['role']}[] = clone $ob;
            }
        }

        //$event = 'after.fetch.' . strtolower($this->adapter->getClassName());
        //Amhsoft_Data_Db_Model_Event_Handler::trigger($event, $this->adapter, $mainObject);

        return $mainObject;
    }

}
