<html>
<head>
<title>Tadeo Fernandez Sosa</title>
<link rel="stylesheet" href="diseño-css-del-trabajo-final.css">

</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<body>

<i><h1>Formulario de comidas deliciosas</h1></i>
<i><h3>Eliga uno de los siguiente alimentos que quiera</h3></i>    

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.1/dist/chart.umd.min.js"></script>

<div class="container mt-4">
    <form method="POST" class="formulario">
        <div class="mb-3">
            <label class="form-label">Seleccione su combo favorito:</label>
            <select name="combo" class="form-select" required>
                <option value=""> Elige una opción </option>
                <option value="1">Combo 1 - Milanesa con pure + 1 gaseosa + postre de helado con tres sabores (vainilla,frutilla y chocolate)</option>
                <option value="2">Combo 2 - 4 Medallones de pescado con ensalada de apio + 1 levite sabor pomelo y de postre 2 mouffins de tofu</option>
                <option value="3">Combo 3 - 4 bombas de papa de queso + 2 porción de tarta de queso + 2 chuleta jugosa y de postre 2 porciones de torta selva negra</option>
                <option value="4">Combo 4 - 2 Sopas de verduras de la estación que tuvo carne pero se la sacaron y de postre 1 flan casero</option>
                <option value="5">Combo 5 - Media docena de empanada de carne + 1 gaseosa y de postre queso con membrillo</option>
                <option value="6">Combo 6 - 2 Hamburguesas extra picantes + 1 gaseosa y de postre humus sabor panceta</option>
            </select>
        </div>
        <button type="submit" class="btn-enviar">Votar</button>
    </form>
</div>

<?php

$resultados = [
    "La insuperable" => 0,
    "La Finoli" => 0,
    "La pesada" => 0,
    "Sopa de Tubo" => 0,
    "El Patriota" => 0,
    "Diablo ácido" => 0
];
?>

<div class="container mt-5">
    <h3 class="text-center mb-3">Resultados de las votaciones</h3>
    <canvas id="graficoVotos"></canvas>
</div>

<script>
const ctx = document.getElementById('graficoVotos');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode(array_keys($resultados)); ?>,
        datasets: [{
            label: 'Cantidad de votos',
            data: <?php echo json_encode(array_values($resultados)); ?>,
            backgroundColor: 'rgba(52, 152, 219, 0.7)',
            borderColor: 'rgba(41, 128, 185, 1)',
            borderWidth: 1,
            borderRadius: 6
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        },
        plugins: {
            legend: { display: false }
        }
    }
});
</script>




</body>
</html>