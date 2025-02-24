<?php
require_once '.../Backend/conexion_bd.php';

// Obtener el representante de la BD
$sql = "SELECT nombre, dpi, fecha_nacimiento FROM tbrepresentante LIMIT 1";
$result = $conn->query($sql);

$representante = [
    "nombre" => "",
    "dpi" => "",
    "fecha_nacimiento" => ""
];

if ($result->num_rows > 0) {
    $representante = $result->fetch_assoc();
}
$conn->close();
?>

