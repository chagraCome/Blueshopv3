<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Common.php 341 2016-02-05 14:17:20Z montassar.amhsoft $
 * $Rev: 341 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-02-05 15:17:20 +0100 (ven., 05 févr. 2016) $
 * $Author: montassar.amhsoft $
 */
class Amhsoft_Common {

    public static $country;
    public $whoisservers = array(
        "ac" => "whois.nic.ac", // Ascension Island
        // ad - Andorra - no whois server assigned
        "ae" => "whois.nic.ae", // United Arab Emirates
        "aero" => "whois.aero",
        "af" => "whois.nic.af", // Afghanistan
        "ag" => "whois.nic.ag", // Antigua And Barbuda
        "ai" => "whois.ai", // Anguilla
        "al" => "whois.ripe.net", // Albania
        "am" => "whois.amnic.net", // Armenia
        // an - Netherlands Antilles - no whois server assigned
        // ao - Angola - no whois server assigned
        // aq - Antarctica (New Zealand) - no whois server assigned
        // ar - Argentina - no whois server assigned
        "arpa" => "whois.iana.org",
        "as" => "whois.nic.as", // American Samoa
        "asia" => "whois.nic.asia",
        "at" => "whois.nic.at", // Austria
        "au" => "whois.aunic.net", // Australia
        // aw - Aruba - no whois server assigned
        "ax" => "whois.ax", // Aland Islands
        "az" => "whois.ripe.net", // Azerbaijan
        // ba - Bosnia And Herzegovina - no whois server assigned
        // bb - Barbados - no whois server assigned
        // bd - Bangladesh - no whois server assigned
        "be" => "whois.dns.be", // Belgium
        "bg" => "whois.register.bg", // Bulgaria
        "bi" => "whois.nic.bi", // Burundi
        "biz" => "whois.biz",
        "bj" => "whois.nic.bj", // Benin
        // bm - Bermuda - no whois server assigned
        "bn" => "whois.bn", // Brunei Darussalam
        "bo" => "whois.nic.bo", // Bolivia
        "br" => "whois.registro.br", // Brazil
        "bt" => "whois.netnames.net", // Bhutan
        // bv - Bouvet Island (Norway) - no whois server assigned
        // bw - Botswana - no whois server assigned
        "by" => "whois.cctld.by", // Belarus
        "bz" => "whois.belizenic.bz", // Belize
        "ca" => "whois.cira.ca", // Canada
        "cat" => "whois.cat", // Spain
        "cc" => "whois.nic.cc", // Cocos (Keeling) Islands
        "cd" => "whois.nic.cd", // Congo, The Democratic Republic Of The
        // cf - Central African Republic - no whois server assigned
        "ch" => "whois.nic.ch", // Switzerland
        "ci" => "whois.nic.ci", // Cote d'Ivoire
        "ck" => "whois.nic.ck", // Cook Islands
        "cl" => "whois.nic.cl", // Chile
        // cm - Cameroon - no whois server assigned
        "cn" => "whois.cnnic.net.cn", // China
        "co" => "whois.nic.co", // Colombia
        "com" => "whois.verisign-grs.com",
        "coop" => "whois.nic.coop",
        // cr - Costa Rica - no whois server assigned
        // cu - Cuba - no whois server assigned
        // cv - Cape Verde - no whois server assigned
        // cw - Curacao - no whois server assigned
        "cx" => "whois.nic.cx", // Christmas Island
        // cy - Cyprus - no whois server assigned
        "cz" => "whois.nic.cz", // Czech Republic
        "de" => "whois.denic.de", // Germany
        // dj - Djibouti - no whois server assigned
        "dk" => "whois.dk-hostmaster.dk", // Denmark
        "dm" => "whois.nic.dm", // Dominica
        // do - Dominican Republic - no whois server assigned
        "dz" => "whois.nic.dz", // Algeria
        "ec" => "whois.nic.ec", // Ecuador
        "edu" => "whois.educause.edu",
        "ee" => "whois.eenet.ee", // Estonia
        "eg" => "whois.ripe.net", // Egypt
        // er - Eritrea - no whois server assigned
        "es" => "whois.nic.es", // Spain
        // et - Ethiopia - no whois server assigned
        "eu" => "whois.eu",
        "fi" => "whois.ficora.fi", // Finland
        // fj - Fiji - no whois server assigned
        // fk - Falkland Islands - no whois server assigned
        // fm - Micronesia, Federated States Of - no whois server assigned
        "fo" => "whois.nic.fo", // Faroe Islands
        "fr" => "whois.nic.fr", // France
        // ga - Gabon - no whois server assigned
        "gd" => "whois.nic.gd", // Grenada
        // ge - Georgia - no whois server assigned
        // gf - French Guiana - no whois server assigned
        "gg" => "whois.gg", // Guernsey
        // gh - Ghana - no whois server assigned
        "gi" => "whois2.afilias-grs.net", // Gibraltar
        "gl" => "whois.nic.gl", // Greenland (Denmark)
        // gm - Gambia - no whois server assigned
        // gn - Guinea - no whois server assigned
        "gov" => "whois.nic.gov",
        // gr - Greece - no whois server assigned
        // gt - Guatemala - no whois server assigned
        "gs" => "whois.nic.gs", // South Georgia And The South Sandwich Islands
        // gu - Guam - no whois server assigned
        // gw - Guinea-bissau - no whois server assigned
        "gy" => "whois.registry.gy", // Guyana
        "hk" => "whois.hkirc.hk", // Hong Kong
        // hm - Heard and McDonald Islands (Australia) - no whois server assigned
        "hn" => "whois.nic.hn", // Honduras
        "hr" => "whois.dns.hr", // Croatia
        "ht" => "whois.nic.ht", // Haiti
        "hu" => "whois.nic.hu", // Hungary
        // id - Indonesia - no whois server assigned
        "ie" => "whois.domainregistry.ie", // Ireland
        "il" => "whois.isoc.org.il", // Israel
        "im" => "whois.nic.im", // Isle of Man
        "in" => "whois.inregistry.net", // India
        "info" => "whois.afilias.net",
        "int" => "whois.iana.org",
        "io" => "whois.nic.io", // British Indian Ocean Territory
        "iq" => "whois.cmc.iq", // Iraq
        "ir" => "whois.nic.ir", // Iran, Islamic Republic Of
        "is" => "whois.isnic.is", // Iceland
        "it" => "whois.nic.it", // Italy
        "je" => "whois.je", // Jersey
        // jm - Jamaica - no whois server assigned
        // jo - Jordan - no whois server assigned
        "jobs" => "jobswhois.verisign-grs.com",
        "jp" => "whois.jprs.jp", // Japan
        "ke" => "whois.kenic.or.ke", // Kenya
        "kg" => "www.domain.kg", // Kyrgyzstan
        // kh - Cambodia - no whois server assigned
        "ki" => "whois.nic.ki", // Kiribati
        // km - Comoros - no whois server assigned
        // kn - Saint Kitts And Nevis - no whois server assigned
        // kp - Korea, Democratic People's Republic Of - no whois server assigned
        "kr" => "whois.kr", // Korea, Republic Of
        // kw - Kuwait - no whois server assigned
        // ky - Cayman Islands - no whois server assigned
        "kz" => "whois.nic.kz", // Kazakhstan
        "la" => "whois.nic.la", // Lao People's Democratic Republic
        // lb - Lebanon - no whois server assigned
        // lc - Saint Lucia - no whois server assigned
        "li" => "whois.nic.li", // Liechtenstein
        // lk - Sri Lanka - no whois server assigned
        "lt" => "whois.domreg.lt", // Lithuania
        "lu" => "whois.dns.lu", // Luxembourg
        "lv" => "whois.nic.lv", // Latvia
        "ly" => "whois.nic.ly", // Libya
        "ma" => "whois.iam.net.ma", // Morocco
        // mc - Monaco - no whois server assigned
        "md" => "whois.nic.md", // Moldova
        "me" => "whois.nic.me", // Montenegro
        "mg" => "whois.nic.mg", // Madagascar
        // mh - Marshall Islands - no whois server assigned
        "mil" => "whois.nic.mil",
        // mk - Macedonia, The Former Yugoslav Republic Of - no whois server assigned
        "ml" => "whois.dot.ml", // Mali
        // mm - Myanmar - no whois server assigned
        "mn" => "whois.nic.mn", // Mongolia
        "mo" => "whois.monic.mo", // Macao
        "mobi" => "whois.dotmobiregistry.net",
        "mp" => "whois.nic.mp", // Northern Mariana Islands
        // mq - Martinique (France) - no whois server assigned
        // mr - Mauritania - no whois server assigned
        "ms" => "whois.nic.ms", // Montserrat
        // mt - Malta - no whois server assigned
        "mu" => "whois.nic.mu", // Mauritius
        "museum" => "whois.museum",
        // mv - Maldives - no whois server assigned
        // mw - Malawi - no whois server assigned
        "mx" => "whois.mx", // Mexico
        "my" => "whois.domainregistry.my", // Malaysia
        // mz - Mozambique - no whois server assigned
        "na" => "whois.na-nic.com.na", // Namibia
        "name" => "whois.nic.name",
        "nc" => "whois.nc", // New Caledonia
        // ne - Niger - no whois server assigned
        "net" => "whois.verisign-grs.net",
        "nf" => "whois.nic.nf", // Norfolk Island
        "ng" => "whois.nic.net.ng", // Nigeria
        // ni - Nicaragua - no whois server assigned
        "nl" => "whois.domain-registry.nl", // Netherlands
        "no" => "whois.norid.no", // Norway
        // np - Nepal - no whois server assigned
        // nr - Nauru - no whois server assigned
        "nu" => "whois.nic.nu", // Niue
        "nz" => "whois.srs.net.nz", // New Zealand
        "om" => "whois.registry.om", // Oman
        "org" => "whois.pir.org",
        // pa - Panama - no whois server assigned
        "pe" => "kero.yachay.pe", // Peru
        "pf" => "whois.registry.pf", // French Polynesia
        // pg - Papua New Guinea - no whois server assigned
        // ph - Philippines - no whois server assigned
        // pk - Pakistan - no whois server assigned
        "pl" => "whois.dns.pl", // Poland
        "pm" => "whois.nic.pm", // Saint Pierre and Miquelon (France)
        // pn - Pitcairn (New Zealand) - no whois server assigned
        "post" => "whois.dotpostregistry.net",
        "pr" => "whois.nic.pr", // Puerto Rico
        "pro" => "whois.dotproregistry.net",
        // ps - Palestine, State of - no whois server assigned
        "pt" => "whois.dns.pt", // Portugal
        "pw" => "whois.nic.pw", // Palau
        // py - Paraguay - no whois server assigned
        "qa" => "whois.registry.qa", // Qatar
        "re" => "whois.nic.re", // Reunion (France)
        "ro" => "whois.rotld.ro", // Romania
        "rs" => "whois.rnids.rs", // Serbia
        "ru" => "whois.tcinet.ru", // Russian Federation
        // rw - Rwanda - no whois server assigned
        "sa" => "whois.nic.net.sa", // Saudi Arabia
        "sb" => "whois.nic.net.sb", // Solomon Islands
        "sc" => "whois2.afilias-grs.net", // Seychelles
        // sd - Sudan - no whois server assigned
        "se" => "whois.iis.se", // Sweden
        "sg" => "whois.sgnic.sg", // Singapore
        "sh" => "whois.nic.sh", // Saint Helena
        "si" => "whois.arnes.si", // Slovenia
        "sk" => "whois.sk-nic.sk", // Slovakia
        // sl - Sierra Leone - no whois server assigned
        "sm" => "whois.nic.sm", // San Marino
        "sn" => "whois.nic.sn", // Senegal
        "so" => "whois.nic.so", // Somalia
        // sr - Suriname - no whois server assigned
        "st" => "whois.nic.st", // Sao Tome And Principe
        "su" => "whois.tcinet.ru", // Russian Federation
        // sv - El Salvador - no whois server assigned
        "sx" => "whois.sx", // Sint Maarten (dutch Part)
        "sy" => "whois.tld.sy", // Syrian Arab Republic
        // sz - Swaziland - no whois server assigned
        "tc" => "whois.meridiantld.net", // Turks And Caicos Islands
        // td - Chad - no whois server assigned
        "tel" => "whois.nic.tel",
        "tf" => "whois.nic.tf", // French Southern Territories
        // tg - Togo - no whois server assigned
        "th" => "whois.thnic.co.th", // Thailand
        "tj" => "whois.nic.tj", // Tajikistan
        "tk" => "whois.dot.tk", // Tokelau
        "tl" => "whois.nic.tl", // Timor-leste
        "tm" => "whois.nic.tm", // Turkmenistan
        "tn" => "whois.ati.tn", // Tunisia
        "to" => "whois.tonic.to", // Tonga
        "tp" => "whois.nic.tl", // Timor-leste
        "tr" => "whois.nic.tr", // Turkey
        "travel" => "whois.nic.travel",
        // tt - Trinidad And Tobago - no whois server assigned
        "tv" => "tvwhois.verisign-grs.com", // Tuvalu
        "tw" => "whois.twnic.net.tw", // Taiwan
        "tz" => "whois.tznic.or.tz", // Tanzania, United Republic Of
        "ua" => "whois.ua", // Ukraine
        "ug" => "whois.co.ug", // Uganda
        "uk" => "whois.nic.uk", // United Kingdom
        "us" => "whois.nic.us", // United States
        "uy" => "whois.nic.org.uy", // Uruguay
        "uz" => "whois.cctld.uz", // Uzbekistan
        // va - Holy See (vatican City State) - no whois server assigned
        "vc" => "whois2.afilias-grs.net", // Saint Vincent And The Grenadines
        "ve" => "whois.nic.ve", // Venezuela
        "vg" => "whois.adamsnames.tc", // Virgin Islands, British
        // vi - Virgin Islands, US - no whois server assigned
        // vn - Viet Nam - no whois server assigned
        // vu - Vanuatu - no whois server assigned
        "wf" => "whois.nic.wf", // Wallis and Futuna
        "ws" => "whois.website.ws", // Samoa
        "xxx" => "whois.nic.xxx",
        // ye - Yemen - no whois server assigned
        "yt" => "whois.nic.yt", // Mayotte
        "yu" => "whois.ripe.net");

