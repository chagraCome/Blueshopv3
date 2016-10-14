<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Security.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Security {

  var $use_xss_clean = TRUE;
  var $ip_address = TRUE;
  var $user_agent = TRUE;
  var $allow_get_array = TRUE;

  function __construct() {
    $this->protect();
  }

  function protect() {

    $protected = array('_SERVER', '_GET', '_POST', '_FILES', '_REQUEST', '_SESSION', '_ENV', 'GLOBALS', 'HTTP_RAW_POST_DATA',
        'system_folder', 'application_folder', 'BM', 'EXT', 'CFG', 'URI', 'RTR', 'OUT', 'IN');

    foreach (array($_GET, $_POST, $_COOKIE, $_SERVER, $_FILES, $_ENV, (isset($_SESSION) && is_array($_SESSION)) ? $_SESSION : array()) as $global) {
      if (!is_array($global)) {
        if (!in_array($global, $protected)) {
          unset($GLOBALS[$global]);
        }
      } else {
        foreach ($global as $key => $val) {
          if (!in_array($key, $protected)) {
            unset($GLOBALS[$key]);
          }

          if (is_array($val)) {
            foreach ($val as $k => $v) {
              if (!in_array($k, $protected)) {
                unset($GLOBALS[$k]);
              }
            }
          }
        }
      }
    }

    if ($this->allow_get_array == FALSE) {
      $_GET = array();
    } else {
      if (is_array($_GET) AND count($_GET) > 0) {
        foreach ($_GET as $key => $val) {
          $_GET[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
        }
      }
    }


    if (is_array($_POST) AND count($_POST) > 0) {
      foreach ($_POST as $key => $val) {
        $_POST[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
      }
    }


    if (is_array($_COOKIE) AND count($_COOKIE) > 0) {
      foreach ($_COOKIE as $key => $val) {
        $_COOKIE[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
      }
    }
  }

  function _clean_input_data($str) {
    if (is_array($str)) {
      $new_array = array();
      foreach ($str as $key => $val) {
        $new_array[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);
      }
      return $new_array;
    }

    if (get_magic_quotes_gpc()) {
      $str = stripslashes($str);
    }
    //$str = addslashes($str);
    $str = htmlspecialchars($str, ENT_QUOTES, "UTF-8");

    if ($this->use_xss_clean === TRUE) {
      $str = $this->xss_clean($str);
      
      //exit;
    }

    // Standardize newlines
    return preg_replace("/\015\012|\015|\012/", "\n", $str);
  }

  function _clean_input_keys($str) {
    if (!preg_match("/^[a-z0-9:_\/-]+$/i", $str)) {
      exit('Disallowed Key Characters.');
    }

    return $str;
  }

  // --------------------------------------------------------------------


  function get($index = '', $xss_clean = FALSE) {
    if (!isset($_GET[$index])) {
      return FALSE;
    }

    if ($xss_clean === TRUE) {
      if (is_array($_GET[$index])) {
        foreach ($_GET[$index] as $key => $val) {
          $_GET[$index][$key] = $this->xss_clean($val);
        }
      } else {
        return $this->xss_clean($_GET[$index]);
      }
    }

    return $_GET[$index];
  }

  // --------------------------------------------------------------------

  function post($index = '', $xss_clean = FALSE) {
    if (!isset($_POST[$index])) {
      return FALSE;
    }

    if ($xss_clean === TRUE) {
      if (is_array($_POST[$index])) {
        foreach ($_POST[$index] as $key => $val) {
          $_POST[$index][$key] = $this->xss_clean($val);
        }
      } else {
        return $this->xss_clean($_POST[$index]);
      }
    }

    return $_POST[$index];
  }

  // --------------------------------------------------------------------

  function cookie($index = '', $xss_clean = FALSE) {
    if (!isset($_COOKIE[$index])) {
      return FALSE;
    }

    if ($xss_clean === TRUE) {
      if (is_array($_COOKIE[$index])) {
        $cookie = array();
        foreach ($_COOKIE[$index] as $key => $val) {
          $cookie[$key] = $this->xss_clean($val);
        }

        return $cookie;
      } else {
        return $this->xss_clean($_COOKIE[$index]);
      }
    } else {
      return $_COOKIE[$index];
    }
  }

  // --------------------------------------------------------------------

  function server($index = '', $xss_clean = FALSE) {
    if (!isset($_SERVER[$index])) {
      return FALSE;
    }

    if ($xss_clean === TRUE) {
      return $this->xss_clean($_SERVER[$index]);
    }

    return $_SERVER[$index];
  }

  // --------------------------------------------------------------------

  function ip_address() {
    if ($this->ip_address !== FALSE) {
      return $this->ip_address;
    }

    if ($this->server('REMOTE_ADDR') AND $this->server('HTTP_CLIENT_IP')) {
      $this->ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ($this->server('REMOTE_ADDR')) {
      $this->ip_address = $_SERVER['REMOTE_ADDR'];
    } elseif ($this->server('HTTP_CLIENT_IP')) {
      $this->ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ($this->server('HTTP_X_FORWARDED_FOR')) {
      $this->ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    if ($this->ip_address === FALSE) {
      $this->ip_address = '0.0.0.0';
      return $this->ip_address;
    }

    if (strstr($this->ip_address, ',')) {
      $x = explode(',', $this->ip_address);
      $this->ip_address = end($x);
    }

    if (!$this->valid_ip($this->ip_address)) {
      $this->ip_address = '0.0.0.0';
    }

    return $this->ip_address;
  }

  // --------------------------------------------------------------------

  function valid_ip($ip) {
    $ip_segments = explode('.', $ip);


    if (count($ip_segments) != 4) {
      return FALSE;
    }

    if (substr($ip_segments[0], 0, 1) == '0') {
      return FALSE;
    }

    foreach ($ip_segments as $segment) {

      if (preg_match("/[^0-9]/", $segment) OR $segment > 255 OR strlen($segment) > 3) {
        return FALSE;
      }
    }

    return TRUE;
  }

  function user_agent() {
    if ($this->user_agent !== FALSE) {
      return $this->user_agent;
    }

    $this->user_agent = (!isset($_SERVER['HTTP_USER_AGENT'])) ? FALSE : $_SERVER['HTTP_USER_AGENT'];

    return $this->user_agent;
  }

  function filename_Amhsoft_Security($str) {
    $bad = array(
        "../",
        "./",
        "<!--",
        "-->",
        "<",
        ">",
        "'",
        '"',
        '&',
        '$',
        '#',
        '{',
        '}',
        '[',
        ']',
        '=',
        ';',
        '?',
        "%20",
        "%22",
        "%3c", // <
        "%253c", // <
        "%3e", // >
        "%0e", // >
        "%28", // (
        "%29", // )
        "%2528", // (
        "%26", // &
        "%24", // $
        "%3f", // ?
        "%3b", // ;
        "%3d"  // =
    );

    return stripslashes(str_replace($bad, '', $str));
  }

  function xss_clean($str) {

    $str = preg_replace('/\0+/', '', $str);
    $str = preg_replace('/(\\\\0)+/', '', $str);

    $str = preg_replace('#(&\#?[0-9a-z]+)[\x00-\x20]*;?#i', "\\1;", $str);


    $str = preg_replace('#(&\#x?)([0-9A-F]+);?#i', "\\1\\2;", $str);


    $str = rawurldecode($str);



    $str = preg_replace_callback("/[a-z]+=([\'\"]).*?\\1/si", array($this, '_attribute_conversion'), $str);

    $str = preg_replace_callback("/<([\w]+)[^>]*>/si", array($this, '_html_entity_decode_callback'), $str);



    $str = str_replace("\t", " ", $str);


    $bad = array(
        'document.cookie' => '[removed]',
        'document.write' => '[removed]',
        '.parentNode' => '[removed]',
        '.innerHTML' => '[removed]',
        'window.location' => '[removed]',
        '-moz-binding' => '[removed]',
        '<!--' => '&lt;!--',
        '-->' => '--&gt;',
        '<!CDATA[' => '&lt;![CDATA['
    );

    foreach ($bad as $key => $val) {
      $str = str_replace($key, $val, $str);
    }

    $bad = array(
        "javascript\s*:" => '[removed]',
        "expression\s*\(" => '[removed]', // CSS and IE
        "Redirect\s+302" => '[removed]'
    );

    foreach ($bad as $key => $val) {
      $str = preg_replace("#" . $key . "#i", $val, $str);
    }


    $str = str_replace(array('<?php', '<?PHP', '<?', '?' . '>'), array('&lt;?php', '&lt;?PHP', '&lt;?', '?&gt;'), $str);


    $words = array('javascript', 'expression', 'vbscript', 'script', 'applet', 'alert', 'document', 'write', 'cookie', 'window');
    foreach ($words as $word) {
      $temp = '';
      for ($i = 0; $i < strlen($word); $i++) {
        $temp .= substr($word, $i, 1) . "\s*";
      }

      $str = preg_replace('#(' . substr($temp, 0, -3) . ')(\W)#ise', "preg_replace('/\s+/s', '', '\\1').'\\2'", $str);
    }


    do {
      $original = $str;

      if ((version_compare(PHP_VERSION, '5.0', '>=') === TRUE && stripos($str, '</a>') !== FALSE) OR
              preg_match("/<\/a>/i", $str)) {
        $str = preg_replace_callback("#<a.*?</a>#si", array($this, '_js_link_removal'), $str);
      }

      if ((version_compare(PHP_VERSION, '5.0', '>=') === TRUE && stripos($str, '<img') !== FALSE) OR
              preg_match("/img/i", $str)) {
        $str = preg_replace_callback("#<img.*?" . ">#si", array($this, '_js_img_removal'), $str);
      }

      if ((version_compare(PHP_VERSION, '5.0', '>=') === TRUE && (stripos($str, 'script') !== FALSE OR stripos($str, 'xss') !== FALSE)) OR
              preg_match("/(script|xss)/i", $str)) {
        $str = preg_replace("#</*(script|xss).*?\>#si", "", $str);
      }
    } while ($original != $str);

    unset($original);


    $event_handlers = array('onblur', 'onchange', 'onclick', 'onfocus', 'onload', 'onmouseover', 'onmouseup', 'onmousedown', 'onselect', 'onsubmit', 'onunload', 'onkeypress', 'onkeydown', 'onkeyup', 'onresize', 'xmlns');
    $str = preg_replace("#<([^>]+)(" . implode('|', $event_handlers) . ")([^>]*)>#iU", "&lt;\\1\\2\\3&gt;", $str);



    $str = preg_replace('#<(/*\s*)(alert|applet|basefont|base|behavior|bgsound|blink|body|embed|expression|form|frameset|frame|head|html|ilayer|iframe|input|layer|link|meta|object|plaintext|style|script|textarea|title|xml|xss)([^>]*)>#is', "&lt;\\1\\2\\3&gt;", $str);

    $str = preg_replace('#(alert|cmd|passthru|eval|exec|expression|system|fopen|fsockopen|file|file_get_contents|readfile|unlink)(\s*)\((.*?)\)#si', "\\1\\2&#40;\\3&#41;", $str);


    $bad = array(
        'document.cookie' => '[removed]',
        'document.write' => '[removed]',
        '.parentNode' => '[removed]',
        '.innerHTML' => '[removed]',
        'window.location' => '[removed]',
        '-moz-binding' => '[removed]',
        '<!--' => '&lt;!--',
        '-->' => '--&gt;',
        '<!CDATA[' => '&lt;![CDATA['
    );

    foreach ($bad as $key => $val) {
      $str = str_replace($key, $val, $str);
    }

    $bad = array(
        "javascript\s*:" => '[removed]',
        "expression\s*\(" => '[removed]', // CSS and IE
        "Redirect\s+302" => '[removed]'
    );

    foreach ($bad as $key => $val) {
      $str = preg_replace("#" . $key . "#i", $val, $str);
    }


    return $str;
  }

  function _js_link_removal($match) {
    return preg_replace("#<a.+?href=.*?(alert\(|alert&\#40;|javascript\:|window\.|document\.|\.cookie|<script|<xss).*?\>.*?</a>#si", "", $match[0]);
  }

  function _js_img_removal($match) {
    return preg_replace("#<img.+?src=.*?(alert\(|alert&\#40;|javascript\:|window\.|document\.|\.cookie|<script|<xss).*?\>#si", "", $match[0]);
  }

  function _attribute_conversion($match) {
    return str_replace('>', '&lt;', $match[0]);
  }

  function _html_entity_decode_callback($match) {
    return $this->_html_entity_decode($match[0], strtoupper("utf-8"));
  }

  function _html_entity_decode($str, $charset = 'UTF-8') {
    if (stristr($str, '&') === FALSE)
      return $str;


    if (function_exists('html_entity_decode') && (strtolower($charset) != 'utf-8' OR version_compare(phpversion(), '5.0.0', '>='))) {
      $str = html_entity_decode($str, ENT_COMPAT, $charset);
      $str = preg_replace('~&#x([0-9a-f]{2,5})~ei', 'chr(hexdec("\\1"))', $str);
      return preg_replace('~&#([0-9]{2,4})~e', 'chr(\\1)', $str);
    }


    $str = preg_replace('~&#x([0-9a-f]{2,5});{0,1}~ei', 'chr(hexdec("\\1"))', $str);
    $str = preg_replace('~&#([0-9]{2,4});{0,1}~e', 'chr(\\1)', $str);


    if (stristr($str, '&') === FALSE) {
      $str = strtr($str, array_flip(get_html_translation_table(HTML_ENTITIES)));
    }

    return $str;
  }

}

new Amhsoft_Security();
?>