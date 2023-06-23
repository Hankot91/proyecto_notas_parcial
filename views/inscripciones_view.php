<?php
require_once "../controllers/inscripciones_controller.php";
$inscripcionesData = (new InscripcionesController())->handleRequest();
$cursosData = (new InscripcionesController())->handleReturnCursos();
$estudiantesData = (new InscripcionesController())->handleReturnEstudiantes();
$getView = isset($_GET['view']) || isset($_GET['cod_inscripcion']) || isset($_GET['cod_est']) || isset($_GET['cod_cur']);
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
    <h1>Listado de Inscripciones</h1>
        <!-- Formulario para agregar un estudiante -->
        <form method="POST">
        <input type="number" name="cod_inscripcion" placeholder="Código de inscripcion" required>
        <label for="periodo_select">Seleciona un periodo</label>
        <select name="periodo" placeholder="Periodo" required>
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
        <label for="anho_select">Selecciona un año:</label>
        <select name="anho" id="anho_select"></select>
        <select name="cod_cur" id="curso_select">
            <?php foreach ($cursosData as $curso): ?>
            <option value="<?php echo $curso['cod_cur']; ?>"><?php echo $curso['nomb_cur']; ?></option>
            <?php endforeach; ?>
        </select>
        <select name="cod_est" id="estudiante_select">
            <?php foreach ($estudiantesData as $estudiante): ?>
            <option value="<?php echo $estudiante['cod_est']; ?>"><?php echo $estudiante['nomb_est']; ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" name="agregar" value="Agregar inscripcion">
    </form>
    <p class="mensaje_error"></p>

    <form method="GET" action="">
        <input type="number" name="buscar" placeholder="Dato" required>
        <input type="submit" name="buscar_submit" value="Buscar">
    </form>

    <br>
    <a href="/views/inscripciones_view.php?view=true">Ver todos</a>
    <br>

    <?php if ($getView === false): ?>
        <?php require_once "footer.php"; ?>
    <?php else: ?>
        <!-- Mostrar la lista de inscripciones-->
        <a href="../views/inscripciones_view.php">Ocultar</a>
        <table>
            <tr>
                <th>Código</th>
                <th>Periodo</th>
                <th>Año</th>
                <th>Estudiante</th>
                <th>Curso</th>
            </tr>
            <?php if (!empty($estudiantesData)): ?>
                <?php foreach ($inscripcionesData as $inscripcion): ?>
                    <tr>
                        <td>
                            <a href="?cod_inscripcion= <?= $inscripcion['cod_inscripcion']; ?>"><?= $inscripcion['cod_inscripcion']; ?></a>
                        </td>
                        <td>
                            <?php echo $inscripcion['periodo']; ?>
                        </td>
                        <td>
                            <?php echo $inscripcion['anho']; ?>
                        </td>
                        <td>
                            <a href="?cod_est= <?= $inscripcion['cod_est']; ?>"><?= $inscripcion['cod_est']; ?></a>
                        </td>
                        <td>
                            <a href="?cod_cur= <?= $inscripcion['cod_cur']; ?>"><?= $inscripcion['cod_cur']; ?></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No hay estudiantes registrados.</td>
                </tr>
            <?php endif; ?>
        </table>
    <?php endif; ?>

    <script src="../js/inscripciones.js"></script>
</body>
</html>