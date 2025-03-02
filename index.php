<?php
// Iniciar sesión para gestionar datos del usuario
session_start();

// Verificar si el usuario está autenticado
$isLoggedIn = isset($_SESSION['usuario']);
$username = $isLoggedIn ? htmlspecialchars($_SESSION['usuario']) : null;
$userRole = isset($_SESSION['rol']) ? $_SESSION['rol'] : null;

// Determinar la página de destino según el rol del usuario
$dashboardLink = ($userRole === 'admin') ? 'admin_home.php' : 'editar_perfil.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sabor Colombiano - Descubre la esencia de la gastronomía y cultura colombiana">
    <title>Sabor Colombiano - Inicio</title>
    
    <!-- Bootstrap CSS: Framework para diseño responsive -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts - Montserrat: Tipografía principal del sitio -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome: Biblioteca de iconos para mejorar la interfaz -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
<!-- Swiper CSS: Para el carrusel deslizable -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<!-- Swiper JS: Para el carrusel deslizable (antes de cerrar el body) -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    
    <!-- Estilos personalizados: Define la apariencia específica de la aplicación -->
    <style>
        /* Variables CSS para mantener consistencia en colores y valores */
        :root {
            --color-primary: #FF5722;
            --color-secondary: #4CAF50;
            --color-accent: #FFC107;
            --color-text: #333333;
            --color-light: #FFFFFF;
            --color-hover: #FFF3E0;
            --border-radius: 10px;
            --box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            --transition-normal: all 0.3s ease;
        }
        
        /* ===== ESTILOS GLOBALES ===== */
        /* Definición del fondo, fuente y estructura básica del documento */
        body {
            /* Fondo con degradado de colores que representan la bandera colombiana */
            background: linear-gradient(135deg, var(--color-accent), var(--color-primary), var(--color-secondary));
            min-height: 100vh;
            font-family: 'Montserrat', sans-serif;
            color: var(--color-text);
            margin: 0;
            padding: 0;
            position: relative;
            padding-bottom: 60px; /* Espacio para el footer */
        }

        /* ===== HEADER Y NAVEGACIÓN ===== */
        /* Configuración del encabezado fijo en la parte superior */
        header {
            background: rgba(255, 255, 255, 0.95);
            padding: 1rem 2rem;
            box-shadow: var(--box-shadow);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1000;
            display: flex !important; /* Fuerza la disposición en línea */
            justify-content: space-between !important; /* Distribuye los elementos */
            align-items: center !important; /* Alinea verticalmente */
            box-sizing: border-box;
            transition: var(--transition-normal);
        }
        
        /* Efecto de scroll para el header */
        header.scrolled {
            padding: 0.5rem 2rem;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Estilo del logo y su contenedor */
        .header-logo {
            flex-shrink: 0; /* Evita que el logo se comprima */
        }

        .header-logo img {
            max-width: 120px;
            border-radius: var(--border-radius);
            border: 3px solid var(--color-primary);
            transition: transform 0.3s ease;
            display: block;
        }

        .header-logo img:hover {
            transform: scale(1.05);
        }

        /* Contenedor de los enlaces de navegación */
        .nav-links {
            flex-grow: 1; /* Ocupa el espacio disponible */
            display: flex !important; /* Fuerza la disposición en línea */
            justify-content: center !important; /* Centra los elementos */
        }

        /* Lista de navegación */
        .navbar-nav {
            display: flex !important; /* Fuerza la disposición en línea */
            flex-direction: row !important; /* Asegura que sea horizontal */
            gap: 2rem !important; /* Espacio entre elementos */
            list-style: none;
            margin: 0;
            padding: 0;
            align-items: center;
        }

        /* Elementos individuales de la navegación */
        .nav-item {
            margin: 0;
            padding: 0;
            display: block !important;
            position: relative;
        }

        /* Enlaces de navegación */
        .nav-link {
            color: var(--color-secondary);
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            transition: var(--transition-normal);
            padding: 0.5rem 1rem;
            border-radius: 5px;
            display: flex !important;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link:hover {
            color: var(--color-primary);
            background: rgba(76, 175, 80, 0.1);
            transform: translateY(-2px);
        }
        
        /* Indicador de enlace activo */
        .nav-link.active {
            color: var(--color-primary);
            background: rgba(255, 87, 34, 0.1);
            position: relative;
        }
        
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background: var(--color-primary);
            border-radius: 3px;
        }

        /* ===== BOTONES ===== */
        /* Botón de salir/iniciar sesión */
        .btn-auth {
            background-color: var(--color-primary);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            transition: var(--transition-normal);
            cursor: pointer;
            white-space: nowrap; /* Evita que el texto se divida */
            flex-shrink: 0; /* Evita que el botón se comprima */
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-auth:hover {
            background-color: var(--color-secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        /* Botón de usuario logueado */
        .user-welcome {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--color-primary);
            font-weight: 600;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            margin-right: 1rem;
            transition: var(--transition-normal);
        }
        
        .user-welcome:hover {
            background-color: var(--color-hover);
            transform: translateY(-2px);
        }

        /* Botón de información */
        .btn-info {
            background-color: var(--color-accent);
            color: var(--color-text);
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition-normal);
        }

        .btn-info:hover {
            background-color: var(--color-primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        /* Botón de servicio */
        .btn-service {
            background-color: var(--color-secondary);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: var(--transition-normal);
            margin-top: 1rem;
            border: none;
            cursor: pointer;
        }

        .btn-service:hover {
            background-color: var(--color-primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* ===== SECCIÓN HERO ===== */
        /* Sección principal de bienvenida */
        .hero {
            text-align: center;
            padding: 10rem 2rem 5rem; /* Espacio superior para evitar solapamiento con header */
            background: rgba(255, 255, 255, 0.9);
            margin: 0 auto;
            max-width: 800px;
            border-radius: 20px;
            box-shadow: var(--box-shadow);
            animation: fadeIn 1s ease-in-out;
        }
        
        /* Animación de aparición suave */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero h2 {
            color: var(--color-primary);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        /* Línea decorativa debajo del título */
        .hero h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(to right, var(--color-accent), var(--color-primary), var(--color-secondary));
            border-radius: 3px;
        }

        .hero p {
            color: var(--color-secondary);
            font-size: 1.2rem;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Contenedor de botones en el hero */
        .hero-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        /* ===== SECCIÓN DE CARACTERÍSTICAS ===== */
        .features {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 2rem auto;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: var(--box-shadow);
        }
        
        .features h3 {
            color: var(--color-primary);
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 700;
        }
        
        /* Estilos para el carrusel Swiper */
        .swiper {
            width: 100%;
            padding-bottom: 50px; /* Espacio para la paginación */
        }
        
        .swiper-slide {
            height: auto; /* Permite que las tarjetas tengan altura variable */
            display: flex;
        }
        
        /* Estilos para los botones de navegación del carrusel */
        .swiper-button-next, .swiper-button-prev {
            color: var(--color-primary);
            background: rgba(255, 255, 255, 0.8);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .swiper-button-next:after, .swiper-button-prev:after {
            font-size: 18px;
            font-weight: bold;
        }
        
        .swiper-button-next:hover, .swiper-button-prev:hover {
            background: var(--color-light);
            transform: scale(1.1);
        }
        
        /* Estilos para la paginación del carrusel */
        .swiper-pagination-bullet {
            background: var(--color-secondary);
            opacity: 0.5;
        }
        
        .swiper-pagination-bullet-active {
            background: var(--color-primary);
            opacity: 1;
        }
        
        /* Tarjetas de características */
        .feature-card {
            background: var(--color-light);
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: var(--transition-normal);
            text-align: center;
            display: flex;
            flex-direction: column;
            height: 100%;
            width: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--color-accent);
            margin-bottom: 1rem;
        }
        
        .feature-title {
            color: var(--color-primary);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .feature-description {
            color: var(--color-text);
            font-size: 0.95rem;
            margin-bottom: 1rem;
            flex-grow: 1; /* Hace que el texto ocupe el espacio disponible */
        }
        
        .feature-button-container {
            margin-top: auto; /* Empuja el botón hacia abajo */
        }
        
        /* Estilos para la lista de tradiciones */
        .tradition-list {
            text-align: left;
            margin-bottom: 1rem;
            padding-left: 0;
            list-style-position: inside;
        }
        
        .tradition-list li {
            margin-bottom: 0.5rem;
            position: relative;
            padding-left: 1.5rem;
            list-style-type: none;
        }
        
        .tradition-list li:before {
            content: "•";
            color: var(--color-primary);
            font-weight: bold;
            position: absolute;
            left: 0;
        }

        /* ===== FOOTER ===== */
        /* Pie de página */
        footer {
            text-align: center;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.9);
            color: var(--color-text);
            font-size: 0.9rem;
            position: absolute;
            bottom: 0;
            width: 100%;
            border-top: 1px solid rgba(255, 193, 7, 0.3);
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .footer-links {
            display: flex;
            gap: 1rem;
        }
        
        .footer-link {
            color: var(--color-secondary);
            text-decoration: none;
            transition: var(--transition-normal);
        }
        
        .footer-link:hover {
            color: var(--color-primary);
        }
        
        .social-icons {
            display: flex;
            gap: 1rem;
        }
        
        .social-icon {
            color: var(--color-secondary);
            font-size: 1.2rem;
            transition: var(--transition-normal);
        }
        
        .social-icon:hover {
            color: var(--color-primary);
            transform: translateY(-2px);
        }

        /* ===== RESPONSIVE ===== */
        /* Ajustes para dispositivos móviles */
        @media (max-width: 768px) {
            header {
                flex-wrap: wrap;
                padding: 1rem;
                gap: 1rem;
            }
            
            .nav-links {
                order: 3;
                width: 100%;
                justify-content: center;
            }
            
            .navbar-nav {
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }
            
            .hero {
                padding: 8rem 1.5rem 3rem;
                margin: 0 1rem;
            }
            
            .hero h2 {
                font-size: 2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
            
            .features {
                padding: 2rem 1rem;
                margin: 1rem;
            }
            
            .footer-content {
                flex-direction: column;
                text-align: center;
            }
            
            .footer-links, .social-icons {
                justify-content: center;
            }
            
            /* Ajustes para el carrusel en móviles */
            .swiper-button-next, .swiper-button-prev {
                width: 30px;
                height: 30px;
            }
            
            .swiper-button-next:after, .swiper-button-prev:after {
                font-size: 14px;
            }
        }

        /* ===== CORRECCIONES PARA BOOTSTRAP ===== */
        /* Estas reglas sobrescriben los estilos de Bootstrap que podrían interferir */
        @media all {
            .navbar-nav {
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
            }
            
            .nav-item {
                display: block !important;
            }
            
            .navbar-nav .nav-link {
                padding: 0.5rem 1rem !important;
            }
        }
        
        /* ===== ACCESIBILIDAD ===== */
        /* Mejoras para accesibilidad */
        .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
        
        /* Enfoque visible para navegación por teclado */
        a:focus, button:focus {
            outline: 3px solid var(--color-accent);
            outline-offset: 2px;
        }
    </style>
</head>
<body>
    <!-- HEADER: Contiene el logo, navegación y botón de inicio de sesión -->
    <header id="main-header">
        <div class="header-logo">
            <a href="index.php" title="Página de inicio">
                <img src="palenque.jpeg" alt="San Basilio de Palenque" width="120" height="120">
            </a>
        </div>
        
        <nav class="nav-links" aria-label="Navegación principal">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php" aria-current="page">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#servicios">
                        <i class="fas fa-utensils"></i> Servicios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contacto">
                        <i class="fas fa-envelope"></i> Contacto
                    </a>
                </li>
                <?php if ($isLoggedIn): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $dashboardLink; ?>">
                        <i class="fas fa-tachometer-alt"></i> Mi Panel
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
        
        <?php if ($isLoggedIn): ?>
            <!-- Si el usuario está logueado, mostrar su nombre y botón de salir -->
            <div class="auth-container">
                <span class="user-welcome">
                    <i class="fas fa-user"></i> Hola, <?php echo $username; ?>
                </span>
                <a href="logout.php" title="Cerrar sesión">
                    <button class="btn-auth">
                        <i class="fas fa-sign-out-alt"></i> Salir
                    </button>
                </a>
            </div>
        <?php else: ?>
            <!-- Si no está logueado, mostrar botón de iniciar sesión -->
            <a href="login.php" title="Iniciar sesión">
                <button class="btn-auth">
                    <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                </button>
            </a>
        <?php endif; ?>
    </header>

    <!-- SECCIÓN HERO: Contiene el mensaje de bienvenida y botones de acción -->
    <section class="hero">
        <h2>¡Bienvenido a Sabor Colombiano!</h2>
        <p>Explora y descubre la esencia de nuestra tierra: alegría, color y tradición. Sumérgete en una experiencia gastronómica única que celebra la diversidad cultural de Colombia.</p>
        
        <div class="hero-buttons">
            <a href="#servicios" class="btn-info">
                <i class="fas fa-info-circle"></i> Más Información
            </a>
            <?php if (!$isLoggedIn): ?>
            <a href="register.php" class="btn-info" style="background-color: var(--color-secondary); color: white;">
                <i class="fas fa-user-plus"></i> Registrarse
            </a>
            <?php endif; ?>
        </div>
    </section>
    
    <!-- SECCIÓN DE CARACTERÍSTICAS: Muestra los principales servicios o características con carrusel deslizable -->
    <section class="features" id="servicios">
    <h3>Nuestros Servicios</h3>
    
    <!-- Swiper: Carrusel deslizable para las tarjetas de servicios -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <!-- Slide 1: Tradiciones -->
            <div class="swiper-slide">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-music"></i>
                    </div>
                    <h4 class="feature-title">Tradiciones</h4>
                    <p class="feature-description">Descubre las ricas tradiciones culturales de San Basilio de Palenque, el primer pueblo libre de América:</p>
                    <ul class="tradition-list">
                        <li><strong>Música</strong></li>
                        <li><strong>Rituales</strong></li>
                        <li><strong>Medicina Tradicional</strong></li>
                    </ul>
                    <div class="feature-button-container">
                        <a href="tradiciones.php" class="btn-service">
                            <i class="fas fa-arrow-right"></i> Explorar Tradiciones
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Slide 2: Productos -->
            <div class="swiper-slide">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shopping-basket"></i>
                    </div>
                    <h4 class="feature-title">Productos</h4>
                    <p class="feature-description">Explora nuestra selección de productos artesanales colombianos, desde alimentos hasta artesanías, todos elaborados con técnicas tradicionales.</p>
                    <div class="feature-button-container">
                        <a href="productos.php" class="btn-service">
                            <i class="fas fa-arrow-right"></i> Ver Productos
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Slide 3: Historias de la Comunidad -->
            <div class="swiper-slide">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="feature-title">Historias de la Comunidad</h4>
                    <p class="feature-description">Conoce las historias inspiradoras de nuestra comunidad y cómo mantenemos vivas nuestras tradiciones a través de generaciones.</p>
                    <div class="feature-button-container">
                        <a href="Historias_comunidad.php" class="btn-service">
                            <i class="fas fa-arrow-right"></i> Ver Historias
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Controles de navegación del carrusel -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
</section>

    <!-- SECCIÓN DE CONTACTO: Información de contacto -->
    <section class="features" id="contacto">
        <h3>Contáctanos</h3>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h4 class="feature-title">Ubicación</h4>
                <p class="feature-description">Calle Principal #123, Bogotá, Colombia</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <h4 class="feature-title">Teléfono</h4>
                <p class="feature-description">+57 123 456 7890</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h4 class="feature-title">Correo Electrónico</h4>
                <p class="feature-description">info@saborcolombiano.com</p>
            </div>
        </div>
    </section>

    <!-- FOOTER: Contiene información de copyright y enlaces adicionales -->
    <footer>
        <div class="footer-content">
            <div class="copyright">
                <p>© 2025 Sabor Colombiano - Todos los derechos reservados.</p>
            </div>
            
            <div class="footer-links">
                <a href="#" class="footer-link">Términos y Condiciones</a>
                <a href="#" class="footer-link">Política de Privacidad</a>
            </div>
            
            <div class="social-icons">
                <a href="#" class="social-icon" title="Facebook" aria-label="Visita nuestra página de Facebook">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="#" class="social-icon" title="Instagram" aria-label="Síguenos en Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="social-icon" title="Twitter" aria-label="Síguenos en Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
        </div>
    </footer>

    <!-- Scripts de Bootstrap para funcionalidades interactivas -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Swiper JS: Para el carrusel deslizable -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    
    <!-- Script personalizado para mejorar la experiencia de usuario -->
    <script>
        // Cuando el documento esté cargado
        document.addEventListener('DOMContentLoaded', function() {
            // Efecto de scroll para el header
            window.addEventListener('scroll', function() {
                const header = document.getElementById('main-header');
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');} else {
                    header.classList.remove('scrolled');
                }
            });
            
            // Navegación suave al hacer clic en los enlaces
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Inicialización del carrusel Swiper
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                // Responsive breakpoints
                breakpoints: {
                    // Cuando el ancho de la ventana es >= 768px
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    // Cuando el ancho de la ventana es >= 1024px
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    }
                },
                // Accesibilidad
                a11y: {
                    prevSlideMessage: 'Slide anterior',
                    nextSlideMessage: 'Siguiente slide',
                    firstSlideMessage: 'Este es el primer slide',
                    lastSlideMessage: 'Este es el último slide',
                    paginationBulletMessage: 'Ir al slide {{index}}'
                }
            });
        });
    </script>

<script>
    // Inicialización del carrusel Swiper
    document.addEventListener('DOMContentLoaded', function() {
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            // Responsive breakpoints
            breakpoints: {
                // Cuando el ancho de la ventana es >= 768px
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                // Cuando el ancho de la ventana es >= 1024px
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30
                }
            },
            // Accesibilidad
            a11y: {
                prevSlideMessage: 'Slide anterior',
                nextSlideMessage: 'Siguiente slide',
                firstSlideMessage: 'Este es el primer slide',
                lastSlideMessage: 'Este es el último slide',
                paginationBulletMessage: 'Ir al slide {{index}}'
            }
        });
    });
</script>
</body>
</html>