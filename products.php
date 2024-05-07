<?php
session_start();
$category = $_GET['category'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon Fresh Inspired Grocery Shop</title>
    <link rel="stylesheet" href="styless.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        button {
  border: none;
  cursor: pointer;
  appearance: none;
  background-color: inherit;
}
    </style>
</head>
<body>
    <header>
        <?php echo '<h1> '. $category .' </h1>'; ?>
        <nav>
            <a href="index.php">Home</a>
            <a href="products.php?category=Medicines">Medicines</a>
            <a href="products.php?category=Snacks">Snacks & Munchies</a>
            <a href="products.php?category=Drinks">Cold drinks & juices</a>
            <a href="products.php?category=Stationery">Stationery</a>
        </nav>
    </header>

    <div class="container">
        <?php
            $servername="localhost:3307";
            $username="root";
            $password="";
            $dbname="project";
            $conn = new mysqli($servername,$username,$password,$dbname);
            // Get category from URL parameter
            // $category = $_GET['category'];
            $sql = "SELECT * from products WHERE category = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $category);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while($row=$result->fetch_assoc()) {
                    echo '<div class="product-card">';
                        echo '<div class="product-image" style="margin-top: 20px;">';
                            echo '<img src="' . $row['image_url'] . '"  alt="' . $row['name'] .'">';
                        echo '</div>';
                        echo '<div class="product-info" style="margin-top: 42px;">';
                            echo '<h3> '. $row['name'] . ' </h3>';
                            echo '<p> ₹' . $row['price'] . '&nbsp; &nbsp;';
                            echo '<form class="hidden" action="add_to_cart.php" method="post">
                                <input type="hidden" name="product_id" value="'. $row['product_id'] . '">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit"><i class="fa-solid fa-cart-plus"></i></button>
                                </form>';
                            echo '</p>';
                        echo '</div>';
                    echo '</div>';
                }
            } else {
                echo 'No products found';
            }
            $conn->close();
        ?>
    </div>

    <footer>
        <p>Contact us: support@mujgro.com | +91 234 567 8190</p>
    </footer>

    <script>
        // JavaScript can be added here for more dynamic interactions if necessary
    </script>
</body>
</html>
