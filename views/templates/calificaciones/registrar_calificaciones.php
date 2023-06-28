<!-- Formulario para agregar una calificacion-->
<?php

$estudiantesbyCurso = (new CalificacionesController())->handleRequest();
$isEstudiantes = isset($_GET['cod_cur']);


?>
<div class="container_form registrar_form">
    <button onclick="window.location.href = 'calificaciones_view.php';" class="btn btn-primary ms-2">
        <i class="fa-solid fa-arrow-right-to-bracket arrow_back" style="color: #ffffff;"></i> Regresar
    </button>
    <br>
    <div class="form_registrar">

        <h3><label for="form_agragar"> Formulario de registro de calificaciones</label></h3>
        <form method="GET" id="form_curso">
            <input type="hidden" name="register" value="true">
            <select name="cod_cur" id="curso_select" class="form-select-sm  text-black">
                <option disabled selected>Curso</option>
                <?php foreach ($cursosData as $curso): ?>
                    <option value="<?php echo $curso['cod_cur']; ?>"><?php echo $curso['nomb_cur']; ?></option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>
    <br>
    <div>

        <?php if ($isEstudiantes === true): ?>
            <form method="POST" action="/views/calificaciones_view.php">
                <input type="number" class="form-control-sm rounded" name="cod_cal" min="0" max="9999999" placeholder="Codigo" required>
                <select name="cod_inscripcion" id="estudiantes_select" class="form-select-sm  text-black">
                    <option disabled selected>Estudiante</option>
                    <?php foreach ($estudiantesbyCurso as $estudiante): ?>
                        <option value="<?php echo $estudiante['cod_inscripcion']; ?>"><?php echo $estudiante['nomb_est']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <select name="nota" id="notas_select" class="form-select-sm  text-black">
                    <option disabled selected>Nota</option>
                    <?php foreach ($notasData as $nota): ?>
                        <?php if ($nota['cod_cur'] == $_GET['cod_cur']): ?>
                            <option value="<?php echo $nota['nota']; ?>"><?php echo $nota['posicion']; ?></option>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="valor" placeholder="Valor" required pattern="[0-5](\.[0-9]+)?"
                    title="Ingrese un valor entre 0 y 5" class="form-control-sm rounded">
                <input type="date" name="fecha" placeholder="Fecha" required class="form-control-sm rounded">
                <button name="agregar" class="btn btn-primary">Agregar   <i class="fa-regular fa-square-plus" style="color: #ffffff;"></i>
                </button>
            </form>
            <?php endif; ?>
        </div>
            
</div>
<br>