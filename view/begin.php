<!doctype html>
<html>

    <head>

        <meta charset="UTF-8">
        <link type="text/css" href="css/style.css" rel="stylesheet" media="screen" />
        <link rel="stylesheet" href="js/jquery-ui-1.12.0/jquery-ui.css" />
        <script src="js/jquery-3.0.0.min.js"></script>
        <script src="js/animatedtablesorter-0.2.2/tsort.min.js"></script>
        <script src="js/jquery-autocomplete-master/src/jquery.autocomplete.min.js"></script>
        <script src="js/jquery-ui-1.12.0/jquery-ui.js"></script>

        <script>
            $(document).ready(
                    function () {
                        $("table.tableSorter").tableSort();
                        $('.datepicker').datepicker({
                            dateFormat: "dd.mm.yy"
                        });
                        $("#tagsDozent").autocomplete({
                            source: "ajaxDozent.php", minLength: 2
                        });
                        $("#tagsOrt").autocomplete({
                            source: "ajaxOrt.php", minLength: 2
                        });
                        $("#tagsKurs").autocomplete({
                            source: "ajaxKurs.php", minLength: 2
                        });
                    });
        </script>

        <title>Dozentenbewertung</title>

    </head>

    <body>

        <div id="container">

            <header>
                <a href="http://localhost/Dozentenbewertung/index.php"><img src="images/daumen.png" alt="" /></a>
                <h1>Dozentenbewertung</h1>
                <table>
                    <tbody>
                        <tr>
                            <td style="font-size: 1.5em"><p><a href="index.php">Home</a></p></td>
                            <td style="font-size: 1.5em"><p><a href="index.php?navi=1">Bewertungen</a></p></td>
                            <td style="font-size: 1.5em"><p><a href="index.php?navi=2">Bewertung eintragen</a></p></td>
                            <td style="font-size: 1.5em"><p><a href="index.php?navi=3">Kontakt</a></p></td>
                        </tr>
                    </tbody>
                </table>
            </header>
            <div id="zentrum">
<!--                <nav>
                    <h2>Navi</h2>                
                    <p><a href="index.php">Home</a></p>
                    <p><a href="index.php?navi=1">Bewertungen</a></p>
                    <p><a href="index.php?navi=2">Bewertung eintragen</a></p>
                    <p><a href="index.php?navi=3">Kontakt</a></p>                                                
                </nav>-->

                <aside>
                    <h2>Suche</h2>
                    <p style="color: #FF0000">Nach Dozenten (Nachnamen)</p>
                    <form action="index.php" method="POST">
                        <input id="tagsDozent" name="suchstringDozent" size="22" class="ui-widget"/>
                        <input style="background: #000000; color: #FF0000" type="submit" value="Absenden" />
                        <input type="hidden" name="sentDozent" value="1" />
                    </form>
                    <br>
                    <p style="color: #FF0000">Nach Ort</p>
                    <form action="index.php" method="POST">                  
                        <input id="tagsOrt" type="text" name="suchstringOrt" size="22" class="ui-widget"/>                           
                        <input style="background: #000000; color: #FF0000" type="submit" value="Absenden" />
                        <input type="hidden" name="sentOrt" value="1" />
                    </form>
                    <br>
                    <p style="color: #FF0000">Nach Kurs</p>
                    <form action="index.php" method="POST">                  
                        <input id="tagsKurs" type="text" name="suchstringKurs" size="22" class="ui-widget"/>                           
                        <input style="background: #000000; color: #FF0000" type="submit" value="Absenden" />
                        <input type="hidden" name="sentKurs" value="1" />
                    </form>
                </aside>

                <section id="content" style="margin-left: 0; margin-right: 200px;">

                    <article style="color: #FF0000">