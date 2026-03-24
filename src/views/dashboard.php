<?php require 'layout/header.php'; ?>

<div class="row">
  <div class="col-md-6">
    <div class="card bg-success text-white">
      <div class="card-body">
        <h5>Total Paiements</h5>
        <h2><?= $totalPaiement ?> Ar</h2>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card bg-primary text-white">
      <div class="card-body">
        <h5>Membres</h5>
        <h2><?= $totalMembre ?></h2>
      </div>
    </div>
  </div>
</div>

<?php require 'layout/footer.php'; ?>
