let editCheckbox = document.getElementById('edit_checkbox');
let nameInput = document.querySelector('form .editable-input');
nameInput.disabled = true;

editCheckbox.addEventListener('change', function() {
    nameInput.disabled = !editCheckbox.checked;
});