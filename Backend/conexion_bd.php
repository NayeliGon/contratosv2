<?php
// Configuración de la conexión a la base de datos usando PDO
$db_host = '34.203.242.2:3306';
$db_name = 'corpo_contratos';
$db_username = 'corpo';
$db_password = 'CorpoS24#'; // Cambia si tienes una contraseña configurada

try {
    // Crear la conexión usando PDO
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8"); // Asegura la codificación UTF-8
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
