<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Print.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */

class Amhsoft_Button_Print_Control extends Amhsoft_Button_Submit_Control{
  /**
   * Construct component print button
   * @param Controller $event_object event/controller object
   * @param string $event_method event method name
   */
  public function __construct(Controller $event_object, $event_method, $name='top_navi_button_print') {
    parent::__construct($name, _t('Print'));
    $this->Class = 'Button Print';
    $this->onClick->registerEvent($event_object, $event_method);
  }

}
?>
