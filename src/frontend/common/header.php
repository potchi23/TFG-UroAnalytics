<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary" style="background-color:#004370 !important; border-bottom:solid 1px black;">
  <div class="container-fluid">
    <button id="brand-logo" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a id="homePage" class="navbar-brand" href="../homePage.php">
        <img src="../img/logo.png" alt="logo" width="40" height="40">
      </a>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a id="querysPage" class="nav-link" href="../querys/queryIndex.php">Consultas <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a id="predictionsPage" class="nav-link" href="../predictions/predictions.php">Predicciones</a>
        </li>
        <li class="nav-item">
          <a id="patientsPage" class="nav-link" href="../patients/patientsIndex.php?page=1">Pacientes</a>
        </li>
        <?php
            $user = $_SESSION["user"];
            
            if ($user->is_admin()) {
              echo "<li class='nav-item'><a class='nav-link' href='../registerPetitions.php?page=1'>Peticiones de registro</a></li>";
            }
        ?>
        <li class="nav-item">
          <a id="userGuidePage" class="nav-link" href="../userGuide/userGuideIndex.php">Manual de usuario</a>
        </li> 
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <div style="margin-top:0.8rem; margin-right:1rem;">
          <?php
            if ($user->is_admin()) {
              echo "<li class='nav-item' style='color:white;'>Modo Admin</li>";
            }
          ?>
        </div>

        <div class="dropdown">
          <i class="icon-account fa-solid fa-user-doctor fa-2x" onclick="dropdown()" style="background-color: #004370;" onMouseOver="this.style.color='lightgray'" onMouseOut="this.style.color='white'"></i>     
          <div id="myDropdown" class="dropdown-content">
            <a href="../userProfile.php">Ver mi perfil</a>
            <a href="../logout.php">Cerrar sesion</a>
          </div>
        </div>  
      </ul>
    </div>      
    </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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

  var currentLocation = location.href;
  var menuItem = document.getElementsByClassName('nav-link');
  var menuLength = menuItem.length;
  var active = false;

  for(var i = 0; i < menuLength; i++) { 
    if(menuItem[i].href === currentLocation) {
      menuItem[i].className += " active";
      active = true;
    }
  }

  if(!active) {        
    if(currentLocation.toLowerCase().includes('query'.toLowerCase())) {
      var queryItem = document.getElementById("querysPage");
      queryItem.className += " active";
      active = true;
    }
    else if(currentLocation.toLowerCase().includes('prediction'.toLowerCase())) {
      var predictionItem = document.getElementById("predictionsPage");
      predictionItem.className += " active";
      active = true;
    }
    else if(currentLocation.toLowerCase().includes('patients'.toLowerCase())) {
      var patientItem = document.getElementById("patientsPage");
      patientItem.className += " active";
      active = true;
    }
    else if(currentLocation.toLowerCase().includes('homePage'.toLowerCase())) {
      var homePageItem = document.getElementById("homePage");
      homePageItem.className += " active";
      active = true;
    }    
  }
    
  </script>
</nav>