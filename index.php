<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Galería AJAX</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{

    height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    background:linear-gradient(135deg,#141e30,#243b55);

    font-family:Arial;

}

.contenedor{

    width:500px;

    background:white;

    padding:40px;

    border-radius:20px;

    box-shadow:0 10px 30px rgba(0,0,0,0.3);

}

.nav-tabs .nav-link{

    color:#243b55;

    font-weight:bold;

}

.btn-principal{

    background:#243b55;

    color:white;

    width:100%;

}

.btn-principal:hover{

    background:#1d3045;

    color:white;

}

</style>

</head>
<body>

<div class="contenedor">

    <ul class="nav nav-tabs mb-4" id="tabs">

        <li class="nav-item">

            <button 
                class="nav-link active"
                data-bs-toggle="tab"
                data-bs-target="#login"
            >
                Iniciar Sesión
            </button>

        </li>

        <li class="nav-item">

            <button 
                class="nav-link"
                data-bs-toggle="tab"
                data-bs-target="#registro"
            >
                Registrarse
            </button>

        </li>

    </ul>

    <div class="tab-content">

        <!-- LOGIN -->

        <div class="tab-pane fade show active" id="login">

            <form action="auth/login.php" method="POST">

                <div class="mb-3">

                    <label>Correo</label>

                    <input 
                        type="email"
                        name="correo"
                        class="form-control"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Contraseña</label>

                    <input 
                        type="password"
                        name="password"
                        class="form-control"
                        required
                    >

                </div>

                <button class="btn btn-principal">

                    Ingresar

                </button>

            </form>

        </div>

        <!-- REGISTRO -->

        <div class="tab-pane fade" id="registro">

            <form action="auth/guardar_usuario.php" method="POST">

                <div class="mb-3">

                    <label>Nombre</label>

                    <input 
                        type="text"
                        name="nombre"
                        class="form-control"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Correo</label>

                    <input 
                        type="email"
                        name="correo"
                        class="form-control"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label>Contraseña</label>

                    <input 
                        type="password"
                        name="password"
                        class="form-control"
                        required
                    >

                </div>

                <button class="btn btn-principal">

                    Registrarse

                </button>

            </form>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>