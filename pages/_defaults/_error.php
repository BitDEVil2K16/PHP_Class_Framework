<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$errormessage = $errormessage ?? "Keine Weiteren Details";
header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
http_response_code(404);
?>
<div class="row">
    <div class="w-100">
        <div class="container" style="height: 60vh;">
            <div class="centerflex">
                <h1>Fehlerhafte anfrage!</h1>
            </div>
            <div class="centerflex">
                <h2>Details zum Fehler:</h2>
            </div>
            <div class="centerflex">
                <h2><b><u><?= $errormessage ?></u></b></h2>
            </div>
        </div>
    </div>
</div>
