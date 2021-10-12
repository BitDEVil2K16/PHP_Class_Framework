
</div>
<?php if($this->config['bootstrap']): ?>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<?php
if (file_exists(BASEPATH.'core/js/bootstrap/'.$this->config['bootstrap-style'].'.js')){
?><script src="<?= BaseUrl('core/js/bootstrap/'.$this->config['bootstrap-style'].'.js?v=1')?>"></script>
<?php
}
?>
        </div>
    </div>
</div>
<?php endif; ?>

<footer>
    <div class="footermain">
        <div class="footerleft"><a href="<?= $this->settings->site_url() ?>" target="_self"><?= $this->config['sitename'] ?></a></div>
        <div class="footercenter">
            Project ToDo:<a href="https://github.com/BitDEVil2K16/PHP_Class_Framework/projects/1" target="_blank" rel="noreferrer" >Github Project</a> |
            Source Code:<a href="https://github.com/BitDEVil2K16/PHP_Class_Framework" target="_blank" rel="noreferrer" >Github</a>
        </div>
        <div class="footerright">&copy;2016 - <?= Date('Y') ?> by <a href="https://bitdevil2k16.club" target="_blank" rel="noreferrer">BitDEVil2K16 Club</a> </div>
    </div>
</footer>
</body>
<?php
$segment = explode("/",preg_replace('/\\.[^.\\s]{3,4}$/', '', $_SERVER['REQUEST_URI']));
array_shift($segment);
if ($segment[0] == ''){
    $cur_tab = 'home';
} else{
    if (array_key_exists(1, $segment) && $segment[1] != ''){
        $cur_taba = implode("_",$segment);
        $cur_tab = $segment[0]."_".$segment[1];
    } else {
        $cur_tab = $segment[0];
    }
}
$cur_tab = strtolower($cur_tab);
if ($cur_tab == 'index') $cur_tab = 'home';
?>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        for (let pres = document.querySelectorAll("code"), i = 0; i < pres.length; i++) pres[i].addEventListener("dblclick", function() {
            let e = getSelection(),
                t = document.createRange();
            t.selectNodeContents(this), e.removeAllRanges(), e.addRange(t)
        }, !1);
        document.querySelectorAll("code").forEach(function(el) {
            el.innerHTML = el.innerHTML.replace(/<br/g, "&lt;br /").replace(/<hr/g, "&lt;hr /").replace(/</g, "&lt;").replace(/>/g, "&gt;");
        });
        document.querySelectorAll('pre code').forEach((el) => {
            try{
                hljs.highlightElement(el);
                //if (!detectMobile())
                hljs.initLineNumbersOnLoad();
            }catch{}
        });
        try {
            if ($("#<?= $cur_tab ?>").length > 0){
                $("#<?= $cur_tab ?> > a").addClass('active');
            } else {
                $("#<?= explode('_',$cur_tab)[0] ?> > a").addClass('active');
            }
        } catch (e) {
            console.error(e)
        }
        function detectMobile() {
            return ( ( window.innerWidth <= 800 ) && ( window.innerHeight <= 600 ) );
        }
    });
</script>
</html>