<?php

/*
 * To change this template) choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL ^ E_STRICT ^ E_DEPRECATED);
ini_set('display_errors','on');
session_name('AMHSOFT');
session_start();

require_once './Amhsoft/Libraries/Security/Firewall.php';
Amhsoft_Security_Firewall::protect(true, true, 'firewall@amhsoft.com');

set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__) . PATH_SEPARATOR . dirname(dirname(dirname(__FILE__))) . '/sass');
require_once 'Amhsoft/System.php';

//setup leve
Amhsoft_System::setLevel('Frontend');

Amhsoft_System::setLayout("Electronic");

Amhsoft_System::setSkin("Default");


//init system
$system = new Amhsoft_System();


//setup database configuration
Amhsoft_Database::setConfig(new Amhsoft_Config_Ini_Adapter("config/application.ini"));


//system configuration.
$systemConfig = Amhsoft_System_Config::getInstance();


//setup system configuration
$systemConfig->setAdapter(new Amhsoft_Config_Database_Adapter('config'));


$systemConfig->merge(new Amhsoft_Config_Ini_Adapter('config/application.ini'));
$systemConfig->merge(new Amhsoft_Config_Table_Adapter('config'));

$auth = Amhsoft_Authentication::getInstance();
$accountConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);

$accountAdapter = new Amhsoft_Authentication_Db_Object_Adapter('Crm_Account_Model_Adapter', 'email1', 'password', 'state = 1');

$auth->setAdapter($accountAdapter);


Amhsoft_Locale::setLocale(Amhsoft_Locale::de_DE);
Amhsoft_Locale::initLocalFromSession();

$merchantId = "2386456";
$merchantPassport = "216bc88ef38e75955a09e0cd27307fb3c92c02a7";
$amount = "500";
$currency = "usd";
$trxRefNumber = "50";
$siteId = '4383';
$code = $merchantId . ':' . $amount . ':' . $currency . ':' . $merchantPassport;
$hashCode = md5($code);
$language = 'en';

$html = '<form action="https://pay.filspay.com" method="post">
<input type="hidden" name="merchantid" value="' . $merchantId . '">
<input type="hidden" name="amount" value="' . $amount . '">
<input type="hidden" name="currency" value="' . $currency . '">
<input type="hidden" name="language" value="' . $language . '">
<input type="hidden" name="Description" value="test transaction">
<input type="hidden" name="trxRefNumber" value="' . $trxRefNumber . '">
<input type="hidden" name="hashCode" value="' . $hashCode . '">
<input type="hidden" name="session_id" value="">
<input type="hidden" name="SiteId" value="' . $siteId . '">
<input type="submit" value="Pay with FilsPay!">
</form>';

echo $html;
?>
