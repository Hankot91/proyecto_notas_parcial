<!-- Mostrar acciones de estudiantes -->
<input type="checkbox" name="edit" id="edit_checkbox">
<label for="edit_checkbox">Editar</label>
<?php foreach ($estudiantesData as $estudiante): ?>
    <table>
        <tr>
            <th>Datos</th>
        </tr>
        <tr>
            <td colspan="2">
                <!-- Formulario para editar un estudiante -->
                <form method="POST" action="/views/estudiantes_view.php?view=true">
                    <input type="hidden" name="cod_est" value="<?php echo $estudiante['cod_est']; ?>">
                    <input type="text" name="nomb_est" placeholder="Nuevo nombre" required
                        value="<?php echo $estudiante['nomb_est']; ?>" class="editable-input">
                    <input type="submit" name="actualizar" value="Actualizar estudiante" action=" ">
                </form>
            </td>
            <td>
                <!-- Formulario para eliminar un estudiante -->
                <form method="POST" action="/views/estudiantes_view.php?view=true">
                    <input type="hidden" name="cod_est" value="<?php echo $estudiante['cod_est']; ?>">
                    <input type="submit" name="eliminar" value="Eliminar">
                </form>
            </td>
        </tr>
    </table>
<?php endforeach; ?>