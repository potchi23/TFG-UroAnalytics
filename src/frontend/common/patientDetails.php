<?php 
    $columns_array = $columns["data"]->data;

    function printSwitch($i, $columns_array){
        echo "  <div class='col-xl-'>
                    <div class='custom-control custom-switch' style='margin-bottom: 0.2em;'>
                        <input type='checkbox' class='custom-control-input' id=$columns_array[$i] name=$columns_array[$i]>
                        <label class='custom-control-label' for=$columns_array[$i]></label>
                    </div>
                </div>
                <div class='col-xl-'>
                    <h5> $columns_array[$i] </h5>
                </div>";
    }

    function loop($ini, $fin, $columns_array){
        for ($i=$ini; $i < $fin; $i++){
            if(($i-$ini) % 3 == 0){
                echo "<div class='col-xl align-items-center'>";
            }
            
            echo "<div class='row'>";
            printSwitch($i, $columns_array);
            echo "</div>";

            if(($i-$ini) % 3 == 2 || $i == ($fin-1)){
                echo "</div>";
            }
        }
    }
?>

<!--filiacion-->
<div class='form-row align-items-center'>
    <div class="col-xl-">
        <h2> Filiación </h2>
    </div>
</div>
<br>
<div id="cir" class="row">
    <?php loop(1, 2, $columns_array); ?>
</div>

<hr class='my-8'>

<!--sociodemograficas-->
<div class='form-row align-items-center'>
    <div class="col-xl-">
        <h2> Sociodemográficas </h2>
    </div>
</div>
<br>
<div id="sociodemographic" class="row">
    <?php loop(2, 4, $columns_array); ?>
</div>

<hr class='my-8'>

<!--antecedentes-->
<div class='form-row align-items-center'>
    <div class="col-xl-">
        <h2> Antecedentes </h2>
    </div>
</div>
<br>
<div id="background" class="row">
    <?php loop(4, 9, $columns_array); ?>
</div>

<hr class='my-8'>

<!--clinico-patologicas-->
<div class='form-row align-items-center'>
    <div class="col-xl-">
        <h2> Clinico-patológicas </h2>
    </div>
</div>
<br>
<div id="clinic" class="row">
    <?php loop(9, 14, $columns_array); ?>
</div>

<hr class='my-8'>

<!--biopsias prostaticas-->
<div class='form-row align-items-center'>
    <div class="col-xl-">
        <h2> Biopsias prostáticas </h2>
    </div>
</div>
<br>
<div id="biopsy" class="row">
    <?php loop(14, 24, $columns_array); ?>
</div>

<hr class='my-8'>

<!--tras-prostatectomia-->
<div class='form-row align-items-center'>
    <div class="col-xl-">
        <h2> Tras prostatectomía </h2>
    </div>
</div>
<br>
<div id="prostate" class="row">
    <?php loop(24, 38, $columns_array); ?>
</div>

<hr class='my-8'>

<!--evolutivos-->
<div class='form-row align-items-center'>
    <div class="col-xl-">
        <h2> Evolutivos </h2>
    </div>
</div>
<br>
<div id="evolve" class="row">
    <?php loop(38, 51, $columns_array); ?>
</div>

<hr class='my-8'>

<!--marcadores-->
<div class='form-row align-items-center'>
    <div class="col-xl-">
        <h2> Marcadores </h2>
    </div>
</div>
<br>
<div id="markers" class="row">
    <?php loop(51, 58, $columns_array); ?>
</div>

<hr class='my-8'>

<!--otros-->
<div class='form-row align-items-center'>
    <div class="col-xl-">
        <h2> Otros </h2>
    </div>
</div>
<br>
<div id="others" class="row">
    <?php loop(58, count($columns_array), $columns_array); ?>
</div>
