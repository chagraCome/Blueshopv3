<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Intrusion_Detection_Adapter {

  private static $instance;
  private $errorDetails;
  private $attacks = array();
  private $sensorLevel;

  const SENSOR_HIGH_LEVEL = 'sensor_high_level';
  const SENSOR_MEDIUM_LEVEL = 'sensor_medium_level';
  const SENSOR_LOW_LEVEL = 'sensor_medium_level';
  const VIRUSES_ATTACK = 'check_file_uploaded_virus_attack';
  const DIRECTORY_TRESPASSING_ATTACK = 'check_direcrtory_trespassing_attack';
  const SQL_INJECTION_ATTACK = 'check_sql_injection_attack';
  const CODE_INJECTION_ATTACK = 'check_code_injection_attack';

  public function __construct($sensorLevel) {
    $this->setSensorLevel($sensorLevel);
  }

  public static function getInstance() {
    if (NULL === self::$instance) {
      self::$instance = new Amhsoft_Intrusion_Detection_Adapter($this->getSensorLevel());
    } else {
      return self::$instance;
    }
  }

  /**
   * Gets Error Message.
   * @return String $errorDetails
   * @author Montasser Smida <montassar@amhsoft.com>
   */
  public function getErrorDetails() {
    return $this->errorDetails;
  }

  /**
   * Gets Attack List.
   * @return Array $attacks
   * @author Montasser Smida <montassar@amhsoft.com>
   */
  public function getAttacks() {
    return $this->attacks;
  }

  /**
   * Set Attack List.
   * @param Array $attacks
   * @author Montasser Smida <montassar@amhsoft.com>
   */
  public function setAttacks($attacks) {
    $this->attacks = $attacks;
  }

  /**
   * Gets Sensor Level.
   * @return String $sensorLevel
   * @author Montasser Smida <montassar@amhsoft.com>
   */
  public function getSensorLevel() {
    return $this->sensorLevel;
  }

  /**
   * Set Sensor Level.
   * @param String $sensorLevel
   * @author Montasser Smida <montassar@amhsoft.com>
   */
  public function setSensorLevel($sensorLevel) {
    $this->sensorLevel = $sensorLevel;
    switch ($sensorLevel) {
      case self::SENSOR_HIGH_LEVEL:
        $this->setAttacks(array(self::VIRUSES_ATTACK, self::DIRECTORY_TRESPASSING_ATTACK, self::SQL_INJECTION_ATTACK, self::CODE_INJECTION_ATTACK));
        break;
      case self::SENSOR_MEDIUM_LEVEL:
        $this->setAttacks(array(self::VIRUSES_ATTACK, self::SQL_INJECTION_ATTACK));
        break;
      case self::SENSOR_LOW_LEVEL:
        $this->setAttacks(array(self::SQL_INJECTION_ATTACK));
        break;
    }
  }

  public function scanUpload($max_len = 65000) {
    $max_len = intval($max_len);
    foreach ($_FILES as $key => $file) {
      if ($max_len > 0) {
        $content = file_get_contents($file["tmp_name"], null, null, null, $max_len);
      } else {
        $content = file_get_contents($file["tmp_name"]);
      }
      $this->scanData($content);
    }
  }

  public function scanInputSecurity($array = "") {
    if ($array === "") {
      $array = $_REQUEST;
    }
    foreach ($array as $key => $val) {
      $this->scanData($val);
    }
  }

  public function secureData($data) {
    $data = @mysql_real_escape_string($data);
    $data = htmlentities($data, ENT_QUOTES);
  }

  public function scanData($data) {
    $attacks = $this->getAttacks();

    if (in_array(self::VIRUSES_ATTACK, $attacks)) {
      if (strpos($data, "gzinflate(") !== false) {
        $this->addDangerousError("The phrase `gzinflate(` found in input. The phrase `gzinflate` is mostly used in viruses. Type: VIRUSES");
        throw new Exception("Dangrous content found. Call \$obj->getDangerousErrorDetail() for more info.");
      }
      if (strpos($data, "eval(") !== false) {
        $this->addDangerousError("The phrase `eval(` found in input. The phrase `eval` can be used to execute malicious codes. Type: VIRUSES");
        throw new Exception("Dangrous content found. Call \$obj->getDangerousErrorDetail() for more info.");
      }
      if (strpos($data, "base64_decode(") !== false) {
        $this->addDangerousError("The phrase `base64_decode(` found in input. The phrase `base64_decode` is usually used to decode viruses. Type: VIRUSES");
        throw new Exception("Dangrous content found. Call \$obj->getDangerousErrorDetail() for more info.");
      }
    }
    if (in_array(self::DIRECTORY_TRESPASSING_ATTACK, $attacks)) {
      if (strpos($data, "../") !== false) {
        $this->addDangerousError("The phrase `../` found in input. The phrase `../` is usually used to access restricted directories of the system. Type: DIRECTORY_TRESPASSING");
        throw new Exception("Dangrous content found. Call \$obj->getDangerousErrorDetail() for more info.");
      }
      if (strpos($data, "..\\") !== false) {
        $this->addDangerousError("The phrase `..\\` found in input. The phrase `..\\` is usually used to access restricted directories of the system. Type: DIRECTORY_TRESPASSING");
        throw new Exception("Dangrous content found. Call \$obj->getDangerousErrorDetail() for more info.");
      }
    }
    if (in_array(self::SQL_INJECTION_ATTACK, $attacks)) {
      if (strpos($data, "--") !== false) {
        $this->addDangerousError("The phrase `--` found in input. The phrase `--` is usually used to comment some part of query. Type: SQL_INJECTION");
        throw new Exception("Dangrous content found. Call \$obj->getDangerousErrorDetail() for more info.");
      }
    }
    if (in_array(self::CODE_INJECTION_RESTRICT, $sensitivity)) {
      if (strpos($data, "<?") !== false) {
        $this->addDangerousError("The phrase `&lt;?` found in input. The phrase `&lt;?` is mostly used to inject PHP codes into your system. Type: CODE_INJECTION_RESTRICT");
        throw new Exception("Dangrous content found. Call \$obj->getDangerousErrorDetail() for more info.");
      }
      if (strpos($data, "<%") !== false) {
        $this->addDangerousError("The phrase `&lt;%` found in input. The phrase `&lt;%` is mostly used to inject ASP codes into your system. Type: CODE_INJECTION_RESTRICT");
        throw new Exception("Dangrous content found. Call \$obj->getDangerousErrorDetail() for more info.");
      }
    }
  }

}

?>
