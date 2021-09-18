<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('getRandomIntString')){
    /**
     * @param int $length
     * @return string
     */
    function getRandomIntString(int $length = 8): string
    {
        $characters = '0123456789';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $string;
    }
}

/* Array Sort */
if (!function_exists('sortBy')) {
    /**
     * @param $field
     * @param $array
     * @param string $direction
     * @return bool
     */
    function sortBy($field, &$array, string $direction = 'asc'): bool
    {
        usort($array, function($a, $b) use ($field, $direction){
            $a = $a[$field];
            $b = $b[$field];
            if ($a == $b)
            {
                return 0;
            }
            if ($a < $b && $direction == 'desc')
                return 1;
            else if ($a > $b && $direction == 'desc')
                return -1;
            if ($a < $b && $direction == 'asc')
                return -1;
            else if ($a > $b && $direction == 'asc')
                return 1;
        });
        return true;
    }
}

/* Run since */
if (!function_exists('ontime')) {
    /**
     * @param $starttime
     * @param string $timezone
     * @return string
     * @throws Exception
     */
    function ontime($starttime, string $timezone = 'Europe/Berlin'): string
    {
        $timezz = $starttime;
        $start = strtotime($timezz);
        $dtF = new DateTime('now', new DateTimeZone($timezone));
        if ($dtF->format('I') == 0) { //Is Summer Time?
            $dtF->add(new DateInterval("PT1H"));
        } else {
            $dtF->add(new DateInterval("PT0H"));
        }

        $dtT = new DateTime('@' . $start);

        $diff = $dtF->diff($dtT);

        $years = $diff->format('%y');
        $months = $diff->format('%m');
        $days = $diff->format('%d');
        $hours = $diff->format('%h');
        $mins = $diff->format('%i');
        $secs = $diff->format('%s');

        $year = '';
        $month = '';
        $day = '';
        $hour = '';
        $min = '';
        $sec = '';

        if ($years > 0) {
            if ($years == 1) {
                $year = '1 Jahr ';
            } else {
                $year = $years . ' Jahren ';
            }
        }
        if ($months > 0) {
            if ($months == 1) {
                $month = '1 Monat ';
            } else {
                $month = $months . ' Monaten ';
            }
        }
        if ($days > 0) {
            if ($days == 1) {
                $day = '1 Tag ';
            } else {
                $day = $days . ' Tage ';
            }
        }
        if ($hours > 0) {
            if ($hours == 1) {
                $hour = '1 Stunde ';
            } else {
                $hour = $hours . ' Std. ';
            }
        }
        if ($mins > 0) {
            if ($mins == 1) {
                $min = '1 Minute ';
            } else {
                $min = $mins . ' Min. ';
            }
        }
        if ($secs > 0) {
            if ($secs == 1) {
                $sec = '1 Sekunde';
            } else {
                $sec = $secs . ' Sek.';
            }
        }
        return '' . $year . $month . $day . $hour . $min . $sec;
    }
}