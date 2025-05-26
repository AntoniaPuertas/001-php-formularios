<?php
//echo "Aquí recibimos los datos";

$errores = [];

// echo "<pre>";
// var_dump($_SERVER);
// echo "</pre>";

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

//Verificar si se ha enviado el formulario por post
if($_SERVER['REQUEST_METHOD'] == "POST"){
    //Validar nombre
    if(empty($_POST['inputNombre'])){
        $errores[] = "El nombre es obligatorio";
    }

    //Validar dirección
    if(empty($_POST['inputDireccion'])){
        $errores[] = "La dirección es obligatoria";
    }

    //Validar correo
    if(empty($_POST['inputEmail'])){
        $errores[] = "La dirección de email es obligatoria";
    }else if(!filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)){
        $errores[] = "El formato del email no es correcto";
    }

    //validar contraseña
    if(empty($_POST['inputPassword'])){
        $errores[] = "La contraseña es obligatoria";
    }

    //validar antiguedad
    if(empty($_POST['inputAntiguedad'])){
        $errores[] = "La fecha de antiguedad es obligatoria";
    }

    //validar que ha aceptado las políticas
    if(empty($_POST['aceptaPoliticas'])){
        $errores[] = "Debe aceptar las políticas de privacidad";
    }

    if(empty($errores)){
        //se han recibido los datos y no hay errores
        //Guardar los datos en una base de datos
        //Mostrar los datos  por pantalla 
        mostrarDatos();
    }else{
        //se han recibido los datos y hay errores
        //Mostrar los errores por pantalla
        mostrarErrores();
        //Mostrar un enlace para volver al formulario
        
    }

}else{
    //No se ha recibido el formulario
    //redirigir al formulario
    header("Location: index.html");
    exit();
}

function mostrarDatos(){

}

function mostrarErrores(){

}