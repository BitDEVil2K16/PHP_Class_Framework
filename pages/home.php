<!-- Body -->
<?php
echo "<h3>".BaseUrl("core/css/")."</h3>";
?>
<div id="hiddenpart" class="hiddeblock">
    <h1><span style="color: lime">I was Hidden!</span></h1>
</div>
<!-- Body end -->
<script>
    // Inline Script
    setTimeout(()=>{
        document.getElementById("hiddenpart").style.display = "block";
    },1500);

</script>