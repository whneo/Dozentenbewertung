<?php

class Kurs {
   
    private $id;
    private $thema;
    
    public function __construct($thema, $id = NULL) {
        $this->thema = $thema;
        if (!is_null($id)) {
            $this->id = $id;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getThema() {
        return $this->thema;
    }
    
    public static function getAll() {
        $db = DbConnect::getConnection();
        
        $stmt = $db->prepare("SELECT * FROM kurs");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $kurse = [];
        foreach ($rows as $row) {
            $kurse[] = new Kurs($row['thema'], $row['id']);
        }
        return $kurse;
    }
    
    public static function getById($id) {
        $db = DbConnect::getConnection();
        
        $stmt = $db->prepare("SELECT * FROM kurs WHERE id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $kurs = new Kurs($rows[0]['thema'], $rows[0]['id']);

        return $kurs;
    }
    
    public static function insert(Bewertung $bewertung) {
        $db = DbConnect::getConnection();
        $returnKurs = NULL;
        foreach (Kurs::getAll() as $value) {
            if ($value->getThema() == $bewertung->getKurs()->getThema()) {
                $returnKurs = $value;
            }
        }
        if ($returnKurs == NULL) {
            $stmt = $db->prepare("INSERT INTO kurs VALUES (NULL, ?)");
            $stmt->bindValue(1, $bewertung->getKurs()->getThema(), PDO::PARAM_STR);
            $stmt->execute();
            $returnKurs = new Kurs($bewertung->getKurs()->getThema(), $db->lastInsertId());
        }
        return $returnKurs;
    }
    
    public static function getThemenByLikeness($term) {
        $db = DbConnect::getConnection();
        
        $stmt = $db->prepare("SELECT * FROM kurs WHERE thema LIKE ?");
        $stmt->bindValue(1, "%$term%", PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $themen = [];
        foreach ($rows as $row) {
            $themen[] = $row->thema;
        }
        return $themen;
    }
    
    public static function getAllByLikeness($suchstring) {
        $db = DbConnect::getConnection();

        $stmt = $db->prepare("SELECT * FROM kurs WHERE thema LIKE ?");
        $stmt->bindValue(1, "%$suchstring%", PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $themen = [];
        foreach ($rows as $row) {
            $themen[] = new Kurs($row['thema'], $row['id']);
        }
        return $themen;
    }
}
