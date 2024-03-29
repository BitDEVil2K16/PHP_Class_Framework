<?php
/*
 * Copyright (c) 2021. BitDEVil2K16 Club. All rights reserved.
 * @author BitDEVil2K16 (Sascha P.)
 * @author BitDEVil2K16 Club <support@pc-dev.info>
 * @author BitDEVil2K16 Club https://bitdevil2k16.club
 * @github https://github.com/BitDEVil2K16
 * @FileName: MathHelper.php
 *
 */

if (!function_exists('getFlagName')) {
    /**
     * @param $flag
     * @param string $flagtype
     * @return string
     */
    function getFlagName($flag, string $flagtype = "none"): string
    {
        $flagarray = getFlagArrays($flagtype);
        if (!empty($flagarray)){
            if (isset($flagarray[$flag])){
                return $flagarray[$flag];
            }
        }
        // Is Not in Array Calc UNK Position
        $_flag = $flag; // Clone
        $i = 1;
        while (true){
            if ((int)($_flag/2) <= 0){
                $position = $i;
                break;
            }else{
                $_flag = (int)($_flag/2);
                $i++;
            }
        }
        return ("UNK".(strlen((string)$position) == 1 ? "0".$position : $position));
    }
}

if (!function_exists('getFlagArrays')) {
    /**
     * @param $type
     * @return array|string[]
     */
    function getFlagArrays($type): array
    {
        $key = $type."flagdatabase";
        //get_instance()->cache->deleteItem($key);
        $CachedString = get_instance()->cache->getItem($key);
        if (!$CachedString->isHit()) {
            $flagarray[$type] = array();
            foreach (GetJsonData('flags', "$type.flags", 'Flags') as $flag){
                $flagarray[$type][$flag->flag] = $flag->description;
            }
            $CachedString->set($flagarray)->expiresAfter(10*60);
            get_instance()->cache->save($CachedString);
        }
        return $CachedString->get()[$type] ?? array();
    }
}

if (!function_exists('convertuinttobits')) {
    /**
     * @param $flag
     * @return array
     */
    function convertuinttobits($flag): array
    {
        $flags= array(); // Array initialisieren
        for ($i = 0; $i <= 32; $i++) {
            if ($flag & (1 << $i)) {
                $flags[] = (1 << $i);
            }
        }
        sort($flags); // Kurz mal das Array sortieren 1,2,3,4.....
        return $flags; // zurück geben
    }
}

if(!function_exists('UintToInt')) {
    /**
     * @param $value
     * @return int
     */
    function UintToInt($value): int
    {
        if ($value > 2147483647) {
            $value -= 4294967296;
        }
        return $value;
    }
}

if(!function_exists('IntToUint')) {
    /**
     * @param $value
     * @return int
     */
    function IntToUint($value): int
    {
        if ($value < 2147483647) {
            $value += 4294967296;
        }
        return $value;
    }
}

if(!function_exists('UintToHex')) {
    /**
     * @param $value
     * @return string
     */
    function UintToHex($value): string
    {
        return "0x" . strtoupper(dechex($value));
    }
}

if(!function_exists('HexToUint')) {
    /**
     * @param $value
     * @return int
     */
    function HexToUint($value): int
    {
        return hexdec($value);
    }
}

/**
 * Jenkins hash function
 * https://en.wikipedia.org/wiki/Jenkins_hash_function
 */
if(!function_exists('Joaat')) {
    /**
     * @param $value
     * @param bool $uint
     * @return float|int|string
     */
    function Joaat($value,bool $uint = false)
    {
        $str = strtolower($value);
        if (!$uint)
            return "0x".strtoupper(hash('joaat', $str, false));
        else
            return hexdec("0x".strtoupper(hash('joaat', $str, false)));
    }
}

