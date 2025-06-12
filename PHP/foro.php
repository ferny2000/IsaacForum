<?php
include('db_connection.php');

// Obtener las publicaciones y el autor
$sql = "SELECT posts.*, users.username FROM posts
        JOIN users ON posts.author_id = users.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='post'>";
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p>Autor: " . $row['username'] . "</p>";
        echo "<p>" . $row['content'] . "</p>";

        // Mostrar la imagen si existe
        if (!empty($row['image_url'])) {
            echo "<img src='" . $row['image_url'] . "' alt='Imagen del post' />";
        }

        echo "</div>";
    }
} else {
    echo "No hay publicaciones.";
}
?>
