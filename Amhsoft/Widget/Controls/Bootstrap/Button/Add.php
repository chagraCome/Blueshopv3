<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Add.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * add button component
 * @author Amir Cherif
 */
class Amhsoft_Bootstrap_Button_Add_Control extends Amhsoft_Button_Add_Control {

  /**
   * Construct component add button
   * @param Controller $event_object event/controller object
   * @param string $event_method event method name
   */
  public function __construct(Controller $event_object, $event_method, $name='top_navi_button_add') {
    parent::__construct($name, _t('Add'));
    $this->Class = 'btn btn-success';
    $this->onClick->registerEvent($event_object, $event_method);
  }

}

