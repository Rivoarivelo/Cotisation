<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" />
<!--! END: Bootstrap CSS-->
<!--! BEGIN: Vendors CSS-->
<link rel="stylesheet" type="text/css" href="../assets/vendors/css/vendors.min.css" />
<link rel="stylesheet" type="text/css" href="../assets/vendors/css/daterangepicker.min.css" />

<link rel="stylesheet" type="text/css" href="../assets/css/theme.min.css" />
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Vérification Carte Membre</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= BASE_URL ?>index.php?controller=verification&action=verifier">

                        <div class="mb-3">
                            <label for="cin" class="form-label">CIN</label>
                            <input type="text" class="form-control" id="cin" name="cin" value="<?= htmlspecialchars($cin) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="numcart" class="form-label">Numéro de carte</label>
                            <input type="text" class="form-control" id="numcart" name="numcart" value="<?= htmlspecialchars($numcart) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="code" class="form-label">Code secret</label>
                            <input type="text" class="form-control" id="code" name="code" value="<?= htmlspecialchars($code) ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Valider</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle (optionnel pour composants interactifs) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>