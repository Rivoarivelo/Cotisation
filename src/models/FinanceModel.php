<?php
require_once __DIR__ . '/../config/Database.php';

class FinanceModel {

    // 💰 Total Entrées (paiements)
    public static function totalEntree()
    {
        $db = Database::compta();

        $sql = "SELECT COALESCE(SUM(montant),0) AS total
                FROM payement";

        return $db->query($sql)->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // 💸 Total Sorties
    public static function totalSortie()
    {
        $db = Database::compta();

        $sql = "SELECT COALESCE(SUM(montantsortie),0) AS total
                FROM sortiefond";

        return $db->query($sql)->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // 🧮 SOLDE RESTANT
    public static function solde()
    {
        return self::totalEntree() - self::totalSortie();
    }
}