/*document.getElementById("deleteModal").onclick=(event)=>{
    event.preventDefault()//EVITA RECARGAR LA PÁGINA
    document.getElementById("form").classList.add('was-validated')
    document.querySelector("#divAlerta").classList.remove("d-none")
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "¡Algo salió mal!",
        //footer: '<a href="#">Why do I have this issue?</a>'
      });
}*/



// document.getElementById("btnSave").onclick=(event)=>{
//   event.preventDefault()//EVITA RECARGAR LA PÁGINA
//   document.getElementById("form").classList.add('was-validated')
//   document.querySelector("#divAlerta").classList.remove("d-none")
//   Swal.fire({
//       icon: "error",
//       title: "Oops...",
//       text: "¡Algo salió mal!",
//       //footer: '<a href="#">Why do I have this issue?</a>'
//     });
// }


document.addEventListener('DOMContentLoaded', function () {
  'use strict';

  // Selecciona todos los formularios con la clase 'needs-validation'
  var forms = document.querySelectorAll('.needs-validation');

  // Aplica validación personalizada a cada formulario
  Array.prototype.slice.call(forms).forEach(function (form) {
      form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
              event.preventDefault(); // Detiene el envío
              event.stopPropagation(); // Detiene propagación de eventos
          }
          form.classList.add('was-validated'); // Aplica estilos de validación Bootstrap
      }, false);
  });
});


/*const modal = document.getElementById('exampleModal');
modal.addEventListener('hidden.bs.modal', function () {
    const form = modal.querySelector('form');
    form.classList.remove('was-validated');
    form.reset();
});*/





var id=0


var botones = document.getElementsByClassName("btnDelete");
//EDITAR
var botonesEditar = document.getElementsByClassName("btnEditar")
for(var i=0; i<botonesEditar.length; i++){
  botonesEditar[i].onclick=(evt)=>{
    var btn = evt.target.closest(".btnEditar");
    var id=btn.getAttribute("data-id")
    document.getElementById("txtIdEdit").value=id
    var titulo=btn.getAttribute("data-titulo")
    document.getElementById("txtTituloEdit").value=titulo
    var contenido=btn.getAttribute("data-contenido")
    $('#txtContenidoEdit').summernote('code', contenido);

    var tipo=btn.getAttribute("data-tipo-id")
    document.getElementById("txtTipoEdit").value=tipo
    var autor=btn.getAttribute("data-autor")
    document.getElementById("txtAutorEdit").value=autor

  }
}

for(var i=0; i<botones.length;i++){
  botones[i].onclick=(evt)=>{
    var btn = evt.target.closest(".btnDelete");
    id = btn.getAttribute('data-id')
    //alert("AAAAAAAAAAAAAAAAAAAAAAAAAAHHHH" + id)

  }
}



//ELIMINAR
document.getElementById("eliminar1").onclick=()=>{
  location.href="../admin/php/remove-articulo.php?id="+id
}






  // Mostrar/ocultar campos de contraseña si se marca el checkbox



document.addEventListener('DOMContentLoaded', function() {
  // Comprobar si el campo ya tiene un valor (es decir, ya está precargado)
  let titulo = document.getElementById('txtTituloEdit');
  if (titulo.value.trim() !== "") {
      // Si el campo ya tiene un valor, marquémoslo como válido
      titulo.classList.add('is-valid');
      titulo.classList.remove('is-invalid');
  }
});


$('.summernote').summernote({
  height: 300,  // Ajusta la altura inicial
  disableResizeEditor: true,  // Desactiva el redimensionamiento manual
  minHeight: null,
  maxHeight: null,
  focus: true
});

// Función para eliminar las etiquetas HTML
function stripHTMLTags(html) {
  let div = document.createElement('div');
  div.innerHTML = html;
  return div.textContent || div.innerText || "";
}

// Función para decodificar entidades HTML
function decodeHTML(html) {
  let textarea = document.createElement("textarea");
  textarea.innerHTML = html;
  return textarea.value;
}

// Cargar el contenido en el editor de texto (sin etiquetas)
let contenidoOriginal = 'An\u00e1lisis de versiones\u0026nbsp;PS5, Xbox Series X\/S y PC<\/b>.<\/div><\/div>';
let contenidoDecodificado = decodeHTML(contenidoOriginal);
let contenidoLimpio = stripHTMLTags(contenidoDecodificado);

// Cargarlo en Summernote (solo el texto limpio)
$('#txtContenidoEdit').summernote('code', contenidoLimpio);

// Recuperar el contenido con etiquetas para guardar
let contenidoConEtiquetas = $('#txtContenidoEdit').summernote('code');
console.log(contenidoConEtiquetas);  // Aquí está el contenido con las etiquetas HTML intactas.


/* location.href="../admin/php/remove-user.php?id="+id*/
document.addEventListener('DOMContentLoaded', function () {
  // Obtiene el formulario de comentarios
  var form = document.querySelector("form[action='../admin/php/agregar-comentario.php']");

  // Asigna el valor del id a un campo oculto antes de enviar el formulario
  form.addEventListener('submit', function (event) {
    var comentarioId = document.getElementById("idComentario");  // Campo oculto en el formulario
    var idPubli = new URLSearchParams(window.location.search).get('id');  // Obtiene el 'id' de la URL
  });
});
