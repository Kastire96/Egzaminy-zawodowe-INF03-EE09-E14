<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <h1>Zdjęcia</h1>
    </header>
    <main>
        <aside>
            <h2>Tematy zdjęć</h2>
            <ol>
                <li>Zwierzęta</li>
                <li>Krajobrazy</li>
                <li>Miasta</li>
                <li>Przyroda</li>
                <li>Samochody</li>
            </ol>
        </aside>
        <section>
                <?php
                    $polaczenie = mysqli_connect("localhost", "root", "", "galeria");

                    $zapytanie = "SELECT plik, tytul , polubienia, autorzy.imie, autorzy.nazwisko FROM zdjecia JOIN autorzy ON autorzy_id = autorzy.id ORDER BY autorzy.nazwisko;";

                    $wynik = mysqli_query($polaczenie, $zapytanie);

                    while ($wiersz = mysqli_fetch_array($wynik)) {
                        echo "<article>
                                <img src='$wiersz[0]' alt='zdjęcie'>
                                <h3>$wiersz[1]</h3>";
                        if ($wiersz[2] > 40) {
                            echo "<p>Autor: $wiersz[3] $wiersz[4].<br>Wiele osób polubiło ten obraz</p>";
                        } else {
                            echo "<p>Autor: $wiersz[3] $wiersz[4]</p>";
                        }
                        echo "<a href='$wiersz[0]' download>Pobierz</a></article>";
                    }

                    mysqli_close($polaczenie);
                ?>
        </section>
        <aside>
            <h2>Najbardziej lubiane</h2>
            <?php
                $polaczenie = mysqli_connect("localhost", "root", "" ,"galeria");

                $zapytanie = "SELECT tytul, plik FROM zdjecia WHERE polubienia >= 100;";

                $wynik = mysqli_query($polaczenie, $zapytanie);

                while ($wiersz = mysqli_fetch_array($wynik)) {
                    echo "<img src='$wiersz[1]' alt='$wiersz[0]'>";
                }

                mysqli_close($polaczenie);
            ?>
            <strong>Zobacz wszystkie nasze zdjęcia</strong>
        </aside>
    </main>
    <footer>
        <h5>Stronę wykonał: 000000000</h5>
    </footer>
</body>
</html>