<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class Amhsoft_Data_Db_Model_Multilanguage_EAV_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

    private static $allowedEntities = array('product');

    public function save(Amhsoft_Data_Db_Model_Interface $object, $cascade = false) {


        $e = parent::save($object, $cascade);
        $set = $object->getEntitySet();

        if (!$set instanceof Eav_Set_Model) {
            self::flushEntityPivotView($this->getCleanTableName(), false, $object->getId());
            return $e;
        }
        $attributes = $set->getAttributes();
        if (count($attributes) == 0) {
            self::flushEntityPivotView($this->getCleanTableName(), false, $object->getId());
            return $e;
        }
        foreach ($attributes as $attribute) {
            $attributeValueAdapter = new Eav_Attribute_Value_Model_Adapter();
            $attributeValueAdapter->where('entity_attribute_id = ?', $attribute->getId());
            $attributeValueAdapter->where('entity_id  = ?', $object->getId());
            $result = $attributeValueAdapter->fetch();
            if ($result->rowCount() == 0) {
                $attributeValue = new Eav_Attribute_Value_Model();
            } else {
                $attributeValue = $result->fetch();
            }
            $attributeValue->setEntityAttributeId($attribute->getId());
            $attributeValue->setEntityId($object->getId());
            $attributeValue->setValue($object->{$attribute->getName()});
            $available_lang = Amhsoft_System::getAvailableLang();
            $attributeValueAdapter->save($attributeValue);
// $object->{$attribute->getName()} = $attributeValue->getId();
//$e = parent::save($object, $cascade);
            if (is_numeric($object->{$attribute->getName()}) || is_numeric('0x' . $object->{$attribute->getName()})) {
                foreach ((array) $available_lang as $name => $lang) {
                    $attributeValueAdapter->setCurrentLang($lang);
                    $attributeValueAdapter->save($attributeValue);
                }
            }
        }

        self::flushEntityPivotView($this->getCleanTableName(), false, $object->getId());

        return $e;
    }

    public function fetchById($id) {
        $object = parent::fetchById($id);
        if ($object instanceof Amhsoft_Data_Db_Model_Multilanguage_EAV_Model) {
            $object->retrieveAttributesValues();
        }
        return $object;
    }

    private function getCleanTableName() {
        $clean_table = str_replace("`", '', $this->table);
        return $clean_table;
    }

    public function deleteById($id) {
        parent::deleteById($id);
        Amhsoft_Database::getInstance()->exec("DELETE FROM entity_attribute_value WHERE entity_id = $id");
        self::flushEntityPivotView($this->getCleanTableName(), false, 0, $id);
    }

    public static function isEavEntity($entity) {
        return in_array($entity, self::$allowedEntities);
    }

    public static function flushEntityPivotView($table, $recreateTables = true, $updateentityid = 0, $deleteentityid = 0) {

        if (!self::isEavEntity($table)) {
            throw new Exception($table . ' is not a eav entity');
        }
        $productAttributeAdapter = new Eav_Attribute_Model_Adapter();

        $collection = $productAttributeAdapter->fetch();
        $sql_attributes = array();
        foreach ($collection as $attribute) {
            if ($attribute->getSearchable()) {
                $name = $attribute->getName();
                $sql_attributes[] = "MAX(IF(entity_attribute.name = '$name', entity_attribute_value_lang.value, NULL)) as '$name'";
            }
        }

        $sql_attributes_string = implode(', ', $sql_attributes);




        if ($recreateTables == true) {
            self::createTempTables($table, $sql_attributes_string);
        }

        if ($updateentityid > 0) {

            self::syncronizeEntity($table, $sql_attributes_string, $updateentityid);
        }

        if ($deleteentityid > 0) {
            self::syncronizeEntity($table, $sql_attributes_string, 0, $deleteentityid);
        }
    }

    protected static function syncronizeEntity($table, $sql_attributes_string, $entityid, $deleteentityid = false) {
        $sql_attributes_string = $sql_attributes_string ? ', ' . $sql_attributes_string : null;


        $langs = Amhsoft_System::getAvailableLang();
        $sqls = array();
        foreach ($langs as $lang_name => $lang_symb) {
            $lang_symb = strtolower($lang_symb);

            if ($deleteentityid > 0) {
                $sqls[] = "DELETE FROM " . $table . "_pivot_$lang_symb WHERE id = $deleteentityid;";
            } else {
                $sqls[] = "DELETE FROM " . $table . "_pivot_$lang_symb WHERE id = " . $entityid;
                $sqls[] = "INSERT INTO " . $table . "_pivot_$lang_symb SELECT " . $table . ".*, " . $table . "_lang.title, " . $table . "_lang.description ," . $table . "_lang.lang, " . $table . "_lang.short_description
$sql_attributes_string
FROM `" . $table . "`
LEFT JOIN " . $table . "_lang ON " . $table . ".id = " . $table . "_lang." . $table . "_id
LEFT JOIN entity_attribute_value ON " . $table . ".id = entity_attribute_value.entity_id
LEFT JOIN entity_attribute_value_lang ON entity_attribute_value.id = entity_attribute_value_lang.entity_attribute_value_id
LEFT JOIN entity_attribute ON entity_attribute.id = entity_attribute_value.entity_attribute_id
WHERE (entity_attribute_value_lang.lang = '$lang_symb' OR entity_attribute_value_lang.lang IS NULL)
AND " . $table . "_lang.lang = '$lang_symb' AND " . $table . ".id = $entityid
group by " . $table . ".id;
";
            }
        }

        $db = Amhsoft_Database::newInstance();
        $db->beginTransaction();
        try {
            //echo $sql_tmp_en;
            foreach ($sqls as $sql) {
                $db->exec($sql);
            }


            $db->commit();
            return true;
        } catch (Exception $e) {

            $db->rollBack();
            return false;
        }
    }

    protected static function createTempTables($table, $sql_attributes_string) {

        $sql_attributes_string = $sql_attributes_string ? ', ' . $sql_attributes_string : null;


        $langs = Amhsoft_System::getAvailableLang();
        $sqls = array();
        foreach ($langs as $lang_name => $lang_symb) {
            $lang_symb = strtolower($lang_symb);


            $sql_tmp_en = "DROP TABLE IF EXISTS " . $table . "_pivot_$lang_symb;
CREATE TABLE " . $table . "_pivot_$lang_symb as SELECT " . $table . ".*, " . $table . "_lang.title, " . $table . "_lang.description, " . $table . "_lang.lang, " . $table . "_lang.short_description
$sql_attributes_string
FROM `" . $table . "`
LEFT JOIN " . $table . "_lang ON " . $table . ".id = " . $table . "_lang." . $table . "_id
LEFT JOIN entity_attribute_value ON " . $table . ".id = entity_attribute_value.entity_id
LEFT JOIN entity_attribute_value_lang ON entity_attribute_value.id = entity_attribute_value_lang.entity_attribute_value_id
LEFT JOIN entity_attribute ON entity_attribute.id = entity_attribute_value.entity_attribute_id
where (entity_attribute_value_lang.lang = '$lang_symb' OR entity_attribute_value_lang.lang IS NULL)
AND " . $table . "_lang.lang = '$lang_symb'
group by " . $table . ".id;
";
            $sql_tmp_en .= "ALTER TABLE `" . $table . "_pivot_$lang_symb` ADD INDEX ( `price` );
";
            $sql_tmp_en .= "ALTER TABLE `" . $table . "_pivot_$lang_symb` ADD INDEX ( `id` );
";
            $sql_tmp_en .= "ALTER TABLE `" . $table . "_pivot_$lang_symb` ADD INDEX ( `categorie_id` );
";
            $sql_tmp_en .= "ALTER TABLE `" . $table . "_pivot_$lang_symb` ADD INDEX ( `online` );
";
            $sql_tmp_en .= "ALTER TABLE `" . $table . "_pivot_$lang_symb` ADD INDEX ( `entity_set_id` );
";
            $sqls[] = $sql_tmp_en;
        }


        $db = Amhsoft_Database::newInstance();
        $db->beginTransaction();
        try {
            //echo $sql_tmp_en;
            foreach ($sqls as $sql) {
                $db->exec($sql);
            }
            $db->commit();
            return true;
        } catch (Exception $e) {
            $db->rollBack();

            return false;
        }
    }

}

?>