    public static function ToHtml($Component) {
        return htmlspecialchars($Component);
    }

    public static function ToUrl($Component) {
        return urlencode($Component);
    }

    public static function GetSQLStatementsFromLineArray($lines) {
# import file line by line
# and filter (remove) those lines, beginning with an sql comment token
        $lines = array_filter($lines, create_function('$line', 'return strpos(ltrim($line), "--") !== 0;'));

# and filter (remove) those lines, beginning with an sql notes token
        $lines = array_filter($lines, create_function('$line', 'return strpos(ltrim($line), "/*") !== 0;'));

# this is a whitelist of SQL commands, which are allowed to follow a semicolon
        $keywords = array(
            'ALTER', 'CREATE', 'DELETE', 'DROP', 'INSERT',
            'REPLACE', 'SELECT', 'SET', 'TRUNCATE', 'UPDATE', 'USE'
        );

# create the regular expression for matching the whitelisted keywords
        $regexp = sprintf('/\s*;\s*(?=(%s)\b)/s', implode('|', $keywords));

# split there
        $splitter = preg_split($regexp, implode("\r\n", $lines));

# remove trailing semicolon or whitespaces
        $splitter = array_map(create_function('$line', 'return preg_replace("/[\s;]*$/", "", $line);'), $splitter);
        return array_filter($splitter, create_function('$line', 'return !empty($line);'));
    }

