<?php
$page = "szamlak";
include 'components/header.php';
?>
<body class="bg-secondary">
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Számla neve</th>
        <th scope="col">Összeg a számlán</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody id="tablazat">
    </tbody>
  </table>

  <form class="mx-4">
    <div class="form-group">
      <label for="szamla">Számla neve</label>
      <input type="text" class="form-control" id="szamla" required>
    </div>
    <div class="form-group">
      <label for="osszeg">Összeg</label>
      <input type="number" class="form-control" id="osszeg" required min="0">
    </div>
    <input type="submit" class="form-control" id="gomb" value="Létrehozás">
  </form>

  <div class="modal fade" id="szamlaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Szerkesztés</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST">
            <input type="text" id="modalSzamla" name="szamla" class="form-control">
            <input type="number" id="modalOsszeg" name="osszeg" id="osszeg" class="form-control">
            <p id="modalHiba" class="text-danger"></p>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Bezárás">
          <input type="button" id="modalMentes" class="btn btn-primary" data-dismiss="modal" value="Mentés">
        </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  include 'components/bootstrap.php';
  ?>
  <script src="../js/Szamlak.js"></script>
</body>

</html>