<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: TagXHR.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Revision: 102 $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedBy: a.cherif $
 * @package    defaultPackage
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    <unknown>
 */

/**
 * TagXHR textarea acomponent
 * @author Amir Cherif
 */
class Amhsoft_TextArea_TagXHR_Control extends Amhsoft_TextArea_Control {

  /**
   * Construct component
   * @param string $name id-name of component
   */
  public function __construct($name, $label = null) {
    parent::__construct($name);
    $this->Id = 'tagxhr';
    $this->Label = $label;
  }


  /**
   * Draw/Render components
   * @return string output like HTML
   */
  public function Draw() {
    return parent::Draw();
  }

}
