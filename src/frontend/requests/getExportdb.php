<?php
    require "../vendor/autoload.php";
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    include_once("../models/User.php");
    include_once("HttpRequests.php");
    require_once("../config/config.php");

    session_start();
    $user = $_SESSION["user"];

    $http_requests = new HttpRequests();
    $response = $http_requests->getResponse("$BACKEND_URL/exportdb", "GET", "", $user->get_token());


    if($response["status"] == 200) {
        $filename = "datos_pacientes.xlsx";      
        $json = json_decode($response["data"]->json, true);
                
        $spreadsheet = new Spreadsheet();
        
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle("Pacientes");

        $c = 1;
        $r = 1;

        foreach($json as $column => $values) {
            $sheet->setCellValueByColumnAndRow($c, $r, $column);
            $r = $r + 1;

            foreach($values as $i => $v) {
                $sheet->setCellValueByColumnAndRow($c, $r, $v);
                $r = $r + 1;
            }
            $c = $c + 1;
            $r = 1;
        }
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
    else {
        if($response["status"] == 401) {
            unset($_SESSION["user"]);
            $_SESSION["error"] = "La sesión ha caducado";
            header("Location: ../login.php");
        }
        else {
            $_SESSION["error"] = "Error al exportar los datos de los pacientes";
            header("Location: ../data/exportdb.php");
        }
    }
?>
