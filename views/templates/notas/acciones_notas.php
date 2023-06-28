<table class="table table-striped table-hover table-dark">
    <tr>
        <th colspan="2">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="edit" id="edit_checkbox">
                <label class="form-check-label" for="edit_checkbox">Edicion de datos</label>
            </div>
        </th>
    </tr>
    <?php foreach ($notasData as $nota): ?>
        <tr>
            <td>
                <!-- Formulario para editar una nota -->
                <form method="POST" action="/views/notas_view.php?view=true">
                    <input type="hidden" name="nota" value="<?php echo $nota['nota']; ?>">
                    <div class="input-group">
                        <span class="input-group-text">Descripcion</span>
                        <textarea class="form-control editable-text" aria-label="With textarea" 
                        name="descrip_nota" placeholder="Nueva descripcion" required disabled><?php echo $nota['descrip_nota']; ?></textarea>
                    </div>
                    <input type="number" class="form-control-sm rounded editable-input" name="porcentaje" value="<?php echo $nota['porcentaje']; ?>"
                        placeholder="Nuevo porcentaje" required disabled>
                    <input type="number" class="form-control-sm rounded editable-input" name="posicion" value="<?php echo $nota['posicion']; ?>"
                        placeholder="Nueva posicion" required disabled>
                    <select name="cod_cur" id="curso_select" class="editable-select form-select-sm bg-primary text-black" disabled>
                        <?php foreach ($cursosData as $curso): ?>
                            <option value="<?php echo $curso['cod_cur']; ?>" <?php if ($nota['cod_cur'] == $curso['cod_cur'])
                                echo 'selected="selected"'; ?>><?php echo $curso['nomb_cur']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" name="actualizar" value="Editar" style="display: none;"></button>
                </form>
            </td>
            <td>
                <button type="submit" class="btn btn-success input-submit" disabled>
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <br>
                <br>
                <!-- Formulario para eliminar una nota -->
                <form method="POST" action="/views/notas_view.php?view=true">
                    <input type="hidden" name="nota" value="<?php echo $nota['nota']; ?>">
                    <button type="submit" class="btn btn-danger" name="eliminar" value="Eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

