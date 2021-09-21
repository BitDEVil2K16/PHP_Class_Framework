
</body>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        for (let pres = document.querySelectorAll("code"), i = 0; i < pres.length; i++) pres[i].addEventListener("dblclick", function() {
            let e = getSelection(),
                t = document.createRange();
            t.selectNodeContents(this), e.removeAllRanges(), e.addRange(t)
        }, !1);
        document.querySelectorAll('pre code').forEach((el) => {
            try{
                hljs.highlightElement(el);
                hljs.initLineNumbersOnLoad();
            }catch{}
        });
    });
</script>
</html>