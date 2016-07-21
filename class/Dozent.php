<?php
class Dozent {

    private $id;
    private $vorname;
    private $nachname;

    public function __construct($vorname, $nachname, $id = NULL) {
        $this->vorname = $vorname;
        $this->nachname = $nachname;
        if (!is_null($id)) {
            $this->id = $id;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getVorname() {
        return $this->vorname;
    }

    public function getNachname() {
        return $this->nachname;
    }

    public static function getAll() {
        $db = DbConnect::getConnection();

        $stmt = $db->prepare("SELECT * FROM dozent");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $dozenten = [];
        foreach ($rows as $row) {
            $dozenten[] = new Dozent($row['vorname'], $row['nachname'], $row['id']);
        }
        return $dozenten;
    }

    public static function getById($id) {
        $db = DbConnect::getConnection();

        $stmt = $db->prepare("SELECT * FROM dozent WHERE id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $dozent = new Dozent($rows[0]['vorname'], $rows[0]['nachname'], $rows[0]['id']);

        return $dozent;
    }

    public static function insert(Bewertung $bewertung) {
        $db = DbConnect::getConnection();
        $returnDozent = NULL;
        foreach (Dozent::getAll() as $value) {
            if ($value->getVorname() == $bewertung->getDozent()->getVorname() && $value->getNachname() == $bewertung->getDozent()->getNachname()) {
                $returnDozent = $value;
            }
        }
        if ($returnDozent == NULL) {
            $stmt = $db->prepare("INSERT INTO dozent VALUES (NULL, ?, ?)");
            $stmt->bindValue(1, $bewertung->getDozent()->getVorname(), PDO::PARAM_STR);
            $stmt->bindValue(2, $bewertung->getDozent()->getNachname(), PDO::PARAM_STR);
            $stmt->execute();
            $returnDozent = new Dozent($bewertung->getDozent()->getVorname(), $bewertung->getDozent()->getNachname(), $db->lastInsertId());
        }
        return $returnDozent;
    }
    
    public static function getNachnamenByLikeness($term) {
        $db = DbConnect::getConnection();
        
        $stmt = $db->prepare("SELECT * FROM dozent WHERE nachname LIKE ?");
        $stmt->bindValue(1, "%$term%", PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $names = [];
        foreach ($rows as $row) {
            $names[] = $row->nachname;
        }
        return $names;
    }
    
    public static function getAllByLikeness($suchstring) {
        $db = DbConnect::getConnection();

        $stmt = $db->prepare("SELECT * FROM dozent WHERE nachname LIKE ?");
        $stmt->bindValue(1, "%$suchstring%", PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $dozenten = [];
        foreach ($rows as $row) {
            $dozenten[] = new Dozent($row['vorname'], $row['nachname'], $row['id']);
        }
        return $dozenten;
    }
}
