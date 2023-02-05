<?php
// Voeg de database-gegevens
require('config.php');

// Maak de $dsn oftewel de data sourcename string
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    // Maak een nieuw PDO object zodat je verbinding hebt met de mysql database
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        // echo "Verbinding is gelukt";
    } else {
        echo "Interne server-error";
    }
} catch (PDOException $e) {
    $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo "skdf";exit();
    try {
        // Maak een update query voor het updaten van een record
        $sql = "UPDATE pizza
                SET Bodemformaat = :Bodemformaat,
                    Saus = :Saus,
                    Pizzatoppings = :Pizzatoppings,
                    Peterselie = :Peterselie,
                    Oregano = :Oregano,
                    Chiliflakes = :Chiliflakes,
                    Zwartepeper = :Zwartepeper
                WHERE Id = :Id";

        // Roep de prepare-method aan van het PDO-object $pdo
        $statement = $pdo->prepare($sql);

        // We moeten de placeholders een waarde geven in de sql-query
        $statement->bindValue(':Id', $_POST['Id'], PDO::PARAM_INT);
        $statement->bindValue(':Bodemformaat', $_POST['bodem'], PDO::PARAM_STR);
        $statement->bindValue(':Saus', $_POST['saus'], PDO::PARAM_STR);
        $statement->bindValue(':Pizzatoppings', $_POST['pizzatoppings'], PDO::PARAM_STR);
        $statement->bindValue(':Peterselie', $_POST['kruiden1'], PDO::PARAM_STR);
        $statement->bindValue(':Oregano', $_POST['kruiden2'], PDO::PARAM_STR);
        $statement->bindValue(':Chiliflakes', $_POST['kruiden3'], PDO::PARAM_STR);
        $statement->bindValue(':Zwartepeper', $_POST['kruiden4'], PDO::PARAM_STR);

        // We gaan de query uitvoeren op de mysql-server
        $statement->execute();

        echo "Het record is geupdate";
        header("Refresh:3; read.php");

    } catch(PDOException $e) {
        echo "Het record is niet geupdate";
        header("Refresh:3; read.php");
    }
    exit();
}

// Maak een select-query
$sql = "SELECT * FROM pizza 
        WHERE Id = :Id";

// Voorbereiden van de query
$statement = $pdo->prepare($sql);

$statement->bindValue(':Id', $_GET['Id'], PDO::PARAM_INT);

$statement->execute();

$result = $statement->fetch(PDO::FETCH_OBJ);

// var_dump($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <title>PDO CRUD</title>
</head>
<body>
    <h1>PDO CRUD</h1>

    <form action="update.php" method="post">
        <label for="bodem">Bodemformaat</label> <br>
        <select name="bodem" id="bodem"> 
            <option value="">Maak je keuze</option>
            <option value="<?php echo $result->Bodemformaat;?>">20cm</option>
            <option value="<?php echo $result->Bodemformaat;?>">25cm</option>
            <option value="<?php echo $result->Bodemformaat;?>">30cm</option>
            <option value="<?php echo $result->Bodemformaat;?>">35cm</option>
            <option value="<?php echo $result->Bodemformaat;?>">40cm</option>
        </select><br><br>

        <label for="saus">Saus</label> <br>
        <select name="saus" id="saus"> 
            <option value="">Maak je keuze</option>
            <option value="<?php echo $result->Saus;?>">Tomatensaus</option>
            <option value="<?php echo $result->Saus;?>">Extra Tomatensaus</option>
            <option value="<?php echo $result->Saus;?>">Spicy tomatensaus</option>
            <option value="<?php echo $result->Saus;?>">BBQ saus</option>
            <option value="<?php echo $result->Saus;?>">Crème fraische</option>
        </select><br><br>

        <p>Pizzatoppings</p>
        <input type="radio" id="pizzatoppings" name="pizzatoppings" value="<?php echo $result->Pizzatoppings;?>">
        <label for="pizzatoppings">vegan</label><br>

        <input type="radio" id="pizzatoppings" name="pizzatoppings" value="<?php echo $result->Pizzatoppings;?>">
        <label for="pizzatoppings">vegetarisch</label><br>

        <input type="radio" id="pizzatoppings" name="pizzatoppings" value="<?php echo $result->Pizzatoppings;?>">
        <label for="pizzatoppings">vlees</label><br><br>

        <p>Kruiden</p>
        <input type="checkbox" id="kruiden1" name="kruiden1" value="<?php echo $result->Peterselie;?>">
        <label for="kruiden1"> Peterselie</label><br>

        <input type="checkbox" id="kruiden2" name="kruiden2" value="<?php echo $result->Oregano;?>">
        <label for="kruiden2"> Oregano</label><br>

        <input type="checkbox" id="kruiden3" name="kruiden3" value="<?php echo $result->Chiliflakes;?>">
        <label for="kruiden3"> Chili flakes</label><br>

        <input type="checkbox" id="kruiden4" name="kruiden4" value="<?php echo $result->Zwartepeper;?>">
        <label for="kruiden4"> Zwarte peper</label><br>

        <input type="hidden" name="Id" value="<?php echo $result->Id;?>">

        <input type="submit" value="Bestel">
    </form>
</body>
</html>