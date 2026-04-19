<?php
require_once __DIR__ . '/../config/database.php';

class PresenceTempModel
{

    public static function ajouter($data)
    {
        $db = Database::compta();

        $stmt = $db->prepare("
            INSERT INTO presence_temp (cin, nom, prenom, num_carte,date_event, heure_scan)
            VALUES (?, ?, ?, ?, CURRENT_DATE(), CURRENT_TIME())
        ");

        $stmt->execute($data);
    }

    public static function getEnAttente()
    {
        $db = Database::compta();

        return $db->query("
            SELECT * FROM presence_temp 
            WHERE statut = 'EN_ATTENTE'
            ORDER BY id DESC
        ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function valider($id)
    {
        $db = Database::compta();
        $stmt = $db->prepare("UPDATE presence_temp SET statut='VALIDE' WHERE id=?");
        $stmt->execute([$id]);
    }

    public static function rejeter($id)
    {
        $db = Database::compta();
        $stmt = $db->prepare("UPDATE presence_temp SET statut='REJETE' WHERE id=?");
        $stmt->execute([$id]);
    }

    // récupérer les validés
    public static function getValide()
    {
        $db = Database::compta();

        return $db->query("
        SELECT * FROM presence_temp 
        WHERE statut = 'VALIDE'
    ")->fetchAll(PDO::FETCH_ASSOC);
    }

    // vider la table temporaire
    public static function vider()
    {
        $db = Database::compta();
        $db->exec("DELETE FROM presence_temp");
    }
}