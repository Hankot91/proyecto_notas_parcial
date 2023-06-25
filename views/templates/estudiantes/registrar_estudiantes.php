<!-- Formulario para agregar un estudiante -->
<a href="estudiantes_view.php">Regresar</a>
<h3><label for="form_agragar"> Formulario de inscripcion de estudiante</label></h3>
<form method="POST" action="/views/estudiantes_view.php?view=true">
    <input type="number" maxlength="9" name="cod_est" placeholder="Código del estudiante" required>
    <input type="text" name="nomb_est" placeholder="Nombre del estudiante" required>

    <input type="submit" name="agregar" value="Agregar estudiante">
</form>

