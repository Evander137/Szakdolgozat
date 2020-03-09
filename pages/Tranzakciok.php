<?php
$page = "tranzakciok";
include 'components/header.php';
?>

<body class="bg-secondary">
  <form action="">
    <div class="form-row">
      <div class="form-group col px-3">
        <label for="osszeg" class="text-light">Összeg</label>
        <input class="form-control" type="number" id="osszeg" min="0" placeholder="Összeg">
      </div>
      <div class="form-group col px-3">
        <label for="kategoria" class="text-light">Kategória</label>
        <select class="form-control" name="" id="kategoria">
          <option value="1" style="background-color:black; color:white" disabled>Bevételek</option>
          <option value="4" style="background-color:black; color:white" disabled>Költségek</option>
        </select>
      </div>
      <div class="form-group col px-3">
        <label for="szamla" class="text-light">Számla</label>
        <select class="form-control" id="szamla">
        </select>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col px-3">
        <label for="datum" class="text-light">Dátum</label>
        <input class="form-control" type="date" id="datum">
      </div>
      <div class="form-group col px-3">
        <label for="megjegyzes" class="text-light">Megjegyzés:</label>
        <input class="form-control" type="text" id="megjegyzes" placeholder="Megjegyzés">
      </div>
    </div>
    <div class="form-row px-3">
      <input class="form-control" type="button" value="Felvitel" id="felvitel">
    </div>
  </form>

  <div id="hibasAdatok" class="alert alert-danger" hidden>
    Kérem töltse ki a mezőket megfelelően!
  </div>
  <div id="siker" class="alert alert-success" hidden>
    Az adatok felvitele sikeresen megtörtént!
  </div>
  <div id="chartContainer" style="height: 300px; width: 100%;"></div>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

  <?php
  include 'components/bootstrap.php';
  ?>
  <script src="../js/Tranzakciok.js"></script>
</body>

</html>