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
                <li><a href="clanak.php">Članak</a></li>
                <li><a href="kategorija.php?kategorija=sport" class="">Sport</a></li>
                <li><a href="kategorija.php?kategorija=kultura" class="">Kultura</a></li>
                <li><a href="unos.php">Unos</a></li>
                <li><a href="registracija.php">Registracija</a></li>
                <li><a href="administrator.php">Administracija</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <hr>
        <h1>Frankfurter Allgemeine Vjesti</h1>
        <br>
        <hr>
        <section>
            <div class="aside">SPORT</div>
            <?php
            $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='sport' LIMIT 3";
            $result = mysqli_query($dbc, $query);
            $i = 0;
            while ($row = mysqli_fetch_array($result)) {
                echo '<article>';
                echo '<div class="article">';
                echo '<div class="sport_img">';
                echo '<img src="' . UPLPATH . $row['slika'] . '">';
                echo '</div>';
                echo '<div class="media_body">';
                echo '<h4 class="title">';
                echo '<a href="clanak.php?id=' . $row['id'] . '">';
                echo $row['naslov'];
                echo '</a></h4>';
                echo '<p class="excerpt">' . $row['sazetak'] . '</p>'; // Dodali smo kratak sadržaj
                echo '</div>';
                echo '</div>';
                echo '</article>';
            } ?>
        </section>
        <section>
            <div class="aside">KULTURA</div>
            <?php
            $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='kultura' LIMIT 3";
            $result = mysqli_query($dbc, $query);
            $i = 0;
            while ($row = mysqli_fetch_array($result)) {
                echo '<article>';
                echo '<div class="article">';
                echo '<div class="kultura_img">';
                echo '<img src="' . UPLPATH . $row['slika'] . '">';
                echo '</div>';
                echo '<div class="media_body">';
                echo '<h4 class="title">';
                echo '<a href="clanak.php?id=' . $row['id'] . '">';
                echo $row['naslov'];
                echo '</a></h4>';
                echo '<p class="excerpt">' . $row['sazetak'] . '</p>'; // Dodali smo kratak sadržaj
                echo '</div>';
                echo '</div>';
                echo '</article>';
            } ?>
        </section>
    </main>
    <footer>
        Frankfurter Allgemeine Vjesti
    </footer>
</body>

</html>