<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CmsCache extends Amhsoft_System_Boot_Event_Listener_Abstract {

  public function __construct() {
    Amhsoft_System_Boot_Event_Handler::attach($this, 'before.boot.controller');
  }

  public function receive($eventName, Amhsoft_System $system) {
    if ($eventName == 'before.boot.controller' && $system->getChannel() == 'cms.frontend.page.controller') {
      Amhsoft_View::getInstance()->caching = true;
      Amhsoft_View::getInstance()->cache_dir = 'cache/Frontend/tmp';
      $id = md5(serialize($_GET) . Amhsoft_Locale::getCurrencyIso3() . Amhsoft_Common::GetCookie('product_default_display_mode'));
      Amhsoft_View::getInstance()->cache_id = 'cms|' . Amhsoft_System::getCurrentLang() . '|' . $id;
      $system->getView()->cache_lifetime = 3600;
      if (Amhsoft_View::getInstance()->isCached('index.tpl.html')) {
        $system->getController()->show();
        exit;
      }
    }
  }

}

?>
