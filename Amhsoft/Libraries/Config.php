<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Config.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */

class Amhsoft_Config extends Amhsoft_Config_Abstract {

    /** @var Amhsoft_Config_Abstract $adapter */
    protected $adapter;

    
    public function __construct($object = null) {
        if($object == null){
            return;
        }
        if($object instanceof Amhsoft_Config_Abstract){
            $this->adapter = $object;
        }
        
        if(is_array($object)){
            $this->adapter = new Amhsoft_Config_Array_Adapter($object);
        }
        
        if(is_string($object)){
            if(preg_match("/.ini$/i", $object)){
                $this->adapter = new Amhsoft_Config_Ini_Adapter($object);
            }
            
            if(preg_match("/.xml$/i", $object)){
                $this->adapter = new Amhsoft_Config_Xml_Adapter($object);
            }
            
             if(preg_match("/.po$/i", $object)){
                $this->adapter = new Amhsoft_Config_Po_Adapter($object);
            }
            
            
        }
    }
    
    public function setAdapter(Amhsoft_Config_Abstract $adapter) {
        $this->adapter = $adapter;
    }

    /**
     * Gets adapter
     * @return Amhsoft_Config_Adapter adapter
     */
    public function getAdapter(){
        return $this->adapter;
    }
    
    public function getArrayValue($key) {
        return $this->adapter->getArrayValue($key);
    }

    public function getConfiguration() {
        return $this->adapter->getConfiguration();
    }

    public function getDoubleValue($key) {
        return $this->adapter->getDoubleValue($key);
    }

    public function getIntValue($key) {
        return $this->adapter->getIntValue($key);
    }

    public function getStringValue($key) {
        return $this->adapter->getStringValue($key);
    }

    public function getValue($key, $defaultValue = null) {
        return $this->adapter->getValue($key, $defaultValue);
    }

    public function hasKey($key) {
        return $this->adapter->hasKey($key);
    }
    
    public function __get($key) {
        return $this->adapter->getValue($key);
    }

}

?>
