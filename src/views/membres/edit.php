<title>Modifier membre</title>

<body class="bg-dark vertical-layout vertical-menu-modern 2-columns navbar-floating footer-static" data-open="click"
  data-menu="vertical-menu-modern" data-col="2-columns">
  <div class="container mt-4">
    <div class="card-shadow shadow-lg">
      <div class="card shadow">
        <div class="card">
          <div class="card-body">
            <h3 class="text-dark card-title text-center fw-bold">Modifier membre</h3>
            <form method="POST" enctype="multipart/form-data"
              action="index.php?controller=membre&action=edit&cin=<?= $membre['CIN'] ?>">
              <!-- CIN (clé primaire) -->
              <input type="hidden" name="CIN" value="<?= $membre['CIN'] ?>">

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Nom</label>
                  <input type="text" name="nom" value="<?= $membre['nom'] ?>"
                    class="form-control border border-1 border-dark">
                </div>

                <div class="col-md-6 mb-3">
                  <label class="form-label">Prénom</label>
                  <input type="text" name="prenom" value="<?= $membre['prenom'] ?>"
                    class="form-control border border-1 border-dark">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Nom du père</label>
                <input type="text" name="nom_pere" value="<?= $membre['nom_pere'] ?>"
                  class="form-control border border-1 border-dark">
              </div>

              <div class="mb-3">
                <label class="form-label">Nom de la mère</label>
                <input type="text" name="nom_mere" value="<?= $membre['nom_mere'] ?>"
                  class="form-control border border-1 border-dark">
              </div>

              <div class="mb-3">
                <label class="form-label">Adresse</label>
                <input type="text" name="adressmembre" value="<?= $membre['adressmembre'] ?>"
                  class="form-control border border-1 border-dark">
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Contact</label>
                  <input type="text" name="contact" value="<?= $membre['contact'] ?>"
                    class="form-control border border-1 border-dark">
                </div>

                <div class="col-md-6 mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" value="<?= $membre['email'] ?>"
                    class="form-control border border-1 border-dark">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Profession</label>
                <input type="text" name="profession" value="<?= $membre['profession'] ?>"
                  class="form-control border border-1 border-dark">
              </div>

              <div class="mb-3">
                <label class="form-label">Nom entreprise</label>
                <input type="text" name="nom_entreprise" value="<?= $membre['nom_entreprise'] ?>"
                  class="form-contro border border-1 border-dark">
              </div>
              <div class="mb-3">
                <label class="form-label">Date d'adhésion</label>
                 <input type="date" name="date_adhesion" value="<?= $membre['date_adhesion'] ?>"
                   class="form-control border border-1 border-dark">
                </div>
              <div class="mb-3">
                <label class="form-label">Genre</label>
                <select name="genre" class="form-select border border-1 border-dark">
                  <option value="Homme" <?= $membre['genre']=='Homme'?'selected':'' ?>>Homme</option>
                  <option value="Femme" <?= $membre['genre']=='Femme'?'selected':'' ?>>Femme</option>
                  <option value="Autre" <?= $membre['genre']=='Autre'?'selected':'' ?>>Autre</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Changer la photo</label>
                <input type="file" name="photo" class="form-contro border border-1 border-dark" accept="image/*">

                <?php if (!empty($membre['photo'])): ?>
                <div class="mt-2">
                  <img src="uploads/<?= $membre['photo'] ?>" width="80" class="rounded border">
                </div>
                <?php endif; ?>
              </div>
              <div class="d-flex justify-content-between mt-4">
                <a href="index.php?controller=membre&action=index" class="btn btn-secondary">
                  Annuler
                </a>

                <button type="submit" class="btn btn-darken">
                  Enregistrer
                </button>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<script>
function generateCardNumber() {
  const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  let result = "";

  for (let i = 0; i < 8; i++)
    result += chars.charAt(Math.floor(Math.random() * chars.length));

  document.getElementById("numcart").value = result;
}
</script>