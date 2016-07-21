<?php

class Bewertung {

    private $id;
    private $teilnehmer;
    private $dozent;
    private $kurs;
    private $einsatzort;
    private $note;
    private $kursbeginn;
    private $kursende;

    public function __construct($teilnehmer, $dozent, $kurs, $einsatzort, $note, $kursbeginn, $kursende, $id = NULL) {
        $this->teilnehmer = $teilnehmer;
        $this->dozent = $dozent;
        $this->kurs = $kurs;
        $this->einsatzort = $einsatzort;
        $this->note = $note;
        $this->kursbeginn = $kursbeginn;
        $this->kursende = $kursende;
        if (!is_null($id)) {
            $this->id = $id;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getTeilnehmer() {
        return $this->teilnehmer;
    }

    public function getDozent() {
        return $this->dozent;
    }

    public function getKurs() {
        return $this->kurs;
    }

    public function getEinsatzort() {
        return $this->einsatzort;
    }

    public function getNote() {
        return $this->note;
    }

    public function getKursbeginn() {
        return $this->kursbeginn;
    }
    
    public function getKursende() {
        return $this->kursende;
    }

    public static function getAll() {
        $db = DbConnect::getConnection();

        $stmt = $db->prepare("SELECT * FROM bewertung");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $returnBewertungen = [];
        foreach ($rows as $row) {
            $returnBewertungen[] = new Bewertung(Teilnehmer::getById($row['teilnehmer_id']), Dozent::getById($row['dozent_id']), Kurs::getById($row['kurs_id']), Einsatzort::getById($row['einsatzort_id']), $row['note'], self::dateMysqlToPhp($row['kursbeginn']), self::dateMysqlToPhp($row['kursende']), $row['id']);
        }
        return $returnBewertungen;
    }

    public static function getValuesForShow() {
        $db = DbConnect::getConnection();

        $stmt = $db->prepare("SELECT * FROM bewertung ORDER BY kursbeginn, kursende");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $bewertungen = [];
        foreach ($rows as $row) {
            $bewertungen[] = new Bewertung(Teilnehmer::getById($row['teilnehmer_id'])->getPseudonym(), Dozent::getById($row['dozent_id']), Kurs::getById($row['kurs_id'])->getThema(), Einsatzort::getById($row['einsatzort_id'])->getStadt(), $row['note'], self::dateMysqlToPhp($row['kursbeginn']), self::dateMysqlToPhp($row['kursende']), $row['id']);
        }
        return $bewertungen;
    }

    public static function getDozentenByLikeness($suchstring) {
        $dozenten = Dozent::getAllByLikeness($suchstring);
        
        $db = DbConnect::getConnection();
        $bewertungen = [];
        for ($i = 0; $i < count($dozenten); $i++) {
            $dozent_id = $dozenten[$i]->getId();

            $stmt = $db->prepare("SELECT * FROM bewertung WHERE dozent_id=?");
            $stmt->bindValue(1, $dozent_id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                $bewertungen[] = new Bewertung(Teilnehmer::getById($row['teilnehmer_id'])->getPseudonym(), Dozent::getById($row['dozent_id']), Kurs::getById($row['kurs_id'])->getThema(), Einsatzort::getById($row['einsatzort_id'])->getStadt(), $row['note'], self::dateMysqlToPhp($row['kursbeginn']), self::dateMysqlToPhp($row['kursende']), $row['id']);
            }
        }
        return $bewertungen;
    }
    
    public static function getEinsatzorteByLikeness($suchstring) {
        $einsatzorte = Einsatzort::getAllByLikeness($suchstring);
        
        $db = DbConnect::getConnection();
        $bewertungen = [];
        for ($i = 0; $i < count($einsatzorte); $i++) {
            $einsatzort_id = $einsatzorte[$i]->getId();

            $stmt = $db->prepare("SELECT * FROM bewertung WHERE einsatzort_id=?");
            $stmt->bindValue(1, $einsatzort_id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                $bewertungen[] = new Bewertung(Teilnehmer::getById($row['teilnehmer_id'])->getPseudonym(), Dozent::getById($row['dozent_id']), Kurs::getById($row['kurs_id'])->getThema(), Einsatzort::getById($row['einsatzort_id'])->getStadt(), $row['note'], self::dateMysqlToPhp($row['kursbeginn']), self::dateMysqlToPhp($row['kursende']), $row['id']);
            }
        }
        return $bewertungen;
    }
    
    public static function getKurseByLikeness($suchstring) {
        $kurse = Kurs::getAllByLikeness($suchstring);
        
        $db = DbConnect::getConnection();
        $bewertungen = [];
        for ($i = 0; $i < count($kurse); $i++) {
            $kurs_id = $kurse[$i]->getId();

            $stmt = $db->prepare("SELECT * FROM bewertung WHERE kurs_id=?");
            $stmt->bindValue(1, $kurs_id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                $bewertungen[] = new Bewertung(Teilnehmer::getById($row['teilnehmer_id'])->getPseudonym(), Dozent::getById($row['dozent_id']), Kurs::getById($row['kurs_id'])->getThema(), Einsatzort::getById($row['einsatzort_id'])->getStadt(), $row['note'], self::dateMysqlToPhp($row['kursbeginn']), self::dateMysqlToPhp($row['kursende']), $row['id']);
            }
        }
        return $bewertungen;
    }

    public static function insert(Bewertung $bewertung) {
        $teilnehmer = Teilnehmer::insert($bewertung);
        $dozent = Dozent::insert($bewertung);
        $kurs = Kurs::insert($bewertung);
        $einsatzort = Einsatzort::insert($bewertung);

        $db = DbConnect::getConnection();

        $returnBewertung = NULL;
        foreach (Bewertung::getAll() as $row) {
            if ($teilnehmer->getPseudonym() == $row->getTeilnehmer()->getPseudonym() && $dozent->getVorname() == $row->getDozent()->getVorname() && $dozent->getNachname() == $row->getDozent()->getNachname() && $kurs->getThema() == $row->getKurs()->getThema() && $einsatzort->getStadt() == $row->getEinsatzort()->getStadt() && $bewertung->getKursbeginn() == $row->getKursbeginn() && $bewertung->getKursende() == $row->getKursende()) {
                $returnBewertung = $row;
            }
        }
        if ($returnBewertung == NULL) {
            $stmt = $db->prepare("INSERT INTO bewertung VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $teilnehmer->getId(), PDO::PARAM_INT);
            $stmt->bindValue(2, $dozent->getId(), PDO::PARAM_INT);
            $stmt->bindValue(3, $kurs->getId(), PDO::PARAM_INT);
            $stmt->bindValue(4, $einsatzort->getId(), PDO::PARAM_INT);
            $stmt->bindValue(5, $bewertung->getNote(), PDO::PARAM_INT);
            $stmt->bindValue(6, self::datePhpToMysql($bewertung->getKursbeginn()), PDO::PARAM_STR);
            $stmt->bindValue(7, self::datePhpToMysql($bewertung->getKursende()), PDO::PARAM_STR);
            $stmt->execute();
            $returnBewertung = new Bewertung($bewertung->getTeilnehmer(), $bewertung->getDozent(), $bewertung->getKurs(), $bewertung->getEinsatzort(), $bewertung->getNote(), self::datePhpToMysql($bewertung->getKursbeginn()), self::datePhpToMysql($bewertung->getKursende()), $db->lastInsertId());
            return $returnBewertung;
        }
    }

    private static function datePhpToMysql($datePhp) {
        $myDateTime = DateTime::createFromFormat('d.m.Y', $datePhp);
        $dateMysql = $myDateTime->format('Y-m-d');
        return $dateMysql;
    }
    
    private static function dateMysqlToPhp($dateMysql) {
        $myDateTime = DateTime::createFromFormat('Y-m-d', $dateMysql);
        $datePhp = $myDateTime->format('d.m.Y');
        return $datePhp;
    }
}
