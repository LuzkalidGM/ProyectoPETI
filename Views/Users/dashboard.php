<?php
session_start();
require_once __DIR__ . '/../../Controllers/AuthController.php';

// Verificar que el usuario esté logueado
AuthController::requireLogin();

// Obtener datos del usuario
$user = AuthController::getCurrentUser();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PETTY</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../../Publics/css/styles_dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../Resources/favicon.ico">
</head>
<body>
    <!-- Header -->
    <?php include 'header.php'; ?>
    
    <!-- Contenido principal -->
    <main class="main-content">
        <div class="container">
            <!-- Mensaje de bienvenida -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php 
                    echo htmlspecialchars($_SESSION['success']); 
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>
            
            <!-- Título del dashboard -->
            <div class="dashboard-header">
                <h1 class="dashboard-title">¡Hola, <?php echo htmlspecialchars($user['name']); ?>! </h1>
                <p class="dashboard-subtitle">Bienvenido a tu espacio de planificación estratégica</p>
            </div>
            
        
            
            <!-- Los 11 apartados del plan estratégico -->
            <div class="strategic-sections">
                <h2 class="sections-title">Los Apartados de tu Plan Estratégico</h2>
                
                <div class="sections-grid">
                    <div class="section-card">
                        <div class="section-number">1</div>
                        <h3>Misión</h3>
                        <p>Define el propósito fundamental de tu organización</p>
                    </div>
                    
                    <div class="section-card">
                        <div class="section-number">2</div>
                        <h3>Visión</h3>
                        <p>Establece hacia dónde quieres que vaya tu empresa</p>
                    </div>
                    
                    <div class="section-card">
                        <div class="section-number">3</div>
                        <h3>Valores</h3>
                        <p>Los principios que guían tu organización</p>
                    </div>
                    
                    <div class="section-card">
                        <div class="section-number">4</div>
                        <h3>Objetivos</h3>
                        <p>Metas específicas y medibles a alcanzar</p>
                    </div>
                    
                    <div class="section-card">
                        <div class="section-number">5</div>
                        <h3>Análisis Interno y Externo</h3>
                        <p>Evaluación completa del entorno empresarial</p>
                    </div>
                    
                    <div class="section-card">
                        <div class="section-number">6</div>
                        <h3>Cadena de Valor</h3>
                        <p>Análisis de los procesos que agregan valor</p>
                    </div>
                    
                    <div class="section-card">
                        <div class="section-number">7</div>
                        <h3>Matriz BCG</h3>
                        <p>Matriz de crecimiento y participación</p>
                    </div>
                    
                    <div class="section-card">
                        <div class="section-number">8</div>
                        <h3>Matriz de Porter</h3>
                        <p>Análisis del microentorno competitivo</p>
                    </div>
                    
                    <div class="section-card">
                        <div class="section-number">9</div>
                        <h3>Análisis PEST</h3>
                        <p>Factores políticos, económicos, sociales y tecnológicos</p>
                    </div>
                    
                    <div class="section-card">
                        <div class="section-number">10</div>
                        <h3>Identificación de Estrategias</h3>
                        <p>Desarrollo de estrategias competitivas</p>
                    </div>
                    
                    <div class="section-card">
                        <div class="section-number">11</div>
                        <h3>Matriz CAME</h3>
                        <p>Corregir, Afrontar, Mantener, Explotar</p>
                    </div>
                </div>
            </div>
            
            
            
            
        </div>
    </main>
    
    <!-- Footer -->
    <?php include 'footer.php'; ?>
    
    <!-- JavaScript -->
    <script src="../../Publics/js/dashboard.js"></script>
</body>
</html>
