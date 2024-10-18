<?php
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevTools Hub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../build/css/app.css">
</head>

<body>
    <header class="header <?php echo $inicio  ? 'inicio' : ''; ?>">
        <div class="header-content">
            <div class="logo">
                <div class="content-logo">
                    <svg class="logo-icon" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>

                    <a href="/">
                        <h1 class="logo-text">DevTools Hub</h1>
                    </a>
                </div>

                <div class="menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="40"
                        height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 6l16 0" />
                        <path d="M4 12l16 0" />
                        <path d="M4 18l16 0" />
                    </svg>
                </div>
            </div>

            <nav class="nav">
                <a href="/elements" class="nav-link">Categorías</a>

                <?php
                if ($auth) { ?>
                    <a href="/logout" class="nav-link">Cerrar Sesion</a>
                <?php }
                ?>

                <div class="dropdown drop">
                    <span>Categorías</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 9l6 6l6 -6" />
                    </svg>
                </div>
            </nav>
        </div>
    </header>

    <?php echo $contenido; ?>

    <footer>
        <div class="container">
            <p>Creado con ❤️ por Benjamín Galán</p>
            <p class="copyright">© 2023 DevTools Hub. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="../build/js/app.js"></script>
</body>

</html>