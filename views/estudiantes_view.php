<?php
require_once "../controllers/estudiantes_controller.php";
$estudiantesData = (new EstudiantesController())->handleRequest();
$getView = isset($_GET['view']) || isset($_GET['buscar']);
$getShow = isset($_GET['show']);
$getRegister = isset($_GET['register']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Estudiantes</title>
</head>

<body>
    <header>
        <nav>
            <a href="../index.php">Inicio</a>
        </nav>
    </header>
    <h1>ESTUDIANTES</h1>
    <!--Busqueda de estudiante -->
    <form method="GET">
        <input type="text" name="buscar" placeholder="Dato" required>
        <input type="submit" value="Buscar estudiante">
    </form>
    <br>

    <!--Llamado del template para registrar estudiantes -->
    <?php if ($getRegister === true): ?>
        <?php require_once "templates/estudiantes/registrar_estudiantes.php"; ?>
    <?php else: ?>
        <form method="GET">
            <input type="hidden" name="register" value="true">
            <input type="submit" value="Registro nuevo">
        </form>
    <?php endif; ?>


    <?php if ($getView === false): ?>
        <br>
        <a href="/views/estudiantes_view.php?view=true">Ver todos</a>
        <br>
        <?php require_once "footer.php"; ?>
    <?php else: ?>
        <?php if (!empty($estudiantesData)): ?>
            <!--Llamado del template para las acciones de estudiantes -->
            <?php if ($getShow === true): ?>
                <br>
                <a href="../views/estudiantes_view.php">Regresar</a>
                <br>
                <?php require_once "templates/estudiantes/acciones_estudiantes.php" ?>
            <?php else: ?>
                <!--Llamado del template para listar los estudiantes -->
                <br>
                <a href="../views/estudiantes_view.php">Ocultar</a>
                <br>
                <?php require_once "templates/estudiantes/lista_estudiantes.php" ?>
            <?php endif; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No hay registros.</td>
            </tr>
        <?php endif; ?>
        </table>
    <?php endif; ?>

    <script src="../js/estudiantes.js"></script>
</body>

</html>