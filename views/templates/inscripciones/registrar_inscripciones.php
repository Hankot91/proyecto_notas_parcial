<!-- Formulario para agregar una inscripcion-->
<a href="inscripciones_view.php">Regresar</a>
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
