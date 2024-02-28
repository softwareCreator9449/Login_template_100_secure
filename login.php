<?php
require '../includes/db_connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']); 
    // Ejemplo -> INSERT INTO users (username, password) VALUES ('pedro', '1f8a558aa07de0d25c61e79f5d2ce1c3');
    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        session_start();
        header("Location: /main"); 
        exit;
    } else {
        exit;
    }
}
?>
