<?php
require '../../../Backend/conexion_bd.php';

if (isset($_GET['id_contrato'])) {
    $id_contrato = $_GET['id_contrato'];
    
    $sql = "SELECT * FROM contratos_a WHERE id_contrato = :id_contrato";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_contrato', $id_contrato, PDO::PARAM_INT);

    try {
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Contrato no encontrado.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;
}
?>