    /**
     * @deprecated since version amhsoft framework 4
     * @param type $ComponentName
     * @param type $ComponentValue
     * @param type $expired
     */
    public static function _SetCookie($ComponentName, $ComponentValue, $expired = -1) {
        if ($expired == -1)
            $expired = time() + 3600 * 24 * 366;
        elseif ($expired && $expired < time())
            $expired = time() + $expired;
        @setcookie($ComponentName, $ComponentValue, $expired);
    }

    public static function SetCookie($ComponentName, $ComponentValue, $expired = -1) {
        return self::_SetCookie($ComponentName, base64_encode($ComponentValue), $expired);
    }

    /**
     * @deprecated since version amhsoft framework version 4
     * @param type $Component
     * @return type
     */
    public static function _GetCookie($Component) {
        return isset($_COOKIE[$Component]) ? $_COOKIE[$Component] : "";
    }

    public static function GetCookie($Component, $default = null) {
        return self::_GetCookie($Component) ? base64_decode(self::_GetCookie($Component)) : $default;
    }

    public static function Strip($Component) {
        if (get_magic_quotes_gpc() != 0) {
            if (is_array($Component))
                foreach ($Component as $key => $val)
                    $Component[$key] = stripslashes($val);
            else
                $Component = stripslashes($Component);
        }
        return $Component;
    }

    public static function remove_bad_chars_from_word($url, $replace_space_with = '-') {
        $url = ltrim($url);
        $url = rtrim($url);
        $code_entities_match = array('/', '\\', '"', '!', '@', '#', '$', '%', '^', '&amp;', '*', '(', ')', '+', '{', '}', '|', ':', '"', '&lt;', '&gt;', '?', '[', ']', '', ';', "'", ',', '.', '_', '/', '*', '+', '~', '`', '=', '—', '–', '–', '%', '&#037;');
        $code_entities_replace = array('');
        $url = str_replace($code_entities_match, $code_entities_replace, $url);  // for replacing
        $url = str_replace(' ', $replace_space_with, $url);
        $url = strtolower($url);
        return $url;
    }

    public static function convertToByteUnit($size) {
        $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }

    public static function GetParam($ComponentName, $default_value = null) {
        $parameter_value = null;

        if (isset($_POST[$ComponentName]))
            $parameter_value = Strip($_POST[$ComponentName]);

        else if (isset($_GET[$ComponentName]))
            $parameter_value = Strip($_GET[$ComponentName]);
        else
            $parameter_value = $default_value;

        return $parameter_value;
    }

    public static function GetFromPost($Component, $default_value = null) {
        return isset($_POST[$Component]) ? Strip($_POST[$Component]) : $default_value;
    }

    public static function GetFromGet($Component, $typ = null) {
        if ($typ == "integer")
            return isset($_GET[$Component]) ? intval($_GET[$Component]) : 0;
        else
            return isset($_GET[$Component]) ? Strip($_GET[$Component]) : "";
    }

    public static function GetQueryString($Req, $RemoveParameters = null) {

        $Result = "";
        if (is_array($Req)) {
            reset($Req);
            foreach ($Req as $ItemName => $ItemValues) {
                $Remove = false;
                if (is_array($RemoveParameters)) {
                    foreach ($RemoveParameters as $key => $val) {
                        if ($val == $ItemName) {
                            $Remove = true;
                            break;
                        }
                    }
                }
                if (!$Remove) {
                    if (is_array($ItemValues))
                        for ($J = 0; $J < sizeof($ItemValues); $J++)
                            $Result .= "&" . @urlencode(self::Strip($ItemName)) . "[]=" . @urlencode(self::Strip($ItemValues[$J]));
                    else
                        $Result .= "&" . @urlencode(self::Strip($ItemName)) . "=" . (self::Strip($ItemValues));
                }
            }
        }

        if (strlen($Result) > 0)
            $Result = substr($Result, 1);

        return $Result;
    }

    public static function QueryStringToArray($Component) {
        $pairs = explode('&', $Component);

        foreach ($pairs as $pair) {
            $new = explode('=', $pair, 2);
            $query_as_array[$new[0]] = $new[1];
        }
        return $query_as_array;
    }

