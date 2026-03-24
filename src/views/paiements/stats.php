<title>Histogramme</title>

<div class="container mt-4">

  <h4 class="mb-4 text-center fw-bold">📊 Statistiques des Paiements</h4>

  <!-- Résumé -->
  <div class="row mb-3">
    <div class="col-md-6">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <small>Total paiements</small>
          <h5><?= $statsGlobal['total_paiements'] ?></h5>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <small>Montant total</small>
          <h5 class="text-success">
            <?= number_format($statsGlobal['total_montant'], 0, ',', ' ') ?> Ar
          </h5>
        </div>
      </div>
    </div>
  </div>

  <!-- Graphique -->
  <div class="card shadow-sm">
    <div class="card-body">
      <canvas id="chartPaiement" height="300"></canvas>
    </div>
  </div>

  <form method="GET" class="row g-2 mb-3">
    <input type="hidden" name="controller" value="paiement">
    <input type="hidden" name="action" value="stats">

    <div class="col-md-4">
      <select name="month" class="form-select">
        <?php for ($m=1;$m<=12;$m++): ?>
        <option value="<?= $m ?>" <?= $m==$month?'selected':'' ?>>
          <?= date('F', mktime(0,0,0,$m,1)) ?>
        </option>
        <?php endfor; ?>
      </select>
    </div>

    <div class="col-md-4">
      <select name="year" class="form-select">
        <?php for ($y=date('Y');$y>=2020;$y--): ?>
        <option value="<?= $y ?>" <?= $y==$year?'selected':'' ?>>
          <?= $y ?>
        </option>
        <?php endfor; ?>
      </select>
    </div>

    <div class="col-md-4">
      <button class="btn btn-primary w-100">
        🔍 Filtrer
      </button>
    </div>

    <!-- <div class="card mt-4">
      <div class="card-body">
        <h6 class="text-center">Répartition par type</h6>
        <canvas id="pieChart" height="100" width="100"></canvas>
      </div>
    </div> -->

    <div class="card mt-4">
      <div class="card-body">
        <h6 class="text-center fw-bold fs-5 text-primary">Utilisateurs par secteur</h6>
        <canvas id="professionChart" height="120"></canvas>
      </div>
    </div>

    <div class="card mt-4">
      <div class="card-body text-center">
        <h6 class="text-center fw-bold fs-5 text-primary">Répartition par genre</h6>

        <div style="max-width: 320px; margin: 0 auto;">
          <canvas id="genreChart"></canvas>
        </div>
      </div>
    </div>

    <div class="card mt-4">
      <div class="card-body">
        <h6 class="text-center fw-bold fs-5 text-primary">Utilisateurs par région</h6>
        <canvas id="regionChart" height="100"></canvas>
      </div>
    </div>
  </form>


</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const labels = <?= json_encode(array_column($statsByDate, 'jour')) ?>;
const data = <?= json_encode(array_column($statsByDate, 'total')) ?>;
//  colorer les barres en fonction du montant (vert > 100000, orange entre 50000 et 100000, rouge < 50000)
const backgroundColors = data.map(montant => {
  if (montant > 100000) return 'rgba(88, 147, 255, 0.7)'; // vert
  if (montant >= 50000) return 'rgba(88, 147, 255, 0.7)'; // orange
  return 'rgba(88, 147, 255, 0.7)'; // rouge
});

// colorer les barres profession en diffrent couleur
const backgroundColorsProfession = <?= json_encode(array_map(function($total) {
  if ($total > 2) return 'rgba(40, 167, 69, 0.7)'; // vert
  if ($total >= 2) return 'rgba(40, 167, 69, 0.7)'; // orange
  return 'rgba(40, 167, 69, 0.7)'; // rouge
}, array_column($statsProfession,'total'))) ?>;
// remplir par ligne

new Chart(document.getElementById('chartPaiement'), {
  type: 'bar',
  data: {
    labels: labels,
    datasets: [{
      label: 'Montant payé (Ar)',
      data: data,
      backgroundColor: backgroundColors,
      fill: false,
      tension: 0.3
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});

// Graphique à barres pour la répartition par profession
new Chart(document.getElementById('professionChart'), {
  type: 'bar',
  data: {
    labels: <?= json_encode(array_column($statsProfession,'profession')) ?>,
    datasets: [{
      label: 'Nombre d’utilisateurs',
      data: <?= json_encode(array_column($statsProfession,'total')) ?>,
      backgroundColor: backgroundColorsProfession,
      fill: false,
      tension: 0.3
    }]
  },

  options: {
    responsive: true,
    plugins: {
      legend: {
        display: false
      }
    },
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});

//regionChart
new Chart(document.getElementById('regionChart'), {
  type: 'bar',
  data: {
    labels: <?= json_encode(array_column($statsRegion,'lieutravail')) ?>,
    datasets: [{
      label: 'Nombre d’utilisateurs',
      data: <?= json_encode(array_column($statsRegion,'total')) ?>,
      backgroundColor: '#198754'
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        display: false
      }
    },
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});


// Graphique circulaire pour la répartition par type
const pieCtx = document.getElementById('pieChart');

new Chart(pieCtx, {
  type: 'pie',
  data: {
    labels: <?= json_encode(array_column($statsByType,'type')) ?>,
    datasets: [{
      data: <?= json_encode(array_column($statsByType,'total')) ?>,
      backgroundColor: [
        '#0d6efd', '#198754', '#ffc107', '#dc3545', '#6f42c1'
      ]
    }]
  }
});

// Genre stats

const genreCanvas = document.getElementById('genreChart');

const genreLabels = <?= json_encode(array_column($statsGenre ?? [], 'genre')) ?>;
const genreData = <?= json_encode(array_column($statsGenre ?? [], 'total')) ?>;

console.log('GENRE labels:', genreLabels);
console.log('GENRE data:', genreData);

if (genreCanvas && genreLabels.length > 0) {
  new Chart(genreCanvas, {
    type: 'pie',
    data: {
      labels: genreLabels,
      datasets: [{
        data: genreData,
        backgroundColor: ['#0d6efd', '#e83e8c', '#20c997', '#ffc107']
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  });
} else {
  console.warn('Graphe genre non affiché: canvas manquant ou données vides');
}
</script>