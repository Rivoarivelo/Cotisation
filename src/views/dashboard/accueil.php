<head>
  <title>Accueil</title>
  <link rel="icon" type="image/png" href="photos/logo.png">
</head>

<div class="main-content container-fluid">

  <!-- ================= KPI CARDS ================= -->
  <div class="row g-3 mb-4">

    <!-- SOLDE -->
    <div class="col-md-3 col-sm-6">
      <div class="card border-0 shadow bg-white text-dark">
        <div class="card-body text-center">
          <i class="fas fa-wallet fa-3x mb-2"></i>
          <h6>Solde Actuel</h6>
          <h3><?= number_format($solde,0,',',' ') ?> Ar</h3>
          <a href="index.php?controller=paiement" class="text-darken fw-bold">Voir →</a>
        </div>
      </div>
    </div>

    <!-- MEMBRES -->
    <div class="col-md-3 col-sm-6">
      <div class="card border-0 shadow bg-white text-dark">
        <div class="card-body text-center">
          <i class="fas fa-users fa-3x mb-2"></i>
          <h6>Membres</h6>
          <h3><?= $totalMembres ?></h3>
          <a href="index.php?controller=membre" class="text-darken fw-bold">Voir →</a>
        </div>
      </div>
    </div>

    <!-- SORTIES -->
    <div class="col-md-3 col-sm-6">
      <div class="card border-0 shadow bg-white text-dark">
        <div class="card-body text-center">
          <i class="fas fa-arrow-down fa-3x mb-2"></i>
          <h6>Total Sorties</h6>
          <h3><?= number_format($totalSortie,0,',',' ') ?> Ar</h3>
          <a href="index.php?controller=sortiefond" class="text-darken fw-bold">Voir →</a>
        </div>
      </div>
    </div>

    <!-- RESPONSABLE -->
    <div class="col-md-3 col-sm-6">
      <div class="card border-0 shadow bg-white text-dark">
        <div class="card-body text-center">
          <i class="fas fa-user-tie fa-3x mb-2"></i>
          <h6>Responsables</h6>
          <h3><?= $totalResponsable ?></h3>
          <a href="index.php?controller=responsable" class="fw-bold text-darken">Voir →</a>
        </div>
      </div>
    </div>

  </div>
  <!-- EVOLUTION FINANCE -->
  <div class="card shadow mb-4">
    <div class="card-header fw-bold">
      Evolution Financière
    </div>

    <div class="card-body">
      <canvas id="financeChart" height="70"></canvas>
    </div>
  </div>

  <div class="card mt-4">
    <div class="card-body">
      <h6 class="fw-bold fs-5 text-primary text-center">
        Régions les plus actives
      </h6>

      <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark text-center">
          <tr>
            <th>Rang</th>
            <th>Région</th>
            <th>Membres</th>
            <th>Paiements</th>
            <th>Montant total (Ar)</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php foreach ($regionsActives as $index => $r): ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= $r['region'] ?></td>
            <td><?= $r['total_membres'] ?></td>
            <td><?= $r['total_paiements'] ?></td>
            <td class="fw-bold text-success">
              <?= number_format($r['total_montant'],0,',',' ') ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </div>

  <!-- DERNIERE ACTIVITER -->
  <div class="card mt-4">
    <div class="card-header">
      Dernières activités
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>Date</th>
          <th>Action</th>
          <th>Montant</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($activites as $a): ?>
        <tr>
          <td><?= $a['date'] ?></td>
          <td><?= $a['action'] ?></td>
          <td><?= number_format($a['montant'],0,',',' ') ?> Ar</td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <?php if($solde < 0): ?>
  <div class="alert alert-danger mt-3">
    ⚠️ Attention : Solde négatif !
  </div>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



  <script>
  const evolution = <?= json_encode($evolution) ?>;

  const labels = evolution.map(e => e.mois);
  const data = evolution.map(e => e.total);

  new Chart(document.getElementById('financeChart'), {
    type: 'line',
    data: {
      labels: labels,
      datasets: [{
        label: 'Evolution Paiements',
        data: data
      }]
    }
  });
  </script>