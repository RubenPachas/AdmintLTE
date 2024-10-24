<?php

require_once "../models/Usuario.php";

header('Content-Type: application/json; charset=utf-8');

$usuario = new Usuario();
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
            } else {
                //La contraseña no es correcta
                $estadoLogin["mensaje"] = "La contraseña no es correcta";
            }
        }
        
        echo json_encode($estadoLogin);
    }
}
