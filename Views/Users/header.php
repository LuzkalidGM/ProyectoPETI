<header class="header">
    <div class="header-container">
        <!-- Sección Izquierda: Logo + Búsqueda -->
        <div class="header-left-section">
    </div>
    
    <!-- Barra de Navegación Inferior -->
    <div class="header-nav-section">
        <div class="header-container">
            <nav class="main-nav">
                <a href="dashboard.php" class="nav-link active">
                    <span class="nav-text">Inicio</span>
                </a>
                
                <a href="progress.php" class="nav-link">
                    <span class="nav-text">Progreso</span>
                </a>
                <a href="reports.php" class="nav-link">
                    <span class="nav-text">Proyectos</span>
                </a>
                
            </nav>
        </div>
    </div>
    

      
        <!-- Sección Central: Información contextual -->
        <div class="header-center-section">
            <div class="context-info">
                <span class="current-time" id="currentTime"></span>
                <span class="context-separator">•</span>
                <span class="welcome-message">¡Buen trabajo!</span>
            </div>
        </div>
        
        <!-- Sección Derecha: Acciones de usuario -->
        <div class="header-right-section">
            
            <div class="user-menu" title="Menú de usuario">
                <div class="user-avatar" onclick="toggleUserDropdown()">
                    <?php if ($user['avatar']): ?>
                        <img src="<?php echo htmlspecialchars($user['avatar']); ?>" alt="Avatar">
                    <?php else: ?>
                        <div class="avatar-placeholder">
                            <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="user-info" onclick="toggleUserDropdown()">
                    <span class="user-name"><?php echo htmlspecialchars($user['name']); ?></span>
                    <span class="dropdown-arrow">▼</span>
                </div>
                
                <!-- Dropdown del usuario -->
                <div class="user-dropdown" id="userDropdown">
                    <div class="dropdown-header">
                        <div class="dropdown-avatar">
                            <?php if ($user['avatar']): ?>
                                <img src="<?php echo htmlspecialchars($user['avatar']); ?>" alt="Avatar">
                            <?php else: ?>
                                <div class="avatar-placeholder">
                                    <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="dropdown-info">
                            <div class="dropdown-name"><?php echo htmlspecialchars($user['name']); ?></div>
                        </div>
                    </div>
                    
                    <div class="dropdown-divider"></div>
                    
                    <a href="profile.php" class="dropdown-item">
                        <span class="dropdown-icon">👤</span>
                        Mi Perfil
                    </a>
                    
                    <a href="settings.php" class="dropdown-item">
                        <span class="dropdown-icon">⚙️</span>
                        Configuración
                    </a>
                    
                    <a href="notifications.php" class="dropdown-item">
                        <span class="dropdown-icon">🔔</span>
                        Notificaciones
                    </a>
                    
                    <a href="help.php" class="dropdown-item">
                        <span class="dropdown-icon">💡</span>
                        Ayuda y Soporte
                    </a>
                    
                    <div class="dropdown-divider"></div>
                    
                    <a href="../../Controllers/AuthController.php?action=logout" class="dropdown-item logout">
                        <span class="dropdown-icon">🚪</span>
                        Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>
    </div>
    
</header>

<script>
// Función para toggle del dropdown de usuario
function toggleUserDropdown() {
    const dropdown = document.getElementById('userDropdown');
    dropdown.classList.toggle('show');
}

// Cerrar dropdown al hacer clic fuera
document.addEventListener('click', function(event) {
    const userMenu = document.querySelector('.user-menu');
    const dropdown = document.getElementById('userDropdown');
    
    if (!userMenu.contains(event.target)) {
        dropdown.classList.remove('show');
    }
});

// Marcar enlace activo en la navegación
document.addEventListener('DOMContentLoaded', function() {
    const currentPage = window.location.pathname.split('/').pop();
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        const href = link.getAttribute('href');
        
        if (href === currentPage || (currentPage === '' && href === 'dashboard.php')) {
            link.classList.add('active');
        }
    });
    
    // Actualizar hora actual
    updateCurrentTime();
    setInterval(updateCurrentTime, 1000);
    
    // Configurar búsqueda mejorada
    setupSearch();
    
    // Configurar indicadores de estado
    setupStatusIndicators();
});

