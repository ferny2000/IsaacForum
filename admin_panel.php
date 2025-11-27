<?php
session_start();
if (!isset($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1) {
    die("Acceso denegado");
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro - Isaac Forum</title>
    <link rel="stylesheet" href="./CSS/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="manifest" href="./manifest.json">
    <meta name="theme-color" content="#4a2d5e">
</head>
<style>
    body {
        background-color: #1a1a1a;
    }
</style>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4a2d5e;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-dungeon me-2"></i>Isaac Forum</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-home me-1"></i>Inicio</a></li>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Si el usuario está logueado, mostrar su nombre y opción para cerrar sesión -->
                    <li class="nav-item">
                        <span class="nav-link">Bienvenido, <?php echo $_SESSION['username']; ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./PHP/logout.php"><i class="fas fa-sign-out-alt me-1"></i>Cerrar sesión</a>
                    </li>
                <?php else: ?>
                    <!-- Si el usuario no está logueado, mostrar los links para iniciar sesión y registrarse -->
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt me-1"></i>Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php"><i class="fas fa-user-plus me-1"></i>Registrarse</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Contenedor Principal -->
    <div class="container my-5">
        <!-- Lista de publicaciones -->
        <section class="my-5">
            <h2 class="text-warning"><i class="fas fa-comments me-2"></i>Publicaciones</h2>
            <div id="posts-container" class="row">
                <?php
                include('./PHP/db_conection.php');

                // Lista de publicaciones
                $sql = "SELECT p.*, u.username 
                        FROM posts p 
                        JOIN users u ON p.author_id = u.id
                        ORDER BY p.created_at DESC";

                $result = $conn->query($sql);

                if ($result === false) {
                    die("Error en la consulta: " . $conn->error);
                }

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-6 mb-4">';
                        echo '  <div class="card bg-dark text-white rounded-4 overflow-hidden">';
                        echo '    <div class="card-header bg-secondary">';
                        echo '      <h5><i class="fas fa-file-alt me-2"></i>' . htmlspecialchars($row['title']) . '</h5>';
                        echo '      <small class="text-muted"><i class="fas fa-user me-1"></i>' . htmlspecialchars($row['username']) . '</small>';
                        echo '    </div>';
                        echo '    <div class="card-body">';
                        echo '      <p class="card-text">' . nl2br(htmlspecialchars($row['content'])) . '</p>';

                        // Mostrar imagen si existe
                        if (!empty($row['image_url'])) {
                            echo '    <img src="' . htmlspecialchars($row['image_url']) . '" class="img-fluid mb-3 rounded-3" alt="Imagen de publicación">';
                        }

                        echo '    </div>';
                        echo '    <div class="card-footer text-muted bg-secondary">';
                        echo '      <small><i class="far fa-clock me-1"></i>' . date('d/m/Y H:i', strtotime($row['created_at'])) . '</small>';


                        // Eliminar publicación
                        echo '      <a href="./PHP/delete_post.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm float-end" onclick="return confirm(\'¿Estás seguro de que quieres eliminar esta publicación?\')"><i class="fas fa-trash me-1"></i>Eliminar</a>';


                        echo '    </div>';
                        echo '  </div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="col-12">';
                    echo '  <div class="alert alert-info rounded-4"><i class="fas fa-info-circle me-2"></i>No hay publicaciones aún. ¡Sé el primero en publicar!</div>';
                    echo '</div>';
                }

                $conn->close();
                ?>
            </div>
        </section>
    </div>

    <!-- Footer Actualizado (color morado #4a2d5e) -->
    <footer style="background-color: #4a2d5e; color: white; padding: 1.5rem; text-align: center; margin-top: auto;">
        <div class="container">
            <p class="mb-0"><i class="fas fa-dungeon me-2"></i>Isaac Forum &copy; 2025</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('sw.js')
                .then(registration => {
                    console.log('Service Worker registrado con éxito:', registration.scope);
                })
                .catch(error => {
                    console.log('Fallo al registrar el Service Worker:', error);
                });
        });
    }
</script>
</body>

</html>