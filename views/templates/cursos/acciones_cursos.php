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
        <?php foreach ($cursosData as $curso): ?>
            <tr>
                <td>
                    <!-- Formulario para editar un estudiante -->
                    <form method="POST" action="/views/cursos_view.php?view=true">
                        <input type="hidden" name="cod_cur" value="<?php echo $curso['cod_cur']; ?>">
                        <input type="text" name="nomb_cur" placeholder="Nuevo nombre" required
                            value="<?php echo $curso['nomb_cur']; ?>" class="editable-input form-control-sm rounded">
                        <button type="submit" name="actualizar" value="Editar" class="btn btn-success input-submit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </form>
                </td>
                <td>
                    <!-- Formulario para eliminar un estudiante -->
                    <form method="POST" action="/views/cursos_view.php?view=true">
                        <input type="hidden" name="cod_cur" value="<?php echo $curso['cod_cur']; ?>">
                        <button type="submit" class="btn btn-danger" name="eliminar" value="Eliminar">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
