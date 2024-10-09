<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poziomy rzek</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <section class="baner">
            <img src="obraz1.png" alt="Mapa Polski">
        </section>
        <section class="baner">
            <h1>Rzeki w województwie dolnośląskim</h1>
        </section>
    </header>
    <nav>
        <form action="poziomRzek.php" method="post">
            <label class="opcje">
                <input type="radio" name="rodzaj" id="wszystkie" value="wszystkie">Wszystkie
            </label>
            <label class="opcje">
                <input type="radio" name="rodzaj" id="ponadStanO" value="ponadStanO">Ponad stan ostrzegawczy
            </label>
            <label class="opcje">
                <input type="radio" name="rodzaj" id="ponadStanA" value="ponadStanA">Ponad stan alarmowy
            </label>
            <input type="submit" value="Pokaż">
        </form>
    </nav>
    <main>
        <section id="lewy">
            <h3>Stany na dzień 2022-05-05</h3>
            <table>
                <tr>
                    <th>Wodomierz</th>
                    <th>Rzeka</th>
                    <th>Ostrzegawczy</th>
                    <th>Alarmowy</th>
                    <th>Aktualny</th>
                </tr>
                <?php
                    $polaczenie = mysqli_connect("localhost", "root", "", "rzeki");
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $rodzaj = $_POST["rodzaj"];

                        if ($rodzaj == "wszystkie") {
                            $zapytanie = "SELECT nazwa, rzeka, stanOstrzegawczy, stanAlarmowy, pomiary.stanWody FROM wodowskazy JOIN pomiary ON wodowskazy.id = pomiary.wodowskazy_id WHERE pomiary.dataPomiaru = '2022-05-05';";

                            $wynik = mysqli_query($polaczenie, $zapytanie);

                            while ($wiersz = mysqli_fetch_array($wynik)) {
                                echo "<tr>
                                        <td>$wiersz[0]</td>
                                        <td>$wiersz[1]</td>
                                        <td>$wiersz[2]</td>
                                        <td>$wiersz[3]</td>
                                        <td>$wiersz[4]</td>
                                    </tr>";
                            }

                        }
                        elseif ($rodzaj == "ponadStanO") {
                            $zapytanie = "SELECT nazwa, rzeka, stanOstrzegawczy, stanAlarmowy, pomiary.stanWody FROM wodowskazy JOIN pomiary ON wodowskazy.id = pomiary.wodowskazy_id WHERE pomiary.dataPomiaru = '2022-05-05' AND pomiary.stanWody > stanOstrzegawczy;";

                            $wynik = mysqli_query($polaczenie, $zapytanie);

                            while ($wiersz = mysqli_fetch_array($wynik)) {
                                echo "<tr>
                                        <td>$wiersz[0]</td>
                                        <td>$wiersz[1]</td>
                                        <td>$wiersz[2]</td>
                                        <td>$wiersz[3]</td>
                                        <td>$wiersz[4]</td>
                                    </tr>";
                            }
                        }
                        elseif ($rodzaj == "ponadStanA") {
                            $zapytanie = "SELECT nazwa, rzeka, stanOstrzegawczy, stanAlarmowy, pomiary.stanWody FROM wodowskazy JOIN pomiary ON wodowskazy.id = pomiary.wodowskazy_id WHERE pomiary.dataPomiaru = '2022-05-05' AND pomiary.stanWody > stanAlarmowy;";

                            $wynik = mysqli_query($polaczenie, $zapytanie);

                            while ($wiersz = mysqli_fetch_array($wynik)) {
                                echo "<tr>
                                        <td>$wiersz[0]</td>
                                        <td>$wiersz[1]</td>
                                        <td>$wiersz[2]</td>
                                        <td>$wiersz[3]</td>
                                        <td>$wiersz[4]</td>
                                    </tr>";
                            }
                        }
                    }
                    mysqli_close($polaczenie);
                ?>
            </table>
        </section>
        <section id="prawy">
            <h3>Informacje</h3>
            <ul>
                <li>Brak ostrzeżeń o burzach z gradem</li>
                <li>Smog w mieście Wrocław</li>
                <li>Silny wiatr w Karkonoszach</li>
            </ul>
            <h3>Średnie stany wód</h3>
            <?php
                $polaczenie = mysqli_connect("localhost", "root", "", "rzeki");

                $zapytanie = "SELECT dataPomiaru, AVG(stanWody) FROM pomiary GROUP BY dataPomiaru;";

                $wynik = mysqli_query($polaczenie, $zapytanie);

                while ($wiersz = mysqli_fetch_array($wynik)) {
                    echo "<p>$wiersz[0]: $wiersz[1]</p>";
                }

                mysqli_close($polaczenie);
            ?>
            <a href="https://komunikaty.pl">Dowiedz się więcej</a>
            <img src="obraz2.jpg" alt="rzeka">
        </section>
    </main>
    <footer>
        <p>Stronę wykonał: 000000000</p>
    </footer>
</body>
</html>