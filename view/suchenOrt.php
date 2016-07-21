<?php
$rows = Bewertung::getEinsatzorteByLikeness($suchstringOrt);
?>
<table border="0" cellspacing="20" cellpadding="20" class="tableSorter">
    <?php
    echo BewertungHTML::buildTableContent($rows);
    ?>
</table>