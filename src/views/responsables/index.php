<head>
  <title>Responsable</title>
</head>

<body class="bg-dark vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static" data-open="click"
  data-menu="vertical-menu-modern" data-col="2-columns">


  <div class="container mt-4">
    <div class="card-shadow">
      <div class="card">
        <div class="card-body">
          <div class="card-title text-center fs-3 text-success fw-bold">Responsable</div>
          <a href="index.php?controller=responsable&action=add" class="btn btn-dark mb-3">
            Nouveau responsable
          </a>

          <table class="table table-bordered border border-1 rounded-3">
            <tr>
              <th>Nom</th>
              <th>Email</th>
              <th class="table-active">Rôle</th>
              <th>Actions</th>
            </tr>

            <?php foreach ($responsables as $r): ?>
            <tr>
              <td class="fs-5 "><?= $r['nomresponsable'] ?> <?= $r['prenomresponsable'] ?></td>
              <td class="fs-5 "><?= $r['mailresponsable'] ?></td>
              <td class="table-active fw-bold"><?= $r['role'] ?></td>
              <td class="d-flex gap-5">
                <a href="index.php?controller=responsable&action=edit&id=<?= $r['idresponsable'] ?>"
                  class="btn btn-warning btn-sm">✏️</a>

                <a onclick="return confirm('Supprimer ?')"
                  href="index.php?controller=responsable&action=delete&id=<?= $r['idresponsable'] ?>"
                  class="btn btn-danger btn-sm">🗑️</a>
              </td>
            </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
    </div>
</body>
<?php require __DIR__ . '/../layout/footer.php'; ?>