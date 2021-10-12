<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Copyright (c) 2021. BitDEVil2K16 Club. All rights reserved.
 * @author BitDEVil2K16 (Sascha P.)
 * @author BitDEVil2K16 Club <support@pc-dev.info>
 * @author BitDEVil2K16 Club https://bitdevil2k16.club
 * @github https://github.com/BitDEVil2K16
 * @FileName: index.php
 * @Date: 12.10.2021
 */

?>

<style>
    .lightboximage  {
        margin-left: 15px;
        margin-bottom: 10px;
        display: inline-flex;
        flex-direction: column;
        text-decoration: none;
        background: rgba(0,0,0,.25);
    }
    .caption {
        font-family: sans-serif;
        color: #999;
        font-weight: bold;
        display: inline-block;
        padding-top: .5em;
        overflow: hidden;
        width: 150px;
    }
    .lb-caption {
        background: rgba(0,0,0,.50) !important;
        font-size: 18px !important;
        color: #fff !important;
    }
    .lb-dataContainer {
        background: rgba(0,0,0,.50) !important;
    }
    .lb-number {
        color: red !important;
        margin-top: 10px;
        font-size: 14px !important;
    }
    .lb-image {
        max-height: 600px !important;
    }
</style>
<div class="row">
    Die Hier gezeigten Bilder sind von hier:
    <a href="https://mediamilitia.com/sample-image-pack-25-free-images/" target="_blank" rel="noreferrer">https://mediamilitia.com/sample-image-pack-25-free-images/</a>
    Gallery Auto Generate System:
</div>
<pre>
    <code class="language-php">//In der Variante würden keine Thumbs erstellt
$this->ccplus->getImagesFromFolder('test',7);
//Hier auf der Webseite Nutzen wir diesen Code
$this->ccplus->getImagesFromFolder('test',7,true);
/*
Die 3 Parameter geben fogendes an
Der erste ist das Sub Verzeichniss was sich im Verzeichniss root/dynamic_content befindet in unserem fall root/dynamic_content/test
Der Zweite gibt an wie viele Bilder Pro Seite gezeigt werden sollen
Der Dritte gibt an ob Thumbinals erstellt werden sollen um die Seite zu Beschleuniegen ist das sehr zu empfehlen
*/
    </code>
    </pre>
<?php
$this->ccplus->getImagesFromFolder('test',7,true);
?>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        lightbox.option({
            'resizeDuration': 500,
            'wrapAround': true,
            'showImageNumberLabel': true,
            'albumLabel': 'Bild %1 von %2',
        });
    });
</script>
