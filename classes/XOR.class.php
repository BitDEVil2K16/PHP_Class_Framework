<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Copyright (c) 2021. BitDEVil2K16 Club. All rights reserved.
 * @author BitDEVil2K16 (Sascha P.)
 * @author BitDEVil2K16 Club <support@pc-dev.info>
 * @author BitDEVil2K16 Club https://bitdevil2k16.club
 * @github https://github.com/BitDEVil2K16
 * @FileName: XOR.class.php
 *
 */
class XOR2 {
    private static function xor_encode( $data, $key ) {
        for( $i = 0; $i < strlen($data); $i++ ) {
            for( $j = 0; $j < strlen($key); $j++ ){
                $data[$i] = $data[$i] ^ $key[$j];
            }
        }
        return $data;
    }
    public static function decode($data, $key) {
        return self::xor_encode(base64_decode($data), (string)$key);
    }
    public static function encode($data, $key): string
    {
        return base64_encode(self::xor_encode($data, (string)$key));
    }
}