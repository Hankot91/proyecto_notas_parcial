<table>
    <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($cursosData as $curso): ?>
        <tr>
            <td>
                <!--Lista de cursos -->
                <a href="?buscar=<?= $curso['cod_cur']; ?>&show=true"><?= $curso['cod_cur']; ?></a>
            </td>
            <td>
                <?php echo $curso['nomb_cur']; ?>
            </td>
            <td>
                <!-- ir a la seccion de editar un curso -->
                <form method="GET">
                    <input type="hidden" name="buscar" value="<?= $curso['cod_cur']; ?>">
                    <input type="hidden" name="show" value="true">
                    <input type="submit" value="Editar">
                </form>
            </td>
            <td>
                <!-- Formulario para eliminar un estudiante -->
                <form method="POST">
                    <input type="hidden" name="cod_cur" value="<?php echo $curso['cod_cur']; ?>">
                    <input type="submit" name="eliminar" value="Eliminar">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>