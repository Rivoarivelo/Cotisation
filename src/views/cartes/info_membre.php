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

<body class="bg-light">
    <div class="py-2">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header bg-success text-center">
                        <h4 class="text-white">Carte Membre Valide</h4>
                    </div>

                    <div class="card-body text-center">

                        <?php
$photoPath = BASE_URL . "uploads/" . $membre['photo'];
?>

                        <img src="<?= $photoPath ?>" class="mb-3" width="200" height="200"
                            style="object-fit:cover; border:1px solid #070707;">

                        <ul class="list-group list-group-flush text-start mt-3">

                            <li class="list-group-item fs-4">
                                <strong>CIN :</strong>
                                <?= htmlspecialchars($membre['CIN']) ?>
                            </li>

                            <li class="list-group-item fs-4">
                                <strong>Nom :</strong>
                                <?= htmlspecialchars($membre['nom']) ?>
                            </li>

                            <li class="list-group-item fs-4">
                                <strong>Prénom :</strong>
                                <?= htmlspecialchars($membre['prenom']) ?>
                            </li>

                            <li class="list-group-item fs-4">
                                <strong>Numéro carte :</strong>
                                <?= htmlspecialchars($membre['numcart']) ?>
                            </li>
                            <li class="list-group-item fs-4">
                                <strong>Contact :</strong>
                                <?= htmlspecialchars($membre['contact']) ?>
                            </li>

                            <li class="list-group-item fs-4">
                                <strong>Profession :</strong>
                                <?= htmlspecialchars($membre['profession']) ?>
                            </li>

                            <li class="list-group-item fs-4">
                                <strong>E-mail :</strong>
                                <?= htmlspecialchars($membre['email']) ?>
                            </li>
                            <li class="list-group-item fs-4">
                                <strong>Region :</strong>
                                <?= htmlspecialchars($membre['lieutravail']) ?>
                            </li>

                            <li class="list-group-item fs-4">
                                <strong>Adresse :</strong>
                                <?= htmlspecialchars($membre['adressmembre']) ?>
                            </li>

                        </ul>

                        <a href="<?= BASE_URL ?>index.php?controller=carte&action=generer&cin=<?= urlencode($membre['CIN']) ?>"
                            class="btn btn-primary mt-3 w-100">Télécharger Carte PDF</a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>