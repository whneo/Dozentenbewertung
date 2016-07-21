<?php

class BewertungHTML {

    public static function buildTableContent($bewertungen) {
        $html = "
        <thead>
        <tr>
            <th><a class=\"bold\" href=\"javascript:$('example1_table').sortTable({onCol: 1, keepRelationships: true})\">Teilnehmer</a></th>
            <th><a class=\"bold\" href=\"javascript:$('example1_table').sortTable({onCol: 2, keepRelationships: true})\">Dozent Vorname</a></th>
            <th><a class=\"bold\" href=\"javascript:$('example1_table').sortTable({onCol: 3, keepRelationships: true})\">Dozent Nachname</a></th>
            <th><a class=\"bold\" href=\"javascript:$('example1_table').sortTable({onCol: 4, keepRelationships: true})\">Kurs</a></th>
            <th><a class=\"bold\" href=\"javascript:$('example1_table').sortTable({onCol: 5, keepRelationships: true})\">Ort</a></th>
            <th><a class=\"bold\" href=\"javascript:$('example1_table').sortTable({onCol: 6, keepRelationships: true, sortType: 'numeric'})\">Note</a></th>
            <th><a class=\"bold\" href=\"javascript:$('example1_table').sortTable({onCol: 7, keepRelationships: true, sortType: 'numeric'})\">Jahr</a></th>
        </tr>
    </thead>
    <tbody>";
        for ($i = 0; $i < count($bewertungen); $i++) {
            $html .= " 
            <tr>
                <td><center> {$bewertungen[$i]->getTeilnehmer()} </center></td>
                <td><center> {$bewertungen[$i]->getDozent()->getVorname()} </center></td>
                <td><center> {$bewertungen[$i]->getDozent()->getNachname()} </center></td>
                <td><center> {$bewertungen[$i]->getKurs()} </center></td>
                <td><center> {$bewertungen[$i]->getEinsatzort()} </center></td>
                <td><center> {$bewertungen[$i]->getNote()} </center></td>
                <td><center> {$bewertungen[$i]->getJahr()} </center></td>
            </tr>";
        }
        $html .= "</tbody>";
        return $html;
    }

}
