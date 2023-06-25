<tr>
    <th>Código</th>
    <th>Periodo</th>
    <th>Año</th>
    <th>Estudiante</th>
    <th>Curso</th>
    <th>Acciones</th>
</tr>
<?php foreach ($inscripcionesData as $inscripcion): ?>
    <tr>
        <td>
            <a href="?buscar= <?= $inscripcion['cod_inscripcion']; ?>&show=true"><?= $inscripcion['cod_inscripcion']; ?></a>
        </td>
        <td>
            <?php echo $inscripcion['periodo']; ?>
        </td>
        <td>
            <?php echo $inscripcion['anho']; ?>
        </td>
        <td>
            <a href="?buscar= <?= $inscripcion['cod_est']; ?>&show=true"><?= $inscripcion['cod_est']; ?></a>
        </td>
        <td>
            <a href="?buscar= <?= $inscripcion['cod_cur']; ?>&show=true"><?= $inscripcion['cod_cur']; ?></a>
        </td>
        <td>
            <!--ir a la seccioon de editar una inscripcion -->
            <form method="GET">
                <input type="hidden" name="buscar" value="<?= $inscripcion['cod_inscripcion']; ?>">
                <input type="hidden" name="show" value="true">
                <input type="submit" value="Editar">
            </form>
        </td>
        <td>
            <!-- Formulario para eliminar una inscripcion -->
            <form method="POST">
                <input type="hidden" name="cod_inscripcion" value="<?php echo $inscripcion['cod_inscripcion']; ?>">
                <input type="submit" name="eliminar" value="Eliminar">
            </form>
        </td>
    </tr>
<?php endforeach; ?>