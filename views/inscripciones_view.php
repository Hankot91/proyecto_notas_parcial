<?php
require_once "../controllers/inscripciones_controller.php";
$inscripcionesData = (new InscripcionesController())->handleRequest();
$cursosData = (new InscripcionesController())->handleReturnCursos();
$estudiantesData = (new InscripcionesController())->handleReturnEstudiantes();
$getView = isset($_GET['view']) || isset($_GET['buscar']);
$getShow = isset($_GET['show']);
$getRegister = isset($_GET['register']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.svg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/stylesIndex.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Inscripciones</title>
</head>

<body>
    <header class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="inscripciones_view.php">Inicio</a>
        <?php require_once "header.php"; ?>
    </header>

    <!--Busqueda de inscripciones -->
    <div class="row justify-content-center offClick">
        <form method="GET" class="row_form">
            <input type="text" name="buscar" class="form-control-lg input_search" placeholder="Dato" required>
            <button class="btn btn-primary ms-2">Buscar <i class="fa-solid fa-eye" style="color: #ffffff;"></i></button>
        </form>
    </div>
    <br>
    <br>

    <!--Llamado del template para registrar inscripciones de estudiantes en cursos -->
    <?php if ($getRegister === true): ?>

        <?php require_once "templates/inscripciones/registrar_inscripciones.php"; ?>
    <?php else: ?>
        <div class="container_form">
            <h3 class="text-info fw-bold">INSCRIPCIONES</h3>
            <br>
            <form method="GET">
                <input type="hidden" name="register" value="true">
                <button class="btn btn-primary me-3 ms-md-auto">Registro nuevo <i
                        class="fa-solid fa-circle-plus"></i></button>
            </form>
        </div>
    <?php endif; ?>


    <?php if ($getView === false): ?>
        <div class="container_form">
            <br>
            <a href="/views/inscripciones_view.php?view=true"><i class="fa-regular fa-eye form_button"></i></a>
            <br>
        </div>
        <?php require_once "footer.php"; ?>
    <?php else: ?>
        <?php if (!empty($inscripcionesData)): ?>
            <?php if ($getShow === true): ?>
                <!--Llamado del template para las acciones de inscripciones -->
                <br>
                <br>
                <div class="container_back">
                    <button onclick="window.location.href = 'inscripciones_view.php';" class="btn btn-primary ms-2">
                        <i class="fa-solid fa-arrow-right-to-bracket arrow_back" style="color: #ffffff;"></i> Regresar
                    </button>
                </div>
                <?php require_once "templates/inscripciones/acciones_inscripciones.php" ?>
            <?php else: ?>
                <!--Llamado del template para listar las inscripciones -->
                <div class="container_form">
                    <br>
                    <a href="../views/inscripciones_view.php"><i class="fa-regular fa-eye-slash form_button"
                            class="form_button"></i></a>
                    <br>
                </div>
                <?php require_once "templates/inscripciones/lista_inscripciones.php" ?>
            <?php endif; ?>
        <?php else: ?>
            <div class="container_form">
                <h4 class="text-info fw-bold">No hay registros</h4>
                <br>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <script src="js/inscripciones.js"></script>
    <?php require_once "footer.php" ?>