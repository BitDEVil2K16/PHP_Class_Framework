<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Copyright (c) 2021. BitDEVil2K16 Club. All rights reserved.
 * @author BitDEVil2K16 (Sascha P.)
 * @author BitDEVil2K16 Club <support@pc-dev.info>
 * @author BitDEVil2K16 Club https://bitdevil2k16.club
 * @github https://github.com/BitDEVil2K16
 * @FileName: CCPlus.php
 * @Date: 12.10.2021
 */
class CCPlus{
    /**
     *
     */
    function __construct()
    {

    }

    /**
     *
     */
    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    /**
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
    }

    /**
     * @param $name
     */
    public function __get($name)
    {
        // TODO: Implement __get() method.
    }

    public function getImagesFromFolder($folder,$perpage = 20, $createTump = false){
        $files = glob(BASEPATH."dynamic_content/$folder/*.{jpg,png,jpeg,gif}", GLOB_BRACE);
        $filefolder = BaseUrl("dynamic_content/$folder/");
        usort($files, function ($a, $b) {
            return filemtime($b) - filemtime($a);
        });
        $record_count  = $perpage;
        $totla_pages   = ceil(count($files)/$record_count);
        $page          = $_REQUEST['page'] ?? 1;
        $offset        = ($page-1)*$record_count;
        $files_filter  = array_slice($files, $offset,$record_count);
        echo '<div class="card">'.PHP_EOL.'<div class="card-header">Galerie '.ucfirst($folder).'</div>'.PHP_EOL.'<div class="card-body">';
        echo "\n".'<div class="ml-3 mr-3 mt-2">'.PHP_EOL."".'<div class="d-inline-block float-left mt-3 mr-2 d-flex flex-wrap justify-content-center">'.PHP_EOL;
        foreach ($files_filter as $file) {
            $files = $filefolder.basename($file);
            $splitfolderfile = explode('.', $file);
            $filename_no_ext = reset($splitfolderfile);
            if ($createTump){
                $filet = $filefolder.'thumb/'.basename($filename_no_ext.'_s.jpg');
                $thumbfolder = BASEPATH."dynamic_content/$folder/thumb/".basename($filename_no_ext.'_s.jpg');
                if (!file_exists(BASEPATH."dynamic_content/$folder/thumb")){
                    mkdir(BASEPATH."dynamic_content/$folder/thumb",0777,true);
                }
                if (!file_exists($thumbfolder) && file_exists($file)) {
                    create_thumb($file, $thumbfolder, 200);
                }
            } else {
                $filet = $files;
            }
        echo "\t".'<a class="lightboximage" href="'.$files.'" data-lightbox="PictureGalary '.$folder.'" data-title="'.basename($files).'">
        <img loading="lazy" src="'.$filet.'" width="180" height="180" alt="'.basename($files).'" />
        <span class="caption">'.basename($files).'</span>
    </a>'.PHP_EOL;
        }
echo '</div></div></div>
<div class="card-footer">'.PHP_EOL;
        $request = explode('/',$_REQUEST['p']);
        $buildreq = implode('/',$request);
        echo "\t".'<div class="d-inline-block float-left mt-2 mx-1 d-flex flex-wrap justify-content-center">'.PHP_EOL;
        if($totla_pages > 1){
            echo "\t\t".' <a class="btn btn-primary mx-1" href="'.BaseUrl($buildreq).'">Startseite</a> '."\n";
            if($page != 1){
                echo "\t\t".'<a class="btn btn-success mx-1" href="'.BaseUrl($buildreq).'?page='.($page-1).'">-</a> '."\n";
            }
            if($page != $totla_pages){
                echo "\t\t".' <a class="btn btn-success mx-1" href="'.BaseUrl($buildreq).'?page='.($page+1).'">+</a>'."\n";
            }
            echo "\t\t".' <a class="btn btn-primary mx-1" href="'.BaseUrl($buildreq).'?page='.$totla_pages.'">Letzte Seite</a> '."\n";
        }
        echo "\t</div>\n</div>\n</div>".PHP_EOL;
    }
}

