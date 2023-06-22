
let  select = document.getElementById("anho_select");


let currentYear = new Date().getFullYear();

// Agrega opciones al desplegable desde el año actual hasta 1900 (puedes ajustar este rango según tus necesidades)
for (var i = currentYear; i >= 2000; i--) {
  var option = document.createElement("option");
  option.value = i;
  option.text = i;
  select.appendChild(option);
}
