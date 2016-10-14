<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Default
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Default_Backend_Portlet_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Default_Portlet_DataGridView $defaultPortletDataGridView */
  protected $defaultPortletDataGridView;

  /** @var Default_Portlet_Model_Adapter $defaultPortletModelAdapter */
  protected $defaultPortletModelAdapter;

  /**
   * Initialize controller
   */
  public function __initialize() {
    $this->defaultPortletModelAdapter = new Default_Portlet_Model_Adapter();
    $this->defaultPortletDataGridView = new Default_Portlet_DataGridView();
    $this->defaultPortletDataGridView->Sortable = false;
    $this->defaultPortletDataGridView->Searchable = false;
    $this->defaultPortletDataGridView->setWithPagination(false);
    $this->getView()->setMessage(_t('List Portlets'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $userConfTable = 'default_user_' . Amhsoft_Authentication::getInstance()->getObject()->id;
    $settingsUser = new Amhsoft_Config_Table_Adapter($userConfTable);
    if ($this->getRequest()->isPost('localsubmit')) {
      $settingsUser->setValue('current_currency', $this->getRequest()->post('locale'));
      Amhsoft_Common::SetCookie('current_currency', $this->getRequest()->post('locale'));
      Amhsoft_Locale::initLocalFromSession();
      $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
      $this->getRedirector()->go('admin.php?module=default&page=portlet-list&ret=true');
    }
  }

  protected function getLocalPanel() {
    $form = new Amhsoft_Widget_Form('localform', 'POST');
    $panel = new Amhsoft_Widget_Panel(_t('Local'));
    $panel->setLayout(new Amhsoft_Flow_Layout());
    $listBox = new Amhsoft_ListBox_Control('locale', _t('Local'));
    $listBox->WithNullOption = false;
    $ds = array();
    $countries = Amhsoft_Locale::getCountries();
    $currencies = Amhsoft_Locale::getCurrencyIsoAsArray();
    for ($i = 0; $i < count($countries); $i++) {
      $ds[] = array('cur' => $currencies[$i], 'country' => $countries[$i]);
    }
    $listBox->DataSource = new Amhsoft_Data_Set($ds);
    $listBox->DataBinding = new Amhsoft_Data_Binding('locale', 'cur', 'country', Amhsoft_Common::GetCookie('current_currency', 'EUR'));
    $panel->addComponent($listBox);
    $submit = new Amhsoft_Button_Submit_Control('localsubmit', _t('Save'));
    $submit->Class = 'ButtonSave';
    $panel->addComponent($submit);
    $form->addComponent($panel);
    return $form;
  }

  protected function getLocalInfoPanel() {
    $panel = new Amhsoft_Widget_Panel(_t('Locale Info'));
    $layout = new Amhsoft_Grid_Layout(2);
    $layout->setWidth(600);
    $panel->setLayout($layout);
    $panel->addComponent(new Amhsoft_Label_Control(_t('Country'), new Amhsoft_Data_Binding('country')));
    $panel->addComponent(new Amhsoft_Label_Control(_t('Country ISO'), new Amhsoft_Data_Binding('country_iso3')));
    $panel->addComponent(new Amhsoft_Label_Control(_t('Time Zone'), new Amhsoft_Data_Binding('time_zone')));
    $panel->addComponent(new Amhsoft_Label_Control(_t('Currency'), new Amhsoft_Data_Binding('currency')));
    $panel->addComponent(new Amhsoft_Label_Control(_t('Currency Symbol'), new Amhsoft_Data_Binding('currency_symbol')));
    $panel->addComponent(new Amhsoft_Label_Control(_t('Currency Cent'), new Amhsoft_Data_Binding('currency_cent')));
    $panel->addComponent(new Amhsoft_Label_Control(_t('Double Comma'), new Amhsoft_Data_Binding('double_comma')));
    $panel->addComponent(new Amhsoft_Label_Control(_t('Thousand Sep'), new Amhsoft_Data_Binding('thousend_sep')));
    $panel->addComponent(new Amhsoft_Label_Control(_t('Decimal Sep'), new Amhsoft_Data_Binding('decimal_sep')));
    $panel->DataSource = new Amhsoft_Data_Set(array(Amhsoft_Locale::getLocalInfo()));
    $panel->Bind();
    return $panel;
  }

  /**
   * Sort event
   */
  public function __sort() {
    $pos = $this->getRequest()->get('pos');
    if (!$pos) {
      $pos = 'L';
    }
    $portletIds = $this->getRequest()->postInts('port');
    $db = Amhsoft_Database::newInstance();
    $db->beginTransaction();
    try {
      $user_id = Amhsoft_Authentication::getInstance()->getObject()->id;
      $db->exec("DELETE FROM portlet_user WHERE position = '$pos' AND user_id = " . $user_id);

      foreach ($portletIds as $k => $id) {
	$sql = "INSERT INTO portlet_user VALUES ('$id', '$user_id', '$pos', '$k', 1)";
	$db->exec($sql);
      }
      $db->commit();
    } catch (Exception $e) {
      $db->rollBack();
      var_dump($e->getMessage());
    }
    exit;
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $items = $this->defaultPortletModelAdapter->fetch()->fetchAll();
    $stmt = Amhsoft_Database::getInstance()->query("SELECT  portlet_id, status FROM portlet_user where user_id = " . Amhsoft_Authentication::getInstance()->getObject()->id);
    $stmt->execute();
    $conf = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    if (count($conf) > 0) {
      $portlets = array_keys($conf);
      $_status = array_values($conf);
      for ($i = 0; $i < count($items); $i++) {
	if (array_key_exists($items[$i]->id, $conf)) {
	  $items[$i]->status = $conf[$items[$i]->id];
	}
      }
    }
    $this->defaultPortletDataGridView->DataSource = new Amhsoft_Data_Set($items);
    $panel = new Amhsoft_Widget_Panel(_t('Dashboard'));
    $panel->addComponent($this->defaultPortletDataGridView);
    $panel->addComponent($this->getLocalPanel());
    $panel->addComponent($this->getLocalInfoPanel());
    $this->getView()->assign('widget', $panel);
    $this->show();
  }

}
?>