<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motocykle</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <img src="motor.png" alt="motocykl" id="motor">
    <header>
        <h1>Motocykle - moja pasja</h1>
    </header>
    <main>
        <section id="lewy">
            <h2>Gdzie pojechać?</h2>
            <dl>
                <?php
                    $polaczenie = mysqli_connect("localhost", "root", "", "motory");

                    $zapytanie = "SELECT nazwa, opis, poczatek, zdjecia.zrodlo FROM wycieczki JOIN zdjecia ON zdjecia_id = zdjecia.id;";

                    $wynik = mysqli_query($polaczenie, $zapytanie);

                    while ($wiersz = mysqli_fetch_array($wynik)) {
                        echo "<dt>$wiersz[0] rozpoczyna się w $wiersz[2] <a href='$wiersz[3].jpg'>zobacz zdjęcie</a></dt>
                        <dd>$wiersz[1]</dd>";
                    }
                    mysqli_close($polaczenie);
                ?>
            </dl>
        </section>
        <section class="prawy">
            <h2>Co kupić?</h2>
            <ol>
                <li>Honda CBR125R</li>
                <li>Yamaha YBR125</li>
                <li>Honda VFR800i</li>
                <li>Honda CBR1100XX</li>
                <li>BMW R1200GS LC</li>
            </ol>
        </section>
        <section class="prawy">
            <h2>Statystyki</h2>
            <p>Wpisanych wycieczek:
            <?php
                $polaczenie = mysqli_connect("localhost", "root", "", "motory");

                $zapytanie = "SELECT COUNT(*) FROM wycieczki;";

                $wynik = mysqli_query($polaczenie, $zapytanie);

                while ($wiersz = mysqli_fetch_array($wynik)) {
                    echo $wiersz[0];
                }

                mysqli_close($polaczenie);
            ?></p>
            <p>Użytkowników forum: 200</p>
            <p>Przesłanych zdjęć: 1300</p>
        </section>
    </main>
    <footer>
        <p>Stronę wykonał: 000000000</p>
    </footer>
</body>
</html>