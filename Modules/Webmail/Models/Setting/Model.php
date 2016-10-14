<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Webmail
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Webmail_Setting_Model implements Amhsoft_Data_Db_Model_Interface {

    public $id;
    public $name;
    public $email;
    public $user_id;
    public $type;
    public $host;
    public $port;
    public $encryption;
    public $cert;
    public $global;
    public $last_update_date_time;
    public $signature;
    public $password;
    public $hash;

    const OUTGOING = 'Outgoing';
    const INCOMING = 'Incoming';

    /**
     * Gets id.
     * @return 
     * */
    public function getId() {
        return $this->id;
    }

    /**
     * Set id.
     * @param  id 
     * @return Webmail_Setting_Model
     * */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets name.
     * @return 
     * */
    public function getName() {
        return $this->name;
    }

    /**
     * Set name.
     * @param  name 
     * @return Webmail_Setting_Model
     * */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets email.
     * @return 
     * */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set email.
     * @param  email 
     * @return Webmail_Setting_Model
     * */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * Gets user.
     * @return 
     * */
    public function getUserId() {
        return $this->user_id;
    }

    /**
     * Set user.
     * @param  user 
     * @return Webmail_Setting_Model
     * */
    public function setUserId($userid) {
        $this->user_id = $userid;
        return $this;
    }

    /**
     * Gets type.
     * @return 
     * */
    public function getType() {
        return $this->type;
    }

    /**
     * Set type.
     * @param  type 
     * @return Webmail_Setting_Model
     * */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    /**
     * Gets host.
     * @return 
     * */
    public function getHost() {
        return $this->host;
    }

    /**
     * Set host.
     * @param  host 
     * @return Webmail_Setting_Model
     * */
    public function setHost($host) {
        $this->host = $host;
        return $this;
    }

    /**
     * Gets port.
     * @return 
     * */
    public function getPort() {
        return $this->port;
    }

    /**
     * Set port.
     * @param  port 
     * @return Webmail_Setting_Model
     * */
    public function setPort($port) {
        $this->port = $port;
        return $this;
    }

    /**
     * Gets encryption.
     * @return 
     * */
    public function getEncryption() {
        return $this->encryption;
    }

    /**
     * Set encryption.
     * @param  encryption 
     * @return Webmail_Setting_Model
     * */
    public function setEncryption($encryption) {
        $this->encryption = $encryption;
        return $this;
    }

    /**
     * Gets cert.
     * @return 
     * */
    public function getCert() {
        return $this->cert;
    }

    /**
     * Set cert.
     * @param  cert 
     * @return Webmail_Setting_Model
     * */
    public function setCert($cert) {
        $this->cert = $cert;
        return $this;
    }

    /**
     * Gets global.
     * @return 
     * */
    public function getGlobal() {
        return $this->global;
    }

    /**
     * Set global.
     * @param  global 
     * @return Webmail_Setting_Model
     * */
    public function setGlobal($global) {
        $this->global = $global;
        return $this;
    }

    /**
     * Gets last_update_date_time.
     * @return 
     * */
    public function getLast_update_date_time() {
        return $this->last_update_date_time;
    }

    /**
     * Set last_update_date_time.
     * @param  last_update_date_time 
     * @return Webmail_Setting_Model
     * */
    public function setLast_update_date_time($last_update_date_time) {
        $this->last_update_date_time = $last_update_date_time;
        return $this;
    }

    /**
     * Gets signature.
     * @return 
     * */
    public function getSignature() {
        return $this->signature;
    }

    /**
     * Set signature.
     * @param  signature 
     * @return Webmail_Setting_Model
     * */
    public function setSignature($signature) {
        $this->signature = $signature;
        return $this;
    }

    /**
     * Gets password.
     * @return 
     * */
    public function getPassword($decryted = true) {
        if ($decryted == false) {
            return $this->password;
        } else {
            return Amhsoft_Common::decrypt($this->password, $this->hash);
        }
    }

    /**
     * Set password.
     * @param  password 
     * @return Webmail_Setting_Model
     * */
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    /**
     * Gets hash.
     * @return 
     * */
    public function getHash() {
        return $this->hash;
    }

    /**
     * Set hash.
     * @param  hash 
     * @return Webmail_Setting_Model
     * */
    public function setHash($hash) {
        $this->hash = $hash;
        return $this;
    }

    /**
     * 
     * @param type $user_id
     * @param type $id
     * @return Webmail_Setting_Model $model
     */
    public static function getOutgoingSettings($user_id = null, $settingsid = null) {
        $adapter = new Webmail_Setting_Model_Adapter();
        $adapter->where('type=?', Webmail_Setting_Model::OUTGOING, PDO::PARAM_STR);
        if ($settingsid) {
            $model = $adapter->fetchById($settingsid);
            if (!$model instanceof Webmail_Setting_Model) {
                throw new Exception(_t('No Server Settings found'));
            } else {
                return $model;
            }
        }
        if ($user_id) {
            $adapter->where('user_id=?', $user_id);
        }
        $model = $adapter->fetch()->fetch();
        if (!$model instanceof Webmail_Setting_Model) {
            throw new Exception(_t('No Server Settings found'));
        } else {
            return $model;
        }
    }

    /**
     * 
     * @param type $user_id
     * @param type $id
     * @return Webmail_Setting_Model $model
     */
    public static function getInComingSettings($user_id = null, $settingsid = null) {
        $adapter = new Webmail_Setting_Model_Adapter();
        $adapter->where('type=?', Webmail_Setting_Model::INCOMING, PDO::PARAM_STR);
        if ($settingsid) {
            $model = $adapter->fetchById($settingsid);
            if (!$model instanceof Webmail_Setting_Model) {
                throw new Exception(_t('No Server Settings found'));
            } else {
                return $model;
            }
        }
        if ($user_id) {
            $adapter->where('user_id=?', $user_id);
        }
        $model = $adapter->fetch()->fetch();
        if (!$model instanceof Webmail_Setting_Model) {
            throw new Exception(_t('No Server Settings found'));
        } else {
            return $model;
        }
    }

    /**
     * Get connection string
     * @return string
     */
    public function getConnectionString() {
        $string = '{' . $this->host . ':' . $this->port;
        if ($this->encryption) {
            $string .= '/' . $this->encryption;
        }
        if ($this->cert) {
            $string .= '/' . $this->cert;
        }
        $string .= '}';
        return $string;
    }

    /**
     * Gets Mail Client Option
     * @return type
     */
    public function getMailClientOptions() {
        return array(
            'Host' => $this->host,
            'Port' => $this->port,
            'Username' => $this->email,
            'Password' => $this->getPassword(),
            'SMTPAuth' => true,
            'From' => $this->email,
            'FromName' => $this->name,
            'Sender' => $this->email
        );
    }

    public function __toString() {
        return $this->email;
    }

    public static function getMailClientOptionsById($id) {
        $webmailSettingModelAdapter = new Webmail_Setting_Model_Adapter();
        $webmailSettingModel = $webmailSettingModelAdapter->fetchById($id);

        if (!$webmailSettingModel instanceof Webmail_Setting_Model) {
            return null;
        }

        return array(
            'Host' => $webmailSettingModel->host,
            'Port' => $webmailSettingModel->port,
            'Username' => $webmailSettingModel->email,
            'Password' => $webmailSettingModel->getPassword(),
            'SMTPAuth' => true,
            'From' => $webmailSettingModel->email,
            'FromName' => $webmailSettingModel->name,
            'Sender' => $webmailSettingModel->email
        );
    }

}

?>
