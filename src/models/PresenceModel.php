<?php
require_once __DIR__ . '/../config/database.php';

class PresenceModel {

   public static function enregistrer($membre)
{
    $db = Database::compta();

    // Vérifier si déjà présent aujourd'hui
    $check = $db->prepare("
        SELECT id FROM fiche_presence
        WHERE cin = ?
        AND DATE(date_presence) = CURDATE()
    ");

    $check->execute([$membre['CIN']]);

    if($check->fetch()){
        return; // déjà enregistré aujourd'hui
    }

    $stmt = $db->prepare("
        INSERT INTO fiche_presence
        (cin, num_carte, nom, prenom, date_presence, heure_presence)
        VALUES (?, ?, ?, ?, CURDATE(), CURTIME())
    ");

    $stmt->execute([
        $membre['CIN'],
        $membre['numcart'],
        $membre['nom'],
        $membre['prenom']
    ]);
}
public static function getAll()
{
    $db = Database::compta();

    $stmt = $db->query("
        SELECT * FROM fiche_presence
        ORDER BY date_presence DESC, heure_presence DESC
    ");

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}