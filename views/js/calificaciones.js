document.addEventListener('DOMContentLoaded', function() {
        let formCurso = document.getElementById('form_curso');
        let selectCurso = document.getElementById('curso_select');

        selectCurso.addEventListener('change', function () {
                formCurso.submit();
        });
});    

let editCheckbox = document.getElementById('edit_checkbox');
let editableInputs = document.querySelectorAll('form .editable-input');
let editableSelect = document.querySelector('form .editable-select');
let inputSubmit = document.querySelector('form .input-submit');

editableInputs.forEach(function (input) {
        input.disabled = true;
});


editableSelect.disabled  = inputSubmit.disabled =true;

editCheckbox.addEventListener('change', function () {
        editableInputs.forEach(function (input) {
                input.disabled = !editCheckbox.checked;
        });
        editableSelect.disabled = inputSubmit.disabled = !editCheckbox.checked;
});

