<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $asunto = trim($_POST['asunto']);
    $mensaje = trim($_POST['mensaje']);

    // Configuración de la conexión a la base de datos
    $host = "localhost";
    $usuario = "root"; // Usuario por defecto en XAMPP
    $password = ""; // Contraseña vacía por defecto
    $baseDatos = "dyd"; // Nombre de la base de datos

    // Crear conexión
    $conexion = new mysqli($host, $usuario, $password, $baseDatos);

    // Verificar conexión
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Preparar consulta
    $stmt = $conexion->prepare("INSERT INTO formulario (Nombre, Email, Asunto, Mensaje) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    // Vincular parámetros
    $stmt->bind_param("ssss", $nombre, $email, $asunto, $mensaje);

    // Ejecutar consulta
    if ($stmt->execute()) {
        echo "Datos guardados correctamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conexion->close();

    // Mostrar los datos procesados
    echo "Nombre: " . htmlspecialchars($nombre) . "<br>";
    echo "Email: " . htmlspecialchars($email) . "<br>";
    echo "Asunto: " . htmlspecialchars($asunto) . "<br>";
    echo "Mensaje: " . htmlspecialchars($mensaje);
}
?>
