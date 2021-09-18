<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Copyright (c) 2021. BitDEVil2K16 Club. All rights reserved.
 * @author BitDEVil2K16 (Sascha P.)
 * @author BitDEVil2K16 Club <support@pc-dev.info>
 * @author BitDEVil2K16 Club https://bitdevil2k16.club
 * @github https://github.com/BitDEVil2K16
 * @FileName: Common.php
 *
 */
if ( ! function_exists('get_config'))
{
    function &get_config(Array $replace = array())
    {
        static $config;

        if (empty($config))
        {
            $file_path = BASEPATH.'config/config.php';
            $found = FALSE;
            if (file_exists($file_path))
            {
                $found = TRUE;
                require($file_path);
            }

            if (file_exists($file_path = APPPATH.'config/'.ENVIRONMENT.'/config.php'))
            {
                require($file_path);
            }
            elseif ( ! $found)
            {
                set_status_header(503);
                echo 'The configuration file does not exist.';
                exit(3); // EXIT_CONFIG
            }

            if ( ! isset($config) OR ! is_array($config))
            {
                set_status_header(503);
                echo 'Your config file does not appear to be formatted correctly.';
                exit(3); // EXIT_CONFIG
            }
        }
        foreach ($replace as $key => $val)
        {
            $config[$key] = $val;
        }
        return $config;
    }
}

if ( ! function_exists('config_item'))
{
    function config_item($item)
    {
        static $_config;
        if (empty($_config))
        {
            $_config[0] =& get_config();
        }
        return $_config[0][$item] ?? NULL;
    }
}

if ( ! function_exists('load_class'))
{
    function &load_class($class, $directory = 'classes', $param = NULL)
    {
        static $_classes = array();

        if (isset($_classes[$class]))
        {
            return $_classes[$class];
        }

        $name = FALSE;

        foreach (array(BASEPATH) as $path)
        {
            if (file_exists($path.$directory.'/'.$class.'.php'))
            {
                $name = $class;
                if (class_exists($name, FALSE) === FALSE)
                {
                    require_once($path.$directory.'/'.$class.'.php');
                }
                break;
            }
        }

        if ($name === FALSE)
        {
            set_status_header(503);
            echo 'Unable to locate the specified class: '.$class.'.php';
            exit(5); // EXIT_UNK_CLASS
        }
        is_loaded($class);

        $_classes[$class] = isset($param)
            ? new $name($param)
            : new $name();
        return $_classes[$class];
    }
}

if ( ! function_exists('is_loaded'))
{
    function &is_loaded($class = '')
    {
        static $_is_loaded = array();

        if ($class !== '')
        {
            $_is_loaded[strtolower($class)] = $class;
        }

        return $_is_loaded;
    }
}

if ( ! function_exists('get_mimes'))
{
    function &get_mimes()
    {
        static $_mimes;

        if (empty($_mimes))
        {
            $_mimes = file_exists(APPPATH.'config/mimes.php')
                ? include(APPPATH.'config/mimes.php')
                : array();

            if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/mimes.php'))
            {
                $_mimes = array_merge($_mimes, include(APPPATH.'config/'.ENVIRONMENT.'/mimes.php'));
            }
        }

        return $_mimes;
    }
}

if ( ! function_exists('is_https'))
{
    function is_https(): bool
    {
        if ( ! empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off')
        {
            return TRUE;
        }
        elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https')
        {
            return TRUE;
        }
        elseif ( ! empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off')
        {
            return TRUE;
        }

        return FALSE;
    }
}

if ( ! function_exists('set_status_header'))
{
    /**
     * Set HTTP Status Header
     *
     * @param	int	the status code
     * @param	string
     * @return	void
     */
    function set_status_header($code = 200, $text = '')
    {
        if (empty($code) OR ! is_numeric($code))
        {
            show_error('Status codes must be numeric', 500);
        }

        if (empty($text))
        {
            is_int($code) OR $code = (int) $code;
            $stati = array(
                100	=> 'Continue',
                101	=> 'Switching Protocols',

                200	=> 'OK',
                201	=> 'Created',
                202	=> 'Accepted',
                203	=> 'Non-Authoritative Information',
                204	=> 'No Content',
                205	=> 'Reset Content',
                206	=> 'Partial Content',

                300	=> 'Multiple Choices',
                301	=> 'Moved Permanently',
                302	=> 'Found',
                303	=> 'See Other',
                304	=> 'Not Modified',
                305	=> 'Use Proxy',
                307	=> 'Temporary Redirect',

                400	=> 'Bad Request',
                401	=> 'Unauthorized',
                402	=> 'Payment Required',
                403	=> 'Forbidden',
                404	=> 'Not Found',
                405	=> 'Method Not Allowed',
                406	=> 'Not Acceptable',
                407	=> 'Proxy Authentication Required',
                408	=> 'Request Timeout',
                409	=> 'Conflict',
                410	=> 'Gone',
                411	=> 'Length Required',
                412	=> 'Precondition Failed',
                413	=> 'Request Entity Too Large',
                414	=> 'Request-URI Too Long',
                415	=> 'Unsupported Media Type',
                416	=> 'Requested Range Not Satisfiable',
                417	=> 'Expectation Failed',
                422	=> 'Unprocessable Entity',
                426	=> 'Upgrade Required',
                428	=> 'Precondition Required',
                429	=> 'Too Many Requests',
                431	=> 'Request Header Fields Too Large',

                500	=> 'Internal Server Error',
                501	=> 'Not Implemented',
                502	=> 'Bad Gateway',
                503	=> 'Service Unavailable',
                504	=> 'Gateway Timeout',
                505	=> 'HTTP Version Not Supported',
                511	=> 'Network Authentication Required',
            );

            if (isset($stati[$code]))
            {
                $text = $stati[$code];
            }
            else
            {
                show_error('No status text available. Please check your status code number or supply your own message text.', 500);
            }
        }

        if (strpos(PHP_SAPI, 'cgi') === 0)
        {
            header('Status: '.$code.' '.$text, TRUE);
            return;
        }

        $server_protocol = (isset($_SERVER['SERVER_PROTOCOL']) && in_array($_SERVER['SERVER_PROTOCOL'], array('HTTP/1.0', 'HTTP/1.1', 'HTTP/2'), TRUE))
            ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
        header($server_protocol.' '.$code.' '.$text, TRUE, $code);
    }

    if ( ! function_exists('show_error'))
    {
        function show_error($message, $status_code = 500, $heading = 'An Error Was Encountered')
        {
            $status_code = abs($status_code);
            if ($status_code < 100)
            {
                $exit_status = $status_code + 9; // 9 is EXIT__AUTO_MIN
                $status_code = 500;
            }
            else
            {
                $exit_status = 1; // EXIT_ERROR
            }

            $_error =& load_class('Exceptions', 'core');
            echo $_error->show_error($heading, $message, 'error_general', $status_code);
            exit($exit_status);
        }
    }
}