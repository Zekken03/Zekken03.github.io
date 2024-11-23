document.getElementById("btnGuardar").onclick=(event)=>{
    event.preventDefault()//EVITA RECARGAR LA PÁGINA
    document.getElementById("form").classList.add('was-validated')
    document.querySelector("#divAlerta").classList.remove("d-none")
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "¡Algo salió mal!",
        //footer: '<a href="#">Why do I have this issue?</a>'
      });
}



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

