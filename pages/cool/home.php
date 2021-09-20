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
if (!function_exists('highlightText')) {
    /**
     * @param $text
     * @param string $fileExt
     * @return array|string|string[]|null
     */
    function highlightText($text, string $fileExt = "php")
    {
        if ($fileExt == "php") {
            ini_set("highlight.comment", "#008000");
            ini_set("highlight.default", "green");
            ini_set("highlight.html", "#808080");
            ini_set("highlight.keyword", "#909090; font-weight: bold");
            ini_set("highlight.string", "#DD0000");
        } else if ($fileExt == "html") {
            ini_set("highlight.comment", "green");
            ini_set("highlight.default", "#CC0000");
            ini_set("highlight.html", "#000000");
            ini_set("highlight.keyword", "black; font-weight: bold");
            ini_set("highlight.string", "#0000FF");
        }
        $text = trim($text);
        $text = highlight_string("<?php " . $text, true);
        $text = trim($text);
        $text = preg_replace("|^\\<code\\>\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>|", "", $text, 1);
        $text = preg_replace("|\\</code\\>\$|", "", $text, 1);
        $text = trim($text);
        $text = preg_replace("|\\</span\\>\$|", "", $text, 1);
        $text = trim($text);
        return preg_replace("|^(\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>)(&lt;\\?php&nbsp;)(.*?)(\\</span\\>)|", "\$1\$3\$4", $text);
    }
}
function code() {
    static $on = false;
    if ( !$on ) {
        ob_start();
    } else {
        $buffer = "<?\n" . ob_get_contents() . "?>";
        ob_end_clean();
        highlight_string( $buffer );
    }
    $on = !$on;
}


$flaguint = $flagarg ?? 49;
$flagtypearg = $flagtypearg ?? 'animation';
$rdm = rand(38,56458);
echo "<hr /><br />Convert <span style='color: lime'>UINT</span>(<span style='color: #0b93d5'>$flaguint</span>) Back to Bits<br />
Anderes Flag testen? dann füge es an die URL an beispiel: <a href='".BaseUrl('cool/'.$rdm)."' target='_top' rel='noreferrer'>".BaseUrl('cool/'.$rdm)."</a><br />";
foreach (convertuinttobits($flaguint) as $flag) {
    echo "Bit: <span style='color: #40A4F3'>$flag</span> ist ".getFlagName($flag, $flagtypearg)."<br />";
}
echo "<hr />";
echo "<br /><br />>Database Test<br />";

echo "<u>Für diesen test haben wir eine Datenbank angelgt und eine Tabelle erstellt</u>:<br />
<pre>
<code class=\"language-sql\">CREATE TABLE `Accounts` (
	`Id` INT(11) NOT NULL AUTO_INCREMENT,
	`Username` VARCHAR(50) NOT NULL DEFAULT '0' COLLATE 'latin1_swedish_ci',
	`Password` VARCHAR(50) NOT NULL DEFAULT '0' COLLATE 'latin1_swedish_ci',
	`Salt` VARCHAR(50) NOT NULL DEFAULT '0' COLLATE 'latin1_swedish_ci',
	`CreateAt` DATETIME NOT NULL,
	`UpdateAt` DATETIME NOT NULL,
	`LastLogin` DATETIME NOT NULL,
	`LoginToken` VARCHAR(250) NOT NULL DEFAULT '' COLLATE 'latin1_swedish_ci',
	PRIMARY KEY (`Id`) USING BTREE
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB;</code>
</pre>

<u>Ebenfals haben wir ein TestUser angelegt</u>:<pre>
<code class=\"language-sql\">INSERT INTO `Accounts` (`Id`, `Username`, `Password`, `Salt`, `CreateAt`, `UpdateAt`, `LastLogin`, `LoginToken`) 
VALUES 
(1, 'DerTester', 'BohNeEyWirklich', 'DasIstNice', '2021-09-20 09:45:44', '2021-09-20 09:45:45', '2021-09-20 09:45:46', 'HaHaHaLULCheckCookie? Nope');</code>
</pre>
Und nun folgen die Ausgaben:<br /><br />
";


echo "<hr />";
/* Normal Quest */
?>
<pre>
    <code class="language-php">$credentials = array(1);
$account = $this->db->query('SELECT * FROM Accounts WHERE Id = ?',$credentials)->fetchArray();</code>
</pre>
<?php

$credentials = array(1);
$account = $this->db->query('SELECT * FROM Accounts WHERE Id = ?',$credentials)->fetchArray();
if ($account){
    echo "User Account Found: <br /><pre>";
    print_r($account);
    echo "</pre><br />";
}


echo "<hr />";
/* Loop all */
?>
<pre>
    <code class="language-php">
$this->db->query('SELECT * FROM Accounts')->fetchAll(function($account) {
    echo "User gefunden Name: ". $account['Username'] \n;
});
    </code>
</pre>
<?php
$this->db->query('SELECT * FROM Accounts')->fetchAll(function($account) {
    echo "User gefunden Name: ". $account['Username'] . "<br />";
});


echo "<hr />";
/* Get Count */
?>
<pre>
    <code class="language-php">
$accounts = $this->db->query('SELECT * FROM Accounts');
echo "Accounts in Database: ".$accounts->numRows();
    </code>
</pre>
<?php
$accounts = $this->db->query('SELECT * FROM Accounts');
echo "Accounts in Database: ".$accounts->numRows();

echo "<hr />";
echo "Gesamt anzahl der DB Querys : ".$this->db->query_count;

$lastinsert = $this->db->lastInsertID();
echo "<br />Letze insert ID: " . ($lastinsert == 0 ? "Kein INSERT ausgeführt daher 0" : "Letze Insert ID: ".$lastinsert);

echo "<br /><hr />Quellcode dieser Seite <a href='https://github.com/BitDEVil2K16/PHP_Class_Framework/blob/84b0dbe9aa2b2c5a00ecf1575a6644fd78327bc4/pages/cool/home.php#L1' target='_blank' rel='noreferrer'>direklink zum Git</a>";


?>


