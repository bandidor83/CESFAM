<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - CESFAM Rocas de Santo Domingo</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'components/header.php'; ?>

    <main class="contacto-container">
        <h2 class="section-title">Contacto</h2>

        <div class="contacto-content">
            <div class="info-contacto">
                <h3>Información de Contacto</h3>
                <div class="info-item">
                    <strong>Dirección:</strong>
                    <p>Las Hortencias 146, Santo Domingo</p>
                </div>
                <div class="info-item">
                    <strong>Teléfono:</strong>
                    <p>(35) 2204500</p>
                </div>
                <div class="info-item">
                    <strong>Horario de Atención:</strong>
                    <p>Lunes a Viernes: 8:00 - 17:00 hrs</p>
                    <p>Sábado: 8:00 - 13:00 hrs</p>
                </div>
            </div>

            <div class="mapa">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1174.3243311410395!2d-71.61197898160029!3d-33.64444282908683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x96623786e51b4f45%3A0x2b10c3130a77c7e5!2sCentro%20de%20Salud%20Rural%20Fernando%20Rodr%C3%ADguez%20Vicu%C3%B1a!5e0!3m2!1ses!2scl!4v1739935630265!5m2!1ses!2scl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
           </div>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>
</body>
</html>

<style>
.servicios-container,
.contacto-container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.section-title {
    text-align: center;
    color: #1a237e;
    margin-bottom: 2rem;
    font-size: 2.5rem;
}

/* Estilos para servicios */
.servicios-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.servicio-card {
    background: #fff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.servicio-card h3 {
    color: #1a237e;
    margin-bottom: 1rem;
}

.servicio-card ul {
    list-style: none;
    padding: 0;
}

.servicio-card ul li {
    margin-bottom: 0.5rem;
    padding-left: 1.5rem;
    position: relative;
}

.servicio-card ul li:before {
    content: "•";
    color: #3498db;
    position: absolute;
    left: 0;
}

/* Estilos para contacto */
.contacto-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.info-contacto {
    background: #fff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.info-item {
    margin-bottom: 1.5rem;
}

.info-item strong {
    display: block;
    color: #1a237e;
    margin-bottom: 0.5rem;
}

.mapa {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Estilos responsivos */
@media (max-width: 768px) {
    .contacto-content {
        grid-template-columns: 1fr;
    }
}
</style> 