<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Juego - Isaac Forum</title>
    <link rel="stylesheet" href="./CSS/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Fijar la barra de búsqueda y navbar */
        .search-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #4a2d5e;
            padding: 10px 0;
            z-index: 1000;
        }

        .navbar {
            position: fixed;
            top: 50px;  /* Ajuste para dejar espacio para la barra de búsqueda */
            left: 0;
            width: 100%;
            background-color: #4a2d5e;
            z-index: 1000;
        }

        .search-container input {
            width: 100%;
            padding: 8px;
            margin: 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        /* Ajuste de margen para el contenido de la página */
        body {
            margin-top: 150px; /* Deja espacio para la barra de búsqueda y navbar */
        }

        /* Para que las tablas tengan un poco de espacio entre ellas */
        table {
            margin-bottom: 30px;
        }

        /* Estilo para el navbar y los enlaces */
        .nav-item a {
            color: white;
        }

        .nav-item a:hover {
            color: #e0a84e; /* Color destacado en hover */
        }
    </style>
</head>
<body style="background-color: #1a1a1a;">

    <!-- Barra de búsqueda fija -->
    <div class="search-container">
        <input type="text" id="search" placeholder="Buscar..." onkeyup="searchTable()">
    </div>

   <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-dungeon me-2"></i>Isaac Forum</a>
            <!-- Botón de hamburguesa para dispositivos pequeños -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menú de navegación -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#logros-section"><i class="fas fa-trophy me-1"></i>Logros</a></li>
                    <li class="nav-item"><a class="nav-link" href="#cartas-section"><i class="fas fa-cogs me-1"></i>Cartas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#monstruos-section"><i class="fas fa-bug me-1"></i>Monstruos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#runas-section"><i class="fas fa-run me-1"></i>Runas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#jefes-section"><i class="fas fa-skull me-1"></i>Jefes</a></li>
                    <li class="nav-item"><a class="nav-link" href="#personajes-section"><i class="fas fa-users me-1"></i>Personajes</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pildoras-section"><i class="fas fa-pills me-1"></i>Píldoras</a></li>
                    <li class="nav-item"><a class="nav-link" href="#transformaciones-section"><i class="fas fa-magic me-1"></i>Transformaciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="#niveles-section"><i class="fas fa-map me-1"></i>Niveles</a></li>
                    <li class="nav-item"><a class="nav-link" href="foro.php"><i class="fas fa-comments me-1"></i>Foro</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt me-1"></i>Iniciar sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php"><i class="fas fa-user-plus me-1"></i>Registrarse</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-home me-1"></i>Inicio</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenedor Principal -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2 class="text-warning mb-4 text-center"><i class="fas fa-info-circle me-2"></i>Información del Juego</h2>

                <!-- Sección Logros -->
                <h3 id="logros-section" class="text-warning mb-3">Logros</h3>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Cómo Desbloquear</th>
                        </tr>
                    </thead>
                    <tbody id="logros-table">
                        <!-- Contenido dinámico -->
                    </tbody>
                </table>

                <!-- Sección Cartas -->
                <h3 id="cartas-section" class="text-warning mb-3">Cartas</h3>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Cómo Desbloquear</th>
                        </tr>
                    </thead>
                    <tbody id="cartas-table">
                        <!-- Contenido dinámico -->
                    </tbody>
                </table>

                <!-- Sección Monstruos -->
                <h3 id="monstruos-section" class="text-warning mb-3">Monstruos</h3>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Rareza</th>
                            <th>Ubicación</th>
                        </tr>
                    </thead>
                    <tbody id="monstruos-table">
                        <!-- Contenido dinámico -->
                    </tbody>
                </table>

                <!-- Sección Runas -->
                <h3 id="runas-section" class="text-warning mb-3">Runas</h3>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Cómo Desbloquear</th>
                        </tr>
                    </thead>
                    <tbody id="runas-table">
                        <!-- Contenido dinámico -->
                    </tbody>
                </table>

                <!-- Sección Jefes -->
                <h3 id="jefes-section" class="text-warning mb-3">Jefes</h3>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Capítulo</th>
                            <th>Ubicación</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody id="jefes-table">
                        <!-- Contenido dinámico -->
                    </tbody>
                </table>

                <!-- Sección Personajes -->
                <h3 id="personajes-section" class="text-warning mb-3">Personajes</h3>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Salud</th>
                            <th>Daño</th>
                            <th>Velocidad</th>
                            <th>Alcance</th>
                            <th>Suerte</th>
                            <th>Recursos</th>
                            <th>Especial</th>
                        </tr>
                    </thead>
                    <tbody id="personajes-table">
                        <!-- Contenido dinámico -->
                    </tbody>
                </table>

                <!-- Sección Píldoras -->
                <h3 id="pildoras-section" class="text-warning mb-3">Píldoras</h3>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody id="pildoras-table">
                        <!-- Contenido dinámico -->
                    </tbody>
                </table>

                <!-- Sección Transformaciones -->
                <h3 id="transformaciones-section" class="text-warning mb-3">Transformaciones</h3>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Cómo Desbloquear</th>
                        </tr>
                    </thead>
                    <tbody id="transformaciones-table">
                        <!-- Contenido dinámico -->
                    </tbody>
                </table>

                <!-- Sección Niveles -->
                <h3 id="niveles-section" class="text-warning mb-3">Niveles</h3>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody id="niveles-table">
                        <!-- Contenido dinámico -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer style="background-color: #4a2d5e; color: white; padding: 1.5rem; text-align: center;">
        <p class="mb-0"><i class="fas fa-dungeon me-2"></i>Isaac Forum &copy; 2025</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Cargar el JSON dinámicamente usando fetch()
        fetch('isaac_data.json')
            .then(response => response.json())
            .then(data => {
                // Logros
                const logrosTable = document.getElementById('logros-table');
                data.logros.forEach(logro => {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td>${logro.name}</td><td>${logro.description}</td><td>${logro.how_to_unlock}</td>`;
                    logrosTable.appendChild(row);
                });

                // Cartas
                const cartasTable = document.getElementById('cartas-table');
                data.cartas.forEach(carta => {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td>${carta.name}</td><td>${carta.description}</td><td>${carta.how_to_unlock}</td>`;
                    cartasTable.appendChild(row);
                });

                // Monstruos
                const monstruosTable = document.getElementById('monstruos-table');
                Object.keys(data.monstruos).forEach(level => {
                    data.monstruos[level].forEach(monstruo => {
                        const row = document.createElement('tr');
                        row.innerHTML = `<td>${monstruo.name}</td><td>${monstruo.rarity}</td><td>${level}</td>`;
                        monstruosTable.appendChild(row);
                    });
                });

                // Runas
                const runasTable = document.getElementById('runas-table');
                data.runas.forEach(runa => {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td>${runa.name}</td><td>${runa.description}</td><td>${runa.how_to_unlock}</td>`;
                    runasTable.appendChild(row);
                });

                // Jefes
                const jefesTable = document.getElementById('jefes-table');
                data.jefes.forEach(jefe => {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td>${jefe.name}</td><td>${jefe.chapter}</td><td>${jefe.location}</td><td>${jefe.description}</td>`;
                    jefesTable.appendChild(row);
                });

                // Personajes
                const personajesTable = document.getElementById('personajes-table');
                data.personajes.forEach(personaje => {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td>${personaje.name}</td><td>${personaje.health}</td><td>${personaje.damage}</td><td>${personaje.speed}</td><td>${personaje.range}</td><td>${personaje.luck}</td><td>${personaje.resources}</td><td>${personaje.special}</td>`;
                    personajesTable.appendChild(row);
                });

                // Píldoras
                const pildorasTable = document.getElementById('pildoras-table');
                data.pildoras.forEach(pildora => {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td>${pildora.name}</td><td>${pildora.description}</td>`;
                    pildorasTable.appendChild(row);
                });

                // Transformaciones
                const transformacionesTable = document.getElementById('transformaciones-table');
                data.transformaciones.forEach(transformacion => {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td>${transformacion.name}</td><td>${transformacion.description}</td><td>${transformacion.unlock_condition}</td>`;
                    transformacionesTable.appendChild(row);
                });

                // Niveles
                const nivelesTable = document.getElementById('niveles-table');
                data.niveles.forEach(nivel => {
                    nivel.forEach(nivelItem => {
                        const row = document.createElement('tr');
                        row.innerHTML = `<td>${nivelItem.nombre}</td><td>${nivelItem.descripcion}</td>`;
                        nivelesTable.appendChild(row);
                    });
                });
            })
            .catch(error => console.error('Error al cargar el JSON:', error));

        // Función de búsqueda
        function searchTable() {
            const query = document.getElementById('search').value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        }
    </script>
</body>
</html>
