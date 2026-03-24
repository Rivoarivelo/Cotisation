<?php
require_once __DIR__ . '/../config/Database.php';

class ActiviteModel {

    public static function recent()
    {
        $db = Database::compta();

        $sql = "
            SELECT datepaiement AS date,
                   'Paiement reçu' AS action,
                   montant AS montant
            FROM payement

            UNION ALL

            SELECT datesortie AS date,
                   'Sortie de fond' AS action,
                   montantsortie AS montant
            FROM sortiefond

            ORDER BY date DESC
            LIMIT 10
        ";

        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}