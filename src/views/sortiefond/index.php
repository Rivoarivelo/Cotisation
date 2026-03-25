<title>Sortie de fond</title>

<body class="bg-light">

  <div class="container mt-4">
    <div class="card-shadow">
      <div class="card">
        <div class="card-body">
          <div class="card-title text-center fs-3 text-darken">Sortie de fond</div>
          <?php if ($_SESSION['user']['role'] === 'ADMIN' || $_SESSION['user']['role'] === 'COMPTABLE'): ?>
            <form method="POST" class="card p-3 border border-1 border-dark mb-4">
              <div class="mb-2">
                <label>Motif</label>
                <input type="text" name="motif" class="form-control border border-1 border-dark" required>
              </div>
              <div class="mb-2">
                <label>Date</label>
                <input type="date" name="datesortie" class="form-control border border-1 border-dark" required>
              </div>

              <div class="mb-2">
                <label>Montant</label>
                <input type="number" name="montantsortie" class="form-control border border-1 border-dark" required>
              </div>

              <div class="mb-2">
                <label>Responsable</label>
                <select name="responsable" class="form-select border border-1 border-dark" required>
                  <option value="">-- Choisir --</option>
                  <?php foreach ($responsables as $r): ?>
                    <option value="<?= $r['idresponsable'] ?>">
                      <?= $r['nomresponsable'] ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <button name="ajouter" class="btn btn-darken mt-2">Enregistrer</button>
            </form>
          <?php endif; ?>

          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Motif</th>
                <th>Date</th>
                <th>Montant</th>
                <th>Responsable</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($sorties as $s): ?>
                <tr>
                  <td><?= $s['idsortie'] ?></td>
                  <td><?= $s['motif'] ?></td>
                  <td><?= $s['datesortie'] ?></td>
                  <td><?= number_format($s['montantsortie'], 2) ?> Ar</td>
                  <td><?= $s['nomresponsable'] ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          <div class="card mt-4 shadow">
            <div class="card-body">
              <div class="card-title text-center fs-3 text-darken">📊 Situation Financière</div>
              <div class="row text-center">
                <div class="col-md-4">
                  <div class="alert alert-success">
                    <strong>Total Entrées</strong><br>
                    <?= number_format($totalEntree, 2) ?> Ar
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="alert alert-danger">
                    <strong>Total Sorties</strong><br>
                    <?= number_format($totalSortie, 2) ?> Ar
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="alert alert-primary">
                    <strong>💰 Solde Restant</strong><br>
                    <h4><?= number_format($soldeRestant, 2) ?> Ar</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>