<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Panel.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Saleorder_Comment_Panel extends Amhsoft_Widget_Panel {

  public function __construct($label = null, $tagName = 'fieldset') {
    parent::__construct($label, $tagName);
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $layout = new Amhsoft_Grid_Layout(1);
    $panelInformation = new Amhsoft_Widget_Panel(_t('Sales Order Comment Information'));
    $panelInformation->setLayout($layout);

    $author_name = new Amhsoft_Label_Control(_t('Author Name'), new Amhsoft_Data_Binding('author_name'));
    $insertAt = new Amhsoft_Label_Control(_t('Insert Date'), new Amhsoft_Data_Binding('insertat'));
    $accountSeen = new Amhsoft_YesNo_Image_Control(_t('Account Seen'), new Amhsoft_Data_Binding('account_seen'));
    $adminSeen = new Amhsoft_YesNo_Image_Control(_t('Admin Seen'), new Amhsoft_Data_Binding('admin_seen'));
    $public = new Amhsoft_YesNo_Image_Control(_t('Public'), new Amhsoft_Data_Binding('public'));

    $panelInformation->addComponent($author_name);
    $panelInformation->addComponent($insertAt);
    $panelInformation->addComponent($accountSeen);
    $panelInformation->addComponent($adminSeen);
    $panelInformation->addComponent($public);
    $panelText = new Amhsoft_Widget_Panel(_t('Comment Messgae'));
    $message = new Amhsoft_Label_Control(_t('Message'), new Amhsoft_Data_Binding('comment'));
    $panelText->addComponent($message);
    $panelInformation->addComponent($panelText);

    $this->addComponent($panelInformation);
  }

}

?>
