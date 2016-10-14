<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Data_Search {

    private $directory;
    private $meta = array();
    private $in = array();

    public function __construct($directory) {
        $this->directory = new Amhsoft_Data_Search_Directory($directory);
        if (file_exists($this->directory->getPath() . '_index')) {
            $data = file_get_contents($this->directory->getIndexPath());
            if ($data) {
                $this->meta = (array) json_decode($data, true);
            }
        }
    }

    public function addDocument(Amhsoft_Data_Search_Document $document) {
        if ($document->getId() == 0) {
            $document->setId($this->getNextId());
        }

        if ($this->commitDocument($document)) {
            $this->meta[$document->getId()] = $document->getIndexedFields();
            $this->commitIndex();
        }
    }

    public function getMetaData() {
        return $this->meta;
    }

    public function commitIndex() {
        file_put_contents($this->directory->getIndexPath(), json_encode($this->meta));
    }

    private function commitDocument(Amhsoft_Data_Search_Document $document) {
        if ($document->hasData()) {
            $fileName = $this->directory->getPath() . $document->getId();
            return file_put_contents($fileName, $document->getDataFieldsAsJson());
        }
        return true;
    }

    public function deleteDocument($id) {
        unset($this->meta[$id]);
        @unlink($this->directory->getPath() . $id);
        $this->commitIndex();
    }

    public function updateDocument($doucment) {
        $this->addDocument($document);
    }

    public function optimize() {
        
    }

    public function in($field) {
        $this->in[] = $field;
        return $this;
    }

    public function query(Amhsoft_Data_Search_Query_Linq_Abstract_Adapter $adapter, $onlyIndexes = true) {
        return $adapter->query($this->meta);
    }

    public function fetchById($id) {
        $fileName = $this->directory->getPath() . $id;
        if (!file_exists($fileName)) {
            return null;
        }
        $data = file_get_contents($fileName);
        return json_decode($data, true);
    }

    public function fetchBy($index, $value) {
        $array_result = array();
        foreach ($this->meta as $key => $data) {
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

    public function match($phrase) {
        if (!trim($phrase)) {
            return array();
        }
        $_keywords = preg_split("/[\s]+/", $phrase);
        $_keywords_count = count($_keywords);

        $_foundkeys = array();




        foreach ($this->meta as $_key => $data) {
            if (empty($this->in)) {
                $this->in = array_keys($data);
            }
            extract($data, EXTR_OVERWRITE);

            $_found = 0;
            $_i = $_keywords_count + 1;
            foreach ($this->in as $_in) {
                foreach ($_keywords as $_keyword) {
                    $_keyword = trim($_keyword);
                    if (stristr(' ' . $$_in . ' ', ' ' . $_keyword . ' ')) {
                        $_found = $_found + $_i * 10;
                        $_foundkeys[$_key] = $_found;
                        continue;
                    }
                    if (preg_match("/$_keyword/i", $$_in)) {
                        ++$_found;
                        //echo $keyword . ' --> '. $value. '-->found: '.$found.' in '.$key.'<br />';
                        $_rank = $_found; //log1p($found);
                        $_foundkeys[$_key] = $_rank;
                    }
                    $_i--;
                }
            }
        }
        arsort($_foundkeys);
        $max = @max($_foundkeys);
        $_result = array();
        foreach ($_foundkeys as $i => $rank) {
            $rank = log10(1 + $rank / $max);
            if ($rank > 0.07) {
                $r = $this->meta[$i];
                $r['amhsoft_search_rank'] = $rank;
                $_result[] = $r;
            }
        }
        return $_result;
    }

    private function getLastInsertId() {
        if (empty($this->meta)) {
            return 0;
        } else {
            $last = end(array_keys($this->meta));
            return intval($last);
        }
    }

    private function getNextId() {
        if (empty($this->meta)) {
            return 1;
        } else {
            $last = end(array_keys($this->meta));
            return intval($last) + 1;
        }
    }

    public function where($field, $value) {
        
    }

    public function like($field, $value) {
        
    }

}

?>
