document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.registro-form');
    const rutInput = document.getElementById('rut');

    // Formatear RUT mientras se escribe
    rutInput.addEventListener('input', function(e) {
        let rut = e.target.value.replace(/[^0-9kK-]/g, '')
                              .replace(/^(\d{2})(\d)/, '$1.$2')
                              .replace(/^(\d{2}\.\d{3})(\d)/, '$1.$2')
                              .replace(/\.(\d{3})(\d)/, '.$1-$2');
        e.target.value = rut;
    });

    // Validación del formulario
    form.addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Las contraseñas no coinciden');
        }

        if (password.length < 6) {
            e.preventDefault();
            alert('La contraseña debe tener al menos 6 caracteres');
        }
    });
}); 