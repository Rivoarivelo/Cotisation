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
            // $membre['heure_scan']
        ]);
    }

    // HISTORIQUE
    public static function getHistorique($date = null, $titre = null)
    {
    $db = Database::compta();
    // Requête de base
    $sql = "SELECT * FROM fiche_presence WHERE 1=1";
    $params = [];

    if ($date) {
        $sql .= " AND date_event = ?";
        $params[] = $date;
    }

    if ($titre) {
        $sql .= " AND titre LIKE ?";
        $params[] = "%$titre%";
    }

    $sql .= " ORDER BY id DESC";

    $stmt = $db->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}