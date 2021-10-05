<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$jo = $bla ?? false;
if (!$jo){
    echo $testnon ?? "Hmmm";
    echo "<hr style='height: .1em; left: 0;' />";
    if (isset($blaarray))
        print_r($blaarray);
    echo "<br />";
    $startproject = new DateTime('2021-09-15 04:25:12', new DateTimeZone("Europe/Berlin"));
    $key = "starttime";
    $CachedString = $this->cache->getItem($key);
    $ctest = "";
    if (is_null($CachedString->get())) {
        $test = "Project exist since: " . lifetime($startproject->format('d.m.Y H:i:s'));
        $testarray = array(1 => "15", 2 => date('s'));
        $CachedString->set($test)->expiresAfter(600*60);
        $this->cache->save($CachedString);
    }
    $minuten = 600;
    $sekunden = $minuten*60;
    $stunden = $minuten/60;
    $stundenformat = floor($minuten/60).':'.(strlen(($minuten%60)) == 1 ? '0'.($minuten%60) : ($minuten%60)). " Stunden";

    $ctest = $CachedString->get();
    //$this->cache->deleteItem("starttime");
    echo "Cachetime auf ".$minuten." Minuten aka ".$stundenformat." gesetzt<br />";
    echo $ctest ." <-- Cache Test läuft ab am: " . $CachedString->getExpirationDate()->format('d.m.Y H:i:s') . " | " . getdifferenz($CachedString->getExpirationDate()->getTimestamp() - time());
    echo "<br />Project exist since: " . lifetime('2021-09-15 04:25:12') . "<br />";
}

$flaguint = $flagarg ?? 49;
$flagtypearg = $flagtypearg ?? 'animation';
//echo $flagtypearg; // animationFlags Default
$rdm = rand(38,56458);
echo "<hr /><br />Convert <span style='color: lime'>UINT</span>(<span style='color: #0b93d5'>$flaguint</span>) Back to Bits<br />
Anderes Flag testen? dann füge es an die URL an beispiel: <a href='".BaseUrl('cool/'.$rdm)."' target='_top' rel='noreferrer'>".BaseUrl('cool/'.$rdm)."</a><br />";
foreach (convertuinttobits($flaguint) as $flag) {
    echo "Bit: <span style='color: #40A4F3'>$flag</span> ist ".getFlagName($flag, $flagtypearg)."<br />";
}
echo "<hr />";
?>
    <pre>
    <code class="language-php">echo "Uint as Hex: <span style='color: lime'>2519455989</span> -> ".UintToHex(2519455989)."<br />";
echo "Hex as Uint: <span style='color: lime'>0x962BD8F5</span> -> ".HexToUint("0x962BD8F5")."<br />";
echo "Uint to Int: <span style='color: lime'>2519455989</span> -> ".UintToInt(2519455989)."<br />";
echo "Int to Uint: <span style='color: lime'>-1775511307</span> -> ".IntToUint(-1775511307);</code>
</pre>
<?php
echo "Uint as Hex: <span style='color: lime'>2519455989</span> -> ".UintToHex(2519455989)."<br />\n";
echo "Hex as Uint: <span style='color: lime'>0x962BD8F5</span> -> ".HexToUint("0x962BD8F5")."<br />\n";
echo "Uint to Int: <span style='color: lime'>2519455989</span> -> ".UintToInt(2519455989)."<br />\n";
echo "Int to Uint: <span style='color: lime'>-1775511307</span> -> ".IntToUint(-1775511307)."<hr />\n";
echo "\n<br /><br />>Database Test<br />\n";

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
$account = $this->db->query('SELECT * FROM Accounts WHERE Id = ?',$credentials)->fetchArray();
if ($account){
    echo "User Account Found: <br /><pre>";
    print_r($account);
    echo "</pre><br />";
}</code>
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
    <code class="language-php">$this->db->query('SELECT * FROM Accounts')->fetchAll(function($account) {
    echo "User gefunden Name: ". $account['Username']. "<br />";
});</code>
</pre>
<?php
$this->db->query('SELECT * FROM Accounts')->fetchAll(function($account) {
    echo "User gefunden Name: ". $account['Username'] . "<br /> ";
});


echo "<hr />";
/* Get Count */
?>
<?php
$code = '$accounts = $this->db->query(\'SELECT * FROM Accounts\');
echo "Accounts in Database: ".$accounts->numRows();
';
?>
<pre>
    <code class="php"><?php echo htmlspecialchars( $code ); ?></code>
</pre>
<?php
$accounts = $this->db->query('SELECT * FROM Accounts');
echo "Accounts in Database: ".$accounts->numRows();
echo "<hr />";

$code = 'echo "Gesamt anzahl der DB Querys : ".$this->db->query_count;
$lastinsert = $this->db->lastInsertID();
echo "<br />Letze insert ID: " . ($lastinsert == 0 ? "Kein INSERT ausgeführt daher 0" : "Letze Insert ID: ".$lastinsert);
echo "<br /><hr />Quellcode dieser Seite <a href=\'https://github.com/BitDEVil2K16/PHP_Class_Framework/blob/main/pages/cool/home.php#L1\' target=\'_blank\' rel=\'noreferrer\'>direklink zum Git</a>";
';
?>
<pre>
    <code class="language-php"><?php echo htmlspecialchars( $code ); ?></code>
</pre>
<?php
echo "Gesamt anzahl der DB Querys : ".$this->db->query_count;

$lastinsert = $this->db->lastInsertID();
echo "<br />Letze insert ID: " . ($lastinsert == 0 ? "Kein INSERT ausgeführt daher 0" : "Letze Insert ID: ".$lastinsert);

echo "<br /><hr />Quellcode dieser Seite <a href='https://github.com/BitDEVil2K16/PHP_Class_Framework/blob/main/pages/cool/home.php#L1' target='_blank' rel='noreferrer'>direklink zum Git</a>";



