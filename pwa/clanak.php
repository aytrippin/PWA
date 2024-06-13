<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Projekt</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="clanak.php">Clanak</a></li>
                <li><a href="kategorija.php?kategorija=sport" class="">Sport</a></li>
                <li><a href="kategorija.php?kategorija=kultura" class="">Kultura</a></li>
                <li><a href="unos.php">Unos</a></li>
                <li><a href="registracija.php">Registracija</a></li>
                <li><a href="administrator.php">Administracija</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <?php
            include 'connect.php';
            define('UPLPATH', 'img/');

            // Dohvaćanje prvog članka iz baze
            $query = "SELECT * FROM vijesti ORDER BY datum DESC LIMIT 1";
            $result = mysqli_query($dbc, $query);

            if ($row = mysqli_fetch_array($result)) {
                echo '<div role="main">
                <div class="row">
                    <h2 class="category"><span>' . $row['kategorija'] . '</span></h2>
                    <h1 class="title">' . $row['naslov'] . '</h1>
                    <p>AUTOR:</p>
                    <p>OBJAVLJENO: <span>' . $row['datum'] . '</span></p>
                </div>
                <div class="slika">
                    <img src="' . UPLPATH . $row['slika'] . '">
                </div>
                <div class="about">
                    <p><i>' . $row['sazetak'] . '</i></p>
                </div>
                <div class="sadrzaj">
                    <p>' . $row['tekst'] . '</p>
                </div>
            </div>';
            } else {
                echo '<p>Članak nije pronađen.</p>';
            }

            mysqli_close($dbc);
            ?>
        </section>
    </main>
    <footer>
        Frankfurter Allgemeine
    </footer>
</body>

</html>