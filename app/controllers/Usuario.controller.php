<?php
session_start();

require_once "../models/Usuario.php";
$usuario = new Usuario();

//Arreglo para manejo de perfiles
//Modulo    : cada carpeta en views/
//ruta      : cada vista (UNIQUEE)omitir la extension
//visible  : e renderizada en el sidebar  
//texto     : info amostrar en el sidebar (solo si visible es true)
//icono     : info amostrar en el sidebar (solo si visible es true)
$accesos = [
    "ADM" => [
        //WELCOME denpdera que welcome tengas en la carpeta home puede variar el nombre home por otro y de igual maenra el welcome
        ["modulo" => "home", "ruta" => "welcome", "visible" => false, "texto" => "", "icono" => ""],//varia welcome

        ["modulo" => "colaboradores", "ruta" => "actulizar-colaborador", "visible" => false, "texto" => "", "icono" => ""],
        ["modulo" => "colaboradores", "ruta" => "lista-colaborador", "visible" => true, "texto" => "Colaborador", "icono" => "nav-icon fas fa-th"],
        ["modulo" => "colaboradores", "ruta" => "registra-colaborador", "visible" => false, "texto" => "", "icono" => ""],

        ["modulo" => "horarios", "ruta" => "lista-horario", "visible" => true, "texto" => "Horarios", "icono" => "nav-icon fas fa-th"],
        ["modulo" => "horarios", "ruta" => "registra-horario", "visible" => false, "texto" => "", "icono" => "nav-icon fas fa-th"],
        
        ["modulo" => "permisos", "ruta" => "lista-permiso", "visible" => true, "texto" => "Permisos", "icono" => "nav-icon fas fa-th"],
        ["modulo" => "permisos", "ruta" => "registra-permiso", "visible" => false, "texto" => "", "icono" => ""],

        ["modulo" => "reportes", "ruta" => "lista-reporte", "visible" => true, "texto" => "Reportes", "icono" => "nav-icon fas fa-th"]


    ],
    "SPV" => [
        ["modulo" => "home", "ruta" => "welcome", "visible" => false, "texto" => "", "icono" => ""],//varia welcome
        ["modulo" => "colaboradores", "ruta" => "lista-colaborador", "visible" => true, "texto" => "Colaborador", "icono" => "nav-icon fas fa-th"],
        ["modulo" => "horarios", "ruta" => "lista-horario", "visible" => true, "texto" => "Horarios", "icono" => "nav-icon fas fa-th"],
        ["modulo" => "horarios", "ruta" => "registra-horario", "visible" => false, "texto" => "", "icono" => "nav-icon fas fa-th"],
        ["modulo" => "permisos", "ruta" => "lista-permiso", "visible" => true, "texto" => "Permisos", "icono" => "nav-icon fas fa-th"]
    ],
    "INV" => [
        ["modulo" => "home", "ruta" => "welcome", "visible" => false, "texto" => "", "icono" => ""],//varia welcome
        ["modulo" => "horarios", "ruta" => "lista-horario", "visible" => true, "texto" => "Horarios", "icono" => "nav-icon fas fa-th"],
        ["modulo" => "permisos", "ruta" => "lista-permiso", "visible" => true, "texto" => "Permisos", "icono" => "nav-icon fas fa-th"]
    ]
];
//Variable/ arreglo de sesion
if (!isset($_SESSION['login']) || $_SESSION['login']['status'] == false) {
    $_SESSION['login'] = [
        "status"    => false,
        "idusuario" => -1,
        "apellidos" => "",
        "nombres"   => "",
        "perfil"    => "",
        "nomser"    => "",
        "permisos"  => []
    ];
}


//Comunicacion E/S json
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST['operation'] == "login") {
        //Se obtiene los datos del formulario
        //Obteniendo datos del origen (VISTA)
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
                //Enviamos todos los accesos en funcion del perfil
                $_SESSION['login']['permisos'] = $accesos[$registro[0]['nombrecorto']];

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
