<?php
include 'connect.php';
define('UPLPATH', 'img/');
?>





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
        <?php
        // Dohvaćanje kategorije iz URL-a
        $kategorija = $_GET['kategorija'];

        // SQL upit za dohvaćanje vijesti iz odabrane kategorije koje nisu arhivirane
        $query = "SELECT * FROM vijesti WHERE kategorija='$kategorija' AND arhiva=0";
        $result = mysqli_query($dbc, $query);

        echo '<section class="vijesti">';
        while ($row = mysqli_fetch_array($result)) {
            echo '<article>';
            echo '<div class="article">';
            echo '<div class="sport_img">';
            echo '<img src="' . UPLPATH . $row['slika'] . '" alt="slika">';
            echo '</div>';
            echo '<div class="media_body">';
            echo '<h4 class="title">';
            echo '<a href="clanak.php?id=' . $row['id'] . '">';
            echo $row['naslov'];
            echo '</a></h4>';
            echo '<p>' . $row['sazetak'] . '</p>';
            echo '</div></div>';
            echo '</article>';
        }
        echo '</section>';

        mysqli_close($dbc);
        ?>
    </main>
    <footer>
        Frankfurter Allgemeine Vjesti
    </footer>
</body>

</html>