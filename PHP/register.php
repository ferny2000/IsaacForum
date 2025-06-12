<?php
include('./db_conection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validar campos vacíos
    if (empty($username) || empty($email) || empty($password)) {
        die("Por favor complete todos los campos del formulario.");
    }

    // Validar formato de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("El formato del correo electrónico no es válido.");
    }

    // Encriptar la contraseña
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Verificar si el usuario o email ya existen
    $check_sql = "SELECT id FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("El nombre de usuario o correo electrónico ya está en uso. Por favor elija otro.");
    }
    $stmt->close();

    // Insertar el nuevo usuario usando sentencias preparadas
    $insert_sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        // Registro exitoso
        $stmt->close();
        $conn->close();
        header("Location: ../login.html");
        exit();
    } else {
        // Manejo de errores
        if ($conn->errno == 1062) {
            die("Error: El nombre de usuario o correo electrónico ya existe.");
        } else {
            die("Error al registrar: " . $conn->error);
        }
    }
} else {
    // Si no es una solicitud POST, redirigir
    header("Location: register.html");
    exit();
}
?>