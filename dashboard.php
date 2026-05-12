
<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.navbar{
    background:#1e3c72;
}

.navbar-brand{
    color:white;
    font-weight:bold;
}

.carrusel-img{
    height:500px;
    object-fit:cover;
    border-radius:20px;
}

.card{
    border:none;
    border-radius:20px;
}

</style>

</head>
<body>

<nav class="navbar navbar-dark px-4">

    <span class="navbar-brand">
        Bienvenido <?= $_SESSION['usuario'] ?>
    </span>

    <a href="logout.php" class="btn btn-light">
        Cerrar sesión
    </a>

</nav>

<div class="container mt-5">

    <!-- SUBIR -->
    <div class="card shadow p-4 mb-5">

        <h3 class="mb-4">Subir Imagen</h3>

        <form id="formImagen" enctype="multipart/form-data">

            <div class="row">

                <div class="col-md-10">
                    <input 
                        type="file"
                        name="imagen"
                        class="form-control"
                        required
                    >
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100">
                        Subir
                    </button>
                </div>

            </div>

        </form>

    </div>

    <!-- CARRUSEL -->
    <div id="carouselExample" class="carousel slide">

        <div class="carousel-inner" id="contenedorCarrusel">

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

    </div>

    <!-- GALERIA -->
    <div class="row mt-5" id="galeria">

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/app.js"></script>

</body>
</html>