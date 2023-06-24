<?php
require_once "../controllers/estudiantes_controller.php";
$estudiantesData = (new EstudiantesController())->handleRequest();
$getView = isset($_GET['view']) || isset($_GET['buscar'] );
$getShow = isset($_GET['show']);
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

    <!-- Formulario para agregar un estudiante -->
    <h3><label for="form_agragar"> Formulario de inscripcion de estudiante</label></h3>    
    <form method="POST" action="/views/estudiantes_view.php?view=true">
        <input type="number" name="cod_est" placeholder="Código del estudiante" required>
        <input type="text" name="nomb_est" placeholder="Nombre del estudiante" required>

        <input type="submit" name="agregar" value="Agregar estudiante">
    </form>

    <h4 class="mensaje_error"></h4>

    <form method="GET">
        <input type="text" name="buscar" placeholder="Dato" required>
        <input type="submit" value="Buscar estudiante">
    </form>

    <br>
    <a href="/views/estudiantes_view.php?view=true">Ver todos</a>
    <br>
    <a href="../views/estudiantes_view.php">Ocultar</a>
    <br>

    <?php if ($getView === false): ?>
        <?php require_once "footer.php"; ?>

    <?php else: ?>
        <!-- Mostrar la lista de estudiantes -->
        <?php if (!empty($estudiantesData)): ?>
            <?php if($getShow === true): ?> 
                <input type="checkbox" name="edit" id="edit_checkbox">
                <label for="edit_checkbox">Editar</label>
                <?php foreach ($estudiantesData as $estudiante): ?>
        <table>
                <tr>
                    <th>Datos</th>
                </tr>
                <tr>
                    <td colspan="2">
                        <!-- Formulario para editar un estudiante -->
                        <form method="POST" action="/views/estudiantes_view.php?view=true">
                            <input type="hidden" name="cod_est" value="<?php echo $estudiante['cod_est']; ?>">
                            <input type="text" name="nomb_est" placeholder="Nuevo nombre" required value="<?php echo $estudiante['nomb_est']; ?>" class="editable-input">
                            <input type="submit" name="actualizar" value="Actualizar estudiante" action=" ">
                        </form>
                    </td>
                    <td>
                        <!-- Formulario para eliminar un estudiante -->
                        <form method="POST" action="/views/estudiantes_view.php?view=true">
                            <input type="hidden" name="cod_est" value="<?php echo $estudiante['cod_est']; ?>">
                            <input type="submit" name="eliminar" value="Eliminar">
                        </form>
                    </td>
                </tr>
        </table>
                <?php endforeach; ?>    
            <?php else: ?>
        <table>        
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
                <?php foreach ($estudiantesData as $estudiante): ?>
                <tr>
                    <td>
                        <a href="?buscar=<?= $estudiante['cod_est']; ?>&show=true"><?= $estudiante['cod_est']; ?></a>
                    </td>
                    <td>
                        <?php echo $estudiante['nomb_est']; ?>
                    </td>
                    <td>
                        <!-- editar un estudiante -->
                        <form method="GET"  >
                            <input type="hidden" name="buscar" value="<?= $estudiante['cod_est']; ?>">
                            <input type="hidden" name="show" value="true">
                            <input type="submit"value="Editar">
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