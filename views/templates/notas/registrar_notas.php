<!-- Formulario para agregar una nota a un curso-->
<div class="container_form registrar_form">
    <button onclick="window.location.href = 'notas_view.php';" class="btn btn-primary ms-2">
        <i class="fa-solid fa-arrow-right-to-bracket arrow_back" style="color: #ffffff;"></i> Regresar
    </button>
    <br>
    <h3><label for="form_agragar"> Registro de notas</label></h3>
    <br>
    <div class="form_registrar notas_form">
        <form method="POST" action="/views/notas_view.php?view=true">
            <input type="text" class="form-control-sm rounded" name="nota" placeholder="Nota" required>
            <input type="number" class="form-control-sm rounded" name="porcentaje" placeholder="Porcentaje" required>
            <input type="number" class="form-control-sm rounded" name="posicion" placeholder="Posicion de la nota" required>
            <select name="cod_cur" id="curso_select" class="form-select-sm  text-black">
                <option disabled selected>Curso</option>
                <?php foreach ($cursosData as $curso): ?>
                    <option value="<?php echo $curso['cod_cur']; ?>"><?php echo $curso['nomb_cur']; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="input-group">
                        <span class="input-group-text">Descripcion</span>
                        <textarea class="form-control" aria-label="With textarea" 
                        name="descrip_nota" placeholder="Breve descripcion" required>Corte </textarea>
            </div>
            <button name="agregar" class="btn btn-primary btn_registro">Agregar   <i class="fa-regular fa-square-plus" style="color: #ffffff;"></i>
            </button>
        </form>
    </div>
</div>
<br>
<br>
<br>