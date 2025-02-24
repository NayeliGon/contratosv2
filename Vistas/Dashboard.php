<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Contratos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Assets/css/sidebar.css">
</head>




<body>
    <!-- Sidebar -->
    <div class="sidebar closed" id="sidebar">
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </div>
        <a href="Dashboard.php" class="active"><i class="fas fa-home"></i> <span>Inicio</span></a>
<a href="reenviar_contratos.php"><i class="fas fa-file-contract"></i> <span>Contratos Generados</span></a>
<a href="usuarios.php"><i class="fas fa-users"></i> <span>Usuarios</span></a>
<a href="../Backend/logout.php"><i class="fas fa-sign-out-alt"></i> <span>Cerrar Sesión</span></a>

</div>
<div class="content">
    <header class="text-center">
        <h1>Gestión de Contratos</h1>
    </header>

    <div class="container dashboard-container">
        <div class="row justify-content-center g-4">
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card w-100" onclick="location.href='ContratoA.php'">
                    <div class="card-body text-center">
                        <i class="fas fa-file-contract card-icon"></i>
                        <h3 class="card-title mt-3">Contrato para Sociedad Anonima</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card w-100" onclick="location.href='Contrato.php'">
                    <div class="card-body text-center">
                        <i class="fas fa-file-signature card-icon"></i>
                        <h3 class="card-title mt-3">Contrato con Patente</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card w-100" onclick="location.href='ContratoC.php'">
                    <div class="card-body text-center">
                        <i class="fas fa-id-card card-icon"></i>
                        <h3 class="card-title mt-3">Contrato con RTU</h3>
                    </div>
                </div>
            </div>
        </div>
        </br>
        <div class="row justify-content-center g-4">
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card w-100" onclick="location.href='ContratoA.php'">
                    <div class="card-body text-center">
                        <i class="fas fa-utensils card-icon"></i>
                        <h3 class="card-title mt-3">Contrato de Punto de Venta y Restaurantes</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card w-100" onclick="location.href='Contrato.php'">
                    <div class="card-body text-center">
                        <i class="fas fa-user-tie card-icon"></i>
                        <h3 class="card-title mt-3">Contrato con Distribuidores</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <footer>
        <p>Sistema de Gestión de Contratos &copy; 2025</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('closed');
        }
    </script>
</body>

</html>