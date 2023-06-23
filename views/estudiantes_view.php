<?php
require_once "../controllers/estudiantes_controller.php";
$estudiantesData = (new EstudiantesController())->handleRequest();
$getView = isset($_GET['view']) || isset($_GET['cod_est']);
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
    <h1>Listado de Estudiantes</h1>

    <!-- Formulario para agregar un estudiante -->
    <form method="POST">
        <input type="number" name="cod_est" placeholder="Código del estudiante" required>
        <input type="text" name="nomb_est" placeholder="Nombre del estudiante" required>
        <input type="submit" name="agregar" value="Agregar estudiante">
    </form>
    <p class="mensaje_error"></p>

    <form method="GET" action="">
        <input type="number" name="cod_est" placeholder="Código del estudiante" required>
        <input type="submit" name="buscar" value="Buscar estudiante">
    </form>

    <br>
    <a href="/views/estudiantes_view.php?view=true">Ver todos</a>

    <br>
    <?php if ($getView === false): ?>
        <?php require_once "footer.php"; ?>
    <?php else: ?>
        <!-- Mostrar la lista de estudiantes -->
        <a href="../views/estudiantes_view.php">Ocultar</a>
        <table>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
            <?php if (!empty($estudiantesData)): ?>
                <?php foreach ($estudiantesData as $estudiante): ?>
                    <tr>
                        <td>
                            <a href="?cod_est= <?= $estudiante['cod_est']; ?>"><?= $estudiante['cod_est']; ?></a>
                        </td>
                        <td>
                            <?php echo $estudiante['nomb_est']; ?>
                        </td>
                        <td>
                            <!-- Formulario para editar un estudiante -->
                            <form method="POST">
                                <input type="hidden" name="cod_est" value="<?php echo $estudiante['cod_est']; ?>">
                                <input type="text" name="nomb_est" placeholder="Nuevo nombre" required>
                                <input type="submit" name="actualizar" value="Actualizar estudiante" action=" ">
                            </form>
                        </td>
                        <td>
                            <!-- Formulario para eliminar un estudiante -->
                            <form method="POST">
                                <input type="hidden" name="cod_est" value="<?php echo $estudiante['cod_est']; ?>">
                                <input type="submit" name="eliminar" value="Eliminar">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No hay estudiantes registrados.</td>
                </tr>
            <?php endif; ?>
        </table>
    <?php endif; ?>

    <script src="../js/estudiantesjs.js"></script>
</body>

</html>