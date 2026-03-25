<title>Modifier responsable</title>

<body class="bg-dark vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static" data-open="click"
  data-menu="vertical-menu-modern" data-col="2-columns">


  <div class="container mt-4">
    <div class="card-shadow shadow-lg">
      <div class="card">
        <div class="card-body">
          <div class="card-title text-center fs-3 text-success">Modifier responsable</div>

          <form method="POST" class="d-flex flex-column gap-3">
            <input name="nom" value="<?= $responsable['nomresponsable'] ?>" class="form-control mb-2 fs-6">
            <input name="prenom" value="<?= $responsable['prenomresponsable'] ?>" class="form-control mb-2 fs-6">
            <input name="email" value="<?= $responsable['mailresponsable'] ?>" class="form-control mb-2 fs-6">
            <input name="telephone" value="<?= $responsable['telephoneresponsable'] ?>" class="form-control mb-2 fs-6">

            <select name="role" class="form-control mb-3 fs-6">
              <option value="RESPONSABLE" <?= $responsable['role'] == 'RESPONSABLE' ? 'selected' : '' ?>>
                COMPTABLE</option>
              <option value="BUREAU" <?= $responsable['role'] == 'BUREAU' ? 'selected' : '' ?>>BUREAU
              </option>
              <option value="ADMIN" <?= $responsable['role'] == 'ADMIN' ? 'selected' : '' ?>>ADMIN
              </option>
            </select>

            <button class="btn btn-darken">Mettre à jour</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

<?php require __DIR__ . '/../layout/footer.php'; ?>