<?php
include('./db_conection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id'])) {
        echo "Debes iniciar sesión para publicar.";
        exit;
    }

    $user_id = $_SESSION['user_id'];  // El ID del usuario logueado
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_url = "";

    // Manejo de la imagen
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Definir la ruta de subida (relativa al archivo actual)
        $upload_dir = __DIR__ . '/../uploads/';  // Usamos __DIR__ para obtener la ruta absoluta

        // Crear el directorio si no existe
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);  // Crea el directorio con permisos adecuados
        }

        // Generar un nombre único para el archivo
        $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_name = uniqid() . '.' . $file_extension;
        $image_path = $upload_dir . $image_name;

        // Validar tipo de archivo (solo imágenes)
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['image']['type'], $allowed_types)) {
            die("Error: Solo se permiten archivos de imagen (JPEG, PNG, GIF).");
        }

        // Mover la imagen
        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $image_url = 'uploads/' . $image_name;  // Ruta relativa para la base de datos
        } else {
            // Más información sobre el error
            error_log("Error al mover archivo: " . print_r(error_get_last(), true));
            die("Error al subir la imagen. Verifique los permisos del directorio.");
        }
    } else {
        // Manejar errores de subida
        $upload_errors = [
            0 => 'No hay error',
            1 => 'El archivo excede el tamaño máximo en php.ini',
            2 => 'El archivo excede el tamaño máximo especificado',
            3 => 'El archivo solo se subió parcialmente',
            4 => 'No se subió ningún archivo',
            6 => 'Falta una carpeta temporal',
            7 => 'No se pudo escribir el archivo en el disco',
            8 => 'Una extensión de PHP detuvo la subida'
        ];
        die("Error al subir imagen: " . $upload_errors[$_FILES['image']['error']]);
    }

    // Evitar inyecciones SQL
    $title = mysqli_real_escape_string($conn, $title);
    $content = mysqli_real_escape_string($conn, $content);
    $image_url = mysqli_real_escape_string($conn, $image_url);

    // Insertar los datos del post en la base de datos
    $sql = "INSERT INTO posts (title, content, author_id, image_url) 
            VALUES ('$title', '$content', '$user_id', '$image_url')";
    if ($conn->query($sql) === TRUE) {
        echo "Publicación creada con éxito.";
        header("Location: ../foro.php");  // Redirigir al foro
    } else {
        echo "Error al crear la publicación: " . $conn->error;
    }
}
