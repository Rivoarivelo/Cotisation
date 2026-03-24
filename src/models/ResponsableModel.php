<?php
require_once __DIR__ . '/../config/database.php';

class ResponsableModel
{
    // fonction de recherche d'un responsable par son email
    public static function findByEmail($email)
    {
        $db = Database::compta();

        $sql = "SELECT * FROM responsable WHERE mailresponsable = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     public static function countResponsable()
    {
        $db = Database::compta();
        return $db->query("SELECT COUNT(*) FROM responsable")->fetchColumn();
    }
    // fonction de récupération de tous les responsables
    public static function getAll() {
        $db = Database::compta();
        return $db->query("SELECT * FROM responsable ORDER BY idresponsable DESC")
                  ->fetchAll(PDO::FETCH_ASSOC);
    }

    // fonction de recherche d'un responsable par son id
    public static function find($id) {
        $db = Database::compta();
        $stmt = $db->prepare("SELECT * FROM responsable WHERE idresponsable = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // fonction d'insertion d'un responsable dans la base de données
    public static function insert($data) {
        $db = Database::compta();
        $sql = "INSERT INTO responsable
                (nomresponsable, prenomresponsable, mailresponsable, motsdepass, telephoneresponsable, role)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        return $stmt->execute($data);
    }

    public static function update($id, $data) {
        $db = Database::compta();
        $sql = "UPDATE responsable
                SET nomresponsable = ?, prenomresponsable = ?, mailresponsable = ?, telephoneresponsable = ?, role = ?
                WHERE idresponsable = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([...$data, $id]);
    }

    public static function delete($id) {
        $db = Database::compta();
        $stmt = $db->prepare("DELETE FROM responsable WHERE idresponsable = ?");
        return $stmt->execute([$id]);
    }
}