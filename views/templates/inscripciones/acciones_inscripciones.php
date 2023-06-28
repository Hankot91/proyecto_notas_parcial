
<table class="table table-striped table-hover  table-dark"> 
    <tr>
            <th colspan="2">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="edit" id="edit_checkbox">
                    <label class="form-check-label" for="checkbox3">Edicion de datos</label>
                </div>
            </th>
    </tr>
<?php foreach ($inscripcionesData as $inscripcion): ?>
    <tr>
        <td>
            <!-- Formulario para editar una inscripcion -->
            <form method="POST" action="/views/inscripciones_view.php">
                <input type="hidden" name="cod_inscripcion" value="<?php echo $inscripcion['cod_inscripcion']; ?>">
                <select name="periodo" placeholder="Nuevo periodo" required class="editable-select form-select-sm bg-primary text-black">
                    <option value="<?php echo $inscripcion['periodo']; ?>" selected><?php echo $inscripcion['periodo']; ?>
                    </option>
                    <?php if ($inscripcion['periodo'] == 1): ?>
                        <option value="2">2</option>
                    <?php else: ?>
                        <option value="1">1</option>
                    <?php endif; ?>
                </select>
                <select name="anho" class="editable-select anho_select anho_edit form-select-sm  text-black">
                    <option value="<?php echo $inscripcion['anho']; ?>"><?php echo $inscripcion['anho']; ?></option>
                </select>
                <select name="cod_cur" id="curso_select" class="editable-select form-select-sm bg-primary text-black">
                    <?php foreach ($cursosData as $curso): ?>
                        <option value="<?php echo $curso['cod_cur']; ?>" <?php if ($inscripcion['cod_cur'] == $curso['cod_cur'])
                            echo 'selected="selected"'; ?>><?php echo $curso['nomb_cur']; ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="cod_est" id="estudiante_select" class="editable-select form-select-sm text-black" <?php echo 'disabled'; ?>>
                    <?php foreach ($estudiantesData as $estudiante): ?>
                        <option value="<?php echo $estudiante['cod_est']; ?>" <?php if ($inscripcion['cod_est'] == $estudiante['cod_est'])
                            echo 'selected="selected"'; ?>><?php echo $estudiante['nomb_est']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="actualizar" value="Editar" class="btn btn-success input-submit">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
            </form>
        </td>
        <td>
            <!-- Formulario para eliminar una inscripcion -->
            <form method="POST" action="/views/inscripciones_view.php">
                <input type="hidden" name="cod_inscripcion" value="<?php echo $inscripcion['cod_inscripcion']; ?>">
                <button type="submit" class="btn btn-danger" name="eliminar" value="Eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                </button>
            </form>
        </td>
    </tr>
<?php endforeach; ?>
</table>