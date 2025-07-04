<?php
session_start()
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isaac Forum</title>
    <link rel="stylesheet" href="./CSS/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<style>
    body{
        background-color: #1a1a1a;
    }
</style>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4a2d5e;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="fas fa-dungeon me-2"></i>Isaac Forum</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="foro.php"><i class="fas fa-comments me-1"></i>Foro</a></li>
            

            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Si el usuario está logueado, mostrar su nombre y opción para cerrar sesión -->
                <li class="nav-item">
                    <span class="nav-link">Bienvenido, <?php echo $_SESSION['username']; ?></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./PHP/logout.php"><i class="fas fa-sign-out-alt me-1"></i>Cerrar sesión</a>
                </li>
                <?php if ($_SESSION['es_admin'] == 1): ?>
                    <!-- Si es admin, mostrar la opción de admin -->
                    <li class="nav-item">
                        <a class="nav-link" href="admin_panel.php"><i class="fas fa-cogs me-1"></i>Panel de Admin</a>
                    </li>
                <?php endif; ?>
            <?php else: ?>
                <!-- Si el usuario no está logueado, mostrar el link para iniciar sesión -->
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


    <!-- Contenido Principal -->
    <div class="container my-5">
        <section class="mb-5">
            <h2 class="text-warning"><i class="fas fa-info-circle me-2"></i>Sobre el foro</h2>
            <p class="lead">Este foro está dedicado a los jugadores de "The Binding of Isaac". Aquí puedes compartir tus experiencias, descubrir estrategias y discutir sobre el juego.</p>
        </section>

        <!-- Sección de Cuadros -->
        <section class="my-5">
            <h2 class="text-warning mb-4"><i class="fas fa-compass me-2"></i>Explora la informacion del juego</h2>
            <div class="row g-4">
                <!-- Logros -->
                <div class="col-md-4 col-sm-6">
                    <a href="info.php#logros-section" class="text-decoration-none">
                        <div class="card h-100 border-0 rounded-4 section-card">
                            <div class="card-body text-center p-4">
                                <div class="icon-wrapper mb-3">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <h5 class="card-title text-accent">Logros</h5>
                                <p class="card-text">Descubre cómo desbloquear todos los logros del juego</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Monstruos/Cartas/Runas -->
                <div class="col-md-4 col-sm-6">
                    <a href="info.php#cartas-section" class="text-decoration-none">
                        <div class="card h-100 border-0 rounded-4 section-card">
                            <div class="card-body text-center p-4">
                                <div class="icon-wrapper mb-3">
                                    <i class="fas fa-pastafarianism"></i>
                                </div>
                                <h5 class="card-title text-accent">Monstruos/Cartas/Runas</h5>
                                <p class="card-text">Información sobre enemigos y objetos coleccionables</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Jefes -->
                <div class="col-md-4 col-sm-6">
                    <a href="info.php#jefes-section" class="text-decoration-none">
                        <div class="card h-100 border-0 rounded-4 section-card">
                            <div class="card-body text-center p-4">
                                <div class="icon-wrapper mb-3">
                                    <i class="fas fa-skull"></i>
                                </div>
                                <h5 class="card-title text-accent">Jefes</h5>
                                <p class="card-text">Estrategias para vencer a todos los jefes del juego</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Personajes -->
                <div class="col-md-4 col-sm-6">
                    <a href="info.php#personajes-section" class="text-decoration-none">
                        <div class="card h-100 border-0 rounded-4 section-card">
                            <div class="card-body text-center p-4">
                                <div class="icon-wrapper mb-3">
                                    <i class="fas fa-user"></i>
                                </div>
                                <h5 class="card-title text-accent">Personajes</h5>
                                <p class="card-text">Guías y consejos para cada personaje jugable</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Píldoras/Transformaciones -->
                <div class="col-md-4 col-sm-6">
                    <a href="info.php#pildoras-section" class="text-decoration-none">
                        <div class="card h-100 border-0 rounded-4 section-card">
                            <div class="card-body text-center p-4">
                                <div class="icon-wrapper mb-3">
                                    <i class="fas fa-pills"></i>
                                </div>
                                <h5 class="card-title text-accent">Píldoras/Transformaciones</h5>
                                <p class="card-text">Todo sobre píldoras y transformaciones de personajes</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Niveles/Trinkets -->
                <div class="col-md-4 col-sm-6">
                    <a href="info.php#niveles-section" class="text-decoration-none">
                        <div class="card h-100 border-0 rounded-4 section-card">
                            <div class="card-body text-center p-4">
                                <div class="icon-wrapper mb-3">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                                <h5 class="card-title text-accent">Niveles/Trinkets</h5>
                                <p class="card-text">Explora todos los niveles y objetos pasivos</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="mt-auto">
        <div class="container py-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-accent"><i class="fas fa-dungeon me-2"></i>Isaac Forum</h5>
                    <p>La mejor comunidad de The Binding of Isaac en español</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">&copy; 2025 Isaac Forum. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>