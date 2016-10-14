<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_System_Backup_Manager {

  /** @var Amhsoft_System_Backup_Storage_Strategy_Interface $strategy */
  private $strategy;

  /** @var Amhsoft_System_Backup_Abstract_Handler $handler */
  private $handler;
  private $modules = array();
  private $xml;

  public function __construct(Amhsoft_System_Backup_Abstract_Handler $handler) {

    $this->handler = $handler;
  }

  public function addModule($moduleName) {
    if (!in_array($moduleName, $this->modules)) {
      $this->modules[] = $moduleName;
    }
  }

  public function backup($backuppath, $database = true, $data = true) {
    if (!is_dir(dirname($backuppath))) {
      throw new Exception("Backup path is not correct");
    }
    if (!is_writable(dirname($backuppath))) {
      throw new Exception("Backup path is not writeable");
    }
    ini_set('memory_limit', '256M');
    $this->handler->init();
    foreach ($this->modules as $module) {
      $this->handler->backupModule($module, $database, $data);
    }
    $moduleInstance = Amhsoft_System_Module_Manager::getModuleInstance($module);
    $zipArchive = new ZipArchive();
    $zipArchive->open($backuppath, ZIPARCHIVE::CREATE);
    $zipArchive->addFromString('backup.xml', $this->handler->getData());

    if ($data == true) {
      foreach ($this->modules as $module) {
        $moduleInstance = Amhsoft_System_Module_Manager::getModuleInstance($module);
        $dirs = $moduleInstance->getFolderToBackup();

        $files = $this->handler->getFilesFromDirs($dirs);
        foreach ($files as $file) {
          $zipArchive->addFile($file);
        }
      }
    }
    $zipArchive->close();
  }

  /**
   * 
   * @param type $backupFile
   * @return \Amhsoft_System_Backup_Xml_Handler
   * @throws Exception
   */
  public static function getHandler($backupFile) {
    try {
      $zipArchive = new ZipArchive();
      $zipArchive->open($backupFile, ZipArchive::ER_READ);
      $fp = @$zipArchive->getStream('backup.xml');
      if ($fp) {
        $contents = '';
        while (!feof($fp)) {
          $contents .= fread($fp, 2);
        }

        fclose($fp);
        $handler = new Amhsoft_System_Backup_Xml_Handler();
        $handler->setData($contents);
        $zipArchive->close();
        return $handler;
      }
    } catch (Exception $e) {
      throw new Exception('zip archive is corrupt!');
    }
  }

  public function restore($backupFile, $modules = array(), $database = true, $data = true) {

    if (count($modules) == 0) {
      throw new Exception('please select a module to restore');
    }

    $handler = self::getHandler($backupFile);
    $zipArchive = new ZipArchive();

    if ($data == true) {
      $zipArchive->open($backupFile, ZipArchive::ER_READ);
    }

    $db = Amhsoft_Database::newInstance();
    $db->beginTransaction();
    try {
      foreach ($modules as $module) {
        $this->restoreModule($db, $zipArchive, $module, $handler, $database, $data);
      }
      $db->commit();
      $this->commitFiles();
      $zipArchive->close();
    } catch (Exception $e) {
      $zipArchive->close();
      $db->rollBack();
      $this->rollBackFiles();
      throw $e;
    }
  }

  private function restoreModule($db, ZipArchive $zipArchive, $moduleName, Amhsoft_System_Backup_Abstract_Handler $handler, $database = true, $data = true) {
    $moduleInfo = $handler->getModuleInfo($moduleName);

    if ($database == true) {
      $minVersion = $moduleInfo['minversion'];
      $moduleInstalledVersion = Amhsoft_System_Module_Manager::getInstalledModuleVersion($moduleName);
      if (version_compare($moduleInstalledVersion, $minVersion, '<')) {
        throw new Exception(_t("Backup version is too old, current version %s backup version %s", array($moduleInstalledVersion, $minVersion)));
      }

      foreach ((array) @$moduleInfo['insertsql'] as $table => $statement) {
        $lines = Amhsoft_Common::GetSQLStatementsFromLineArray(explode("\n", $statement));
        foreach ($lines as $line) {
          $db->exec($line);
        }
      }
    }

    if ($data == true) {
      foreach ((array) @$moduleInfo['files'] as $fileName) {
        $this->restoreFile($zipArchive, $fileName);
      }
    }

    if (Amhsoft_System_Module_Manager::isModuleInstalled('Eav')) {
      Amhsoft_Data_Db_Model_Multilanguage_EAV_Adapter::flushEntityPivotView('product', true);
    }
  }

  private $modifedfiles = array();
  private $restoredfiles = array();

  private function restoreFile(ZipArchive $zipArchive, $fileName) {
    $e = true;
    if (file_exists($fileName)) {
      $e = @rename($fileName, $fileName . '.back');
    }
    if ($e) {
      $this->modifedfiles[] = $fileName . '.back';
      $dir = dirname(dirname(dirname(dirname(__FILE__))));
      $zipArchive->extractTo($dir . '/', array($fileName));
      $this->restoredfiles[] = $fileName;
    } else {
      throw new Exception(_t('cannot restore file %s', array($fileName)));
    }
  }

  private function rollBackFiles() {
    foreach ($this->restoredfiles as $file) {
      @unlink($file);
    }
    foreach ($this->modifedfiles as $file) {
      $e = @rename($file . '.back', $file);
    }
  }

  private function commitFiles() {
    foreach ($this->modifedfiles as $file) {
      @unlink($file);
    }
  }

}

?>
