<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro - Isaac Forum</title>
    <link rel="stylesheet" href="./CSS/styles.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>

<body>


    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4a2d5e;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Isaac Forum</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.html">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="login.html">Iniciar sesión</a></li>
                <li class="nav-item"><a class="nav-link" href="register.html">Registrarse</a></li>
            </ul>
        </div>
    </nav>

    <!-- Contenedor Principal -->
    <div class="container my-5">
        <!-- Crear publicación -->
        <section>
            <h2 class="text-warning">Crear una publicación</h2>
            <form action="./PHP/upload_post.php" method="POST" enctype="multipart/form-data"
                class="bg-dark p-4 rounded shadow">
                <div class="mb-3">
                    <label for="title" class="form-label text-white">Título</label>
                    <input type="text" class="form-control" name="title" required>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label text-white">Contenido</label>
                    <textarea class="form-control" name="content" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label text-white">Imagen</label>
                    <input type="file" class="form-control" name="image" accept="image/*">
                </div>

                <button type="submit" class="btn btn-warning">Publicar</button>
            </form>
        </section>
        <!-- Lista de publicaciones -->
        <section class="my-5">
            <h2 class="text-warning">Publicaciones</h2>
            <div id="posts-container" class="row">
                <?php
                include('./PHP/db_conection.php');

                // Lista de publicaciones
                $sql = "SELECT p.*, u.username 
        FROM posts p 
        JOIN users u ON p.author_id = u.id  /* Cambiado a author_id para coincidir con tu DB */
        ORDER BY p.created_at DESC";

                $result = $conn->query($sql);

                if ($result === false) {
                    die("Error en la consulta: " . $conn->error);
                }

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-6 mb-4">';
                        echo '  <div class="card bg-dark text-white">';
                        echo '    <div class="card-header">';
                        echo '      <h5>' . htmlspecialchars($row['title']) . '</h5>';
                        echo '      <small class="text-muted">Publicado por: ' . htmlspecialchars($row['username']) . '</small>';
                        echo '    </div>';
                        echo '    <div class="card-body">';
                        echo '      <p class="card-text">' . nl2br(htmlspecialchars($row['content'])) . '</p>';

                        // Mostrar imagen si existe
                        if (!empty($row['image_url'])) {
                            echo '    <img src="' . htmlspecialchars($row['image_url']) . '" class="img-fluid mb-3" alt="Imagen de publicación">';
                        }

                        echo '    </div>';
                        echo '    <div class="card-footer text-muted">';
                        echo '      <small>' . date('d/m/Y H:i', strtotime($row['created_at'])) . '</small>';
                        echo '    </div>';
                        echo '  </div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="col-12">';
                    echo '  <div class="alert alert-info">No hay publicaciones aún. ¡Sé el primero en publicar!</div>';
                    echo '</div>';
                }

                $conn->close();
                ?>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer style="background-color: #4a2d5e; color: white; padding: 1.5rem; text-align: center;">
        <p>&copy; 2025 Isaac Forum</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>