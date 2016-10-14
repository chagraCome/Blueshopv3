<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Panel.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Comment
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Comment_Panel extends Amhsoft_Widget_Panel {

  /**
   * Panel Construct
   * @param type $label
   * @param type $tagName
   */
  public function __construct($label = null, $tagName = 'fieldset') {
    parent::__construct($label, $tagName);
    $this->initializeComponents();
  }

  /**
   * Initialize Panel Components
   */
  public function initializeComponents() {
    $subjectLabel = new Amhsoft_Label_Control(_t('Subject'), new Amhsoft_Data_Binding('subject'));
    $insertAtDateControl = new Amhsoft_Date_Time_Label_Control(_t('Insert Date'), new Amhsoft_Data_Binding('insertat'));
    $authorNameLabel = new Amhsoft_Label_Control(_t('Author Name'), new Amhsoft_Data_Binding('author_name'));
    $userSeen = new Amhsoft_YesNo_Text_Control(_t('User Seen'), new Amhsoft_Data_Binding('user_seen'));
    $isPublic = new Amhsoft_YesNo_Text_Control(_t('Is Public'), new Amhsoft_Data_Binding('public'));
    $publicSeen = new Amhsoft_YesNo_Text_Control(_t('Public Seen'), new Amhsoft_Data_Binding('public_seen'));
    $commentLabel = new Amhsoft_Label_Control(_t('Comment'), new Amhsoft_Data_Binding('comment'));
    $this->addComponent($subjectLabel);
    $this->addComponent($insertAtDateControl);
    $this->addComponent($authorNameLabel);
    $this->addComponent($userSeen);
    $this->addComponent($isPublic);
    $this->addComponent($publicSeen);
    $this->addComponent($commentLabel);
  }

}

?>
