<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Abstract.php 127 2016-01-26 17:51:54Z montassar.amhsoft $
 * $Rev: 127 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-26 18:51:54 +0100 (mar., 26 janv. 2016) $
 * $Author: montassar.amhsoft $
 */
abstract class Amhsoft_System_Module_Abstract extends Amhsoft_System_Boot_Event_Listener_Abstract {

    public function onBoot(Amhsoft_System $system) {
        
    }

    public function afterBoot(Amhsoft_System $system) {
        
    }

    public function onInitMenuContainer(Amhsoft_System $system) {
        
    }

    public function onInitToolBarContainer(Amhsoft_System $system) {
        
    }

    public function initTranslation(Amhsoft_System $system, $module = null) {
        if (Amhsoft_System::isTranslationCached()) {
            return;
        }
        $defaultTranslationFile = 'Modules/' . $module . '/I18N/' . strtolower(Amhsoft_System::getCurrentLang()) . '.po';

        if (file_exists($defaultTranslationFile)) {
            $translation = new Amhsoft_Config_Po_Adapter($defaultTranslationFile);
            $system->appendToTranslation($translation->getDataAsArray());
        }
    }

    public function beforeDispatchController(Amhsoft_System $system) {
        
    }

    public function onInstall(Amhsoft_System $system) {
        $file = dirname(dirname(__FILE__)) . '/Install/mysql.sql';
        try {
            $this->executeSQLFile($file);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getFolderToBackup() {
        return array();
    }

    public function getTablesToBackup() {
        return array();
    }

    public function onUpdate(Amhsoft_System $system, $installedVersion) {
        
    }

    public function beforeInstall(Amhsoft_System $system) {
        
    }

    public function afterInstall(Amhsoft_System $system) {
        
    }

    public function initRBAC(Amhsoft_System $system) {
        
    }

    public function receive($eventName, Amhsoft_System $system) {
        
    }

    protected function executeSQLFile($file_path) {
        $sql_array = $this->getQueriesFromSQLFile($file_path);

        if (empty($sql_array)) {
            return;
        }
        $db = Amhsoft_Database::newInstance();

        $db->beginTransaction();
        try {
            foreach ($sql_array as $line) {
                $db->exec($line);
            }
            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }
    }

    private function getQueriesFromSQLFile($sqlfile) {
        if (is_readable($sqlfile) === false) {
            throw new Exception($sqlfile . 'does not exist or is not readable.');
        }

        # read file into array
        $file = file($sqlfile);

        # import file line by line
        # and filter (remove) those lines, beginning with an sql comment token
        $file = array_filter($file, create_function('$line', 'return strpos(ltrim($line), "--") !== 0;'));

        # and filter (remove) those lines, beginning with an sql notes token
        $file = array_filter($file, create_function('$line', 'return strpos(ltrim($line), "/*") !== 0;'));

        # this is a whitelist of SQL commands, which are allowed to follow a semicolon
        $keywords = array(
            'ALTER', 'CREATE', 'DELETE', 'DROP', 'INSERT',
            'REPLACE', 'SELECT', 'SET', 'TRUNCATE', 'UPDATE', 'USE'
        );

        # create the regular expression for matching the whitelisted keywords
        $regexp = sprintf('/\s*;\s*(?=(%s)\b)/s', implode('|', $keywords));

        # split there
        $splitter = preg_split($regexp, implode("\r\n", $file));

        # remove trailing semicolon or whitespaces
        $splitter = array_map(create_function('$line', 'return preg_replace("/[\s;]*$/", "", $line);'), $splitter);

        # replace the default database prefix "your_prefix_"
        //$table_prefix = @$_POST['config']['database']['prefix'];
        //$splitter = preg_replace("/`your_prefix_/", "`$table_prefix", $splitter);
        # remove empty lines
        return array_filter($splitter, create_function('$line', 'return !empty($line);'));
    }

}

?>
