<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('Base_Url')) {
    /**
     * @param string $add
     * @return string
     */
    function Base_Url(string $add = ""): string
    {
        return BASEURL . $add;
    }
}
if ( ! function_exists('site_url'))
{
    function site_url($uri = '', $protocol = NULL)
    {
        return get_instance()->config->site_url($uri, $protocol);
    }
}
if ( ! function_exists('BaseUrl'))
{
    function BaseUrl($uri = '')
    {
        return http_check($uri);
    }
}
if (!function_exists('redirect')) {
    /**
     * @param $url
     * @param bool $replace
     * @param string $mode
     * @param int $status
     */
    function redirect($url, bool $replace = true, string $mode = '', int $status = 303)
    {
        switch ($mode) {
            case 'refresh':
                header('Refresh:0;url=' . http_check($url));
                break;
            default:
                header('Location: ' . http_check($url), $replace, $status);
                break;
        }
        exit;
    }
}
if (!function_exists('http_check')) {
    /**
     * @param $url
     * @return string
     */
    function http_check($url): string
    {
        $return = $url;
        if ((!(substr($url, 0, 7) == 'http://')) && (!(substr($url, 0, 8) == 'https://'))) {
            $return = Base_Url() . $url;
        }
        return $return;
    }
}
