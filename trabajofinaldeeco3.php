<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tadeo Fernandez Sosa - Votación en Vivo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.1/dist/chart.umd.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            text-align: center;
            padding: 20px;
        }
        .btn-enviar {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
        }
    </style></head>
<body>

    <h1>Formulario de comidas deliciosas</h1>
    <h3>Elegí tu combo favorito</h3>

    <div class="container mt-4">
        <form id="formVoto">
            <div class="mb-3">
                <select name="combo" id="combo" class="form-select" required>
                    <option value="">Elige una opción</option>
                    <option value="1">Combo 1 - Milanesa con puré...</option>
                    <option value="2">Combo 2 - Medallones de pescado...</option>
                    <option value="3">Combo 3 - Bombas de papa...</option>
                    <option value="4">Combo 4 - Sopas de verduras...</option>
                    <option value="5">Combo 5 - Empanadas de carne...</option>
                    <option value="6">Combo 6 - Hamburguesas picantes...</option>
                </select>
            </div>
            <button type="submit" class="btn-enviar">Votar</button>
        </form>
    </div>

    <div class="container mt-5">
        <h3 class="text-center mb-3">Resultados de las votaciones</h3>
        <canvas id="graficoVotos"></canvas>
    </div>

    <script>
    const ctx = document.getElementById('graficoVotos');
    let chart;

    // Función para cargar los votos actuales
    async function cargarVotos() {
        const response = await fetch('votos.json?nocache=' + Date.now());
        const datos = await response.json();
        const labels = Object.keys(datos);
        const values = Object.values(datos);

        if (chart) chart.destroy(); // Si ya existe un gráfico, lo destruye

        chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Cantidad de votos',
                    data: values,
                    backgroundColor: 'rgba(52, 152, 219, 0.7)',
                    borderColor: 'rgba(41, 128, 185, 1)',
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                scales: { y: { beginAtZero: true } },
                plugins: { legend: { display: false } }
            }
        });
    }

    // Llamamos a cargar los votos al inicio
    cargarVotos();

    // Evento del formulario
    document.getElementById('formVoto').addEventListener('submit', async (e) => {
        e.preventDefault();

        const combo = document.getElementById('combo').value;
        if (!combo) return alert("Seleccioná un combo antes de votar");

        // Envía el voto por POST (sin recargar)
        const response = await fetch('guardar_voto.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'combo=' + combo
        });

        const data = await response.text();
        alert(data);
        await cargarVotos(); // Actualiza el gráfico en vivo
    });

    // Actualiza el gráfico cada 5 segundos automáticamente
    setInterval(cargarVotos, 5000);
    </script>
</body>
</html>
