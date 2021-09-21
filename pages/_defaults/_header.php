<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    if (defined('DEBUG') && DEBUG){
        error_reporting(E_ALL);
        ini_set('ignore_repeated_errors', TRUE);
        ini_set('display_errors', TRUE);
        ini_set('log_errors', TRUE);
        ini_set('error_log', BASEPATH.'logs/PHP_ERROR-'.date('Y-m-d').'-error.log');
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
    <?= $this->anjascript->higlightjs('github-dark') ?>
    <style>
        /* Inline Style / Styleoverwrites */
        .hiddeblock {
            display: none;
        }
        .hljs-ln-numbers {-webkit-touch-callout: none !important; -webkit-user-select: none !important; -khtml-user-select: none !important; -moz-user-select: none !important; -ms-user-select: none !important; user-select: none !important; text-align: center !important; color: #ccc !important; border-right: 1px solid #CCC !important; vertical-align: top !important; padding-right: 5px !important; }
        .hljs-ln-code {padding-left: 12px !important; }
    </style>
</head>

<body>