<?php
include 'connect.php'; // Uključivanje datoteke za spajanje na bazu podataka

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Provjera jesu li svi potrebni podaci poslani iz forme
    if (isset($_POST['title']) && isset($_POST['about']) && isset($_POST['content']) && isset($_POST['category'])) {

        // Priprema podataka za unos u bazu
        $title = $_POST['title'];
        $about = $_POST['about'];
        $content = $_POST['content'];
        $category = $_POST['category'];
        $archive = isset($_POST['archive']) ? 1 : 0;
        $date = date('Y-m-d');

        // Upload slike
        $picture = $_FILES['pphoto']['name'];
        $target_dir = 'img/' . $picture;
        move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);

        // SQL upit za unos novosti
        $query = "INSERT INTO vijesti (datum, naslov, sazetak, tekst, slika, kategorija, arhiva) 
                  VALUES ('$date', '$title', '$about', '$content', '$picture', '$category', '$archive')";

        // Izvršavanje upita
        $result = mysqli_query($dbc, $query) or die('Error querying database.');

        // Zatvaranje veze s bazom
        mysqli_close($dbc);

        // Uspješan unos
        echo '<script>alert("Novost je uspješno objavljena.");</script>';
    } else {
        // Neispravni ili nedostajući podaci
        echo '<script>alert("Molimo provjerite unos podataka.");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unos novosti</title>
    <link rel="stylesheet" href="style.css">
    <script src="validate.js" defer></script>
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
        <hr>
        <div class="con1">
            <h2>Unos novosti</h2>
            <form id="newsForm" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="title">Naslov:</label><br>
                <input type="text" id="title" name="title"><br><br>
                <span id="titleError" class="error-message"></span><br>

                <label for="about">Kratki sadržaj (do 50 znakova):</label><br>
                <textarea id="about" name="about" rows="4"></textarea><br><br>
                <span id="aboutError" class="error-message"></span><br>

                <label for="content">Sadržaj:</label><br>
                <textarea id="content" name="content" rows="10"></textarea><br><br>
                <span id="contentError" class="error-message"></span><br>

                <label for="pphoto">Slika:</label><br>
                <input type="file" id="pphoto" name="pphoto"><br><br>
                <span id="photoError" class="error-message"></span><br>

                <label for="category">Kategorija:</label><br>
                <select id="category" name="category">
                    <option value="">Odaberite kategoriju</option>
                    <option value="sport">Sport</option>
                    <option value="kultura">Kultura</option>
                    <option value="politika">Politika</option>
                    <option value="zabava">Zabava</option>
                </select><br><br>
                <span id="categoryError" class="error-message"></span><br>

                <input type="checkbox" id="archive" name="archive">
                <label for="archive">Arhiva</label><br><br>

                <input type="submit" value="Objavi vijest">
            </form>
        </div>
    </main>
    <footer>
        Frankfurter Allgemeine
    </footer>
</body>

</html>