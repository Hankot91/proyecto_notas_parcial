<?php
require_once "../controllers/cursos_controller.php";
$cursosData = (new CursosController())->handleRequest();
$getView = isset($_GET['view']) || isset($_GET['buscar']);
$getShow = isset($_GET['show']);

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
        <input type="text" name="buscar" placeholder="Dato" required>
        <input type="submit" value="Buscar curso">
    </form>


    <br>
    <a href="/views/cursos_view.php?view=true">Ver todos</a>
    <br>
    <a href="../views/cursos_view.php">Ocultar</a>
    <br>

    <?php if ($getView === false): ?>
        <?php require_once "footer.php"; ?>

    <?php else: ?>
        <!-- Mostrar la lista de cursos -->
        <?php if (!empty($cursosData)): ?>
            <?php if($getShow === true): ?> 
                <input type="checkbox" name="edit" id="edit_checkbox">
                <label for="edit_checkbox">Editar</label>
                <?php foreach ($cursosData as $curso): ?>
        <table>
                <tr>
                    <th>Datos</th>
                </tr>
                <tr>
                    <td colspan="2">
                        <!-- Formulario para editar un curso -->
                        <form method="POST" action="/views/cursos_view.php?view=true">
                            <input type="hidden" name="cod_cur" value="<?php echo $curso['cod_cur']; ?>">
                            <input type="text" name="nomb_cur" placeholder="Nuevo nombre" required value="<?php echo $curso['nomb_cur']; ?>" class="editable-input">
                            <input type="submit" name="actualizar" value="Actualizar curso">
                        </form>
                    </td>
                    <td>
                        <!-- Formulario para eliminar un curso -->
                        <form method="POST" action="/views/curso_view.php?view=true">
                            <input type="hidden" name="cod_cur" value="<?php echo $curso['cod_cur']; ?>">
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
                <?php foreach ($cursosData as $curso): ?>
                <tr>
                    <td>
                        <a href="?buscar=<?= $curso['cod_cur']; ?>&show=true"><?= $curso['cod_cur']; ?></a>
                    </td>
                    <td>
                        <?php echo $curso['nomb_cur']; ?>
                    </td>
                    <td>
                        <!-- editar un curso -->
                        <form method="GET"  >
                            <input type="hidden" name="buscar" value="<?= $curso['cod_cur']; ?>">
                            <input type="hidden" name="show" value="true">
                            <input type="submit"value="Editar">
                        </form>
                    </td>
                    <td>
                        <!-- Formulario para eliminar un estudiante -->
                        <form method="POST">
                            <input type="hidden" name="cod_cur" value="<?php echo $curso['cod_cur']; ?>">
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
    <script src="../js/cursos.js"></script>
</body>

</html>