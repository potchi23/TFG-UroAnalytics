<div class="sidebar-logo">
    ÍNDICE
  </div>
  <ul class="sidebar-navigation">
    <li>
      <a href="#indexHelp">
        <i aria-hidden="true"></i>Inicio 
      </a>
    </li>    
    <li>
      <a href="#querysHelpSection">
        <i aria-hidden="true"></i>Consultas
      </a>
    </li>
    <li>
      <a href="#predictionsHelpSection">
        <i aria-hidden="true"></i>Predicciones
      </a>
    </li>
    <li>
      <a href="#patientsHelpSection">
        <i aria-hidden="true"></i>Pacientes
      </a>
    </li>
    <?php
        $user = $_SESSION["user"];
        
        if ($user->get_type() == 'admin') {
            echo "<li><a href='#registerPetitionsHelpSection'><i aria-hidden='true'></i>Página Peticiones de registro</a></li>";
        }
    ?>       
    <li>
      <a href="#profileHelpSection">
        <i class="fa-solid fa-user-doctor fa-2x" aria-hidden="true"></i>
      </a>
    </li>
  </ul>