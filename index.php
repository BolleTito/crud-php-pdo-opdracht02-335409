<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maak je eigen pizza!</title>
</head>
<body>
    <h1>Maak je eigen pizza</h1>

    <form action="create.php" method="post">
        <label for="bodem">Bodemformaat</label> <br>
        <select name="bodem" id="bodem"> 
            <option value="">Maak je keuze</option>
            <option value="20cm">20cm</option>
            <option value="25cm">25cm</option>
            <option value="30cm">30cm</option>
            <option value="35cm">35cm</option>
            <option value="40cm">40cm</option>
        </select><br><br>

        <label for="saus">Saus</label> <br>
        <select name="saus" id="saus"> 
            <option value="">Maak je keuze</option>
            <option value="tomatensaus">Tomatensaus</option>
            <option value="extratomatensaus">Extra Tomatensaus</option>
            <option value="spicytomatensaus">Spicy tomatensaus</option>
            <option value="bbq">BBQ saus</option>
            <option value="fraische">Crème fraische</option>
        </select><br><br>

        <p>Pizzatoppings</p>
        <input type="radio" id="vegan" name="pizzatoppings1" value="vegan">
        <label for="vegan">vegan</label><br>
        <input type="radio" id="vegetarisch" name="pizzatoppings2" value="vegetarisch">
        <label for="vegetarisch">vegetarisch</label><br>
        <input type="radio" id="vlees" name="pizzatoppings3" value="vlees">
        <label for="vlees">vlees</label><br><br>

        <p>Kruiden</p>
        <input type="checkbox" id="peterselie" name="kruiden1" value="peterselie">
        <label for="kruiden1"> Peterselie</label><br>
        <input type="checkbox" id="oregano" name="kruiden2" value="oregano">
        <label for="kruiden2"> Oregano</label><br>
        <input type="checkbox" id="chiliflakes" name="kruiden3" value="chiliflakes">
        <label for="kruiden3"> Chili flakes</label><br>
        <input type="checkbox" id="zwartepeper" name="kruiden4" value="zwartepeper">
        <label for="kruiden4"> Zwarte peper</label><br><br>

        <input type="submit" value="Bestel">
    </form>


</body>
</html>