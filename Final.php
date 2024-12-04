<?php
session_start();
?>
<!--
FILE : A03.php
PROJECT : PROG2001 - Final - SET Pizza Shop
PROGRAMMER : Josh Horsley | Josh Rice
FIRST VERSION : 2024-10-018
DESCRIPTION :  This file contains the PHP logic for the Hi-Lo game. It takes user input from forms, including the player's name and 
the maximum guess number. It validates user guesses, provides feedback on guesses, and includes the ability to play again. 
Error handling is included for invalid inputs, and direct access to the page is restricted.
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
        $_SESSION["fullName"] = $fullName;
        printForm_Page2($_SESSION['fullName'],"");
    }


}
else
{
    echo"<div class=\"warning\">Mama Mia thats a spicy meatball! Direct access is prohibited.</div>";
}

function printForm_Page2($fullName, $errorMsg){
    echo" <form id= \"page2\" method=\"POST\" action=\"Final.php\">
            <div class = \"title-container\">
                <img id=\"left-side\" src=\"Resources/sideimage.png\">
                <h1><img id=\"pizza\" src=\"Resources/pizza.png\" alt=\"Pizza Logo\">SET Pizza Shop</h1>
                <img id=\"right-side\" src=\"Resources/sideimage.png\">
            </div>
            <div class=\"toppingChoice\">
                <h2 id=\"greeting\">Ciao $fullName!<img id=\"hand\" src=\"Resources/italian.png\"></h2>
                <p>At the SET Pizza Shop You get ONE Pizza and we only make em ONE Size!<br>
                ALL PIZZAS COME WITH SAUCE AND CHEESE!</p>

               <p>These are the only toppings we got, you don't like em go somewheres else</p>
<form>
<div class=\"ingredients\">
    <input type=\"checkbox\" id=\"pepperoni\" name=\"pepperoni\" value=\"pepperoni\">
    <label for=\"pepperoni\">
        <img src=\"Resources/pepperoni.png\" alt=\"Pepperoni\" style=\"width: 20px; height: 20px; margin-right: 8px;\">
        Pepperoni ($1.50)
    </label><br>

    <input type=\"checkbox\" id=\"mushrooms\" name=\"mushrooms\" value=\"mushrooms\">
    <label for=\"mushrooms\">
        <img src=\"Resources/mushroom.png\" alt=\"Mushrooms\" style=\"width: 20px; height: 20px; margin-right: 8px;\">
        Mushrooms ($1.00)
    </label><br>

    <input type=\"checkbox\" id=\"greenOlives\" name=\"greenOlives\" value=\"greenOlives\">
    <label for=\"greenOlives\">
        <img src=\"Resources/olives.png\" alt=\"Green Olives\" style=\"width: 20px; height: 20px; margin-right: 8px;\">
        Green Olives ($1.00)
    </label><br>

    <input type=\"checkbox\" id=\"greenPeppers\" name=\"greenPeppers\" value=\"greenPeppers\">
    <label for=\"greenPeppers\">
        <img src=\"Resources/capsicum.png\" alt=\"Green Peppers\" style=\"width: 20px; height: 20px; margin-right: 8px;\">
        Green Peppers ($1.00)
    </label><br>

    <input type=\"checkbox\" id=\"doubleCheese\" name=\"doubleCheese\" value=\"doubleCheese\">
    <label for=\"doubleCheese\">
        <img src=\"Resources/cheese.png\" alt=\"Double Cheese\" style=\"width: 20px; height: 20px; margin-right: 8px;\">
        Double Cheese ($2.25)
    </label><br>
        </div> 
    <p id=\"Error\" class=\"errorMessage\">$errorMsg</p>
    <button type=\"submit\">Make It!</button>
          
    </div>
        </form>";
}  
    ?>