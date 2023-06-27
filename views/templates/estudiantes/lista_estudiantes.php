<table class="table table-striped table-hover  table-dark">
    <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th colspan="2">Acciones</th>
    </tr>
    <?php foreach ($estudiantesData as $estudiante): ?>
        <tr>
            <!--Lista de estudiantes -->
            <td>
                <a href="?buscar=<?= $estudiante['cod_est']; ?>&show=true" class="badge bg-info rounded-pill"><?= $estudiante['cod_est']; ?></a>
            </td>
            <td>
                <?php echo $estudiante['nomb_est']; ?>
            </td>
            <td>
                <!-- editar un estudiante -->
                <form method="GET">
                    <input type="hidden" name="buscar" value="<?= $estudiante['cod_est']; ?>">
                    <input type="hidden" name="show" value="true">
                    <button type="submit" value="Editar" class="btn btn-success">
                        <i class="fa-solid fa-user-pen"></i>
                    </button>
                </form>
            </td>
            <td>
                <!-- Formulario para eliminar un estudiante -->
                <form method="POST">
                    <input type="hidden" name="cod_est" value="<?php echo $estudiante['cod_est']; ?>">
                    <button type="submit" class="btn btn-danger" name="eliminar" value="Eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
            </td>
        </tr>

    <?php endforeach; ?>