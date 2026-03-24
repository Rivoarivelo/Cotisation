<!-- <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" /> -->

<script>
function generateCardNumber() {
  const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  let result = "";

  for (let i = 0; i < 8; i++)
    result += chars.charAt(Math.floor(Math.random() * chars.length));

  document.getElementById("numcart").value = result;
}
</script>
<title>Ajouter Membre</title>

<body class="bg-light vertical-layout vertical-menu-modern 2-columns navbar-floating footer-static" data-open="click"
  data-menu="vertical-menu-modern" data-col="2-columns">

  <div class="container mt-4">
    <div class="card-shadow  shadow-lg">
      <div class="card  border border-1 border-dark shadow-sm">
        <div class="card">
          <div class="card-body">
            <h3 class="text-dark card-title text-center fw-bold">Ajouter membre</h3>
            <form method="post" class="card border border-0 border-dark" enctype="multipart/form-data">



              <input class="form-control mb-2 border border-1 border-dark " name="CIN" placeholder="CIN" required>
              <input class="form-control mb-2 border border-1 border-dark " name="nom" placeholder="Nom">
              <input class="form-control mb-2 border border-1 border-dark" name="prenom" placeholder="Prénom">

              <label>Date naissance</label>
              <input type="date" class="form-control mb-2 border border-1 border-dark" name="date_naissance">

              <label>Date adhésion</label>
              <input type="date" class="form-control mb-2 border border-1 border-dark"  name="date_adhesion" value="<?= date('Y-m-d') ?>">
              <input class="form-control mb-2 border border-1 border-dark " name="profession" placeholder="Profession">
              <input class="form-control mb-2 border border-1 border-dark " name="lieutravail"
                placeholder="Lieu de Travail">

              <label>Date embauche</label>
              <input type="date" class="form-control mb-2 border border-1 border-dark" name="date_embauche">

              <input class="form-control mb-2 border border-1 border-dark" name="nom_entreprise"
                placeholder="Entreprise">
              <input class="form-control mb-2 border border-1 border-dark" name="adressmembre" placeholder="Adresse">
              <input class="form-control mb-2 border border-1 border-dark" name="contact" placeholder="Contact">
              <input class="form-control mb-2 border border-1 border-dark " name="email" placeholder="Email">
              <div class="mb-3">
                <label class="form-label fw-bold">Numéro Carte</label>

                <!-- <div class="input-group">
                  <input type="text" id="numcart" class="form-control border border-1 border-dark"
                    placeholder="Généré automatiquement" readonly>

                  <button type="button" class="btn btn-primary" onclick="generateCardNumber()">
                    Générer
                  </button>
                </div> -->
              </div>
              <input class="form-control mb-2 border border-1 border-dark" name="genre" placeholder="Genre">

              <label>Photo membre</label>
              <input type="file" name="photo" class="form-control">

              <button class="btn btn-success">Enregistrer</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<!-- ajouter index.php -->