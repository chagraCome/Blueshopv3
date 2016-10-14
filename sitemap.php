<?php

/*
 * To change this template) choose Tools | Templates
 * and open the template in the editor.
 */

error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE ^ E_STRICT ^ E_DEPRECATED);
ini_set('display_errors', 'on');
require '3rdParty/vendor/autoload.php';


session_name('AMHSOFT');

require_once './Amhsoft/Libraries/Security/Firewall.php';
Amhsoft_Security_Firewall::protect(true, true, 'firewall@amhsoft.com');

session_start();

set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__));
require_once 'Amhsoft/System.php';

//setup leve
Amhsoft_System::setLevel('Frontend');

Amhsoft_System::setSkin("Default");

$system = new Amhsoft_System();


//setup database configuration
Amhsoft_Database::setConfig(new Amhsoft_Config_Ini_Adapter("config/application.ini"));


//system configuration.
$systemConfig = Amhsoft_System_Config::getInstance();

//setup system configuration
$systemConfig->setAdapter(new Amhsoft_Config_Database_Adapter('config'));


$systemConfig->merge(new Amhsoft_Config_Ini_Adapter('config/application.ini'));
$systemConfig->merge(new Amhsoft_Config_Table_Adapter('config'));


Amhsoft_Session::deleteOld();


$siteMap = new Amhsoft_Xml_Sitemap();

$modelAdapter = new Product_Product_Model_Adapter();
$modelAdapter->where('online = 1');
$modelAdapter->orderBy('id ASC');
$result = $modelAdapter->fetch();
foreach ($result as $item) {
    $url = null;
    $title = Amhsoft_Common::remove_bad_chars_from_word($item->getTitle());
    $url = $item->getUrl();
    if ($url) {
        $siteMap->addRow(new Amhsoft_Xml_Sitemap_Row($url . '&amp;lang=en', Amhsoft_Locale::UCTDateTime($item->insertat)));
        $siteMap->addRow(new Amhsoft_Xml_Sitemap_Row($url . '&amp;lang=ar', Amhsoft_Locale::UCTDateTime($item->insertat)));
    }
}

header("Content-type: text/xml");
echo $siteMap;
exit;
?>