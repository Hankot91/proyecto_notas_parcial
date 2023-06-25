<tr>
    <th>Código</th>
    <th>Descripcion</th>
    <th>Porcentaje</th>
    <th>Posicion</th>
    <th>Curso</th>
    <th>Acciones</th>
</tr>
<?php foreach ($notasData as $nota): ?>
    <tr>
        <td>
            <a href="?buscar=<?= $nota['nota']; ?>&show=true"><?=$nota['nota']; ?></a>
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
            <a href="?buscar=<?=$nota['cod_cur']; ?>&show=true"><?=$nota['cod_cur']; ?></a>
        </td>
        <td>
            <!--ir a la seccioon de editar una nota -->
            <form method="GET">
                <input type="hidden" name="buscar" value="<?= $nota['nota']; ?>">
                <input type="hidden" name="show" value="true">
                <input type="submit" value="Editar">
            </form>
        </td>
        <td>
            <!-- Formulario para eliminar una inscripcion -->
            <form method="POST">
                <input type="hidden" name="nota" value="<?php echo $nota['nota']; ?>">
                <input type="submit" name="eliminar" value="Eliminar">
            </form>
        </td>
    </tr>
<?php endforeach; ?>