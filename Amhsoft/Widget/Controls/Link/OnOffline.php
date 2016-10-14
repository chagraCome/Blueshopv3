<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: OnOffline.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Link_OnOffline_Control extends Amhsoft_Link_Control {

  public $OnlineLabel;
  public $OfflineLabel;

  public function __construct($label, $href = null, $target = '', $fragment = null) {
    parent::__construct($label, $href, $target, $fragment);
    $this->OnlineLabel = _t('Online');
    $this->OfflineLabel = _t('Offline');
  }

  public function Render() {
    if ($this->ValueToDisplay == '1') {
      $this->Class = 'online';
      $this->Label = $this->OnlineLabel;
      $this->Href = str_replace('online', 'offline', $this->Href);
    } else {
      $this->Class = 'offline';
      $this->Label = $this->OfflineLabel;
      $this->Href = str_replace('offline', 'online', $this->Href);
    }
    return parent::Render();
  }

}

?>
