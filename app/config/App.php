<?php

//Constantes globales
const SERVERURL = "http://localhost/Permisos/";
const COMPANY = "SENATI";
const VERSION = "1.0";

//Configuracion horarira
date_default_timezone_set("America/Lima");

//recursos - HELPERS...
function renderContentHeader($title, $home, $path){
    return "
        <div class='content-header'>
        <div class='container-fluid'>
            <div class='row mb-2'>
                <div class='col-sm-6'>
                    <h1 class='m-0'{$title}>Registro de colaborador</h1>
                </div><!-- /.col -->
                <div class='col-sm-6'>
                    <ol class='breadcrumb float-sm-right'>
                        <li class='breadcrumb-item'><a href='{$path}'>{$home}</a></li>
                        <li class='breadcrumb-item active'>{$title}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    ";
}