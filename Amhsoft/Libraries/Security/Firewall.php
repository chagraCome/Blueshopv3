<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Firewall.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package  Amhsoft Srcurity
 * @copyright  2005-2013 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Security_Firewall {

  public static function protect( $stop = true, $log = false, $mail = null) {
    $array = array_merge((array)$_POST, (array)$_GET, (array)$_COOKIE, (array)@$_SESSION);
    $affected = self::detectXSSInArray($array) | self::detectInjectionInArray($array);
    
    if ($affected) {
      if ($stop == true) {
        die("Possible Attack!");
      }
      if ($log) {
        $headers = "From: PHP Firewall: " . $mail . " <" . $mail . ">\r\n"
                . "Reply-To: " . $mail . "\r\n"
                . "Priority: urgent\r\n"
                . "Importance: High\r\n"
                . "Precedence: special-delivery\r\n"
                . "Organization: PHP Firewall\r\n"
                . "MIME-Version: 1.0\r\n"
                . "Content-Type: text/plain\r\n"
                . "Content-Transfer-Encoding: 8bit\r\n"
                . "X-Priority: 1\r\n"
                . "X-MSMail-Priority: High\r\n"
                . "X-Mailer: PHP/" . phpversion() . "\r\n"
                . "X-PHPFirewall: 1.0 by PHPFirewall\r\n"
                . "Date:" . date("D, d M Y H:s:i") . " +0100\n";
        if ($mail) {
          @mail($mail, $subject, 'Possible Attack!', $headers);
        }
      }
    }
  }

  /**
   * A utility function to manage nested array structures, checking
   * each value for possible XSS. Function returns boolean if XSS is
   * found.
   *
   * @param array $array
   *  An array of data to check, this can be nested arrays.
   * @return boolean
   *  True if XSS is detected, false otherwise
   */
  protected static function detectInjectionInArray(array $array) {
    foreach ($array as $value) {
      if (is_array($value)) {
        return self::detectInjectionInArray($value);
      } else {
        if (self::detectInjection($value) === TRUE)
          return TRUE;
      }
    }

    return FALSE;
  }

  /**
   * Given a string, this function will determine if it potentially an
   * XSS attack and return boolean.
   *
   * @param string $string
   *  The string to run XSS detection logic on
   * @return boolean
   *  True if the given `$string` contains XSS, false otherwise.
   */
  protected static function detectInjection($string) {
    $contains_injection = FALSE;

    // Skip any null or non string values
    if (is_null($string) || !is_string($string)) {
      return $contains_injection;
    }

    // URL decode
    $string = urldecode($string);

    // Convert Hexadecimals
    $string = preg_replace('!(&#|\\\)[xX]([0-9a-fA-F]+);?!e', 'chr(hexdec("$2"))', $string);

    // Clean up entities
    $string = preg_replace('!(&#0+[0-9]+)!', '$1;', $string);

    // Decode entities
    $string = html_entity_decode($string, ENT_NOQUOTES, 'UTF-8');

  

    if (preg_match('/(UNI\*\*ON|OR 1=1|AND 1=1|1 EXEC XP_)/i', $string)) {
      return true;
    }elseif(preg_match("/[\s]OR[\s](.*)[\s]*=[\s]*(.*)/i", $string)){
    return true;
    }
     elseif (preg_match('/(&#x31;|&#x27;|&#x20;|&#x4F;|&#x52;|&#x3D;|&#49&#39&#32&#79&#82&#32&#39&#49&#39&#61&#39&#49|%31%27%20%4F%52%20%27%31%27%3D%27%31)/i', $string)) {
      return true;
    } elseif (preg_match('/(SELECT\s[\w\*\)\(\,\s]+\sFROM\s[\w]+)| (UPDATE\s[\w]+\sSET\s[\w\,\'\=]+)| (INSERT\sINTO\s[\d\w]+[\s\w\d\)\(\,]*\sVALUES\s\([\d\w\'\,\)]+)| (DELETE\sFROM\s[\d\w\'\=]+)/i', $string)) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * A utility function to manage nested array structures, checking
   * each value for possible XSS. Function returns boolean if XSS is
   * found.
   *
   * @param array $array
   *  An array of data to check, this can be nested arrays.
   * @return boolean
   *  True if XSS is detected, false otherwise
   */
  protected static function detectXSSInArray(array $array) {
    foreach ($array as $value) {
      if (is_array($value)) {
        return self::detectXSSInArray($value);
      } else {
        if (self::detectXSS($value) === TRUE)
          return TRUE;
      }
    }

    return FALSE;
  }

  /**
   * Given a string, this function will determine if it potentially an
   * XSS attack and return boolean.
   *
   * @param string $string
   *  The string to run XSS detection logic on
   * @return boolean
   *  True if the given `$string` contains XSS, false otherwise.
   */
  protected static function detectXSS($string) {
    $contains_xss = FALSE;

    // Skip any null or non string values
    if (is_null($string) || !is_string($string)) {
      return $contains_xss;
    }

    // Keep a copy of the original string before cleaning up
    $orig = $string;

    // URL decode
    $string = urldecode($string);

    // Convert Hexadecimals
    $string = preg_replace('!(&#|\\\)[xX]([0-9a-fA-F]+);?!e', 'chr(hexdec("$2"))', $string);

    // Clean up entities
    $string = preg_replace('!(&#0+[0-9]+)!', '$1;', $string);

    // Decode entities
    $string = html_entity_decode($string, ENT_NOQUOTES, 'UTF-8');

    // Strip whitespace characters
    $string = preg_replace('!\s!', '', $string);

    // Set the patterns we'll test against
    $patterns = array(
        // Match any attribute starting with "on" or xmlns
        '#(<[^>]+[\x00-\x20\"\'\/])(on|xmlns)[^>]*>?#iUu',
        // Match javascript:, livescript:, vbscript: and mocha: protocols
        '!((java|live|vb)script|mocha|feed|data):(\w)*!iUu',
        '#-moz-binding[\x00-\x20]*:#u',
        // Match style attributes
        '#(<[^>]+[\x00-\x20\"\'\/])style=[^>]*>?#iUu',
        // Match unneeded tags
        '#</*(img|applet|meta|xml|blink|link|style|script|embed|object|iframe|frame|frameset|ilayer|layer|bgsound|title|base)[^>]*>?#i'
    );

    foreach ($patterns as $pattern) {
      // Test both the original string and clean string
      if (preg_match($pattern, $string) || preg_match($pattern, $orig)) {
        $contains_xss = TRUE;
      }
      if ($contains_xss === TRUE)
        return TRUE;
    }

    return FALSE;
  }

}

