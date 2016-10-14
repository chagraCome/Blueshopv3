<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Manager.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of Acl
 *
 * @author cherif
 */
class Amhsoft_Acl_Manager implements Amhsoft_Acl_Interface {

  /**
   * @access protected
   * @var array roles Speichert alle Rollen
   */
  protected $roles = array();

  /**
   * @access protected
   * @var array resources Speichert alle Ressourcen
   */
  protected $resources = array();

  /**
   * @access protected
   * @var array rules Speichert alle Regeln
   */
  protected $rules = array();

  public function __construct() {
    //initialisiere Rechte
    $this->rules = array
        (
        "permission_all" => null,
        "resources" => array()
    );
  }

  public function hasPermission($role, $resource, $do_what) {
    $role = (string) strtolower($role);
    $resource = (string) strtolower($resource);
    $do_what = (string) strtolower($do_what);

    //als erstes wird geprüft, ob die Rolle Rechte auf alles hat.
    if (isset($this->rules["permission_all"][$role])) {
      return true;
    }

    //wenn nicht, wird geprüft, ob rechte auf die geasmte Ressource bestehen
    if (isset($this->rules["resources"][$resource]["roles"][$role]) &&
            count($this->rules["resources"][$resource]["roles"][$role]) < 1) {
      return true;
    }

    //wenn er nich alle rechte auf alles hat und auch nicht alle rechte auf die
    //resource, wird geschaut, ob er die aktion do_what ausführen darf
    if (isset($this->rules["resources"][$resource]["roles"][$role]) &&
            in_array($do_what, $this->rules["resources"][$resource]["roles"][$role])) {
      return true;
    }

    //vllt. gibt es vererbung?
    if (isset($this->roles[$role]["parents"])) {
      foreach ($this->roles[$role]["parents"] as $parent_role_object) {
        if ($this->hasPermission($parent_role_object->getRoleName(), $resource, $do_what)) {
          return true;
        }
      }
    }

    return false;
  }

  /**
   * @access public
   * @return instanz der klasse
   * @param Amhsoft_Acl_Role $role
   * @param array(string|Amhsoft_Acl_Role) parent
   *
   * Fügt eine neue Rolle hinzu. Die Rolle kann von einer bereits existierenden
   * Rolle erben. In diesem Fall erhält die Elternrolle einen Eintrag im
   * children-Array.
   */
  public function addRole(Amhsoft_Acl_Role $role, array $parents = null) {
    /**
     * Der Rollenname ist später der Index in allen beteiligten Arrays
     */
    $role_name = $role->getRoleName();
    $parentArray = array();
    /**
     * Wenn diese Rolle von einer anderen Rolle erbt
     */
    if ($parents !== null) {
      //durchlaufe alle Eltern und mache sie unter $parent zugänglich
      foreach ($parents as $parent) {
        /**
         * Wurde eine Instanz oder nur ein Rollenname übergeben?
         */
        if ($parent instanceof Amhsoft_Acl_Role) {
          $parentObject = $parent;
          $parent_name = $parentObject->getRoleName();
          if (!$this->roleExists($parent_name)) {
            throw new Amhsoft_Acl_Exception("Diese Rolle gibt es nicht: " . $parent_name);
          }
        } else {
          $parent_name = (string) $parent;
          if (!$this->roleExists($parent_name)) {
            throw new Amhsoft_Acl_Exception("Diese Rolle gibt es nicht: " . $parent_name);
          }
          $parentObject = $this->getRoleByName($parent_name);
        }

        $parentArray[$parent_name] = $parentObject; //weise dem Rollennamen seine Instanz zu

        /**
         * Die Elternklasse soll wissen, dass sie Kinder hat.
         */
        $this->roles[$parent_name]["children"][$role_name] = $role;
      }
    }

    $this->roles[$role_name] = array
        (
        "children" => array(), //hat zu diesem Zeitpunkt noch keine Kinder
        "instance" => $role, //Die Instanz der Rolle
        "parents" => $parentArray       //Falls geerbt wird, steht hier ein Array
    );

    return $this;
  }

  /**
   *  @access protected
   *  @return Amhsoft_Acl_Role instanz
   *  @param string $name
   *
   * Gibt die zum Rollennamen zugehörige instanz zurück.
   */
  protected function getRoleByName($name) {
    return $this->roles[$name]["instance"];
  }

  /**
   * @access public
   * @return instanz der Klasse
   * @param Amhsoft_Acl_Resource $resource
   *
   * Die Methode fügt eine Ressouce auf dem Stack dieser ACL-Klasse an
   */
  public function addResource(Amhsoft_Acl_Resource $resource) {
    $this->resources[$resource->getResourceName()] = $resource;
    return $this;
  }

