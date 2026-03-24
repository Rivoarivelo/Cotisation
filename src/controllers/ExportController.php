<?php
require_once __DIR__ . '/../config/database.php';

class ExportController
{
    public function csv()
    {
        $db = Database::compta();

        $sql = "
            SELECT
                'ADHESION' AS source,
                a.CIN,
                a.nom,
                a.prenom,
                a.profession,
                a.contact,
                a.email,
                NULL AS numcart,
                0 AS montant
            FROM sartmmg_site.adhesion a

            UNION ALL

            SELECT
                'COMPTA' AS source,
                m.CIN,
                m.nom,
                m.prenom,
                m.profession,
                m.contact,
                m.email,
                m.numcart,
                IFNULL(SUM(p.montant),0) AS montant
            FROM membre m
            LEFT JOIN payement p
                ON p.cinpaiement = m.CIN
            GROUP BY
                m.CIN,
                m.nom,
                m.prenom,
                m.profession,
                m.contact,
                m.email,
                m.numcart
        ";

        $data = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        // ✅ Forcer téléchargement Excel compatible
        header('Content-Type: text/csv; charset=UTF-16LE');
        header('Content-Disposition: attachment; filename=export_global.csv');

        $output = fopen('php://output', 'w');

        // ✅ BOM UTF-16LE (IMPORTANT pour Excel)
        fwrite($output, chr(0xFF) . chr(0xFE));

        // Fonction pour écrire en UTF-16LE
        $writeRow = function($row) use ($output) {
            $line = implode("\t", $row) . "\r\n";
            fwrite($output, mb_convert_encoding($line, 'UTF-16LE', 'UTF-8'));
        };

        // ✅ En-tête
        $writeRow([
            'SOURCE',
            'CIN',
            'Nom',
            'Prénom',
            'Profession',
            'Contact',
            'Email',
            'NumCarte',
            'Montant'
        ]);

        // ✅ Données
        foreach ($data as $row) {
            $writeRow($row);
        }

        fclose($output);
        exit;
    }
}