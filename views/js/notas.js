let editCheckbox = document.getElementById('edit_checkbox');
let editableInputs = document.querySelectorAll('form .editable-input');
let editableSelect = document.querySelector('form .editable-select');
let editableText = document.querySelector('form .editable-text');

editableInputs.forEach(function(input) {
    input.disabled = true;
});

editableSelect.disabled = editableText.disabled = true;

editCheckbox.addEventListener('change', function() {
    editableInputs.forEach(function(input) {
        input.disabled = !editCheckbox.checked;
    });
    editableSelect.disabled = editableText.disabled = !editCheckbox.checked;
});