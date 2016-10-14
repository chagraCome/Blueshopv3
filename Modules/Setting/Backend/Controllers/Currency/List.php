<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: List.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Revision: 112 $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedBy: a.cherif $
 * @package    Setting
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    03.07.2008 - 15:37:46
 */
class Setting_Backend_Currency_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Amhsoft_Widget_Panel $panel */
  protected $panel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->getView()->setMessage(_t('Manage Currency Rates'), View_Message_Type::INFO);
  }

  /**
   * Update Currency Rates
   */
  protected function updateCurrencyRates() {
    $localModelAdapter = new Setting_Local_Model_Adapter();
    $currency_set = array();
    $currency_set['base'] = Amhsoft_System_Config::getProperty('base_currency', Amhsoft_Locale::getCurrencyIso3());
    foreach ($localModelAdapter->fetch() as $local) {
      $rate = Amhsoft_Currency_Converter::OnlineConvert(Amhsoft_System_Config::getProperty('base_currency', Amhsoft_Locale::getCurrencyIso3()), $local->getCurrencyIso3(), 'yahoo');
      $currency_set['rates'][$local->getCurrencyIso3()] = $rate;
    }
    $sql_rates = "UPDATE locale SET `rate` = :rate WHERE currency_iso3 = :iso3";
    $sql_base = "UPDATE locale SET `base` = 1 WHERE currency_iso3 = :iso3";
    $sql_set = "INSERT INTO currency_set VALUES (NULL, :base, :rates, :insert_date_time)";
    $db = Amhsoft_Database::newInstance();
    try {
      $db->beginTransaction();
      $ratesStmt = $db->prepare($sql_rates);
      while (list($iso3, $rate) = each($currency_set['rates'])) {
	$ratesStmt->bindParam(':rate', $rate, PDO::PARAM_STR);
	$ratesStmt->bindParam(':iso3', $iso3, PDO::PARAM_STR);
	$ratesStmt->execute();
      }
      $db->exec("UPDATE locale SET base = 0;");
      $sql_baseStmt = $db->prepare($sql_base);
      $sql_baseStmt->bindParam('iso3', $currency_set['base']);
      $sql_baseStmt->execute();
      $sql_set_Stmt = $db->prepare($sql_set);
      $sql_set_Stmt->bindParam(':base', $currency_set['base']);
      @$sql_set_Stmt->bindParam(':insert_date_time', Amhsoft_Locale::UCTDateTime());
      $json_rates = json_encode($currency_set);
      $sql_set_Stmt->bindParam(':rates', $json_rates);
      $sql_set_Stmt->execute();
      $db->commit();
    } catch (Exception $e) {
      $db->rollBack();
    }
  }

  /**
   * Iitialize Grid
   */
  protected function initDataGridView() {
    $this->panel = new Amhsoft_Widget_Panel(_t('Currency List'));
    $currencyDataGridView = new Amhsoft_Widget_DataGridView();
    $baseCol = new Amhsoft_RadioBox_Control('base', _t('Base Currency'));
    $baseCol->Value = 1;
    $baseCol->DataBinding = new Amhsoft_Data_Binding('currency_iso3');
    $currencyDataGridView->AddColumn($baseCol);
    $nameCol = new Amhsoft_Label_Control(_t('Currency'), new Amhsoft_Data_Binding('currency'));
    $currencyDataGridView->AddColumn($nameCol);
    $timeZoneCol = new Amhsoft_Label_Control(_t('Time Zone'), new Amhsoft_Data_Binding('time_zone'));
    $currencyDataGridView->AddColumn($timeZoneCol);
    $symbolCol = new Amhsoft_Input_Control('currency_symbol', _t('Currency Symbol'), null, null, new Amhsoft_Data_Binding('currency_symbol'));
    $symbolCol->DataBinding->Index = 'currency_iso3';
    $currencyDataGridView->AddColumn($symbolCol);
    $decimalCol = new Amhsoft_Input_Control('double_comma', _t('Currency Decimal'), null, null, new Amhsoft_Data_Binding('double_comma'));
    $decimalCol->DataBinding->Index = 'currency_iso3';
    $currencyDataGridView->AddColumn($decimalCol);
    $rateCol = new Amhsoft_Input_Control('rate', _t('Currency Rate'), 1, null, new Amhsoft_Data_Binding('rate'));
    $rateCol->DataBinding->Index = 'currency_iso3';
    $currencyDataGridView->AddColumn($rateCol);
    $lacalAdapter = new Setting_Local_Model_Adapter();
    $lacalAdapter->groupBy('currency');
    $currencyDataGridView->setCheckedLines(array(Amhsoft_System_Config::getProperty('base_currency', Amhsoft_Locale::getCurrencyIso3())));
    $currencyDataGridView->DataSource = new Amhsoft_Data_Set($lacalAdapter);
    $this->panel->addComponent($currencyDataGridView);
    $saveButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $saveButton->Class = 'ButtonSave';
    $updateButton = new Amhsoft_Button_Submit_Control('update', _t('Update Currency from Yahoo Financial Center'));
    $updateButton->Class = 'ButtonSave';
    $resetButton = new Amhsoft_Button_Submit_Control('reset', _t('Reset Currency'));
    $resetButton->Class = 'ButtonSave';
    $panel = new Amhsoft_Widget_Panel();
    $panel->setLayout(new Amhsoft_Flow_Layout());
    $panel->addComponent($saveButton);
    $panel->addComponent($updateButton);
    $panel->addComponent($resetButton);
    $panel->addComponent(new Amhsoft_Html_Control("<br/><br/>" . _t('Note : If you want to delete the Currency Decimal in the product price, please set the currency decimal to 0')));
    $panel->addComponent(new Amhsoft_Html_Control("<br/><p style='font-weight:bold;color:red;'>" . _t('Warning: When you reset currency you must click on update currencies from Yahoo Financial Center') . "</p>"));
    $this->panel->addComponent($panel);
  }

  /**
   * Default Event
   */
  public function __default() {
    if ($this->getRequest()->isPost('reset')) {
      Amhsoft_Locale::resetLocalTable();
      Amhsoft_Locale::flushLocalToDatabase();
      $this->getRedirector()->go('?module=setting&page=currency-list&ret=true');
    }
    if ($this->getRequest()->isPost('update')) {
      $base_currency = $this->getRequest()->post('base');
      $config = new Amhsoft_Config_Database_Adapter('config');
      $config->setValue('base_currency', $base_currency);
      Amhsoft_System_Config::getInstance()->merge($config);
      $this->updateCurrencyRates();
    }
    if ($this->getRequest()->isPost('submit')) {
      $base_currency = $this->getRequest()->post('base');
      $config = new Amhsoft_Config_Database_Adapter('config');
      $config->setValue('base_currency', $base_currency);
      Amhsoft_System_Config::getInstance()->merge($config);
      $symbols = $this->getRequest()->posts('currency_symbol');
      $doubles = $this->getRequest()->posts('double_comma');
      $rates = $this->getRequest()->posts('rate');
      $localAdapter = new Setting_Local_Model_Adapter();
      foreach ($symbols as $iso3 => $symbol) {
	$model = $localAdapter->fetchCurrencyIso3($iso3);
	if ($model instanceof Setting_Local_Model) {
	  $model->setCurrencySymbol($symbol);
	  $model->setDouble_comma($doubles[$iso3]);
	  $model->setRate($rates[$iso3]);
	  $localAdapter->save($model);
	}
      }
      $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
    }
    $this->initDataGridView();
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $form = new Amhsoft_Widget_Form('currency_form', 'POST');
    $form->addComponent($this->panel);
    $this->getView()->assign('widget', $form);
    $this->show();
  }

}

?>
