<?php
require_once "../controllers/cursos_controller.php";
$cursosData = (new CursosController())->handleRequest();
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
    <title>Cursos</title>
</head>

<body>
    <header>
        <nav>
            <a href="../index.php">Inicio</a>
        </nav>
    </header>
    <h1>CURSOS</h1>

    <!--Busqueda de cursos -->
    <form method="GET" action="">
        <input type="text" name="buscar" placeholder="Dato" required>
        <input type="submit" value="Buscar curso">
    </form>
    <br>
    <!--Llamado del template para registrar estudiantes -->
    <?php if ($getRegister === true): ?>
        <?php require_once "templates/cursos/registrar_cursos.php"; ?>
    <?php else: ?>
        <form method="GET">
            <input type="hidden" name="register" value="true">
            <input type="submit" value="Registro nuevo">
        </form>
    <?php endif; ?>



    <?php if ($getView === false): ?>
        <br>
        <a href="/views/cursos_view.php?view=true">Ver todos</a>
        <br>
        <?php require_once "footer.php"; ?>
    <?php else: ?>
        <?php if (!empty($cursosData)): ?>
            <?php if ($getShow === true): ?>
                <!--Llamado del template para las acciones de cursos -->
                <br>
                <a href="../views/cursos_view.php">Regresar</a>
                <br>
                <?php require_once "templates/cursos/acciones_cursos.php" ?>
            <?php else: ?>
                <!--Llamado del template para listar los cursos -->
                <br>
                <a href="../views/cursos_view.php">Ocultar</a>
                <br>
                <?php require_once "templates/cursos/lista_cursos.php"; ?>
            <?php endif; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No hay registros.</td>
            </tr>
        <?php endif; ?>
        </table>
    <?php endif; ?>
    <script src="../js/cursos.js"></script>
</body>

</html>