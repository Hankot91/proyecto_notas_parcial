<!-- Mostrar acciones de estudiantes -->

<?php foreach ($estudiantesData as $estudiante): ?>
    <table class="table table-striped table-hover  table-dark">
        <tr>
            <th colspan="2">
            <input type="checkbox" name="edit" id="edit_checkbox">
            <label for="edit_checkbox">Datos</label>
            </th>
        </tr>
        <tr>
            <td>
                <!-- Formulario para editar un estudiante -->
                <form method="POST" action="/views/estudiantes_view.php?view=true">
                    <input type="hidden" name="cod_est" value="<?php echo $estudiante['cod_est']; ?>">
                    <input type="text" name="nomb_est" placeholder="Nuevo nombre" required
                        value="<?php echo $estudiante['nomb_est']; ?>" class="editable-input">
                        <button type="submit" name="actualizar" value="Editar" class="btn btn-success input-submit">
                        <i class="fa-solid fa-user-pen"></i>
                    </button>
                </form>
            </td>
            <td>
                <!-- Formulario para eliminar un estudiante -->
                <form method="POST" action="/views/estudiantes_view.php?view=true">
                    <input type="hidden" name="cod_est" value="<?php echo $estudiante['cod_est']; ?>">
                    <button type="submit" class="btn btn-danger" name="eliminar" value="Eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
            </td>
        </tr>
<?php endforeach; ?>
</table>