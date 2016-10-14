<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Label.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Currency_Label_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

  protected $currencyFactor = 1;
  protected $baseCurrency;
  public $CurrencyFactorDataBinding = null;
  public $BaseCurrencyDataBinding = null;
  public $CurrencyDoubleComma = 3;
  public $style=null;

  public function getCurrencyFactor() {
    return $this->currencyFactor;
  }

  public function setCurrencyFactor($currencyFactor) {
    $this->currencyFactor = $currencyFactor;
  }

  public function getBaseCurrency() {
    return $this->baseCurrency;
  }

  public function setBaseCurrency($baseCurrency) {
    $this->baseCurrency = $baseCurrency;
  }

  public function getCurrencyDoubleComma() {
    return $this->CurrencyDoubleComma;
  }

  public function setCurrencyDoubleComma($CurrencyDoubleComma) {
    $this->CurrencyDoubleComma = $CurrencyDoubleComma;
  }

  public function __construct($label, Amhsoft_Data_Binding $dataBinding = null) {
    parent::__construct($label);
    $this->Label = $label;
    $this->DataBinding = $dataBinding;
    $this->CurrencyDoubleComma = Amhsoft_Locale::getDoubleComma();
    $this->currencyFactor = Amhsoft_Locale::getRate();
  }

  public function bind($dataSource) {
//        
//        if ($this->CurrencyFactorDataBinding instanceof Amhsoft_Data_Binding) {
//            $this->currencyFactor = $dataSource->GetDouble($this->CurrencyFactorDataBinding->Value);
//        }
//
//        if ($this->BaseCurrencyDataBinding instanceof Amhsoft_Data_Binding) {
//            $this->baseCurrency = $dataSource->GetString($this->BaseCurrencyDataBinding->Value);
//        }
//        if (!$this->baseCurrency) {
//            $this->baseCurrency = Amhsoft_Locale::getCurrencySymbol();
//        }
//        $this->Value = ((double) $dataSource->GetString($this->DataBinding->Value)) * $this->currencyFactor;
  }

  public function getFormattedValue() {
    
    $this->Value = ((double) $this->Value * $this->currencyFactor);
    //$factor = Amhsoft_Currency_Converter::quote_google_currency('USD', Amhsoft_Locale::getCurrencyIso3());
    //$this->Value = $factor * $this->Value;
    return number_format((double) $this->Value, $this->CurrencyDoubleComma, Amhsoft_Locale::getDecimalSep(), Amhsoft_Locale::getThousandSep()) . ' ' . Amhsoft_Locale::getCurrencySymbol();
  }

  /**
   * Get output HTML / string represantation of Control.
   * @return string Output HTML / string represantation of Control.
   */
  public function Draw() {
    $style = $this->style ? 'style="'.$this->style.'"' : null;
    return '<label  '.$style.'>' . $this->getFormattedValue() . '</label>';
  }

}

?>
