<table class="table table-striped table-hover  table-dark">
    <tr>
        <th>Código</th>
        <th>Periodo</th>
        <th>Año</th>
        <th>Estudiante</th>
        <th>Curso</th>
        <th colspan="2">Acciones</th>
    </tr>
    <?php foreach ($inscripcionesData as $inscripcion): ?>
        <tr>
            <td>
                <a href="?buscar= <?= $inscripcion['cod_inscripcion']; ?>&show=true" class="badge bg-info rounded-pill"><?= $inscripcion['cod_inscripcion']; ?></a>
            </td>
            <td>
                <?php echo $inscripcion['periodo']; ?>
            </td>
            <td>
                <?php echo $inscripcion['anho']; ?>
            </td>
            <td>
                <a href="?buscar= <?= $inscripcion['cod_est']; ?>&show=true" class="badge bg-info rounded-pill"><?= $inscripcion['cod_est']; ?></a>
            </td>
            <td>
                <a href="?buscar= <?= $inscripcion['cod_cur']; ?>&show=true" class="badge bg-info rounded-pill"><?= $inscripcion['cod_cur']; ?></a>
            </td>
            <td> 
                <!--ir a la seccioon de editar una inscripcion -->
                <form method="GET">
                    <input type="hidden" name="buscar" value="<?= $inscripcion['cod_inscripcion']; ?>">
                    <input type="hidden" name="show" value="true">
                    <button type="submit" value="Editar" class="btn btn-success">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </form>
            </td>
            <td>
                <!-- Formulario para eliminar una inscripcion -->
                <form method="POST">
                    <input type="hidden" name="cod_inscripcion" value="<?php echo $inscripcion['cod_inscripcion']; ?>">
                    <button type="submit" class="btn btn-danger" name="eliminar" value="Eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
            </td>
        </tr> 
    <?php endforeach; ?>
</table>