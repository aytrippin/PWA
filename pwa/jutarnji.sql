CREATE TABLE IF NOT EXISTS vijesti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    datum DATE,
    naslov VARCHAR(255) NOT NULL,
    sazetak TEXT NOT NULL,
    tekst TEXT NOT NULL,
    slika VARCHAR(255),
    kategorija VARCHAR(100),
    arhiva TINYINT(1) DEFAULT 0
);
CREATE TABLE korisnik (
    id INT AUTO_INCREMENT PRIMARY KEY,
    korisnicko_ime VARCHAR(50) NOT NULL,
    lozinka VARCHAR(255) NOT NULL,
    ime VARCHAR(50),
    prezime VARCHAR(50),
    email VARCHAR(100),
    administratorska_prava BOOLEAN NOT NULL DEFAULT 0
);

