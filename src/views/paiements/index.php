<!-- <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" /> -->
<title>Liste de paiement</title>

<body class="bg-dark vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static" data-open="click"
  data-menu="vertical-menu-modern" data-col="2-columns">


  <div class="container mt-4">
    <div class="card-shadow shadow-lg">
      <div class="card">
        <div class="card-body">
          <form method="GET">
            <input type="hidden" name="controller" value="paiement">

            <div class="input-group shadow-sm">
              <span class="input-group-text bg-darken text-white">
                <i class="bi bi-search"></i>
              </span>

              <input type="text" name="search" class="form-control"
                placeholder="Rechercher : CIN, Nom, Prénom, Type, Date..."
                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">

              <button class="btn btn-dark" type="submit">
                Rechercher
              </button>

              <?php if (!empty($_GET['search'])): ?>
              <a href="index.php?controller=paiement" class="btn btn-outline-secondary">
                Réinitialiser
              </a>
              <?php endif; ?>
            </div>
          </form>
          <div class="card-title text-center fs-3 text-darken fw-bold">LISTE DES PAIEMENTS</div>
          <table class="table table-striped table-bordered">
            <thead class="table-dark">
              <tr class="text-center">
                <th>ID</th>
                <th>CIN</th>
                <th>Membre</th>
                <th>Montant</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Expiration</th>
                <th>Etat</th>
                <th>Recus</th>
              </tr>
            </thead>

            <tbody class="text-center">
              <?php foreach ($payements as $p): ?>
              <tr>
                <td><?= $p['numpayement'] ?></td>
                <td><?= $p['cinpaiement'] ?></td>
                <td><?= $p['nom'] . ' ' . $p['prenom'] ?></td>
                <td><?= number_format($p['montant'], 0, ',', ' ') ?> Ar</td>
                <td><?= $p['datepaiement'] ?></td>
                <td>
                  <span class="badge text-dark fw-bold">
                    <?= $p['type'] ?>
                  </span>
                </td>
                <td>
                  <?php if( $p['type'] === 'cotisation') : ?>
                  <?= $p['date_expiration'] ?? '---' ?>
                  <?php endif; ?>
                </td>

                <td>
                  <?php
                  $today = date('Y-m-d');
                  $expired = empty($p['date_expiration']) || $p['date_expiration'] < $today;
                  ?>
                  <span class="badge bg-<?= $expired ? 'danger' : 'success' ?>">

                    <?= $expired ? 'Expiré' : 'Payé' ?>
                  </span>
                </td>
                <td>

                  <a href="index.php?controller=recu&action=pdf&id=<?= $p['numpayement'] ?>"
                    class="btn btn-sm btn-darken" target="_blank">
                    📄Reçu
                  </a>

                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            <!-- total paiements en couleur  -->
            <tfoot>
              <tr>
                <th colspan="2">Total</th>
                <!-- aligner par colonne montant -->
                <th colspan="3" class="fs-2 text-end">
                  <span class="badge fs-3 bg-<?=
            array_sum(array_column($payements, 'montant')) > 0 ? 'success' :
            (array_sum(array_column($payements, 'montant')) === 0 ? 'warning' : 'danger')
          ?>">
                    <?= number_format(array_sum(array_column($payements, 'montant')), 0, ',', ' ') ?> Ar
                  </span>
                </th>
              </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

  </div>

  <?php require __DIR__ . '/../layout/footer.php'; ?>