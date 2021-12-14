<?php
    session_start();

    $ch = curl_init();

    $delete_req = array(
        "id" => $_POST["id"]
    );

    curl_setopt($ch, CURLOPT_URL,"http://localhost:5000/register_petitions");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $delete_req);

    $response = curl_exec($ch);
    
    curl_close($ch);
   
    if(curl_getinfo($ch, CURLINFO_RESPONSE_CODE) == 200) {
        $data = json_decode($response)->data[0];
        $email = $data->email;
        $name = $data->name;

        $subject = 'Estado de solicitud de registro';
        
        $msg = "Hola $name. Te informamos que hemos rechazado tu solicitud de registro.";
        $headers = 'From: tfg@ucm.es' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        //mail($email, $subject, $msg, $headers);

        header("Location: ../registerPetitions.php");
    }
    else{
        echo "<h1>Hubo un error</h1>";
    }
?>
