<?php
require_once 'Envio.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $ciudad = $_POST["ciudad"];
    $peso = floatval($_POST["peso"]);
    $servicio = $_POST["servicio"];
    $valorDeclarado = floatval($_POST["valor_declarado"]);

    // Crear instancia de la clase Envio
    $envio = new Envio($peso, $servicio, $valorDeclarado);
    $costoTotal = $envio->calcularCostoTotal();
    $detalles = $envio->obtenerDetalles();

    echo "<h2>Resumen del Envío</h2>";
    echo "<p><strong>Cliente:</strong> $nombre</p>";
    echo "<p><strong>Destino:</strong> $direccion, $ciudad</p>";
    echo "<p><strong>Peso del Paquete:</strong> $peso kg</p>";
    echo "<p><strong>Tipo de Servicio:</strong> " . ucfirst($servicio) . "</p>";
    echo "<p><strong>Valor Declarado:</strong> $" . number_format($valorDeclarado, 2) . "</p>";

    echo "<h3>Detalle de Costos</h3>";
    foreach ($detalles as $key => $value) {
        echo "<p><strong>$key:</strong> $" . number_format($value, 2) . "</p>";
    }

    echo "<h3>Total a Pagar: $" . number_format($costoTotal, 2) . "</h3>";
} else {
    echo "<p>Error: No se han enviado datos.</p>";

}
?>




