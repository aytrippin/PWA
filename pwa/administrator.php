<?php
include 'connect.php';
session_start();

if (!isset($_SESSION['korisnik'])) {
    echo "Morate se prijaviti. <a href='login.php'>Prijavi se</a>";
    exit();
}

$korisnik = $_SESSION['korisnik'];

if ($korisnik['administratorska_prava'] == 0) {
    echo "Pozdrav, " . $korisnik['ime'] . ". Nemate administratorska prava.";
    exit();
}
// Provjeri je li korisnik prijavljen
if (!isset($_SESSION['korisnik'])) {
    header('Location: login.php');
    exit();
}

// Odjava korisnika
if (isset($_POST['logout'])) {
    session_unset();    // Unisti sve varijable sesije
    session_destroy();  // Unisti sesiju
    header('Location: login.php');
    exit();
}
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
                <li>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <button type="submit" name="logout">Odjava</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <?php
            include 'connect.php';
            define('UPLPATH', 'img/');

            // Brisanje vijesti
            if (isset($_POST['delete'])) {
                $id = $_POST['id'];
                $query = "DELETE FROM vijesti WHERE id=$id";
                $result = mysqli_query($dbc, $query);
            }

            // Ažuriranje vijesti
            if (isset($_POST['update'])) {
                $picture = $_FILES['pphoto']['name'];
                $title = $_POST['title'];
                $about = $_POST['about'];
                $content = $_POST['content'];
                $category = $_POST['category'];
                $archive = isset($_POST['archive']) ? 1 : 0;

                // Ako je nova slika dodana, premjesti je u direktorij
                if ($picture) {
                    $target_dir = 'img/' . $picture;
                    move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
                } else {
                    $picture = $_POST['existing_image']; // koristi postojeću sliku ako nije dodana nova
                }

                $id = $_POST['id'];
                $query = "UPDATE vijesti SET naslov='$title', sazetak='$about', tekst='$content', slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id";
                $result = mysqli_query($dbc, $query);
            }

            // Dohvaćanje svih vijesti iz baze
            $query = "SELECT * FROM vijesti";
            $result = mysqli_query($dbc, $query);

            while ($row = mysqli_fetch_array($result)) {
                echo '<form enctype="multipart/form-data" action="" method="POST">
        <div class="form-item">
            <label for="title">Naslov vijesti:</label>
            <div class="form-field">
                <input type="text" name="title" class="form-field-textual" value="' . $row['naslov'] . '">
            </div>
        </div>
        <div class="form-item">
            <label for="about">Kratki sadržaj vijesti (do 50 znakova):</label>
            <div class="form-field">
                <textarea name="about" cols="30" rows="10" class="form-field-textual">' . $row['sazetak'] . '</textarea>
            </div>
        </div>
        <div class="form-item">
            <label for="content">Sadržaj vijesti:</label>
            <div class="form-field">
                <textarea name="content" cols="30" rows="10" class="form-field-textual">' . $row['tekst'] . '</textarea>
            </div>
        </div>
        <div class="form-item">
            <label for="pphoto">Slika:</label>
            <div class="form-field">
                <input type="file" class="input-text" id="pphoto" name="pphoto"/>
                <input type="hidden" name="existing_image" value="' . $row['slika'] . '"/>
                <br><img src="' . UPLPATH . $row['slika'] . '" width=100px>
            </div>
        </div>
        <div class="form-item">
            <label for="category">Kategorija vijesti:</label>
            <div class="form-field">
                <select name="category" class="form-field-textual">
                    <option value="sport" ' . ($row['kategorija'] == 'sport' ? 'selected' : '') . '>Sport</option>
                    <option value="kultura" ' . ($row['kategorija'] == 'kultura' ? 'selected' : '') . '>Kultura</option>
                    <option value="politika" ' . ($row['kategorija'] == 'politika' ? 'selected' : '') . '>Politika</option>
                    <option value="zabava" ' . ($row['kategorija'] == 'zabava' ? 'selected' : '') . '>Zabava</option>
                </select>
            </div>
        </div>
        <div class="form-item">
            <label>Spremiti u arhivu:
            <div class="form-field">';
                if ($row['arhiva'] == 0) {
                    echo '<input type="checkbox" name="archive" id="archive"/> Arhiviraj?';
                } else {
                    echo '<input type="checkbox" name="archive" id="archive" checked/> Arhiviraj?';
                }
                echo '</div>
            </label>
        </div>
        <div class="form-item">
            <input type="hidden" name="id" class="form-field-textual" value="' . $row['id'] . '">
            <button type="reset" value="Poništi">Poništi</button>
            <button type="submit" name="update" value="Prihvati">Izmjeni</button>
            <button type="submit" name="delete" value="Izbriši">Izbriši</button>
        </div>
        </form>';
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