// Función para actualizar la hora
function updateCurrentTime() {
    const now = new Date();
    const options = { 
        hour: '2-digit', 
        minute: '2-digit',
        weekday: 'short',
        day: 'numeric',
        month: 'short'
    };
    const timeString = now.toLocaleDateString('es-ES', options);
    const timeElement = document.getElementById('currentTime');
    if (timeElement) {
        timeElement.textContent = timeString;
    }
}

// Función para configurar la búsqueda mejorada
function setupSearch() {
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        // Animación de enfoque mejorada
        searchInput.addEventListener('focus', function() {
            this.parentElement.classList.add('search-focused');
        });
        
        searchInput.addEventListener('blur', function() {
            this.parentElement.classList.remove('search-focused');
        });
        
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch(this.value);
            }
        });
        
        // Búsqueda en tiempo real
        searchInput.addEventListener('input', function() {
            if (this.value.length > 2) {
                showSearchSuggestions(this.value);
            } else {
                hideSearchSuggestions();
            }
        });
    }
}

// Función para realizar búsqueda con mejoras
function performSearch(query) {
    if (query.trim()) {
        console.log('Buscando:', query);
        // Mostrar indicador de carga
        showSearchLoading();
        
        // Aquí irá la lógica de búsqueda real
        setTimeout(() => {
            hideSearchLoading();
            console.log('Búsqueda completada para:', query);
        }, 1000);
    }
}

// Función para mostrar sugerencias de búsqueda mejoradas
function showSearchSuggestions(query) {
    // Crear o actualizar el contenedor de sugerencias
    let suggestionsContainer = document.querySelector('.search-suggestions');
    if (!suggestionsContainer) {
        suggestionsContainer = document.createElement('div');
        suggestionsContainer.className = 'search-suggestions';
        document.querySelector('.search-container').appendChild(suggestionsContainer);
    }
    
    // Ejemplo de sugerencias
    const suggestions = [
        '📋 Estrategia de Marketing',
        '📈 Plan de Crecimiento',
        '📊 Análisis Financiero',
        '🏠 Gestión del Hogar'
    ].filter(item => item.toLowerCase().includes(query.toLowerCase()));
    
    suggestionsContainer.innerHTML = suggestions.map(suggestion => 
        `<div class="suggestion-item" onclick="selectSuggestion('${suggestion}')">${suggestion}</div>`
    ).join('');
    
    suggestionsContainer.style.display = suggestions.length > 0 ? 'block' : 'none';
}

// Función para ocultar sugerencias
function hideSearchSuggestions() {
    const suggestionsContainer = document.querySelector('.search-suggestions');
    if (suggestionsContainer) {
        suggestionsContainer.style.display = 'none';
    }
}

// Función para seleccionar una sugerencia
function selectSuggestion(suggestion) {
    document.querySelector('.search-input').value = suggestion.replace(/^[^\s]+\s/, '');
    hideSearchSuggestions();
    performSearch(suggestion);
}

// Funciones de carga
function showSearchLoading() {
    const searchIcon = document.querySelector('.search-icon');
    if (searchIcon) {
        searchIcon.textContent = '⏳';
        searchIcon.style.animation = 'spin 1s infinite linear';
    }
}

function hideSearchLoading() {
    const searchIcon = document.querySelector('.search-icon');
    if (searchIcon) {
        searchIcon.textContent = '🔍';
        searchIcon.style.animation = 'none';
    }
}

// Función para configurar indicadores de estado
function setupStatusIndicators() {
    // Actualizar estado de conexión
    const statusIndicator = document.querySelector('.status-indicator');
    if (statusIndicator) {
        // Simular estados de conexión
        setInterval(() => {
            const isOnline = navigator.onLine;
            statusIndicator.textContent = isOnline ? '🟢 En línea' : '🔴 Sin conexión';
            statusIndicator.style.color = isOnline ? '#5d4e37' : '#d64545';
        }, 5000);
    }
}
</script>
