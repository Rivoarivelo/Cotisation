<?php
class SortieFondModele {

    private $conn;
    private $table = "sortiefond";

    public function __construct($db){
        $this->conn = $db;
    }

    // Récupérer toutes les sorties
    public function getAll(){
        $sql = "SELECT s.*, r.nomresponsable
                FROM {$this->table} s
                JOIN responsable r
                  ON s.idresponsablesortie = r.idresponsable
                ORDER BY s.datesortie DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insérer une sortie
    public function insert($motif, $date, $montant, $responsable){
        $sql = "INSERT INTO {$this->table}
                (motif, datesortie, montantsortie, idresponsablesortie)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$motif, $date, $montant, $responsable]);
    }

    // Total sorties
    public function totalSortie()
    {
        $sql = "SELECT SUM(montantsortie) as total FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }

    // Total entrées (paiements cotisation)
    public function totalEntree()
    {
        $sql = "SELECT SUM(montant) as total FROM payement";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }

    //solde restant
    public function soldeRestant (){
        return $this->totalEntree() - $this->totalSortie();
    }
}