<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Client.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    Core
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Ftp_Client {

  public $hostname;
  public $user;
  public $pass;
  public $port = 21;
  private $rootDirectory = './';
  public $connectionID;

  public function __construct($config = null) {
    if ($config != null) {
      $this->loadConfig($config);
    }
  }

  public function getHostName() {
    return $this->hostname;
  }

  private function loadConfig($config) {
    foreach ($config as $key => $val) {
      if (isset($this->{$key})) {
        $this->{$key} = $val;
      }
    }
  }

  public function setRootDirectory($root) {
    $root = preg_replace("/(.+?)\/*$/", "\\1/", $root);
    $this->rootDirectory = $root;
  }

  public function getRoot() {
    return $this->rootDirectory;
  }

  public function downloadfile($local_file, $remote_file, $mode = FTP_ASCII) {
    if (@ftp_get($this->connectionID, $local_file, $remote_file, $mode) === FALSE) {
      throw new Exception("Can not download file $remote_file");
    }
  }

  public function isConnected() {
    return is_resource($this->connectionID);
  }

  public function login($host, $user, $pass, $port = 21) {

    $this->hostname = $host;
    $this->user = $user;
    $this->pass = $pass;
    $this->port = $port;
    if ($this->hostname != null) {
      $this->hostname = @preg_replace('|.+?://|', '', $this->hostname);
    }
    $this->connect();
  }

  public function ping() {
    if (is_null($this->hostname)) {
      throw new Exception('hostname is missing');
    }

    if (FALSE == ($this->connectionID = @ftp_connect($this->hostname, $this->port))) {
      throw new Exception('Can´t connect to ' . $this->hostname . ':' . $this->port);
    }
    return true;
  }

  public function connect() {
    $this->ping();

    if (FALSE === @ftp_login($this->connectionID, $this->user, $this->pass)) {
      throw new Exception('Can´t not Login');
    }
    ftp_pasv($this->connectionID, true);
  }

  public function discoverWWW() {
    if ($this->changeDir('www')) {
      return 'www';
    }
    if ($this->changeDir('public_html')) {
      return 'public_html';
    }
    if ($this->changeDir('httpdocs')) {
      return 'httpdocs';
    }

    if ($this->changeDir('httpdoc')) {
      return 'httpdoc';
    }
    if ($this->changeDir('http')) {
      return 'http';
    }
    if ($this->changeDir('web')) {
      return 'web';
    }
    return null;
  }

  public function changeDir($dir) {

    if (!$this->isConnected()) {
      $this->connect();
    }

    if (!is_string($dir)) {
      throw new Exception($dir . ': is not a Directory');
    }

    if (FALSE === @ftp_chdir($this->connectionID, $dir)) {
      throw new Exception('Can´t change to directory: ' . $dir);
    }

    return true;
  }

  public function mkDir($dir, $mode = null) {
    if (is_null($dir)) {
      throw new Exception($dir . ': is not a Directory');
    }

    if (!$this->isConnected()) {
      $this->connect();
    }

    if (FALSE === @ftp_mkdir($this->connectionID, $dir)) {
      throw new Exception('Can´t create Directory ' . $dir);
    }

    if (!is_null($mode)) {
      $this->changePermission($dir, $mode);
    }
  }

  public function changePermission($dir, $permission) {
    if (FALSE === @ftp_chmod($this->connectionID, $permission, $dir)) {
      throw new Exception('can´t change permission for ' . $dir);
    }
  }

  public function upload($local, $remote, $mode = 'auto', $permission = null) {
    if (!file_exists($local)) {
      throw new Exception('file' . $local . ' not found!');
    }

    if (!$this->isConnected()) {
      $this->connect();
    }

    if ($mode == 'auto') {
      if (FALSE === strpos($local, '.')) {
        $mode = FTP_ASCII;
      } else {
        $mode = FTP_BINARY;
        $extention = end(explode('.', $local));
        $ascii_extentions = array(
            'txt',
            'text',
            'php',
            'phps',
            'php4',
            'js',
            'css',
            'htm',
            'html',
            'phtml',
            'shtml',
            'log',
            'xml'
        );
        $mode = (!in_array($extention, $ascii_extentions)) ? FTP_BINARY : FTP_ASCII;
      }
      if (FALSE === @ftp_put($this->connectionID, $remote, $local, $mode)) {
        throw new Exception('can´t upload file ' . $local . ' to ' . $remote);
      }
      if (!is_null($permission)) {
        $this->changePermission($remote, $permission);
      }
    }
  }

  public function rename($old, $new) {
    if (!$this->isConnected()) {
      $this->connect();
    }
    if (FALSE === @ftp_rename($this->connectionID, $old, $new)) {
      throw new Exception('can´t rename file' . $old . ' to ' . $new);
    }
  }

  public function deleteFile($file) {
    if (!$this->isConnected()) {
      $this->connect();
    }
    if (FALSE === @ftp_delete($this->connectionID, $file)) {
      throw new Exception('can´ t delete file  ' . $file);
    }
  }

  public function deleteDir($dir) {
    if (!$this->isConnected()) {
      $this->connect();
    }

    $dir = preg_replace("/(.+?)\/*$/", "\\1/", $dir);

    $list = $this->getList($dir);
    if ($list !== FALSE && count($list) > 0) {
      foreach ($list as $item) {
        if (!@ftp_delete($this->connectionID, $item)) {
          $this->deleteDir($item);
        }
      }
    }


    if (FALSE === @ftp_rmdir($this->connectionID, $dir)) {
      throw new Exception('Can´ t delete directroy  ' . $dir);
    }
  }

  public function uploadDir($local, $remote) {
    if (!$this->isConnected()) {
      $this->connect();
    }

    $directoryIterator = new DirectoryIterator($local);

    try {
      $this->changeDir($remote);
    } catch (Exception $e) {
      try {
        $this->mkDir($remote);
        $this->changeDir($remote);
      } catch (Exception $ex) {
        die($ex->getMessage());
      }
    }

    while ($directoryIterator->valid()) {
      if ($directoryIterator->isDot()) {
        $directoryIterator->next();
        continue;
      }
      if ($directoryIterator->isDir()) {

        $this->uploadDir($directoryIterator->getPathname(), $directoryIterator->getFilename());
      } else {
        $this->upload($directoryIterator->getPathname(), $directoryIterator->getFilename());
      }
      $directoryIterator->next();
    }
  }

  public function getList($path = '.') {
    if (!$this->isConnected()) {
      $this->connect();
    }
    return ftp_nlist($this->connectionID, $path);
  }

  public function __destruct() {
    @ftp_close($this->connectionID);
  }

  public function listDetailed($directory = '.') {
    $children = ftp_rawlist($this->connectionID, $directory);
    if (is_array($children = @ftp_rawlist($this->connectionID, $directory))) {
      $items = array();

      foreach ($children as $child) {

        if (strpos($child, '.zip') === false) {
          continue;
        }
        $chunks = preg_split("/\s+/", $child);
        list($item['rights'], $item['number'], $item['user'], $item['group'], $item['size'], $item['month'], $item['day'], $item['time']) = $chunks;
        $item['type'] = $chunks[0]{0} === 'd' ? 'directory' : 'file';
        array_splice($chunks, 0, 8);
        $items[implode(" ", $chunks)] = $item;
      }

      return $items;
    }

    return false;
  }

}

?>