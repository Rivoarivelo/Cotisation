<?php
require_once __DIR__ . '/../config/database.php';

class PresenceModel
{

    public static function enregistrer($membre, $titre, $date_event)
    {
        $db = Database::compta();

        $stmt = $db->prepare("
        INSERT INTO fiche_presence
        (cin, num_carte, nom, prenom, titre, date_event, date_presence, heure_presence)
        VALUES (?, ?, ?, ?, ?, ?, CURDATE(), CURTIME())
    ");

        $stmt->execute([
            $membre['CIN'],
            $membre['numcart'],
            $membre['nom'],
            $membre['prenom'],
            $titre,
            $date_event
        ]);
    }
}