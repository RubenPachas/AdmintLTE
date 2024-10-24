<?php 
require_once "Conexion.php";
/* 
 Contiene toda la logica (CRUD) de acceso a datos
*/
class Usuario extends Conexion{
    
    //Obejto a nivel de clase, que almacena la conexion a la base de datos
    private $pdo;

    /**
     * La momento de instanciar esta clase, el objeto "pdo" recibe la conexion a la base de datos
     */
    public function __CONSTRUCT(){
        $this->pdo = parent::getConexion();
    }

    /**
     * Valida el acceso en 2 pasos (primero valida el usuario y luego la contraseña)
     * @param array $params Arreglo que contiene el usuario y la contraseña
     * @return array Retorna una coleccion
     */
    
    public function login($params = []):array{
        try {
            //Variables de entrada:
            //Forma 1   : ?,?,? (comodines|indice de datos)
            //Forma 2   : @valor1, @valor2, @valorN (explicita)                          
            $cmd = $this->pdo->prepare("call spu_usuarios_login(?)"); 
            
            //Forma 1
            $cmd->execute(array($params["nomuser"]));
            //Forma 2
            //$cmd->bindParam(1, $params["usuario"], PDO::PARAM_STR);

            //Se retorna la coleccion como arreglo asociativo (JSON)
            return $cmd->fetchAll(PDO::FETCH_ASSOC);
        } 
        catch (Exception $e) {
            error_log("Error login: ".$e->getMessage());
            return [];
        }
    }
    public function add(){}
    public function update(){}
    public function delete(){}

   
}


    