
</body>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('pre code').forEach((el) => {
            try{
                hljs.highlightElement(el);
            }catch{}
        });
    });
</script>
</html>