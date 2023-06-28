<table class="table table-striped table-hover  table-dark">
    <tr>
        <th>Código</th>
        <th>Valor</th>
        <th>Fecha</th>
        <th>N de inscripcion</th>
        <th>Nota</th>
        <th colspan="2">Acciones</th>
    </tr>
    <?php foreach ($calificacionesData as $calificacion): ?>
        <tr>
            <!--Lista de estudiantes -->
            <td>
                <a href="?buscar=<?= $calificacion['cod_cal']; ?>&show=true" class="badge bg-info rounded-pill"><?= $calificacion['cod_cal']; ?></a>
            </td>
            <td>
                <?php echo $calificacion['valor']; ?>
            </td>
            <td>
                <?php echo $calificacion['fecha']; ?>
            </td>
            <td>
                <?php echo $calificacion['cod_inscripcion']; ?>
            </td>
            <td>
                <?php echo $calificacion['nota']; ?>
            </td>
            <td>
                <!-- editar un estudiante -->
                <form method="GET">
                    <input type="hidden" name="buscar" value="<?= $calificacion['cod_cal']; ?>">
                    <input type="hidden" name="show" value="true">
                    <button type="submit" value="Editar" class="btn btn-success">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </form>
            </td>
            <td>
                <!-- Formulario para eliminar un estudiante -->
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