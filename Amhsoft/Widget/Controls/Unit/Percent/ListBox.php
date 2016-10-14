<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: ListBox.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Revision: 102 $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedBy: a.cherif $
 * @package    defaultPackage
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    <unknown>
 */
class Amhsoft_Unit_Percent_ListBox_Control extends Amhsoft_ListBox_Control {

  public $Step = 10;
  

  public function getStep() {
    return $this->Step;
  }

  public function setStep($Step) {
    $this->Step = $Step;
  }


  public function Render() {
    $ds = array();
    for($i = 0; $i < $this->Step+1; $i++){
      $ds[] = array('id' => $i*$this->Step, 'name' => $i*$this->Step.'%');
    }
    $this->DataSource  = new Amhsoft_Data_Set($ds);
    $this->DataBinding = new Amhsoft_Data_Binding($this->Name, 'id', 'name', $this->Value);
    return parent::Render();
  }
  
  
}

?>
