<?php
    $ch = curl_init();

    $post_req = array(
        "email" => $_POST["email"], 
        "password" => $_POST["password"]
    );

    curl_setopt($ch, CURLOPT_URL,"http://localhost:5000/login");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_req);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    
    curl_close($ch);
    $response_array = json_decode($response,true);
    $email = $response_array["email"];
    $password = $response_array["password"];

    // Create connection
    $conn = mysqli_connect("localhost","root","","tfg_bd");

    if(!$conn){
        die("Connection error: " . mysqli_connect_error()); 
    }

    $sql = "select * from users where email = '".$email."'";
    $rs = mysqli_query($conn,$sql);
    $numRows = mysqli_num_rows($rs);

    if($numRows  == 1){
        $row = mysqli_fetch_assoc($rs);
        if(password_verify($password,$row['password'])){
            header("Location: ../dashboard.php?email=$email&password=$password");
        }else{
            header("Location: ../dashboard.php?email=DoctorMalito&password=Tolai");;
        }
    }
?>
