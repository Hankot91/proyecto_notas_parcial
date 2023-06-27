

<input type="checkbox" name="edit" id="edit_checkbox">
<label for="edit_checkbox">Editar</label>
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
                <input type="hidden" name="cod_cal" value="<?php echo $calificacion['cod_cal']; ?>" >
                <input type="hidden" name="cod_inscripcion" value="<?php echo $calificacion['cod_inscripcion']; ?>">
                <input type="text" name="valor" class="editable-input"value="<?php echo $calificacion['valor']; ?>" placeholder="Nueva nota" required>
                <input type="date" name="fecha" class="editable-input" value="<?php echo $calificacion['fecha'];?>" placeholder="Fecha" required>
                <label for="nueva_nota">Nota</label>
                <select name="nota" id="nota_select" class="editable-select">
                    <?php foreach ($notasByCurso as $nota): ?>
                        <option value="<?php echo $nota['nota']; ?>" <?php if ($calificacion['nota'] == $nota['nota']): ?>
                            selected="selected"
                        <?php endif; ?>><?php echo $nota['posicion']; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" name="actualizar" value="Actualizar calificacion" class="input-submit">
            </form>
        </td>
        <td>
            <!-- Formulario para eliminar una calificacion -->
            <form method="POST" action="/views/calificaciones_view.php">
                <input type="hidden" name="cod_cal" value="<?php echo $calificacion['cod_cal']; ?>">
                <input type="submit" name="eliminar" value="Eliminar">
            </form>
        </td>
    </tr>
<?php endforeach; ?>
