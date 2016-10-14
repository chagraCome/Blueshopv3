<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Eav_Backend_Attributeset_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Product_Set_Form $entitySetForm */
  protected $entitySetForm;

  /** @var Product_Set_Model $entitySetModel */
  protected $entitySetModel;
  protected $entity;

  /**
   * Initialize Controller
   * @throws Exception
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
   $this->entity = $this->getRequest()->get('entity');
    $entityAdapter = new Eav_Entity_Model_Adapter();
    $entity = $entityAdapter->fetchById($this->entity);
    if(!$entity instanceof Eav_Entity_Model){
      throw new Exception('no entity found');
    }
    
    
    
    
    $this->entitySetForm = new Eav_Set_Form('project_form', 'POST');
    $this->getView()->setMessage(_t('Edit Entity Set'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $entitySetModelAdapter = new Eav_Set_Model_Adapter();
      $this->entitySetModel = $entitySetModelAdapter->fetchById($id);
    }
    if (!$this->entitySetModel instanceof Eav_Set_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->entitySetForm->DataSource = new Amhsoft_Data_Set($this->entitySetModel);
    $this->entitySetForm->Bind();
  }

  /**
   * Delete set view event
   */
  public function __deleteview() {
    $view_id = $this->getRequest()->getInt('view_id');
    if ($view_id > 0) {
      $productSetViewModelAdapter = new Eav_Set_View_Model_Adapter();
      $productSetViewModelAdapter->deleteById($view_id);
      $this->getRedirector()->go('admin.php?module=eav&page=attributeset-modify&ret=true&entity=' . $this->entity . '&id=' . $this->entitySetModel->getId());
    }
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->getRequest()->isPost('save_views')) {
      $views = $this->getRequest()->posts('views');
      foreach ($views as $id => $name) {
	$productSetViewModel = new Eav_Set_View_Model();
	$productSetViewModel->setId(intval($id));
	$productSetViewModel->setName($name);
	$productSetViewModel->entity_set_id = $this->entitySetModel->getId();
	if (trim($name) != '') {
	  $productSetViewModelAdapter = new Eav_Set_View_Model_Adapter();
	  $e = $productSetViewModelAdapter->save($productSetViewModel);
	}
      }
      $this->getRedirector()->go('admin.php?module=eav&page=attributeset-modify&ret=true&entity=' . $this->entity . '&id=' . $this->entitySetModel->getId());
    }
    if ($this->entitySetForm->isSend()) {
      $this->entitySetForm->DataSource = Amhsoft_Data_Source::Post();
      $this->entitySetForm->Bind();
      if ($this->entitySetForm->isValid()) {
	$this->entitySetForm->DataBinding = $this->entitySetModel;
	$entitySetModelAdapter = new Eav_Set_Model_Adapter();
	$this->entitySetModel = $this->entitySetForm->getDataBindItem();
	$entitySetModelAdapter->save($this->entitySetModel);
	$this->handleSuccess();
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Handle Success.
   */
  protected function handleSuccess() {
    $this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('views', $this->entitySetModel->getViews());
    $this->getView()->assign('form', $this->entitySetForm);
    $this->show();
  }

}

?>