  /**
   * @access public
   * @return instanz der Klasse
   * @param string $resource
   *
   * Die Methode löscht eine Ressource auf dem Stack dieser ACL-Klasse
   */
  public function removeResource($resource) {
    $resource = (string) $resource;
    unset($this->resources[$resource]);
    return $this;
  }

  /**
   * @access public
   * @return instanz der Klasse
   * @param string $role
   *
   * Mit dieser Methode lassen sich Rollen entfernen. Zusätzlich werden auch
   * andere Rollen "aufgeräumt", falls diese von der zu löschenden Rolle erben
   * oder der Vater davon sind.
   */
  public function removeRole($role) {
    $role = (string) $role;

    /**
     * Durchsuche den kompletten Baum nach Kindern und Eltern der Rolle
     */
    foreach ($this->roles as $key => $value) {
      /**
       * Ist diese Rolle ein Kind von einer anderen Rolle?
       */
      if (isset($value["children"][$role])) {
        unset($this->roles[$key]["children"][$role]);
      }

      /**
       * Ist diese Rolle der Vater von einer anderen Rolle?
       */
      if (isset($value["parents"][$role])) {
        unset($this->roles[$key]["parents"][$role]);
      }
    }

    /**
     * Als letztes noch die Rolle entfernen
     */
    unset($this->roles[$role]);
    return $this;
  }

  /**
   * ein leeres $do_what-array heißt, dass alles getan werden darf.
   * $resource leer = zugriff auf alles (admin)
   */
  public function addRule($role, $resource = null, array $do_what = array()) {
    /**
     * Bringe alles auf Kleinbuchstaben
     */
    foreach ($do_what as &$value) {
      $value = strtolower($value);
    }

    $role = strtolower((string) $role);
    $resource = ($resource === null) ? null : strtolower((string) $resource);

    if (!$this->roleExists($role)) {
      throw new Amhsoft_Acl_Exception("Diese Rolle gibt es nicht: " . $role);
    }

    //wurde eine ressource angegeben?
    if ($resource !== null) {
      if (!$this->resourceExists($resource)) {
        throw new Amhsoft_Acl_Exception("Diese Resource gibt es nicht: " . $resource);
      }

      //wenn diese rolle alle rechte auf alles hat, werden diese jetzt aufgehoben
      if (isset($this->rules["permission_all"][$role])) {
        unset($this->rules["permission_all"][$role]);
      }

      if (count($do_what) < 1) { //hat alle rechte
        //ein leeres Array signalisiert, dass alle aktionen erlaubt sind
        $this->rules["resources"][$resource]["roles"][$role] = array();
      } else {
        //hier werden die aktuellen rechte mit den neuen zusammengeführt
        $rightsNow = (isset($this->rules["resources"][$resource]["roles"][$role])) ? $this->rules[$resource]["roles"][$role] : array();
        //array_unique löscht alle doppelte Werte aus dem Array
        $this->rules["resources"][$resource]["roles"][$role] = array_unique(array_merge($rightsNow, $do_what));
      }
    } else {
      //falls schon spezielle rechte auf resourcen gegeben wurden, sollen sie gelöscht werden,
      //da der eintrag in permission_all das ersetzt
      foreach ($this->rules["resources"] as $resource => $roles) {
        if (isset($this->rules["resources"][$resource]["roles"][$role])) {
          unset($this->rules["resources"][$resource]["roles"][$role]);
        }
      }

      //Rollen in permission_all dürfen alles
      $this->rules["permission_all"][$role] = "__ALL__";
    }

    return $this;
  }

  protected function roleExists($role) {
    return isset($this->roles[strtolower($role)]);
  }

  protected function resourceExists($resource) {
    return isset($this->resources[strtolower($resource)]);
  }

}

interface Amhsoft_Acl_Interface {

  public function hasPermission($role, $resource, $do_what);
}

class Amhsoft_Acl_Resource implements Amhsoft_Acl_Resource_Interface {

  protected $resource_name;

  public function __construct($resource_name) {
    $this->resource_name = (string) $resource_name;
  }

  public function getResourceName() {
    return $this->resource_name;
  }

}

class Amhsoft_Acl_Role implements Amhsoft_Acl_Role_Interface {

  protected $role_name;

  public function __construct($role_name) {
    $this->role_name = (string) $role_name;
  }

  public function getRoleName() {
    return $this->role_name;
  }

}

interface Amhsoft_Acl_Resource_Interface {

  public function getResourceName();
}

interface Amhsoft_Acl_Role_Interface {

  public function getRoleName();
}

class Amhsoft_Acl_Exception extends Exception {
  
}

?>
