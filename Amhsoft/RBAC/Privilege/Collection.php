<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Collection.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_RBAC_Privilege_Collection {

    private $privileges = array();

    public function add(Amhsoft_RBAC_Privilege $privilege) {
        $this->privileges[] = $privilege;
    }

    public function addAll(array $privileges) {
        foreach ($privileges as $value) {
            $this->add($value);
        }
    }

    public function remove(Amhsoft_RBAC_Privilege $privilege){
        $index = array_search($privilege, $this->privileges);
        if($index !== FALSE){
            unset($this->privileges[$index]);
        }
    }
    
    public function getAll() {
        return $this->privileges;
    }

    public function count() {
        return count($this->privileges);
    }

    public function exists(Amhsoft_RBAC_Privilege $privilege) {
        
        foreach($this->privileges as $_privilege){
            
            if(preg_match("/\*/", $_privilege->getName())){
                $string =  $_privilege->getName();
                $regEx = str_replace('*', '[a-zA-Z_]*', $string);
                if(preg_match("/^$regEx$/i", $privilege->getName())){
                    return true;
                }
            }else{
                
                if(in_array($privilege, $this->privileges)){
                    return true;
                }
            }
        }
        
    }

    public function find($name) {
        foreach ($this->getAll() as $privilege) {
            if ($privilege->getName() == $name) {
                return $privilege;
            }
        }
        return null;
    }

    public function reset() {
        $this->privileges = array();
    }

}

?>
