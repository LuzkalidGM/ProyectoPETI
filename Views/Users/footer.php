<footer class="footer">
    <div class="footer-container">
        <!-- Información principal -->
        <div class="footer-main">
            <div class="footer-logo">
                <span class="footer-logo-text">PETTY</span>
            </div>
            
            
        </div>
        
        <!-- Línea divisoria -->
        <div class="footer-divider"></div>
        
        <!-- Footer bottom -->
        <div class="footer-bottom">
            <div class="footer-copyright">
                <p>&copy; <?php echo date('Y'); ?> PlanMaster. Todos los derechos reservados.</p>
                <p class="footer-version">Versión 1.0.0 | Desarrollado con para empresarios</p>
            </div>
            
            
        </div>
    </div>
    
    <!-- Botón de volver arriba -->
    <button class="back-to-top" onclick="scrollToTop()" title="Volver arriba">
        ↑
    </button>
</footer>

<script>
// Función para volver arriba
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Mostrar/ocultar botón de volver arriba
window.addEventListener('scroll', function() {
    const backToTopBtn = document.querySelector('.back-to-top');
    if (window.pageYOffset > 300) {
        backToTopBtn.classList.add('show');
    } else {
        backToTopBtn.classList.remove('show');
    }
});

// Newsletter subscription
document.addEventListener('DOMContentLoaded', function() {
    const newsletterBtn = document.querySelector('.newsletter-btn');
    const newsletterInput = document.querySelector('.newsletter-input');
    
    if (newsletterBtn && newsletterInput) {
        newsletterBtn.addEventListener('click', function() {
            const email = newsletterInput.value.trim();
            
            if (email && isValidEmail(email)) {
                // Simulación de suscripción exitosa
                newsletterInput.value = '';
                showNotification('¡Gracias por suscribirte!', 'success');
            } else {
                showNotification('Por favor ingresa un email válido', 'error');
            }
        });
        
        newsletterInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                newsletterBtn.click();
            }
        });
    }
});

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function showNotification(message, type) {
    // Crear notificación temporal
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        z-index: 10000;
        animation: slideInRight 0.3s ease-out;
        ${type === 'success' ? 'background: #4caf50;' : 'background: #f44336;'}
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease-in';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}
