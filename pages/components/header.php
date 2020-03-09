<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>Szakdolgozat</title>
</head>

<body class="bg-secondary">
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
          <a class="nav-link <?php if ( $page == "tranzakciok" ) { echo "active"; } ?>" href="<?php if ( $page == "tranzakciok" ) { echo "#"; } else { echo "Tranzakciok.php"; } ?>">
            <h5>Tranzakciók</h5>
          </a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link <?php if ( $page == "szamlak" ) { echo "active"; } ?>" href="<?php if ( $page == "szamlak" ) { echo "#"; } else { echo "Szamlak.php"; } ?>">
            <h5>Számlák</h5>
          </a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link <?php if ( $page == "attekintes" ) { echo "active"; } ?>" href="<?php if ( $page == "attekintes" ) { echo "#"; } else { echo "Attekintes.php"; } ?>">
            <h5>Áttekintés</h5>
          </a>
        </li>
        <li class="nav-item px-3">
        <form action="../php/kijelentkezes.php">
          <input type="submit" value="Kijelentkezés">
        </form>
        </li>
      </ul>
    </div>
  </nav>

  <?php
  include 'bootstrap.php';
  ?>
</body>

</html>