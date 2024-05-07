<?php
$servername="localhost:3307";
$username="root";
$password="";
$dbname="project";
$conn = new mysqli($servername,$username,$password,$dbname);
$sql = "SELECT * from products";
$result = $conn->query($sql);

session_start();

if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$product_id = (int) $_POST['product_id'];
$quantity = (int) $_POST['quantity'];

$sql = "SELECT * from products WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i',$product_id);
$stmt->execute();
$result = $stmt->get_result();

$product = $result->fetch_assoc();

// Check if user already has the product in the cart
$sql = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $_SESSION['user_id'], $product_id);
$stmt->execute();
$result = $stmt->get_result();

// Add product to cart if not already present
if ($result->num_rows === 0) {
  $sql = "INSERT INTO cart (user_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('iiid', $_SESSION['user_id'], $product_id, $quantity, $product['price']);
  $stmt->execute();
} else {
  // Update quantity if product already exists in cart
  $sql = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('iii', $quantity, $_SESSION['user_id'], $product_id);
  $stmt->execute();
}

header('Location: cart.php');

$conn->close();
