<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../vendor/fpdf/fpdf.php';
require_once __DIR__ . '/../models/MembreModel.php';
require_once __DIR__ . '/../models/CarteModel.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

class CarteController
{

    public function generer()
    {
        $cin = $_GET['cin'] ?? null;

        if (!$cin) {
            die("CIN manquant");
        }

        $membre = MembreModel::getByCIN($cin);

        if (!$membre) {
            die("Membre introuvable");
        }

        /* =========================
        CREATION QR CODE
        ========================== */

        //         $url = BASE_URL .
// "index.php?controller=verification&action=formulaire"
// ."&cin=".urlencode($membre['CIN'])
// ."&numcart=".urlencode($membre['numcart'])
// ."&code=".urlencode($membre['code_secret']);


        // $url = "http://192.168.137.113/cotisation/public/index.php?controller=verification&action=formulaire"
        //     . "&cin=" . $membre['CIN']
        //     . "&numcart=" . urlencode($membre['numcart'])
        //     . "&code=" . $membre['code_secret'];

        $url = "http://192.168.137.235/cotisation/public/index.php?controller=pointage&action=scan&cin=" 
     . $membre['CIN'];

        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($url)
            ->size(200)
            ->margin(5)
            ->build();

        $qrDir = __DIR__ . '/../../public/qrcodes';

        if (!file_exists($qrDir)) {
            mkdir($qrDir, 0777, true);
        }

        $qrFile = $qrDir . '/' . $membre['CIN'] . '.png';

        $result->saveToFile($qrFile);

        /* =========================
        CREATION PDF
        ========================== */

        $pdf = new FPDF('L', 'mm', [86, 54]);
        $pdf->SetAutoPageBreak(false);

        /* RECTO */

        $pdf->AddPage();
        require __DIR__ . '/../views/cartes/template_recto.php';

        /* VERSO */

        $pdf->AddPage();
        require __DIR__ . '/../views/cartes/template_verso.php';

        CarteModel::log($membre['CIN'], $membre['numcart']);

        $pdf->Output('I', 'carte_' . $membre['CIN'] . '.pdf');
        exit;
    }

}