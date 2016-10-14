<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Eav_Backend_Attributeset_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Product_Set_Form $entitySetForm */
  protected $entitySetForm;

  /** @var Product_Set_Model $entitySetModel */
  protected $entitySetModel;
  protected $entity;

  /**
   * Initialize Controller
   * @throws Exception
   */
  public function __initialize() {
   
    $entityid = $this->getRequest()->get('entity');
    $entityAdapter = new Eav_Entity_Model_Adapter();
    $this->entity = $entityAdapter->fetchById($entityid);
    if(!$this->entity instanceof Eav_Entity_Model){
      throw new Exception('no entity found');
    }
    
    
    $this->entitySetForm = new Eav_Set_Form('entitySetForm_form', 'POST');
    $this->entitySetModel = new Eav_Set_Model();
    $this->getView()->setMessage(_t('Create new Product Set'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $this->entitySetForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->entitySetForm->isSend()) {
      if ($this->entitySetForm->isValid()) {
	$this->entitySetForm->DataBinding = $this->entitySetModel;
	$entitySetModelAdapter = new Eav_Set_Model_Adapter();
	$this->entitySetModel = $this->entitySetForm->getDataBindItem();
        $this->entitySetModel->entity_id = $this->getRequest()->get('entity');
	$entitySetModelAdapter->save($this->entitySetModel);
	$this->handleSuccess();
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Handle success.
   */
  protected function handleSuccess() {
    $this->getRedirector()->go('admin.php?module=eav&page=attributeset-modify&ret=true&entity=' . $this->getRequest()->get('entity') . '&id=' . $this->entitySetModel->getId());
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->entitySetForm);
    $this->show();
  }

}

?>
