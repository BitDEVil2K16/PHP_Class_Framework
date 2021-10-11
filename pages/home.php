<div class="centerflex" style="height: 180px;">
    <div>Hallo hier werden wir dan als Nächstes mal ein Template einbinden damit wir ein wenig Frontend Haben!</div>
</div>
<div id="hiddenpart" class="hiddeblock">
    <span style="color: lime; height: 100px;">I was Hidden, but now i am Visible!</span>
</div>
<script>
    // Inline Script
    setTimeout(()=>{
        $("#hiddenpart").css('display','block');
        //document.getElementById("hiddenpart").style.display = "block";
    },1000);
</script>