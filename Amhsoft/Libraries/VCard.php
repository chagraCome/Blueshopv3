<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VCard
 *
 * @author Pirate007
 */
class Amhsoft_VCard {

    var $properties;
    var $filename;

    function setPhoneNumber($number, $type = "") {
        // type may be PREF | WORK | HOME | VOICE | FAX | MSG | CELL | PAGER | BBS | CAR | MODEM | ISDN | VIDEO or any senseful combination, e.g. "PREF;WORK;VOICE"
        $key = "TEL";
        if ($type != "")
            $key .= ";" . $type;
        // $key.= ";ENCODING=QUOTED-PRINTABLE";
        $this->properties[$key] = quoted_printable_encode($number);
    }

    function setFormattedName($name) {
        $this->properties["FN"] = $name;
    }

    function setName($family = "", $first = "", $additional = "", $prefix = "", $suffix = "") {
        $this->properties["N"] = "$first;$additional;$prefix;$suffix";
        $this->filename = "$first%20$family.vcf";
        if (@$this->properties["FN"] == "")
            $this->setFormattedName(trim("$prefix $first $additional $family $suffix"));
    }

    function setBirthday($date) { // $date format is YYYY-MM-DD
        $this->properties["BDAY"] = $date;
    }

    function setAddress($postoffice = "", $extended = "", $street = "", $city = "", $region = "", $zip = "", $country = "", $type = "HOME;POSTAL") {
        // $type may be DOM | INTL | POSTAL | PARCEL | HOME | WORK or any combination of these: e.g. "WORK;PARCEL;POSTAL"
        $key = "ADR";
        if ($type != "")
            $key.= ";$type";
        $key.= ";ENCODING=QUOTED-PRINTABLE";
        $this->properties[$key] = encode($extended) . ";" . encode($street) . ";" . encode($city) . ";" . encode($region) . ";" . encode($zip) . ";" . encode($country);

        if (@$this->properties["LABEL;$type;ENCODING=QUOTED-PRINTABLE"] == "") {
            $this->setLabel($postoffice, $extended, $street, $city, $region, $zip, $country, $type);
        }
    }

    function setLabel($postoffice = "", $extended = "", $street = "", $city = "", $region = "", $zip = "", $country = "", $type = "HOME;POSTAL") {
        $label = "";
        if ($postoffice != "")
            $label.= "$postoffice\r\n";
        if ($extended != "")
            $label.= "$extended\r\n";
        if ($street != "")
            $label.= "$street\r\n";
        if ($zip != "")
            $label.= "$zip ";
        if ($city != "")
            $label.= "$city\r\n";
        if ($region != "")
            $label.= "$region\r\n";
        if ($country != "")
            $country.= "$country\r\n";

        $this->properties["LABEL;$type;ENCODING=QUOTED-PRINTABLE"] = quoted_printable_encode($label);
    }

    function setEmail($address) {
        $this->properties["EMAIL;INTERNET"] = $address;
    }

    function setNote($note) {
        $this->properties["NOTE"] = $note;
    }

    function setURL($url, $type = "") {
        // $type may be WORK | HOME
        $key = "URL";
        if ($type != "")
            $key.= ";$type";
        $this->properties[$key] = $url;
    }

    function getVCard() {
        $text = "BEGIN:VCARD\r\n";
        $text.= "VERSION:2.1\r\n";
        foreach ($this->properties as $key => $value) {

            if ($key == 'N' || $key == 'N') {
                $text.= "$key;CHARSET=utf-8:$value\r\n";
            } else {
                $text.= "$key:$value\r\n";
            }
        }
        $text.= "REV:" . date("Y-m-d") . "T" . date("H:i:s") . "Z\r\n";
        $text.= "END:VCARD\r\n";
        return $text;
    }

    function getFileName() {
        return $this->filename;
    }

}

function encode($string) {
    return escape(quoted_printable_encode($string));
}

function escape($string) {
    return str_replace(";", "\;", $string);
}
