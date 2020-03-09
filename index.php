<!doctype html>
<html lang="en">

<head>
  <!--#region Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--#endregion -->

  <!--#region Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!--#endregion -->

  <title>Kezdőlap</title>

  <link rel="stylesheet" href="css/index.css">
</head>

<body class="bg-secondary">

  <!--#region NAVBAR  -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
      <h4>Névxd</h4>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item px-3">
          <a class="nav-link disabled" href="Tranzakciok.php" aria-disabled="true">
            <h5>Tranzakciók</h5>
          </a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link disabled" href="Szamlak.php" aria-disabled="true">
            <h5>Számlák</h5>
          </a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link disabled" href="Attekintes.php" aria-disabled="true">
            <h5>Áttekintés</h5>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <button class="btn btn-outline-success my-2 my-sm-0" id="regisztracio">Regisztráció</button>
        </li>
      </ul>
    </div>
  </nav>
  <!--#endregion -->

  <!--#region BEJELENTKEZŐS FORM -->
  <div class="fluid-container p-0 m-0 bg-secondary text-light">
    <div class="row">
      <div class="penz col-12 col-md-6" id="">Rosszul vagyok</div>
      <div class="col-12 col-md-6">
        <h1 class="display-4">Bejelentkezés</h1>
        <p class="lead">
          <form action="php/bejelentkezes.php" method="POST">
            <label for="email" class="">Email cím</label><br><input type="email" name="email" id="email"
              class="form-control"><br>
            <label for="jelszo" class="">Jelszó</label><br><input type="password" name="jelszo" id="jelszo"
              class="form-control"><br>

            <div class="form-row">
              <div class="from-group col">
                <input type="submit" value="Bejelentkezés" class="form-control">
              </div>
          </form>
      </div>
      <br>
      </p>
    </div>

  </div>
  </div>


  <!--#endregion -->

  <div class="bg-dark m-0">
    <h1 class="display-4 text-center text-light">Bemutatkozás</h1>
  </div>

  <!-- #region Bemutató jumbotron 1 -->
  <div class="jumbotron jumbotron-fluid bg-secondary text-light">
    <div class="container">
      <h1 class="display-4">Vezesd a költségeidet egyszerűen!</h1>
      <p class="lead">A XY átláthatóvá teszi a pénzügyeit, hasznos grafikonok és statisztikák segítségével.</p>
    </div>
  </div>
  <!--#endregion -->

  <!-- #region Footer -->
  <footer class="page-footer font-small blue pt-4 bg-dark text-light">
    <div class="container-fluid text-center text-md-left">
      <div class="row">
        <div class="col-md-6 mt-md-0 mt-3">
          <h5 class="text-uppercase">Elérhetőségek</h5>
        </div>

        <hr class="clearfix w-100 d-md-none pb-3">

        <div class="col-md-3 mb-md-0 mb-3">
          <img src="kepek/assistant-64.png">
          <h5 class="text-uppercase">+36 30 420 6969</h5>
        </div>

        <div class="col-md-3 mb-md-0 mb-3">
          <img src="kepek/contacts-2-64.png">
          <h5 class="">honlapneve@gmail.com</h5>
        </div>
      </div>
    </div>
  </footer>
  <!--#endregion -->
  
  <?php
  include 'pages/components/bootstrap.php';
  ?>
  <script src="js/index.js"></script>
</body>

</html>