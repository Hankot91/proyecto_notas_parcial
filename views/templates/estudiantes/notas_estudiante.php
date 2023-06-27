<h4>Notas del Estudiante</h4>
    <table>
        <tr>
            <th>Curso</th>
            <?php $maxNotas = 0; ?>
            <?php foreach ($notasData as $notas): ?>
                <?php $numNotas = count(explode(',', $notas['notas'])); ?>
                <?php if ($numNotas > $maxNotas): ?>
                    <?php $maxNotas = $numNotas; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php for ($i = 1; $i <= $maxNotas; $i++): ?>
                <th>Nota <?php echo $i; ?></th>
            <?php endfor; ?>
            <th colspan="<?php echo $maxNotas - $numNotas; ?>"></th>
            <th>Total</th>
        </tr>
        <?php foreach ($notasData as $notas): ?>
            <tr>
                <td><?php echo $notas['curso']; ?></td>
                <?php $notasArray = explode(',', $notas['notas']); ?>
                <?php $numNotas = count($notasArray); ?>
                <?php for ($i = 0; $i < $maxNotas; $i++): ?>
                    <td><?php echo ($i < $numNotas) ? trim($notasArray[$i], '{}') : ''; ?></td>
                <?php endfor; ?>
                <?php for ($i = $numNotas + 1; $i <= $maxNotas; $i++): ?>
                    <td></td>
                <?php endfor; ?>
                <td><?php echo $notas['total']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>