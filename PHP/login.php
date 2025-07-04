<?php
// Agrega esto al inicio para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('./db_conection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Depuración: Ver qué se está recibiendo
    error_log("Intento de login con usuario: $username");

    $stmt = $conn->prepare("SELECT id, username, password, es_admin FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Depuración: Ver los datos obtenidos
        error_log("Datos del usuario: " . print_r($row, true));

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['es_admin'] = $row['es_admin'];

            // Depuración: Verificación exitosa
            error_log("Login exitoso para: $username");

            header("Location: " . ($row['es_admin'] == 1 ? "../admin_panel.php" : "../index.php"));
            exit;
        } else {
            // Depuración: Contraseña no coincide
            error_log("Fallo de contraseña para: $username");
        }
    } else {
        echo "Usuario no encontrado.";
    }
    $stmt->close();
}
$conn->close();
?>