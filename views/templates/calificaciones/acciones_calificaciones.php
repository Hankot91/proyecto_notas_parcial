<table class="table table-striped table-hover  table-dark">
    <tr>
        <th colspan="2">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="edit" id="edit_checkbox">
                <label class="form-check-label" for="checkbox3">Edicion de datos</label>
            </div>
        </th>
    </tr>
    <?php foreach ($calificacionesData as $calificacion): ?>
        <?php
        $notaActual = $calificacion['nota'];
        foreach ($notasData as $nota) {
            if ($notaActual == $nota['nota']) {
                $notasByCurso = (new CalificacionesController())->handleReturnNotasByCursos($nota['cod_cur']);
            }
        }
        ?>
        <tr>
            <td>
                <!-- Formulario para editar una calificacion -->
                <form method="POST" action="/views/calificaciones_view.php">
                        <div class="container_cal">
                            <input type="hidden" name="cod_cal" value="<?php echo $calificacion['cod_cal']; ?>">
                            <input type="hidden" name="cod_inscripcion" value="<?php echo $calificacion['cod_inscripcion']; ?>">
                            <input type="text" name="valor" class="editable-input form-select-sm bg-primary text-black rounded input_cal"
                                value="<?php echo $calificacion['valor']; ?>" placeholder="Nueva nota" required>
                            <input type="date" name="fecha" class="editable-input form-control-sm rounded input_cal" value="<?php echo $calificacion['fecha']; ?>"
                                placeholder="Fecha" required>
                            <div class="input-group mb-3 input_cal">
                                <label class="input-group-text" for="inputGroupSelect01">Nota</label>
                                <select name="nota" class="editable-select form-select" id="inputGroupSelect01">
                                <?php foreach ($notasByCurso as $nota): ?>
                                    <option value="<?php echo $nota['nota']; ?>" <?php if ($calificacion['nota'] == $nota['nota']): ?>
                                        selected="selected" <?php endif; ?>><?php echo $nota['posicion']; ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" name="actualizar" value="Editar" class="btn btn-success input-submit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </div>
                </form> 
            </td>
            <td>
                <!-- Formulario para eliminar una calificacion -->
                <form method="POST" action="/views/calificaciones_view.php">
                    <input type="hidden" name="cod_cal" value="<?php echo $calificacion['cod_cal']; ?>">
                    <button type="submit" class="btn btn-danger" name="eliminar" value="Eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
