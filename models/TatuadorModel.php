<?php
    require_once "./database/DBHandler.php";

    class TatuadorModel {
        private $nombreTabla = "tatuadores"; // NOMBRE DE LA TABLA DE LA BASE DE DATOS
        private $conexion;              // ATRIBUTO QUE ALMACENARÁ LA CONEXIÓN A LA BASE DE DATOS
        private $dbHandler;             // ATRIBUTO QUE ALMACENA LA INSTANCIA DE DBHAndler

        public function __construct() {
            // CONECTARSE A LA BASE DE DATOS
            /*
            1º NECESITAMOS SABER LOS PARÁMETROS DE CONEXION A LA BASE DE DATOS
            - IP (localhost o la IP que sea)
            - usuario
            - contraseña
            - nombre de la base de datos
            - puerto
            Inicializamos un objeto DBHandler (el de la clase que hemos construído) que va a ser
            el encargado de conectar y desconectar la base de datos
            */
            $this->dbHandler = new DBHandler("localhost","root","","tattoos_bd","3306");
        }

        public function insertTatuador($nombre, $email, $password, $foto) {

            // INSERTAR EN LA BASE DE DATOS
            /*
            2º NECESITAMOS PREPARAR UNA SENTENCIA SQL PARA INSERTAR EN LA BD
                a) Nos conectamos a la BD
                b) Escribimos la sentencia SQL -> INSERT INTO citas (id, descripcion, fechaCita, cliente, tatuador) VALUES ($id, $descripcion, $fechaCita, $cliente, $tatuador);
                c) Realizamos un prepared statement -> Las s corresponden a la posición de la ? y al tipo de dato de la ?
            */
            // a) Usamos el método conectar() que hemos hecho para obtener la conexión a la BD
            $this->conexion = $this->dbHandler->conectar();
            // b) Escribimos una sentencia SQL tal cual, poniendo ? por cada columna de la tabla de la BD
            $sql = "INSERT INTO $this->nombreTabla (nombre, email, password, foto) VALUES (?, ?, ?, ?)";
            // c.1) Realizamos un prepared statement con el método .prepare() del objeto $this->conexion
            $stmt = $this->conexion->prepare($sql);
            // c.2) Intercambiamos las interrogaciones por nuestros valores. Cada s corresponde a una ?, y con la s le decimos que se trata de un string
            // s -> string, d -> double/float, i -> integer
            $stmt-> bind_param("ssss", $nombre, $email, $password, $foto); // "bindear"/unir cada parámetro a su interrogación. "qué tipo de datos vamos a intercambiar", "los datos en sí"

            /*
            3º EJECUTAR LA SENTENCIA SQL

            Ejecutamos la query -> .execute(), devuelve true o false si la operación ha sido exitosa o no

            ¡ATENCIÓN! -> Al conectarnos a la base de datos o al ejecutar la query se pueden producir excepciones
            */
            try {
                return $stmt->execute(); // EXECUTE DEVUELVE UN TRUE O FALSE -> SI HA SIDO EXITOSA LA OPERACION O NO
            } catch(Exception $e) {
                return false;
            } finally {
                $this->dbHandler->desconectar(); // USAMOS FINALLY PARA ASEGURARNOS QUE HEMOS CERRADO LA CONEXIÓN A LA BASE DE DATOS
            }
        }

        public function emailExist($email) {
            $this->conexion = $this->dbHandler->conectar();

            // Preparar la consulta para verificar si el email existe
            $sql = "SELECT COUNT(*) as count FROM $this->nombreTabla WHERE email = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();

            // Obtener el resultado
            $resultado = $stmt->get_result();
            $fila = $resultado->fetch_assoc();

            // Cerrar la conexión y devolver si existe o no
            $this->dbHandler->desconectar();

            return $fila['count'] > 0; // Devuelve true si el email existe, false si no
        }

    }
?>