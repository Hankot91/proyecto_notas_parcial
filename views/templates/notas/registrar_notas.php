<!-- Formulario para agregar una nota a un curso-->
<a href="notas_view.php">Regresar</a>
<h3><label for="form_agragar"> Formulario de inscripcion</label></h3>
<form method="POST" action="/views/notas_view.php?view=true">
    <input type="text" name="nota" placeholder="Nota" required>
    <textarea name="descrip_nota" placeholder="Breve descripcion" required>Nota de parcial #</textarea>
    <label for="porcentaje de notas">Porcentaje</label>
    <input type="number" name="porcentaje" placeholder="%" required>
    <input type="number" name="posicion" placeholder="Posicion de la nota" required>
    <select name="cod_cur" id="curso_select">
        <option disabled selected>Curso</option>
        <?php foreach ($cursosData as $curso): ?>
            <option value="<?php echo $curso['cod_cur']; ?>"><?php echo $curso['nomb_cur']; ?></option>
        <?php endforeach; ?>
    </select>

    <input type="submit" name="agregar" value="Agregar nota">
</form>
