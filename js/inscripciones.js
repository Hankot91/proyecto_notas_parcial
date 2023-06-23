
let selects = document.getElementsByClassName("anho_select");

let currentYear = new Date().getFullYear();

// Recorre todos los elementos select con la clase "anho_select"
Array.from(selects).forEach(select => {
  // Agrega opciones al desplegable desde el año actual hasta 2000
  for (var i = currentYear; i >= 2000; i--) {
    var option = document.createElement("option");
    option.value = i;
    option.text = i;
    select.appendChild(option);
  }
});
