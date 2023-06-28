<table class="table table-striped table-hover  table-dark">
    <tr>
        <th>Código</th>
        <th>Nombre</th> 
        <th colspan="2">Acciones</th>
    </tr>
    <?php foreach ($cursosData as $curso): ?>
        <tr>
            <td>
                <!--Lista de cursos -->
                <a href="?buscar=<?= $curso['cod_cur']; ?>&show=true" class="badge bg-info rounded-pill"><?= $curso['cod_cur']; ?></a>
            </td>
            <td>
                <?php echo $curso['nomb_cur']; ?>
            </td>
            <td>
                <!-- ir a la seccion de editar un curso -->
                <form method="GET">
                    <input type="hidden" name="buscar" value="<?= $curso['cod_cur']; ?>">
                    <input type="hidden" name="show" value="true">
                    <button type="submit" value="Editar" class="btn btn-success">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </form>
            </td>
            <td>
                <!-- Formulario para eliminar un estudiante -->
                <form method="POST">
                    <input type="hidden" name="cod_cur" value="<?php echo $curso['cod_cur']; ?>">
                    <button type="submit" class="btn btn-danger" name="eliminar" value="Eliminar">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>