<?php
include 'connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];

    $query = "SELECT * FROM korisnik WHERE korisnicko_ime = '$korisnicko_ime'";
    $result = mysqli_query($dbc, $query) or die('Error querying database.');

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($lozinka, $row['lozinka'])) {
            $_SESSION['korisnik'] = $row;
            header('Location: administrator.php');
        } else {
            $error_message = "Neispravno korisničko ime ili lozinka.";
        }
    } else {
        $error_message = "Neispravno korisničko ime ili lozinka.";
    }

    mysqli_close($dbc);
}
?>

<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Prijava</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="clanak.php">Članak</a></li>
                <li><a href="kategorija.php?kategorija=sport">Sport</a></li>
                <li><a href="kategorija.php?kategorija=kultura">Kultura</a></li>
                <li><a href="unos.php">Unos</a></li>
                <li><a href="registracija.php">Registracija</a></li>
                <li><a href="administrator.php">Administracija</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="con1">
            <h2>Prijava</h2>
            <form action="login.php" method="post">
                <?php
                if (isset($error_message)) {
                    echo '<div style="color: red;">' . $error_message . '</div>';
                }
                ?>
                <label for="korisnicko_ime">Korisničko ime:</label><br>
                <input type="text" id="korisnicko_ime" name="korisnicko_ime" required><br><br>

                <label for="lozinka">Lozinka:</label><br>
                <input type="password" id="lozinka" name="lozinka" required><br><br>

                <input type="submit" value="Prijavi se">
            </form>
        </div>
    </main>
    <footer>
        Frankfurter Allgemeine
    </footer>
</body>

</html>