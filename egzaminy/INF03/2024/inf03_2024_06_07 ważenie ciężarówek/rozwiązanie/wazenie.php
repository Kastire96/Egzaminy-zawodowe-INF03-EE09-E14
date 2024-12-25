<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ważenie samochodów ciężarowych</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <h1>Ważenie pojazdów we Wrocławiu</h1>
    </header>
    <header>
        <img src="obraz1.png" alt="waga">
    </header>
    <main>
        <aside>
            <h2>Lokalizacje wag</h2>
            <ol>
                <?php
                    $polaczenie = mysqli_connect("localhost", "root", "", "wazenietirow");
                    $zapytanie = "SELECT ulica FROM lokalizacje;";

                    $wynik = mysqli_query($polaczenie, $zapytanie);
                    
                    while ($wiersz = mysqli_fetch_array($wynik)) {
                        echo "<li>ulica $wiersz[0]</li>";
                    }
                ?>
            </ol>
            <h2>Kontakt</h2>
            <a href="mailto:wazenie@wroclaw.pl">napisz</a>
        </aside>
        <section>
            <h2>Alerty</h2>
            <table>
                <tr>
                    <th>rejestracja</th>
                    <th>ulica</th>
                    <th>waga</th>
                    <th>dzień</th>
                    <th>czas</th>
                </tr>
                <?php
                    $zapytanie = "SELECT rejestracja, waga, dzien, czas, lokalizacje.ulica FROM wagi JOIN lokalizacje ON lokalizacje_id = lokalizacje.id WHERE waga > 5;";

                    $wynik = mysqli_query($polaczenie, $zapytanie);

                    while ($wiersz = mysqli_fetch_array($wynik)) {
                        echo"<tr>";
                                echo"<td>$wiersz[0]</td>";
                                echo"<td>$wiersz[4]</td>";
                                echo"<td>$wiersz[1]</td>";
                                echo"<td>$wiersz[2]</td>";
                                echo"<td>$wiersz[3]</td>";
                        echo"</tr>";
                    }
                ?>
            </table>
            <?php
                $zapytanie = "INSERT INTO wagi (lokalizacje_id, waga, rejestracja, dzien, czas) VALUES (5, FLOOR(1 + RAND() * (10 - 1 + 1)), 'DW12345', CURRENT_DATE, CURRENT_TIME);";

                $wynik = mysqli_query($polaczenie, $zapytanie);

                header("refresh: 10");
                mysqli_close($polaczenie);
            ?>
        </section>
        <aside>
            <img src="obraz2.jpg" alt="tir">
        </aside>
    </main>
    <footer>
        <p>Stronę wykonał: 00000000000</p>
    </footer>
</body>
</html>