<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Session{
    /**
     * @param array $params
     */
    public function __construct(array $params = array())
    {}

    /**
     * @param null $key
     * @param false $clear
     * @return array|mixed|null
     */
    public function flashdata($key = NULL, bool $clear = false)
    {
        if ($clear && $_SESSION[$key]){
            $data = $_SESSION[$key];
            $this->set_flashdata($key,null);
            return $data;
        }
        if (isset($key))
        {
            return (isset($_SESSION['__s_vars'], $_SESSION['__s_vars'][$key], $_SESSION[$key]) && ! is_int($_SESSION['__s_vars'][$key]))
                ? $_SESSION[$key]
                : NULL;
        }
        $flashdata = array();
        if ( !empty($_SESSION['__s_vars']))
        {
            foreach ($_SESSION['__s_vars'] as $key => &$value)
            {
                is_int($value) OR $flashdata[$key] = $_SESSION[$key];
            }
        }
        return $flashdata;
    }

    /**
     * @param $data
     * @param null $value
     */
    public function set_flashdata($data, $value = NULL)
    {
        $this->set_userdata($data, $value);
        $this->mark_as_flash(is_array($data) ? array_keys($data) : $data);
    }

    /**
     * @param $key
     */
    public function keep_flashdata($key)
    {
        $this->mark_as_flash($key);
    }

    /**
     * @param $data
     * @param null $value
     */
    public function set_userdata($data, $value = NULL)
    {
        if (is_array($data))
        {
            foreach ($data as $key => &$value)
            {
                $_SESSION[$key] = $value;
            }
            return;
        }
        $_SESSION[$data] = $value;
    }

    /**
     * @param $key
     * @return bool
     */
    public function mark_as_flash($key)
    {
        if (is_array($key))
        {
            for ($i = 0, $c = count($key); $i < $c; $i++)
            {
                if ( ! isset($_SESSION[$key[$i]]))
                {
                    return FALSE;
                }
            }
            $new = array_fill_keys($key, 'new');
            $_SESSION['__s_vars'] = isset($_SESSION['__s_vars'])
                ? array_merge($_SESSION['__s_vars'], $new)
                : $new;
            return TRUE;
        }
        if ( ! isset($_SESSION[$key]))
        {
            return FALSE;
        }
        $_SESSION['__s_vars'][$key] = 'new';
        return TRUE;
    }

    /**
     * @param $key
     */
    public function unset_userdata($key)
    {
        if (is_array($key))
        {
            foreach ($key as $k)
            {
                unset($_SESSION[$k]);
            }
            return;
        }
        unset($_SESSION[$key]);
    }
}