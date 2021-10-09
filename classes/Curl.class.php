<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Copyright (c) 2021. BitDEVil2K16 Club. All rights reserved.
 * @author BitDEVil2K16 (Sascha P.)
 * @author BitDEVil2K16 Club <support@pc-dev.info>
 * @author BitDEVil2K16 Club https://bitdevil2k16.club
 * @github https://github.com/BitDEVil2K16
 * @FileName: Curl.class.php
 *
 */

class Curl{
    /**
     * @var
     */
    protected $return;
    private $proxyip = "";
    private $proxyport = "";
    private $proxyauth;
    private $proxytype = "SOCKS5";
    private static $curl;

    /**
     * Constructor
     */
    public function __construct($proxyip = "", $proxyport = "", $proxyauth = "")
    {
        if (!empty($proxyip)){
            $this->proxyip = $proxyip;
        }
        if(!empty($proxyport)){
            $this->proxyport = $proxyport;
        }
        if (!empty($proxyauth)){
            $this->proxyauth = $proxyauth;
        }
    }
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    public function SetProxyIp($proxyip){
        $this->proxyip = $proxyip;
    }
    public function SetProxyPort($port){
        $this->proxyport = $port;
    }
    public function SetProxyAuth($username,$password){
        $this->proxyauth = $username.':'.$password;
    }

    /**
     * @param $url
     * @param string $ref
     * @param string $cookie
     * @return string
     */
    public function get($url, string $ref = "", string $cookie = ""): string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_REFERER, (empty($ref) && $ref = "" ? $url : $ref));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        if (!empty($cookie) && $cookie != "") {
            if (!file_exists(getcwd() . '/cookie')) {
                mkdir(getcwd() . '/cookie', 0777, true);
            }
            //curl_setopt($ch, CURLOPT_COOKIESESSION, true);
            curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/cookie/' . $cookie . '.txt');
            curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/cookie/' . $cookie . '.txt');
        }
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36');
        curl_setopt ($ch, CURLOPT_HTTPHEADER, array(
                "Upgrade-Insecure-Requests: 1",
                "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36",
                "sec-metadata: none",
                "Access-Control-Allow-Origin: *",
                "authority: ".$url,
                "referer: https://www.google.com/",
                "cookie: ",
                "sec-fetch-site: cross-site"
            )
        );
        if (isset($this->proxyport) && isset($this->proxyip)) {
            //curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, 1);
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
            curl_setopt($ch, CURLOPT_PROXY, $this->proxyip);
            curl_setopt($ch, CURLOPT_PROXYPORT, $this->proxyport);
            if (isset($this->proxyauth)){
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, $this->proxyauth);
            }
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->return = curl_exec($ch);
        curl_close($ch);
        return stripslashes($this->return);
    }

    /**
     * @param $file_source
     * @param $file_target
     * @return bool
     */
    public function download($file_source, $file_target, $host = ''): bool
    {
        $ch = curl_init();
        $file_target = BASEPATH.$file_target; // BASEPATH RelativPath to App root eg. /var/www/meinedomain/html/
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt_array($ch, array(
            CURLOPT_URL => $file_source,
            CURLOPT_USERAGENT => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPGET => false,
            CURLOPT_HTTPHEADER => array(
                "REMOTE_ADDR: '127.0.0.1'",
                "X_FORWARDED_FOR: '127.0.0.1'",
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36",
                "Upgrade-Insecure-Requests: 1",
                "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
                "Accept-Encoding: gzip, deflate",
                "Accept-Language: en-US,en;q=0.9",
                "Connection: keep-alive"
            ),
            CURLOPT_COOKIESESSION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_NOBODY => false,
        ));
        if (isset($this->proxyport) && isset($this->proxyip)) {
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
            curl_setopt($ch, CURLOPT_PROXY, $this->proxyip);
            curl_setopt($ch, CURLOPT_PROXYPORT, $this->proxyport);
            if (isset($this->proxyauth)){
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, $this->proxyauth);
            }
        }
        $data = curl_exec($ch);
        curl_close($ch);
        $dirname = pathinfo($file_target, PATHINFO_DIRNAME);
        if (!file_exists($dirname)) {
            mkdir($dirname, 0777, true);
        }
        file_put_contents($file_target, $data);
        return true;
    }

}