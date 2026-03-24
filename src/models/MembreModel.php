<?php
require_once __DIR__ . '/../config/database.php';

class MembreModel {

    public static function getAll() {
        $db = Database::compta();
        $sql = "SELECT * FROM membre";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

        public static function insert($data)
    {
        $db = Database::compta();

        $sql = "INSERT INTO membre
            (cin, nom, prenom, nom_entreprise, contact,email,
            date_naissance, genre,date_adhesion,
            profession, lieutravail,
            date_embauche, adressmembre, photo)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
        $stmt->execute($data);
    }

     public static function count()
    {
        $db = Database::compta();
        return $db->query("SELECT COUNT(*) FROM membre")->fetchColumn();
    }
        public static function getForSelect() {
        $db = Database::compta();
        $sql = "SELECT CIN, nom, prenom FROM membre ORDER BY nom";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getByCIN($cin)
    {
        $db = Database::compta();
        $stmt = $db->prepare("SELECT * FROM membre WHERE CIN = ?");
        $stmt->execute([$cin]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($cin, $data)
    {
        $db = Database::compta();

        $sql = "UPDATE membre SET
                nom = ?, prenom = ?, nom_entreprise = ?, contact = ?, email = ? ,profession = ?, adressmembre = ?,photo = ?, genre = ?, date_adhesion =?
                WHERE CIN = ?";

        $stmt = $db->prepare($sql);
        $data[] = $cin;
        return $stmt->execute($data);
    }

    public static function delete($cin)
    {
        $db = Database::compta();
        $stmt = $db->prepare("DELETE FROM membre WHERE CIN = ?");
        return $stmt->execute([$cin]);
    }

    public static function search($keyword)
    {
        $db = Database::compta();

        $sql = "SELECT * FROM membre
                WHERE CIN LIKE ?
                OR nom LIKE ?
                OR prenom LIKE ?
                ORDER BY nom";

        $key = "%$keyword%";
        $stmt = $db->prepare($sql);
        $stmt->execute([$key, $key, $key]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Génère un numéro de carte aléatoire
    public static function generateNumeroCarte($length = 8)
    {
        $db = Database::compta();

        do {
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $num = '';

            for ($i = 0; $i < $length; $i++) {
                $num .= $chars[random_int(0, strlen($chars) - 1)];
            }

            // vérifier unicité
            $stmt = $db->prepare("SELECT COUNT(*) FROM membre WHERE numcart = ?");
            $stmt->execute([$num]);

        } while ($stmt->fetchColumn() > 0);

        return $num;
    }

    public static function generateCarteIfNotExists($cin)
    {
            $db = Database::compta();

            // vérifier si carte existe déjà
            $stmt = $db->prepare("SELECT numcart FROM membre WHERE CIN = ?");
            $stmt->execute([$cin]);
            $membre = $stmt->fetch(PDO::FETCH_ASSOC);
            // si carte déjà existante → STOP
            if (!empty($membre['numcart'])) {
                return $membre['numcart'];
            }
            // sinon générer
            $numcart = self::generateNumeroCarte();
            self::updateNumCarte($cin, $numcart);
            return $numcart;
    }

    // Met à jour le numéro de carte d'un membre
    public static function updateNumCarte($cin, $numcart)
    {
        $db = Database::compta();
        $stmt = $db->prepare("UPDATE membre SET numcart = ? WHERE CIN = ?");
        return $stmt->execute([$numcart, $cin]);
    }

        // 📊 Statistique utilisateurs par secteur (profession)
    public static function statsByProfession()
    {
        $db = Database::compta();
        return $db->query("
            SELECT profession, COUNT(*) AS total
            FROM membre
            WHERE profession IS NOT NULL AND profession != ''
            GROUP BY profession
            ORDER BY total DESC
        ")->fetchAll(PDO::FETCH_ASSOC);
    }

    // 📊 Statistique utilisateurs par région (lieu de travail)
    public static function statsByRegion()
    {
        $db = Database::compta();
        return $db->query("
            SELECT lieutravail, COUNT(*) AS total
            FROM membre
            WHERE lieutravail IS NOT NULL AND lieutravail != ''
            GROUP BY lieutravail
            ORDER BY total DESC
        ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function regionsPlusActives()
    {
    $db = Database::compta();

    return $db->query("
        SELECT
            m.lieutravail AS region,
            COUNT(DISTINCT m.CIN) AS total_membres,
            COUNT(p.numpayement) AS total_paiements,
            IFNULL(SUM(p.montant),0) AS total_montant
        FROM membre m
        LEFT JOIN payement p ON p.cinpaiement = m.CIN
        WHERE m.lieutravail IS NOT NULL
        AND m.lieutravail != ''
        GROUP BY m.lieutravail
        ORDER BY total_montant DESC
    ")->fetchAll(PDO::FETCH_ASSOC);
    }

    // stat par Genre les baby e

    public static function statsByGenre() {
        $db = Database::compta();
        $sql = "SELECT genre, COUNT(*) AS total
                FROM membre
                GROUP BY genre";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByCarte($numCarte)
{
    $db = Database::compta();

    $stmt = $db->prepare("
        SELECT * FROM membre
        WHERE numcart = ?
    ");

    $stmt->execute([$numCarte]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public static function verifyCarte($cin,$numcart,$code)
{
    $db = Database::compta();

    $stmt = $db->prepare("
        SELECT * FROM membre
        WHERE CIN = ?
        AND numcart = ?
        AND code_secret = ?
    ");

    $stmt->execute([$cin,$numcart,$code]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}