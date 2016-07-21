<?php
class Teilnehmer {

    private $id;
    private $pseudonym;

    public function __construct($pseudonym, $id = NULL) {
        $this->pseudonym = $pseudonym;
        if (!is_null($id)) {
            $this->id = $id;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getPseudonym() {
        return $this->pseudonym;
    }

    public static function getAll() {
        $db = DbConnect::getConnection();

        $stmt = $db->prepare("SELECT * FROM teilnehmer");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $teilnehmer = [];
        foreach ($rows as $row) {
            $teilnehmer[] = new Teilnehmer($row['pseudonym'], $row['id']);
        }
        return $teilnehmer;
    }

    public static function getById($id) {
        $db = DbConnect::getConnection();

        $stmt = $db->prepare("SELECT * FROM teilnehmer WHERE id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $teilnehmer = new Teilnehmer($rows[0]['pseudonym'], $rows[0]['id']);

        return $teilnehmer;
    }

    public static function insert(Bewertung $bewertung) {
        $db = DbConnect::getConnection();
        $returnTeilnehmer = NULL;
        foreach (Teilnehmer::getAll() as $value) {
            if ($value->getPseudonym() == $bewertung->getTeilnehmer()->getPseudonym()) {
                $returnTeilnehmer = $value;
            }
        }
        if ($returnTeilnehmer == NULL) {
            $stmt = $db->prepare("INSERT INTO teilnehmer VALUES (NULL, ?)");
            $stmt->bindValue(1, $bewertung->getTeilnehmer()->getPseudonym(), PDO::PARAM_STR);
            $stmt->execute();
            $returnTeilnehmer = new Teilnehmer($bewertung->getTeilnehmer()->getPseudonym(), $db->lastInsertId());
        }
        return $returnTeilnehmer;
    }
}
