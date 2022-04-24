<div class="sidebar-logo">
    ÍNDICE
  </div>
  <ul class="sidebar-navigation">
    <li>
      <a href="#indexUserGuide">
        <i aria-hidden="true"></i>Inicio 
      </a>
    </li>    
    <li>
      <a href="#querysGuide">
        <i aria-hidden="true"></i>Consultas
      </a>
    </li>
    <li>
      <a href="#predictionsGuide">
        <i aria-hidden="true"></i>Predicciones
      </a>
    </li>
    <li>
      <a href="#patientsGuide">
        <i aria-hidden="true"></i>Pacientes
      </a>
    </li>
    <?php
        $user = $_SESSION["user"];
        
        if ($user->get_type() == 'admin') {
            echo "<li><a href='#registerPetitionsGuide'><i aria-hidden='true'></i>Página Peticiones de registro</a></li>";
        }
    ?>       
    <li>
      <a href="#myAccountGuide">
        <i aria-hidden="true"></i>Mi cuenta
      </a>
    </li>
  </ul>