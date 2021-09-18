
<h3 class="centerflex">
    <div>Hallo hier werden wir dan als Nächstes mal ein Template einbinden damit wir ein wenig Frontend Haben!</div>
    <div id="hiddenpart" class="hiddeblock">
        <h1><span style="color: lime">I was Hidden!</span></h1>
    </div>
</h3>

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
        document.getElementById("hiddenpart").style.display = "block";
    },1500);

</script>