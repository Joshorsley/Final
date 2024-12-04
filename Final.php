<?php
session_start();
?>
<!--
FILE : Final.php
PROJECT : PROG2001 - Final - SET Pizza Shop
PROGRAMMER : Josh Horsley | Josh Rice
FIRST VERSION : 2024-12-02
DESCRIPTION : 
-->
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Hi-Lo Game (Revisited)</title>
        <link rel="stylesheet" href="Final.css">
        <script src="Final.js" defer></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lacquer&family=Miniver&family=Oswald:wght@200..700&family=Parkinsans:wght@300..800&family=Permanent+Marker&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    </head>
    <body>
    </body>

    <?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(!isset($_SESSION["fullName"])) {
        $fullName = htmlspecialchars($_POST["fullName"]);
        $nameParts = explode(" ",$fullName);
        $_SESSION['firstName'] = $nameParts[0];
        $_SESSION['fullName'] = $fullName;
        printForm_Page2($_SESSION['firstName'],"");
    } else {
        if (isset($_POST["toppings"])) {
            $_SESSION["selectedToppings"] = $_POST["toppings"];
        } else {
            $_SESSION["selectedToppings"] = [];
        }
    }


}
else
{
    echo"<div class=\"warning\">Mama Mia thats a spicy meatball! Direct access is prohibited.</div>";
}

function printForm_Page2($firstName, $errorMsg) {
    $toppingForm = <<<HTML
    <form id="page2" method="POST" action="Final.php">
        <div class="title-container">
            <img id="left-side" src="Resources/sideimage.png">
            <h1><img id="pizza" src="Resources/pizza.png" alt="Pizza Logo">SET Pizza Shop</h1>
            <img id="right-side" src="Resources/sideimage.png">
        </div>
        <div class="toppingChoice">
            <h2 id="greeting">Ciao $firstName! <img id="hand" src="Resources/italian.png"></h2>
            <p>At the SET Pizza Shop You get ONE Pizza and we only make em ONE Size!<br>
            ALL PIZZAS COME WITH SAUCE AND CHEESE!</p>
            <p>These are the only toppings we got, you don't like em go somewheres else</p>
            <div class="toppings">
                <p>Select your toppings:</p>
                <form id="toppingForm" method="POST">
                    <label>
                        <input type="checkbox" name="toppings[]" value="pepperoni" class="topping"> Pepperoni ($1.50)
                    </label><br>
                    <label>
                        <input type="checkbox" name="toppings[]" value="mushrooms" class="topping"> Mushrooms ($1.00)
                    </label><br>
                    <label>
                        <input type="checkbox" name="toppings[]" value="greenOlives" class="topping"> Green Olives ($1.00)
                    </label><br>
                    <label>
                        <input type="checkbox" name="toppings[]" value="greenPeppers" class="topping"> Green Peppers ($1.00)
                    </label><br>
                    <label>
                        <input type="checkbox" name="toppings[]" value="doubleCheese" class="topping"> Double Cheese ($2.25)
                    </label><br>
                    <p>Total Price: $<span id="totalPrice">0.00</span></p>
                    <button type="submit">Make It!</button>
                    <p id="Error" class="errorMessage">$errorMsg</p>
                </form>
            </div>
        </div>
    </form>
HTML;

    echo $toppingForm;
}
    ?>