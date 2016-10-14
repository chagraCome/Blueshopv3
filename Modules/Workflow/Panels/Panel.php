<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: index.class.php 879 2011-06-20 04:31:08Z Montasser $
 * $Rev: 879 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2011-06-20 06:31:08 +0200 (Mo, 20. Jun 2011) $
 * $Author: Montasser $
 */
class Workflow_Panel extends Amhsoft_Widget_Panel {

  public function __construct($label = null, $tagName = "fieldset") {
    parent::__construct($label, $tagName);
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $layout = new Amhsoft_Grid_Layout(1, Amhsoft_Grid_Layout::PREPAPPEND);
    $panel = new Amhsoft_Widget_Panel(_t('Workflow Details'));
    $panel->setLayout($layout);

    
    $nameLabel = new Amhsoft_Label_Control(_t('Name'), new Amhsoft_Data_Binding("name"));
    $eventNameLabel = new Amhsoft_Label_Control(_t('Event Name'), new Amhsoft_Data_Binding("eventname"));

    $panel->addComponent($nameLabel);
    $panel->addComponent($eventNameLabel);
    $panel->addComponent(new Amhsoft_Label_Control(_t('Model Name'), new Amhsoft_Data_Binding('modelname')));
    $panel->addComponent(new Amhsoft_YesNo_Image_Control(_t('State'), new Amhsoft_Data_Binding('state')));
    $this->addComponent($panel);
  }

}

?>
