<!-- Formulario para agregar un estudiante -->

<div class="container_form registrar_form">
    <button onclick="window.location.href = 'estudiantes_view.php';" class="btn btn-primary ms-2">
        <i class="fa-solid fa-arrow-right-to-bracket arrow_back" style="color: #ffffff;"></i> Regresar
    </button>
    <div class="form_registrar">
        <h3><label for="form_agragar"> Formulario de inscripcion de estudiante</label></h3>
        <form method="POST" action="/views/estudiantes_view.php?view=true" class="registar">
            <input type="number" class="form-control-sm rounded" min="0" max="999999999"  name="cod_est" placeholder="Código" required>
            <input type="text"  class="form-control-sm rounded" name="nomb_est" placeholder="Nombre del estudiante" required>
            <button name="agregar" class="btn btn-primary">Agregar  <i class="fa-solid fa-user-plus" style="color: #ffffff;"></i>
            </button>
        </form>
    </div>
    
</div>