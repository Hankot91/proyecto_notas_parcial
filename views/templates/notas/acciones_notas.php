<input type="checkbox" name="edit" id="edit_checkbox">
<label for="edit_checkbox">Editar</label>
<?php foreach ($notasData as $nota): ?>
    <tr>
        <td>
            <!-- Formulario para editar una nota -->
            <form method="POST" action="/views/notas_view.php?view=true">
                <input type="hidden" name="nota" value="<?php echo $nota['nota']; ?>">
                <textarea name="descrip_nota" placeholder="Nueva descripcion" required class="editable-text"><?php echo $nota['descrip_nota']; ?></textarea>
                <input type="number" name="porcentaje" value="<?php echo $nota['porcentaje']; ?>" placeholder="Nuevo porcentaje" required class="editable-input">
                <input type="number" name="posicion" value="<?php echo $nota['posicion']; ?>" placeholder="Nueva posicion" required class="editable-input">
                <select name="cod_cur" id="curso_select" class="editable-select">
                    <?php foreach ($cursosData as $curso): ?>
                        <option value="<?php echo $curso['cod_cur']; ?>" <?php if ($nota['cod_cur'] == $curso['cod_cur'])
                            echo 'selected="selected"'; ?>><?php echo $curso['nomb_cur']; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" name="actualizar" value="Actualizar nota"> 
            </form>
        </td>
        <td>
            <!-- Formulario para eliminar una nota -->
            <form method="POST">
                <input type="hidden" name="nota" value="<?php echo $nota['nota']; ?>">
                <input type="submit" name="eliminar" value="Eliminar">
            </form>
        </td>
    </tr>
<?php endforeach; ?>