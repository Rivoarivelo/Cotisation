<?php
require_once __DIR__ . '/../models/MembreModel.php';
require_once __DIR__ . '/../models/PresenceModel.php';

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


        $cin = $_POST['cin'] ?? null;
        $numcart = $_POST['numcart'] ?? null;
        $code = $_POST['code'] ?? null;

        if (!$cin || !$numcart || !$code) {
            die("Veuillez remplir tous les champs");
        }

        $membre = MembreModel::verifyCarte($cin, $numcart, $code);

        // après vérification OK
        PresenceTempModel::ajouter([
            $membre['CIN'],
            $membre['nom'],
            $membre['prenom'],
            $membre['numcart']
        ]);

        if (!$membre) {
            die("Carte invalide");
        }

        // ✅ ENREGISTRER PRESENCE
        // PresenceModel::enregistrer(
        //     $membre,
        //     "Scan QR", // titre
        //     date('Y-m-d') // date_event
        // );

        $_SESSION['cin'] = $cin;

        require __DIR__ . '/../views/cartes/info_membre.php';
    }
}