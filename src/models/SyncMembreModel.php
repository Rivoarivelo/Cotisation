<?php
require_once __DIR__ . '/../config/database.php';

class SyncMembreModel {

    // Synchronise les membres de la BD1 vers la BD2
    public static function sync() {
        $db = Database::compta();
        // On insère les membres de la BD1 (sartmmg_site.adhesion) dans la BD2 (membre)
        $sql = "
        INSERT INTO membre
        (CIN, nom, prenom, date_cin, lieu_cin,
         date_naissance, lieu_naissance,
         nom_pere, nom_mere,
         profession, date_embauche,
         adressmembre, contact, email,
         nom_entreprise, photo, photoCIN, regionId, genre)

        SELECT
            a.CIN, a.nom, a.prenom, a.date_cin, a.lieu_cin,
            a.date_naissance, a.lieu_naissance,
            a.nom_pere, a.nom_mere,
            a.profession, a.date_embauche,
            a.residence, a.contact, a.email,
            a.nom_entreprise, a.photo, a.photoCIN, a.regionId, a.genre
        FROM sartmmg_site.adhesion a
        WHERE NOT EXISTS (
            SELECT 1 FROM membre m WHERE m.CIN = a.CIN
        )";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        // On retourne le nombre de membres insérés
        return $stmt->rowCount();
    }

       public static function all()
       {
        $db = Database::compta();

        $sql = "
            SELECT
                m.*,
                IFNULL(SUM(p.montant), 0) AS montant
            FROM membre m
            LEFT JOIN payement p
                ON p.cinpaiement = m.CIN
            GROUP BY m.CIN
            ORDER BY m.nom
        ";

        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function allAdhesion()
        {
            $db = Database::compta();
        
            $sql = "
                SELECT 
                    a.*,
                    m.CIN AS existe
                FROM sartmmg_site.adhesion a
                LEFT JOIN membre m
                    ON m.CIN = a.CIN
                ORDER BY a.prenom
            ";
        
            return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function allCompta()
        {
            $db = Database::compta();

            $sql = "
                SELECT m.*,
                    IFNULL(SUM(p.montant),0) AS montant
                FROM membre m
                LEFT JOIN payement p
                    ON p.cinpaiement = m.CIN
                GROUP BY m.CIN
                ORDER BY m.date_adhesion
            ";

            return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function syncOne($cin)
        {
            $db = Database::compta();
        
            $sql = "
                INSERT INTO membre
                (CIN, nom, prenom, profession, contact, email, date_adhesion)
        
                SELECT
                    CIN,
                    nom,
                    prenom,
                    profession,
                    contact,
                    email,
                    CURDATE()
        
                FROM sartmmg_site.adhesion
                WHERE CIN = ?
                AND NOT EXISTS (
                    SELECT 1 FROM membre WHERE CIN = ?
                )
            ";
        
            $stmt = $db->prepare($sql);
            return $stmt->execute([$cin, $cin]);
        }
    }