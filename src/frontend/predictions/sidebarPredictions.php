<?php
    require_once("../models/User.php");

    if (!isset($_SESSION["user"])){
        header("Location: ../login.php");
    }

    $user = $_SESSION["user"];
?>


<div class="sidebar-logo">
    PREDICCIONES
</div>

<ul class="sidebar-navigation">
  <li class="header-sidebar">Índice</li>

  <?php
  if($user->is_admin()){
    echo <<<EOL
      <li>
        <a href="#training">
          <i aria-hidden="true"></i> Entrenamiento
        </a>
      </li>
      EOL;
  }
  ?>

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

  <li>
    <a href="patients.php">
      <i aria-hidden="true"></i> Prediccion sobre paciente existente
    </a>
  </li>
</ul>