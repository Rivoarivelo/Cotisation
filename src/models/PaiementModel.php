<?php
require_once __DIR__ . '/../config/database.php';
class PaiementModel {

    // 🔹 Total des montants
    public static function total() {
        $db = Database::compta();
        $sql = "SELECT SUM(montant) AS total FROM payement";
        $result = $db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    // 🔹 Ajouter un paiement
    public static function insert($data) {
        $db = Database::compta();

        $sql = "INSERT INTO payement
            (type, datepaiement, duree, montant, status, cinpaiement, montant_recu)
            VALUES (?, CURDATE(), ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
        return $stmt->execute($data);
    }
//
    public static function getWithMembre() {
    $db = Database::compta();
    $sql = "SELECT p.*, m.nom, m.prenom, m.date_expiration
            FROM payement p
            JOIN membre m ON m.CIN = p.cinpaiement
            ORDER BY p.datepaiement DESC";
    return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

// 🔹 Récupérer un paiement avec les infos du membre
    public static function getOneWithMembre($id)
{
    $db = Database::compta();
    $stmt = $db->prepare("
        SELECT p.*, m.nom, m.prenom, m.numcart, m.date_expiration
        FROM payement p
        JOIN membre m ON m.CIN = p.cinpaiement
        WHERE p.numpayement = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public static function search($keyword)
{
    $db = Database::compta();

    $sql = "SELECT p.*, m.nom, m.prenom
            FROM payement p
            JOIN membre m ON m.CIN = p.cinpaiement
            WHERE
                m.CIN LIKE ?
                OR m.nom LIKE ?
                OR m.prenom LIKE ?
                OR p.type LIKE ?
                OR p.datepaiement LIKE ?
            ORDER BY p.datepaiement DESC";

    $key = "%$keyword%";
    $stmt = $db->prepare($sql);
    $stmt->execute([$key, $key, $key, $key, $key]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // 📊 Statistiques par date
public static function statsByDate()
{
    $db = Database::compta();

    $sql = "
        SELECT
            DATE(datepaiement) AS jour,
            SUM(montant) AS total
        FROM payement
        GROUP BY DATE(datepaiement)
        ORDER BY jour
    ";

    return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

// 🔢 Statistiques globales
public static function statsGlobal()
{
    $db = Database::compta();

    return $db->query("
        SELECT
            COUNT(*) AS total_paiements,
            SUM(montant) AS total_montant
        FROM payement
    ")->fetch(PDO::FETCH_ASSOC);
}

public static function statsByMonth($month, $year)
{
    $db = Database::compta();
    $stmt = $db->prepare("
        SELECT DATE(datepaiement) AS jour, SUM(montant) AS total
        FROM payement
        WHERE MONTH(datepaiement) = ?
          AND YEAR(datepaiement) = ?
        GROUP BY jour
        ORDER BY jour
    ");
    $stmt->execute([$month, $year]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public static function statsByType()
{
    $db = Database::compta();
    return $db->query("
        SELECT type, SUM(montant) AS total
        FROM payement
        GROUP BY type
    ")->fetchAll(PDO::FETCH_ASSOC);
}

    // 🔄 Mettre à jour la date d'expiration d'un membre
    public static function updateExpiration($cin, $duree)
{
    $db = Database::compta();

    // Récupérer membre
    $stmt = $db->prepare("SELECT date_expiration FROM membre WHERE CIN = ?");
    $stmt->execute([$cin]);
    $membre = $stmt->fetch(PDO::FETCH_ASSOC);

    $today = new DateTime();
    $expiration = $membre['date_expiration']
        ? new DateTime($membre['date_expiration'])
        : null;

    if (!$expiration) {
        // Aucun expiration existant
        $expiration = new DateTime();
        $expiration->modify("+$duree month");
    }
    else if ($expiration >= $today) {
        // Toujours actif
        $expiration->modify("+$duree month");
    }
    else {
        // Membre expiré
        $diff = $expiration->diff($today);
        $moisRetard = ($diff->y * 12) + $diff->m;

        if ($duree > $moisRetard) {
            $reste = $duree - $moisRetard;
            $expiration = new DateTime();
            $expiration->modify("+$reste month");
        } else {
            // Toujours expiré
            return;
        }
    }

    // Mise à jour
    $stmt = $db->prepare("UPDATE membre SET date_expiration = ? WHERE CIN = ?");
    $stmt->execute([$expiration->format('Y-m-d'), $cin]);
}

public static function evolutionMensuelle()
{
    $db = Database::compta();

    $sql = "
        SELECT
            DATE_FORMAT(datepaiement,'%Y-%m') AS mois,
            SUM(montant) AS total
        FROM payement
        GROUP BY mois
        ORDER BY mois ASC
    ";

    return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
}