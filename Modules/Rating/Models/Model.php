<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 489 2016-05-17 10:34:28Z imen.amhsoft $
 * $Rev: 489 $
 * @package    Rating
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-05-17 12:34:28 +0200 (mar., 17 mai 2016) $
 * $Author: imen.amhsoft $
 */
class Rating_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $entity_id;
  public $entity_class;
  public $rate = 0;
  public $rate2 = 0;
  public $rate3 = 0;
  public $rate4 = 0;
  public $name;
  public $comment;
  public $rate_date_time;
  public $ip;
  public $state;


  /**
   * Gets id.
   * @return 
   * */
  public function getId() {
    return $this->id;
  }

  /**
   * Set id.
   * @param  id 
   * @return 
   * */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets entity.
   * @return 
   * */
  public function getEntityId() {
    return $this->entity_id;
  }

  /**
   * Set entity.
   * @param  entity 
   * @return 
   * */
  public function setEntityId($entityId) {
    $this->entity_id = $entityId;
    return $this;
  }

  /**
   * Gets entity_class.
   * @return 
   * */
  public function getEntityClass() {
    return $this->entity_class;
  }

  /**
   * Set entity_class.
   * @param  entity_class 
   * @return 
   * */
  public function setEntityClass($entity_class) {
    $this->entity_class = $entity_class;
    return $this;
  }

  /**
   * Gets rate.
   * @return 
   * */
  public function getRate() {
    return $this->rate;
  }

  /**
   * Set rate.
   * @param  rate 
   * @return 
   * */
  public function setRate($rate) {
    $this->rate = $rate;
    return $this;
  }

  /**
   * Gets name.
   * @return 
   * */
  public function getName() {
    return $this->name;
  }

  /**
   * Set name.
   * @param  name 
   * @return 
   * */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * Gets comment.
   * @return 
   * */
  public function getComment() {
    return $this->comment;
  }

  /**
   * Set comment.
   * @param  comment 
   * @return 
   * */
  public function setComment($comment) {
    $this->comment = $comment;
    return $this;
  }

  /**
   * Gets rate_date_time.
   * @return 
   * */
  public function getRateDateTime() {
    return $this->rate_date_time;
  }

  /**
   * Set rate_date_time.
   * @param  rate_date_time 
   * @return 
   * */
  public function setRateDateTime($rate_date_time) {
    $this->rate_date_time = $rate_date_time;
    return $this;
  }

  /**
   * Gets ip.
   * @return 
   * */
  public function getIp() {
    return $this->ip;
  }

  /**
   * Set ip.
   * @param  ip 
   * @return 
   * */
  public function setIp($ip) {
    $this->ip = $ip;
    return $this;
  }

  /**
   * Get Rate Component
   * @return \Amhsoft_Rating_Control
   */
  public function getRateComponent($name = 'rate', $label = 'Rate') {
    $rateControl = new Amhsoft_Rating_Control($name . $this->getId(), _t($label));
    $rateControl->Value = $this->{$name};
    $rateControl->Disabled = true;
    $rateControl->Label = _t($label);
    return $rateControl;
  }
  
    public function getRateComponentPrefix($prefix, $name = 'rate', $label = 'Rate') {
    $rateControl = new Amhsoft_Rating_Control($prefix. $name . $this->getId(), _t($label));
    $rateControl->Value = $this->{$name};
    $rateControl->Disabled = true;
    $rateControl->Label = _t($label);
    return $rateControl;
  }
  /**
   * Get State
   * @return type
   */
  public function getState() {
    return $this->state;
  }

  /**
   * Set State
   * @param type $state
   */
  public function setState($state) {
    $this->state = $state;
  }
  
   public function __get($name) {

        if ($name == 'link') {
            return "<a class='details' href='admin.php?module=product&page=product-detail&id=" . $this->getEntityId() . "' > "._t('Commented Product')." </a>";
        }
    }

}

?>