<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Config_Table_Adapter extends Amhsoft_Config_Abstract {

  protected $data = null;
  protected $entity = null;

  public function __construct($entity) {
    if (!$entity) {
      throw new Exception('please declate entity name');
    }
    $this->entity = $entity;
    $this->refresh();
  }

  private function refresh() {
    $settingModelAdapter = new Amhsoft_Setting_Model_Adapter();
    $settingModelAdapter->where('entity = ?', $this->entity, PDO::PARAM_STR);
    $result = $settingModelAdapter->fetch();
    foreach ($result as $model) {
      $this->data[$model->settingkey] = $model->settingvalue;
    }
  }

  public function getConfiguration() {
    return (array) $this->data;
  }

  public function getValue($key, $defaultValue = null) {
    if ($this->hasKey($key)) {
      return $this->data[$key];
    } else {
      return $defaultValue;
    }
  }

  public function getKeyByValue($value) {
    return array_search($value, $this->data);
  }

  public function hasKey($key) {
    return isset($this->data[$key]);
  }

  public function getArrayValue($key) {
    return (array) $this->getValue($key);
  }

  public function getDoubleValue($key) {
    return (double) $this->getValue($key);
  }

  public function getIntValue($key) {
    return intval($this->getValue($key));
  }

  public function getStringValue($key) {
    return (string) $this->getValue($key);
  }

  public function setValue($key, $value, $save = true) {
    $settingModelAdapter = new Amhsoft_Setting_Model_Adapter();
    if (array_key_exists($key, (array)$this->data)) {
      $settingModelAdapter->where('entity=?', $this->entity, PDO::PARAM_STR);
      $settingModelAdapter->where('settingkey = ?', $key, PDO::PARAM_STR);
      $model = $settingModelAdapter->fetch()->fetch();
      if ($model instanceof Amhsoft_Setting_Model) {
        $model->setSettingvalue($value);
      }
    } else {
      $model = new Amhsoft_Setting_Model();
      $model->entity = $this->entity;
      $model->settingkey = $key;
      $model->settingvalue = $value;
    }
    $settingModelAdapter->save($model);
    $this->refresh();
  }

}

class Amhsoft_Setting_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $settingkey;
  public $settingvalue;
  public $entity;

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getSettingkey() {
    return $this->settingkey;
  }

  public function getSettingvalue() {
    return $this->settingvalue;
  }

  public function getEntity() {
    return $this->entity;
  }

  public function setSettingkey($settingkey) {
    $this->settingkey = $settingkey;
  }

  public function setSettingvalue($settingvalue) {
    $this->settingvalue = $settingvalue;
  }

  public function setEntity($entity) {
    $this->entity = $entity;
  }

}

class Amhsoft_Setting_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

  public function __construct() {
    $this->table = 'setting';
    $this->className = 'Amhsoft_Setting_Model';
    $this->map = array('id' => 'id', 'settingkey' => 'settingkey', 'entity' => 'entity');
    parent::__construct();
  }

  public function getJoinColumn() {
    return 'setting_id';
  }

  public function getLangMap() {
    return array('settingvalue' => 'settingvalue');
  }

  public function getLanguageTableName() {
    return 'setting_lang';
  }

}

?>
