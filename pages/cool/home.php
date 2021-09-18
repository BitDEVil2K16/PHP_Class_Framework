<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$jo = $bla ?? false;
if (!$jo){
    echo $testnon ?? "Hmmm";
    echo "<hr style='width: 150px; height: 2px; left: 0;' />";
    if (isset($blaarray))
        print_r($blaarray);
    echo "<br />";
    $startproject = new DateTime('2021-09-15 04:25:12', new DateTimeZone("Europe/Berlin"));

    echo "Project exist since: " . ontime($startproject->format('d.m.Y h:i:s')) . "<br />";

    echo "Project exist since: " . ontime('2021-09-15 04:25:12') . "<br />";
}
?>


Hallo ich bin Cool!!!
