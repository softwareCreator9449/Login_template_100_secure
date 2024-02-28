<?php
require '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: /main"); 
        exit;
    } else {
        $error = "Nombre de usuario o contraseña inválidos.";
        header("Location: index.php?error=" . urlencode($error));
        exit;
    }
}
?>

