<?php

require_once __DIR__ . '/../config/database.php';

class CotisationApiController {

    public function list(){

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Content-Type: application/json");


        $db = Database::compta();

        $cin = $_GET['cin'];

        $sql = "SELECT montant, datepaiement
                FROM payement
                WHERE cinpaiement = ?
                ORDER BY datepaiement DESC";

        $stmt = $db->prepare($sql);
        $stmt->execute([$cin]);

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);

    }
}