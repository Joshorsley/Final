<?php
session_start();

$basePrice =10.00;
$toppingPrices = [
    'Pepperoni' => 1.50,
    'Mushrooms' => 1.00,
    'Double Cheese' => 2.25,
    'Green Olives' => 1.00,
    'Green Peppers' => 1.00
];


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); 
    exit(json_encode(['error' => 'Only POST requests are allowed.']));
}


$contentType = $_SERVER['CONTENT_TYPE'] ?? '';
if ($contentType !== 'application/json') {
    http_response_code(415); 
    exit(json_encode(['error' => 'Content-Type must be application/json.']));
}


$payload = file_get_contents('php://input');
$data = json_decode($payload, true);

// Ensure the payload is valid JSON
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400); // Bad Request
    exit(json_encode(['error' => 'Invalid JSON payload.']));
}

// Initialize the total price with the base price
$totalPrice = $basePrice;


foreach ($toppingPrices as $topping => $price) {
    if (!empty($data[$topping]) && $data[$topping] == 1) {
        $totalPrice += $price;
    }
}

$selectedToppings = [];
foreach ($toppingPrices as $topping => $price) {
    if (!empty($data[$topping]) && $data[$topping] == 1) {
        $selectedToppings[] = $topping; 
    }
}

if(empty($selectedToppings)){
    $selectedToppings[] = "No toppings selected.";
}

$_SESSION['selectedToppings'] = $selectedToppings;

$_SESSION['totalPrice'] = $totalPrice;
http_response_code(200); 
header('Content-Type: application/json');
echo json_encode(['Value' => $totalPrice]);
?>