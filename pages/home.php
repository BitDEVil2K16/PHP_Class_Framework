<style>
    .hiddeblock {
        display: none;
    }
    .h3{
        font-size: 20px !important;
    }
</style>
<div class="row">
    <div class="ml-3 mr-3 mt-2">
        <div class="d-inline-block float-left mt-3 mr-2 d-flex flex-wrap justify-content-center">

            <span id="hiddenpart" class="hiddeblock">
                <div class="centerflex" style="color: lime;">
                    <div>I was Hidden, but now i am Visible!</div>
                </div>
            </span>
            <span id="hiddenpart2" class="hiddeblock">
                <div class="centerflex" style="color: lime;">
                    <div>I was Hidden, but now i am Visible!</div>
                </div>
            </span>
            <div class="centerflex" >
                <div>Willkommen auf der 0815 ohne Bedeutung Landing Page!</div>
            </div>
            <div class="centerflex" >
                <div>Willkommen auf der 0815 ohne Bedeutung Landing Page!</div>
            </div>
        </div>
    </div>
</div>

<script>
    // Inline Script
    setTimeout(()=>{
        $("#hiddenpart").css('display','block');
        $("#hiddenpart2").css('display','block');
        //document.getElementById("hiddenpart").style.display = "block";
    },1000);
</script>