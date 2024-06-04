<?php

namespace App\Utils;


class Tools
{
//    public static function getBrightness($hex)
//    {
//        if (Tools::strtolower($hex) == 'transparent') {
//            return '129';
//        }
//
//        $hex = str_replace('#', '', $hex);
//
//        if (Tools::strlen($hex) == 3) {
//            $hex .= $hex;
//        }
//
//        $r = hexdec(substr($hex, 0, 2));
//        $g = hexdec(substr($hex, 2, 2));
//        $b = hexdec(substr($hex, 4, 2));
//        return (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
//    }
//
//    public static function strtolower($str)
//    {
//        if (is_array($str)) {
//            return false;
//        }
//        if (function_exists('mb_strtolower')) {
//            return mb_strtolower($str, 'utf-8');
//        }
//        return strtolower($str);
//    }

    public static function strlen($str, $encoding = 'UTF-8')
    {
        if (is_array($str)) {
            return false;
        }
        $str = html_entity_decode($str, ENT_COMPAT, 'UTF-8');
        if (function_exists('mb_strlen')) {
            return mb_strlen($str, $encoding);
        }
        return strlen($str);
    }

    public static function dateYears()
    {
        $tab = array();
        for ($i = date('Y'); $i >= 1900; $i--) {
            $tab[] = $i;
        }
        return $tab;
    }

    public static function dateDays()
    {
        $tab = array();
        for ($i = 1; $i != 32; $i++) {
            $tab[] = $i;
        }
        return $tab;
    }

    public static function dateMonths()
    {
        $tab = array();
        for ($i = 1; $i != 13; $i++) {
            $tab[$i] = date('F', mktime(0, 0, 0, $i, date('m'), date('Y')));
        }
        return $tab;
    }

    public static function cleanString(string $text)
    {
        $text = str_replace("-", " ", strtolower($text));
        $text = str_replace(".", "", strtolower($text));
        if ($text == "nazca") {
            $text = "nasca";
        }

        if ($text == "rupa rupa") {
            $text = "rupa-rupa";
        }

        if ($text == "quispicanchis") {
            $text = "quispicanchi";
        }

        if ($text == strtolower("STA ROSA DE SACCO")) {
            $text = "Santa Rosa de Sacco";
        }

        if ($text == strtolower("CHOSICA LURIG")) {
            $text = "Lurigancho";
        }

        if ($text == strtolower("MARISCAL RAMON CASTILLA")) {
            $text = "Ramón Castilla";
        }

        if ($text == strtolower("RAIMONDI")) {
            $text = "Raymondi";
        }


        return strtolower($text);
    }

    public static function basicCleanString(?string $text)
    {
        if ($text == null || $text == "") {
            return "";
        }
        $text = str_replace("-", " ", strtolower($text));
        return strtolower($text);
    }

}
