<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>
</head>

<body>
    <h1>Listado de Estudiantes</h1>

    <!-- Formulario para agregar un estudiante -->
    <form method="POST" action="/controllers/estudiantes_controller.php">
        <input type="text" name="cod_est" placeholder="Código del estudiante" required>
        <input type="text" name="nomb_est" placeholder="Nombre del estudiante" required>
        <input type="submit" name="agregar" value="Agregar estudiante">
    </form>

    <br>

    <!-- Mostrar la lista de estudiantes -->
    <table>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($estudiantesData as $estudiante): ?>
            <tr>
                <td>
                    <?php echo $estudiante['cod_est']; ?>
                </td>
                <td>
                    <?php echo $estudiante['nomb_est']; ?>
                </td>
                <td>
                    <!-- Formulario para editar un estudiante -->
                    <form method="POST" action="/controllers/estudiantes_controller.php">
                        <input type="hidden" name="cod_est" value="<?php echo $estudiante['cod_est']; ?>">
                        <input type="text" name="nomb_est" placeholder="Nuevo nombre" required>
                        <input type="submit" name="actualizar" value="Actualizar estudiante">
                    </form>

                    <!-- Formulario para eliminar un estudiante -->
                    <form method="POST" action="/controllers/estudiantes_controller.php">
                        <input type="hidden" name="cod_est" value="<?php echo $estudiante['cod_est']; ?>">
                        <input type="submit" name="eliminar" value="Eliminar">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
</body>

</html>