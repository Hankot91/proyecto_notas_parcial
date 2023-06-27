<table>
    <tr>
        <th>Código</th>
        <th>Valor</th>
        <th>Fecha</th>
        <th>N de inscripcion</th>
        <th>Nota</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($calificacionesData as $calificacion): ?>
        <tr>
            <!--Lista de estudiantes -->
            <td>
                <a href="?buscar=<?= $calificacion['cod_cal']; ?>&show=true"><?= $calificacion['cod_cal']; ?></a>
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
                    <input type="submit" value="Editar">
                </form>

                <!-- Formulario para eliminar un estudiante -->
                <form method="POST" action="/views/calificaciones_view.php">
                    <input type="hidden" name="cod_cal" value="<?php echo $calificacion['cod_cal']; ?>">
                    <input type="submit" name="eliminar" value="Eliminar">
                </form>
            </td>
        </tr>

    <?php endforeach; ?>