    public static function AddParamToQueryString($Component, $ParameterName, $ParameterValue) {
        $queryStr = null;
        $paramStr = null;
        if (strpos($Component, '?') !== false)
            list($queryStr, $paramStr) = explode('?', $Component);
        else if (strpos($Component, '=') !== false)
            $paramStr = $Component;
        else
            $queryStr = $Component;
        $paramStr = $paramStr ? '&' . $paramStr : '';
        $paramStr = preg_replace('/&' . $ParameterName . '(\[\])?=[^&]*/', '', $paramStr);
        if (is_array($ParameterValue)) {
            foreach ($ParameterValue as $key => $val) {
                $paramStr .= "&" . urlencode($ParameterName) . "[]=" . urlencode($val);
            }
        } else {
            $paramStr .= "&" . urlencode($ParameterName) . "=" . urlencode($ParameterValue);
        }
        $paramStr = ltrim($paramStr, '&');
        return $queryStr ? $queryStr . '?' . $paramStr : $paramStr;
    }

    public static function TimestampToDate($Component) {
        $DateArray = array(0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        if (!strlen($timestamp) && !is_int($Component)) {
            $timestamp = time();
        }

        $DateArray[ccsTimestamp] = $Component;
        $DateArray[ccsYear] = date("Y", $Component);
        $DateArray[ccsMonth] = date("n", $Component);
        $DateArray[ccsDay] = date("j", $Component);
        $DateArray[ccsHour] = date("G", $Component);
        $DateArray[ccsMinute] = date("i", $Component);
        $DateArray[ccsSecond] = date("s", $Component);

        return $DateArray;
    }

    public static function CheckSSL() {
        if (isset($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) == "on")
            return true;
        return false;
    }

    public static function GetClientIp() {
        return (!empty($HTTP_SERVER_VARS['REMOTE_ADDR']) ) ? $HTTP_SERVER_VARS['REMOTE_ADDR'] : ( (!empty($HTTP_ENV_VARS['REMOTE_ADDR']) ) ? $HTTP_ENV_VARS['REMOTE_ADDR'] : getenv('REMOTE_ADDR') );
    }

    public static function GetClientHostname() {
        $ip = self::GetClientIp();
        return @gethostbyaddr($ip);
    }

    public static function getheight($img) {
        $size = getImageSize($img);
        return $size[1];
    }

    public static function getwidth($img) {
        $size = getImageSize($img);
        return $size[0];
    }

    public static function GetShortDateFromDB($Component) {
        if ($Component == "0000-00-00")
            return "";

        $new_date_entry = explode('-', $Component);
        if (count($new_date_entry) == 3) {
            $Year = $new_date_entry[0];
            $Month = $new_date_entry[1];
            $day = $new_date_entry[2];
            return $day . '-' . $Month . '-' . $Year;
        }
        return "";
    }

    public static function SetShortDate($Component) {
        if ($Component == "")
            return "NULL";

        $new_date_entry = explode('-', $Component);
        if (count($new_date_entry) == 3) {
            $Year = $new_date_entry[2];
            $Month = $new_date_entry[1];
            $day = $new_date_entry[0];
            return $Year . '-' . $Month . '-' . $day;
        }
        return "NULL";
    }

    public static function ParseDate($input, $returnFomat = 'Y-m-d H:i:s') {
//using .
    }

    public static function GetDateFromDateTimeFromDB($Component) {
        if ($Component == "0000-00-00 00:00:00")
            return NULL;

        $datum = explode(' ', $Component);
        $new_date_entry = explode('-', $datum[0]);
        $Year = $new_date_entry[0];
        $Month = $new_date_entry[1];
        $day = $new_date_entry[2];
        return $day . '.' . $Month . '.' . $Year;
    }

    public static function GetFloatFromDB($Component, $comma = 2, $decimal = ",", $thousand = ".", $with_comma = true) {
        $return = number_format($Component, $comma, DECIMAL, THOUSAND);
        if ($with_comma == false) {
            if ($return == 0)
                return "";
        }
        return $return;
    }

    public static function SetFloat($Component) {
        $Component = str_replace(",", ".", $Component);
        return $Component;
    }

    public static function Import($file) {
        if (file_exists(FrameworkPath . $file . ".php"))
            require_once(FrameworkPath . $file . ".php");
    }

    public static function full_copy($source, $target) {
        if (is_dir($source)) {
            @mkdir($target);
            $d = dir($source);
            while (FALSE !== ( $entry = $d->read() )) {
                if ($entry == '.' || $entry == '..') {
                    continue;
                }
                $Entry = $source . '/' . $entry;
                if (is_dir($Entry)) {
                    full_copy($Entry, $target . '/' . $entry);
                    continue;
                }
                copy($Entry, $target . '/' . $entry);
            }

            $d->close();
        } else {
            copy($source, $target);
        }
        return true;
    }

    public static function writeToFile($file, $content) {
        $h = fopen($file, "a+");
        fwrite($h, $content);
        fclose($h);
    }

    public static function remove_dir($dir) {
        if (is_dir($dir)) {
            $dir = (substr($dir, -1) != "/") ? $dir . "/" : $dir;
            $openDir = opendir($dir);
            while ($file = readdir($openDir)) {
                if (!in_array($file, array(".", ".."))) {
                    if (!is_dir($dir . $file))
                        @unlink($dir . $file);
                    else
                        remove_dir($dir . $file);
                }
            }
            closedir($openDir);
            rmdir($dir);
        }
    }

    /**
     * Get an array that represents directory tree
     * @param string $directory     Directory path
     * @param bool $recursive         Include sub directories
     * @param bool $listDirs         Include directories on listing
     * @param bool $listFiles         Include files on listing
     * @param regex $exclude         Exclude paths that matches this regex
     */
    public static function scandirFlat($directory, $recursive = true, $listDirs = false, $listFiles = true, $exclude = '') {
        $arrayItems = array();
        $skipByExclude = false;
        $handle = opendir($directory);
        if ($handle) {
            while (false !== ($file = readdir($handle))) {
                preg_match("/(^(([\.]){1,2})$|(\.(svn|git|md))|(Thumbs\.db|\.DS_STORE))$/iu", $file, $skip);
                if ($exclude) {
                    preg_match($exclude, $file, $skipByExclude);
                }
                if (!$skip && !$skipByExclude) {
                    if (is_dir($directory . DIRECTORY_SEPARATOR . $file)) {
                        if ($recursive) {
                            $arrayItems = array_merge($arrayItems, self::scandirFlat($directory . DIRECTORY_SEPARATOR . $file, $recursive, $listDirs, $listFiles, $exclude));
                        }
                        if ($listDirs) {
                            $file = $directory . DIRECTORY_SEPARATOR . $file;
                            $arrayItems[] = $file;
                        }
                    } else {
                        if ($listFiles) {
                            $file = $directory . DIRECTORY_SEPARATOR . $file;
                            $arrayItems[] = $file;
                        }
                    }
                }
            }
            closedir($handle);
        }
        return $arrayItems;
    }

    public static function validate_email($email) {
        $valid_address = true;

        $mail_pat = '^(.+)@(.+)$';
        $valid_chars = "[^] \(\)<>@,;:\.\\\"\[]";
        $atom = "$valid_chars+";
        $quoted_user = '(\"[^\"]*\")';
        $word = "($atom|$quoted_user)";
        $user_pat = "^$word(\.$word)*$";
        $ip_domain_pat = '^\[([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\]$';
        $domain_pat = "^$atom(\.$atom)*$";

        if (eregi($mail_pat, $email, $components)) {
            $user = $components[1];
            $domain = $components[2];
// validate user
            if (eregi($user_pat, $user)) {
// validate domain
                if (eregi($ip_domain_pat, $domain, $ip_components)) {
// this is an IP address
                    for ($i = 1; $i <= 4; $i++) {
                        if ($ip_components[$i] > 255) {
                            $valid_address = false;
                            break;
                        }
                    }
                } else {
// Domain is a name, not an IP
                    if (eregi($domain_pat, $domain)) {
                        /* domain name seems valid, but now make sure that it ends in a valid TLD or ccTLD
                          and that there's a hostname preceding the domain or country. */
                        $domain_components = explode(".", $domain);
// Make sure there's a host name preceding the domain.
                        if (sizeof($domain_components) < 2) {
                            $valid_address = false;
                        } else {

                            $top_level_domain = strtolower($domain_components[sizeof($domain_components) - 1]);
// Allow all 2-letter TLDs (ccTLDs)
                            /*
                              if (eregi('^[a-z][a-z]$', $top_level_domain) != 1) {
                              $tld_pattern = '';
                              // Get authorized TLDs from text file
                              $tlds = file(DIR_WS_INCLUDES . 'tld.txt');
                              while (list(,$line) = each($tlds)) {
                              // Get rid of comments
                              $words = explode('#', $line);
                              $tld = trim($words[0]);
                              // TLDs should be 3 letters or more
                              if (eregi('^[a-z]{3,}$', $tld) == 1) {
                              $tld_pattern .= '^' . $tld . '$|';
                              }
                              }
                              // Remove last '|'
                              $tld_pattern = substr($tld_pattern, 0, -1);
                              if (eregi("$tld_pattern", $top_level_domain) == 0) {
                              $valid_address = false;
                              }
                              } */
                        }
                    } else {
                        $valid_address = false;
                    }
                }
            } else {
                $valid_address = false;
            }
        } else {
            $valid_address = false;
        }
//	if ($valid_address && ENTRY_EMAIL_ADDRESS_CHECK == 'true') {
//		if (!checkdnsrr($domain, "MX") && !checkdnsrr($domain, "A")) {
//			$valid_address = false;
//		}
//	}
        return $valid_address;
    }

    public static function getIV() {
        return mcrypt_create_iv(mcrypt_get_block_size(MCRYPT_TripleDES, MCRYPT_MODE_CBC), MCRYPT_DEV_RANDOM);
    }

    public static function encrypt($decrypted, $password, $salt = '!kQm*fF3pXe1Kbm%9') {

        $key = hash('SHA256', $salt . $password, true);

        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);


        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);


