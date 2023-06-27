<!-- seccion de acciones de cursos -->
<input type="checkbox" name="edit" id="edit_checkbox">
<label for="edit_checkbox">Editar</label>
<?php foreach ($cursosData as $curso): ?>
    <table>
        <tr>
            <th>Datos</th>
        </tr>
        <tr>
            <td colspan="2">
                <!-- Formulario para editar un curso -->
                <form method="POST" action="/views/cursos_view.php?view=true">
                    <input type="hidden" name="cod_cur" value="<?php echo $curso['cod_cur']; ?>">
                    <input type="text" name="nomb_cur" placeholder="Nuevo nombre" required
                        value="<?php echo $curso['nomb_cur']; ?>" class="editable-input">
                    <input type="submit" name="actualizar" value="Actualizar curso" class="input-submit">
                </form>
            </td>
            <td>
                <!-- Formulario para eliminar un curso -->
                <form method="POST" action="/views/curso_view.php?view=true">
                    <input type="hidden" name="cod_cur" value="<?php echo $curso['cod_cur']; ?>">
                    <input type="submit" name="eliminar" value="Eliminar">
                </form>
            </td>
        </tr>
    </table>
<?php endforeach; ?>