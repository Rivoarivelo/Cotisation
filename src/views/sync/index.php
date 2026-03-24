<title>Synchronisation</title>


<a href="<?= BASE_URL ?>?controller=export&action=csv" class="btn btn-darken mb-3">
  Export CSV Global
</a>


<div class="ms-3 mt-2">
  <div class="row g-2">

    <!-- TABLE ADHESION -->
    <div class="card col-md-5 ms-3 border border-1 border-darken">
      <h4 class="text-darken">ADHESION</h4>
      <table class="table table-bordered  table-sm">
        <thead class="table-success">
          <tr class="text-center" >
            <th>CIN</th>
            <th>Nom et Prenom</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="text-center">
<?php foreach ($adhesions as $a): ?>
<tr class="text-center <?= empty($a['existe']) ? 'table-success' : '' ?>">

  <td><?= $a['CIN'] ?></td>
  <td><?= $a['nom'] .' '. $a['prenom'] ?></td>

  <td>
    <a href="index.php?controller=sync&action=syncOne&cin=<?= $a['CIN'] ?>"
       class="btn btn-sm btn-primary">
       ➜
    </a>
  </td>

</tr>
<?php endforeach; ?>
</tbody>
      </table>
      <div class="mt-3 text-center">
           <a href="index.php?controller=sync&action=syncAll"
                         class="btn btn-success">
                         🔄 Tout synchroniser
                   </a>
      </div>

    </div>
 
    <!-- TABLE COMPTA -->
    <div class="card col-md-6 ms-5 border border-1 border-black">
      <h4 class="text-darken">COMPTA</h4>
      <table class="table table-bordered table-sm ">
        <thead class="table-primary">
          <tr class="text-center">
            <th>CIN</th>
            <th>Nom et Prenom</th>
            <th>N° Carte</th>
            <th class="fs-6 w-25">Montant T</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php foreach ($compta as $m): ?>
            <?php
                  $nouveau = false;

                  if (!empty($m['date_adhesion'])) {
                      $dateAdh = strtotime($m['date_adhesion']);
                      $limite = strtotime('+30 days', $dateAdh);

                      if (time() <= $limite) {
                          $nouveau = true;
                      }
                  }
                  ?>
          <tr class="<?= $nouveau ? 'table-success' : '' ?>">
            <td><?= $m['CIN'] ?></td>
            <td><?= $m['nom'] .' ' .$m['prenom'] ?></td>

            <td><?= $m['numcart'] ?? '-' ?></td>
            <td><?= number_format($m['montant'],0,',',' ') ?> Ar</td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</>