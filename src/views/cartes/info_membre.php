<?php
if(!isset($_SESSION['cin'])){
    die("Accès interdit");
}
?>

<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" />
<!--! END: Bootstrap CSS-->
<!--! BEGIN: Vendors CSS-->
<link rel="stylesheet" type="text/css" href="../assets/vendors/css/vendors.min.css" />
<link rel="stylesheet" type="text/css" href="../assets/vendors/css/daterangepicker.min.css" />

<link rel="stylesheet" type="text/css" href="../assets/css/theme.min.css" />
<div class="alert alert-success text-center">
    Présence enregistrée avec succès ✅
</div>

<body class="bg-light">

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="card shadow">

                    <div class="card-header bg-success text-white text-center">
                        <h4>Carte Membre Valide</h4>
                    </div>

                    <div class="card-body text-center">

                        <?php
$photoPath = BASE_URL . "uploads/" . $membre['photo'];
?>

                        <img src="<?= $photoPath ?>" class="rounded-circle mb-3" width="120" height="120"
                            style="object-fit:cover; border:3px solid #198754;">

                        <ul class="list-group list-group-flush text-start mt-3">

                            <li class="list-group-item">
                                <strong>CIN :</strong>
                                <?= htmlspecialchars($membre['CIN']) ?>
                            </li>

                            <li class="list-group-item">
                                <strong>Nom :</strong>
                                <?= htmlspecialchars($membre['nom']) ?>
                            </li>

                            <li class="list-group-item">
                                <strong>Prénom :</strong>
                                <?= htmlspecialchars($membre['prenom']) ?>
                            </li>

                            <li class="list-group-item">
                                <strong>Numéro carte :</strong>
                                <?= htmlspecialchars($membre['numcart']) ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Contact :</strong>
                                <?= htmlspecialchars($membre['contact']) ?>
                            </li>

                            <li class="list-group-item">
                                <strong>Profession :</strong>
                                <?= htmlspecialchars($membre['profession']) ?>
                            </li>

                        </ul>

                        <a href="<?= BASE_URL ?>index.php?controller=carte&action=generer&cin=<?= urlencode($membre['CIN']) ?>" class="btn btn-primary mt-3 w-100">Télécharger Carte PDF</a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>