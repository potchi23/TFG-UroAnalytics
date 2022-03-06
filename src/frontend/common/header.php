<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="../dashboard.php">Icono app</a>
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
      <li class="nav-item">
        <a class="nav-link" href="#"><img src="/img/icono_persona.png" height="30%" width="15%"></span></a>
      </li>
    </ul>

    <ul class="nav navbar-nav navbar-right">      
      <div class="dropdown" >
        <i class="icon-account fa-solid fa-user-doctor fa-2x" onclick="dropdown()"></i>
        
        <div id="myDropdown" class="dropdown-content">
          <a href="../userProfile.php">Ver mi perfil</a>
          <a href="../logout.php">Cerrar sesion</a>
        </div>
      </div>
  </ul>

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
  </div>
</nav>