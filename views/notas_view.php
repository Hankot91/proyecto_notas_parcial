<?php
require_once "../controllers/notas_controller.php";
$notasData = (new notasController())->handleRequest();
$cursosData = (new notasController())->handleReturnCursos();
$getView = isset($_GET['view']) || isset($_GET['buscar']);
$getShow = isset($_GET['show']);
$getRegister = isset($_GET['register']);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/stylesIndex.css">
    <title>Notas</title>
</head>
<body>
<header>
    <div class="panel">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php?">Menu</a>
        <?php require_once "header.php"; ?>
    </header>
    <!--Busqueda de notas -->
    <div class="row justify-content-center offClick">
        <form method="GET" class="row_form">
            <input type="text" name="buscar" class="form-control-lg input_search" placeholder="Dato" required>
            <button  class="btn btn-primary ms-2">Buscar <i class="fa-solid fa-eye" style="color: #ffffff;"></i></button>
        </form>
    </div>
    <br>
    <br>

    <?php if ($getRegister === true): ?>
        <?php require_once "templates/notas/registrar_notas.php"; ?>
    <?php else: ?>
        <div class="container_form">
            <h3 class="text-info fw-bold">NOTAS</h3>
            <br>
        <form method="GET">
            <input type="hidden" name="register" value="true">
            <input type="submit" value="Registro nuevo">
        </form>
    <?php endif; ?>

    
    <?php if ($getView === false): ?>
        <br>
        <a href="/views/notas_view.php?view=true" name="verTodos">Ver todos</a>
        <br>
        <?php require_once "footer.php"; ?>
    <?php else: ?>
        <table>
            <?php if (!empty($notasData)): ?>
                <?php if ($getShow === true): ?>
                    <!--Llamado del template para las acciones de notas -->
                    <br>
                    <a href="../views/notas_view.php">Regresar</a>
                    <br>
                    <?php require_once "templates/notas/acciones_notas.php" ?>
                <?php else: ?>
                    <!--Llamado del template para listar las notas -->
                    <br>
                    <a href="../views/notas_view.php">Ocultar</a>
                    <br>
                    <?php require_once "templates/notas/lista_notas.php" ?>
                <?php endif; ?>
            <?php else: ?>
                <tr>
                    <br>
                    <a href="../views/notas_view.php">Regresar</a>
                    <br>
                    <td colspan="5">No hay registros.</td>
                </tr>

            <?php endif; ?>
        </table>

    <?php endif; ?>
    <script src="js/notas.js"></script>
    <?php require_once "footer.php"?>