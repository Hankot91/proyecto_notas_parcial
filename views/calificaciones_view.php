<?php
require_once "../controllers/calificaciones_controller.php";
$calificacionesData = (new CalificacionesController())->handleRequest();
$cursosData = (new CalificacionesController())->handleReturnCursos();
$notasData = (new CalificacionesController())->handleReturnNotas();
$getView = isset($_GET['view']) || isset($_GET['buscar']);
$getShow = isset($_GET['show']);
$getRegister = isset($_GET['register']);

?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Calificaciones</title>
</head>
<body>
    <header>
        <nav>
            <a href="../index.php">Inicio</a>
        </nav>
    </header>

    <h1>CALIFICACIONES</h1>
    <!--Busqueda de calificacioness -->
    <form method="GET">
        <input type="text" name="buscar" placeholder="Dato" required>
        <input type="submit" name="buscar_submit" value="Buscar">
    </form>
    <br>


    <!--Llamado del template para registrar calificaciones de estudiantes en cursos -->
    <?php if ($getRegister === true): ?>
        <?php require_once "templates/calificaciones/registrar_calificaciones.php"; ?>
    <?php else: ?>
        <form method="GET">
            <input type="hidden" name="register" value="true">
            <input type="submit" value="Registro nuevo">
        </form>
    <?php endif; ?>

    <?php if ($getView === false): ?>
        <br>
        <a href="/views/calificaciones_view.php?view=true">Ver todos</a>
        <br>
        <?php require_once "footer.php"; ?>
    <?php else: ?>
        <?php if (!empty($calificacionesData)): ?>
            <!--Llamado del template para las acciones de estudiantes -->
            <?php if ($getShow === true): ?>
                <br>
                <a href="../views/calificaciones_view.php">Regresar</a>
                <br>
                <?php require_once "templates/calificaciones/acciones_calificaciones.php" ?>
            <?php else: ?>
                <!--Llamado del template para listar los estudiantes -->
                <br>
                <a href="../views/calificaciones_view.php">Ocultar</a>
                <br>
                <?php require_once "templates/calificaciones/lista_calificaciones.php" ?>
            <?php endif; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No hay registros.</td>
            </tr>
        <?php endif; ?>
        </table>
    <?php endif; ?>
<script src="js/calificaciones.js"></script>
</body>
</html>