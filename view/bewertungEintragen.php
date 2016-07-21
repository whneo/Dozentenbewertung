<form action="index.php" method="POST">
    <table border="0" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th style="background: #000000" colspan="2">Bitte tragen Sie hier alle Daten zur Bewertung ein</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Ihr Pseudonym:</td>
                <td><input type="text" name="teilnehmerPseudonym" value="" required=""/></td>
            </tr>
            <tr>
                <td>Vorname des Dozenten:</td>
                <td><input type="text" name="dozentVorname" value="" required=""/></td>
            </tr>
            <tr>
                <td>Nachname des Dozenten:</td>
                <td><input type="text" name="dozentNachname" value="" required=""/></td>
            </tr>
            <tr>
                <td>Thema des Kurses:</td>
                <td><input type="text" name="kursThema" value="" required=""/></td>
            </tr>
            <tr>
                <td>Wo fand der Kurs statt? (Ort/Stadt):</td>
                <td><input type="text" name="einsatzortStadt" value="" required=""/></td>
            </tr>
            <tr>
                <td>Bewertung:</td>
                <td>
                    1 <input type="radio" name="note" value="1" >
                    2 <input type="radio" name="note" value="2" >
                    3 <input type="radio" name="note" value="3" checked>
                    4 <input type="radio" name="note" value="4" >
                    5 <input type="radio" name="note" value="5" >
                    6 <input type="radio" name="note" value="6" > (Schulnoten)
                </td>
            </tr>
            <tr>
                <td>Beginn des Kurses:</td>
                <td><input class="datepicker" type="text" id="fromdate" name='kursBeginn' size='9' value="" required=""/></td>
            </tr>
            <tr>
                <td>Ende des Kurses:</td>
                <td><input class="datepicker" type="text" id="todate" name='kursEnde' size='9' value="" required=""/></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input style="background: #000000; color: #FF0000" type="submit" value="Absenden"/>
                    <input style="background: #000000; color: #FF0000" type="reset" />
                    <input type="hidden" name="insertsent" value="1" />
                </td>
            </tr>
        </tbody>
    </table>
</form>