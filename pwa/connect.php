<?php
header('Content-Type: text/html; charset=utf-8');

$servername = "localhost";
$username = "root";
$password = "";
$basename = "jutarnji";

// Stvaranje veze s bazom podataka
$dbc = mysqli_connect($servername, $username, $password, $basename);

// Provjera veze
if (!$dbc) {
    die('Greška pri spajanju na MySQL server: ' . mysqli_connect_error());
}

mysqli_set_charset($dbc, "utf8");
