<?php
require_once __DIR__ . '/../models/MembreModel.php';
require_once __DIR__ . '/../models/PointageModel.php';

class PointageController {

    // page interface
    public function index()
    {
        $view = __DIR__ . '/../views/pointage/index.php';
        require __DIR__ . '/../views/layout/dashboard.php';
    }

    // scan QR → enregistrement direct
    public function scan()
    {
        $cin = $_GET['cin'] ?? null;

        if(!$cin){
            echo json_encode(['error'=>'CIN manquant']);
            return;
        }

        $membre = MembreModel::getByCIN($cin);

        if(!$membre){
            echo json_encode(['error'=>'Membre introuvable']);
            return;
        }

        // 🔥 ENREGISTRER DIRECT
        PointageModel::enregistrer($membre);

        echo json_encode($membre);
    }

    // temps réel
    public function get()
    {
        header('Content-Type: application/json');
        echo json_encode(PointageModel::getALL());
    }
}