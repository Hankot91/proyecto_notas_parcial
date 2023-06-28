<!-- Mostrar acciones de estudiantes -->
    <table class="table table-striped table-hover table-dark">
        <tr>
            <th colspan="2">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="edit" id="edit_checkbox">
                    <label class="form-check-label" for="edit_checkbox">Edición de datos</label>
                </div>
            </th>
        </tr>
        <?php foreach ($estudiantesData as $estudiante): ?>
            <tr>
                <td>
                    <!-- Formulario para editar un estudiante -->
                    <form method="POST" action="/views/estudiantes_view.php?view=true">
                        <input type="hidden" name="cod_est" value="<?php echo $estudiante['cod_est']; ?>">
                        <input type="text" name="nomb_est" placeholder="Nuevo nombre" required
                            value="<?php echo $estudiante['nomb_est']; ?>" class="editable-input form-control-sm rounded">
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
