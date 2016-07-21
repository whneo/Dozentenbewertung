<?php
$rows = Bewertung::getEinsatzorteByLikeness($suchstringOrt);
?>

<table id="example1_table" border="1" cellspacing="0" cellpadding="5" class="tableSorter">
    <?php
    echo BewertungHTML::buildTableContent($rows);
    ?>
</table>