        $iv_base64 = rtrim(base64_encode($iv), '=');



        if (strlen($iv_base64) != 43)
            return false;

        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $decrypted . md5($decrypted), MCRYPT_MODE_ECB, $iv));

        return $iv_base64 . $encrypted;
    }

    public static function decrypt($encrypted, $password, $salt = '!kQm*fF3pXe1Kbm%9') {
// Build a 256-bit $key which is a SHA256 hash of $salt and $password.
        $key = hash('SHA256', $salt . $password, true);

// Retrieve $iv which is the first 22 characters plus ==, base64_decoded.
        $iv = base64_decode(substr($encrypted, 0, 43) . '==');
// Remove $iv from $encrypted.
        $base64_encrypted = substr($encrypted, 43);
// Decrypt the data.  rtrim won't corrupt the data because the last 32 characters are the md5 hash; thus any \0 character has to be padding.
        $decrypted_with_hash = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($base64_encrypted), MCRYPT_MODE_ECB, $iv), "\0\4");



// Retrieve $hash which is the last 32 characters of $decrypted.
        $hash = substr($decrypted_with_hash, -32);

// Remove the last 32 characters from $decrypted.
        $decrypted = substr($decrypted_with_hash, 0, -32);

// Integrity check.  If this fails, either the data is corrupted, or the password/salt was incorrect.
        if (md5($decrypted) != $hash)
            return false;

