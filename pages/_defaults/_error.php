<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$errormessage = $errormessage ?? "Keine Weiteren Details";
?>
<div class="row">
    <div class="w-100">
        <div class="container d-flex justify-content-md-center align-items-center" style="height: 60vh;">
            <h1>Fehlerhafte anfrage!</h1>
            <h3><?= $errormessage ?></h3>
        </div>
    </div>
</div>
