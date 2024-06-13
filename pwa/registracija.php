<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = password_hash($_POST['lozinka'], PASSWORD_DEFAULT);
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email = $_POST['email'];
    $administratorska_prava = isset($_POST['administratorska_prava']) ? 1 : 0;

    $query = "INSERT INTO korisnik (korisnicko_ime, lozinka, ime, prezime, email, administratorska_prava) 
              VALUES ('$korisnicko_ime', '$lozinka', '$ime', '$prezime', '$email', '$administratorska_prava')";
    $result = mysqli_query($dbc, $query) or die('Error querying database.');

    mysqli_close($dbc);
    echo "Registracija uspješna. Možete se prijaviti.";
}
?>

<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Registracija</title>
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
            <h2>Registracija</h2>
            <form action="registracija.php" method="post">
                <label for="korisnicko_ime">Korisničko ime:</label><br>
                <input type="text" id="korisnicko_ime" name="korisnicko_ime" required><br><br>

                <label for="lozinka">Lozinka:</label><br>
                <input type="password" id="lozinka" name="lozinka" required><br><br>

                <label for="ime">Ime:</label><br>
                <input type="text" id="ime" name="ime" required><br><br>

                <label for="prezime">Prezime:</label><br>
                <input type="text" id="prezime" name="prezime" required><br><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br><br>

                <label for="administratorska_prava">Administratorska prava:</label>
                <input type="checkbox" id="administratorska_prava" name="administratorska_prava"><br><br>

                <input type="submit" value="Registriraj se">
            </form>
        </div>
    </main>
    <footer>
        Frankfurter Allgemeine
    </footer>
</body>

</html>