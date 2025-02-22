<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CorpoContratos</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Roboto', sans-serif;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 12px;
            overflow: hidden;
            background-color:rgb(255, 255, 255);
        }

        .login-container {
            padding: 30px;
            border-radius: 12px;
        }

        .login-header {
            color: #555;
            font-weight: 700;
        }

        .btn-primary {
            background-color: #d32f2f;
            border: none;
        }

        .btn-primary:hover {
            background-color: #b71c1c;
        }

        .login-image {
            background-color: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-image img {
            max-width: 80%;
        }

        label {
            font-weight: 500;
        }

        .form-control {
            border-radius: 6px;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow-lg">
                    <div class="row g-0">

                        <div class="col-md-5 login-image">
                            <img src="./Assets/img/logos/logo.png" alt="Logo">
                        </div>

                        <div class="col-md-7 d-flex align-items-center">
                            <div class="login-container w-100">
                                <h2 class="text-center login-header mb-4">Iniciar Sesión</h2>
                                <form action="./Backend/login.php" method="POST">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Correo Electrónico</label>
                                        <input type="email" class="form-control" id="email" name="correo" placeholder="Ingresa tu correo" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control" id="password" name="contrasena" placeholder="Ingresa tu contraseña" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
