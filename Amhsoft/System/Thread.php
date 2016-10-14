<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_System_Thread {

  private $backgroundInstance = null;
  public $parameters = array();
  public $class = null;
  public $workerName = null;

  public function __construct(Amhsoft_System_Runnable $delegate, $parameters = array()) {
    $this->backgroundInstance = $delegate;
    $this->parameters = (array) $parameters;
    $this->class = get_class($this->backgroundInstance);
    $this->workerName = md5($this->class);
  }

  public function execute() {
    $this->class = get_class($this->backgroundInstance);
    $data = array('backgroundinstance' => $this->class);


    $data_array = array();
    foreach ($data as $key => $val) {
      $data_array[] = $key . '=' . $val;
    }
    foreach ($this->parameters as $param) {
      $data_array[] = 'params[]=' . urlencode($param);
    }
    $data_array[] = 'worker_name=' . $this->workerName;
    $data_string = implode('&', $data_array);

    $ch = curl_init();
    $url = Amhsoft_System_Config::getProperty('appurl');
    curl_setopt($ch, CURLOPT_URL, rtrim($url, '/') . '/pool.php');
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_exec($ch);
    curl_close($ch);
  }

  public function isAlive() {
    return @file_exists('cache/thread/' . md5($this->class));
  }
  
  

  public function getInfo() {
    $threadInfo = new Amhsoft_System_Thread_Info();
    if ($this->isAlive()) {
      $content = file_get_contents('cache/thread/' . md5($this->class));
      $array = json_decode($content);
      $threadInfo->fromArray($array);
    }
    return $threadInfo;
  }

}

?>
