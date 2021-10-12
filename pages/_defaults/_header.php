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
<?php if($this->config['bootstrap']): ?>
<html lang="de">
<?php else: ?>
<html lang="de" style="background: #333; color: #9E9E9E">
<?php endif; ?>

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
    <link rel="stylesheet" href="<?= BaseUrl('core/css/mainstyle.css?v=0.1.5')?>" />
    <link rel="stylesheet" href="<?= BaseUrl('core/css/'.$this->style->Style.'.css?v='.$this->style->Version)?>" />
    <?= $this->anjascript->jQuery() ?>
    <?= $this->anjascript->jQueryUi() ?>
    <?= $this->anjascript->higlightjs('github-dark-dimmed') ?>
    <style>
        /* Inline Style / Styleoverwrites */
        <?php if(!$this->config['bootstrap']): ?>

        a{
            text-decoration: none;
            color: #40A4F3;
        }
        a:visited{
            color: #40A4F3;
        }
        <?php else: ?>
        
        a{
            text-decoration: none;
        }
        <?php endif; ?>

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
<?php if($this->config['bootstrap']): ?>
<div id="wrapper">
<!-- Page content wrapper-->
<div id="page-content-wrapper">
    <!-- Top navigation-->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark border-bottom fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><?= $this->config['sitename'] ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li id="home" class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li id="cool" class="nav-item"><a class="nav-link" href="/cool">Cool</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#!">Action</a>
                            <a class="dropdown-item" href="#!">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#!">Something else here</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<!-- Page content wrapper-->
<div id="page-content-wrapper" style="padding-top: 60px; margin-bottom: 60px;">
<?php endif; ?>
<div class="content">
