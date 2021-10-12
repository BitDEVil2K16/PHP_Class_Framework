<style>
    .hiddeblock {
        display: none;
    }
    .centerflex div {
        width: 100%;
        min-width: 250px;
        height: 50px;
    }
    .card{
        margin-right: 10px;
    }
    .card-body{
        height: 180px;
        max-height: 180px;
        overflow-y: auto;
    }
</style>
<?php
$maxperrow = "col-md-3";
$cardset = "w-100 mb-4";
?>
<div class="row grid flex">
    <div class='<?= $maxperrow ?> d-flex align-items-stretch'>
        <div class="card <?= $cardset ?>">
            <div class="card-header">Card 1</div>
            <div class="card-body" >
                <div>Willkommen auf der 0815 ohne Bedeutung Landing Page!</div>
            </div>
            <div class="card-footer">&copy; 2021</div>
        </div>
    </div>

    <div class='<?= $maxperrow ?> d-flex align-items-stretch'>
        <div class="card <?= $cardset ?>">
            <div class="card-header">Card 2</div>
            <div class="card-body" style="color: lime;">
                <div id="hiddenpart" class="hiddeblock">I was Hidden, but now i am Visible!</div>
            </div>
            <div class="card-footer">&copy; 2021</div>
        </div>
    </div>

    <div class='<?= $maxperrow ?> d-flex align-items-stretch'>
        <div class="card <?= $cardset ?>">
            <div class="card-header">Card 3</div>
            <div class="card-body" >
                <div>Willkommen auf der 0815 ohne Bedeutung Landing Page!</div>
            </div>
            <div class="card-footer">&copy; 2021</div>
        </div>
    </div>

    <div class='<?= $maxperrow ?> d-flex align-items-stretch'>
        <div  class="card <?= $cardset ?>">
            <div class="card-header">Card 4</div>
            <div class="card-body" style="color: lime;">
                <div id="hiddenpart3" class="hiddeblock">I was Hidden, but now i am Visible!</div>
            </div>
            <div class="card-footer">&copy; 2021</div>
        </div>
    </div>

    <div class='<?= $maxperrow ?> d-flex align-items-stretch'>
        <div class="card <?= $cardset ?>">
            <div class="card-header">Card 5</div>
            <div class="card-body" style="color: lime;">
                <div id="hiddenpart2" class="hiddeblock">I was Hidden, but now i am Visible!</div>
            </div>
            <div class="card-footer">&copy; 2021</div>
        </div>
    </div>
</div>

<script>
    // Inline Script
    setTimeout(()=>{
        $("#hiddenpart").css('display','block');
        setTimeout(()=>{
            $("#hiddenpart3").css('display','block');
            setTimeout(()=>{
                $("#hiddenpart2").css('display','block');
            },1000);
        },1000);
    },1000);
</script>