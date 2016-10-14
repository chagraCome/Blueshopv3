<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cms
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cms_Site_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $name;
  public $state;
  public $title;
  public $root;
  public $width;
  public $style;
  public $require_login;
  public $description;
  public $homepage;
  public $file;
  public $defaultsite;

  /**
   * Gest CmsSite id.
   * @return type Integer $id
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets CmsSite id.
   * @param Integer $id
   * @return CmsSiteModel 
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets CmsSite name.
   * @return String $name 
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Sets CmsSite name.
   * @param String $name
   * @return CmsSiteModel 
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * Gets CmsSite state.
   * @return Integer $state
   */
  public function getState() {
    return $this->state;
  }

  public function setState($state) {
    $this->state = $state;
    return $this;
  }

  /**
   * Gets HomePage
   * @return type
   */
  public function getHomepage() {
    return $this->homepage;
  }

  /**
   * Set HomePage
   * @param type $homepage
   */
  public function setHomepage($homepage) {
    $this->homepage = $homepage;
  }

  public function __toString() {
    return $this->name;
  }

  /**
   * Get Default Site.
   * @return CmsSiteModel $defaultsite
   */
  public static function getDefault() {
    $cmsSiteModelAdapter = new Cms_Site_Model_Adapter();
    $cmsSiteModelAdapter->where('defaultsite = 1');
    return $cmsSiteModelAdapter->fetch()->fetch();
  }

  /**
   * Gets Default Site
   * @return type
   */
  public function getDefaultSite() {
    return $this->defaultsite;
  }

  /**
   * Set Default Site
   * @param type $defaultsite
   */
  public function setDefaultSite($defaultsite) {
    $this->defaultsite = $defaultsite;
  }

  /**
   * Check if default site
   * @return type
   */
  public function isDefaultSite() {
    return (boolean) $this->defaultsite == true;
  }

}

?>
