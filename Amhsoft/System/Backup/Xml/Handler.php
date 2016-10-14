<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_System_Backup_Xml_Handler extends Amhsoft_System_Backup_Abstract_Handler {

  private $xml;
  private $modules = array();

  public function __construct() {
    
  }

  public function init() {
    $this->xml = new SimpleXMLElement('<backup></backup>');
    $this->xml->addAttribute('datetime', Amhsoft_Locale::DateTime());
  }

  public function backupModule($moduleName, $database = true, $data = true) {
    if (!Amhsoft_System_Module_Manager::isModuleInstalled($moduleName)) {
      throw new Exception("Module $moduleName is not installed");
    }


    $moduleXml = $this->xml->addChild($moduleName);
    $moduleXml->addAttribute('version', Amhsoft_System_Module_Manager::getInstalledModuleVersion($moduleName));

    $moduleInstance = Amhsoft_System_Module_Manager::getModuleInstance($moduleName);
    $tables = $moduleInstance->getTablesToBackup();
    $sql = '';
    $moduleXMLSQL = $moduleXml->addChild('sql');
    if ($database == true) {
      foreach ($tables as $table) {
        $moduleXmlSqlTable = $moduleXMLSQL->addChild('table');
        $moduleXmlSqlTable->addAttribute('name', $table);
        $create = $moduleXmlSqlTable->addChild('create', base64_encode(Amhsoft_Database::getTableCreateSql($table)));
        $create->addAttribute('encoding', 'base64');
        $insert = $moduleXmlSqlTable->addChild('insert', base64_encode(Amhsoft_Database::getTableData($table)));
        $insert->addAttribute('encoding', 'base64');
      }
    }
    if ($data == true) {
      $dirs = $moduleInstance->getFolderToBackup();
      $data = $this->getFilesFromDirs($dirs);
      $moduleXmlData = $moduleXml->addChild('data');
      foreach ($data as $d) {
        $moduleXmlData->addChild('filename', $d);
        //$bin = $moduleXmlData->addChild('bin', base64_encode(gzcompress($d['data'])));
        //$bin->addAttribute('encoding', 'base64');
      }
    }
  }

  public function getData() {
    return $this->xml->asXML();
  }

  public function setData($data) {
    $this->xml = simplexml_load_string($data);
    foreach ($this->xml as $key => $val) {
      $this->modules[] = ($key);
    }
  }

  public function getModuleNames() {
    return $this->modules;
  }

  public function getModuleInfo($moduleName) {
    $module = $this->xml->{$moduleName};
    $info = array();
    $minversion = (string) @$module['version'];
    $_vesion = explode('.', $minversion);
    if(count($_vesion) > 1){
     $info['minversion'] = $_vesion[0].'.'.$_vesion[1];
    }else{
      $info['minversion'] =  $_vesion[0];
    }
    
    foreach (@$module->sql->table as $sql) {
      $info['insertsql'][(string) $sql['name']] = base64_decode((string) $sql->insert);
      $info['createsql'][(string) $sql['name']] = base64_decode((string) $sql->create);
    }
    foreach ((array) @$module->data as $f) {
      $info['files'] = $f;
    }
    return $info;
  }

}

?>
