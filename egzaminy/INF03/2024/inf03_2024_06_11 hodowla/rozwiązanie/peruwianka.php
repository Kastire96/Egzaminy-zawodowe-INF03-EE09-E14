<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hodowla świnek morskich</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <h1>Hodowla świnek morskich - zamów świnkowe maluszki</h1>
    </header>
    <main>
        <aside id="menu">
            <a href="peruwianka.php">Rasa Peruwianka</a>
            <a href="american.php">Rasa American</a>
            <a href="crested.php">Rasa Crested</a>
        </aside>
        <aside id="blok-prawy">
            <h3>Poznaj wszystkie rasy świnek morskich</h3>
            <ol>
               <?php
                    $polaczenie = mysqli_connect('localhost', 'root', '', 'hodowla');

                    if (!$polaczenie) {
                        die('Wystąpił błąd połączenia: ' . mysqli_connect_error());
                    }

                    $zapytanie = 'SELECT rasa FROM rasy;';

                    $wynik = mysqli_query($polaczenie, $zapytanie);

                    while ($wiersz = mysqli_fetch_array($wynik)) {
                        echo "<li>$wiersz[0]</li>";
                    }
               ?> 
            </ol>
        </aside>
        <section>
            <img src="peruwianka.jpg" alt="Świnka morska rasy peruwianka">
            <?php
                $zapytanie = 'SELECT DISTINCT data_ur, miot, rasy.rasa FROM swinki JOIN rasy ON rasy_id = rasy.id WHERE rasy.id = 1;';

                $wynik = mysqli_query($polaczenie, $zapytanie);

                while ($wiersz = mysqli_fetch_array($wynik)) {
                    echo "<h2>Rasa: $wiersz[2]</h2>
                        <p>Data urodzenia: $wiersz[0]</p>
                        <p>Oznaczenie miotu: $wiersz[1]</p>";
                }
            ?>
            <hr>
            <h2>Świnki w tym miocie</h2>
            <?php
                $zapytanie = "SELECT imie, cena, opis FROM swinki WHERE rasy_id = 1;";

                $wynik = mysqli_query($polaczenie, $zapytanie);

                while ($wiersz = mysqli_fetch_array($wynik)) {
                    echo "<h3>$wiersz[0] - $wiersz[1] zł</h3>
                        <p>$wiersz[2]</p>";
                }

                mysqli_close($polaczenie);
            ?>
        </section>
    </main>
    <footer>
        <p>Stronę wykonał: 00000000000</p>
    </footer>
</body>
</html>