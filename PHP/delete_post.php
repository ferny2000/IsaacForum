<?php
include('./db_conection.php');

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Obtener la URL de la imagen de la publicación para eliminarla
    $sql = "SELECT image_url FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($image_url);
        $stmt->fetch();

        // Eliminar el archivo de imagen físico, si existe
        if (!empty($image_url) && file_exists($image_url)) {
            unlink($image_url);
        }

        // Eliminar la publicación
        $delete_sql = "DELETE FROM posts WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $post_id);
        $delete_stmt->execute();
    }

    // Redirigir al foro
    header("Location: ../admin_panel.php");
    exit();
}

$conn->close();
?>