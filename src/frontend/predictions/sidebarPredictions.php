<?php
    require_once("../models/User.php");

    if (!isset($_SESSION["user"])){
        header("Location: ../login.php");
    }

    $user = $_SESSION["user"];
?>

<ul class="sidebar-navigation" style="padding-top: 5px;">
  <li class="header-sidebar">Índice</li>
  <li>
    <a href="#indexPrediction">
      <i aria-hidden="true"></i> Inicio Predicción
    </a>
  </li>
  <li>
    <a href="#dataPatients">
      <i aria-hidden="true"></i> Datos del paciente
    </a>
  </li>
  <li>
    <a href="#predictionAlgorithm">
      <i aria-hidden="true"></i> Algoritmo a utilizar
    </a>
  </li>
</ul>