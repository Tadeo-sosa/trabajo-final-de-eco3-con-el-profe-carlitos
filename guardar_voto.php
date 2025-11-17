<?php
// Archivo donde se guardan los votos
$archivo = "votos.json";

// Si el archivo no existe, se crea con todos los combos en 0
if (!file_exists($archivo)) {
    $votosIniciales = [
        "Combo 1" => 0,
        "Combo 2" => 0,
        "Combo 3" => 0,
        "Combo 4" => 0,
        "Combo 5" => 0,
        "Combo 6" => 0
    ];
    file_put_contents($archivo, json_encode($votosIniciales, JSON_PRETTY_PRINT));
}

// Cargar votos actuales
$votos = json_decode(file_get_contents($archivo), true);

// Obtener el combo votado
if (isset($_POST['combo'])) {
    $comboSeleccionado = intval($_POST['combo']);
    $clave = "Combo " . $comboSeleccionado;

    if (isset($votos[$clave])) {
        $votos[$clave]++;
        file_put_contents($archivo, json_encode($votos, JSON_PRETTY_PRINT));
        echo "su voto registrado para $clave!";
    } else {
        echo " combo no encontrado.";
    }
} else {
    echo "no se recibió ningún voto.";
}
?>
