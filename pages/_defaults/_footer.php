
</div>
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
                if (!detectMobile())
                hljs.initLineNumbersOnLoad();
            }catch{}
        });
        function detectMobile() {
            return ( ( window.innerWidth <= 800 ) && ( window.innerHeight <= 600 ) );
        }
    });
</script>
</html>