
let editCheckbox = document.getElementById('edit_checkbox');
let nameInput = document.querySelector('form .editable-input');
let inputSubmit = document.querySelector('form .input-submit');
nameInput.disabled = inputSubmit.disabled = true;

editCheckbox.addEventListener('change', function() {
    nameInput.disabled =inputSubmit.disabled = !editCheckbox.checked;
});
