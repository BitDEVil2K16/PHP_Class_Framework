<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$jo = $bla ?? false;
if (!$jo){
    echo $testnon ?? "Hmmm";
    echo "<hr style='height: 2px; left: 0;' />";
    if (isset($blaarray))
        print_r($blaarray);
    echo "<br />";
    $startproject = new DateTime('2021-09-15 04:25:12', new DateTimeZone("Europe/Berlin"));
    $key = "starttime";
    $CachedString = $this->cache->getItem($key);
    $ctest = "";
    if (is_null($CachedString->get())) {
        $test = "Project exist since: " . ontime($startproject->format('d.m.Y h:i:s'));
        $testarray = array(1 => "15", 2 => date('s'));
        $CachedString->set($test)->expiresAfter(600);
        $this->cache->save($CachedString);
    }
    $ctest = $CachedString->get();
    //$this->cache->deleteItem("starttime");
    echo "Cachetime auf 10 Minuten gesetzt<br />";
    echo $ctest ." <-- Cache Test läuft ab am: " . $CachedString->getExpirationDate()->format('d.m.Y h:i:s');
    echo "<br />Project exist since: " . ontime('2021-09-15 04:25:12') . "<br />";
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
        $CachedString = get_instance()->cache->getItem($key);
        if (!$CachedString->isHit()) {
            $flagarray["animation"] = array(
                0 => "Normal",
                1 => "Repeat",
                2 => "Stop On Last Frame",
                16 => "Upperbody Only",
                32 => "Player Controlable",
                120 => "CANCELABLE"
            );
            $CachedString->set($flagarray)->expiresAfter(10*60);
            get_instance()->cache->save($CachedString);
        }
        //echo "Cache läuft ab: ".$CachedString->getExpirationDate()->format('d.m.Y h:i:s');
        //echo implode("<br />",$CachedString->get()[$type]);
        return $CachedString->get()[$type] ?? array();
    }
}
$flaguint = $flagarg ?? 49;
$flagtypearg = $flagtypearg ?? 'animation';
echo "<hr /><br />Convert UINT($flaguint) Back to Bits<br /><br />";
foreach (convertuinttobits($flaguint) as $flag) {
    echo "Bit: <span style='color: #40A4F3'>$flag</span> ist ".getFlagName($flag, $flagtypearg)."<br />";
}
