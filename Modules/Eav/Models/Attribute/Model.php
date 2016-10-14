<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Eav_Attribute_Model implements Amhsoft_Data_Db_Model_Interface {

    public $id;
    public $entity_attribute_id;
    public $entity_id;
    public $value;
    public $name;
    public $defaultvalue;
    public $searchable;
    public $validator;
    public $required;
    public $datasources = array();
    public $entityid;

    /**
     * Gets Default Value
     * @return type
     */
    public function getDefaultvalue() {
        return $this->defaultvalue;
    }

    /**
     * Set Default Value
     * @param type $defaultvalue
     */
    public function setDefaultvalue($defaultvalue) {
        $this->defaultvalue = $defaultvalue;
    }

    /*
     * Get Searchable
     */

    public function getSearchable() {
        return $this->searchable;
    }

    /**
     * Checck if Searchable
     * @return type
     */
    public function isSearchable() {
        return $this->searchable;
    }

    /**
     * Set Searchable
     * @param type $searchable
     */
    public function setSearchable($searchable) {
        $this->searchable = $searchable;
    }

    /**
     * Gets Validato
     * @return type
     */
    public function getValidator() {
        return $this->validator;
    }

    /*
     * Set Validatir
     */

    public function setValidator($validator) {
        $this->validator = $validator;
    }

    /**
     * Get Required
     * @return type
     */
    public function getRequired() {
        return $this->required;
    }

    public function setRequired($required) {
        $this->required = $required;
    }

    /**
     * Gets Name
     * @return type
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set Name
     * @param type $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Sets id.
     * @param <type> id
     * @return ProductAttributeValue
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets id.
     * @return <type> id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Sets entity_attribute_id.
     * @param <type> entity_attribute_id
     * @return ProductAttributeValue
     */
    public function setEntityAttributeId($entity_attribute_id) {
        $this->entity_attribute_id = $entity_attribute_id;
        return $this;
    }

    /**
     * Gets entity_attribute_id.
     * @return <type> entity_attribute_id
     */
    public function getEntityAttributeId() {
        return $this->entity_attribute_id;
    }

    /**
     * Sets entity_id.
     * @param <type> entity_id
     * @return ProductAttributeValue
     */
    public function setEntityId($entity_id) {
        $this->entity_id = $entity_id;
        return $this;
    }

    /**
     * Gets entity_id.
     * @return <type> entity_id
     */
    public function getEntityId() {
        return $this->entity_id;
    }

    /**
     * Set value
     * @param type $value
     */
    public function setValue($value) {
        $this->value = $value;
    }

    /**
     * Get Label
     * @return type
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Set Label
     * @param type $label
     */
    public function setLabel($label) {
        $this->label = $label;
    }

    /**
     * Get DataSource
     * @return type
     */
    public function getDatasource() {
        return $this->datasource;
    }

    public function getEntityAttributeTypeBackendId() {
        return $this->entity_attribute_type_backend_id;
    }

    public function getEntityAttributeTypeBackendClassName() {
        return get_class(Amhsoft_Abstract_Control::Create('comp', $this->entity_attribute_type_backend_id));
    }

    public function setEntityAttributeTypeBackendId($entity_attribute_type_backend_id) {
        $this->entity_attribute_type_backend_id = $entity_attribute_type_backend_id;
    }

    public function getDatasources() {
        return $this->datasources;
    }

    public function setDatasource($datasource) {
        $this->datasource = $datasource;
    }

    /**
     * 
     * @return type
     */
    public function getErrormessage() {
        return $this->errormessage;
    }

    /**
     * 
     * @param type $errormessage
     */
    public function setErrormessage($errormessage) {
        $this->errormessage = $errormessage;
    }

    /**
     * Gets Entity
     * @return Eav_Entity_Model
     */
    public function getEntity() {
        $entityAdapter = new Eav_Entity_Model_Adapter();
        $entity = $entityAdapter->fetchById($this->entity_id);
        if (!$entity instanceof Eav_Entity_Model) {
            throw new Exception('no entity found');
        }
        return $entity;
    }

    /**
     * $productModel->warrantly = 'yes'
     * @param type $value
     * @return int
     */
    public function getResolvedValue($value) {
        if ($this->entity_attribute_type_backend_id == 4) { //checkbox
            if (strtolower($value) == 'yes' || $value == 'نعم') {
                return 1;
            }
        }
        if ($this->entity_attribute_type_backend_id == 2) { //listbox
            foreach ($this->datasources as $src) {
                if (strtolower(trim($src->getValue())) == strtolower(trim($value))) {
                    return $src->getId();
                }
            }
            $entityAttributeDataSource = new Eav_Attribute_DataSource_Model();
            $entityAttributeDataSource->setEntity_attribute_id($this->id);
            $entityAttributeDataSource->setValue($value);
            $entityAttributeDataSourceAdapter = new Eav_Attribute_DataSource_Model_Adapter();
            $entityAttributeDataSourceAdapter->save($entityAttributeDataSource);
            return $entityAttributeDataSource->getId();
        }
        if ($this->entity_attribute_type_backend_id == 23) { //listbox
            foreach ($this->datasources as $src) {
                if (strtolower(trim($src->getValue())) == strtolower(trim($value))) {
                    return $src->getId();
                }
            }
        }
        return $value;
    }

    /**
     * 
     * @param type $entityid
     * @return null
     */
    public function getValue($entityid) {
        $attributeValueAdapter = new Eav_Attribute_Value_Model_Adapter();
        $attributeValueAdapter->where('entity_attribute_id = ?', $this->id);
        $attributeValueAdapter->where('entity_id  = ?', $entityid);
        $result = $attributeValueAdapter->fetch();
        if ($result->rowCount() == 0) {
            return null;
        } else {
            return $result->fetch()->value;
        }
    }

    /**
     * 
     * 
     * 
     * used-------
     * 
     * 
     * 
     * Gets control component.
     * ControlComponent $control
     */
    public function getControlComponent($entitytablename, $css_class = null , $width = 300) {
      
        $control = Amhsoft_Abstract_Control::Create($this->getName(), $this->entity_attribute_type_backend_id);
       //var_dump($control);      exit();
	if ($control instanceof Amhsoft_Unit_Color_Input_Control) {
            $sql = "SELECT DISTINCT(" . $control->getName() . ") as d FROM " . $entitytablename . "_conf WHERE " . $control->getName() . " IS NOT NULL";
            $re = Amhsoft_Database::getInstance()->query($sql);
            while ($color = $re->fetchColumn()) {
                $control->addAvailableColor($color);
            }
        }
	if($control instanceof Amhsoft_Label_Control){
	  $control->setValue($this->getLabel());
	}
        $control->setLabel($this->getLabel());
        $control->setIdentification($this->id);
        $control->setRequired($this->getRequired());
        $control->addValidator($this->getValidator());
        $control->setWidth($width);
        $control->setClass($css_class);
        if ($control instanceof Amhsoft_YesNo_ListBox_Control) {
            $control->DataBinding->Value = $this->getName();
            return $control;
        }
        if ($control instanceof Amhsoft_ListBox_Control && $control->getRequired() == false) {
            $control->WithNullOption = true;
        }
        $control->DataBinding = new Amhsoft_Data_Binding($this->getName());
        if ($this->entity_attribute_type_backend_id == 2) {
            $control->DataBinding = new Amhsoft_Data_Binding($this->getName(), 'id', 'value');
            $control->DataSource = new Amhsoft_Data_Set($this->datasources); // new Amhsoft_Data_Set(explode("\n", $this->getDatasource()));
        }
        //Listbox multipl
        if ($this->entity_attribute_type_backend_id == 23) {
            $control->DataBinding = new Amhsoft_Data_Binding($this->getName(), 'id', 'value');
            $control->DataSource = new Amhsoft_Data_Set($this->datasources); // new Amhsoft_Data_Set(explode("\n", $this->getDatasource()));
        }
        return $control;
    }

    /**
     * 
     * @param type $dataSource
     * @return type
     */
    public function getFrontEndComponent($dataSource) {
        $control = Amhsoft_Abstract_Control::CreateFrontEnd($this->getName(), $this->entity_attribute_type_backend_id);
        $control->setLabel($this->getLabel());
        if ($this->entity_attribute_type_backend_id == 2) {
            $control->setValue($this->getValueBySourceId($dataSource->{$this->getName()}));
        } else {
            $control->setValue($dataSource->{$this->getName()});
        }
        return $control;
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    protected function getValueBySourceId($id) {
        foreach ($this->datasources as $source) {
            if ($source->getId() == $id) {
                return $source->getValue();
            }
        }
    }

    /**
     * Create Attribute In config Table
     * @param type $entityName
     */
    public function createAttributeInConfTable() {

        $entity = $this->getEntity();
        $tableName = $entity->table;


        $defaultValue = $this->getDefaultvalue() ? "DEFAULT '" . $this->getDefaultvalue() . "'" : '';

        $langTable = false;
        $type = 'INT';
        $className = $this->getEntityAttributeTypeBackendClassName();

        switch ($className) {
            case 'Amhsoft_Input_Control':
                $type = 'VARCHAR (255)';
                $langTable = true;
                break;
            case 'Amhsoft_Unit_Color_Input_Control':
                $type = 'VARCHAR(6)';
                break;
            case 'Amhsoft_TextArea_Control':
                $type = 'TEXT';
                $langTable = true;
                break;
            case 'Amhsoft_TextArea_Wysiwyg_Control':
                $type = 'LONGTEXT';
                $langTable = true;
                break;
            case 'Amhsoft_YesNo_ListBox_Control':
                $type = 'BOOLEAN';
                break;
            case 'Amhsoft_Date_Input_Control':
                $type = 'DATE';
                break;
            case 'Amhsoft_Date_Time_Input_Control':
                $type = 'DATETIME';
                break;
            case 'Amhsoft_Currency_Input_Control':
                $type = 'DOUBLE( 12, 3 )';
                break;
            case 'Amhsoft_Currency_Input_Control':
                $type = 'DOUBLE( 12, 3 )';
                break;
            default:
                $type = 'INT';
                break;
        }

        if ($entity->getTypeof() == 'Amhsoft_Data_Db_Model_Multilanguage_Semi_Eav_Adapter') {
            if ($langTable == true) {
                $tableName = $tableName . '_conf_lang';
                $add_column_sql = "ALTER TABLE `$tableName` ADD `" . $this->getName() . "` $type NULL $defaultValue ;";
                Amhsoft_Database::getInstance()->exec($add_column_sql);
                return;
            }
        }
        $tableName = $tableName . '_conf';
        $add_column_sql = "ALTER TABLE `$tableName` ADD `" . $this->getName() . "` $type NULL $defaultValue ;";
        Amhsoft_Database::getInstance()->exec($add_column_sql);
    }

    public function isString() {
        $string_array = array(1, 6, 7, 8); //input, textarea, wysiwig, label
        return in_array($this->entity_attribute_type_backend_id, $string_array);
    }

    /**
     * Remove Attribute From Config Table
     * @param type $entityName
     */
    public function removeAttributeFromConfTable() {

        $entity = $this->getEntity();
        $tableName = null;
        $langTable = false;
        $className = $this->getEntityAttributeTypeBackendClassName();
        switch ($className) {
            case 'Amhsoft_Input_Control':
                $langTable = true;
                break;
            case 'Amhsoft_TextArea_Control':
                $langTable = true;
                break;
            case 'Amhsoft_TextArea_Wysiwyg_Control':
                $langTable = true;
                break;

            default:

                break;
        }

        try {
            if ($entity->getTypeof() == 'Amhsoft_Data_Db_Model_Multilanguage_Semi_Eav_Adapter') {
                if ($langTable == true) {
                    $tableName = $entity->table . '_conf_lang';
                    $delete_column_sql = "ALTER TABLE `$tableName` DROP `" . $this->getName() . "` ;";
                    Amhsoft_Database::getInstance()->exec($delete_column_sql);
                    return;
                }
            }

            $tableName = $entity->table . '_conf';
            $delete_column_sql = "ALTER TABLE `$tableName` DROP `" . $this->getName() . "` ;";
            Amhsoft_Database::getInstance()->exec($delete_column_sql);
        } catch (Exception $e) {
            
        }
    }

}

?>
