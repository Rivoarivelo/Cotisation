<?php
require_once __DIR__ . '/../config/database.php';

class AuthModel {

    // 🔐 Trouver responsable par email
    public static function findByEmail($email)
    {
        $db = Database::compta();

        $sql = "SELECT * FROM responsable WHERE mailresponsable = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔄 Modifier mot de passe (hashé)
    public static function updatePassword($idresponsable, $hash)
    {
        $db = Database::compta();

        $sql = "UPDATE responsable
                SET motsdepass = ?
                WHERE idresponsable = ?";

        $stmt = $db->prepare($sql);
        return $stmt->execute([$hash, $idresponsable]);
    }
}