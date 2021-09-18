<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (defined(DEBUG) && DEBUG){
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}

?>
<!DOCTYPE html>
<html lang="de" style="background: #333; color: #999">
<head>
    <title><?= $title ?? "Ohne Titel" ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="<?= BaseUrl('core/css/mainstyle.css?v=0.0.6')?>" />
    <link rel="stylesheet" href="<?= BaseUrl('core/css/public/'.$this->style->Style.'.css?v='.$this->style->Version)?>" />
    <?= $this->anjascript->jQuery() ?>
    <?= $this->anjascript->jQueryUi() ?>
    <style>
        /* Inline Style / Styleoverwrites */
        .hiddeblock {
            display: none;
        }
    </style>
</head>

<body>