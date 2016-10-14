<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Data_Search_Query_Linq_Amhsoft_Adapter extends Amhsoft_Data_Search_Query_Linq_Abstract_Adapter {

    private $array;
    private $_where_eq = array();
    private $_where_noteq = array();
    private $_like_eq = array();
    private $_like_neq = array();
    private $_orderBy = array();
    private $limitstart;
    private $limitsend;

    private $count = 0;
    public function __construct() {
        
    }

    public function where($where) {
        $_where_eq = preg_split("/[\s]+(=|eq|equals)[\s]+/i", $where);
        if (count($_where_eq) == 2) {
            $this->_where_eq[$_where_eq[0]] = $_where_eq[1];
        }

        $_where_neq = preg_split("/[\s]+(\<\>|noteq|!eq|!equals)[\s]+/i", $where);
        if (count($_where_neq) == 2) {
            $this->_where_noteq[$_where_neq[0]] = $_where_neq[1];
        }


        $_like_eq = preg_split("/[\s]+(LIKE|lk)[\s]+/i", $where);
        if (count($_like_eq) == 2) {
            $this->_like_eq[$_like_eq[0]] = $_like_eq[1];
        }

        $_like_neq = preg_split("/[\s]+(notlike|!lk|!like)[\s]+/i", $where);
        if (count($_like_neq) == 2) {
            $this->_like_neq[$_like_neq[0]] = $_like_neq[1];
        }
    }

    public function orderBy($statement) {
        
    }
    
    public function limit($start, $end){
        $this->limitstart = $start;
        $this->limitsend = $end;
    }

    public function wildcard($key) {
        if (substr($key, -1) != '%') {
            $key = $key . '$';
        }
        if (substr($key, 0, 1) != '%') {
            $key = '^' . $key;
        }
        $key = str_replace('%', '', $key);

        return $key;
    }

    public function match($query) {
        
    }

    public function query($array) {

        $foundkeys = array();
        $result = array();
        $i = 100;

        $total = count($this->_where_eq) + count($this->_where_noteq) + count($this->_like_eq) + count($this->_like_neq) + 1;

        
        foreach ($array as $key => $data) {
            $found = 0;
            $i = $total;
            
            
            
            extract($data, EXTR_OVERWRITE);


            foreach ($this->_where_eq as $v => $k) {
                if ($$v == $k) {
                    $found = (++$i + $found) * 10;
                    $foundkeys[$key] = $found;
                    continue;
                }
            }

            foreach ($this->_where_noteq as $v => $k) {
                if ($$v != $k) {
                    $found = (++$i + $found) * 10;
                    $foundkeys[$key] = $found;
                    continue;
                }
            }


            foreach ($this->_like_eq as $v => $k) {
            $preg_match = $this->wildcard($k);
                if (preg_match("/$preg_match/i", $$v)) {
                    $found = (++$i + $found) * 10;
                    $foundkeys[$key] = $found;
                    continue;
                }
            }


            foreach ($this->_like_neq as $v => $k) {
                $preg_match = $this->wildcard($k);
                if (!preg_match("/$preg_match/i", $$v)) {
                    $found = (++$i + $found) * 10;
                    $foundkeys[$key] = $found;
                    continue;
                }
            }
           
        }

        if (empty($foundkeys)) {
            return array();
        }
        arsort($foundkeys);
        $this->count = count($foundkeys);
        $max = max($foundkeys);
        $counter = 0;
        foreach ($foundkeys as $i => $rank) {
            if($this->limitstart > 0 && $this->limitstart < $counter)
            {
                $counter++;
                continue;
            }
            
            if($this->limitsend > 0 && $this->limitsend <= $counter){
                break;
            }
            $rank = log10(1 + $rank / $max);
            if ($rank > 0.07) {
                $r = $array[$i]; //$this->fetchById($i);
                $r['amhsoft_search_rank'] = $rank;
                $result[] = $r;
            }
             $counter++;
        }
        return $result;
    }
    
    public function getCount(){
        return $this->count;
    }

}

?>
