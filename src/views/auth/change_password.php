<div class="container mt-4">
  <div class="card">
    <div class="card card-title text-center fw-bold ">Changer le mot de passe</div>
    <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
    <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-2">
        <input type="password" name="ancien_motdepasse" class="form-control" placeholder="Ancien mot de passe" required>
      </div>

      <div class="mb-3">
        <input type="password" name="nouveau_motdepasse" class="form-control" placeholder="Nouveau mot de passe"
          required>
      </div>

      <button class="btn btn-primary">
        Modifier
      </button>
    </form>
  </div>
</div>