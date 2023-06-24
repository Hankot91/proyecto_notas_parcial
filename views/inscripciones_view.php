<?php
require_once "../controllers/inscripciones_controller.php";
$inscripcionesData = (new InscripcionesController())->handleRequest();
$cursosData = (new InscripcionesController())->handleReturnCursos();
$estudiantesData = (new InscripcionesController())->handleReturnEstudiantes();
$getView = isset($_GET['view']) || isset($_GET['buscar'] );
$getShow = isset($_GET['show']);

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
            <!-- Formulario para agregar una inscripcion-->
            <h3><label for="form_agragar"> Formulario de inscripcion</label></h3>    
            <form method="POST" action="/views/inscripciones_view.php?view=true">
                <input type="number" name="cod_inscripcion" placeholder="Código de inscripcion" required>
                <select name="periodo" placeholder="Periodo" required>
                    <option disabled selected>Periodo</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
                <select name="anho" class="anho_select">
                    <option disabled selected>Año</option>
                </select>
                <select name="cod_cur" id="curso_select">
                    <option disabled selected>Curso</option>
                    <?php foreach ($cursosData as $curso): ?>
                    <option value="<?php echo $curso['cod_cur']; ?>"><?php echo $curso['nomb_cur']; ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="cod_est" id="estudiante_select">
                    <option disabled selected>Estudiante</option>
                    <?php foreach ($estudiantesData as $estudiante): ?>
                    <option value="<?php echo $estudiante['cod_est']; ?>"><?php echo $estudiante['nomb_est']; ?></option>
                    <?php endforeach; ?>
                </select>

            <input type="submit" name="agregar" value="Agregar inscripcion">
        </form>
        <h4 class="mensaje_error"></h4>

        <form method="GET" action="">
            <input type="number" name="buscar" placeholder="Dato" required>
            <input type="submit" name="buscar_submit" value="Buscar">
        </form>

        <br>
        <a href="/views/inscripciones_view.php?view=true" name="verTodos">Ver todos</a>
        <br>
        <a href="../views/inscripciones_view.php">Ocultar</a>
        <br>
        
        <?php if ($getView === false): ?>
            <?php require_once "footer.php"; ?>

        <?php else: ?>

            <!-- Mostrar la lista de inscripciones-->
            <table>

                <?php if (!empty($inscripcionesData)): ?>
                    <?php if($getShow === true): ?> 
                        <input type="checkbox" name="edit" id="edit_checkbox">
                        <label for="edit_checkbox">Editar</label>
                        <?php foreach ($inscripcionesData as $inscripcion): ?>
                <tr>
                    <td>
                        <!-- Formulario para editar una inscripcion -->
                        <form method="POST" action="/views/inscripciones_view.php?view=true">
                                <input type="hidden" name="cod_inscripcion" value="<?php echo $inscripcion['cod_inscripcion']; ?>">
                                <select name="periodo" placeholder="Nuevo periodo" required class="editable-select">
                                        <option value="<?php echo $inscripcion['periodo']; ?>" selected><?php echo $inscripcion['periodo']; ?></option>
                                        <?php if ($inscripcion['periodo'] == 1): ?>
                                            <option value="2">2</option>
                                        <?php else: ?>
                                            <option value="1">1</option>
                                        <?php endif; ?>
                                </select>
                                <select name="anho" class="editable-select anho_select anho_edit">
                                        <option value="<?php echo $inscripcion['anho']; ?>"><?php echo $inscripcion['anho']; ?></option>
                                </select>
                                <select name="cod_cur" id="curso_select" class="editable-select">
                                        <?php foreach ($cursosData as $curso): ?>
                                            <option value="<?php echo $curso['cod_cur']; ?>" <?php if ($inscripcion['cod_cur'] == $curso['cod_cur'])
                                                echo 'selected="selected"'; ?>><?php echo $curso['nomb_cur']; ?></option>
                                        <?php endforeach; ?>
                                </select>
                                <select name="cod_est" id="estudiante_select" class="editable-select" <?php echo 'disabled'; ?>>
                                        <?php foreach ($estudiantesData as $estudiante): ?>
                                            <option value="<?php echo $estudiante['cod_est']; ?>" <?php if ($inscripcion['cod_est'] == $estudiante['cod_est'])
                                                echo 'selected="selected"'; ?>><?php echo $estudiante['nomb_est']; ?></option>
                                        <?php endforeach; ?>
                                </select>
                                <input type="submit" name="actualizar" value="Actualizar inscripcion" >
                        </form>
                    </td>
                    <td>
                        <!-- Formulario para eliminar una inscripcion -->
                        <form method="POST">
                                <input type="hidden" name="cod_inscripcion" value="<?php echo $inscripcion['cod_inscripcion']; ?>">
                                <input type="submit" name="eliminar" value="Eliminar">
                        </form>
                    </td>
                </tr>        
                        <?php endforeach; ?>
                    <?php else: ?>
                <tr>
                    <th>Código</th>
                    <th>Periodo</th>
                    <th>Año</th>
                    <th>Estudiante</th>
                    <th>Curso</th>
                    <th>Acciones</th>
                </tr>
                        <?php foreach ($inscripcionesData as $inscripcion): ?>
                <tr>
                    <td>
                        <a href="?buscar= <?= $inscripcion['cod_inscripcion']; ?>&show=true"><?= $inscripcion['cod_inscripcion']; ?></a>
                    </td>
                    <td>
                        <?php echo $inscripcion['periodo']; ?>
                    </td>
                    <td>
                        <?php echo $inscripcion['anho']; ?>
                    </td>
                    <td>
                        <a href="?buscar= <?= $inscripcion['cod_est']; ?>&show=true"><?= $inscripcion['cod_est']; ?></a>
                    </td>
                    <td>
                        <a href="?buscar= <?= $inscripcion['cod_cur']; ?>&show=true"><?= $inscripcion['cod_cur']; ?></a>
                    </td>
                    <td>
                                <!-- editar una inscripcion -->
                        <form method="GET"  >
                            <input type="hidden" name="buscar" value="<?= $inscripcion['cod_inscripcion']; ?>">
                            <input type="hidden" name="show" value="true">
                            <input type="submit"value="Editar">
                        </form>
                    </td>
                    <td>
                        <!-- Formulario para eliminar una inscripcion -->
                        <form method="POST">
                                <input type="hidden" name="cod_inscripcion" value="<?php echo $inscripcion['cod_inscripcion']; ?>">
                                <input type="submit" name="eliminar" value="Eliminar">
                        </form>
                    </td>
                </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php else: ?>

                <tr>
                    <td colspan="5">No hay inscripciones registradas.</td>
                </tr>
                        
                <?php endif; ?>
            </table>

        <?php endif; ?>

    <script src="../js/inscripciones.js"></script>
</body>
</html>