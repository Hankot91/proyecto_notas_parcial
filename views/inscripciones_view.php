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
    <link rel="stylesheet" href="../css/style.css">
    <title>Inscripciones</title>
</head>

<body>
    <header>
        <nav>
            <a href="../index.php">Inicio</a>
        </nav>
    </header>
    <h1>INSCRIPCIONES</h1>
    <!--Busqueda de inscripciones -->
    <form method="GET" action="">
        <input type="number" name="buscar" placeholder="Dato" required>
        <input type="submit" name="buscar_submit" value="Buscar">
    </form>
    <br>


    <!--Llamado del template para registrar inscripciones de estudiantes en cursos -->
    <?php if ($getRegister === true): ?>
        <?php require_once "templates/inscripciones/registrar_inscripciones.php"; ?>
    <?php else: ?>
        <form method="GET">
            <input type="hidden" name="register" value="true">
            <input type="submit" value="Registro nuevo">
        </form>
    <?php endif; ?>


    <?php if ($getView === false): ?>
        <br>
        <a href="/views/inscripciones_view.php?view=true" name="verTodos">Ver todos</a>
        <br>
        <?php require_once "footer.php"; ?>
    <?php else: ?>
        <table>
            <?php if (!empty($inscripcionesData)): ?>
                <?php if ($getShow === true): ?>
                    <!--Llamado del template para las acciones de inscripciones -->
                    <br>
                    <a href="../views/inscripciones_view.php">Regresar</a>
                    <br>
                    <?php require_once "templates/inscripciones/acciones_inscripciones.php" ?>
                <?php else: ?>
                    <!--Llamado del template para listar las inscripciones -->
                    <br>
                    <a href="../views/inscripciones_view.php">Ocultar</a>
                    <br>
                    <?php require_once "templates/inscripciones/lista_inscripciones.php" ?>
                <?php endif; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No hay registros.</td>
                </tr>

            <?php endif; ?>
        </table>

    <?php endif; ?>

    <script src="../js/inscripciones.js"></script>
</body>

</html>