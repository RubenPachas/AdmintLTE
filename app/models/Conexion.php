<?php

const SERVER = "localhost";
const DB = "";
const USER = "root";
const PASS = "";
//CADENA DE CONEXION
const SGBD = "mysql:host=" . SERVER . ";portname=3306;dbname=" . DB . ";charset=UTF8";

class Conexion
{
    /* 
    Retorna la conexion al servidor y BD utilizando patron SINGLETON y de acceso Restringido
    */
    protected static function getConexion(){
        try {
            //Instancia de la clase PDO (integrada en PHP)
            $pdo = new PDO(SGBD, USER, PASS);
            //Gestionara los errores/eccepciones
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Retorna la conexion activa
            return $pdo;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    /* 
    Metodo obtine los datos del SPU y los retorna en forma de arreglo
    */
    public static function getDara($storeProcedure):array{
        return [];   
    }
    /*  
    Envia SQLInjeccion
    */
    public static function limpiarCadena($cadena):string{
        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);
        //JavaScript
        $cadena = str_ireplace("<script>", "", $cadena);
        $cadena = str_ireplace("</script>", "", $cadena);
        $cadena = str_ireplace("<script src>", "", $cadena);
        $cadena = str_ireplace("<script type=>", "", $cadena);
        $cadena = str_ireplace("'>", "", $cadena);
        //SQL
        $cadena = str_ireplace("SELECT * FROM", "", $cadena);
        $cadena = str_ireplace("DELETE FROM", "", $cadena);
        $cadena = str_ireplace("INSERT INTO", "", $cadena);
        $cadena = str_ireplace("DROP TABLE", "", $cadena);
        $cadena = str_ireplace("DROP DATABASE", "", $cadena);
        $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
        $cadena = str_ireplace("SHOW TABLES", "", $cadena);
        $cadena = str_ireplace("SHOW DATABASES", "", $cadena);
        //etiquestas
        $cadena = str_ireplace("<?php", "", $cadena);
        $cadena = str_ireplace("?>", "", $cadena);
        $cadena = str_ireplace("--", "", $cadena);
        $cadena = str_ireplace("<", "", $cadena);
        $cadena = str_ireplace(">", "", $cadena);
        $cadena = str_ireplace("[", "", $cadena);
        $cadena = str_ireplace("]", "", $cadena);
        $cadena = str_ireplace("{", "", $cadena);
        $cadena = str_ireplace("}", "", $cadena);
        $cadena = str_ireplace("(", "", $cadena);
        $cadena = str_ireplace(")", "", $cadena);
        $cadena = str_ireplace("==", "", $cadena);
        $cadena = str_ireplace("=", "", $cadena);
        $cadena = str_ireplace("==", "", $cadena);
        $cadena = str_ireplace("!==", "", $cadena);
        $cadena = str_ireplace("===", "", $cadena);
        $cadena = str_ireplace("^", "", $cadena);
        return $cadena;
    }
    
}
