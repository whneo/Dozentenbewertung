<form action="index.php" method="POST">
    <table border="0" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th style="background: #000000" colspan="2">Bitte teilen Sie uns Ihr Anliegen mit</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Anrede:</td>
                <td>
                    <select name="anrede" id="anrede">
                        <option value="herr">Herr</option>
                        <option value="frau">Frau</option>
                    </select>
                </td>    
            </tr>
            <tr>
                <td>Pseudonym:*</td>
                <td><input type="text" name="pseudonym" value="" required=""/></td>    
            </tr>
            <tr>
                <td>Email:*</td>
                <td><input type="text" name="email" value="" required=""/></td>    
            </tr>
            <tr>
                <td>Nachricht:*</td>
                <td><textarea name="message" id="message" style="resize: none; height: 143px;" rows="auto" cols="auto" required=""></textarea></td>    
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
    <p style="margin-top:20px; color: #FF0000">Die mit * gekennzeichneten Felder müssen ausgefüllt werden.</p>
</form>