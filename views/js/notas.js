let editCheckbox = document.getElementById('edit_checkbox');
let editableInputs = document.querySelectorAll('form input.editable-input, form select.editable-select, form textarea.editable-text');
let inputSubmit = document.querySelector('.input-submit');
let actualizarButton = document.querySelector('form [name="actualizar"]');

editableInputs.forEach(function(input) {
    input.disabled = true;
});

inputSubmit.disabled = true;

editCheckbox.addEventListener('change', function() {
    let isCheckboxChecked = editCheckbox.checked;

    editableInputs.forEach(function(input) {
        input.disabled = !isCheckboxChecked;
    });

    inputSubmit.disabled = !isCheckboxChecked;

});

inputSubmit.addEventListener('click', function(e) {
    actualizarButton.click();
});