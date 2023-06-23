
let selects = document.getElementsByClassName("anho_select");

let currentYear = new Date().getFullYear();
Array.from(selects).forEach(select => {
  // Agrega opciones al desplegable desde el año actual hasta 2000
  for (var i = currentYear; i >= 2000; i--) {
    var option = document.createElement("option");
    option.value = i;
    option.text = i;
    select.appendChild(option);
  }
});


let editCheckbox = document.getElementById('edit_checkbox');
let  editableSelects = document.querySelectorAll('form .editable-select');
let anhoSelect = document.querySelector('form .anho_edit');

function toggleInputs() {
    var disabled = !editCheckbox.checked;
    for (var i = 0; i < editableSelects.length; i++) {
        editableSelects[i].disabled = disabled;
    }
    anhoSelect.disabled = disabled;
}

editCheckbox.addEventListener('change', toggleInputs);
toggleInputs();