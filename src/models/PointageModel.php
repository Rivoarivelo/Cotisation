<?php
require_once __DIR__ . '/../config/database.php';

class PointageModel {

    public static function enregistrer($membre)
    {
        $db = Database::compta();

        $stmt = $db->prepare("
            INSERT INTO pointage 
            (cin, nom, prenom, date_pointage, heure_pointage)
            VALUES (?, ?, ?, CURDATE(), CURTIME())
        ");

        $stmt->execute([
            $membre['CIN'],
            $membre['nom'],
            $membre['prenom']
        ]);
    }

    public static function getAll()
    {
        $db = Database::compta();

        return $db->query("
            SELECT * FROM pointage 
            ORDER BY id DESC
        ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getToday()
    {
        $db = Database::compta();

        return $db->query("
            SELECT * FROM pointage 
            WHERE date_pointage = CURDATE()
            ORDER BY id DESC
        ")->fetchAll(PDO::FETCH_ASSOC);
    }
}