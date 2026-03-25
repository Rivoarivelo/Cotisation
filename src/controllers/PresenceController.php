<?php
require_once __DIR__ . '/../models/MembreModel.php';
require_once __DIR__ . '/../models/PresenceModel.php';

class PresenceController {

    public function index()
    {
        $presences = PresenceModel::getAll();
        require __DIR__ . '/../views/presence/index.php';
    }

    

    public function scan()
    {
        $numCarte = $_GET['numcarte'] ?? $_POST['numcarte'] ?? null;
        $message = null;
    
        if ($numCarte) {
    
            $membre = MembreModel::getByCarte($numCarte);
    
            if ($membre) {
    
                PresenceModel::enregistrer($membre);
    
                $message = "Présence enregistrée : "
                         . $membre['nom']." ".$membre['prenom'];
            } else {
    
                $message = "Carte inconnue";
            }
        }
        $presences = PresenceModel::getAll();
        
        

        require __DIR__ . '/../views/presence/index.php';
    }
}