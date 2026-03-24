
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Membres</title>
    <style>
        /* Styles CSS */
        body { font-family: Arial, sans-serif; max-width: 1200px; margin: auto; padding: 20px;}
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="date"], input[type="email"], input[type="file"] {
            width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc;
        }
        button[type="submit"] { padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer; }
        .message.success { color: green; border: 1px solid green; padding: 10px; background-color: #e6ffe6; margin-bottom: 20px; }
        .message.error { color: red; border: 1px solid red; padding: 10px; background-color: #ffe6e6; margin-bottom: 20px; }

        /* Styles du Tableau */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn-modifier { background-color: #ffc107; color: black; text-decoration: none; padding: 5px 10px; border-radius: 3px; display: inline-block;}
        .btn-supprimer { background-color: #dc3545; color: white; text-decoration: none; padding: 5px 10px; border-radius: 3px; display: inline-block;}
        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;}
    </style>
</head>
<body>
<a href="AccueilDashboard.php" class="back-button">
    &larr; Retour au Tableau de Bord
</a>

    <h1>Gestion des Membres</h1>

    <hr>

    <h2>Ajouter un Nouveau Membre</h2>
    <form action="" method="post" enctype="multipart/form-data">

        <h3>Informations d'identité</h3>

        <div class="form-group">
            <label for="cin">CIN (Identifiant National) : <span style="color:red;">*</span></label>
            <input type="text" name="CIN" id="cin" value="" required>
        </div>

        <div class="form-group">
            <label for="nom">Nom : <span style="color:red;">*</span></label>
            <input type="text" name="nom" id="nom" value="" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom : <span style="color:red;">*</span></label>
            <input type="text" name="prenom" id="prenom" value="" required>
        </div>

        <div class="form-group">
            <label for="date_naissance">Date de Naissance :</label>
            <input type="date" name="datenaissance" id="datenaissance" value="">
        </div>

        <div class="form-group">
            <label for="lieu_naissance">Lieu de Naissance :</label>
            <input type="text" name="lieunaissance" id="lieunaissance" value="">
        </div>

        <h3>Informations Parentales</h3>

        <div class="form-group">
            <label for="nom_pere">Nom du Père :</label>
            <input type="text" name="nompere" id="nompere" value="">
        </div>
        <div class="form-group">
            <label for="nom_mere">Nom de la Mère :</label>
            <input type="text" name="nom_mere" id="nom_mere" value="">
        </div>

        <h3>Informations CIN et Carte</h3>

        <div class="form-group">
            <label for="datecreationcin">Date de création CIN :</label>
            <input type="date" name="date_cin" id="date_cin" value="">
        </div>
        <div class="form-group">
            <label for="lieu_cin">Lieu de Délivrance CIN :</label>
            <input type="text" name="lieu_cin" id="lieu_cin" value="">
        </div>

        <div class="form-group">
            <label for="numcart">Numéro de Carte (Unique) :</label>
            <input type="text" name="numcart" id="numcart" value="">
        </div>

        <h3>Profession et Contact</h3>

        <div class="form-group">
            <label for="profession">Profession /Lieu de Travail:</label>
            <input type="text" name="profession" id="profession" value="">
        </div>
        <div class="form-group">
            <label for="lieutravail">region :</label>
            <input type="text" name="lieutravail" id="lieutravail" value="">
        </div>
        <div class="form-group">
            <label for="datedebtravail">Date Début Travail :</label>
            <input type="date" name="datedebtravail" id="datedebtravail" value="">
        </div>

        <div class="form-group">
            <label for="adressmembre">Adresse :</label>
            <input type="text" name="adressmembre" id="adressmembre" value="">
        </div>
        <div class="form-group">
            <label for="contact">Téléphone :</label>
            <input type="text" name="contact" id="contact" value="">
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="">
        </div>

        <div class="form-group">
            <label for="photo">Photo du Membre :</label>
            <input type="file" name="photo" id="photo" accept="image/*">
        </div>

        <button type="submit">Ajouter le Membre</button>
    </form>

    <hr>
    <h2>Liste des Membres</h2>
    <table>
        <thead>
            <tr>
                <th>CIN</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de Naissance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <!-- afficher les données base de donnée dans le model MembreModel et SyncController -->

</body>
</html>