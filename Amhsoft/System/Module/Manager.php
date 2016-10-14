<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Manager.php 453 2016-02-23 15:09:38Z imen.amhsoft $
 * $Rev: 453 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-23 16:09:38 +0100 (mar., 23 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Amhsoft_System_Module_Manager {

  private static $installedModules = array();

  public static function getAvailableModules() {
    $dirIterator = new DirectoryIterator('Modules');
    $i = 0;
    $_return = array();
    while ($dirIterator->valid()) {
      if ($dirIterator->isDir() && !$dirIterator->isDot() && $dirIterator->getBasename() != 'Cg') {

        $xmlFile = 'Modules/' . $dirIterator->getBasename() . '/manifest.xml';
        if (is_file($xmlFile)) {
          $xml = simplexml_load_file($xmlFile);
          $_return[$i]["version"] = (string) $xml->version;
          $_return[$i]["class"] = (string) $xml->name;
          $_return[$i]["name"] = (string) $xml->businessname;
          $_return[$i]["state"] = 2;
          $_return[$i]["build_date"] = (string) $xml->builddate;
          $count_of_updates = count($xml->updates->update);
          if ($count_of_updates == 0) {
            $_return[$i]["version"] = (string) $xml->version;
          } else {
            $_return[$i]["version"] = (string) $xml->updates->update[$count_of_updates - 1]->version;
          }
          $i++;
        }
      }


      $dirIterator->next();
    }
    return $_return;
  }

 public static function getInstalledModules() {
    $db = Amhsoft_Database::newInstance();
    $stmt = $db->prepare('SELECT * FROM module');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getModulesForBackup() {
    $db = Amhsoft_Database::newInstance();
    $stmt = $db->prepare('SELECT * FROM module');
    $stmt->execute();
    $modules = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      try {
        $moduleInstance = self::getModuleInstance($row['name']);
        if (method_exists($moduleInstance, 'getTablesToBackup')) {
          $modules[] = $row;
        }
      } catch (Exception $e) {
        
      }
    }

    return $modules;
  }

  public static function compare($array1 = array(), $array2 = array()) {
    $result = array();
    for ($i = 0; $i < count($array1); $i++) {
      $result[$i] = $array1[$i];
      $result[$i]["build_date"] = $array1[$i]["build_date"];
      $result[$i]["state"] = 2;
      for ($j = 0; $j < count($array2); $j++) {
        if (($array1[$i]["class"]) == ($array2[$j]["name"])) { //module found
          if (version_compare($array1[$i]["version"], $array2[$j]["version"]) > 0) { //need update
            $result[$i]["build_date"] = $array1[$i]["build_date"];
            $result[$i]["state"] = 0; //update
            $result[$i]["version"] = $array2[$j]["version"];
          } else { //no update needed.
            $result[$i]["state"] = 1; // ok
            $result[$i]["build_date"] = $array1[$i]["build_date"];
          }
          break;
        }
      }
    }
    return $result;
  }

  public static function isModuleInstalled($moduleName) {
    if (empty(self::$installedModules)) {
      $installed = self::getInstalledModules();
      foreach ($installed as $moduleInfo) {
        if (is_dir('Modules/' . $moduleInfo['name'])) {
          self::$installedModules[] = $moduleInfo['name'];
        }
      }
    }
    return in_array($moduleName, self::$installedModules);
  }

  public static function getInstalledModuleVersion($moduleName) {
    $db = Amhsoft_Database::newInstance();
    $stmt = $db->prepare('SELECT version FROM module WHERE `name`= :n');
    $stmt->bindParam(':n', $moduleName, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
  }

  /**
   * Gets Module instance.
   * @param String $moduleName
   * @return Amhsoft_System_Module_Abstract 
   */
  public static function getModuleInstance($moduleName) {
    $class = 'Modules_' . ucfirst($moduleName) . '_Backend_Boot';
    $file = 'Modules/' . ucfirst($moduleName) . '/Backend/Boot.php';
    if (!file_exists($file)) {
      throw new Exception(_t('Boot file was not found'));
    }
    $object = new $class;
    return $object;
  }

  /**
   * Gets Module manifest
   * @param <type> $moduleName
   * @return SimpleXMLElement
   */
  public static function getManifest($moduleName) {
    $manifestFile = 'Modules/' . $moduleName . '/manifest.xml';

    if (!file_exists($manifestFile)) {
      return null;
    }
    $xml = simplexml_load_file($manifestFile);
    return $xml;
  }

  public static function installModule($module, $system, $silent = false) {
    $moduleManifest = self::getManifest($module);
    if ($moduleManifest != null) {
      $version = (string) $moduleManifest->version;

      if ($moduleManifest->dependecy) {
        foreach ($moduleManifest->dependecy->module as $depModule) {
          if (!self::isModuleInstalled((string) $depModule)) {
            throw new Exception(_t('Module %s is required to complete the installation.', array((string) $depModule)));
            return $depModule;
          }

          $installversion_of_dep_module = self::getInstalledModuleVersion((string) $depModule);
          if (version_compare($installversion_of_dep_module, (string) $depModule['min_version'], '<')) {
            throw new Exception(_t('Module %s version %s is required to complete the installation.', array((string) $depModule, (string) $depModule['min_version'])));
            return;
          }
        }
      }
      $object = self::getModuleInstance($module);
      $object->onInstall($system);
      $exists = Amhsoft_Database::querySingle("SELECT COUNT(*) FROM module WHERE `name` = '$module' LIMIT 1");
      if (!$exists) {
        Amhsoft_Database::newInstance()->exec("INSERT INTO module (`name`, `title`, `version`, `state`) VALUES ('" . $module . "', '" . (string) $moduleManifest->businessname . "', '" . $version . "', '1')");
      } else {
        Amhsoft_Database::newInstance()->exec("DELETE FROM module WHERE `name` = '$module' LIMIT 1");
      }
      if ($silent == false) {
        $object->afterInstall($system);
      }
    } else {
      throw new Exception('No Manifest found');
    }
  }

  public static function updateModule($module, $system) {
    $moduleManifest = self::getManifest($module);
    if ($moduleManifest != null) {

      if ($moduleManifest->dependecy) {
        foreach ($moduleManifest->dependecy->module as $depModule) {
          if (!self::isModuleInstalled((string) $depModule)) {
            throw new Exception(_t('Module %s is required to complete the installation.', array((string) $depModule)));
            return;
          }

          $installversion_of_dep_module = self::getInstalledModuleVersion((string) $depModule);
          if (version_compare($installversion_of_dep_module, (string) $depModule['min_version'], '<')) {
            throw new Exception(_t('Module %s version %s is required to complete the installation.', array((string) $depModule, (string) $depModule['min_version'])));
            return;
          }
        }
      }

      $version = (string) $moduleManifest->version;
      $installed_version = self::getInstalledModuleVersion($module);

      $count_of_updates = count($moduleManifest->updates->update);

      if ($count_of_updates > 0) {
        $current_version = (string) $moduleManifest->updates->update[$count_of_updates-1]->version;
        if (version_compare($current_version, $installed_version, '>')) {
          $version = $current_version;
        }
      }

      $object = self::getModuleInstance($module);
      $object->onUpdate($system, $installed_version);
      Amhsoft_Database::newInstance()->exec("UPDATE module SET  `version` = '$version' WHERE `name` = '$module' LIMIT 1");
    } else {
      throw new Exception('Manifest was not found.');
    }
  }

}
