<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Details.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_Backend_User_Details_Controller extends Amhsoft_System_Web_Controller {

  /** @var User_User_Panel $userUserPanel */
  protected $userUserPanel;

  /** @var User_User_Model $userUserModel */
  protected $userUserModel;

  /**
   * Initialize controller
   */
  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->userUserPanel = new User_User_Panel();
     
    $userUserModelAdapter = new User_User_Model_Adapter();
    $this->userUserModel = $userUserModelAdapter->fetchById($id);
    if (!$this->userUserModel instanceof User_User_Model) {
      Amhsoft_Log::error("User not found ", array($this->userUserModel, $id));
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    
    $this->userUserPanel->picture->setSrc($this->userUserModel->getImage());
    
    $this->getView()->setMessage(_t('User Profile'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->userUserPanel->setDataSource(new Amhsoft_Data_Set($this->userUserModel));
    $this->userUserPanel->Bind();
    $this->getView()->assign('panel', $this->userUserPanel);
    $this->show();
  }

}

?>
