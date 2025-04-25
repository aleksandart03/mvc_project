# MVC Store Project

Ovaj projekat je PHP MVC aplikacija koja simulira online prodavnicu sa funkcionalnostima kao što su prijava korisnika, registracija, administracija proizvoda i korpa.

## Kako da se povežete sa bazom podataka

Da biste pokrenuli projekat i povezali se sa bazom podataka, pratite sledeće korake:

### 1. Kreiranje baze podataka

1. Preuzmite SQL dump fajl sa [mvc_project.sql](database/mvc_project.sql).
2. Kreirajte novu bazu podataka na svom MySQL serveru:
   - Ako koristite **phpMyAdmin**:
     - Kreirajte bazu podataka pod imenom `mvc_project`.
     - Importujte `mvc_project.sql` dump fajl.
   - Ako koristite **MySQL CLI**:
     - Kreirajte bazu podataka pomoću sledeće komande:
       ```bash
       CREATE DATABASE mvc_project;
       ```
     - Zatim importujte SQL dump:
       ```bash
       mysql -u your_username -p mvc_project < path_to_mvc_project.sql
       ```

### 2. Konfiguracija za povezivanje sa bazom

Da biste povezali aplikaciju sa bazom podataka, izmenite sledeće parametre u `config/database.php` fajlu:

```php
define('DB_HOST', 'localhost');    // Server baze podataka
define('DB_NAME', 'mvc_project');  // Ime baze podataka
define('DB_USER', 'your_username'); // Vaše korisničko ime za bazu
define('DB_PASS', 'your_password'); // Vaš password za bazu
