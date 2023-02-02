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
        $sql = "UPDATE Pizza
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
        $statement->bindValue(':Peterselie', $_POST['peterselie'], PDO::PARAM_STR);
        $statement->bindValue(':Oregano', $_POST['oregano'], PDO::PARAM_STR);
        $statement->bindValue(':Chiliflakes', $_POST['chiliflakes'], PDO::PARAM_STR);
        $statement->bindValue(':Zwartepeper', $_POST['zwartepeper'], PDO::PARAM_STR);

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
$sql = "SELECT * FROM Pizza 
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

        <label for="bodem">Bodemformaat:</label><br>
        <input type="text" name="bodem" id="bodem" value="<?php echo $result->Bodemformaat; ?>"><br><br>

        <label for="saus">Saus:</label><br>
        <input type="text" name="saus" id="saus" value="<?php echo $result->Saus; ?>"><br><br>

        <label for="">Pizzatoppings:</label><br>
        <input type="radio" name="pizzatoppings" id="" value="<?php echo $result->Pizzatoppings; ?>"><br><br>

        <label for="peterselie">Peterselie:</label><br>
        <input type="checkbox" name="peterselie" id="peterselie" value="<?php echo $result->Peterselie; ?>"><br><br>

        <label for="oregano">Oregano:</label><br>
        <input type="checkbox" name="oregano" id="oregano" value="<?php echo $result->Oregano; ?>"><br><br>

        <label for="chilipeper">Chilipeper:</label><br>
        <input type="checkbox" name="chilipeper" id="chilipeper" value="<?php echo $result->Chiliflakes; ?>"><br><br>
        
        <label for="zwartepeper">Zwartepeper:</label><br>
        <input type="checkbox" name="zwartepeper" id="zwartepeper" value="<?php echo $result->Zwartepeper; ?>"><br><br>

        <input type="hidden" name="Id" value="<?php echo $result->Id; ?>">

        <input type="submit" value="Verstuur">
    </form>
</body>
</html>