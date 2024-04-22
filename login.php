<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (password_verify($password, $row["password"])) {
        echo "Login successful";
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $row["user_id"];
        header('Location: index.html');
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
?>
