<table class="table table-striped table-hover  table-dark">
    <tr>
        <th>Código</th>
        <th>Descripcion</th>
        <th>Porcentaje</th>
        <th>Posicion</th>
        <th>Curso</th>
        <th colspan="2">Acciones</th>
    </tr>
    <?php foreach ($notasData as $nota): ?>
        <tr>
            <td>
                <a href="?buscar=<?= $nota['nota']; ?>&show=true" class="badge bg-info rounded-pill"><?= $nota['nota']; ?></a>
            </td>
            <td>
                <?php echo $nota['descrip_nota']; ?>
            </td>
            <td>
                <?php echo $nota['porcentaje']; ?>
            </td>
            <td>
                <?php echo $nota['posicion']; ?>
            </td>
            <td>
                <a href="?buscar=<?= $nota['cod_cur']; ?>&show=true" class="badge bg-info rounded-pill"><?= $nota['cod_cur']; ?></a>
            </td>
            <td>
                <!--ir a la seccioon de editar una nota -->
                <form method="GET">
                    <input type="hidden" name="buscar" value="<?= $nota['nota']; ?>">
                    <input type="hidden" name="show" value="true">
                    <button type="submit" value="Editar" class="btn btn-success">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </form>
            </td>
            <td>
                <!-- Formulario para eliminar una inscripcion -->
                <form method="POST">
                    <input type="hidden" name="nota" value="<?php echo $nota['nota']; ?>">
                    <button type="submit" class="btn btn-danger" name="eliminar" value="Eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>