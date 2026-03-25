<title>Ajouter Responsable</title>

<body class="bg-dark">
  <!-- retour vers accueil -->

  <div class="container mt-4">
    <div class="card-shadow">
      <div class="card border border-1 border-darken">
        <div class="card-body">
          <div class="card-title text-center text-darken fs-3">AJOUTER RESPONSABLE</div>

          <form method="POST" class="d-flex flex-column gap-3">
            <input name="nom" class="form-control mb-2 fs-6 border border-1 border-darken" placeholder="Nom" required>
            <input name="prenom" class="form-control mb-2 fs-6 border border-1 border-darken" placeholder="Prénom"
              required>
            <input name="email" type="email" class="form-control mb-2 fs-6 border border-1 border-darken"
              placeholder="Email" required>
            <input name="password" type="password" class="form-control mb-2 fs-6 border border-1 border-darken"
              placeholder="Mot de passe" required>
            <input name="telephone" class="form-control mb-2 fs-6 border border-1 border-darken"
              placeholder="Téléphone">

            <select name="role" class="form-control mb-3 fs-6 border border-1 border-darken">
              <option value="RESPONSABLE">COMPTABLE</option>
              <option value="BUREAU">BUREAU</option>
              <option value="ADMIN">ADMIN</option>
            </select>

            <button class="btn btn-darken">Enregistrer</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
<?php require __DIR__ . '/../layout/footer.php'; ?>