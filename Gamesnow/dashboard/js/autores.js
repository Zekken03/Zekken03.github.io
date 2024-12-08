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
    var nombre=btn.getAttribute("data-nombre")
    document.getElementById("txtNombreEdit").value=nombre
    var correo=btn.getAttribute("data-correo")
    document.getElementById("txtCorreoEdit").value=correo
    var biografia=btn.getAttribute("data-biografia")
    document.getElementById("txtBiografiaEdit").value=biografia
    var redes=btn.getAttribute("data-redes")
    document.getElementById("txtRedesEdit").value=redes

  }
}

  
  for(var i=0; i<botones.length;i++){
    botones[i].onclick=(evt)=>{
      var btn = evt.target
      id = btn.getAttribute('data-id')
      //alert("AAAAAAAAAAAAAAAAAAAAAAAAAAHHHH" + id)
  
    }
  }
  
  
  
  //ELIMINAR
  document.getElementById("eliminar").onclick=()=>{
    location.href="../admin/php/remove-autor.php?id="+id
  }
  
  
  
  
  
  
    // Mostrar/ocultar campos de contraseña si se marca el checkbox
  document.getElementById("changePassword").addEventListener("change", function() {
    const passwordFields = document.getElementById("passwordFields");
    const confirmPasswordFields = document.getElementById("confirmPasswordFields");
    console.log("hola")
    // Verificamos si el checkbox está marcado
    if (this.checked) {
        passwordFields.style.display = "block";
        confirmPasswordFields.style.display = "block";
    } else {
        passwordFields.style.display = "none";
        confirmPasswordFields.style.display = "none";
    }
  });
  
  
  
  
  
  
  
  /* location.href="../admin/php/remove-user.php?id="+id*/