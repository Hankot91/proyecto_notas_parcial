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
    <link rel="stylesheet" href="../css/style.css">
    <title>Notas</title>
</head>
<body>
    <header>
        <nav>
            <a href="../index.php">Inicio</a>
        </nav>
    </header>
    <h1>NOTAS</h1>
    <!--Busqueda de notas -->
    <form method="GET">
        <input type="text" name="buscar" placeholder="Dato" required>
        <input type="submit" name="buscar_submit" value="Buscar">
    </form>
    <br>

    <?php if ($getRegister === true): ?>
        <?php require_once "templates/notas/registrar_notas.php"; ?>
    <?php else: ?>
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
                    <?php require_once "templates/notass/lista_notas.php" ?>
                <?php endif; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No hay registros.</td>
                </tr>

            <?php endif; ?>
        </table>

    <?php endif; ?>

</body>
</html>