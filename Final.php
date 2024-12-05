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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Action handling (Page 3 confirmation/cancellation)
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action == 'confirm') {
            echo "<div class=\"success\">Your order has been placed successfully. Enjoy your pizza!</div>";
            session_destroy(); // Clear session after order confirmation
        } elseif ($action == 'cancel') {
            echo "<div class=\"info\">Your order has been canceled. You will be redirected to start a new order.</div>";
            session_destroy();
            exit;
        }
    } 

    // Page 1 (Full Name Submission)
    elseif (!isset($_SESSION["fullName"])) {
        if (isset($_POST["fullName"]) && !empty($_POST["fullName"])) {
            $fullName = htmlspecialchars($_POST["fullName"]);
            $nameParts = explode(" ", $fullName);
            $_SESSION['firstName'] = $nameParts[0] ?? ''; // Handle single-word names
            $_SESSION['fullName'] = $fullName;

            printForm_Page2($_SESSION['firstName'], ""); // Move to Page 2
        } else {
            echo "<div class=\"warning\">Please provide your full name.</div>";
        }
    } 

    // Page 2 (Toppings Submission)
    else {
        $toppings = $_POST['toppings'] ?? []; // Allow for no toppings
        $selectedToppings = [];
        $basePrice = 10.00; // Example base price
        $toppingPrices = ['Cheese' => 1.50, 'Pepperoni' => 2.00, 'Mushrooms' => 1.25]; // Example topping prices
        $totalPrice = $basePrice;

        // Calculate total price only if toppings are selected
        foreach ($toppings as $topping) {
            if (isset($toppingPrices[$topping])) {
                $selectedToppings[$topping] = $toppingPrices[$topping];
                $totalPrice += $toppingPrices[$topping];
            }
        }

        printForm_Page3($_SESSION['firstName'], $selectedToppings, number_format($totalPrice, 2)); // Move to Page 3
    }

}else {
    // Not a POST request, display warning
    echo "<div class=\"warning\">Mama Mia that's a spicy meatball! Direct access is prohibited.</div>";
}

function printForm_Page2($firstName, $errorMsg) {
    $toppingForm = <<<HTML
    <form id="toppingForm" method="POST" action="Final.php">
        <div class="title-container">
            
            <h1><img id="pizza" src="Resources/pizza.png" alt="Pizza Logo">SET Pizza Shop</h1>
        
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

function printForm_Page3($firstName, $selectedToppings, $totalPrice) {
    
    $orderSummary = <<<HTML
    <form id="confirmationForm" method="POST" action="Final.php">
        <div class="title-container">
            <h1><img id="pizza" src="Resources/pizza.png" alt="Pizza Logo">SET Pizza Shop</h1>
        </div>
        <div class="order-summary">
            <h2 id="greeting">Ciao $firstName! <img id="hand" src="Resources/italian.png"></h2>
            <h3>Your Order Summary</h3>
            <ul>
               <li> stuff go here </li>
            </ul>
            <p><strong>Total Price: $</strong> <span id="totalPrice">$totalPrice</span></p>
            <div class="confirmation-buttons">
            <button type="submit" name="action" value="confirm">CONFIRM</button>
            <button type="submit" name="action" value="cancel">CANCEL</button>
        </div>
        </div>
    </form>
HTML;

    echo $orderSummary;
}


    ?>