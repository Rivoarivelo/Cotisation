<?php
require_once __DIR__ . '/../models/MembreModel.php';
require_once __DIR__ . '/../models/PresenceModel.php';

class VerificationController {

    public function formulaire()
    {
        $cin = $_GET['cin'] ?? '';
        $numcart = $_GET['numcart'] ?? '';
        $code = $_GET['code'] ?? '';

        require __DIR__.'/../views/cartes/formulaire_verif.php';
    }

    public function verifier()
    {
        $cin = $_POST['cin'] ?? null;
        $numcart = $_POST['numcart'] ?? null;
        $code = $_POST['code'] ?? null;

        if(!$cin || !$numcart || !$code){
            die("Veuillez remplir tous les champs");
        }

        $membre = MembreModel::verifyCarte($cin,$numcart,$code);

        if(!$membre){
            die("Carte invalide");
        }

        // ✅ ENREGISTRER PRESENCE
        PresenceModel::enregistrer($membre);

        $_SESSION['cin'] = $cin;

        require __DIR__.'/../views/cartes/info_membre.php';
    }
}