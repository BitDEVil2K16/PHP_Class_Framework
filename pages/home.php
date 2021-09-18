<style>
    .h3{
        font-size: 20px !important;
    }
    a{
        text-decoration: none;
        color: #40A4F3;
    }
    a:visited{
        color: #40A4F3;
    }
</style>
<div class="centerflex h3" style="height: 100px; overflow: hidden">
    <div>Hallo hier werden wir dan als Nächstes mal ein Template einbinden damit wir ein wenig Frontend Haben!</div>
    <div id="hiddenpart" class="hiddeblock">
        <span style="color: lime">I was Hidden!</span>
    </div>
</div>
<hr />
<div class="centerflex h3">
    <div>
        ToDo und so : <a href="https://github.com/BitDEVil2K16/PHP_Class_Framework/projects/1" target="_blank" rel="noreferrer" >Github Project</a>
    </div>
    <div>
        Source Code : <a href="https://github.com/BitDEVil2K16/PHP_Class_Framework" target="_blank" rel="noreferrer" >Github</a>
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