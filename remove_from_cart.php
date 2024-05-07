<?php
session_start();

$servername = "localhost:3307";
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php'); // Redirect to login page if not logged in
  exit;
}

// Get product ID from URL parameter
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

// Check if user already has the product in the cart
$sql = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $_SESSION['user_id'], $product_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Remove product from cart if quantity = 1
if ($row['quantity'] === 1) {
    $sql = "DELETE FROM cart WHERE product_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $product_id, $_SESSION['user_id']);
    $stmt->execute();
} else {
  // Decrement quantity if quantity > 1
  $sql = "UPDATE cart SET quantity = quantity - 1 WHERE user_id = ? AND product_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ii', $_SESSION['user_id'], $product_id);
  $stmt->execute();
}
header('Location: cart.php');

$conn->close();
?>
