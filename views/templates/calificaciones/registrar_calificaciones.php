<!-- Formulario para agregar una calificacion-->
<?php

$estudiantesbyCurso = (new CalificacionesController())->handleRequest();
$isEstudiantes = isset($_GET['cod_cur']);


?>
<br>
<a href="calificaciones_view.php">Regresar</a>
<br>
<br>
<h3><label for="form_agragar"> Formulario de registro de calificaciones</label></h3>
<form method="GET" id = "form_curso">
    <input type="hidden" name="register" value = "true">
    <select name="cod_cur" id="curso_select">
        <option disabled selected>Curso</option>
        <?php foreach ($cursosData as $curso): ?>
            <option value="<?php echo $curso['cod_cur']; ?>"><?php echo $curso['nomb_cur']; ?></option>
        <?php endforeach; ?>
    </select>
</form>


<br>
<?php if($isEstudiantes === true): ?>
<form method="POST" action="/views/calificaciones_view.php">
    <input type="number" name="cod_cal" max="9999999"placeholder="Codigo de calificacion" required>
    <select name="cod_inscripcion" id="estudiantes_select">
        <option disabled selected>Estudiante</option>
        <?php foreach ($estudiantesbyCurso as $estudiante): ?>
                    <option value="<?php echo $estudiante['cod_inscripcion'];?>"><?php echo $estudiante['nomb_est']; ?></option>
        <?php endforeach; ?>
    </select>
    <select name="nota" id="notas_select">
        <option disabled selected>Nota</option>
        <?php foreach ($notasData as $nota): ?>
            <?php if ($nota['cod_cur'] == $_GET['cod_cur']): ?>
                <option value="<?php echo $nota['nota']; ?>"><?php echo $nota['posicion']; ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>
    <input type="text" name="valor" placeholder="Valor" required pattern="[0-5](\.[0-9]+)?" title="Ingrese un valor entre 0 y 5">
    <input type="date" name="fecha" placeholder="Fecha" required>

    <input type="submit" name="agregar" value="Agregar calificacion">
</form>
<?php endif; ?>