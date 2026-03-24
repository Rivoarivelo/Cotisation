<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" />


  <!-- <link rel="stylesheet" type="text/css" href="../assets/css/theme.min.css" /> -->
</head>

<body class="bg-light">
  <style>
  .logo {
    width: 150px;
    height: auto;
  }
  </style>
  <hr>
  <a href="<?= BASE_URL ?>?controller=auth&action=visitor" class="btn btn-primary w-100">
    Mode Visiteur
  </a>
  <!-- a grandir container -->
  <div class="container-fluid mt-5 ">
    <div class="row justify-content-center">
      <div class="col-md-4">

        <div class="card shadow">
          <div class="card-header text-center fw-bold fw-light fs-5 bg-primary text-white">
            Connexion
          </div>

          <div class="card-body">
            <!-- ajouter logo -->
            <div class="text-center mb-4">
              <img src="photos/logo.jpg" alt="Logo" class="logo">
            </div>
            <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="post">
              <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
              </div>

              <div class="mb-3">
                <label>Mot de passe</label>
                <input type="password" name="motsdepass" class="form-control" required>
              </div>

              <button class="btn btn-primary w-100">
                Se connecter
              </button>
            </form>

          </div>
        </div>

      </div>
    </div>
  </div>

</body>

</html>