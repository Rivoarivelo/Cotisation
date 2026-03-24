<?php
require_once __DIR__ . '/../config/database.php';

class CarteModel {
    public static function log($cin, $numCarte)
    {
        $db = Database::compta();
        $stmt = $db->prepare("
            INSERT INTO carte_historique (cin, num_carte)
            VALUES (?, ?)
        ");
        $stmt->execute([$cin, $numCarte]);
    }
}