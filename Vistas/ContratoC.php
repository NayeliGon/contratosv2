<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato Clientes </title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../Assets/css/conA.css">
    <link rel="stylesheet" href="../Assets/css/sidebar.css">

    <style>
    </style>
</head>

<body>
   
    <!-- Sidebar -->
     <?php include "./side/side_C.php"?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Card -->
                <?php include "../Vistas/cards/Contrato_C/Cre_contra.php";?>
                <!-- End of Card -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('closed');
        }
    </script>
</body>

</html>
