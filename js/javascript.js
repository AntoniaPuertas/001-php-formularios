/**
 * Evento que se ejecuta cuando el documento ha terminado de cargarse
 * Cuando el navegador ha terminado de crear el DOM
 */
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const mensajeError = document.getElementById("mensajeError");
    const mensajeEnviado = document.getElementById("mensajeEnviado");

    //crear un evento para el submit del formulario
    form.addEventListener('submit', function(event) {

        let errores = [];

        //validar nombre
        const inputNombre = document.getElementById("inputNombre");
        //comprobar si tiene contenido
        if(inputNombre.value.trim() === ''){
            errores.push("El nombre es obligatorio");
        }
        if(inputNombre.value.trim().length < 3){
            errores.push("El nombre es demasiado corto");
        }

        //validar direccion
        const inputDireccion = document.getElementById("inputDireccion");
        //comprobar si tiene contenido
        if(inputDireccion.value.trim() === ''){
            errores.push("La dirección es obligatoria");
        }

        //validar correo
        const inputCorreo = document.getElementById("inputEmail");
        if(inputCorreo.value.trim() === ''){
            errores.push("La dirección de email es obligatoria")
        }
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!regex.test(inputCorreo.value.trim())){
            errores.push("La dirección de correo no es válida")
        }

        //validar contraseña
        const inputPassword = document.getElementById("inputPassword");
        if(inputPassword.value.trim() < 8 || inputPassword.value.trim() > 10){
            errores.push("La contraseña debe tener entre 8 y 10 caracteres")
        }
        //comprobar si tiene al menos un dígito
        if(/\d/.test(inputPassword.value) === false){
            errores.push("La contraseña debe contener al menos un número")
        }
        //validar antiguedad
        const inputAntiguedad = document.getElementById("inputAntiguedad");
        if(inputAntiguedad.value === ''){
            errores.push("La fecha de antiguedad es obligatoria");
        }
        
        //validar políticas
        const checkPoliticas = document.getElementById("aceptaPoliticas");
        if(!checkPoliticas.checked){
            errores.push("Debes aceptar las políticas de privacidad")
        }
        //Si hay errores, mostrarlos y parar el envío del formulario
        if(errores.length > 0){
            //parar el submit (parar el envío del formulario)
            event.preventDefault();
            mensajeError.innerHTML = mostrarErrores(errores);
            mensajeError.classList.remove('d-none');
        }else{
            mensajeError.classList.add('d-none');
        }
    })

})

function mostrarErrores(errores){
    listaErrores = '<ul>';
    listaErrores += errores.map(error => 
        `<li>${error}</li>`
    ).join('');
    listaErrores += '</ul>';
    return listaErrores;
}
