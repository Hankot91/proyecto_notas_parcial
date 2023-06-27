let editCheckbox = document.getElementById('edit_checkbox');
let editableInputs = document.querySelectorAll('form .editable-input');
let editableSelect = document.querySelector('form .editable-select');
let editableText = document.querySelector('form .editable-text');
let inputSubmit = document.querySelector('form .input-submit');

editableInputs.forEach(function(input) {
    input.disabled = true;
});

editableSelect.disabled = editableText.disabled = inputSubmit.disabled = true;

editCheckbox.addEventListener('change', function() {
    editableInputs.forEach(function(input) {
        input.disabled = !editCheckbox.checked;
    });
    editableSelect.disabled = editableText.disabled = inputSubmit.disabled = !editCheckbox.checked;
});