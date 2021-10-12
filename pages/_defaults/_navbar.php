<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark border-bottom fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><?= $this->config['sitename'] ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li id="home" class="nav-item"><a class="nav-link" href="/">Startseite</a></li>
                <li id="cool" class="nav-item"><a class="nav-link" href="/cool">Allgemeine Funktionen</a></li>
                <li id="pictures" class="nav-item"><a class="nav-link" href="/pictures">Bilder Funktion</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Extern</a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="https://datacenter.bitdevil2k16.club" target="_blank" rel="noreferrer">Datacenter</a>
                        <a class="dropdown-item" href="https://bitdevil2k16.club" target="_blank" rel="noreferrer">BitDEVil2K16 Club</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#footer">Zum ende der Seite</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
