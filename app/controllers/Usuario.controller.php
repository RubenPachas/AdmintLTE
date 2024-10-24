<?php
session_start();

require_once "../models/Usuario.php";
$usuario = new Usuario();

//Variable/ arreglo de sesion
if (!isset($_SESSION['login']) || $_SESSION['login']['status'] == false) {
    $_SESSION['login'] = [
        "status"    => false,
        "idusuario" => -1,
        "apellidos" => "",
        "nombres"   => "",
        "perfil"    => "",
        "nomser"    => ""
    ];
}


//Comunicacion E/S json
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST['operation'] == "login") {
        //Se obtiene los datos del formulario
        //Obteniendo datos del origen (VISTA0)
        $nomuser = $usuario->limpiarCadena($_POST['nomuser']);
        $passuser = $usuario->limpiarCadena($_POST['passuser']);
        $claveEncriptada = "";
        $estadoLogin =[
            "esCorrecto"    => false,
            "mensaje"       => ""
        ];

        $registro = $usuario->login(["nomuser" => $nomuser]);

        //Comporbar si existe el usuario
        if (count($registro) == 0) {
            //No existe el usuario
            $estadoLogin["mensaje"] = "El usuario no existe";
        } else {
            //El usuario existe, verificar la contraseña
            $claveEncriptada = $registro[0]['passuser'];

            if (password_verify($passuser, $claveEncriptada)) {
                //La contraseña es correcta
                $estadoLogin["esCorrecto"] = true;
                $estadoLogin["mensaje"] = "Login correcto";

                //Actulizar los datos de la variable de sesion
                $_SESSION['login']['status'] = true;
                $_SESSION['login']['idusuario'] = $registro[0]['idusuario'];
                $_SESSION['login']['apellidos'] = $registro[0]['apellidos'];
                $_SESSION['login']['nombres'] = $registro[0]['nombres'];
                $_SESSION['login']['perfil'] = $registro[0]['perfil'];
                $_SESSION['login']['nomuser'] = $registro[0]['nomuser'];

            } else {
                //La contraseña no es correcta
                $estadoLogin["mensaje"] = "La contraseña no es correcta";
            }
        }
        
        echo json_encode($estadoLogin);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($_GET['operation'] == "destroy") {
        session_destroy();
        session_unset();
        header("Location: ../../");
    }
}
