<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Session_DB_Adapter implements Amhsoft_Session_Interface {

    private static $lifeTime;

    public function __construct($lifeTime = 1440) {
        self::$lifeTime = $lifeTime;
    }

    /**
     * Read the session
     * @param int session id
     * @return string string of the sessoin
     */
    public function read($key) {
        $stmt = Amhsoft_Database::getInstance()->prepare('SELECT `session_value` FROM `session` WHERE session_key = :key AND  `session_id` = :id');
        $stmt->bindParam(':key', $key, PDO::PARAM_STR);
        $sessionid = session_id();
        $stmt->bindParam(":id", $sessionid, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }
	
	public function deleteOld(){
		Amhsoft_Database::getInstance()->exec("DELETE FROM `session` WHERE `session_expiry` < " . (microtime(true)));
        $life = microtime(true) + self::$lifeTime;
        Amhsoft_Database::getInstance()->exec("UPDATE `session` SET session_expiry = $life WHERE  session_id = '" . session_id() . "' ");
	}

    /**
     * Write the session
     * @param int session id
     * @param string data of the session
     */
    public function write($key, $data) {
        $sessionid = session_id();
        if (!$this->read($key)) {
            $sql = "INSERT INTO `session` (session_id, session_key, session_expiry, session_value, host) VALUES(:session_id, :session_key, :session_expiry, :session_value, :host)";
            $stmt = Amhsoft_Database::getInstance()->prepare($sql);

            $stmt->bindParam(':session_id', $sessionid, PDO::PARAM_STR);
            $stmt->bindParam(':session_key', $key, PDO::PARAM_STR);
            $stmt->bindParam(':session_value', $data, PDO::PARAM_STR);
            $life = microtime(true) + self::$lifeTime;
            $stmt->bindParam(':session_expiry', $life, PDO::PARAM_STR);
            $host = Amhsoft_Common::GetClientHostname();
            $stmt->bindParam(':host', $host, PDO::PARAM_STR);
            return $stmt->execute();
        } else {
            $sql = "UPDATE `session` SET session_expiry = :session_expiry, session_value = :session_value WHERE session_key = :session_key AND session_id = :session_id ";
            $stmt = Amhsoft_Database::getInstance()->prepare($sql);
            $stmt->bindParam(':session_id', $sessionid, PDO::PARAM_STR);
            $stmt->bindParam(':session_key', $key, PDO::PARAM_STR);
            $stmt->bindParam(':session_value', $data, PDO::PARAM_STR);
            $life = microtime(true) + self::$lifeTime;

            $stmt->bindParam(':session_expiry', $life, PDO::PARAM_STR);
            return $stmt->execute();
        }
    }

    /**
     * Destoroy the session
     * @param int session id
     * @return bool
     */
    public function destroyAll() {
        return Amhsoft_Database::getInstance()->exec("DELETE FROM `session` WHERE session_id = '" . session_id() . "'");
    }

    /**
     * Destoroy the session
     * @param int session id
     * @return bool
     */
    public function destroy($key) {
        return Amhsoft_Database::getInstance()->exec("DELETE FROM `session` WHERE `session_key` = '$key' and session_id = '" . session_id() . "'");
    }

}

?>
