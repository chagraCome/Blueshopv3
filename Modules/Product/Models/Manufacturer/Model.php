<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Product
 * @copyright  2005-201 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is 4a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Product_Manufacturer_Model implements Amhsoft_Data_Db_Model_Interface {

    public $id;
    public $name;
    public $home_page;
    public $logosrc;

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
     * @return Product_Manufacturer_Model
     * */
    public function setId($id) {
        $this->id = $id;
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
     * @return Product_Manufacturer_Model
     * */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets home_page.
     * @return 
     * */
    public function getHomePage() {
        return $this->home_page;
    }

    /**
     * Set home_page.
     * @param  home_page 
     * @return Product_Manufacturer_Model
     * */
    public function setHomePage($home_page) {
        $this->home_page = $home_page;
        return $this;
    }

    public function getPictureSrc() {
        if (@file_exists("media/product/manufacturer/" . $this->id . ".jpg")) {
            return "media/product/manufacturer/" . $this->id . ".jpg";
        } else {
            return null;
        }
    }

}

?>
