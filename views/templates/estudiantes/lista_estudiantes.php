<table>
    <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($estudiantesData as $estudiante): ?>
        <tr>
            <!--Lista de estudiantes -->
            <td>
                <a href="?buscar=<?= $estudiante['cod_est']; ?>&show=true"><?= $estudiante['cod_est']; ?></a>
            </td>
            <td>
                <?php echo $estudiante['nomb_est']; ?>
            </td>
            <td>
                <!-- editar un estudiante -->
                <form method="GET">
                    <input type="hidden" name="buscar" value="<?= $estudiante['cod_est']; ?>">
                    <input type="hidden" name="show" value="true">
                    <input type="submit" value="Editar">
                </form>
            </td>
            <td>
                <!-- Formulario para eliminar un estudiante -->
                <form method="POST">
                    <input type="hidden" name="cod_est" value="<?php echo $estudiante['cod_est']; ?>">
                    <input type="submit" name="eliminar" value="Eliminar">
                </form>
            </td>
        </tr>

    <?php endforeach; ?>