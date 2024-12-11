

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
  
    }
  }
  
  for(var i=0; i<botones.length;i++){
    botones[i].onclick=(evt)=>{
      var btn = evt.target
      id = btn.getAttribute('data-id')
      //alert("AAAAAAAAAAAAAAAAAAAAAAAAAAHHHH" + id)
  
    }
  }

  
