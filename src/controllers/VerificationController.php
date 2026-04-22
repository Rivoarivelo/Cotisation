<?php
require_once __DIR__ . '/../models/MembreModel.php';
require_once __DIR__ . '/../models/PresenceModel.php';
require_once __DIR__ . '/../models/PresenceTempModel.php';
require_once __DIR__ . '/../models/PointageModel.php';
class VerificationController
{

    public function formulaire()
    {
        $cin = $_GET['cin'] ?? '';
        $numcart = $_GET['numcart'] ?? '';
        $code = $_GET['code'] ?? '';

        require __DIR__ . '/../views/cartes/formulaire_verif.php';
    }

public function verifier()
{
    require_once __DIR__ . '/../models/PresenceTempModel.php';
    require_once __DIR__ . '/../models/PointageModel.php';

    $cin = $_POST['cin'] ?? null;
    $numcart = $_POST['numcart'] ?? null;
    $code = $_POST['code'] ?? null;

    if (!$cin || !$numcart || !$code) {
        die("Veuillez remplir tous les champs");
    }

    $membre = MembreModel::verifyCarte($cin, $numcart, $code);

    // ✅ vérification obligatoire
    if (!$membre) {
        die("Carte invalide");
    }

    // 🔥 1. PRESENCE (inchangé)
    PresenceTempModel::ajouter([
        $membre['CIN'],
        $membre['nom'],
        $membre['prenom'],
        $membre['numcart']
    ]);

    // 🔥 2. POINTAGE (avec anti doublon)
    if(!PointageModel::dejaPointer($membre['CIN'])){
        PointageModel::enregistrer($membre);
    }

    $_SESSION['cin'] = $cin;

    require __DIR__ . '/../views/cartes/info_membre.php';
}
}