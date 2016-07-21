<?php
$rows = Bewertung::getValuesForShow();
?>
<table id="example1_table" border="0" cellspacing="15" cellpadding="20" class="tableSorter">
    <?php
echo BewertungHTML::buildTableContent($rows);
?>
</table>