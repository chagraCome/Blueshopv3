<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Data_Db_NoSQL_Model_Adapter {

    private $_index = array();
    private $_data = array();
    private $document;
    private static $directory = './_index/';
    private $indexes = array();

    public function __construct($document) {
        $this->document = $document;
        if (file_exists($this->getPath() . '_index')) {
            $data = file_get_contents($this->getPath() . '_index');
            if ($data) {
                $this->_index = (array) json_decode($data, true);
            }
        }
    }

    public function addIndex($colName) {
        $this->indexes[] = $colName;
    }

    public static function setDataBase($directory) {
        self::$directory = rtrim($directory, '/').'/';
    }

    public static function getDataBase() {
        return self::$directory;
    }

    private function getPath() {
        return rtrim(self::$directory, '/') . '/' . rtrim($this->document, '/') . '/';
    }

    public function insert($object) {

        if (!is_dir($this->getPath())) {
            mkdir($this->getPath(), true);
        }

        $nextid = $this->getNextId();
        $object['_hash_id'] = $nextid;
        $raw_data = json_encode($object);

        $fileName = $this->getPath() . $nextid;
        $e = file_put_contents($fileName, $raw_data);
        if ($e) {
            $indexes = array();
            foreach ($this->indexes as $index) {
                $indexes[$index] = $object[$index];
            }
            $this->_index[$nextid] = $indexes;
            $index_file = $this->getPath() . '_index';
            file_put_contents($index_file, json_encode($this->_index));
        }
    }

    private function getLastInsertId() {
        if (empty($this->_index)) {
            return 0;
        } else {
            $last = end(array_keys($this->_index));
            return intval($last);
        }
    }

    private function getNextId() {
        if (empty($this->_index)) {
            return 1;
        } else {
            $last = end(array_keys($this->_index));
            return intval($last) + 1;
        }
    }

    public function update($object) {
        $raw_data = json_encode($object);
        $fileName = $this->getPath() . $object['_hash_id'];
        $e = file_put_contents($fileName, $raw_data);
        if ($e) {
            $indexes = array();
            foreach ($this->indexes as $index) {
                $indexes[$index] = $object[$index];
            }
            $this->_index[$object['_hash_id']] = $indexes;
            $index_file = $this->getPath() . '_index';
            file_put_contents($index_file, json_encode($this->_index));
        }
    }

    public function save($object) {
        if (!isset($object['_hash_id'])) {
            $object['_hash_id'] = null;
        }
        if ($object['_hash_id']) {
            $this->update($object);
        } else {
            $this->insert($object);
        }
    }

    public function fetchById($id) {
        $fileName = $this->getPath() . $id;
        if (!file_exists($fileName)) {
            return null;
        }
        $data = file_get_contents($fileName);
        return json_decode($data, true);
    }

    public function fetchBy($index, $value) {
        $array_result = array();
        foreach ($this->_index as $key => $data) {
            foreach ($data as $i => $v) {
                if ($i == $index) {
                    if (preg_match("/$value/i", $v)) {
                        $array_result[] = $this->fetchById($key);
                    }
                }
            }
        }
        return $array_result;
    }

    public function find($phrase, $field = '*', $onlyindex = true) {

        if (!trim($phrase)) {
            return array();
        }
        $keywords = preg_split("/[\s]+/", $phrase);
        $keywords_count = count($keywords);
        $range = 1;


        $foundkeys = array();
        $result = array();
        foreach ($this->_index as $key => $data) {
            $found = 0;
            foreach ($data as $index => $value) {
                if (is_null($value)) {
                    continue;
                }

                if ($field != '*' && $index != $field) {
                    continue;
                }

                $i = $keywords_count + 1;
                foreach ($keywords as $keyword) {
                    $keyword = trim($keyword);
                    if (stristr(' ' . $value . ' ', ' ' . $keyword . ' ')) {
                        $found = $found + $i * 10;
                        $found += $range;
                        $foundkeys[$key] = $found;
                        continue;
                    }
                    if (preg_match("/$keyword/i", $value)) {
                        ++$found;

                        //echo $keyword . ' --> '. $value. '-->found: '.$found.' in '.$key.'<br />';
                        $rank = $found; //log1p($found);
                        $foundkeys[$key] = $rank;
                    }
                    $i--;
                }
            }
        }
        if (empty($foundkeys)) {
            return array();
        }
        arsort($foundkeys);
        $max = max($foundkeys);
        foreach ($foundkeys as $i => $rank) {
            $rank = log10(1 + $rank / $max);
            if ($rank > 0.07) {
                if ($onlyindex == true) {
                    $r = $this->_index[$i];
                } else {
                    $r = $this->fetchById($i);
                }
                $r['amhsoft_search_rank'] = $rank;
                $result[] = $r;
            }
        }
        return $result;
    }

}

?>
