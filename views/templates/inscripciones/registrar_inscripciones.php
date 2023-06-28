<!-- Formulario para agregar una inscripcion-->
<div class="container_form registrar_form">
    <button onclick="window.location.href = 'inscripciones_view.php';" class="btn btn-primary ms-2">
        <i class="fa-solid fa-arrow-right-to-bracket arrow_back" style="color: #ffffff;"></i> Regresar
    </button>
    <div class="form_registrar">
        <h3><label for="form_agragar"> Formulario de inscripcion</label></h3>
        <form method="POST" action="/views/inscripciones_view.php?view=true">
            <input type="number" min="0" max="99999"  name="cod_inscripcion"class="form-control-sm rounded" placeholder="Código" required>
            <select name="periodo" placeholder="Periodo" class="form-select-sm  text-black" required>
                <option disabled selected>Periodo</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
            <select name="anho" class="anho_select form-select-sm  text-black"> 
                <option disabled selected>Año</option>
            </select>
            <select name="cod_cur" id="curso_select" class="form-select-sm  text-black">
                <option disabled selected>Curso</option>
                <?php foreach ($cursosData as $curso): ?>
                    <option value="<?php echo $curso['cod_cur']; ?>"><?php echo $curso['nomb_cur']; ?></option>
                <?php endforeach; ?>
            </select>
            <select name="cod_est" id="estudiante_select" class="form-select-sm  text-black">
                <option disabled selected>Estudiante</option>
                <?php foreach ($estudiantesData as $estudiante): ?>
                    <option value="<?php echo $estudiante['cod_est']; ?>"><?php echo $estudiante['nomb_est']; ?></option>
                <?php endforeach; ?>
            </select>
            <button name="agregar" class="btn btn-primary">Agregar   <i class="fa-regular fa-square-plus" style="color: #ffffff;"></i>
            </button>
        </form>
    </div>
</div>