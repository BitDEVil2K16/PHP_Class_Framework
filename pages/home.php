
<div class="centerflex h3" style="height: 100px; overflow: hidden">
    <div>Hallo hier werden wir dan als Nächstes mal ein Template einbinden damit wir ein wenig Frontend Haben!</div>
    <div id="hiddenpart" class="hiddeblock">
        <span style="color: lime">I was Hidden!</span>
    </div>
</div>
<?php
//$this->cookiemanager->delete('style');
//$this->style->SetStyle("dark");
//if ($this->cookiemanager->get('style') != "mynewultimatestyle"){
//    $this->style->SetStyle("mynewultimatestyle");
//    header('Location: '.$_SERVER['REQUEST_URI']);
//}
?>
<script>
    // Inline Script
    setTimeout(()=>{
        $("#hiddenpart").css('display','block');
        //document.getElementById("hiddenpart").style.display = "block";
    },1000);

</script>