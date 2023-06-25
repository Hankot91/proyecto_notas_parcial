<!-- Formulario para agregar un curso -->
<a href="cursos_view.php">Regresar</a>
<h3><label for="form_agragar"> Formulario de inscripcion de curso</label></h3>
<form method="POST" action="/views/cursos_view.php?view=true">
    <input type="number" name="cod_cur" placeholder="Código del curso" required>
    <input type="text" name="nomb_cur" placeholder="Nombre del curso" required>
    <input type="submit" name="agregar" value="Agregar curso">
</form>
<p class="mensaje_error"></p>