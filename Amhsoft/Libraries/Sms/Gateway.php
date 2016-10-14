<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Sms_Gateway {

  /**
   * 
   * @param array $config configuration
   * @return Amhsoft_Sms_Gateway_Abstract 
   * <code>
   * $config = array(
   * 'gatewayname' => 'mobily' , 
   * 'gatewayclass' => 'Amhsoft_Sms_Gateway_Mobily_Adapter', 
   * 'username' => 'xxxxx',
   * 'password' => 'plain',
   * 'sender' => 'sendername');
   * 
   * Amhsoft_Sms_Gateway::factory($config)->send(0097544, 'helloword', 'Amhsoft');
   * </code>
   */
  public static function factory($config) {
    if (!isset($config['gatewayclass']) || !class_exists($config['gatewayclass'])) {
      throw new Exception("Smsgateway not found");
    }
    $adapter = new $config['gatewayclass']($config['username'], $config['password'], $config['sender']);
    if (!$adapter instanceof Amhsoft_Sms_Gateway_Abstract) {
      throw new Exception("Smsgateway not found");
    }
    return $adapter;
  }

  public static function register($gatewayName, $gateWayClass, $username, $passwrd, $sender) {
    try {
      $db = Amhsoft_Database::getInstance();
      $stmt = $db->prepare("INSERT INTO `sms_gateway` VALUES (NULL , :name , :class , :username , :password , :sender , :salt , 0)");
      $stmt->bindParam(':name', $gatewayName);
      $stmt->bindParam(':class', $gateWayClass);
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':password', $passwrd);
      $stmt->bindParam(':sender', $sender);
      $salt = microtime(true);
      $stmt->bindParam(':salt', $salt);
      $stmt->execute();
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * 
   * @param Amhsoft_Config_Table_Adapter $adapter
   * <code>
   * $adapter = new Amhsoft_Config_Table_Adapter('mobily_ws');
   * Amhsoft_Sms_Gateway::fromAdapter($adapter)->send(1234565, 'amhsoft');
   * </code>
   */
  public static function fromAdapter(Amhsoft_Config_Table_Adapter $adapter) {
    $data = $adapter->getConfiguration();
    $salt = Amhsoft_System_Config::getProperty('salt', 123456);
    $data['password'] = Amhsoft_Common::decrypt($data['password'], $salt);
    return self::factory($data);
  }

  /**
   * Find gateway byNale.
   * @param String $name
   * @return Amhsoft_Sms_Gateway_Abstract
   * @throws Exception
   */
  public static function byName($name) {
    if (!$name) {
      throw new Exception();
    }
    $name = addslashes($name);
    $sql = "SELECT * FROM sms_gateway WHERE gatewayname = '$name'";
    $stmt = Amhsoft_Database::getInstance()->query($sql);

    if ($stmt->rowCount() == 0) {
      throw new Exception('Gateway not found');
    }
    $row = $stmt->fetch();
    $row['password'] = Amhsoft_Common::decrypt(@$row['password'], @$row['salt']);
    return self::factory($row);
  }

  /**
   * Get default sms gateway
   * @return Amhsoft_Sms_Gateway_Abstract
   * <code>
   * try{
   * Amhsoft_Sms_Gateway::getDefault()->send(122321,'asdaasd');
   * }catch(Exception $e){
   * }
   * </code>
   */
  public static function getDefault() {
    $default = Amhsoft_Database::querySingle("SELECT gatewayname FROM sms_gateway WHERE as_default = 1 LIMIT 1");
    return self::byName($default);
  }

}

?>
