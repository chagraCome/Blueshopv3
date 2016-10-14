<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: index.php 475 2016-03-10 09:09:07Z imen.amhsoft $
 * $Rev: 475 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-03-10 10:09:07 +0100 (jeu., 10 mars 2016) $
 * $LastChangedDate: 2016-03-10 10:09:07 +0100 (jeu., 10 mars 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

session_name('AMHSOFT');
session_start();

require_once './Amhsoft/Libraries/Security/Firewall.php';

require '3rdParty/vendor/autoload.php';
require_once 'autoload.php';

set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__));
require_once 'Amhsoft/System.php';

//setup level
Amhsoft_System::setLevel('Frontend');

Amhsoft_System::setLayout("Hide1");

Amhsoft_System::setSkin("Default");

//init system
$system = new Amhsoft_System();

$iniConfig = new Amhsoft_Config_Ini_Adapter("config/application.ini");
//setup database configuration
Amhsoft_Database::setConfig($iniConfig);

//system configuration.
$systemConfig = Amhsoft_System_Config::getInstance();

//setup system configuration
$systemConfig->setAdapter(new Amhsoft_Config_Database_Adapter('config'));


$systemConfig->merge($iniConfig);
$systemConfig->merge(new Amhsoft_Config_Table_Adapter('config'));

$auth = Amhsoft_Authentication::getInstance();
$accountConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
$accountAdapter = new Amhsoft_Authentication_Db_Object_Adapter('Crm_Account_Model_Adapter', 'email1', 'password', 'state = 1');
$auth->setAdapter($accountAdapter);

$errorLog = Amhsoft_System_Config::getInstance()->getProperty('error_type', 'E_ALL');
@error_reporting($errorLog);

@ini_set('display_errors', Amhsoft_System_Config::getInstance()->getProperty('show_errors', 0));

Amhsoft_Security_Firewall::protect(true, true, 'firewall@amhsoft.com');

Amhsoft_Locale::setLocale(Amhsoft_Locale::ar_SA);
Amhsoft_Locale::initLocalFromSession();

Amhsoft_Debugger::getInstance()->getCollector('config')->setData($systemConfig->getProperties());

Amhsoft_Session::deleteOld();

$system->boot();
?>
