<?php
require_once "../controllers/cursos_controller.php";
$cursosData = (new CursosController())->handleRequest();
$getView = isset($_GET['view']) || isset($_GET['cod_cur']);

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
    <h1>Listado de Cursos</h1>

    <!-- Formulario para agregar un estudiante -->
    <form method="POST">
        <input type="number" name="cod_cur" placeholder="Código del curso" required>
        <input type="text" name="nomb_cur" placeholder="Nombre del curso" required>
        <input type="submit" name="agregar" value="Agregar curso">
    </form>
    <p class="mensaje_error"></p>

    <form method="GET" action="">
        <input type="number" name="cod_cur" placeholder="Código del curso" required>
        <input type="submit" name="buscar" value="Buscar curso">
    </form>

    <br>
    <a href="/views/cursos_view.php?view=true">Ver todos</a>

    <br>
    <?php if ($getView === false): ?>
        <?php require_once "footer.php"; ?>
    <?php else: ?>
        <!-- Mostrar la lista de cursos -->
        <a href="../views/cursos_view.php">Ocultar</a>
        <table>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
            <?php if (!empty($cursosData)): ?>
                <?php foreach ($cursosData as $curso): ?>
                    <tr>
                        <td>
                            <a href="?cod_cur= <?= $curso['cod_cur']; ?>"><?= $curso['cod_cur']; ?></a>
                        </td>
                        <td>
                            <?php echo $curso['nomb_cur']; ?>
                        </td>
                        <td>
                            <!-- Formulario para editar un curso -->
                            <form method="POST">
                                <input type="hidden" name="cod_cur" value="<?php echo $curso['cod_cur']; ?>">
                                <input type="text" name="nomb_cur" placeholder="Nuevo nombre" required>
                                <input type="submit" name="actualizar" value="Actualizar curso">
                            </form>
                        </td>
                        <td>
                            <!-- Formulario para eliminar un curso-->
                            <form method="POST">
                                <input type="hidden" name="cod_cur" value="<?php echo $curso['cod_cur']; ?>">
                                <input type="submit" name="eliminar" value="Eliminar">
                                </f orm>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No hay cursos registrados.</td>
                </tr>
            <?php endif; ?>

        </table>
    <?php endif; ?>
</body>

</html>