# Požadavky
  Docker
  Git

# Přihlašovací údaje
  MYSQL databáze
    **Jméno:** root
    **Heslo:** root
  Aplikace
    **Jméno:** admin
    **Heslo:** heslo


# Instalace a konfigurace
  ## Klonování repozitáře
    git clone https://github.com/Nguyen-programko/WebSite.git
    cd WebSite
  ## Spuštění kontejnerů
    docker-compose up -d
  ## Linky
    Aplikace:   http://localhost:8080
    phpMyAdmin: http://localhost:8081
  ## Zastavení 
    docker-compose down -v

## Úprava přihlašovacích údajů
Přihlašovací údaje aplikace lze změnit v booksdb.sql přidáním nebo změny záznamu. (heslo musí být hash z PHP)
    INSERT INTO `users` (`ID`, `username`, `password`) VALUES 
    (1, 'Admin', '$2y$10$OiKMnY19hGET7WidMyC/HOwWJKT6nDkeuZeGDgIIWIJiTM0xMxtz2');

## Heslo MYSQL databáze lze změnít v docker-compose.yml
    mysql:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: Zde heslo
      
  ### Pokud se změní heslo je třeba upravit "src\classes\database.class.php"
    <?php 
    $db_server = "mysql";
    $db_user = "root";
    $db_pass = "tvoje heslo";
    $db_name = "booksdb";
    $connection = "";
    $connection = mysqli_connect($db_server,$db_user,$db_pass,$db_name);
