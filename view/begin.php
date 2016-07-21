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
                <a><img src="images/daumen.png" alt="" /></a>
                <h1>Dozentenbewertung</h1>
            </header>

            <nav>
                <h2>Navigation</h2>                
                <p><a href="index.php">Home</a></p>
                <p><a href="index.php?navi=1">Bewertungen</a></p>
                <p><a href="index.php?navi=2">Bewertung eintragen</a></p>
                <p><a href="index.php?navi=3">Kontakt</a></p>                                                
            </nav>

            <aside>
                <h2>Suche</h2>
                <h3>Nach Dozenten (Nachnamen)</h3>
                <form action="index.php" method="POST">
                    <input id="tagsDozent" name="suchstringDozent" size="25" class="ui-widget"/>
                    <input type="submit" value="Absenden" />
                    <input type="hidden" name="sentDozent" value="1" />
                </form>
                <br>
                <br>
                <br>
                <h3>Nach Ort</h3>
                <form action="index.php" method="POST">                  
                    <input id="tagsOrt" type="text" name="suchstringOrt" size="25" class="ui-widget"/>                           
                    <input type="submit" value="Absenden" />
                    <input type="hidden" name="sentOrt" value="1" />
                </form>
                <br>
                <br>
                <br>
                <h3>Nach Kurs</h3>
                <form action="index.php" method="POST">                  
                    <input id="tagsKurs" type="text" name="suchstringKurs" size="25" class="ui-widget"/>                           
                    <input type="submit" value="Absenden" />
                    <input type="hidden" name="sentKurs" value="1" />
                </form>
            </aside>

            <section id="content">

                <article>