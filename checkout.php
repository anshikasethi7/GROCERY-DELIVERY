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

// Get cart items for the user
$sql = "SELECT c.product_id, p.name, p.price, p.image_url, c.quantity 
        FROM cart c 
        INNER JOIN products p ON c.product_id = p.product_id 
        WHERE c.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

$cart_items = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
  }
}

// Calculate cart total
$cart_total = 0;
foreach ($cart_items as $item) {
  $cart_total += $item['price'] * $item['quantity'];
}

// Insert order details (assuming a 'orders' table)
  $sql = "INSERT INTO orders (user_id, total_amount) 
          VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('is', $_SESSION['user_id'], $cart_total);
  $stmt->execute();

  // Get the inserted order ID (optional, for further processing)
  $order_id = $conn->insert_id;

  // Insert into ordered_products
  foreach ($cart_items as $item) {
    $sql = "INSERT INTO ordered_products (order_id, product_id, quantity) 
          VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('isi', $order_id, $item['product_id'], $item['quantity']);
    $stmt->execute();
  }

  // Clear cart items after successful order placement
  $sql = "DELETE FROM cart WHERE user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $_SESSION['user_id']);
  $stmt->execute();

  // Display success message or redirect to order confirmation page
  $message = "Your order has been placed successfully! (Order ID: $order_id)";

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/style.css">
<title>EcomEmpire - Checkout</title>
<style>
    table {
  width: 90%;
  border-collapse: collapse;
  margin: 20px auto 30px auto;
  border-radius: 10px;
}

th, td {
  padding: 10px;
  border: 1px solid #ddd;
  text-align: left;
}

th {
  background-color: #f2f2f2;
  font-weight: bold;
}

td img {
  width: 100px;
}

.subtotal, .total {
  text-align: right;
}

a {
  text-decoration: none;
  color: #333;
  padding: 10px 20px;
  background-color: #ddd;
  border-radius: 5px;
  display: inline-block;
  margin: 10px auto;
}

a:hover {
  background-color: #ccc;
}
</style>
</head>
<body>

<h1>Checkout</h1>

<?php if ($message): ?>
  <p style="text-align: center; color: green;"><?php echo $message; ?></p>
  <table>
  <tr>
    <th>Product Image</th>
    <th>Product Name</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Subtotal</th>
  </tr>
  <?php foreach ($cart_items as $item): ?>
  <tr>
    <td><img src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['name']; ?>" style="width:100px;"></td>
    <td><?php echo $item['name']; ?></td>
    <td><?php echo $item['quantity']; ?></td>
    <td>₹<?php echo number_format($item['price'], 2); ?></td>
    <td>₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
  </tr>
  <?php endforeach; ?>
  <tr>
    <td colspan="4">Total Order Amount:</td>
    <td colspan="1">₹<?php echo number_format($cart_total, 2); ?></td>
  </tr>
</table>
<?php else: ?>
<?php endif; ?>

<?php if (empty($cart_items)): ?>
  <p>Your cart is currently empty.</p>
<?php else: ?>
<?php endif; ?>

</body>
</html>
