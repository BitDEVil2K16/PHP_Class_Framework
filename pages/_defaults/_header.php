<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    if (defined('DEBUG') && DEBUG) {
        error_reporting(E_ALL);
        ini_set('ignore_repeated_errors', TRUE);
        ini_set('display_errors', TRUE);
        ini_set('log_errors', TRUE);
        ini_set('error_log', BASEPATH.'logs/PHP_ERROR-'.date('Y-m-d').'-error.log');
    }
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!DOCTYPE html>
<html lang="de" style="background: #333; color: #999">
<head>
    <meta name="description" content="<?= $description ?? "BitDEVil2K16 Network - Website" ?>">
    <meta name="keywords" content="<?= $metatags ?? "HTML, CSS, JavaScript, PHP, Template" ?>">
    <meta name="author" content="BitDEVil2K16 Club">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= !isset($this->config['sitename']) ? "" : $this->config['sitename']." | " ?><?= $title ?? "Ohne Titel" ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel='canonical' href='<?= $actual_link ?>' />
    <meta property="og:site_name" content="<?= (!isset($this->config['sitename']) ? "" : $this->config['sitename']) ?>">
    <meta property="og:image" content="<?= ($ogimage = $ogimage ?? "") ? $ogimage : (!isset($this->config['logo']) ? "" : $this->config['logo']) ?>">
    <meta property="fb:app_id" content="1357092867740080">
    <meta property="og:title" content="<?= (!isset($this->config['sitename']) ? "" : $this->config['sitename']) ?> - <?= $title ?? "Ohne Titel" ?>">
    <meta property="og:url" content="<?= $actual_link ?>">
    <meta property="og:image:width" content="360">
    <meta property="og:image:height" content="240">
    <meta property="og:type" content="website">
    <meta name='twitter:card' content='<?= ($ogimage = $ogimage ?? "summary") ? "summary_large_image" : (!isset($this->config['logo']) ? "summary_large_image" : "summary") ?>' />
    <meta name="twitter:site" content="@BitDEVil2K16">
    <meta name="twitter:creator" content="@BitDEVil2K16">
    <meta name='twitter:title' content="<?= !isset($this->config['sitename']) ? "" : $this->config['sitename']." | " ?><?= $title ?? "Ohne Titel" ?>" />
    <meta name='twitter:description' content="<?= $description ?? "BitDEVil2K16 Network - Website" ?>" />
    <meta name='twitter:url' content="<?= $actual_link ?>" />
    <meta name="twitter:image" content="<?= ($ogimage = $ogimage ?? "") ? $ogimage : (!isset($this->config['logo']) ? "" : $this->config['logo']) ?>">
    <link rel="stylesheet" href="<?= BaseUrl('core/css/mainstyle.css?v=0.0.14')?>" />
    <link rel="stylesheet" href="<?= BaseUrl('core/css/public/'.$this->style->Style.'.css?v='.$this->style->Version)?>" />
    <?= $this->anjascript->jQuery() ?>
    <?= $this->anjascript->jQueryUi() ?>
    <?= $this->anjascript->higlightjs('github-dark-dimmed') ?>
    <style>
        /* Inline Style / Styleoverwrites */
        .hiddeblock {
            display: none;
        }
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
        /* Overides for Higlight JS */
        .hljs-ln-numbers {
            -webkit-touch-callout: none !important;
            -webkit-user-select: none !important;
            -khtml-user-select: none !important;
            -moz-user-select: none !important;
            -ms-user-select: none !important;
            user-select: none !important;
            text-align: center !important;
            color: #ccc !important;
            border-right: 1px solid #CCC !important;
            vertical-align: top !important;
            padding-right: 4px !important;
        }
        .hljs-ln-code {
            padding-left: 8px !important;
        }
    </style>
</head>

<body>
<div class="content">
