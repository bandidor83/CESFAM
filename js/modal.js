document.addEventListener('DOMContentLoaded', function() {
    // Formatear RUT (solo con guion)
    const formatRut = (rut) => {
        rut = rut.replace(/[^0-9kK]/g, '');
        if(rut.length > 1) {
            rut = rut.slice(0, -1) + '-' + rut.slice(-1);
        }
        return rut;
    };

    // Event listener para formateo de RUT
    const rutInput = document.getElementById('modal_rut');
    if (rutInput) {
        rutInput.addEventListener('input', (e) => {
            e.target.value = formatRut(e.target.value);
        });
    }

    // Código para el modal
    const modal = document.getElementById('loginModal');
    const openBtn = document.getElementById('openLoginModal');
    const closeBtn = document.querySelector('.close');

    if (openBtn) {
        openBtn.onclick = function() {
            modal.style.display = "block";
        }
    }

    if (closeBtn) {
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Función para verificar si las ventanas emergentes están bloqueadas
    function checkPopupBlocker() {
        const testPopup = window.open('about:blank', 'test', 'width=1,height=1');
        if (!testPopup || testPopup.closed || typeof testPopup.closed === 'undefined') {
            alert('Por favor, permite las ventanas emergentes para este sitio para poder acceder al sistema.');
            return false;
        }
        testPopup.close();
        return true;
    }

    // Verificar el bloqueador de ventanas emergentes al cargar la página
    checkPopupBlocker();
}); 