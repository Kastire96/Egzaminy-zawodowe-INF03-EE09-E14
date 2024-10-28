<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komis aut</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <h1><em>KupAuto!</em> Internetowy Komis Samochodowy</h1>
    </header>
    <main>
        <section id="blok1">
            <?php
                $polaczenie = mysqli_connect("localhost", "root", "", "kupauto");

                $zapytanie = "SELECT model, rocznik, przebieg, paliwo, cena, zdjecie FROM samochody WHERE id = 10;";

                $wynik = mysqli_query($polaczenie, $zapytanie);

                while ($wiersz = mysqli_fetch_array($wynik)) {
                    echo "
                        <img src='$wiersz[5]' alt='oferta dnia'>
                        <h4>Oferta Dnia: Toyota $wiersz[0]</h4>
                        <p>Rocznik: $wiersz[1], przebieg: $wiersz[2], rodzaj paliwa: $wiersz[3]</p>
                        <h4>Cena: $wiersz[4]</h4>";
                }

                mysqli_close($polaczenie);
            ?>
        </section>
        <section>
            <h2>Oferty Wyróżnione</h2>
            <?php
                $polaczenie = mysqli_connect("localhost", "root", "", "kupauto");

                $zapytanie = "SELECT marki.nazwa, model, rocznik, cena, zdjecie FROM marki JOIN samochody ON marki_id = marki.id WHERE wyrozniony = 1 LIMIT 4;";

                $wynik = mysqli_query($polaczenie, $zapytanie);

                while ($wiersz = mysqli_fetch_array($wynik)) {
                    echo "<article>
                            <img src='$wiersz[4]' alt='$wiersz[1]'>
                            <h4>$wiersz[0] $wiersz[1]</h4>
                            <p>Rocznik: $wiersz[2]</p>
                            <h4>Cena: $wiersz[3]</h4>
                        </article>";
                }

                mysqli_close($polaczenie);
            ?>
        </section>
        <section id="blok3">
            <h2>Wybierz markę</h2>
            <form action="KupAuto.php" method="post">
                <select name="wybierz-marke" id="wybierz-marke">
                    <?php
                        $polaczenie = mysqli_connect("localhost", "root", "", "kupauto");

                        $zapytanie = "SELECT nazwa FROM marki;";

                        $wynik = mysqli_query($polaczenie, $zapytanie);

                        while ($wiersz = mysqli_fetch_array($wynik)) {
                            echo "<option>$wiersz[0]";
                        }

                        mysqli_close($polaczenie);
                    ?>
                </select>
                <input type="submit" value="Wyszukaj">
                </form>
                <?php
                    $polaczenie = mysqli_connect("localhost", "root", "", "kupauto");

                    if (isset($_POST["wybierz-marke"])) {
                        $marka = $_POST["wybierz-marke"];

                        $zapytanie = "SELECT model, cena, zdjecie FROM samochody JOIN marki ON marki_id = marki.id WHERE marki.nazwa = '$marka';";

                        $wynik = mysqli_query($polaczenie, $zapytanie);

                        while ($wiersz = mysqli_fetch_array($wynik)) {
                            echo "<article>
                                    <img src='$wiersz[2]' alt='$wiersz[0]'>
                                    <h4>$marka $wiersz[0]</h4>
                                    <h4>Cena: $wiersz[1]</h4>
                                </article>";
                        }
                    }

                    mysqli_close($polaczenie);
                ?>
        </section>
    </main>
    <footer>
        <p>Stronę wykonał: 000000000</p>
        <a href="http://firmy.pl/komis">Znajdź nas także</a>
    </footer>
</body>
</html>