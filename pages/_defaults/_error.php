<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$errormessage = $errormessage ?? "Keine Weiteren Details";
$errorcode = $errorcode ?? 503;
set_status_header($errorcode);
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
