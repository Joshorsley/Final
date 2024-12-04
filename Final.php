<?php
session_start();
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SET Pizza</title>
        <link rel="stylesheet" href="Final.css">
        <script src="jquery-3.7.1.js"></script>
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
    }
     
}
else
{
    echo"<div class=\"warning\">Mama Mia thats a spicy meatball! Direct access is prohibited.</div>";
}

function printForm_Page2($firstName, $errorMsg) {
    $toppingForm = <<<HTML
    <form id="toppingForm" method="POST" action="Final.php">
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
                <label>
                    <input type="checkbox" id="pepperoni" name="toppings[]" value="pepperoni" class="topping"> Pepperoni ($1.50)
                </label><br>
                <label>
                    <input type="checkbox" id="mushrooms" name="toppings[]" value="mushrooms" class="topping"> Mushrooms ($1.00)
                </label><br>
                <label>
                    <input type="checkbox" id="greenOlives" name="toppings[]" value="greenOlives" class="topping"> Green Olives ($1.00)
                </label><br>
                <label>
                    <input type="checkbox" id="greenPeppers" name="toppings[]" value="greenPeppers" class="topping"> Green Peppers ($1.00)
                </label><br>
                <label>
                    <input type="checkbox" id="doubleCheese" name="toppings[]" value="doubleCheese" class="topping"> Double Cheese ($2.25)
                </label><br>
                <p>Total Price: $<span id="totalPrice">10.00</span></p>
            </div>
            <button type="submit">Make It!</button>
            <p id="Error" class="errorMessage">$errorMsg</p>
        </div>
    </form>
HTML;

    echo $toppingForm;
}

function printForm_Page3($firstName, $errorMsg) {
    // Get the toppings and total price from the session
    $toppings = $_SESSION['toppings'];
    $totalPrice = $_SESSION['totalPrice'];

    $toppingNames = [
        "pepperoni" => "Pepperoni",
        "mushrooms" => "Mushrooms",
        "greenOlives" => "Green Olives",
        "greenPeppers" => "Green Peppers",
        "doubleCheese" => "Double Cheese"
    ];

    $orderSummary = "<h2>Order Confirmation</h2>";
    $orderSummary .= "<p>Ciao, $firstName! Here is your order:</p>";
    $orderSummary .= "<ul>";

    foreach ($toppings as $topping) {
        if (isset($toppingNames[$topping])) {
            $orderSummary .= "<li>{$toppingNames[$topping]}</li>";
        }
    }

    $orderSummary .= "</ul>";
    $orderSummary .= "<p>Total Price: \$$totalPrice</p>";
    $orderSummary .= "<form action='Final.php' method='POST'>
                        <button type='submit' name='confirm' value='yes'>CONFIRM</button>
                        <button type='submit' name='cancel' value='yes'>CANCEL</button>
                        <p id='Error' class='errorMessage>$errorMsg</p>
                      </form>";

    echo $orderSummary;

    // Handle confirm or cancel actions
    if (isset($_POST['confirm'])) {
        echo "<p>Your order has been confirmed!</p>";
        // Add additional logic to finalize the order (store in DB, etc.)
    } elseif (isset($_POST['cancel'])) {
        echo "<p>Your order has been canceled. Please go back to the toppings page.</p>";
        // Optionally, redirect to a previous page or reset session
        session_unset(); // Reset the session data
        header("Location: Final.php");
        exit();
    }
}
?>


    