<?php
// var_dump($_POST);exit();
include('config.php');

// DSN staat voor data sourcename.
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    echo "Er is een verbinding met de database";
} catch(PDOException $e) {
    echo "Er is helaas geen verbinding met de database.<br>
          Neem contact op met de Administrator<br>";
    echo "Systeemmelding: " . $e->getMessage();
}
// Maak de sql query voor het inserten van een record
$sql = "INSERT INTO pizza   (Id
                            ,Bodemformaat
                            ,Saus
                            ,Pizzatoppings
                            ,Peterselie
                            ,Oregano
                            ,Chiliflakes
                            ,Zwartepeper)
        VALUES              (NULL
                            ,:bodem
                            ,:saus
                            ,:pizzatoppings
                            ,:kruiden1
                            ,:kruiden2
                            ,:kruiden3
                            ,:kruiden4);";
// Maak de query gereed met de prepare-method van het $pdo-object
$statement = $pdo->prepare($sql);
$statement->bindValue(':bodem', $_POST['bodem'], PDO::PARAM_STR);
$statement->bindValue(':saus', $_POST['saus'], PDO::PARAM_STR);
$statement->bindValue(':pizzatoppings', $_POST['pizzatoppings'], PDO::PARAM_STR);
$statement->bindValue(':kruiden1', $_POST['kruiden1'], PDO::PARAM_STR);
$statement->bindValue(':kruiden2', $_POST['kruiden2'], PDO::PARAM_STR);
$statement->bindValue(':kruiden3', $_POST['kruiden3'], PDO::PARAM_STR);
$statement->bindValue(':kruiden4', $_POST['kruiden4'], PDO::PARAM_STR);

// Vuur de query af op de database...
$statement->execute();

// Hiermee sturen we automatisch door naar de pagina read.php
header('Location: read.php');



