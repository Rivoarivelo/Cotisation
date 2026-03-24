<!-- <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" /> -->
<title>Liste membre</title>

<body class="bg-dark vertical-layout vertical-menu-modern 2-columns navbar-floating footer-static" data-open="click"
  data-menu="vertical-menu-modern" data-col="2-columns">

  <div class="container mt-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <form method="GET" class="mb-3">
          <input type="hidden" name="controller" value="membre">

          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher par CIN, nom ou prénom"
              value="<?= $_GET['search'] ?? '' ?>">
            <button class="btn btn-dark">
              Rechercher
            </button>
          </div>
        </form>
        <h3 class="text-dark card-title text-center fw-bold">LISTE DES MEMBRES</h3>
        <div class=" card-title text-end d-flex justify-content-between align-items-end mb-3">


          <a href="index.php?controller=membre&action=add" class="btn btn-dark">
            Ajouter membre
          </a>

        </div>

        <table class="table table-bordered table-hover align-middle fs-6">
          <thead class="table-dark text-center">
            <tr class="align-middle">
              <th>Photo</th>
              <th>CIN</th>
              <th>Nom</th>
              <!-- <th>Prénom</th> -->
              <th>N° Carte</th>
              <th>Téléphone</th>
              <th>Email</th>
              <th>Actions</th>
              <th class="fs-6">Carte</th>
            </tr>
          </thead>

          <tbody class="text-center ">
            <?php foreach ($membres as $m): ?>
            <tr>

              <td>
                <?php
                     $photo = !empty($m['photo'])
                     ? "uploads/" . htmlspecialchars($m['photo'])
                     : "photos/user.png";?>

                 <img src="<?= $photo ?>" width="50" height="50" class="rounded-circle border">

              </td>

              <td><?= htmlspecialchars($m['CIN']) ?></td>
              <td><?= htmlspecialchars($m['nom'])." ".$m['prenom'] ?></td>

              <td><?= htmlspecialchars($m['numcart'] ?? '-') ?></td>
              <td><?= htmlspecialchars($m['contact']) ?></td>
              <td><?= htmlspecialchars($m['email']) ?></td>


              <td class="text-center d-flex row g-1 justify-content-center">
                <!-- ✏️ Modifier -->
                <a href="index.php?controller=membre&action=edit&cin=<?= $m['CIN'] ?>" class="btn btn-sm  btn-darken">
                  Modifier
                </a>
                <?php if ($_SESSION['user']['role'] == 'ADMIN') :?>
                <!-- 🗑️ Supprimer -->
                <a href="index.php?controller=membre&action=delete&cin=<?= $m['CIN'] ?>" class="btn btn-sm btn-danger"
                  onclick="return confirm('Supprimer ce membre ?')">
                  Supprimer
                </a>
              </td>
              <?php endif; ?>

              <td><a href="index.php?controller=carte&action=generer&cin=<?= $m['CIN'] ?>"
                  class="bg-blue-600 text-white btn btn-sm btn-darken px-2 py-1 rounded">
                  Pdf
                </a></td>
            </tr>
            <?php endforeach; ?>
          </tbody>

        </table>

      </div>
    </div>
  </div>
</body>


<?php require __DIR__ . '/../layout/footer.php'; ?>