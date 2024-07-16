<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago con Yape</title>
</head>
<body>
    <h1>Generar Código QR para Pago con Yape</h1>
    <form method="POST" action="">
        <label for="monto">Monto (S/):</label>
        <input type="number" id="monto" name="monto" step="0.01" required>
        <br><br>
        <label for="descripcion">Descripción del Producto:</label>
        <input type="text" id="descripcion" name="descripcion" required>
        <br><br>
        <button type="submit">Generar Código QR</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Mostrar errores para depuración
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        // Incluir la biblioteca phpqrcode
        include('phpqrcode/qrlib.php');

        // Obtener los datos del formulario
        $monto = htmlspecialchars($_POST['monto']);
        $descripcion = htmlspecialchars($_POST['descripcion']);

        // Formato de datos para Yape
        $numeroYape = "925620168"; // Reemplaza esto con tu número de Yape
        $yape_info = "YAPE|$numeroYape|$monto|$descripcion";

        // Nombre del archivo donde se guardará el código QR
        $nombre_archivo = 'yape_pago.png';

        // Generar y guardar el código QR
        QRcode::png($yape_info, $nombre_archivo, QR_ECLEVEL_L, 10, 4);

        // Mostrar el código QR en el navegador
        echo '<h2>Escanea para pagar con Yape</h2>';
        echo '<img src="'.$nombre_archivo.'" alt="Pago con Yape" />';
    }
    ?>
</body>
</html>
