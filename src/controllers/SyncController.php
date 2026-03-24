<?php
require_once __DIR__ . '/../models/SyncMembreModel.php';
require_once __DIR__ . '/../helpers/auth.php';

checkWriteAccess();
class SyncController {

    public function index()
    {
        $adhesions = SyncMembreModel::allAdhesion();
        $compta = SyncMembreModel::allCompta();
        // require __DIR__ . '/../views/sync/index.php';
        $view = __DIR__ . '/../views/sync/index.php';
        require __DIR__ . '/../views/layout/dashboard.php';
    }

    public function syncOne()
    {
        $cin = $_GET['cin'];
        SyncMembreModel::syncOne($cin);

        header("Location: index.php?controller=sync");
        exit;
    }
    public function syncAll()
{
    SyncMembreModel::sync();

    header("Location: index.php?controller=sync");
    exit;
}
}