// Yay!
        return $decrypted;
    }

    public static function encryptData($string) {
        $key = "sectet_key11111";
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
    }

    public static function decryptData($string) {
        $key = "sectet_key11111";
        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    }

    public static function makeKeywords($text = null) {
        if ($text == null)
            return "";

        $data = @explode(" ", str_replace("  ", " ", $text));

        return @implode(", ", $data);
    }

    /**
     *
     * @param $file
     * @param $dirPath
     * @param $maxSize
     * @param $allowed
     * @return array  array[0]: file_path, array[1]:file_extension, array[1]:file_body_name
     * @return bool;
     */
    public static function upload_file($file, $dirPath = '', $maxSize = 100000000, $allowed = array()) {
        foreach ($file as $key => $val)
            $$key = $val;


        if ((!is_uploaded_file($tmp_name)) || ($error != 0) || ($size == 0) || ($size > $maxSize))
            return false;    // file failed basic validation checks

        if ((is_array($allowed)) && (!empty($allowed)))
            if (!in_array($type, $allowed))
                return false;    // file is not an allowed type
//exit;
        $path = rtrim($dirPath, '/') . '/' . $name;

        $info = pathinfo($path);
        if (@move_uploaded_file($tmp_name, $path)) {
            @chmod($path . $tmp_name, 0777);
            if ($info)
                return array($path, $info["extension"], null);
            return false;
        }

        return false;
    }

    public static function __($var) {
        if (get_magic_quotes_gpc()) {
            $var = addslashes($var);
        }
        return $var;
    }

    public static function randomPassword($length) {
        $chars = "234567890abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $i = 0;
        $password = "";
        while ($i <= $length) {
            $password .= $chars{mt_rand(0, strlen($chars) - 1)};
            $i++;
        }
        return $password;
    }

    public static function generateCode($blocCount, $blocLength, $blockSep = '-') {
        $chars = "234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $blocks = array();
        for ($j = 0; $j < $blocCount; $j++) {
            $password = "";
            $i = 0;
            while ($i < $blocLength) {
                $password .= $chars{mt_rand(0, strlen($chars) - 1)};
                $i++;
            }
            $blocks[] = $password;
        }
        return implode($blockSep, $blocks);
    }

    public function uploadTo($file, $destination) {
        if (is_uploaded_file($file['tmp_name'])) {
            move_uploaded_file($file['tmp_name'], $destination);
        }
    }

    public static function force_download($filename = '', $data = '', $mime = 'application/octet-stream') {
        if ($filename == '' OR $data == '') {
            return FALSE;
        }

// Try to determine if the filename includes a file extension.
// We need it in order to set the MIME type
        if (FALSE === strpos($filename, '.')) {
            return FALSE;
        }

// Grab the file extension
        $x = explode('.', $filename);
        $extension = end($x);

        if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")) {
            header('Content-Type: "' . $mime . '"');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header("Content-Transfer-Encoding: binary");
            header('Pragma: public');
            header("Content-Length: " . strlen($data));
        } else {
            header('Content-Type: "' . $mime . '"');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header("Content-Transfer-Encoding: binary");
            header('Expires: 0');
            header('Pragma: no-cache');
            header("Content-Length: " . strlen($data));
        }

        echo $data;
    }

    public static function get_file_extension($file_name) {
        return substr(strrchr($file_name, '.'), 1);
    }

    public static function csv_to_array($filename = '', $delimiter = ',') {
        if (!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = @array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }

    public static function LookupDomain($domain) {
        $whoisservers = array(
            "ac" => "whois.nic.ac", // Ascension Island
            // ad - Andorra - no whois server assigned
            "ae" => "whois.nic.ae", // United Arab Emirates
            "aero" => "whois.aero",
            "af" => "whois.nic.af", // Afghanistan
            "ag" => "whois.nic.ag", // Antigua And Barbuda
            "ai" => "whois.ai", // Anguilla
            "al" => "whois.ripe.net", // Albania
            "am" => "whois.amnic.net", // Armenia
            // an - Netherlands Antilles - no whois server assigned
            // ao - Angola - no whois server assigned
            // aq - Antarctica (New Zealand) - no whois server assigned
            // ar - Argentina - no whois server assigned
            "arpa" => "whois.iana.org",
            "as" => "whois.nic.as", // American Samoa
            "asia" => "whois.nic.asia",
            "at" => "whois.nic.at", // Austria
            "au" => "whois.aunic.net", // Australia
            // aw - Aruba - no whois server assigned
            "ax" => "whois.ax", // Aland Islands
            "az" => "whois.ripe.net", // Azerbaijan
            // ba - Bosnia And Herzegovina - no whois server assigned
            // bb - Barbados - no whois server assigned
            // bd - Bangladesh - no whois server assigned
            "be" => "whois.dns.be", // Belgium
            "bg" => "whois.register.bg", // Bulgaria
            "bi" => "whois.nic.bi", // Burundi
            "biz" => "whois.biz",
            "bj" => "whois.nic.bj", // Benin
            // bm - Bermuda - no whois server assigned
            "bn" => "whois.bn", // Brunei Darussalam
            "bo" => "whois.nic.bo", // Bolivia
            "br" => "whois.registro.br", // Brazil
            "bt" => "whois.netnames.net", // Bhutan
            // bv - Bouvet Island (Norway) - no whois server assigned
            // bw - Botswana - no whois server assigned
            "by" => "whois.cctld.by", // Belarus
            "bz" => "whois.belizenic.bz", // Belize
            "ca" => "whois.cira.ca", // Canada
            "cat" => "whois.cat", // Spain
            "cc" => "whois.nic.cc", // Cocos (Keeling) Islands
            "cd" => "whois.nic.cd", // Congo, The Democratic Republic Of The
            // cf - Central African Republic - no whois server assigned
            "ch" => "whois.nic.ch", // Switzerland
            "ci" => "whois.nic.ci", // Cote d'Ivoire
            "ck" => "whois.nic.ck", // Cook Islands
            "cl" => "whois.nic.cl", // Chile
            // cm - Cameroon - no whois server assigned
            "cn" => "whois.cnnic.net.cn", // China
            "co" => "whois.nic.co", // Colombia
            "com" => "whois.verisign-grs.com",
            "coop" => "whois.nic.coop",
            // cr - Costa Rica - no whois server assigned
            // cu - Cuba - no whois server assigned
            // cv - Cape Verde - no whois server assigned
            // cw - Curacao - no whois server assigned
            "cx" => "whois.nic.cx", // Christmas Island
            // cy - Cyprus - no whois server assigned
            "cz" => "whois.nic.cz", // Czech Republic
            "de" => "whois.denic.de", // Germany
            // dj - Djibouti - no whois server assigned
            "dk" => "whois.dk-hostmaster.dk", // Denmark
            "dm" => "whois.nic.dm", // Dominica
            // do - Dominican Republic - no whois server assigned
            "dz" => "whois.nic.dz", // Algeria
            "ec" => "whois.nic.ec", // Ecuador
            "edu" => "whois.educause.edu",
            "ee" => "whois.eenet.ee", // Estonia
            "eg" => "whois.ripe.net", // Egypt
            // er - Eritrea - no whois server assigned
            "es" => "whois.nic.es", // Spain
            // et - Ethiopia - no whois server assigned
            "eu" => "whois.eu",
            "fi" => "whois.ficora.fi", // Finland
            // fj - Fiji - no whois server assigned
            // fk - Falkland Islands - no whois server assigned
            // fm - Micronesia, Federated States Of - no whois server assigned
            "fo" => "whois.nic.fo", // Faroe Islands
            "fr" => "whois.nic.fr", // France
            // ga - Gabon - no whois server assigned
            "gd" => "whois.nic.gd", // Grenada
            // ge - Georgia - no whois server assigned
            // gf - French Guiana - no whois server assigned
            "gg" => "whois.gg", // Guernsey
            // gh - Ghana - no whois server assigned
            "gi" => "whois2.afilias-grs.net", // Gibraltar
            "gl" => "whois.nic.gl", // Greenland (Denmark)
            // gm - Gambia - no whois server assigned
            // gn - Guinea - no whois server assigned
            "gov" => "whois.nic.gov",
            // gr - Greece - no whois server assigned
            // gt - Guatemala - no whois server assigned
            "gs" => "whois.nic.gs", // South Georgia And The South Sandwich Islands
            // gu - Guam - no whois server assigned
            // gw - Guinea-bissau - no whois server assigned
            "gy" => "whois.registry.gy", // Guyana
            "hk" => "whois.hkirc.hk", // Hong Kong
            // hm - Heard and McDonald Islands (Australia) - no whois server assigned
            "hn" => "whois.nic.hn", // Honduras
            "hr" => "whois.dns.hr", // Croatia
            "ht" => "whois.nic.ht", // Haiti
            "hu" => "whois.nic.hu", // Hungary
            // id - Indonesia - no whois server assigned
            "ie" => "whois.domainregistry.ie", // Ireland
            "il" => "whois.isoc.org.il", // Israel
            "im" => "whois.nic.im", // Isle of Man
            "in" => "whois.inregistry.net", // India
            "info" => "whois.afilias.net",
            "int" => "whois.iana.org",
            "io" => "whois.nic.io", // British Indian Ocean Territory
            "iq" => "whois.cmc.iq", // Iraq
            "ir" => "whois.nic.ir", // Iran, Islamic Republic Of
            "is" => "whois.isnic.is", // Iceland
            "it" => "whois.nic.it", // Italy
            "je" => "whois.je", // Jersey
            // jm - Jamaica - no whois server assigned
            // jo - Jordan - no whois server assigned
            "jobs" => "jobswhois.verisign-grs.com",
            "jp" => "whois.jprs.jp", // Japan
            "ke" => "whois.kenic.or.ke", // Kenya
            "kg" => "www.domain.kg", // Kyrgyzstan
            // kh - Cambodia - no whois server assigned
            "ki" => "whois.nic.ki", // Kiribati
            // km - Comoros - no whois server assigned
            // kn - Saint Kitts And Nevis - no whois server assigned
            // kp - Korea, Democratic People's Republic Of - no whois server assigned
            "kr" => "whois.kr", // Korea, Republic Of
            // kw - Kuwait - no whois server assigned
            // ky - Cayman Islands - no whois server assigned
            "kz" => "whois.nic.kz", // Kazakhstan
            "la" => "whois.nic.la", // Lao People's Democratic Republic
            // lb - Lebanon - no whois server assigned
            // lc - Saint Lucia - no whois server assigned
            "li" => "whois.nic.li", // Liechtenstein
            // lk - Sri Lanka - no whois server assigned
            "lt" => "whois.domreg.lt", // Lithuania
            "lu" => "whois.dns.lu", // Luxembourg
            "lv" => "whois.nic.lv", // Latvia
            "ly" => "whois.nic.ly", // Libya
            "ma" => "whois.iam.net.ma", // Morocco
            // mc - Monaco - no whois server assigned
            "md" => "whois.nic.md", // Moldova
            "me" => "whois.nic.me", // Montenegro
            "mg" => "whois.nic.mg", // Madagascar
            // mh - Marshall Islands - no whois server assigned
            "mil" => "whois.nic.mil",
            // mk - Macedonia, The Former Yugoslav Republic Of - no whois server assigned
            "ml" => "whois.dot.ml", // Mali
            // mm - Myanmar - no whois server assigned
            "mn" => "whois.nic.mn", // Mongolia
            "mo" => "whois.monic.mo", // Macao
            "mobi" => "whois.dotmobiregistry.net",
            "mp" => "whois.nic.mp", // Northern Mariana Islands
            // mq - Martinique (France) - no whois server assigned
            // mr - Mauritania - no whois server assigned
            "ms" => "whois.nic.ms", // Montserrat
            // mt - Malta - no whois server assigned
            "mu" => "whois.nic.mu", // Mauritius
            "museum" => "whois.museum",
            // mv - Maldives - no whois server assigned
            // mw - Malawi - no whois server assigned
            "mx" => "whois.mx", // Mexico
            "my" => "whois.domainregistry.my", // Malaysia
            // mz - Mozambique - no whois server assigned
            "na" => "whois.na-nic.com.na", // Namibia
            "name" => "whois.nic.name",
            "nc" => "whois.nc", // New Caledonia
            // ne - Niger - no whois server assigned
            "net" => "whois.verisign-grs.net",
            "nf" => "whois.nic.nf", // Norfolk Island
            "ng" => "whois.nic.net.ng", // Nigeria
            // ni - Nicaragua - no whois server assigned
            "nl" => "whois.domain-registry.nl", // Netherlands
            "no" => "whois.norid.no", // Norway
            // np - Nepal - no whois server assigned
            // nr - Nauru - no whois server assigned
            "nu" => "whois.nic.nu", // Niue
            "nz" => "whois.srs.net.nz", // New Zealand
            "om" => "whois.registry.om", // Oman
            "org" => "whois.pir.org",
            // pa - Panama - no whois server assigned
            "pe" => "kero.yachay.pe", // Peru
            "pf" => "whois.registry.pf", // French Polynesia
            // pg - Papua New Guinea - no whois server assigned
            // ph - Philippines - no whois server assigned
            // pk - Pakistan - no whois server assigned
            "pl" => "whois.dns.pl", // Poland
            "pm" => "whois.nic.pm", // Saint Pierre and Miquelon (France)
            // pn - Pitcairn (New Zealand) - no whois server assigned
            "post" => "whois.dotpostregistry.net",
            "pr" => "whois.nic.pr", // Puerto Rico
            "pro" => "whois.dotproregistry.net",
            // ps - Palestine, State of - no whois server assigned
            "pt" => "whois.dns.pt", // Portugal
            "pw" => "whois.nic.pw", // Palau
            // py - Paraguay - no whois server assigned
            "qa" => "whois.registry.qa", // Qatar
            "re" => "whois.nic.re", // Reunion (France)
            "ro" => "whois.rotld.ro", // Romania
            "rs" => "whois.rnids.rs", // Serbia
            "ru" => "whois.tcinet.ru", // Russian Federation
            // rw - Rwanda - no whois server assigned
            "sa" => "whois.nic.net.sa", // Saudi Arabia
            "sb" => "whois.nic.net.sb", // Solomon Islands
            "sc" => "whois2.afilias-grs.net", // Seychelles
            // sd - Sudan - no whois server assigned
            "se" => "whois.iis.se", // Sweden
            "sg" => "whois.sgnic.sg", // Singapore
            "sh" => "whois.nic.sh", // Saint Helena
            "si" => "whois.arnes.si", // Slovenia
            "sk" => "whois.sk-nic.sk", // Slovakia
            // sl - Sierra Leone - no whois server assigned
            "sm" => "whois.nic.sm", // San Marino
            "sn" => "whois.nic.sn", // Senegal
            "so" => "whois.nic.so", // Somalia
            // sr - Suriname - no whois server assigned
            "st" => "whois.nic.st", // Sao Tome And Principe
            "su" => "whois.tcinet.ru", // Russian Federation
            // sv - El Salvador - no whois server assigned
            "sx" => "whois.sx", // Sint Maarten (dutch Part)
            "sy" => "whois.tld.sy", // Syrian Arab Republic
            // sz - Swaziland - no whois server assigned
            "tc" => "whois.meridiantld.net", // Turks And Caicos Islands
            // td - Chad - no whois server assigned
            "tel" => "whois.nic.tel",
            "tf" => "whois.nic.tf", // French Southern Territories
            // tg - Togo - no whois server assigned
            "th" => "whois.thnic.co.th", // Thailand
            "tj" => "whois.nic.tj", // Tajikistan
            "tk" => "whois.dot.tk", // Tokelau
            "tl" => "whois.nic.tl", // Timor-leste
            "tm" => "whois.nic.tm", // Turkmenistan
            "tn" => "whois.ati.tn", // Tunisia
            "to" => "whois.tonic.to", // Tonga
            "tp" => "whois.nic.tl", // Timor-leste
            "tr" => "whois.nic.tr", // Turkey
            "travel" => "whois.nic.travel",
            // tt - Trinidad And Tobago - no whois server assigned
            "tv" => "tvwhois.verisign-grs.com", // Tuvalu
            "tw" => "whois.twnic.net.tw", // Taiwan
            "tz" => "whois.tznic.or.tz", // Tanzania, United Republic Of
            "ua" => "whois.ua", // Ukraine
            "ug" => "whois.co.ug", // Uganda
            "uk" => "whois.nic.uk", // United Kingdom
            "us" => "whois.nic.us", // United States
            "uy" => "whois.nic.org.uy", // Uruguay
            "uz" => "whois.cctld.uz", // Uzbekistan
            // va - Holy See (vatican City State) - no whois server assigned
            "vc" => "whois2.afilias-grs.net", // Saint Vincent And The Grenadines
            "ve" => "whois.nic.ve", // Venezuela
            "vg" => "whois.adamsnames.tc", // Virgin Islands, British
            // vi - Virgin Islands, US - no whois server assigned
            // vn - Viet Nam - no whois server assigned
            // vu - Vanuatu - no whois server assigned
            "wf" => "whois.nic.wf", // Wallis and Futuna
            "ws" => "whois.website.ws", // Samoa
            "xxx" => "whois.nic.xxx",
            // ye - Yemen - no whois server assigned
            "yt" => "whois.nic.yt", // Mayotte
            "yu" => "whois.ripe.net");

        $domain_parts = explode(".", $domain);
        $tld = strtolower(array_pop($domain_parts));
        $whoisserver = $whoisservers[$tld];
        if (!$whoisserver) {
            return "Error: No appropriate Whois server found for $domain domain!";
        }
        $result = self::QueryWhoisServer($whoisserver, $domain);
        if (!$result) {
            return "Error: No results retrieved from $whoisserver server for $domain domain!";
        } else {
            while (strpos($result, "Whois Server:") !== FALSE) {
                preg_match("/Whois Server: (.*)/", $result, $matches);
                $secondary = $matches[1];
                if ($secondary) {
                    $result = self::QueryWhoisServer($secondary, $domain);
                    $whoisserver = $secondary;
                }
            }
        }
        return "$domain domain lookup results from $whoisserver server:\n\n" . $result;
    }

    public static function LookupIP($ip) {
        $whoisservers = array(
            //"whois.afrinic.net", // Africa - returns timeout error :-(
            "whois.lacnic.net", // Latin America and Caribbean - returns data for ALL locations worldwide :-)
            "whois.apnic.net", // Asia/Pacific only
            "whois.arin.net", // North America only
            "whois.ripe.net" // Europe, Middle East and Central Asia only
        );
        $results = array();
        foreach ($whoisservers as $whoisserver) {
            $result = self::QueryWhoisServer($whoisserver, $ip);
            if ($result && !in_array($result, $results)) {
                $results[$whoisserver] = $result;
            }
        }
        $res = "RESULTS FOUND: " . count($results);
        foreach ($results as $whoisserver => $result) {
            $res .= "\n\n-------------\nLookup results for " . $ip . " from " . $whoisserver . " server:\n\n" . $result;
        }
        return $res;
    }

    public static function ValidateIP($ip) {
        $ipnums = explode(".", $ip);
        if (count($ipnums) != 4) {
            return false;
        }
        foreach ($ipnums as $ipnum) {
            if (!is_numeric($ipnum) || ($ipnum > 255)) {
                return false;
            }
        }
        return $ip;
    }

    public static function ValidateDomain($domain) {
        if (!preg_match("/^([-a-z0-9]{2,100})\.([a-z\.]{2,8})$/i", $domain)) {
            return false;
        }
        return $domain;
    }

    public static function QueryWhoisServer($whoisserver, $domain) {
        $port = 43;
        $timeout = 10;
        $fp = @fsockopen($whoisserver, $port, $errno, $errstr, $timeout) or die("Socket Error " . $errno . " - " . $errstr);
        //if($whoisserver == "whois.verisign-grs.com") $domain = "=".$domain; // whois.verisign-grs.com requires the equals sign ("=") or it returns any result containing the searched string.
        fputs($fp, $domain . "\r\n");
        $out = "";
        while (!feof($fp)) {
            $out .= fgets($fp);
        }
        fclose($fp);

        $res = "";
        if ((strpos(strtolower($out), "error") === FALSE) && (strpos(strtolower($out), "not allocated") === FALSE)) {
            $rows = explode("\n", $out);
            foreach ($rows as $row) {
                $row = trim($row);
                if (($row != '') && ($row{0} != '#') && ($row{0} != '%')) {
                    $res .= $row . "\n";
                }
            }
        }
        return $res;
    }

    public static function CsrfGenrateToken($formName) {
        if (function_exists("hash_algos") and in_array("sha512", hash_algos())) {
            $token = hash("sha512", mt_rand(0, mt_getrandmax()));
        } else {
            $token = ' ';
            for ($i = 0; $i < 128; ++$i) {
                $r = mt_rand(0, 35);
                if ($r < 26) {
                    $c = chr(ord('a') + $r);
                } else {
                    $c = chr(ord('0') + $r - 26);
                }
                $token.=$c;
            }
        }
        Amhsoft_Session::write($formName, $token);
        return $token;
    }

    public static function CsrfValidateToken($formName, $tokenValue) {
        $token = Amhsoft_Session::read($formName);
        if (!$token) {
            return false;
        } elseif ($token == $tokenValue) {
            $result = true;
        } else {
            $result = false;
        }
        Amhsoft_Session::destroy($formName);
        return $result;
    }

    public static function getCountry() {
        if (self::$country == null) {
            $ip = self::GetClientIp();
            if ($ip) {
                $sql = "SELECT iso_code_3 FROM ip2nationCountries WHERE code = (SELECT country FROM ip2nation WHERE ip < INET_ATON('" . $ip . "') ORDER BY ip DESC LIMIT 0,1)";
                $result = Amhsoft_Database::querySingle($sql);
                return $result;
            }
        } else {
            return self::$country;
        }
    }

    public static function error2string($value) {
        $array = explode('^', $value);
        $errorReporting = E_ALL;
        foreach ($array as $err) {
            if ($err == 'E_NOTICE') {
                $errorReporting.= E_NOTICE;
            }
            if ($err == 'E_WARNING') {
                $errorReporting.= E_WARNING;
            }
            if ($err == 'E_DEPRECATED') {
                $errorReporting.= E_DEPRECATED;
            }
            if ($err == 'E_STRICT') {
                $errorReporting.= E_STRICT;
            }
        }

        return $errorReporting;
    }

}

function sort_array_by_str_length($a, $b) {
    return strlen($b) - strlen($a);
}

?>