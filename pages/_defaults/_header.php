<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (defined(DEBUG) && DEBUG){
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}

?>
<!DOCTYPE html>
<html lang="de" style="background: #333; color: #999">
<head>
    <meta name="description" content="PHP Class website Building WIP">
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP">
    <meta name="author" content="BitDEVil2K16 Club">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= $title ?? "Ohne Titel" ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="<?= BaseUrl('core/css/mainstyle.css?v=0.0.6')?>" />
    <link rel="stylesheet" href="<?= BaseUrl('core/css/public/'.$this->style->Style.'.css?v='.$this->style->Version)?>" />
    <style>
        .h3{
            font-size: 20px !important;
        }
        a{
            text-decoration: none;
            color: #40A4F3;
        }
        a:visited{
            color: #40A4F3;
        }
    </style>
    <?= $this->anjascript->jQuery() ?>
    <?= $this->anjascript->jQueryUi() ?>
    <?= $this->anjascript->higlightjs() ?>

    <style>
        /* Inline Style / Styleoverwrites */
        .hiddeblock {
            display: none;
        }
    </style>
</head>

<body>