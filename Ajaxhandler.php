<?php
session_start();
// Define topping prices
$basePrice =10.00;
$toppingPrices = [
    'Pepperoni' => 1.50,
    'Mushrooms' => 1.00,
    'DoubleCheese' => 2.25,
    'GreenOlives' => 1.00,
    'GreenPeppers' => 1.00
];

// Ensure the request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    exit(json_encode(['error' => 'Only POST requests are allowed.']));
}

// Ensure the Content-Type is JSON
$contentType = $_SERVER['CONTENT_TYPE'] ?? '';
if ($contentType !== 'application/json') {
    http_response_code(415); // Unsupported Media Type
    exit(json_encode(['error' => 'Content-Type must be application/json.']));
}

// Get the JSON payload
$payload = file_get_contents('php://input');
$data = json_decode($payload, true);

// Ensure the payload is valid JSON
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400); // Bad Request
    exit(json_encode(['error' => 'Invalid JSON payload.']));
}

// Initialize the total price with the base price
$totalPrice = $basePrice;

// Process the selected toppings
foreach ($toppingPrices as $topping => $price) {
    if (!empty($data[$topping]) && $data[$topping] == 1) {
        $totalPrice += $price;
    }
}

$_SESSION['totalPrice'] = $totalPrice;
// Respond with the calculated total price
http_response_code(200); // Success
header('Content-Type: application/json');
echo json_encode(['Value' => $totalPrice]);
?>