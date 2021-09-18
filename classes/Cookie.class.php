<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Copyright (c) 2021. BitDEVil2K16 Club. All rights reserved.
 * @author BitDEVil2K16 (Sascha P.)
 * @author BitDEVil2K16 Club <support@pc-dev.info>
 * @author BitDEVil2K16 Club https://bitdevil2k16.club
 * @github https://github.com/BitDEVil2K16
 * @FileName: Cookie.class.php
 *
 */
class Cookie
{
    /**
     * Cookie name - the name of the cookie.
     * @var bool
     */
    private $name = false;

    /**
     * @var string
     */
    private $prefix = "";

    /**
     * Cookie value
     * @var string
     */
    private $value = "";

    /**
     * Cookie life time
     * @var DateTime
     */
    private $time;

    /**
     * Cookie domain
     * @var bool
     */
    private $domain = false;

    /**
     * Cookie path
     * @var bool
     */
    private $path = false;

    /**
     * Cookie secure
     * @var bool
     */
    private $secure = true;

    /**
     * Cookie secure
     * @var bool
     */
    private $httponly = true;

    /**
     * Constructor
     */
    public function __construct() { }

    /**
     * Create or Update cookie.
     */
    public function create(): bool
    {
        return setcookie($this->name, $this->getValue(), $this->getTime(), $this->getPath(), $this->getDomain(), $this->getSecure(), $this->getHttpOnly());
    }

    /**
     * Return a cookie
     * @return mixed
     */
    public function get($name = ""){
        if (!empty($name)){
            return $_COOKIE[$this->prefix.'_'.$name] ?? false;
        }
        return $_COOKIE[$this->getName()];
    }

    /**
     * Delete cookie.
     * @return bool
     */
    public function delete($name = ""){
        if (!empty($name)){
            return setcookie($name, '', time() - 3600, $this->getPath(), $this->getDomain(), $this->getSecure(), true);
        }
        return setcookie($this->name, '', time() - 3600, $this->getPath(), $this->getDomain(), $this->getSecure(), true);
    }


    /**
     * @param $prefix
     */
    public function setPrefix($prefix) {
        $this->prefix = $prefix;
    }

    /**
     * @param $domain
     */
    public function setDomain($domain) {
        $this->domain = $domain;
    }

    /**
     * @return bool
     */
    public function getDomain() {
        return $this->domain;
    }

    /**
     * @param $id
     */
    public function setName($id) {
        $this->name = $this->prefix.'_'.$id;
    }

    /**
     * @return bool
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param $path
     */
    public function setPath($path) {
        $this->path = $path;
    }

    /**
     * @return bool
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @param $secure
     */
    public function setSecure($secure) {
        $this->secure = $secure;
    }

    /**
     * @return bool
     */
    public function getSecure() {
        return $this->secure;
    }

    /**
     * @param $httponly
     */
    public function setHttpOnly($httponly) {
        $this->httponly = $httponly;
    }

    /**
     * @return bool
     */
    public function getHttpOnly(): bool
    {
        return $this->httponly;
    }

    /**
     * @param $time
     */
    public function setTime($time) {
        // Create a date
        $date = new DateTime();
        // Modify it (+1hours; +1days; +20years; -2days etc)
        $date->modify($time);
        // Store the date in UNIX timestamp.
        $this->time = $date->getTimestamp();
    }

    /**
     * @return bool|int
     */
    public function getTime() {
        return $this->time;
    }

    /**
     * @param string $value
     */
    public function setValue($value) {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue() {
        return $this->value;
    }
}
