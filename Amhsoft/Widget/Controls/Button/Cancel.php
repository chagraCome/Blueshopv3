<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Cancel.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * cancel button component
 * @author Amir Cherif
 */
class Amhsoft_Button_Cancel_Control extends Amhsoft_Button_Submit_Control {

  /**
   * Construct component cancel button
   * @param Controller $event_object event/controller object
   * @param string $event_method event method name
   */
  public function __construct($event_object, $event_method) {
    parent::__construct('top_navi_button_cancel', _t('Cancel'));
    $this->Class = 'Button Cancel';
    $this->onClick->registerEvent($event_object, $event_method);
  }

}
