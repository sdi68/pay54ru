<?php
/*
 * Pay54Helper.php  18.10.2021, 14:42
 * Created for project pay54.ru API
 * www.econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2021 Econsult Lab.
 */

namespace Pay54ru\Common;

/**
 * Helper class
 */
class Pay54Helper
{

    /**
     * Преобразование строки ASCII -> HEX
     * @param string $string
     * @return string
     */
    public static function strToHex(string $string):string{
        $hex = '';
        for ($i=0; $i<strlen($string); $i++){
            $ord = ord($string[$i]);
            $hexCode = dechex($ord);
            $hex .= substr('0'.$hexCode, -2);
        }
        return strToUpper($hex);
    }

    /**
     * Преобразование строки HEX -> ASCII
     * @param string $hex
     * @return string
     */
    public static function hexToStr(string $hex):string{
        $string='';
        for ($i=0; $i < strlen($hex)-1; $i+=2){
            $string .= chr(hexdec($hex[$i].$hex[$i+1]));
        }
        return $string;
    }
}