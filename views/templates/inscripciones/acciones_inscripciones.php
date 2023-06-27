<input type="checkbox" name="edit" id="edit_checkbox">
<label for="edit_checkbox">Editar</label>
<?php foreach ($inscripcionesData as $inscripcion): ?>
    <tr>
        <td>
            <!-- Formulario para editar una inscripcion -->
            <form method="POST" action="/views/inscripciones_view.php">
                <input type="hidden" name="cod_inscripcion" value="<?php echo $inscripcion['cod_inscripcion']; ?>">
                <select name="periodo" placeholder="Nuevo periodo" required class="editable-select">
                    <option value="<?php echo $inscripcion['periodo']; ?>" selected><?php echo $inscripcion['periodo']; ?>
                    </option>
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
                <input type="submit" name="actualizar" value="Actualizar inscripcion" class="input-submit">
            </form>
        </td>
        <td>
            <!-- Formulario para eliminar una inscripcion -->
            <form method="POST" action="/views/inscripciones_view.php">
                <input type="hidden" name="cod_inscripcion" value="<?php echo $inscripcion['cod_inscripcion']; ?>">
                <input type="submit" name="eliminar" value="Eliminar">
            </form>
        </td>
    </tr>
<?php endforeach; ?>