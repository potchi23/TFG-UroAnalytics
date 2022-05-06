<?php
    $data_array = NULL;
    if($response["status"] != 200) {
        if($response["status"] == 401){
            unset($_SESSION["user"]);
            echo "<script>alert('La sesión ha caducado. Vuelva a iniciar sesión.');</script>";
            $_SESSION["message"] = "La sesión ha caducado";
            echo "<script type='text/javascript'>window.location.href = '../login.php';</script>";
        }else if($response["data"]->errorMsg != ""){
            $error = $response["data"]->errorMsg;
            echo"<div class='alert-message'><div class='alert alert-danger'>$error</div></div>";
        }
    }else{
        $data_array = $response["data"]->data;
        $num_patients = $response["data"]->num_entries;

        if($num_patients > 0) 
            echo "<h5>Número de pacientes: $num_patients</h5><br>";
        else
            echo "<h5>No hay pacientes en la base de datos</h5><br>";                                                    
    ?>
        
    <div class="table-container m-auto">
        <div class="table-responsive table-content">
            <table class="table table-striped table-bordered table-hover table-light">
                <?php                                    
                    if (count($data_array) > 0) {

                        echo '<tr class="thead-dark">';
                        echo "<th>#</th>";
                        foreach($data_array[0] as $key=>$value){
                            echo "<th>$key</th>";
                        }
                        echo "</tr>";  

                        $numElems = count($data_array);

                        foreach($data_array as $petition){
                            echo "<tr id='patients_$petition->N'>";
                            echo "<td>$petition->N</td>";
                            foreach($petition as $key=>$value){
                                echo "<td>$value</td>";
                            }
                            echo "</tr>";                                      
                        }

                    }
                ?>
            </table>             
        </div>
    </div>
<?php }?>