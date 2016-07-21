<?php
class Einsatzort {
   
    private $id;
    private $stadt;
    
    public function __construct($stadt, $id = NULL) {
        $this->stadt = $stadt;
        if (!is_null($id)) {
            $this->id = $id;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getStadt() {
        return $this->stadt;
    }
 
    public static function getAll() {
        $db = DbConnect::getConnection();
        
        $stmt = $db->prepare("SELECT * FROM einsatzort");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $einsatzorte = [];
        foreach ($rows as $row) {
            $einsatzorte[] = new Einsatzort($row['stadt'], $row['id']);
        }
        return $einsatzorte;
    }
    
    public static function getById($id) {
        $db = DbConnect::getConnection();
        
        $stmt = $db->prepare("SELECT * FROM einsatzort WHERE id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $einsatzort = new Einsatzort($rows[0]['stadt'], $rows[0]['id']);
        
        return $einsatzort;
    }
    
    public static function insert(Bewertung $bewertung) {
        $db = DbConnect::getConnection();
        $returnEinsatzort = NULL;
        foreach (Einsatzort::getAll() as $value) {
            if ($value->getStadt() == $bewertung->getEinsatzort()->getStadt()) {
                $returnEinsatzort = $value;
            }
        }
        if ($returnEinsatzort == NULL) {
            $stmt = $db->prepare("INSERT INTO einsatzort VALUES (NULL, ?)");
            $stmt->bindValue(1, $bewertung->getEinsatzort()->getStadt(), PDO::PARAM_STR);
            $stmt->execute();
            $returnEinsatzort = new Kurs($bewertung->getEinsatzort()->getStadt(), $db->lastInsertId());
        }
        return $returnEinsatzort;
    }
    
    public static function getStaedteByLikeness($term) {
        $db = DbConnect::getConnection();
        
        $stmt = $db->prepare("SELECT * FROM einsatzort WHERE stadt LIKE ?");
        $stmt->bindValue(1, "%$term%", PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $staedte = [];
        foreach ($rows as $row) {
            $staedte[] = $row->stadt;
        }
        return $staedte;
    }
    
    public static function getAllByLikeness($suchstring) {
        $db = DbConnect::getConnection();

        $stmt = $db->prepare("SELECT * FROM einsatzort WHERE stadt LIKE ?");
        $stmt->bindValue(1, "%$suchstring%", PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $staedte = [];
        foreach ($rows as $row) {
            $staedte[] = new Einsatzort($row['stadt'], $row['id']);
        }
        return $staedte;
    }
}
