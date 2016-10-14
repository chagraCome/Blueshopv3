<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Model.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package Semi
 * @copyright  2005-2013 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Data_Db_Model_Semi_Eav_Model{
  
  protected $attributes = array();
  
  /**
   * Gets product attributes
   * @return array attributes
   */
  public function getAttributes() {
    if (empty($this->attributes)) {
      $entitySetAdapter = new Eav_Set_Model_Adapter();
      $this->set = $entitySetAdapter->fetchById($this->entity_set_id);
      if ($this->set instanceof Eav_Set_Model) {
        $this->attributes = $this->set->getAttributes();
      }
    }
    return $this->attributes;
  }
  
  
  public function getAttributeValue($name) {
    $attributes = $this->getAttributes();
    foreach ($attributes as $attr) {
      if ($attr->getName() == $name) {
        return $attr->getFrontEndComponent($this)->Value;
      }
    }
    return null;
  }
  
}
