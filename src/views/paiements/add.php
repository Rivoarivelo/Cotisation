<title>Ajouter paiement</title>
<?php if (!empty($_SESSION['error'])): ?>
<div class="alert alert-danger">
    <?= $_SESSION['error'] ?>
</div>
<?php unset($_SESSION['error']); ?>
<?php endif; ?>

<body class="bg-dark vertical-layout vertical-menu-modern 2-columns navbar-floating footer-static" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    <div class="container mt-4">
        <div class="card-shadow shadow-lg">
            <div class="card shadow">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-dark card-title text-center fw-bold">AJOUTER PAIEMENTS</h3>
                        <form method="post" class="card p-3 border border-1 border-dark mb-4">
                            <!-- MEMBRE -->
                            <div class="mb-3">
                                <label class="form-label text-white">Membre concerné (CIN)</label>
                                <select name="cinpaiement" class="form-select border border-1 border-dark" required>
                                    <option value="">-- Choisir un membre --</option>
                                    <?php foreach ($membres as $m): ?>
                                    <option value="<?= $m['CIN'] ?>">
                                        <?= $m['nom'] . ' ' . $m['prenom'] ?> (<?= $m['CIN'] ?>)
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- TYPE -->
                            <div class="mb-3">
                                <label class="form-label">Type de paiement</label>
                                <!-- <input type="text" name="type" class="form-control"> -->
                                <select name="type" class="form-select border border-1 border-dark">
                                    <option>cotisation</option>
                                    <option>Bénévole</option>
                                    <option>Don</option>
                                    <option>Commision</option>
                                    <option>Subvention</option>
                                </select>
                            </div>

                            <!-- DATE PAIEMENTS -->
                            <div class="mb-3">
                                <label class="form-label">Date de paiement</label>
                                <input type="date" name="datepaiement" class="form-control border border-1 border-dark"
                                    required>
                            </div>

                            <!-- MONTANT -->
                            <div class="mb-3">
                                <label class="form-label">Montant</label>
                                <input type="number" name="montant" id="montant"
                                    class="form-control border border-1 border-dark" required>
                                <small id="montantHelp" class="text-danger d-none">
                                    ❌ Montant indisponible (1000 = 1 mois, 2000 = 2 mois, 3000 = 3 mois, ...)
                                </small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Durée (mois)</label>
                                <input type="number" id="dureeAffichee" class="form-control border border-1 border-dark"
                                    readonly>
                                <input type="hidden" name="duree" id="dureeAuto">
                            </div>

                            <input type="hidden" name="duree" id="dureeAuto">

                            <!-- MONTANT REÇU -->
                            <div class="mb-3">
                                <label class="form-label">Montant reçu</label>
                                <input type="number" step="0.01" name="montant_recu"
                                    class="form-control border border-1 border-dark">
                            </div>

                            <!-- STATUS -->
                            <div class="mb-3">
                                <label class="form-label">Statut</label>
                                <select name="status" class="form-select border border-1 border-dark">
                                    <option value="payé">Payé</option>
                                    <option value="partiel">Partiel</option>
                                    <option value="non payé">Non payé</option>
                                </select>
                            </div>

                            <select name="responsable" class="form-select border border-1 border-dark" required>
                                <option value="">-- Choisir --</option>
                                <?php foreach ($responsables as $r): ?>
                                <option value="<?= $r['idresponsable'] ?>">
                                    <?= $r['nomresponsable'] ." ". $r['prenomresponsable'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <button class="btn btn-darken">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<script>
const montantInput = document.getElementById('montant');
const dureeAffichee = document.getElementById('dureeAffichee');
const dureeAuto = document.getElementById('dureeAuto');
const helpText = document.getElementById('montantHelp');

montantInput.addEventListener('input', () => {
    const montant = parseInt(montantInput.value);

    if (montant >= 1000 && montant % 1000 === 0) {
        const duree = montant / 1000;
        dureeAffichee.value = duree;
        dureeAuto.value = duree;
        helpText.classList.add('d-none');
    } else {
        dureeAffichee.value = '';
        dureeAuto.value = '';
        helpText.classList.remove('d-none');
    }
});
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>