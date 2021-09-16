<?php defined("BASEPATH") or die("Kein Direkt aufruf erlaubt");
$jo = $bla ?? false;
if (!$jo){
    echo $testnon ?? "Hmmm";
    echo "<hr style='width: 150px; height: 2px; left: 0;' />";
    if (isset($blaarray))
        print_r($blaarray);
    echo "<br />";
}
?>


Hallo ich bin Cool!!!
