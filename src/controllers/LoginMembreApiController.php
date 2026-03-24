<?php

require_once __DIR__ . '/../config/database.php';

class LoginMembreApiController
{

    public function login()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        header("Content-Type: application/json; charset=UTF-8");

        $db = Database::compta();

        $cin = $_POST['cin'] ?? '';
        $numcart = $_POST['numcart'] ?? '';

        if (empty($cin) || empty($numcart)) {
            echo json_encode([
                "status" => "error",
                "message" => "CIN ou numéro carte manquant"
            ]);
            exit;
        }

        $sql = "SELECT CIN, nom, prenom, numcart
                FROM membre
                WHERE CIN = ? AND numcart = ?";

        $stmt = $db->prepare($sql);
        $stmt->execute([$cin, $numcart]);

        $membre = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($membre) {

            echo json_encode([
                "status" => "success",
                "message" => "Connexion réussie",
                "data" => $membre
            ]);

        } else {

            echo json_encode([
                "status" => "error",
                "message" => "CIN ou numéro carte incorrect"
            ]);

        }

        exit;
    }

}