<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="../dashboard.php">
        <img src="../img/logo.png" alt="logo" width="40" height="40">
      </a>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="../queryIndex.php">Consultas <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../predictions/predictions.php">Predicciones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../patients/patientsIndex.php">Pacientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../data/dataIndex.php">Datos</a>
        </li>
        <?php
            $user = $_SESSION["user"];
            
            if ($user->get_type() == 'admin') {
              echo "<li class='nav-item'><a class='nav-link' href='../registerPetitions.php?page=1'>Peticiones de registro</a></li>";
            }
        ?> 
      </ul>      
    </div>
  
    <div class="dropdown">
      <i class="icon-account fa-solid fa-user-doctor fa-2x" onclick="dropdown()"></i>
      
      <div id="myDropdown" class="dropdown-content">
        <a href="../userProfile.php">Ver mi perfil</a>
        <a href="../logout.php">Cerrar sesion</a>
      </div>
    </div>  
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>         
  <script language="javaScript"> 
  function dropdown() {
    const dropdown = document.getElementById('myDropdown');
    dropdown.classList.toggle('show');
  }

  window.onclick = function(event) {
    if (!event.target.matches('.icon-account')) {
      var dropdowns = document.getElementsByClassName('dropdown-content');

      for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
  </script>
</nav>