<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Revision: 446 $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedBy: imen.amhsoft $
 * @package    Newslatter
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    18.06.2008 - 18:53:25
 */
class Modules_Newsletter_Frontend_Boot extends Amhsoft_System_Module_Abstract {

  public function initTranslation(Amhsoft_System $system) {
    if ($system->getCurrentLang() == 'ar') {
      $arabic = new Amhsoft_Config_Po_Adapter('Modules/Newsletter/I18N/translation_ar.po');
      $system->appendToTranslation($arabic->getDataAsArray());
      $arabic2 = new Amhsoft_Config_Ini_Adapter('Modules/Newsletter/I18N/ar.ini');
      $system->appendToTranslation($arabic2->getConfiguration());
    }
  }

}
