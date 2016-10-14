<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: admin.php 461 2016-02-27 19:45:22Z montassar.amhsoft $
 * $Rev: 461 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-27 20:45:22 +0100 (sam., 27 févr. 2016) $
 * $LastChangedDate: 2016-02-27 20:45:22 +0100 (sam., 27 févr. 2016) $
 * $Author: montassar.amhsoft $
 * *********************************************************************************************** */
  
error_reporting(E_ALL);
ini_set('display_errors', 1);
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__));
session_name('AMHSOFT');
session_start();
require_once 'Amhsoft/System.php';
require '3rdParty/vendor/autoload.php';



Amhsoft_System::setLevel('Backend');

Amhsoft_System::setLayout("Pro");

Amhsoft_System::setSkin("Default");


$system = new Amhsoft_System();


$auth = Amhsoft_Authentication::getInstance();

$auth->setAdapter(new Amhsoft_Authentication_Db_Object_Adapter('User_User_Model_Adapter', 'username', 'password', 'state = 1'));


$systemConfig = Amhsoft_System_Config::getInstance();
Amhsoft_Database::setConfig(new Amhsoft_Config_Ini_Adapter("config/application.ini"));

$systemConfig->setAdapter(new Amhsoft_Config_Database_Adapter('config'));


$systemConfig->merge(new Amhsoft_Config_Ini_Adapter('config/application.ini'));


Amhsoft_Locale::setLocale(Amhsoft_Locale::ar_SA);
Amhsoft_Locale::initLocalFromSession();
Amhsoft_Session::deleteOld();

$system->boot();
?>