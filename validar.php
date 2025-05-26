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
        mostrarErrores($errores);
        //Mostrar un enlace para volver al formulario
        echo "<p><a href='javascript:history.back()'>Volver al formulario</a></p>";
    }

}else{
    //No se ha recibido el formulario
    //redirigir al formulario
    header("Location: index.html");
    exit();
}

function mostrarDatos(){
    $comentarios = "";
    if(empty($_POST['inputComentarios'])){
        $comentarios = "Sin comentarios";
    }else{
        $comentarios = $_POST['inputComentarios'];
    }
    //$comentarios = empty($_POST['inputComentarios']) ? "Sin comentarios" : $_POST['inputComentarios'];
    //TODO comprobar si la fecha es válida
    $fecha = new DateTime($_POST['inputAntiguedad']);
    echo "<h2>Datos recibidos:</h2>";
    echo "<p><strong>Nombre: </strong>".htmlentities(htmlspecialchars($_POST['inputNombre'])) ."</p>";
    echo "<p><strong>Dirección: </strong>". htmlspecialchars($_POST['inputDireccion']) ."</p>";
    echo "<p><strong>Email: </strong>". htmlspecialchars($_POST['inputEmail']) ."</p>";
    echo "<p><strong>Contraseña: </strong> Oculta por seguridad</p>";
    echo "<p><strong>Antigüedad: </strong>". $fecha->format('d/m/Y') ."</p>";
    //echo "<p><strong>Antigüedad: </strong>". $_POST['inputAntiguedad'] ."</p>";
    echo "<p><strong>Comentarios: </strong>". htmlspecialchars($comentarios)  ."</p>"; 
    echo "<p><strong>Aceptó políticas: </strong> Sí </p>";
    

}

function mostrarErrores($errores){
    echo "<h2>Errores en el formulario:</h2>";
    echo "<ul>";
    foreach($errores as $error){
        echo "<li>$error</li>";
    }
    echo "</ul>";
}